@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Ubah Mesin Pemilah</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Ubah Mesin Pemilah</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('mesinPemilah.update', $mesinPemilah->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_mesin" class="form-label ">Nama Mesin</label>
                                <input type="text" class="form-control @error('nama_mesin') is-invalid @enderror" value="{{ old('nama_mesin', $mesinPemilah->nama_mesin) }}" id="nama_mesin" name="nama_mesin" required>
                                @error('nama_mesin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="konfigurasi" class="form-label">Konfigurasi</label>
                                <input type="text" class="form-control @error('konfigurasi') is-invalid @enderror" value="{{ old('konfigurasi', $mesinPemilah->konfigurasi) }}" id="konfigurasi" name="konfigurasi" required>
                                @error('konfigurasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Active" {{ old('status', $mesinPemilah->status) == 'Active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Inactive" {{ old('status', $mesinPemilah->status) == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="action_btns d-flex">
                                <a href="/mesinPemilah" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-warning rounded-pill text-white mt-3"><i class="ti-save"></i> Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection