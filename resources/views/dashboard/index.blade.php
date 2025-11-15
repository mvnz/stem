@extends('layouts.app')

@section('content')
<style>
    svg.w-5.h-5 {
        width: 14px !important;
        height: 14px !important;
    }
</style>
    <div class="row">
        <div class="col-12">
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="main_content_iner ">
        <div class="container-fluid p-0 ">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quick_activity_wrap">
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Jumlah Tempat Sampah</p>
                                                <h3><span class="counter">{{ $jmlTempatSampah }}</span> </h3>
                                            </div>
                                            <a href="#" class="notification_btn">per/{{ now()->format('Y-m-d') }}</a>
                                        </div>
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Jumlah Jenis Sampah</p>
                                                <h3><span class="counter">35000</span> </h3>
                                            </div>
                                            <a href="#" class="notification_btn yellow_btn">per/{{ now()->format('Y-m-d') }}</a>

                                        </div>
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Jumlah Data Training</p>
                                                <h3><span class="counter">50000</span> </h3>
                                                </div>
                                                <a href="#" class="notification_btn green_btn">per/{{ now()->format('Y-m-d') }}</a>
                                                
                                        </div>
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Jumlah Insiden</p>
                                                <h3><span class="counter">{{ $jmlInsidenOpen }}</span></h3>
                                            </div>
                                            <a href="#" class="notification_btn violate_btn">per/{{ now()->format('Y-m-d') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h4 class="m-0">Monitoring Tempat Sampah</h3>
                                </div>
                                <div class="header_more_tool">
                                    status : connected
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body p-0">
                            

                            
<canvas id="trashChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('trashChart').getContext('2d');
    let trashChart = null;

    async function loadTrashData() {
        try {
            const res = await fetch('{{ route('dashboard.trash-data') }}'); // route baru untuk data chart
            const data = await res.json();

            const labels = data.labels;
            const values = data.values;

            if (!trashChart) {
                trashChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Volume (cm)',
                            data: values,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    callback: function (value) {
                                        return value.toFixed(1);
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        return context.parsed.y.toFixed(1);
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                trashChart.data.labels = labels;
                trashChart.data.datasets[0].data = values;
                trashChart.update();
            }
        } catch (e) {
            console.error('Gagal load data chart:', e);
        }
    }

    loadTrashData();

    setInterval(loadTrashData, 5000); //update tiap 5 detik
</script>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h4 class="m-0">Daftar Piket Petugas Kebersihan</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="equal_hdr mb_15 d-flex justify-content-between align-items-center flex-wrap">
                                <h4 class="f_s_28 f_w_700">{{ now()->format('Y-m-d') }}</h4>
                                <a href="#" class="Euro_btn">{{ now()->format('l') }}</a>
                            </div>
                            <div>
                                <div class="row mb-3" style="border-bottom:1px solid #eee">
                                    <div class="col-sm-2">
                                        <strong>Shift</strong>
                                    </div>
                                    <div class="col-sm-5">
                                        <strong>Nama</strong>
                                    </div>
                                    <div class="col-sm-5">
                                        <strong>Tower</strong>
                                    </div>
                                </div>
                            </div>
                            @php
                                $shifts = ['Pagi', 'Siang', 'Malam'];  // sesuaikan dengan value di DB
                            @endphp

                            @foreach ($shifts as $shift)
                                @php
                                    /** @var \Illuminate\Support\Collection $items */
                                    $items = $jadwalPerShift[$shift] ?? collect();
                                @endphp

                                <div class="row mb-4 pb-3" style="border-bottom:1px solid #eee">
                                    <div class="col-sm-2">
                                        <strong>{{ $shift }}</strong>
                                    </div>

                                    {{-- Nama Petugas --}}
                                    <div class="col-sm-5">
                                        @if ($items->isEmpty())
                                            -
                                        @else
                                            {{ $items->pluck('pegawai.nama_pegawai')->implode(', ') }}
                                        @endif
                                    </div>

                                    {{-- Tower (sebenarnya sama semua karena per tower), tapi tetap bisa ditulis --}}
                                    <div class="col-sm-5">
                                        @if ($items->isEmpty())
                                            -
                                        @else
                                            {{ $currentTower->nama_tower }}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div id="area-spaline"></div>
                        <div class="d-flex justify-content-between align-items-center mt-3">

                                {{-- Left: Info --}}
                                <div class="text-muted small">
                                    Showing {{ $towers->firstItem() }} to {{ $towers->lastItem() }} of {{ $towers->total() }} results
                                </div>

                                {{-- Right: Custom Pagination --}}
                                <nav>
                                    <ul class="pagination mb-0">

                                        {{-- Previous --}}
                                        @if ($towers->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link custom-page">‹< </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link custom-page" href="{{ $towers->previousPageUrl() }}">‹< </a>
                                            </li>
                                        @endif

                                        {{-- Page Numbers --}}
                                        @foreach ($towers->links()->elements[0] ?? [] as $page => $url)
                                            @if ($page == $towers->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link custom-page">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link custom-page" href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next --}}
                                        @if ($towers->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link custom-page" href="{{ $towers->nextPageUrl() }}"> >›</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link custom-page"> >›</span>
                                            </li>
                                        @endif

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection