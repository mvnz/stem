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

    public function handleNewReading(TrashReading $reading): void
    {
        

        Log::info('TrashWhatsappNotifier DIPANGGIL', [
            'reading_id' => $reading->id,
            'device_id'  => $reading->device_id,
            'fill_pct'   => $reading->fill_pct,
            'created_at' => $reading->created_at,
        ]);

        // Klo mau threshold balik lagi, tinggal un-comment
         //if ($reading->fill_pct < 80) {
         //    return;
         //}

        $waktu   = $reading->created_at->timezone(config('app.timezone'));
        $tanggal = $waktu->toDateString();
        $shift   = $this->tentukanShift($waktu);

        // CARI PEGAWAI YG LAGI PIKET
        $pegawaiOnDuty = Pegawai::whereHas('jadwalPikets', function ($q) use ($tanggal, $shift) {
                $q->whereDate('tanggal', $tanggal)
                  ->where('shift', $shift);
            })
            ->whereNotNull('no_telp')
            ->get();

        Log::info('Pegawai piket yang ketemu', [
            'tanggal' => $tanggal,
            'shift'   => $shift,
            'jumlah'  => $pegawaiOnDuty->count(),
        ]);

        if ($pegawaiOnDuty->isEmpty()) {
            Log::warning('Tidak ada pegawai piket utk tanggal+shift ini', [
                'tanggal' => $tanggal,
                'shift'   => $shift,
            ]);
            return;
        }

        // SUSUN PESAN
        $message = sprintf(
            "⚠️ [STEM Notifikasi] Tempat sampah *%s* hampir penuh, sisa %.1f%% (ketinggian sampah sudah: %.1f cm) pada %s.",
            $reading->device_id,
            $reading->fill_pct,
            $reading->distance_cm,
            $waktu->format('Y-m-d H:i:s')
        );

       // bikin record notif_whatsapps + kirim WA
        foreach ($pegawaiOnDuty as $pegawai) {
            try {
                $notif = $this->fonnte->send($pegawai->no_telp, $message);

                Log::info('WA notifikasi terkirim / tercatat', [
                    'pegawai_id' => $pegawai->id,
                    'no_telp'    => $pegawai->no_telp,
                    'notif_id'   => $notif->id,
                    'status'     => $notif->status,
                ]);
            } catch (\Throwable $e) {
                Log::error('Gagal kirim WA ke pegawai piket', [
                    'pegawai_id' => $pegawai->id,
                    'no_telp'    => $pegawai->no_telp,
                    'error'      => $e->getMessage(),
                ]);
            }
        }
    }

    protected function tentukanShift($waktu): string
    {
        $seconds = $waktu->secondsSinceMidnight();

        $pagiStart  = 1;
        $pagiEnd    = 8 * 3600;

        $siangStart = (8 * 3600) + 1;
        $siangEnd   = 16 * 3600;

        $malamStart = (16 * 3600) + 1;
        $malamEnd   = 24 * 3600;

        if ($seconds >= $pagiStart && $seconds <= $pagiEnd) {
            return 'Pagi';
        }

        if ($seconds >= $siangStart && $seconds <= $siangEnd) {
            return 'Siang';
        }

        return 'Malam';
    }
}
