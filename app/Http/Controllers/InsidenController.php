<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Insiden;
use App\Models\Tower;   
use App\Models\User;
use Carbon\Carbon;

class InsidenController extends Controller
{
    protected $casts = [
        'tanggal_insiden' => 'datetime',
        'tanggal_close' => 'datetime',
    ];

    public function index()
    {
        $insidens = Insiden::all();

        return view('insidens.index', [
            'insidens' => $insidens,
        ]);
    }

    public function create()
    {
        $towers = Tower::all();
        $users = User::all();

        return view('insidens.create', compact('towers', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_insiden' => 'required|date',
            'tanggal_close' => 'nullable|date',
            'tower_id' => 'required|exists:towers,id',
            'jenis_insiden' => 'required|in:Sampah,Sensor,Lantai,Lainnya',
            'deskripsi_insiden' => 'required|string|max:255',
            'status_insiden' => 'required|in:Open,Proses Perbaikan,Selesai',
            'user_id' => 'nullable|exists:users,id',
            'catatan_perbaikan' => 'nullable|string|max:255',
        ]);

        Insiden::create($validated);

        return redirect()->route('insiden.index')->with('success', 'Insiden berhasil ditambahkan');
    }

    public function edit($id){
        $insiden = Insiden::findOrFail($id);
        $towers = Tower::all();
        $users = User::all();

        return view('insidens.edit', compact('insiden', 'towers', 'users'));
    }

    public function update(Request $request, $id)
    {
        $insiden = Insiden::findOrFail($id);

        //dd($request->all(), $insiden->toArray());

        $validated = $request->validate([
            'tanggal_close' => 'nullable|date',
            'jenis_insiden' => 'enum:Sampah,Sensor,Lantai,Lainnya',
            'status_insiden' => 'required|in:Open,Proses Perbaikan,Selesai',
            'catatan_perbaikan' => 'required|string|max:255',
        ]);

        $insiden->update($validated);

        return redirect()->route('insiden.index')->with('success', 'Insiden berhasil diubah');
    }

    public function destroy($id)
    {
        $insiden = Insiden::findOrFail($id);
        $insiden->delete();

        return redirect()->route('insiden.index')->with('success', 'Insiden berhasil dihapus');
    }

    public function show($id)
    {
        $insiden = Insiden::with(['tower', 'user.pegawai'])->findOrFail($id);

        // helper kecil buat tanggal
        $fmt = fn ($d) => $d ? Carbon::parse($d)->isoFormat('YYYY-MM-DD') : '-';

        return response()->json([
            'tanggal_insiden'    => $fmt($insiden->tanggal_insiden),
            'tanggal_close'      => $fmt($insiden->tanggal_close),
            'tower'              => optional($insiden->tower)->nama_tower ?? '-',
            'jenis_insiden'      => $insiden->jenis_insiden ?? '-',
            'status_insiden'     => $insiden->status_insiden ?? '-',
            'pelapor'            => optional(optional($insiden->user)->pegawai)->nama_pegawai
                                    ?? optional($insiden->user)->name ?? '-',
            'deskripsi_insiden'  => $insiden->deskripsi_insiden ?? '-',
            'catatan_perbaikan'  => $insiden->catatan_perbaikan ?? '-',
        ]);
    }

    
}
