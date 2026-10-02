<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    @auth
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4 py-3" style="background-color: #43c7d6 !important;">
            <div class="container">
                <a class="navbar-brand fw-bold fs-4 text-white" href="{{ route('dashboard') }}">App Sertifikasi</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5 {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                                href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5 {{ request()->routeIs('skemas.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('skemas.index') }}">Data Skema</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5 {{ request()->routeIs('pesertas.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('pesertas.index') }}">Data Peserta</a>
                        </li>
                    </ul>
                    <form action="{{ route('logout') }}" method="POST" class="d-flex">
                        @csrf
                        <button type="submit" class="btn btn-outline-light fs-6">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <div class="container mb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-3" role="alert">
                <strong>Berhasil !</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-3" role="alert">
                <strong>Gagal !</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
