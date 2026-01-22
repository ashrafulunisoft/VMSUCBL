<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Visit;
use App\Models\VisitType;
use App\Services\EmailNotificationService;
use App\Services\SmsNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    /**
     * Display a listing of visitors
     */
    public function index()
    {
        $visits = Visit::with(['visitor', 'type', 'meetingUser'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('vms.backend.visitor.index', compact('visits'));
    }

    /**
     * Show the form for creating a new visitor
     */
    public function create()
    {
        $users = User::where('status', 'active')->get();
        $visitTypes = VisitType::all();

        return view('vms.backend.visitor.create', compact('users', 'visitTypes'));
    }

    /**
     * Store a newly created visitor
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:visitors,email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'host_name' => 'required|string|max:255',
            'purpose' => 'required|string|max:500',
            'visit_date' => 'required|date|after_or_equal:today',
            'visit_type_id' => 'required|exists:visit_types,id',
            'face_image' => 'nullable|string',
        ]);

        try {
            // Create or find visitor
            $visitor = Visitor::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->company,
                    'is_blocked' => false,
                ]
            );

            // Find host user
            $hostUser = User::where('name', 'like', '%' . $request->host_name . '%')->first();

            if (is_null($hostUser)) {
                $hostUser = Auth::user();
                Log::warning('Host not found, using current user as default host', [
                    'requested_host' => $request->host_name,
                    'default_host' => $hostUser->name,
                ]);
            }

            // Create visit record
            $visit = Visit::create([
                'visitor_id' => $visitor->id,
                'meeting_user_id' => $hostUser->id,
                'visit_type_id' => $request->visit_type_id,
                'purpose' => $request->purpose,
                'schedule_time' => $request->visit_date,
                'status' => 'pending', // Default to pending for non-admin
            ]);

            // Send email notification
            $emailData = [
                'visitor_name' => $visitor->name,
                'visitor_email' => $visitor->email,
                'visitor_phone' => $visitor->phone,
                'visitor_company' => $visitor->address,
                'visit_date' => \Carbon\Carbon::parse($visit->schedule_time)->format('F j, Y - g:i A'),
                'visit_type' => $visit->type->name ?? 'N/A',
                'purpose' => $visit->purpose,
                'host_name' => $hostUser->name,
                'status' => $visit->status,
            ];

            $emailService = new EmailNotificationService();
            $emailService->sendVisitorRegistrationEmail($emailData);

            // Send SMS notification if phone number exists
            if (!empty($visitor->phone)) {
                $smsMessage = "Dear {$visitor->name}, Your visit to UCB Bank has been registered for " .
                              \Carbon\Carbon::parse($visit->schedule_time)->format('F j, Y - g:i A') .
                              ". Host: {$hostUser->name}. Status: {$visit->status}. Thank you!";

                $phone = preg_replace('/[^0-9]/', '', $visitor->phone);
                if (strpos($phone, '880') !== 0) {
                    $phone = '88' . $phone;
                }

                $smsService = new SmsNotificationService();
                $smsService->send($phone, $smsMessage);
            }

            return redirect()->route('visitor.index')
                ->with('success', 'Visitor ' . $visitor->name . ' registered successfully!');

        } catch (\Exception $e) {
            Log::error('Error during visitor registration', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Failed to register visitor: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified visitor
     */
    public function show($id)
    {
        $visit = Visit::with(['visitor', 'type', 'meetingUser'])->findOrFail($id);

        return view('vms.backend.visitor.show', compact('visit'));
    }

    /**
     * Show the form for editing the specified visitor
     */
    public function edit($id)
    {
        $visit = Visit::with(['visitor', 'type', 'meetingUser'])->findOrFail($id);
        $users = User::where('status', 'active')->get();
        $visitTypes = VisitType::all();

        return view('vms.backend.visitor.edit', compact('visit', 'users', 'visitTypes'));
    }

    /**
     * Update the specified visitor
     */
    public function update(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);
        $visitor = Visitor::findOrFail($visit->visitor_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:visitors,email,'.$visitor->id.'|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'host_name' => 'required|string|max:255',
            'purpose' => 'required|string|max:500',
            'visit_date' => 'required|date|after_or_equal:today',
            'visit_type_id' => 'required|exists:visit_types,id',
            'status' => 'nullable|in:approved,pending,completed,cancelled',
        ]);

        try {
            // Update visitor information
            $visitor->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->company,
            ]);

            // Find host user
            $hostUser = User::where('name', 'like', '%' . $request->host_name . '%')->first();
            if (is_null($hostUser)) {
                $hostUser = Auth::user();
            }

            // Update visit
            $oldStatus = $visit->status;
            $visit->update([
                'meeting_user_id' => $hostUser->id,
                'visit_type_id' => $request->visit_type_id,
                'purpose' => $request->purpose,
                'schedule_time' => $request->visit_date,
                'status' => $request->status ?? $oldStatus,
            ]);

            // Send status update notification if status changed
            if ($oldStatus !== $visit->status) {
                // Send email
                $emailData = [
                    'visitor_name' => $visitor->name,
                    'visitor_email' => $visitor->email,
                    'visitor_company' => $visitor->address,
                    'visit_date' => \Carbon\Carbon::parse($visit->schedule_time)->format('F j, Y - g:i A'),
                    'visit_type' => $visit->type->name ?? 'N/A',
                    'purpose' => $visit->purpose,
                    'host_name' => $hostUser->name,
                    'status' => $visit->status,
                ];

                $emailService = new EmailNotificationService();
                $emailService->sendVisitStatusEmail($emailData);

                // Send SMS if phone exists
                if (!empty($visitor->phone)) {
                    $statusMessages = [
                        'approved' => 'Your visit has been approved.',
                        'completed' => 'Your visit has been completed.',
                        'cancelled' => 'Your visit has been cancelled.',
                        'pending' => 'Your visit is pending approval.',
                    ];

                    $statusMessage = $statusMessages[$visit->status] ?? "Your visit status is: " . ucfirst($visit->status);
                    $smsMessage = "Dear {$visitor->name}, {$statusMessage} Thank you!";

                    $phone = preg_replace('/[^0-9]/', '', $visitor->phone);
                    if (strpos($phone, '880') !== 0) {
                        $phone = '88' . $phone;
                    }

                    $smsService = new SmsNotificationService();
                    $smsService->send($phone, $smsMessage);
                }
            }

            return redirect()->route('visitor.index')
                ->with('success', 'Visitor updated successfully!');

        } catch (\Exception $e) {
            Log::error('Error updating visitor', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Failed to update visitor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified visitor
     */
    public function destroy($id)
    {
        try {
            $visit = Visit::findOrFail($id);
            $visit->delete();

            return response()->json([
                'success' => true,
                'message' => 'Visit deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting visitor', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete visit: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Auto-fill visitor details from previous visits
     */
    public function autofill(Request $request)
    {
        $email = $request->get('email');
        $phone = $request->get('phone');

        $visitor = null;

        if (!empty($email)) {
            $visitor = Visitor::where('email', $email)->first();
        } elseif (!empty($phone)) {
            $visitor = Visitor::where('phone', $phone)->first();
        }

        if (!is_null($visitor)) {
            // Get latest visit for this visitor
            $latestVisit = $visitor->visits()->latest()->first();

            return response()->json([
                'success' => true,
                'visitor' => [
                    'name' => $visitor->name,
                    'email' => $visitor->email,
                    'phone' => $visitor->phone,
                    'company' => $visitor->address,
                ],
                'latest_visit' => $latestVisit ? [
                    'visit_type_id' => $latestVisit->visit_type_id,
                    'purpose' => $latestVisit->purpose,
                    'host_name' => $latestVisit->meetingUser->name ?? '',
                ] : null,
            ]);
        }

        return response()->json(['success' => false]);
    }

    /**
     * Search for host
     */
    public function searchHost(Request $request)
    {
        $query = $request->get('q');
        $users = User::where('name', 'like', '%' . $query . '%')
                    ->where('status', 'active')
                    ->limit(10)
                    ->get(['id', 'name']);

        return response()->json($users);
    }

    /**
     * Get visitor statistics
     */
    public function statistics()
    {
        $stats = [
            'total_visitors' => Visitor::count(),
            'total_visits' => Visit::count(),
            'pending_visits' => Visit::where('status', 'pending')->count(),
            'approved_visits' => Visit::where('status', 'approved')->count(),
            'completed_visits' => Visit::where('status', 'completed')->count(),
            'cancelled_visits' => Visit::where('status', 'cancelled')->count(),
            'visits_this_month' => Visit::whereMonth('schedule_time', now()->month)
                                         ->whereYear('schedule_time', now()->year)
                                         ->count(),
        ];

        return view('vms.backend.visitor.statistics', compact('stats'));
    }
}
