<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Tower;
use App\Models\JadwalPiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class JadwalPiketController extends Controller
{
    public function index()
    {
        $jadwalPikets = JadwalPiket::with(['tower', 'pegawai'])
            ->orderBy('tanggal', 'asc')
            ->orderByRaw("FIELD(shift, 'Pagi', 'Siang', 'Malam', 'Libur')")
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('jadwalPikets.index', compact('jadwalPikets'));
    }

    public function create()
    {
        return view('jadwalPikets.create', [
            'towers' => Tower::orderBy('nama_tower')->get(),
        ]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'quota_per_shift' => 'required|integer|min:1',
            'towers' => 'nullable|array',
            'towers.*' => 'integer|exists:towers,id',
            'overwrite'  => 'nullable|boolean',
        ]);

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->startOfDay();
        $quota = (int) $request->quota_per_shift;
        $overwrite = (bool) $request->boolean('overwrite');

        $towers = $request->filled('towers')
            ? Tower::whereIn('id', $request->towers)->orderBy('id')->get()
            : Tower::orderBy('id')->get();

        $pegawais = Pegawai::where('status','Active')
            ->where('unit_kerja','Petugas Kebersihan')
            ->orderBy('id')
            ->get();

        if ($pegawais->isEmpty()) {
            return back()->with('error','Tidak ada petugas kebersihan aktif.');
        }

        if ($overwrite) {
            JadwalPiket::whereBetween('tanggal', [$start->toDateString(), $end->toDateString()])->delete();
        }

        $shifts = ['Pagi','Siang','Malam'];
        $total  = $pegawais->count();

        $globalPtr = 0;
        $created   = 0;

        DB::transaction(function() use ($start,$end,$towers,$pegawais,$shifts,$quota,$total,&$globalPtr,&$created) {

            $forceOffTomorrow = [];

            for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
                $tanggal = $d->toDateString();

                //insert yang libur habis shift malam
                $usedToday = [];               
                if (!empty($forceOffTomorrow)) {
                    foreach ($forceOffTomorrow as $pid) {
                        JadwalPiket::updateOrCreate(
                            [
                                'pegawai_id'=>$pid,
                                'tanggal'=>$tanggal,
                                'shift'=>'Libur',
                                'tower_id'=>null,
                                'jam_mulai'=>null,
                                'jam_selesai'=>null,
                            ]
                        );
                        $usedToday[$pid] = true;
                        $created++;
                    }
                }
                $forceOffTomorrow = [];        //yang besok libur disini

                $available = $pegawais->pluck('id')->diff(array_keys($usedToday))->values();

                //nyari tower satu2
                foreach ($towers as $tw) {

                    $need = [
                        'Pagi' => $quota,
                        'Siang' => $quota,
                        'Malam' => $quota,
                    ];

                    //cari orang yang available
                    while (array_sum($need) > 0 && $available->isNotEmpty()) {
                        foreach ($shifts as $s) {
                            if ($need[$s] <= 0) continue;
                            if ($available->isEmpty()) break;

                            $picked = null;
                            $tries  = 0;
                            while ($tries < $available->count()) {
                                $pidIdx = $globalPtr % $available->count();
                                $pid    = $available[$pidIdx];
                                $globalPtr++;
                                $tries++;

                                if (!isset($usedToday[$pid])) {
                                    $picked = $pid;
                                    $available = $available->reject(fn($x)=>$x===$pid)->values();
                                    break;
                                }
                            }
                            if (is_null($picked)) continue;

                            [$mulai,$selesai] = JadwalPiket::jamShift($s);
                            JadwalPiket::updateOrCreate(
                                ['pegawai_id'=>$picked,'tanggal'=>$tanggal],
                                [
                                    'shift' => $s,
                                    'tower_id' => $tw->id,
                                    'jam_mulai' => $mulai,
                                    'jam_selesai'=> $selesai,
                                ]
                            );
                            $usedToday[$picked] = true;
                            $need[$s]--;
                            $created++;

                            
                            if ($s === 'Malam') {
                                $forceOffTomorrow[] = $picked;
                            }
                        }
                    }
                    
                }

                //insert yang libur sama yangblm dapat jadwal piket
                foreach ($pegawais as $p) {
                    if (!isset($usedToday[$p->id])) {
                        JadwalPiket::updateOrCreate(
                            [
                                'pegawai_id'=>$p->id,
                                'tanggal'=>$tanggal,
                                'shift'=>'Libur',
                                'tower_id'=>null,
                                'jam_mulai'=>null,
                                'jam_selesai'=>null
                            ]
                        );
                        $created++;
                    }
                }
            }
        });

        return back()->with('success', "Jadwal berhasil dibuat. Total entri: {$created}");
    }

    public function edit($id){
        $jadwalPiket = JadwalPiket::findOrFail($id);
        $towers = Tower::all();

        return view('jadwalPikets.edit', compact('jadwalPiket', 'towers'));
    }

    public function update(Request $request, $id)
    {
        $jadwalPiket = JadwalPiket::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'shift' => 'required|in:Pagi,Siang,Malam,Libur',
            'tower_id' => [
                Rule::requiredIf(fn () => $request->shift !== 'Libur'),
                'nullable','exists:towers,id'
            ],
        ]);

        if ($validated['shift'] === 'Libur') {
            $validated['tower_id'] = null;
            $validated['jam_mulai'] = null;
            $validated['jam_selesai'] = null;
        } else {
            [$mulai,$selesai] = JadwalPiket::jamShift($validated['shift']);
            $validated['jam_mulai'] = $mulai;
            $validated['jam_selesai'] = $selesai;
        }

        $jadwalPiket->update($validated);

        return redirect()
            ->route('jadwalPiket.index')->with('success', 'Jadwal Piket berhasil diubah');
    }
   

}
