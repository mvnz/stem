@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Tambah Tempat Sampah</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Tambah Tempat Sampah</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('tempatSampah.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_tempat_sampah" class="form-label ">Nama Tempat Sampah</label>
                                <input type="text" class="form-control @error('nama_tempat_sampah') is-invalid @enderror" value="{{ old('nama_tempat_sampah') }}" id="nama_tempat_sampah" name="nama_tempat_sampah" required>
                                @error('nama_tempat_sampah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jumlah_lantai" class="form-label">Tower</label>
                                <select class="form-select @error('id_tower') is-invalid @enderror" id="id_tower" name="id_tower" required>
                                    <option value="" disabled selected>Pilih Nama Tower</option>
                                @foreach ($towers as $tower)
                                    <option value="{{ $tower->id }}" @selected(old('id_tower') == $tower->id)>{{ $tower->nama_tower }}</option>
                                @endforeach
                                </select>
                                @error('id_tower')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Lantai</label>
                                <input type="number" class="form-control @error('lantai') is-invalid @enderror" value="{{ old('lantai') }}" id="lantai" name="lantai" required>
                                @error('lantai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Sensor ID</label>
                                <input type="text" class="form-control @error('id_sensor') is-invalid @enderror" value="{{ old('id_sensor') }}" id="id_sensor" name="id_sensor" required>
                                @error('id_sensor')
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
                                <a href="/tempatSampah" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill mt-3"><i class="ti-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection