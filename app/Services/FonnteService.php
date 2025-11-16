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

        Log::info('Fonnte request', [
            'url'     => $url,
            'target'  => $phone,
            'message' => $message,
        ]);

        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => $token,
            ])
            ->asForm()
            ->post($url, $payload);

        $body = $response->json();
        Log::info('Fonnte response', ['body' => $body, 'http' => $response->status()]);

        $status = ($response->successful() && ($body['status'] ?? false))
            ? 'success'
            : 'failed';

        try {
            $notif = NotifWhatsapp::create([
                'no_telp'  => $phone,
                'pesan'    => $message,
                'status'   => $status,
                'response' => $body,
                'sent_at'  => now(),
            ]);

            Log::info('NotifWhatsapp tersimpan', [
                'notif_id' => $notif->id,
                'status'   => $notif->status,
            ]);

            return $notif;
        } catch (\Throwable $e) {
            Log::error('Gagal insert ke notif_whatsapps', [
                'error' => $e->getMessage(),
            ]);
            throw $e; // biar tetep ketangkep di TrashWhatsappNotifier
        }
    }
}
