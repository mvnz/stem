<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tower;
use App\Models\TrashReading;
use App\Models\TempatSampah;
use App\Models\Insiden;

use Illuminate\Support\Facades\Http;



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

        //settingan thingspeak
        $url = "https://api.thingspeak.com/channels/" . env('THINGSPEAK_CHANNEL_ID') . "/fields/1.json";
        
        $response = Http::withoutVerifying()->get($url, [
            'api_key' => env('THINGSPEAK_API_KEY'),
            'results' => 2,
        ]);

        if (! $response->successful()) {
            // bisa log atau kasih fallback
            abort(500, 'Gagal ambil data dari ThingSpeak');
        }

        $data = $response->json();   // ini array PHP

        // biasanya struktur ThingSpeak: channel, feeds[]
        $feeds = $data['feeds'] ?? [];

        // contoh ambil 1 data terakhir
        $lastFeed = !empty($feeds) ? end($feeds) : null;

        // misal field1 = nilai sensor
        $organik = $lastFeed['field1'] ?? null;
        $anorganik = $lastFeed['field2'] ?? null;
        $residu = $lastFeed['field3'] ?? null;

        return view('dashboard.index', compact('tanggal', 'towers', 'currentTower', 'jadwalPerShift', 'labels', 'values', 'jmlTempatSampah', 'jmlInsidenOpen',
    'feeds', 'organik', 'anorganik', 'residu'));
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

    public function hitungTotal()
    {
        $baseUrl = "https://api.thingspeak.com/channels/3165781/fields";
        $apiKey  = "BEFGTPZ57LAPPU16";

        $total = 0;

        // ambil field 1, 2, 3
        for ($i = 1; $i <= 3; $i++) {
            $response = Http::withoutVerifying()->get("$baseUrl/$i.json", [
                'api_key' => $apiKey,
                'results' => 1000
            ]);

            if (!$response->successful()) continue;

            $feeds = $response->json()['feeds'] ?? [];

            // hitung yg nilainya "1"
            $jumlah = collect($feeds)
                        ->where("field$i", "1")
                        ->count();

            $total += $jumlah;
        }

        return response()->json([
            'total' => $total
        ]);
    }

    public function hitungPerField()
    {
        $baseUrl = "https://api.thingspeak.com/channels/3165781/fields";
        $apiKey  = "BEFGTPZ57LAPPU16";

        $result = [];

        for ($i = 1; $i <= 3; $i++) {
            $response = Http::withoutVerifying()->get("$baseUrl/$i.json", [
                'api_key' => $apiKey,
                'results' => 1000
            ]);

            if ($response->failed()) {
                $result["field$i"] = 0;
                continue;
            }

            $feeds = $response->json()['feeds'] ?? [];

            $count = collect($feeds)
                        ->where("field$i", "1")
                        ->count();

            $result["field$i"] = $count;
        }

        return response()->json($result);
    }

    public function sumFields()
    {
        $apiKey  = "BEFGTPZ57LAPPU16";
        $baseUrl = "https://api.thingspeak.com/channels/3165781/fields";

        $result = [];

        for ($i = 1; $i <= 3; $i++) {

            $response = Http::withoutVerifying()->get("$baseUrl/$i.json", [
                'api_key' => $apiKey,
                'results' => 100
            ]);

            $feeds = $response->json()['feeds'] ?? [];

            // ambil isi field trs convert integer trs buang 0 itung sum
            $jumlah = collect($feeds)
                ->map(fn($row) => (int) ($row["field$i"] ?? 0))
                ->filter(fn($val) => $val > 0)
                ->sum();

            $result["field$i"] = $jumlah;
        }

        return response()->json($result);
    }

}