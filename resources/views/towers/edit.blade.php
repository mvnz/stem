@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Ubah Tower</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Ubah Tower</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('tower.update', $tower->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_tower" class="form-label ">Nama Tower</label>
                                <input type="text" class="form-control @error('nama_tower') is-invalid @enderror" value="{{ old('nama_tower', $tower->nama_tower) }}" id="nama_tower" name="nama_tower" required>
                                @error('nama_tower')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jumlah_lantai" class="form-label">Jumlah Lantai</label>
                                <input type="number" class="form-control @error('jumlah_lantai') is-invalid @enderror" value="{{ old('jumlah_lantai', $tower->jumlah_lantai) }}" id="jumlah_lantai" name="jumlah_lantai" required>
                                @error('jumlah_lantai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Active" {{ old('status', $tower->status) == 'Active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Inactive" {{ old('status', $tower->status) == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="action_btns d-flex">
                                <a href="/tower" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-warning rounded-pill text-white mt-3"><i class="ti-save"></i> Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection