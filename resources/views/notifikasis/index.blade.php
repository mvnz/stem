@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>History Pengiriman Notifikasi</h1>
            @if (session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Daftar histori pengiriman notifikasi sampah area Apartemen Kalibata City, Jakarta. 
                                        <p>Berisi tentang nomor telepon, pesan, waktu pengiriman, dan status pengiriman notifikasi.
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <a href="/notifikasi/create" class="btn btn-success btn-sm rounded-pill text-white"><i class="ti-plus me-2"></i> Tambah</a>
                                </div>
        
                                <div class="QA_table mb_30">
                                    <!-- table-responsive -->
                                    <table class="table lms_table_active table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="text-end">
                                                <th scope="col">No. </th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Nomor </th>
                                                <th scope="col">Pesan</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($messages as $index => $item)
                                            <tr class="text-end">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->sent_at?->format('Y-m-d H:i') ?? $item->created_at->format('Y-m-d H:i') }}</td>
                                                <td>{{ $item->no_telp }}</td>
                                                <td style="max-width: 350px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->pesan }}</td>
                                                <td>
                                                    @if ($item->status === 'success')
                                                        <span class="badge bg-success">Sukses</span>
                                                    @elseif ($item->status === 'failed')
                                                        <span class="badge bg-danger">Gagal</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $item->status ?? 'N/A' }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    
                </div>
            </div>
@endsection