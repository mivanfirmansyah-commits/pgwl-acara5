@extends('layouts.template')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                    <div class="bg-primary p-4 text-center text-white">
                        <div class="mb-3">
                            <i class="bi bi-person-badge-fill" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-1">M. Ivan Firmansyah</h3>
                        <span class="badge bg-light text-primary px-3 rounded-pill">Developer / Student</span>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <small class="text-muted d-block">NIM</small>
                                <span class="fw-semibold text-dark">24/535333/SV/24201</span>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted d-block">Angkatan</small>
                                <span class="fw-semibold text-dark">SIG'24</span>
                            </div>

                            <hr class="my-2 opacity-10">

                            <div class="col-12">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-box bg-primary-subtle text-primary rounded-3 p-2 me-3">
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Mata Kuliah</small>
                                        <span class="fw-bold text-dark text-uppercase">Pemrograman Geospasial Web
                                            Lanjut</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box bg-success-subtle text-success rounded-3 p-2 me-3">
                                        <i class="bi bi-door-open-fill"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Kelas</small>
                                        <span class="fw-bold text-dark">PGWL A</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light border-0 py-3 text-center">
                        <p class="mb-0 text-muted small">Dibuat dengan ❤️ untuk Pengembangan Sistem Informasi Geografis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
