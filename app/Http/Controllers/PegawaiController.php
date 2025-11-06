<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();

        return view('pegawais.index', [
            'pegawais' => $pegawais,
        ]);
    }

    public function create()
    {
        return view('pegawais.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pegawai' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'unit_kerja' => 'required|string|max:50',
            'status' => 'required|in:Active,Inactive',
        ]);

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit($id){
        $pegawai = Pegawai::findOrFail($id);

        return view('pegawais.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $validated = $request->validate([
            'nama_pegawai' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'unit_kerja' => 'required|string|max:50',
            'status' => 'required|in:Active,Inactive',
        ]);

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diubah');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus');
    }
}
