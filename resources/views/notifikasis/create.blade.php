@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Kirim Notifikasi</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Kirim Notifikasi</h3>
                        </div>
                         @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <form action="{{ route('notifikasi.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="no_telp" class="form-label ">Nomor Tujuan (format 62...)</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" id="no_telp" name="no_telp" required>
                                @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            </div>
                            <div class="action_btns d-flex">
                                <a href="{{ route('notifikasi.index') }}" class="btn btn-secondary rounded-pill text-white mt-3 me-2"><i class="ti-angle-left mr-2"></i> Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill mt-3"><i class="ti-location-arrow"></i> Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection