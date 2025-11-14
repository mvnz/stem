<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;
use illuminate\Validate\Rule;


class TowerController extends Controller
{
    public function index()
    {
        $towers = Tower::all();

        return view('towers.index', [
            'towers' => $towers,
        ]);
    }

    public function create()
    {
        return view('towers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tower' => 'required|string|max:100',
            'jumlah_lantai' => 'required|int|min:1|max:99',
            'status' => 'required|in:Active,Inactive',
        ]);

        Tower::create($validated);

        return redirect()->route('tower.index')->with('success', 'Tower berhasil ditambahkan');

    }

    public function edit($id){
        $tower = Tower::findOrFail($id);

        return view('towers.edit', compact('tower'));
    }

    public function update(Request $request, $id)
    {
        $towers = Tower::findOrFail($id);

        $validated = $request->validate([
            'nama_tower' => 'required|string|max:100',
            'jumlah_lantai' => 'required|int|min:1|max:99',
            'status' => 'required|in:Active,Inactive',
        ]);

        $towers->update($validated);

        return redirect()->route('tower.index')->with('success', 'Tower berhasil diubah');
    }

    public function destroy($id)
    {
        $towers = Tower::findOrFail($id);
        $towers->delete();

        return redirect()->route('tower.index')->with('success', 'Tower berhasil dihapus');
    }


}