<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['pegawai'])->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $pegawais = Pegawai::all();
        $pegawaiYangSudahPunyaUser = User::pluck('pegawai_id')->toArray();
        $pegawais = $pegawais->whereNotIn('id', $pegawaiYangSudahPunyaUser);

        return view('users.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        //dd("data kesimpan");

        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'username' => 'required|string|max:100|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Admin,User,petugasKebersihan',
            'status' => 'required|in:Active,Inactive',
        ]);

        User::create($validated);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $pegawais = Pegawai::all();
        $pegawaiYangSudahPunyaUser = User::where('pegawai_id', '!=', $user->pegawai_id)->pluck('pegawai_id')->toArray();
        $pegawais = $pegawais->whereNotIn('id', $pegawaiYangSudahPunyaUser);

        return view('users.edit', compact('user', 'pegawais'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'pegawai_id' => 'exists:pegawais,id',
            'username'   => 'string|max:255|unique:users,username,'.$id,
            'password'   => 'nullable|confirmed|min:8',
            'role'       => 'string',
            'status'     => 'in:Active,Inactive',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('user.index')->with('success', 'User berhasil diubah.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}