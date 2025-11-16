<div class="container-fluid g-0">
        <div class="row">
            <div class="col-lg-12 p-0 ">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="serach_field-area d-flex align-items-center">
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                            <p class="text-white">Selamat Datang, {{ Auth::user()->pegawai->nama_pegawai." (" . Auth::user()->username . ")" }}</p>                   
                        </div>
                        <div class="profile_info">
                            <img src="{{ asset('dash/images/img-client_img.png') }}" alt="#">
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <p>{{ Auth::user()->role }} </p>
                                    </div>
                                <div class="profile_info_details">
                                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill">Log Out </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>