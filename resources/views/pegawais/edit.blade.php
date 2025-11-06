@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Ubah Pegawai</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Ubah Pegawai</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_pegawai" class="form-label ">Nama Pegawai</label>
                                <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" id="nama_pegawai" name="nama_pegawai" required>
                                @error('nama_pegawai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label ">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $pegawai->alamat) }}" id="alamat" name="alamat" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_telp" class="form-label">No Telepon</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp', $pegawai->no_telp) }}" id="no_telp" name="no_telp" required>
                                @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror" value="{{ old('unit_kerja', $pegawai->unit_kerja) }}" id="unit_kerja" name="unit_kerja" required>
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
                                    <option value="Active" {{ old('status', $pegawai->status) == 'Active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Inactive" {{ old('status', $pegawai->status) == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="action_btns d-flex">
                                <a href="/pegawai" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-warning rounded-pill text-white mt-3"><i class="ti-save"></i> Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection