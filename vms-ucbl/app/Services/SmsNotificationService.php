<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsNotificationService
{
    protected $enabled;
    protected $provider;
    protected $from;
    protected $apiKey;
    protected $apiSecret;
    protected $senderId;

    public function __construct()
    {
        $this->enabled = config('sms.enabled', false);
        $this->provider = config('sms.provider', 'nexmo');
        $this->from = config('sms.from', 'UCB Bank');
        $this->apiKey = config('sms.api_key');
        $this->apiSecret = config('sms.api_secret');
        $this->senderId = config('sms.sender_id');
    }

    /**
     * Send SMS message
     *
     * @param string $to Recipient phone number
     * @param string $message Message content
     * @return array
     */
    public function send(string $to, string $message): array
    {
        if (!$this->enabled) {
            return [
                'success' => false,
                'message' => 'SMS is disabled'
            ];
        }

        // Clean phone number
        $to = $this->cleanPhoneNumber($to);

        if (empty($to)) {
            return [
                'success' => false,
                'message' => 'Invalid phone number'
            ];
        }

        try {
            switch ($this->provider) {
                case 'nexmo':
                    return $this->sendViaNexmo($to, $message);
                case 'twilio':
                    return $this->sendViaTwilio($to, $message);
                case 'bulk':
                    return $this->sendViaBulk($to, $message);
                case 'default':
                default:
                    return $this->sendViaDefault($to, $message);
            }
        } catch (\Exception $e) {
            Log::error('SMS Error: ' . $e->getMessage(), [
                'provider' => $this->provider,
                'to' => $to,
                'message' => $message
            ]);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Send via Nexmo (Vonage)
     */
    protected function sendViaNexmo(string $to, string $message): array
    {
        if (!$this->apiKey || !$this->apiSecret) {
            return [
                'success' => false,
                'message' => 'Nexmo API credentials not configured'
            ];
        }

        $response = Http::asForm()->post('https://rest.nexmo.com/sms/json', [
            'api_key' => $this->apiKey,
            'api_secret' => $this->apiSecret,
            'from' => $this->from,
            'to' => $to,
            'text' => $message,
        ]);

        $data = $response->json();

        if ($response->successful() && isset($data['messages'][0]['status']) && $data['messages'][0]['status'] == '0') {
            return [
                'success' => true,
                'message' => 'SMS sent successfully via Nexmo',
                'message_id' => $data['messages'][0]['message-id'] ?? null
            ];
        }

        return [
            'success' => false,
            'message' => $data['messages'][0]['error-text'] ?? 'Unknown error'
        ];
    }

    /**
     * Send via Twilio
     */
    protected function sendViaTwilio(string $to, string $message): array
    {
        if (!$this->apiKey || !$this->apiSecret) {
            return [
                'success' => false,
                'message' => 'Twilio API credentials not configured'
            ];
        }

        $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->asForm()
            ->post("https://api.twilio.com/2010-04-01/Accounts/{$this->apiKey}/Messages.json", [
                'From' => $this->from,
                'To' => $to,
                'Body' => $message,
            ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => 'SMS sent successfully via Twilio',
                'message_id' => $response->json('sid')
            ];
        }

        return [
            'success' => false,
            'message' => $response->json('message') ?? 'Unknown error'
        ];
    }

    /**
     * Send via BulkSMS (Bangladesh)
     */
    protected function sendViaBulk(string $to, string $message): array
    {
        if (!$this->apiKey || !$this->senderId) {
            return [
                'success' => false,
                'message' => 'BulkSMS credentials not configured'
            ];
        }

        $response = Http::get('https://bulksmsbd.net/api/smsapi', [
            'api_key' => $this->apiKey,
            'senderid' => $this->senderId,
            'number' => $to,
            'message' => $message,
        ]);

        if ($response->successful() && strpos($response->body(), 'SUCCESS') !== false) {
            return [
                'success' => true,
                'message' => 'SMS sent successfully via BulkSMS'
            ];
        }

        return [
            'success' => false,
            'message' => $response->body() ?? 'Unknown error'
        ];
    }

    /**
     * Default SMS sending (log only for development)
     */
    protected function sendViaDefault(string $to, string $message): array
    {
        // For development, just log the SMS
        Log::info('SMS (Logged):', [
            'to' => $to,
            'from' => $this->from,
            'message' => $message
        ]);

        return [
            'success' => true,
            'message' => 'SMS logged (development mode)'
        ];
    }

    /**
     * Clean and format phone number
     */
    protected function cleanPhoneNumber(string $phone): string
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Add country code if missing (default: Bangladesh +880)
        if (strlen($phone) === 11 && strpos($phone, '01') === 0) {
            $phone = '88' . $phone;
        }

        return $phone;
    }
}
