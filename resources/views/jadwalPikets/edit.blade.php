@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Ubah Jadwal Piket</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Ubah Jadwal Piket</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('jadwalPiket.update', $jadwalPiket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="namaPegawai" class="form-label ">Nama Pegawai</label>
                                <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai', $jadwalPiket->pegawai->nama_pegawai) }}" id="nama_pegawai" name="nama_pegawai" required>
                                @error('nama_pegawai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal',optional($jadwalPiket->tanggal)->format('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                                
                            </div>

                            <div class="col-md-6">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select @error('shift') is-invalid @enderror" id="shift" name="shift" required>
                                    <option value="" disabled selected>Pilih Shift</option>
                                    <option value="Pagi" {{ old('shift', $jadwalPiket->shift) == 'Pagi' ? 'selected' : '' }}>Pagi (00.00 - 08.00)</option>
                                    <option value="Siang" {{ old('shift', $jadwalPiket->shift) == 'Siang' ? 'selected' : '' }}>Siang (08.00 - 16.00)</option>
                                    <option value="Malam" {{ old('shift', $jadwalPiket->shift) == 'Malam' ? 'selected' : '' }}>Malam (16.00 - 00.00)</option>
                                    <option value="Libur" {{ old('shift', $jadwalPiket->shift) == 'Libur' ? 'selected' : '' }}>Libur</option>
                                </select>
                                @error('shift')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tower" class="form-label">Tower</label>
                                <select class="form-select @error('tower_id') is-invalid @enderror" id="tower_id" name="tower_id" required>
                                    <option value="" disabled selected>Pilih Tower</option>
                                @foreach ($towers as $tower)
                                    <option value="{{ $tower->id }}" @selected(old('tower_id', $jadwalPiket->tower_id) == $tower->id)>{{ $tower->nama_tower }}</option>
                                @endforeach
                                </select>
                                @error('tower_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="action_btns d-flex">
                                <a href="/jadwalPiket" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-warning rounded-pill text-white mt-3"><i class="ti-save"></i> Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection