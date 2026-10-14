@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header text-white d-flex justify-content-between align-items-center"
                        style="background-color: #43c7d6;">
                        <h4 class="mb-0">Dashboard Peserta</h4>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light text-dark fw-bold">Logout</button>
                        </form>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <h5 class="fw-bold mb-2">Halo, {{ $user->name }}! 👋</h5>
                        <p class="text-muted">Selamat datang di portal sertifikasi Anda. Berikut adalah informasi data diri
                            dan status sertifikasi Anda saat ini.</p>

                        <hr>

                        {{-- Cek apakah user sudah mengisi no_hp (artinya profil sudah lengkap) --}}
                        @if ($user->no_hp)
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold" style="width: 30%;">Nama Lengkap</td>
                                        <td>: {{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Email</td>
                                        <td>: {{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">No. Handphone</td>
                                        <td>: {{ $user->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Alamat</td>
                                        <td>: {{ $user->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Skema Sertifikasi</td>
                                        <td>: {{ $skema->nama_skema ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Status Sertifikasi</td>
                                        <td>:
                                            <span class="badge bg-warning text-dark">
                                                {{ $peserta->status_sertifikasi ?? 'Pending (Menunggu Validasi Admin)' }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ route('user.profile') }}" class="btn text-white fw-bold w-100 mt-3"
                                style="background-color: #43c7d6;">Edit / Perbarui Data Diri Saya</a>
                        @else
                            <div class="alert alert-warning text-center">
                                Data diri peserta Anda belum tersedia. Silakan lengkapi data diri Anda terlebih dahulu.
                            </div>
                            <a href="{{ route('user.profile') }}" class="btn text-white fw-bold w-100 mt-3"
                                style="background-color: #43c7d6;">Lengkapi Data Diri Sekarang</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
