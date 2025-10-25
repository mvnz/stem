@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Tower</h1>
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
                                    <a href="/tower/create" class="btn btn-success btn-sm rounded-pill text-white"><i class="ti-plus me-2"></i> Tambah</a>
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
                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>
                                                <th scope="col">No. </th>
                                                <th scope="col">Nama Tower</th>
                                                <th scope="col">Jumlah Lantai</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($towers as $item)
                                                <th scope="row"> <a href="#" class="question_content">{{ $item->id }}</a></th>
                                                <td>{{ $item->nama_tower }}</td>
                                                <td>{{ $item->jumlah_lantai }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="/tower/{{ $item->id }}" class="d-inline-block me-2 btn btn-warning btn-sm rounded-pill text-white"><i class="ti-pencil mr-2"></i> Ubah</a>
                                                        <a href="/tower/{{ $item->id }}" class="btn btn-danger btn-sm rounded-pill text-white"><i class="ti-trash"></i> Hapus</a>
                                                    </div>
                                                </td>
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