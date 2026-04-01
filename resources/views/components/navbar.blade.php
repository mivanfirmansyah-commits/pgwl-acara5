<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">{{ $title }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" @if(request()->routeIs('home')) aria-current="page" @endif href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('peta') ? 'active' : '' }}" @if(request()->routeIs('peta')) aria-current="page" @endif href="{{ route('peta') }}">Peta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('table') ? 'active' : '' }}" @if(request()->routeIs('table')) aria-current="page" @endif href="{{ route('table') }}">Tabel</a>
                    </li>
                    <li class="nav-item">
                        {{-- Pastikan Anda memiliki route dengan nama 'tentang' di routes/web.php --}}
                        <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" @if(request()->routeIs('tentang')) aria-current="page" @endif href="{{ route('tentang') }}">Tentang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
