<?php

namespace App\Http\Controllers;

use App\Models\TempatSampah;
use App\Models\Tower;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Validate\Rule;

class TempatSampahController extends Controller
{
    public function index()
    {

        $tempatSampahs = TempatSampah::with(['tower', 'sensor'])->get();

        return view('tempatSampahs.index', compact('tempatSampahs'));
    }

    public function create()
    {
        $towers = Tower::all();
        $sensorYangDipake = TempatSampah::pluck('id_sensor')->toArray();
        $sensors = Sensor::whereNotIn('id', $sensorYangDipake)->get();

        return view('tempatSampahs.create', compact('towers', 'sensors'));
    }

    public function store(Request $request)
    {
        $tower = Tower::findOrFail($request->id_tower);
        $maksimumLantai = (int) $tower->jumlah_lantai;
        $validated = $request->validate([
            'nama_tempat_sampah' => 'required|string|max:100',
            'id_tower' => 'required|int',
            'lantai' => 'required|int|min:1|max:'.$maksimumLantai,
            'id_sensor' => 'nullable|string|max:10',
            'status' => 'required|in:Active,Inactive',
        ]);

        TempatSampah::create($validated);

        return redirect()->route('tempatSampah.index')->with('success', 'Tempat Sampah berhasil ditambahkan');
    }

    public function edit($id){
        $tempatSampah = TempatSampah::findOrFail($id);
        $towers = Tower::all();
        $sensorYangDipake = TempatSampah::where('id_sensor', '!=', $tempatSampah->id_sensor)->pluck('id_sensor')->toArray();
        $sensors = Sensor::whereNotIn('id', $sensorYangDipake)->get();

        return view('tempatSampahs.edit', compact('tempatSampah', 'towers', 'sensors'));
    }

    public function update(Request $request, $id)
    {
        $tower = Tower::findOrFail($request->id_tower);
        $tempatSampahs = TempatSampah::findOrFail($id);
        $maksimumLantai = (int) $tower->jumlah_lantai;

        $validated = $request->validate([
            'nama_tempat_sampah' => 'required|string|max:100',
            'lantai' => 'required|int|min:1|max:'.$maksimumLantai,
            'id_sensor' => 'nullable|string|max:10',
            'status' => 'required|in:Active,Inactive',
        ]);

        $tempatSampahs->update($validated);

        return redirect()->route('tempatSampah.index')->with('success', 'Tempat Sampah berhasil diubah');
    }

    public function destroy($id)
    {
        $tempatSampahs = TempatSampah::findOrFail($id);
        $tempatSampahs->delete();

        return redirect()->route('tempatSampah.index')->with('success', 'Tempat Sampah berhasil dihapus');
    }
}
