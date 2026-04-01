@extends('layouts.template')
@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    {{-- Leaflet Draw CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />

    <style>
        #map {
            height: calc(100vh - 56px);
            /* Mengurangi tinggi navbar */
        }
    </style>
@endsection

@section('content')
    <!-- Container untuk Peta -->
    <div id="map"></div>

    {{-- Modal Form Input Point --}}
    <div class="modal" tabindex="-1" id="inputPointModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Titik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('points.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Isikan Nama Titik">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Isikan Deskripsi Titik" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometri_point" class="form-label">Geometri</label>
                            <textarea class="form-control" id="geometri_point" name="geometri_point" placeholder="Isikan Geometri Titik"
                                rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Form Input Polyline --}}
    <div class="modal" tabindex="-1" id="inputPolylineModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Polyline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polyline.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Isikan Nama Polyline">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Isikan Deskripsi Polyline" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometri_polyline" class="form-label">Geometri</label>
                            <textarea class="form-control" id="geometri_polyline" name="geometri_polyline" placeholder="Isikan Geometri Polyline"
                                rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Form Input Polygon --}}
    <div class="modal" tabindex="-1" id="inputPolygonModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Polygon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polygon.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Isikan Nama Polygon">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Isikan Deskripsi Polygon" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometri_polygon" class="form-label">Geometri</label>
                            <textarea class="form-control" id="geometri_polygon" name="geometri_polygon" placeholder="Isikan Geometri Polygon"
                                rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- Leaflet Draw JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    {{-- Terraformer JS      --}}
    <script src="https://unpkg.com/@terraformer/wkt"></script>

    {{-- JQuery JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Koordinat Yogyakarta, Indonesia
        const yogyakarta = [-7.7956, 110.3695];

        // Inisialisasi peta
        const map = L.map('map').setView(yogyakarta, 13);

        // Menambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Opsional: Menambahkan marker di pusat Yogyakarta
        L.marker(yogyakarta).addTo(map)
            .bindPopup('Yogyakarta')
            .openPopup();

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            console.log(drawnJSONObject);
            console.log(objectGeometry);

            if (type === 'polyline') {
                console.log("Create " + type);
                // set value geometri to geometri_polyline textarea
                $('#geometri_polyline').val(objectGeometry);

                // Show Modal Form Input Polyline
                $('#inputPolylineModal').modal('show');

                // modal dismiss reload page
                $('#inputPolylineModal').on('hidden.bs.modal', function() {
                    location.reload();
                });

            } else if (type === 'polygon' || type === 'rectangle') {
                console.log("Create " + type);
                // set value geometri to geometri_polygon textarea
                $('#geometri_polygon').val(objectGeometry);

                // Show Modal Form Input Polygon
                $('#inputPolygonModal').modal('show');

                // modal dismiss reload page
                $('#inputPolygonModal').on('hidden.bs.modal', function() {
                    location.reload();
                });

            } else if (type === 'marker') {
                console.log("Create " + type);

                // set value geometri to geometri_point textarea
                $('#geometri_point').val(objectGeometry);

                // Show Modal Form Input Point
                $('#inputPointModal').modal('show');

                // modal dismiss reload page
                $('#inputPointModal').on('hidden.bs.modal', function() {
                    location.reload();
                });
            } else {
                console.log('__undefined__');
            }

            drawnItems.addLayer(layer);
        });
    </script>
@endsection
