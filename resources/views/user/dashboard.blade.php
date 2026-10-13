@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header text-white d-flex justify-content-between align-items-center"
                        style="background-color: #43c7d6;">
                        <h4 class="mb-0">Dashboard User / Peserta</h4>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light text-dark fw-bold">Logout</button>
                        </form>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <h5 class="fw-bold mb-3">Selamat Datang, {{ Auth::user()->name }}! 👋</h5>
                        <p class="text-muted">Ini adalah halaman dashboard akun Anda. Silakan lengkapi data diri atau cek
                            status sertifikasi Anda di bawah ini.</p>

                        <hr>

                        @if ($peserta)
                            <div class="mb-3">
                                <strong>Status Pendaftaran:</strong>
                                <span class="badge bg-success">Terdaftar</span>
                            </div>
                            <div class="mb-3">
                                <strong>Nama Lengkap:</strong> {{ $peserta->nama_lengkap }}
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong> {{ $peserta->email }}
                            </div>
                            <div class="mb-3">
                                <strong>No. Handphone:</strong> {{ $peserta->no_hp }}
                            </div>
                            <div class="mb-3">
                                <strong>Status Sertifikasi:</strong>
                                <span
                                    class="badge
                                @if ($peserta->status_sertifikasi == 'Lulus') bg-success
                                @elseif($peserta->status_sertifikasi == 'Tidak Lulus') bg-danger
                                @else bg-warning text-dark @endif">
                                    {{ $peserta->status_sertifikasi }}
                                </span>
                            </div>

                            <a href="{{ route('user.profile') }}" class="btn text-white fw-bold w-100"
                                style="background-color: #43c7d6;">Edit / Perbarui Data Diri</a>
                        @else
                            <div class="alert alert-warning">
                                Anda belum melengkapi data diri peserta. Silakan lengkapi data Anda terlebih dahulu agar
                                terdaftar dalam skema sertifikasi.
                            </div>
                            <a href="{{ route('user.profile') }}" class="btn text-white fw-bold w-100"
                                style="background-color: #43c7d6;">Lengkapi Data Diri Sekarang</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
