@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header text-white d-flex justify-content-between align-items-center"
                        style="background-color: #43c7d6;">
                        <h4 class="mb-0">Form Data Diri & Profil Peserta</h4>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-light text-dark fw-bold">Kembali ke
                            Dashboard</a>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.updateProfile') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Pilih Skema Sertifikasi</label>
                                <select name="skema_id" class="form-select" required>
                                    <option value="">-- Pilih Skema --</option>
                                    @foreach ($skemas as $skema)
                                        <option value="{{ $skema->id }}"
                                            {{ isset($peserta) && $peserta->skema_id == $skema->id ? 'selected' : '' }}>
                                            {{ $skema->nama_skema ?? ($skema->judulsyah ?? ($skema->nama ?? 'Skema #' . $skema->id)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    value="{{ old('nama_lengkap', $peserta->nama_lengkap ?? Auth::user()->name) }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $peserta->email ?? Auth::user()->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. Handphone</label>
                                <input type="text" name="no_hp" class="form-control"
                                    value="{{ old('no_hp', $peserta->no_hp ?? '') }}" required
                                    placeholder="Contoh: 081234567890">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required placeholder="Masukkan alamat lengkap">{{ old('alamat', $peserta->alamat ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Sertifikasi</label>
                                <input type="text" class="form-control bg-light"
                                    value="{{ $peserta->status_sertifikasi ?? 'Pending' }}" disabled>
                                <small class="text-muted">Status sertifikasi diatur sepenuhnya oleh pihak Admin.</small>
                            </div>

                            <button type="submit" class="btn text-white w-100 fw-bold py-2"
                                style="background-color: #43c7d6;">Simpan / Perbarui Data</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
