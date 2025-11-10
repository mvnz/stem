@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Tambah User Pengguna</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Tambah User Pengguna</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="pegawai" class="form-label">Nama Pegawai</label>
                                <select class="form-select @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id" required>
                                    <option value="" disabled selected>Pilih Pegawai</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}" @selected(old('pegawai_id') == $pegawai->id)>{{ $pegawai->nama_pegawai }}</option>
                                @endforeach
                                </select>
                                @error('pegawai_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" id="username" name="username" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="" disabled selected>Pilih Role</option>
                                @foreach ([
                                (object)[
                                    "label" => "Admin",
                                    "value" => "Admin",
                                ],
                                (object)[
                                    "label" => "User",
                                    "value" => "User",
                                ],
                                (object)[
                                    "label" => "Petugas Kebersihan",
                                    "value" => "petugasKebersihan",
                                ],
                                ] as $option)
                                    <option value="{{ $option->value }}" @selected(old('role') == $option->value)>{{ $option->label }}</option>
                                @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                @foreach ([
                                (object)[
                                    "label" => "Aktif",
                                    "value" => "Active",
                                ],
                                (object)[
                                    "label" => "Tidak Aktif",
                                    "value" => "Inactive",
                                ],
                                ] as $option)
                                    <option value="{{ $option->value }}" @selected(old('status') == $option->value)>{{ $option->label }}</option>
                                @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="action_btns d-flex">
                                <a href="/user" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill mt-3"><i class="ti-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 