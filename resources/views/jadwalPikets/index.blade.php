@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Jadwal Piket</h1>
        </div>
    </div>
    <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Data jadwal piket petugas kebersihan di area Apartemen Kalibata City, Jakarta. <p>Berisi tentang 
                                        informasi jadwal piket, shift, dan nama petugas kebersihan.
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <a href="/jadwalPiket/create" class="btn btn-success btn-sm rounded-pill text-white"><i class="ti-reload me-2"></i> Generate Jadwal Piket</a>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form active="#">
                                                    <div class="search_field">
                                                        <input type="text" placeholder="Cari disini...">
                                                    </div>
                                                    <button type="submit"> <i class="ti-search"></i> </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="add_button ms-2">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn_1">Cari</a>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="text-end">
                                                <th scope="col">No. </th>
                                                <th scope="col">Tanggal</th>                                                
                                                <th scope="col">Shift</th>
                                                <th scope="col">Jam</th>
                                                <th scope="col">Tower</th>
                                                <th scope="col">Nama Petugas Kebersihan</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwalPikets as $index => $item)
                                            <tr class="text-end">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tanggal->format('d M Y') }}</td>
                                                <td>{{ $item->shift }}</td>
                                                <td>
                                                    @if($item->shift !== 'Libur')
                                                        {{ $item->jam_mulai ? \Illuminate\Support\Str::substr($item->jam_mulai,0,5) : '-' }}
                                                        -
                                                        {{ $item->jam_selesai ? \Illuminate\Support\Str::substr($item->jam_selesai,0,5) : '-' }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $item->tower->nama_tower ?? '-' }}</td>
                                                <td>{{ $item->pegawai->nama_pegawai ?? '-' }}</td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('jadwalPiket.edit', $item->id) }}" class="d-inline-block me-2 btn btn-warning btn-sm rounded-pill text-white"><i class="ti-pencil mr-2"></i> Ubah</a>
                                                    </div>
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