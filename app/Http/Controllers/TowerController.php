<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;
use illuminate\validate\Rule;

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
        $request->validate([
            'nama_tower' => 'required|string|max:100',
            'jumlah_lantai' => 'required|int|max:2',
            'status' => 'required|in:active,inactive',
        ]);

        Tower::create($request->validate());

        return redirect()->route('towers.index')->with('success', 'Tower berhasil ditambahkan');
    }

    public function edit($id){
        $towers = Tower::findOrFail($id);

        return view('towers.edit', compact('towers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tower' => 'required|string|max:100',
            'jumlah_lantai' => 'required|int|max:2',
            'status' => 'required|in:active,inactive',
        ]);

        Tower::findOrFail($id)->update($request->validate());

        return redirect()->route('towers.index')->with('success', 'Tower berhasil diubah');
    }

    public function destroy($id)
    {
        $towers = Tower::findOrFail($id);
        $towers->delete();

        return redirect()->route('towers.index')->with('success', 'Tower berhasil dihapus');
    }


}