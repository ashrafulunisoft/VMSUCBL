<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\NotificationHelper;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Visit;
use App\Models\VisitType;
use App\Notifications\VisitorRegistered;
use App\Services\EmailNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function dashboard(){
        return view('vms.backend.admin.admin_dashboard');
    }

    public function createRole(){
        return view('vms.backend.admin.Addrole');
    }

    public function storeRole(Request $request){
        $request->validate([
            'role_name' => 'required|string|unique:roles,name|max:255',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive,restricted',
        ]);

        $role = Role::create([
            'name' => $request->role_name,
        ]);

        // If permissions are selected, sync them to the role
        if ($request->has('permissions')) {
            $permissions = [];

            if (in_array('dashboard', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'view dashboard']);
            }
            if (in_array('users', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'manage users']);
            }
            if (in_array('roles', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'manage roles']);
            }
            if (in_array('reports', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'view reports']);
            }
            if (in_array('audit', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'view audit logs']);
            }
            if (in_array('settings', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'manage settings']);
            }

            $role->syncPermissions($permissions);
        }

        return redirect()->route('admin.role.create')
            ->with('success', 'Role "' . $request->role_name . '" created successfully!');
    }

    public function createAssignRole(){
        $users = User::all();
        $roles = Role::all();
        return view('vms.backend.admin.Assignrole', compact('users', 'roles'));
    }

    public function storeAssignRole(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
            'effective_date' => 'nullable|date',
            'status' => 'required|in:active,pending,restricted',
            'remarks' => 'nullable|string|max:500',
        ]);

        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);

        // Remove existing roles and assign new one
        $user->syncRoles([$role->id]);

        // Log the assignment (optional - you might want to create a role_assignments table)
        // For now, we'll just return success

        return redirect()->route('admin.role.assign.create')
            ->with('success', 'Role "' . $role->name . '" assigned to ' . $user->name . ' successfully!');
    }

    public function removeUserRole(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $roles = $user->getRoleNames();
        $user->removeRole($roles->first());

        return redirect()->route('admin.role.assign.create')
            ->with('success', 'Role removed from ' . $user->name . ' successfully!');
    }

    public function createVisitorRegistration(){
        $users = User::all();
        $visitTypes = VisitType::all();
        return view('vms.backend.admin.VisitorRegistration', compact('users', 'visitTypes'));
    }

    public function storeVisitorRegistration(Request $request){
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

        // Log the start of visitor registration process
        Log::info('Starting visitor registration process', [
            'admin_name' => Auth::user()->name ?? 'System',
            'admin_email' => Auth::user()->email ?? 'N/A',
            'visitor_name' => $request->name,
            'visitor_email' => $request->email,
            'visit_date' => $request->visit_date,
            'ip_address' => $request->ip(),
            'timestamp' => now()->toDateTimeString()
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

            Log::info('Visitor record created/retrieved', [
                'visitor_id' => $visitor->id,
                'visitor_name' => $visitor->name,
                'visitor_email' => $visitor->email,
                'is_new_visitor' => $visitor->wasRecentlyCreated ?? false
            ]);

            // Find or create host user by name
            $hostUser = User::where('name', 'like', '%' . $request->host_name . '%')->first();

            if (!$hostUser) {
                // If host doesn't exist, use current admin as default host
                $hostUser = Auth::user();
                Log::warning('Host not found, using current admin as default host', [
                    'requested_host' => $request->host_name,
                    'default_host' => $hostUser->name,
                    'default_host_id' => $hostUser->id
                ]);
            }

            // Create visit record
            $visit = Visit::create([
                'visitor_id' => $visitor->id,
                'meeting_user_id' => $hostUser->id,
                'visit_type_id' => $request->visit_type_id,
                'purpose' => $request->purpose,
                'schedule_time' => $request->visit_date,
                'status' => 'approved', // Auto-approve when created by admin
                'approved_at' => now(),
            ]);

            Log::info('Visit record created successfully', [
                'visit_id' => $visit->id,
                'visitor_id' => $visit->visitor_id,
                'host_id' => $visit->meeting_user_id,
                'visit_type_id' => $visit->visit_type_id,
                'schedule_time' => $visit->schedule_time,
                'status' => $visit->status,
                'approved_at' => $visit->approved_at
            ]);

            // Prepare email data
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

            // Use EmailNotificationService to send email
            $emailService = new EmailNotificationService();
            $emailSent = $emailService->sendVisitorRegistrationEmail($emailData);

            if ($emailSent) {
                Log::info('Visitor registration email sent successfully', [
                    'visit_id' => $visit->id,
                    'visitor_email' => $visitor->email,
                    'sent_at' => now()->toDateTimeString()
                ]);
            } else {
                Log::error('Failed to send visitor registration email', [
                    'visit_id' => $visit->id,
                    'visitor_email' => $visitor->email
                ]);
            }

            // Send SMS notification if phone number exists
            if ($visitor->phone && config('sms.enabled')) {
                $visitDate = \Carbon\Carbon::parse($visit->schedule_time)->format('M j, Y g:i A');
                $smsMessage = "UCB Bank: Visit confirmed on {$visitDate}. "
                              . "Status: " . ucfirst($visit->status) . ". "
                              . "Arrive 10 mins early. Questions? Contact us.";

                $smsSent = NotificationHelper::sendSms($visitor->phone, $smsMessage);

                if ($smsSent) {
                    Log::info('SMS notification sent successfully', [
                        'visit_id' => $visit->id,
                        'visitor_phone' => $visitor->phone,
                        'sent_at' => now()->toDateTimeString()
                    ]);
                } else {
                    Log::error('Failed to send SMS notification', [
                        'visit_id' => $visit->id,
                        'visitor_phone' => $visitor->phone
                    ]);
                }
            }

            // Log successful completion of visitor registration
            Log::info('Visitor registration completed successfully', [
                'visitor_id' => $visitor->id,
                'visit_id' => $visit->id,
                'visitor_name' => $visitor->name,
                'visitor_email' => $visitor->email,
                'visit_date' => $visit->schedule_time,
                'host_name' => $hostUser->name,
                'status' => $visit->status,
                'email_sent' => $emailSent,
                'sms_sent' => ($visitor->phone && config('sms.enabled')) ? 'attempted' : 'skipped',
                'registered_by' => Auth::user()->name ?? 'System',
                'completed_at' => now()->toDateTimeString()
            ]);

            return redirect()->route('admin.visitor.registration.create')
                ->with('success', 'Visitor ' . $visitor->name . ' registered successfully!')
                ->withInput();

        } catch (\Exception $e) {
            // Log error during visitor registration
            Log::error('Error during visitor registration', [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'visitor_name' => $request->name ?? 'N/A',
                'visitor_email' => $request->email ?? 'N/A',
                'trace' => $e->getTraceAsString(),
                'occurred_at' => now()->toDateTimeString()
            ]);

            return back()->with('error', 'Failed to register visitor: ' . $e->getMessage())->withInput();
        }
    }

    public function searchHost(Request $request)
    {
        $query = $request->get('q');
        $users = User::where('name', 'like', '%' . $query . '%')
                    ->limit(10)
                    ->get(['id', 'name']);

        return response()->json($users);
    }

    public function checkVisitor(Request $request)
    {
        $email = $request->get('email');
        $visitor = Visitor::where('email', $email)->first();

        if ($visitor) {
            return response()->json([
                'success' => true,
                'visitor' => [
                    'name' => $visitor->name,
                    'email' => $visitor->email,
                    'phone' => $visitor->phone,
                    'company' => $visitor->address,
                ]
            ]);
        }

        return response()->json(['success' => false]);
    }

    public function checkVisitorByPhone(Request $request)
    {
        $phone = $request->get('phone');
        $visitor = Visitor::where('phone', $phone)->first();

        if ($visitor) {
            return response()->json([
                'success' => true,
                'visitor' => [
                    'name' => $visitor->name,
                    'email' => $visitor->email,
                    'phone' => $visitor->phone,
                    'company' => $visitor->address,
                ]
            ]);
        }

        return response()->json(['success' => false]);
    }

    public function visitorList()
    {
        $visitors = Visit::with(['visitor', 'type', 'meetingUser'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

        return view('vms.backend.admin.visitor-list', compact('visitors'));
    }

    public function editVisitor($id)
    {
        $visit = Visit::with(['visitor', 'type', 'meetingUser'])->findOrFail($id);
        $users = User::all();
        $visitTypes = VisitType::all();

        return view('vms.backend.admin.edit-visitor', compact('visit', 'users', 'visitTypes'));
    }

    public function updateVisitor(Request $request, $id)
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
            'status' => 'required|in:approved,pending,completed,cancelled',
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
            if (!$hostUser) {
                $hostUser = Auth::user();
            }

            // Update visit
            $oldStatus = $visit->status;
            $visit->update([
                'meeting_user_id' => $hostUser->id,
                'visit_type_id' => $request->visit_type_id,
                'purpose' => $request->purpose,
                'schedule_time' => $request->visit_date,
                'status' => $request->status,
                'approved_at' => $request->status === 'approved' ? now() : $visit->approved_at,
            ]);

            // Log visit update
            Log::info('Visit details updated', [
                'visit_id' => $visit->id,
                'visitor_name' => $visitor->name,
                'old_status' => $oldStatus,
                'new_status' => $visit->status,
                'updated_by' => Auth::user()->name ?? 'System',
                'updated_at' => now()->toDateTimeString()
            ]);

            // Send status update email if status changed
            if ($oldStatus !== $visit->status) {
                $emailData = [
                    'visitor_name' => $visitor->name,
                    'visitor_email' => $visitor->email,
                    'visitor_company' => $visitor->address,
                    'visit_date' => \Carbon\Carbon::parse($visit->schedule_time)->format('F j, Y - g:i A'),
                    'visit_type' => $visit->type->name ?? 'N/A',
                    'purpose' => $visit->purpose,
                    'host_name' => $hostUser->name,
                    'status' => $visit->status,
                    'remarks' => $request->remarks ?? null,
                ];

                $emailService = new EmailNotificationService();
                $emailSent = $emailService->sendVisitStatusEmail($emailData);

                if ($emailSent) {
                    Log::info('Visit status email sent successfully', [
                        'visit_id' => $visit->id,
                        'visitor_email' => $visitor->email,
                        'status' => $visit->status,
                        'sent_at' => now()->toDateTimeString()
                    ]);
                } else {
                    Log::error('Failed to send visit status email', [
                        'visit_id' => $visit->id,
                        'visitor_email' => $visitor->email,
                        'status' => $visit->status
                    ]);
                }
            }

            // Check if request expects JSON (AJAX)
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Visit updated successfully!'
                ]);
            }

            return redirect()->route('admin.visitor.list')
                ->with('success', 'Visit updated successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }

            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteVisitor($id)
    {
        $visit = Visit::findOrFail($id);
        $visit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Visit deleted successfully!'
        ]);
    }
}
