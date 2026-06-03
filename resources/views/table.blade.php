@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">
    <style>
        .container-custom {
            margin-top: 20px;
            margin-bottom: 30px;
        }
    </style>
@endsection


@section('content')
    <!-- Container untuk Tabel -->
    <div class="container container-custom">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Tabel Data Tempat Wisata Yogyakarta</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id ="dataTable">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Tempat</th>
                                <th>Deskripsi / Lokasi</th>
                                <th>Koordinat</th>
                                <th>Foto</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($points as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td>{{ $p->coordinates }}</td>
                                    {{-- <td><img src="{{ route('points.image', ['id' => $p->id]) }}"
                                            alt="Foto {{ $p->name }}" width="100"></td> --}}
                                    <td>{{ $p->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted">
                Total Data: {{ $points->count() }} tempat wisata
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
    <script>
        new DataTable('#dataTable');
    </script>
@endsection
