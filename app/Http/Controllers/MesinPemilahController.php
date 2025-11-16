<?php

namespace App\Http\Controllers;
use App\Models\MesinPemilah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MesinPemilahController extends Controller
{
    public function index()
    {
        $mesinPemilahs = MesinPemilah::all();

        $channelUrl = "https://api.thingspeak.com/channels/3165781.json";

        $response = Http::withoutVerifying()->get($channelUrl, [
            'api_key' => 'BEFGTPZ57LAPPU16'
        ]);

        $channelData = $response->json();

        // Ambil yang dibutuhkan
        $id = $channelData['id'] ?? '-';
        $channelName = $channelData['name'] ?? 'Tidak ada nama';
        $description = $channelData['description'] ?? '-';
        $lastEntryId = $channelData['last_entry_id'] ?? '-';

        $fieldUrl = "https://api.thingspeak.com/channels/3165781/fields/";
        $apikey = "BEFGTPZ57LAPPU16";

        $field1 = Http::withoutVerifying()->get($fieldUrl . "1.json", ['api_key' => $apikey])->json();
        $field2 = Http::withoutVerifying()->get($fieldUrl . "2.json", ['api_key' => $apikey])->json();
        $field3 = Http::withoutVerifying()->get($fieldUrl . "3.json", ['api_key' => $apikey])->json();

        $field1Name = $field1['channel']['field1'] ?? '-';
        $field2Name = $field2['channel']['field2'] ?? '-';
        $field3Name = $field3['channel']['field3'] ?? '-';

        return view('mesinPemilahs.index', [
            'mesinPemilahs' => $mesinPemilahs,
            'id' => $id,
            'channelName' => $channelName,
            'description' => $description,
            'field1Name' => $field1Name,
            'field2Name' => $field2Name,
            'field3Name' => $field3Name,
            'lastEntryId' => $lastEntryId,
        ]);
    }

    public function create()
    {
        return view('mesinPemilahs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mesin' => 'required|string|max:100',
            'konfigurasi' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        MesinPemilah::create($validated);

        return redirect()->route('mesinPemilah.index')->with('success', 'Mesin Pemilah berhasil ditambahkan');
    }

    public function edit($id){
        $mesinPemilah = MesinPemilah::findOrFail($id);

        return view('mesinPemilahs.edit', compact('mesinPemilah'));
    }

    public function update(Request $request, $id)
    {
        $mesinPemilah = MesinPemilah::findOrFail($id);

        $validated = $request->validate([
            'nama_mesin' => 'required|string|max:100',
            'konfigurasi' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $mesinPemilah->update($validated);

        return redirect()->route('mesinPemilah.index')->with('success', 'Mesin Pemilah berhasil diubah');
    }

    public function destroy($id)
    {
        $mesinPemilah = MesinPemilah::findOrFail($id);
        $mesinPemilah->delete();

        return redirect()->route('mesinPemilah.index')->with('success', 'Mesin Pemilah berhasil dihapus');
    }

    
}
