<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PGWL' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Navbar Style */
        .navbar-custom {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.85);
            transition: color 0.3s ease;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #ffffff;
        }

        .navbar-custom .nav-link.active {
            font-weight: 600; /* Membuat link aktif sedikit lebih tebal */
        }
    </style>

    @yield('styles')
</head>
<body>
    {{-- Memasukkan komponen navbar dan meneruskan variabel title dari view --}}
    @include('components.navbar', ['title' => $title ?? 'PGWL'])

    {{-- Bagian ini akan menampilkan konten dari halaman (map, table, dll.) --}}
    <main>
        @yield('content')
    </main>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

    @include('components.toast')
</body>
</html>
