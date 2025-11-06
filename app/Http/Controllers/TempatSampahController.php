<?php

namespace App\Http\Controllers;

use App\Models\TempatSampah;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Validate\Rule;

class TempatSampahController extends Controller
{
    public function index()
    {
        $tempatSampahs = TempatSampah::all();

        return view('tempatSampahs.index', compact('tempatSampahs'));
    }

    public function create()
    {
        $towers = Tower::all();

        return view('tempatSampahs.create', compact('towers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tempat_sampah' => 'required|string|max:100',
            'id_tower' => 'required|int',
            'lantai' => 'required|int|min:1|max:99',
            'id_sensor' => 'nullable|string|max:10',
            'status' => 'required|in:Active,Inactive',
        ]);

        TempatSampah::create($validated);

        return redirect()->route('tempatSampah.index')->with('success', 'Tempat Sampah berhasil ditambahkan');
    }

    public function edit($id){
        $tempatSampah = TempatSampah::findOrFail($id);
        $towers = Tower::all();

        return view('tempatSampahs.edit', compact('tempatSampah', 'towers'));
    }

    public function update(Request $request, $id)
    {
        $tempatSampahs = TempatSampah::findOrFail($id);

        $validated = $request->validate([
            'nama_tempat_sampah' => 'required|string|max:100',
            'lantai' => 'required|int|min:1|max:99',
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
