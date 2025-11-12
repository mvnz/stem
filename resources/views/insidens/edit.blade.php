@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Ubah Insiden</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Form Ubah Insiden</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('insiden.update', $insiden->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tanggal_insiden" class="form-label ">Tanggal Insiden</label>
                                <input type="date" class="form-control @error('tanggal_insiden') is-invalid @enderror" value="{{ old('tanggal_insiden', $insiden->tanggal_insiden->format('Y-m-d')) }}" id="tanggal_insiden" name="tanggal_insiden" disabled>
                                @error('tanggal_insiden')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_close" class="form-label ">Tanggal Close</label>
                                <input type="date" class="form-control @error('tanggal_close') is-invalid @enderror" value="{{ old('tanggal_close', $insiden->tanggal_close) }}" id="tanggal_close" name="tanggal_close">
                                @error('tanggal_close')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tower" class="form-label">Tower</label>
                                <select class="form-select @error('tower_id') is-invalid @enderror" id="tower_id" name="tower_id" disabled>
                                    <option value="" disabled selected>Pilih Nama Tower</option>
                                @foreach ($towers as $tower)
                                    <option value="{{ $tower->id }}" @selected(old('tower_id', $insiden->tower_id) == $tower->id)>{{ $tower->nama_tower }}</option>
                                @endforeach
                                </select>
                                @error('tower_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jenis_insiden" class="form-label">Jenis Insiden</label>
                                <select class="form-select @error('jenis_insiden') is-invalid @enderror" id="jenis_insiden" name="jenis_insiden" disabled>
                                    <option value="" disabled selected>Pilih Jenis Insiden</option>
                                    <option value="Sampah" {{ old('jenis_insiden', $insiden->jenis_insiden) == 'Sampah' ? 'selected' : '' }}>Sampah</option>
                                    <option value="Sensor" {{ old('jenis_insiden', $insiden->jenis_insiden) == 'Sensor' ? 'selected' : '' }}>Sensor</option>
                                    <option value="Lantai" {{ old('jenis_insiden', $insiden->jenis_insiden) == 'Lantai' ? 'selected' : '' }}>Lantai</option>
                                    <option value="Lainnya" {{ old('jenis_insiden', $insiden->jenis_insiden) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('jenis_insiden')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="deskripsi_insiden" class="form-label ">Deskripsi Insiden</label>
                                <textarea class="form-control @error('deskripsi_insiden') is-invalid @enderror" id="deskripsi_insiden" 
                                name="deskripsi_insiden" rows="3" disabled>{{ old('deskripsi_insiden', $insiden->deskripsi_insiden) }}</textarea>
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
                                    <option value="Open" {{ old('status_insiden', $insiden->status_insiden) == 'Open' ? 'selected' : '' }}>Open</option>
                                    <option value="Proses Perbaikan" {{ old('status_insiden', $insiden->status_insiden) == 'Proses Perbaikan' ? 'selected' : '' }}>Proses Perbaikan</option>
                                    <option value="Closed" {{ old('status_insiden', $insiden->status_insiden) == 'Closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                                @error('status_insiden')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="catatan_perbaikan" class="form-label">Catatan Perbaikan</label>
                                <input type="text" class="form-control @error('catatan_perbaikan') is-invalid @enderror" value="{{ old('catatan_perbaikan', $insiden->catatan_perbaikan) }}" id="catatan_perbaikan" name="catatan_perbaikan">
                                @error('catatan_perbaikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <label for="petugas_kebersihan" class="form-label">Petugas Kebersihan (ntar ini otomatis ngisi klo udah login)</label>
                                <input type="text" class="form-control @error('petugas_kebersihan') is-invalid @enderror" value="1" id="petugas_kebersihan" name="petugas_kebersihan">
                                @error('petugas_kebersihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="action_btns d-flex">
                                <a href="/insiden" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-warning rounded-pill mt-3 text-white"><i class="ti-save"></i> Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection