<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Data Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    @auth
        <div class="d-flex" style="min-height: 100vh;">
            <aside class="text-white p-3 d-flex flex-column shadow"
                style="width: 280px; background-color: #43c7d6 !important; flex-shrink: 0;">
                <a href="{{ auth()->user()->role === 'admin' ? route('dashboard') : route('user.dashboard') }}"
                    class="d-flex align-items-center justify-content-center text-center mb-3 text-white text-decoration-none">
                    <span class="fs-2 fw-bold">Aplikasi Data<br>Sertifikasi</span>
                </a>
                <hr class="border-white opacity-50">

                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item mb-2">
                        <a href="{{ auth()->user()->role === 'admin' ? route('dashboard') : route('user.dashboard') }}"
                            class="nav-link text-white fs-5 {{ request()->routeIs('dashboard') || request()->routeIs('user.dashboard') ? 'active bg-white fw-bold' : '' }}"
                            style="{{ request()->routeIs('dashboard') || request()->routeIs('user.dashboard') ? 'color: #43c7d6 !important;' : '' }}">
                            <i class="bi bi-house-door me-2"></i> Dashboard
                        </a>
                    </li>

                    {{-- MENU HANYA MUNCUL UNTUK ADMIN --}}
                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item mb-2">
                            <a href="{{ route('skemas.index') }}"
                                class="nav-link text-white fs-5 {{ request()->routeIs('skemas.*') ? 'active bg-white fw-bold' : '' }}"
                                style="{{ request()->routeIs('skemas.*') ? 'color: #43c7d6 !important;' : '' }}">
                                <i class="bi bi-file-earmark-text me-2"></i> Data Skema
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('pesertas.index') }}"
                                class="nav-link text-white fs-5 {{ request()->routeIs('pesertas.*') ? 'active bg-white fw-bold' : '' }}"
                                style="{{ request()->routeIs('pesertas.*') ? 'color: #43c7d6 !important;' : '' }}">
                                <i class="bi bi-people me-2"></i> Data Peserta
                            </a>
                        </li>
                    @endif
                </ul>

                <hr class="border-white opacity-50">

                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100 fs-6 btn-logout-hover">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>

                    <style>
                        .btn-logout-hover:hover {
                            background-color: #dc3545 !important;
                            border-color: #dc3545 !important;
                            color: #ffffff !important;
                        }
                    </style>
                </form>
            </aside>

            <main class="flex-grow-1 p-4 overflow-auto">
                <div class="container-fluid">
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
            </main>
        </div>
    @else
        <div class="container py-5">
            @yield('content')
        </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
