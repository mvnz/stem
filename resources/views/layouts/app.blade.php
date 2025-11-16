<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>STEM - Smart Waste Management System</title>

    <link rel="icon" href="{{ asset('dash/favicons/favicon.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/css-bootstrap1.min.css') }}">
    <!-- themefy CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/themefy_icon-themify-icons.css') }}">
    <!-- select2 CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/css-nice-select.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/css-owl.carousel.css') }}">
    <!-- gijgo css -->
    <link rel="stylesheet" href="{{ asset('dash/css/gijgo-gijgo.min.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/css-font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/tagsinput-tagsinput.css') }}">

    <!-- date picker -->
     <link rel="stylesheet" href="{{ asset('dash/css/datepicker-date-picker.css') }}">
     <!-- scrollabe  -->
     <link rel="stylesheet" href="{{ asset('dash/css/scroll-scrollable.css') }}">
    <!-- datatable CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/css-jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/css-responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/css-buttons.dataTables.min.css') }}">
    <!-- text editor css -->
    <link rel="stylesheet" href="{{ asset('dash/css/text_editor-summernote-bs4.css') }}">
    <!-- morris css -->
    <link rel="stylesheet" href="{{ asset('dash/css/morris-morris.css') }}">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="{{ asset('dash/css/material_icon-material-icons.css') }}">

    <!-- menu css  -->
    <link rel="stylesheet" href="{{ asset('dash/css/css-metisMenu.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/css-style1.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/colors-default.css') }}" id="colorSkinCSS">

    <link href="{{ asset('dash/css/style.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('dash/js/all.js') }}" crossorigin="anonymous"></script>

    <style>
      .custom-page {
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 14px;
    color: #4A4A4A;
    border: 1px solid #ddd;
    transition: all 0.2s ease-in-out;
}

.custom-page:hover {
    background: #eef2ff;
    border-color: #b3c1ff;
    color: #3b4cca;
}

.page-item.active .custom-page {
    background: #3b4cca;
    color: white;
    border-color: #3b4cca;
}
    </style>
    
</head>
<body class="crm_body_bg">
    


<!-- main content part here -->
 
 <!-- sidebar  -->
 <!-- sidebar part here -->
@include('layouts.sidebar')
<!-- sidebar part end -->
 <!--/ sidebar  -->


<section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
    @include('layouts.navbar')
    <!--/ menu  -->
    <div class="main_content_iner ">
        <div class="container-fluid p-0 ">
            @yield('content')            
        </div>
    </div>

<!-- footer part -->
<div class="footer_part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <p>2025 &copy; Designed by <a href="#"> Kelompok 6 AKPSI</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- main content part end -->

<!-- ### CHAT_MESSAGE_BOX   ### -->



<!--/### CHAT_MESSAGE_BOX  ### -->

<!-- footer  -->
<script src="{{ asset('dash/js/7585-js-jquery1-3.4.1.min.js') }}"></script>
<!-- popper js -->
<script src="{{ asset('dash/js/6871-js-popper1.min.js') }}"></script>
<!-- bootstarp js -->
<script src="{{ asset('dash/js/2924-js-bootstrap1.min.js') }}"></script>
<!-- sidebar menu  -->
<script src="{{ asset('dash/js/2850-js-metisMenu.js') }}"></script>
<!-- waypoints js -->
<script src="{{ asset('dash/js/count_up-jquery.waypoints.min.js') }}"></script>
<!-- waypoints js -->
<script src="{{ asset('dash/js/chartlist-Chart.min.js') }}"></script>
<!-- counterup js -->
<script src="{{ asset('dash/js/count_up-jquery.counterup.min.js') }}"></script>

<!-- nice select -->
<script src="{{ asset('dash/js/js-jquery.nice-select.min.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('dash/js/js-owl.carousel.min.js') }}"></script>

<!-- responsive table -->
<script src="{{ asset('dash/js/js-jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dash/js/js-dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dash/js/js-dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dash/js/js-buttons.flash.min.js') }}"></script>
<script src="{{ asset('dash/js/js-jszip.min.js') }}"></script>
<script src="{{ asset('dash/js/js-pdfmake.min.js') }}"></script>
<script src="{{ asset('dash/js/js-vfs_fonts.js') }}"></script>
<script src="{{ asset('dash/js/js-buttons.html5.min.js') }}"></script>
<script src="{{ asset('dash/js/js-buttons.print.min.js') }}"></script>


<script src="{{ asset('dash/js/9472-js-chart.min.js') }}"></script>
<!-- progressbar js -->
<script src="{{ asset('dash/js/progressbar-jquery.barfiller.js') }}"></script>
<!-- tag input -->
<script src="{{ asset('dash/js/tagsinput-tagsinput.js') }}"></script>
<!-- text editor js -->
<script src="{{ asset('dash/js/text_editor-summernote-bs4.js') }}"></script>
<script src="{{ asset('dash/js/am_chart-amcharts.js') }}"></script>

<!-- scrollabe  -->
<script src="{{ asset('dash/js/scroll-perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dash/js/scroll-scrollable-custom.js') }}"></script>


<script src="{{ asset('dash/js/chart_am-core.js') }}"></script>
<script src="{{ asset('dash/js/chart_am-charts.js') }}"></script>
<script src="{{ asset('dash/js/chart_am-animated.js') }}"></script>
<script src="{{ asset('dash/js/chart_am-kelly.js') }}"></script>
<script src="{{ asset('dash/js/chart_am-chart-custom.js') }}"></script>
<!-- custom js -->


<script src="{{ asset('dash/js/9118-js-custom.js') }}"></script>
<script src="{{ asset('dash/js/bootstrap.bundle.min.js') }}" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>



<style>
.lms_table_active th,
.lms_table_active td {
  font-size: 14px !important; 
  color: #212529; 
  vertical-align: middle;
}

.lms_table_active {
  border-collapse: collapse;
  width: 100%;
  border-top: 2px solid #dee2e6;  
  border-bottom: 2px solid #2a2a2b; 
}

</style>

<script>
document.addEventListener('click', async (e) => {
  const btn = e.target.closest('.btn-lihat');
  if (!btn) return;

  const url   = btn.dataset.url;
  const modal = document.getElementById('lihatModal');

  // helper isi field
  const fill = (name, val) => {
    modal.querySelector(`[data-field="${name}"]`).textContent = (val ?? '-') || '-';
  };

  try {
    const res = await fetch(url, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    if (!res.ok) throw new Error('Gagal mengambil data insiden');

    const d = await res.json();

    fill('tanggal_insiden',   d.tanggal_insiden);
    fill('tanggal_close',     d.tanggal_close);
    fill('tower',             d.tower);
    fill('jenis_insiden',     d.jenis_insiden);
    fill('status_insiden',    d.status_insiden);
    fill('pelapor',           d.pelapor);
    fill('deskripsi_insiden', d.deskripsi_insiden);
    fill('catatan_perbaikan', d.catatan_perbaikan);
  } catch (err) {
    console.error(err);
  }
});
</script>



</body>
</html>
