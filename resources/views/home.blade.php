@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-content-table">
    <section class="section">
        <div class="margin-content">
            <div class="container-sm">
                <div class="section-header">
                    <h1>Selamat Datang, {{ substr(auth()->user()->name, 0, 15) }}!</h1>
                </div>
                
                {{-- Statistik Card --}}
                <div class="row mt-4">
                    <!-- Produk -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-success text-white position-relative" style="min-height:120px; border-radius:10px;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h4 class="mb-1">Produk</h4>
                                <h2 class="mb-0">{{ $productCount }}</h2>
                            </div>
                            <i class="fas fa-box-open position-absolute" style="font-size:6rem; opacity:0.1; bottom:-10px; right:10px;"></i>
                        </div>
                    </div>

                    <!-- Penjualan -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-warning text-white position-relative" style="min-height:120px; border-radius:10px;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h4 class="mb-1">Penjualan</h4>
                                <h2 class="mb-0">{{ $salesCount }}</h2>
                            </div>
                            <i class="fas fa-shopping-cart position-absolute" style="font-size:6rem; opacity:0.1; bottom:-10px; right:10px;"></i>
                        </div>
                    </div>

                    <!-- User (superadmin) -->
                    @if(auth()->user()->role == 'superadmin')
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-primary text-white position-relative" style="min-height:120px; border-radius:10px;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h4 class="mb-1">User</h4>
                                <h2 class="mb-0">{{ $userCount }}</h2>
                            </div>
                            <i class="fas fa-user position-absolute" style="font-size:6rem; opacity:0.1; bottom:-10px; right:10px;"></i>
                        </div>
                    </div>
                    @endif

                    <!-- Member -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-danger text-white position-relative" style="min-height:120px; border-radius:10px;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h4 class="mb-1">Member</h4>
                                <h2 class="mb-0">{{ $memberCount }}</h2>
                            </div>
                            <i class="fas fa-user-plus position-absolute" style="font-size:6rem; opacity:0.1; bottom:-10px; right:10px;"></i>
                        </div>
                    </div>
                </div>
                
                {{-- Grafik Section --}}
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="mb-4">Grafik Pembelian Per Hari (Bulan Ini)</h5>
                                <div class="chart-container" style="height: 400px; position: relative;">
                                    <canvas id="salesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Grafik Jumlah Stok Produk --}}
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="mb-4">Grafik Jumlah Stok Produk</h5>
                                <div class="chart-container" style="height: 400px; position: relative;">
                                    <canvas id="stockChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($salesDates),
            datasets: [{
                label: 'Jumlah Pembelian',
                data: @json($salesTotals),
                backgroundColor: '#3b82f6',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    bodyFont: {
                        size: 14
                    },
                    titleFont: {
                        size: 16
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 12
                        },
                        stepSize: 1
                    },
                    title: {
                        display: true,
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12
                        }
                    },
                    title: {
                        display: true,
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });

    const stockCtx = document.getElementById('stockChart').getContext('2d');

    new Chart(stockCtx, {
        type: 'bar',
        data: {
            labels: @json($productNames),
            datasets: [{
                label: 'Jumlah Stok',
                data: @json($productStocks),
                backgroundColor: '#10b981',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    bodyFont: {
                        size: 14
                    },
                    titleFont: {
                        size: 16
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 12
                        }
                    },
                    title: {
                        display: true,
                        text: 'Stok',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12
                        }
                    },
                    title: {
                        display: true,
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
</script>
@endpush