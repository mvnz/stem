@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Activity Log</h1>
        </div>
    </div>
    <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Data tower area Apartemen Kalibata City, Jakarta. <p>Berisi tentang nama tower, jumlah lantai dan status 
                                        tower apakah aktif atau tidak (dalam pembangunan/renovasi).
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <div></div>
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
                                                <th scope="col">Waktu</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Aksi</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Id</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logs as $index => $item)
                                            <tr class="text-end">
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->user->username ?? '-'  }}</td>
                                                <td>{{ $item->action }}</td>
                                                <td>{{ class_basename($item->model_type) }}</td>
                                                <td>{{ $item->model_id }}</td>
                                                <td>{{ $item->description }}</td>
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