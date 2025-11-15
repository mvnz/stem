<?php

namespace App\Services;

use App\Models\NotifWhatsapp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    public function send(string $phone, string $message): NotifWhatsapp
    {
        $token = config('fonnte.token');
        $url   = config('fonnte.url', 'https://api.fonnte.com/send');

        $payload = [
            'target'  => $phone,
            'message' => $message,
        ];

        $response = Http::withoutVerifying()      // << BYPASS SSL (DEV ONLY)
            ->withHeaders([
                'Authorization' => $token,
            ])
            ->asForm()
            ->post($url, $payload);

        $body = $response->json();
        Log::info('Fonnte response', ['body' => $body, 'http' => $response->status()]);

        if ($response->successful() && ($body['status'] ?? false)) {
            $status = 'success';
        } else {
            $status = 'failed';
        }

        return NotifWhatsapp::create([
            'no_hp'    => $phone,
            'pesan'    => $message,
            'status'   => $status,
            'response' => $body,
            'sent_at'  => now(),
        ]);
    }
}
