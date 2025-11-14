<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tower;
use App\Models\TrashReading;
use App\Models\TempatSampah;
use App\Models\Insiden;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', now()->toDateString());

        
        $towers = Tower::with(['jadwalPiket' => function ($q) use ($tanggal) {
                $q->whereDate('tanggal', $tanggal)
                ->where('shift', '!=', 'Libur')
                ->with('pegawai')          
                ->orderBy('shift');
            }])
            ->orderBy('nama_tower')
            ->paginate(1);         

        $currentTower = $towers->first();    

        
        $jadwalPerShift = $currentTower
            ? $currentTower->jadwalPiket->groupBy('shift')
            : collect();

        // Controller
        $sampah = TrashReading::select('device_id', 'distance_cm')
            ->whereIn('id', function ($q) {
                $q->selectRaw('MAX(id)')
                ->from('trash_readings')
                ->groupBy('device_id');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $labels = $sampah->pluck('device_id')->toArray();    // <- penting: toArray()
        $values = $sampah->pluck('distance_cm')->toArray();  // <- penting: toArray()
        
        $values = array_map('floatval', $values);

        //dd($sampah->pluck('distance_cm'));

        $jmlTempatSampah = TempatSampah::where('status', 'Active')->count();

        $jmlInsidenOpen = Insiden::where('status_insiden', 'Open')->count();

        return view('dashboard.index', compact('tanggal', 'towers', 'currentTower', 'jadwalPerShift', 'labels', 'values', 'jmlTempatSampah', 'jmlInsidenOpen'));
    }

    public function trashData()
    {
        // contoh: ambil data terakhir per bin
        $latest = TrashReading::select('device_id', 'distance_cm', 'created_at')
            ->orderBy('device_id')
            ->orderByDesc('created_at')
            ->get()
            ->unique('device_id')   // ambil yang terakhir per device
            ->values();

        return response()->json([
            'labels' => $latest->pluck('device_id'),
            'values' => $latest->pluck('distance_cm'),
        ]);
    }
    
}