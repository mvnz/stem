<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="#"><img src="{{ asset('dash/images/wms-logo.png') }}" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="">
          <a class="" href="/dashboard" aria-expanded="false">
          <!-- <i class="fas fa-th"></i> -->
          <div class="icon_menu">
              <img src="{{ asset('dash/images/menu-icon-dashboard.svg') }}" alt="">
        </div>
            <span>Dashboard</span>
          </a>          
        </li>
        @AdminSpv
        <li class="">
          <a class="" href="/jadwalPiket" aria-expanded="false">            
            <div class="icon_menu">
                <img src="{{ asset('dash/images/menu-icon-4.svg') }}" alt="">
            </div>
            <span>Jadwal Piket</span>
          </a>      
        @endAdminSpv
        </li>
        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">            
            <div class="icon_menu">
                <img src="{{ asset('dash/images/menu-icon-7.svg') }}" alt="">
            </div>
            <span>Report</span>
          </a>
          <ul>
            <li><a href="/insiden">Insiden</a></li>
            @AdminSpv
            <li><a href="/notifikasi">Notifikasi</a></li>
            @endAdminSpv
            @Admin  
            <li><a href="/activityLog">Activity Log</a></li>
            @endAdmin
          </ul>
        </li>

        @AdminSpv
        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{ asset('dash/images/menu-icon-5.svg') }}" alt="">
            </div>
            <span>Master Data</span>
          </a>
          
          <ul>
            <li><a href="/tower">Tower</a></li>
            <li><a href="/sensor">Sensor Iot</a></li>
            <li><a href="/tempatSampah">Tempat Sampah</a></li>
            <li><a href="/mesinPemilah">Mesin Pemilah</a></li>
            <li><a href="/pegawai">Pegawai</a></li>
            <li><a href="/user">User</a></li>
          </ul>
        </li>
        @endAdminSpv

        @Admin
        <!--<li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
              <div class="icon_menu">
                  <img src="{{ asset('dash/images/menu-icon-11.svg') }}" alt="">
              </div>
              <span>ML</span>
            </a>
            <ul>
              <li><a href="#">Data Tranining</a></li>
              <li><a href="#">Klasifikasi</a></li>
            </ul>
          </li>-->
        @endAdmin
      </ul>
    
</nav>