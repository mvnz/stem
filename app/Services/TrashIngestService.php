<?php

namespace App\Services;

use App\Models\TrashReading;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TrashBinThresholdExceeded;
use Carbon\Carbon;

class TrashIngestService
{
    public function ingest(array $data): void
    {
        $binHeight = (float)($data['bin_height_cm'] ?? 80);
        $dist      = (float)($data['distance_cm'] ?? 999);
        $tsMs      = (int)($data['timestamp'] ?? 0); //(int)($data['timestamp'] ?? (microtime(true)*1000));
        $fillPct   = max(0, min(100, 100 * (1 - min(max($dist,0.0), $binHeight) / $binHeight)));

        $measuredAt = now();
        if ($tsMs > 1_000_000_000_000) {           // epoch dalam milidetik
            $measuredAt = Carbon::createFromTimestampMs($tsMs);
        } elseif ($tsMs > 1_000_000_000) {          // epoch dalam detik
            $measuredAt = Carbon::createFromTimestamp($tsMs);
        }

        $reading = TrashReading::create([
            'device_id'     => $data['deviceId'] ?? 'unknown',
            'bin_height_cm' => $binHeight,
            'distance_cm'   => $dist,
            'fill_pct'      => round($fillPct, 2),
            'payload'       => $data,
            'measured_at'   => $measuredAt, //now()->createFromTimestampMs($tsMs),
        ]);

        $threshold = (float)config('trash.threshold_pct', 80);
        if ($reading->fill_pct >= $threshold) {
            // ganti route mail/telegram/sms sesuai kebutuhan lu
            Notification::route('mail', config('trash.alert_email', 'ops@example.com'))
                ->notify(new TrashBinThresholdExceeded($reading, $threshold));
        }
    }
}
