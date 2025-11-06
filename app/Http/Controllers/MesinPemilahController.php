<?php

namespace App\Http\Controllers;
use App\Models\MesinPemilah;
use Illuminate\Http\Request;

class MesinPemilahController extends Controller
{
    public function index()
    {
        $mesinPemilahs = MesinPemilah::all();

        return view('mesinPemilahs.index', [
            'mesinPemilahs' => $mesinPemilahs,
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
