@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">
    <style>
        .container-custom {
            margin-top: 30px;
            margin-bottom: 40px;
        }
        /* Custom Header agar Selaras dengan Gradasi Navbar Anda */
        .card-header-custom {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            color: #ffffff;
        }
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="container container-custom">

        <!-- 1. TABEL DATA POINTS -->
        <div class="card mb-5">
            <div class="card-header card-header-custom">
                <h4 class="card-title mb-0"><i class="fas fa-map-marker-alt me-2"></i> Tabel Data Tempat Wisata Yogyakarta (Points)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle" id="tabeldatapoints">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Tempat</th>
                                <th>Deskripsi / Lokasi</th>
                                <th width="20%">Foto</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $noPoints = 1; @endphp
                            @foreach ($points as $p)
                                <tr>
                                    <td>{{ $noPoints++ }}</td>
                                    <td class="fw-bold text-secondary">{{ $p['name'] }}</td>
                                    <td>{{ $p['description'] }}</td>
                                    <td>
                                        @if(isset($p['image']) && $p['image'] != '')
                                            <img src="{{ asset('storage/images/' . $p['image']) }}" alt="Foto {{ $p['name'] }}" class="img-thumbnail" width="120">
                                        @else
                                            <span class="text-muted-custom small">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $p['created_at'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted small">
                Total Data: {{ count($points) }} tempat wisata
            </div>
        </div>

        <!-- 2. TABEL DATA POLYLINE -->
        <div class="card mb-5">
            <div class="card-header card-header-custom">
                <h4 class="card-title mb-0"><i class="fas fa-route me-2"></i> Tabel Data Rute Wisata (Polyline)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle" id="tabeldatapolylines">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Rute</th>
                                <th>Deskripsi / Lokasi</th>
                                <th width="20%">Foto</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $noPolylines = 1; @endphp
                            @foreach ($polylines as $p)
                                <tr>
                                    <td>{{ $noPolylines++ }}</td>
                                    <td class="fw-bold text-secondary">{{ $p['name'] }}</td>
                                    <td>{{ $p['description'] }}</td>
                                    <td>
                                        @if(isset($p['image']) && $p['image'] != '')
                                            <img src="{{ asset('storage/images/' . $p['image']) }}" alt="Foto {{ $p['name'] }}" class="img-thumbnail" width="120">
                                        @else
                                            <span class="text-muted-custom small">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $p['created_at'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted small">
                Total Data: {{ count($polylines) }} rute
            </div>
        </div>

        <!-- 3. TABEL DATA POLYGON -->
        <div class="card mb-4">
            <div class="card-header card-header-custom">
                <h4 class="card-title mb-0"><i class="fas fa-draw-polygon me-2"></i> Tabel Data Area Wisata (Polygon)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle" id="tabeldatapolygons">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Area</th>
                                <th>Deskripsi / Lokasi</th>
                                <th width="20%">Foto</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $noPolygons = 1; @endphp
                            @foreach ($polygons as $p)
                                <tr>
                                    <td>{{ $noPolygons++ }}</td>
                                    <td class="fw-bold text-secondary">{{ $p['name'] }}</td>
                                    <td>{{ $p['description'] }}</td>
                                    <td>
                                        @if(isset($p['image']) && $p['image'] != '')
                                            <img src="{{ asset('storage/images/' . $p['image']) }}" alt="Foto {{ $p['name'] }}" class="img-thumbnail" width="120">
                                        @else
                                            <span class="text-muted-custom small">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $p['created_at'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted small">
                Total Data: {{ count($polygons) }} area
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#tabeldatapoints');
            new DataTable('#tabeldatapolylines');
            new DataTable('#tabeldatapolygons');
        });
    </script>
@endsection
