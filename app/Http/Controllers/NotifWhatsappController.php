<?php

namespace App\Http\Controllers;

use App\Services\FonnteService;
use Illuminate\Http\Request;
use App\Models\NotifWhatsapp;

class NotifWhatsappController extends Controller
{
    public function index()
    {
        $messages = NotifWhatsapp::orderBy('created_at', 'desc')->get();

        return view('notifikasis.index', [
            'messages' => $messages,
        ]);
    }

    public function create()
    {
        return view('notifikasis.create');
    }

    public function store(Request $request, FonnteService $fonnte)
    {
        $data = $request->validate([
            'no_telp'   => 'required|string',  // pastikan format 62xxxxxxxx
            'message' => 'required|string|max:1000',
        ]);

        $msg = $fonnte->send($data['no_telp'], $data['message']);
        return redirect()
            ->route('notifikasi.index')
            ->with('status', "Pesan dikirim ke {$msg->no_telp} dengan status: {$msg->status}");
    }
}
