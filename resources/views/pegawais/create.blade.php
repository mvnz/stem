@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Tambah Pegawai</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Tambah Pegawai</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('pegawai.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_pegawai" class="form-label ">Nama Pegawai</label>
                                <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai') }}" id="nama_pegawai" name="nama_pegawai" required>
                                @error('nama_pegawai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label ">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" id="alamat" name="alamat" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_telp" class="form-label">No Telepon</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" id="no_telp" name="no_telp" required>
                                @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <select class="form-select" @error('unit_kerja') is-invalid @enderror" id="unit_kerja" name="unit_kerja" required>
                                    <option value="" disabled selected>Pilih Unit Kerja</option>
                                    <option value="Pengelola Gedung" {{ old('unit_kerja') == 'Pengelola Gedung' ? 'selected' : '' }}>Pengelola Gedung</option>
                                    <option value="Petugas Kebersihan" {{ old('unit_kerja') == 'Petugas Kebersihan' ? 'selected' : '' }}>Petugas Kebersihan</option>
                                </select>
                                @error('unit_kerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="row mb-3">
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
                                <a href="/pegawai" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill mt-3"><i class="ti-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection