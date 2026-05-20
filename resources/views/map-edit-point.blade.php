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

{{-- Modal Form Edit --}}
<div class="modal" tabindex="-1" id="ModalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Titik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('points.update', ':id') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                        <label for="geometri" class="form-label">Geometri</label>
                        <textarea class="form-control" id="geometri" name="geometri" placeholder="Isikan Geometri Titik"
                            rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                            onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb-3">
                        <img src="" alt="" id="preview-image" class="img-thumbnail"
                            width="400">
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
        draw: false,
        edit: {
            featureGroup: drawnItems,
            edit: true,
            remove: false
        }
    });

    map.addControl(drawControl);

    map.on('draw:edited', function(e) {
        var layers = e.layers;

        layers.eachLayer(function(layer) {
            var drawnJSONObject = layer.toGeoJSON();
            console.log(drawnJSONObject);

            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
            console.log(objectGeometry);

            // layer properties
            var properties = drawnJSONObject.properties;
            console.log(properties);

            drawnItems.addLayer(layer);

            // mengisi form edit dengan data dari layer yang diedit
            $('#nama').val(properties.name);
            $('#deskripsi').val(properties.description);
            $('#geometri').val(objectGeometry);
            $('#preview-image').attr('src', "{{ asset('storage/images') }}/" + properties.image);

            // menampilkan modal form edit
            $('#ModalEdit').modal('show');
        });
    });

    // GeoJSON Points
    var points = L.geoJSON(null, {
        // Style

        // onEachFeature
        onEachFeature: function(feature, layer) {
            // memasukkan layer ke dalam drawnItems agar bisa diedit
            drawnItems.addLayer(layer);

            layer.on({
                click: function(e) {

                },
            });
        },

    });
    $.getJSON("{{ route('geojson_point', $id) }} ",
        function(data) {
            points.addData(data);
            map.addLayer(points);
        });
</script>
@endsection
