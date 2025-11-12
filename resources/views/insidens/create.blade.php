@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Tambah Insiden</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Tambah Insiden</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('insiden.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tanggal_insiden" class="form-label ">Tanggal Insiden</label>
                                <input type="date" class="form-control @error('tanggal_insiden') is-invalid @enderror" value="{{ old('tanggal_insiden') }}" id="tanggal_insiden" name="tanggal_insiden" required>
                                @error('tanggal_insiden')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_close" class="form-label ">Tanggal Close</label>
                                <input type="date" class="form-control @error('tanggal_close') is-invalid @enderror" value="{{ old('tanggal_close') }}" id="tanggal_close" name="tanggal_close">
                                @error('tanggal_close')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tower" class="form-label">Tower</label>
                                <select class="form-select @error('tower_id') is-invalid @enderror" id="tower_id" name="tower_id" required>
                                    <option value="" disabled selected>Pilih Nama Tower</option>
                                @foreach ($towers as $tower)
                                    <option value="{{ $tower->id }}" @selected(old('tower_id') == $tower->id)>{{ $tower->nama_tower }}</option>
                                @endforeach
                                </select>
                                @error('tower_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jenis_insiden" class="form-label">Jenis Insiden</label>
                                <select class="form-select @error('jenis_insiden') is-invalid @enderror" id="jenis_insiden" name="jenis_insiden" required>
                                    <option value="" disabled selected>Pilih Jenis Insiden</option>
                                @foreach ([
                                (object)[
                                    "label" => "Sampah",
                                    "value" => "Sampah",
                                ],
                                (object)[
                                    "label" => "Sensor",
                                    "value" => "Sensor",
                                ],
                                (object)[
                                    "label" => "Lantai",
                                    "value" => "Lantai",
                                ],
                                (object)[
                                    "label" => "Lainnya",
                                    "value" => "Lainnya",
                                ],
                                ] as $option)
                                    <option value="{{ $option->value }}" @selected(old('jenis_insiden') == $option->value)>{{ $option->label }}</option>
                                @endforeach
                                </select>
                                @error('jenis_insiden')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="deskripsi_insiden" class="form-label ">Deskripsi Insiden</label>
                                <textarea class="form-control @error('deskripsi_insiden') is-invalid @enderror" id="deskripsi_insiden" name="deskripsi_insiden" rows="3" required>{{ old('deskripsi_insiden') }}</textarea>
                                @error('deskripsi_insiden')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status_insiden" class="form-label">Status Insiden</label>
                                <select class="form-select @error('status_insiden') is-invalid @enderror" id="status_insiden" name="status_insiden" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                @foreach ([
                                (object)[
                                    "label" => "Open",
                                    "value" => "Open",
                                ],
                                (object)[
                                    "label" => "Proses Perbaikan",
                                    "value" => "Proses Perbaikan",
                                ],
                                (object)[
                                    "label" => "Closed",
                                    "value" => "Closed",
                                ],
                                ] as $option)
                                    <option value="{{ $option->value }}" @selected(old('status') == $option->value)>{{ $option->label }}</option>
                                @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="catatan" class="form-label">Catatan</label>
                                <input type="text" class="form-control @error('catatan') is-invalid @enderror" value="{{ old('catatan') }}" id="catatan" name="catatan">
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">Petugas Kebersihan (ntar ini otomatis ngisi klo udah login)</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror" value="1" id="user_id" name="user_id">
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="action_btns d-flex">
                                <a href="/insiden" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill mt-3"><i class="ti-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection