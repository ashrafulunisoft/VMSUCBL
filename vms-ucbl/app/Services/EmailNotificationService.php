<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EmailNotificationService
{
    /**
     * Send visitor registration confirmation email
     *
     * @param array $data
     * @return bool
     */
    public function sendVisitorRegistrationEmail(array $data): bool
    {
        try {
            Log::info('Preparing to send visitor registration email', [
                'visitor_email' => $data['visitor_email'] ?? 'N/A',
                'visitor_name' => $data['visitor_name'] ?? 'N/A',
                'visit_date' => $data['visit_date'] ?? 'N/A',
                'sent_by' => Auth::user()->name ?? 'System'
            ]);

            Mail::to($data['visitor_email'])->send(new \App\Mail\VisitorRegistrationEmail($data));

            Log::info('Visitor registration email sent successfully', [
                'visitor_email' => $data['visitor_email'],
                'visit_date' => $data['visit_date']
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send visitor registration email', [
                'error' => $e->getMessage(),
                'visitor_email' => $data['visitor_email'] ?? 'N/A',
                'trace' => $e->getTraceAsString()
            ]);

            return false;
        }
    }

    /**
     * Send visit status update email
     *
     * @param array $data
     * @return bool
     */
    public function sendVisitStatusEmail(array $data): bool
    {
        try {
            Log::info('Preparing to send visit status email', [
                'visitor_email' => $data['visitor_email'] ?? 'N/A',
                'status' => $data['status'] ?? 'N/A',
                'sent_by' => Auth::user()->name ?? 'System'
            ]);

            Mail::to($data['visitor_email'])->send(new \App\Mail\VisitStatusEmail($data));

            Log::info('Visit status email sent successfully', [
                'visitor_email' => $data['visitor_email'],
                'status' => $data['status']
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send visit status email', [
                'error' => $e->getMessage(),
                'visitor_email' => $data['visitor_email'] ?? 'N/A',
                'trace' => $e->getTraceAsString()
            ]);

            return false;
        }
    }

    /**
     * Send custom email notification
     *
     * @param string $recipient
     * @param string $subject
     * @param string $view
     * @param array $data
     * @return bool
     */
    public function sendCustomEmail(string $recipient, string $subject, string $view, array $data = []): bool
    {
        try {
            Log::info('Preparing to send custom email', [
                'recipient' => $recipient,
                'subject' => $subject,
                'sent_by' => Auth::user()->name ?? 'System'
            ]);

            Mail::send($view, $data, function ($message) use ($recipient, $subject) {
                $message->to($recipient)
                    ->subject($subject);
            });

            Log::info('Custom email sent successfully', [
                'recipient' => $recipient,
                'subject' => $subject
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send custom email', [
                'error' => $e->getMessage(),
                'recipient' => $recipient,
                'subject' => $subject,
                'trace' => $e->getTraceAsString()
            ]);

            return false;
        }
    }

    /**
     * Send bulk email notifications
     *
     * @param array $recipients
     * @param string $subject
     * @param string $view
     * @param array $data
     * @return array ['success' => int, 'failed' => int]
     */
    public function sendBulkEmail(array $recipients, string $subject, string $view, array $data = []): array
    {
        $successCount = 0;
        $failedCount = 0;

        Log::info('Preparing to send bulk email', [
            'recipient_count' => count($recipients),
            'subject' => $subject,
            'sent_by' => Auth::user()->name ?? 'System'
        ]);

        foreach ($recipients as $recipient) {
            try {
                Mail::send($view, $data, function ($message) use ($recipient, $subject) {
                    $message->to($recipient)
                        ->subject($subject);
                });
                $successCount++;
            } catch (\Exception $e) {
                $failedCount++;
                Log::error('Failed to send email to recipient', [
                    'error' => $e->getMessage(),
                    'recipient' => $recipient,
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        Log::info('Bulk email sending completed', [
            'success_count' => $successCount,
            'failed_count' => $failedCount,
            'total' => count($recipients)
        ]);

        return [
            'success' => $successCount,
            'failed' => $failedCount
        ];
    }
}
