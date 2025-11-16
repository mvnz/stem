@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Sensor IoT</h1>
        </div>
    </div>
    <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Data Sensor IoT di area Apartemen Kalibata City, Jakarta. <p>Berisi tentang lokasi nama sensor dan 
                                        threshold untuk sensor tempat sampah serta status sensor (aktif/tidak aktif).
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <a href="/sensor/create" class="btn btn-success btn-sm rounded-pill text-white"><i class="ti-plus me-2"></i> Tambah</a>
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
                                    <!-- table-responsive -->
                                    <table class="table lms_table_active table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="text-end">
                                                <th scope="col">No. </th>
                                                <th scope="col">Nama Sensor</th>
                                                <th scope="col">Threshold (dalam cm)</th>
                                                <th scope="col">Status</th>
                                                @Admin
                                                <th scope="col">Aksi</th>
                                                @endAdmin
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sensors as $index =>$item)
                                            <tr class="text-end">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_sensor }}</td>
                                                <td>{{ $item->threshold }}</td>
                                                <td>{{ $item->status == 'Active' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                                @Admin
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('sensor.edit', $item->id) }}" class="d-inline-block me-2 btn btn-warning btn-sm rounded-pill text-white"><i class="ti-pencil mr-2"></i> Ubah</a>
                                                        <form action="{{ route('sensor.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus sensor ini?')" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill"><i class="ti-trash me-1"></i> Hapus
                                                        </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                @endAdmin
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