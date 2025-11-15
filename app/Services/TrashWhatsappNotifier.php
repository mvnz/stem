<?php

namespace App\Services;

use App\Models\TrashReading;
use App\Models\Pegawai;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Log;

class TrashWhatsappNotifier
{
    public function __construct(
        protected FonnteService $fonnte
    ) {}

    /**
     * Dipanggil otomatis setiap ada record baru di trash_readings.
     */
    public function handleNewReading(TrashReading $reading): void
    {
        // 1. Threshold biar nggak spam (silakan ubah/ilangin kalau nggak perlu)
        if ($reading->fill_pct < 80) {
            return;
        }

        // 2. Pakai jam server (APP_TIMEZONE) dari created_at
        $waktu   = $reading->created_at->timezone(config('app.timezone'));
        $tanggal = $waktu->toDateString();
        $shift   = $this->tentukanShift($waktu);

        Log::info('Notif trash_reading baru', [
            'reading_id' => $reading->id,
            'waktu'      => $waktu->format('Y-m-d H:i:s'),
            'shift'      => $shift,
        ]);

        // 3. Cari pegawai yang piket di HARI itu + SHIFT itu
        $pegawaiOnDuty = Pegawai::whereHas('jadwalPiket', function ($q) use ($tanggal, $shift) {
                $q->whereDate('tanggal', $tanggal)
                  ->where('shift', $shift);
            })
            ->whereNotNull('no_hp')
            ->get();

        if ($pegawaiOnDuty->isEmpty()) {
            Log::warning('Tidak ada pegawai piket utk tanggal+shift ini', [
                'tanggal' => $tanggal,
                'shift'   => $shift,
            ]);
            return;
        }

        // 4. Susun pesan WA
        $message = sprintf(
            "Peringatan Smart Waste\n\n".
            "Bin: %s\nTingkat kepenuhan: %.1f%%\nDistance: %.1f cm\n".
            "Waktu: %s (shift %s)\n\nMohon segera dicek dan dikosongkan.",
            $reading->device_id ?? 'UNKNOWN',
            $reading->fill_pct,
            $reading->distance_cm,
            $waktu->format('Y-m-d H:i'),
            ucfirst(strtolower($shift))
        );

        // 5. Kirim WA ke semua pegawai yang lagi piket shift ini
        foreach ($pegawaiOnDuty as $pegawai) {
            try {
                $this->fonnte->send($pegawai->no_hp, $message);
            } catch (\Throwable $e) {
                Log::error('Gagal kirim WA ke pegawai piket', [
                    'pegawai_id' => $pegawai->id,
                    'no_hp'      => $pegawai->no_hp,
                    'error'      => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Tentukan shift dari jam server:
     * 00:01:00 – 08:00:00  -> Pagi
     * 08:01:00 – 16:00:00  -> Siang
     * 16:01:00 – 00:00:00  -> Malam
     */
    protected function tentukanShift($waktu): string
    {
        $seconds = $waktu->secondsSinceMidnight(); // Carbon

        $pagiStart  = 1;                // 00:00:01
        $pagiEnd    = 8 * 3600;         // 08:00:00

        $siangStart = (8 * 3600) + 1;   // 08:00:01
        $siangEnd   = 16 * 3600;        // 16:00:00

        $malamStart = (16 * 3600) + 1;  // 16:00:01
        $malamEnd   = 24 * 3600;        // 24:00:00 (00:00 esoknya)

        if ($seconds >= $pagiStart && $seconds <= $pagiEnd) {
            return 'Pagi';
        }

        if ($seconds >= $siangStart && $seconds <= $siangEnd) {
            return 'Siang';
        }

        // termasuk 00:00:00 gw anggap Malam
        return 'Malam';
    }
}

\App\Models\TrashReading::create([
    'device_id'     => 'bin-01',
    'bin_height_cm' => 80,
    'distance_cm'   => 5,
    'fill_pct'      => 90, // >= 80
]);
