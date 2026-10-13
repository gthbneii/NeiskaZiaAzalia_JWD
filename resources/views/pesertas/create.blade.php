@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header text-white py-3" style="background-color: #43c7d6;">
                    <h5 class="mb-0 fw-bold">Tambah Data Peserta</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pesertas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Pilih User / Peserta yang Mendaftar</label>
        <select name="user_id" class="form-select" required>
            <option value="">--- Pilih User ---</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Skema Sertifikasi</label>
        <select name="skema_id" class="form-select" required>
            <option value="">--- Pilih Skema ---</option>
            @foreach ($skemas as $skema)
                <option value="{{ $skema->id }}">{{ $skema->kode_skema }} - {{ $skema->nama_skema }}</option>
            @endforeach
        </select>
    </div>

        <label class="form-label">Status Sertifikasi</label>
        <select name="status_sertifikasi" class="form-select" required>
            <option value="Pending">Pending</option>
            <option value="Kompeten">Kompeten</option>
            <option value="Belum Kompeten">Belum Kompeten</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Data Peserta</button>
</form>
                </div>
            </div>
        </div>
    </div>
@endsection
