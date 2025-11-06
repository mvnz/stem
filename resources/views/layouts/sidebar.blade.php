<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="index.html"><img src="{{ asset('dash/images/wms-logo.png') }}" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="">
          <a class="" href="#" aria-expanded="false">
          <!-- <i class="fas fa-th"></i> -->
          <div class="icon_menu">
              <img src="{{ asset('dash/images/menu-icon-dashboard.svg') }}" alt="">
        </div>
            <span>Dashboard</span>
          </a>
          
        </li>
        <li class="">
            <a class="" href="#" aria-expanded="false">
              <div class="icon_menu">
                  <img src="{{ asset('dash/images/menu-icon-2.svg') }}" alt="">
              </div>
              <span>Monitoring</span>
            </a>
          </li>
        <li class="">
          <a class="" href="#" aria-expanded="false">
            
            <div class="icon_menu">
                <img src="{{ asset('dash/images/menu-icon-3.svg') }}" alt="">
            </div>
            <span>Pemilahan</span>
          </a>
          
        </li>
        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
            
            <div class="icon_menu">
                <img src="{{ asset('dash/images/menu-icon-4.svg') }}" alt="">
            </div>
            <span>Report</span>
          </a>
          <ul>
            <li><a href="#">Insiden</a></li>
            <li><a href="#">Notifikasi</a></li>  
            <li><a href="#">Activity Log</a></li>
            <li><a href="#">User Log</a></li>
          </ul>
        </li>

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
            <li><a href="#">User</a></li>
          </ul>
        </li>
        
        <li class="">
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
          </li>

          

      </ul>
    
</nav>