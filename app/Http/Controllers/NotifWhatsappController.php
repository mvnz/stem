<?php

namespace App\Http\Controllers;

use App\Services\FonnteService;
use Illuminate\Http\Request;
use App\Models\NotifWhatsapp;

class NotifWhatsappController extends Controller
{
    public function index()
    {
        $messages = NotifWhatsapp::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('notifikasis.index', compact('messages'));
    }

    public function create()
    {
        return view('notifikasis.create');
    }

    public function store(Request $request, FonnteService $fonnte)
    {
        $data = $request->validate([
            'no_hp'   => 'required|string',  // pastikan format 62xxxxxxxx
            'message' => 'required|string|max:1000',
        ]);

        $msg = $fonnte->send($data['no_hp'], $data['message']);
        return redirect()
            ->route('notifikasi.index')
            ->with('status', "Pesan dikirim ke {$msg->no_hp} dengan status: {$msg->status}");
    }
}
