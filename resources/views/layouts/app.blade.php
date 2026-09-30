<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Data Peserta Sertifikasi - USK 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    @auth
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">App Sertifikasi</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('skemas.index') }}">Data Skema</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pesertas.index') }}">Data Peserta</a>
                        </li>
                    </ul>
                    <form action="{{ route('logout') }}" method="POST" class="d-flex">
                        @csrf
                        <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <div class="container mb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
