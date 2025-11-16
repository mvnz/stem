@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Data Insiden</h1>
        </div>
    </div>
    <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Data insiden aplikasi STEM. <p>Berisi tentang tanggal insiden, tanggal close, tower, jenis insiden, deskripsi insiden, status insiden, user pelapor, dan catatan perbaikan.
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <a href="/insiden/create" class="btn btn-success btn-sm rounded-pill text-white"><i class="ti-plus me-2"></i> Tambah</a>
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
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal Insiden</th>
                                        <th scope="col">Tower</th>
                                        <th scope="col">Jenis Insiden</th>
                                        <th scope="col">Status Insiden</th>
                                        <th scope="col">Pelapor</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($insidens as $item)
                                    <tr class="text-end">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal_insiden->format('Y-m-d') }}</td>
                                        <td>{{ $item->tower->nama_tower ?? '-' }}</td>
                                        <td>{{ $item->jenis_insiden }}</td>
                                        <td>{{ $item->status_insiden }}</td>
                                        <td>{{ $item->user->pegawai->nama_pegawai ?? $item->user->name ?? '-' }}</td>
                                        <td>
                                        <button type="button" class="btn btn-info btn-sm rounded-pill text-white btn-lihat" data-url="{{ route('insiden.show', $item->id) }}"
                                            data-bs-toggle="modal" data-bs-target="#lihatModal"><i class="ti ti-eye"></i> Lihat
                                        </button>
                                        @AdminSpv
                                        <a href="{{ route('insiden.edit', $item->id) }}" class="btn btn-warning btn-sm rounded-pill text-white">
                                            <i class="ti ti-pencil"></i> Ubah
                                        </a>
                                        @endAdminSpv
                                        @Admin
                                        <form action="{{ route('insiden.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus insiden ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill"><i class="ti ti-trash"></i> Hapus</button>
                                        </form>
                                        @endAdmin
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
    

<div class="modal fade" id="lihatModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="ti ti-agenda"></i> Detail Insiden</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <dl class="row mb-0">
          <dt class="col-sm-4">Tanggal Insiden</dt>
          <dd class="col-sm-8" data-field="tanggal_insiden">-</dd>

          <dt class="col-sm-4">Tanggal Close</dt>
          <dd class="col-sm-8" data-field="tanggal_close">-</dd>

          <dt class="col-sm-4">Tower</dt>
          <dd class="col-sm-8" data-field="tower">-</dd>

          <dt class="col-sm-4">Jenis Insiden</dt>
          <dd class="col-sm-8" data-field="jenis_insiden">-</dd>

          <dt class="col-sm-4">Status Insiden</dt>
          <dd class="col-sm-8" data-field="status_insiden">-</dd>

          <dt class="col-sm-4">User Pelapor</dt>
          <dd class="col-sm-8" data-field="pelapor">-</dd>

          <dt class="col-sm-4">Deskripsi</dt>
          <dd class="col-sm-8" data-field="deskripsi_insiden">-</dd>

          <dt class="col-sm-4">Catatan Perbaikan</dt>
          <dd class="col-sm-8" data-field="catatan_perbaikan">-</dd>
        </dl>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>



@endsection