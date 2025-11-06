@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Tambah Sensor IoT</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Tambah Sensor IoT</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('sensor.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_sensor" class="form-label ">Nama Sensor</label>
                                <input type="text" class="form-control @error('nama_sensor') is-invalid @enderror" value="{{ old('nama_sensor') }}" id="nama_sensor" name="nama_sensor" required>
                                @error('nama_sensor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="threshold" class="form-label">Threshold (dalam cm)</label>
                                <input type="number" class="form-control @error('threshold') is-invalid @enderror" value="{{ old('threshold') }}" id="threshold" name="threshold" required>
                                @error('threshold')
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
                                <a href="/sensor" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill mt-3"><i class="ti-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection