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

                </div>            
                </div>
            </div>
        </div>
    </section>
</div>
@endsection