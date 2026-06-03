@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .hero-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        .hero-title {
            color: #0d6efd;
            font-weight: 700;
        }
        /* Style baru untuk Card Statistik */
        .stat-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        }
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
    </style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="hero-section px-4 px-md-5 shadow-sm">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">Sistem Informasi Geografis</span>
                <h1 class="display-5 hero-title mb-3">Jelajahi Keindahan Yogyakarta dalam Satu Peta Interaktif</h1>

                <p class="lead text-muted mb-4" style="text-align: justify; line-height: 1.7;">
                    Selamat datang di <strong>Web Interaktif Wisata Yogyakarta</strong>! Aplikasi berbasis spasial ini dirancang khusus untuk memandu perjalanan Anda menemukan sudut-sudut terbaik di Kota Gudeg. Melalui visualisasi peta digital yang dinamis, Anda dapat dengan mudah mengeksplorasi lokasi, jangkauan rute, informasi mendalam, hingga dokumentasi visual dari berbagai destinasi populer maupun permata tersembunyi <em>(hidden gems)</em> secara presisi.
                </p>

                <div class="d-grid d-md-flex justify-content-md-start gap-3 mb-4">
                    <a href="{{ route('peta') }}" class="btn btn-primary btn-lg px-4 me-md-2 rounded-pill shadow-sm">
                        <i class="bi bi-map-fill me-2"></i> Buka Peta Wisata
                    </a>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block text-center">
                <img src="https://images.unsplash.com/photo-1604999333679-b86d54738315?q=80&w=600" class="img-fluid" alt="Yogyakarta" style="max-height: 320px; border-radius: 12px; object-fit: cover;">
            </div>
        </div>
    </div>

    <h4 class="fw-bold mb-3 text-secondary"><i class="bi bi-speedometer2 me-2"></i>Ikhtisar Data Spasial</h4>
    <div class="row g-4 mb-5">

        <div class="col-6 col-md-3">
            <div class="card stat-card bg-primary text-white h-100 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase fw-semibold mb-1" style="font-size: 0.85rem; opacity: 0.9;">Jumlah Point</h6>
                        <h2 class="display-6 fw-bold mb-0">
                            {{ $points_count }}
                        </h2>
                    </div>
                    <i class="bi bi-geo-alt-fill stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card bg-success text-white h-100 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase fw-semibold mb-1" style="font-size: 0.85rem; opacity: 0.9;">Jumlah Polyline</h6>
                        <h2 class="display-6 fw-bold mb-0">
                            {{ $polylines_count }}
                        </h2>
                    </div>
                    <i class="bi bi-signpost-split-fill stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card bg-warning text-dark h-100 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase fw-semibold mb-1" style="font-size: 0.85rem; opacity: 0.9;">Jumlah Polygon</h6>
                        <h2 class="display-6 fw-bold mb-0">
                            {{ $polygon_count }}
                        </h2>
                    </div>
                    <i class="bi bi-bounding-box-circles stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card bg-dark text-white h-100 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase fw-semibold mb-1" style="font-size: 0.85rem; opacity: 0.9;">Jumlah User</h6>
                        <h2 class="display-6 fw-bold mb-0">
                            {{ $user_count }}
                        </h2>
                    </div>
                    <i class="bi bi-people-fill stat-icon"></i>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
