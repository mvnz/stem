@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12"><h1>Generate Jadwal Piket</h1></div>
</div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
@if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif
@if ($errors->any())
  <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif

<div class="white_card">
    <div class="white_card_header">
        <div class="box_header m-0">
            <div class="main-title">
                <h3 class="m-0">Parameter auto generate jadwal piket</h3>
            </div>
        </div>
    </div>

    <div class="white_card_body">
        <form action="{{ route('jadwalPiket.generate') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-4">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Tanggal Selesai</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jumlah Orang per Shift</label>
            <input type="number" name="quota_per_shift" min="1" value="1" class="form-control" required>
            <div class="form-text">Jumlah Petugas Kebersihan tiap shift</div>
        </div>

        <div class="col-12">
            <label class="form-label">Pilih Tower (opsional)</label>
            <select name="towers[]" class="form-select" multiple>
                @foreach($towers as $tw)
                <option value="{{ $tw->id }}">{{ $tw->nama_tower }}</option>
                @endforeach
            </select>
            <div class="form-text">Pilih tower (kosongkan untuk memilih semua tower)</div>
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="overwrite" name="overwrite" value="1">
                <label class="form-check-label" for="overwrite">Rewrite data yang ada</label>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary rounded-pill">Generate Jadwal</button>
        </div>
    </form>
    </div>
</div>
@endsection
