@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Data Peserta Sertifikasi</h4>
        <a href="{{ route('pesertas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            <form action="{{ route('pesertas.update', $peserta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap"
                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                        value="{{ old('nama_lengkap', $peserta->nama_lengkap) }}" required>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $peserta->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="skema_id" class="form-label">Skema Sertifikasi</label>
                    <select name="skema_id" id="skema_id" class="form-select @error('skema_id') is-invalid @enderror"
                        required>
                        <option value="">-- Pilih Skema Sertifikasi --</option>
                        @foreach ($skemas as $skema)
                            <option value="{{ $skema->id }}"
                                {{ old('skema_id', $peserta->skema_id) == $skema->id ? 'selected' : '' }}>
                                {{ $skema->nama_skema }}
                            </option>
                        @endforeach
                    </select>
                    @error('skema_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">No. HP / WhatsApp</label>
                    <input type="text" name="no_hp" id="no_hp"
                        class="form-control @error('no_hp') is-invalid @enderror"
                        value="{{ old('no_hp', $peserta->no_hp) }}" required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"
                        required>{{ old('alamat', $peserta->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status_sertifikasi" class="form-label">Status Sertifikasi</label>
                    <select name="status_sertifikasi" id="status_sertifikasi"
                        class="form-select @error('status_sertifikasi') is-invalid @enderror" required>
                        <option value="Pending"
                            {{ old('status_sertifikasi', $peserta->status_sertifikasi) == 'Pending' ? 'selected' : '' }}>
                            Pending</option>
                        <option value="Lulus"
                            {{ old('status_sertifikasi', $peserta->status_sertifikasi) == 'Lulus' ? 'selected' : '' }}>
                            Lulus</option>
                        <option value="Tidak Lulus"
                            {{ old('status_sertifikasi', $peserta->status_sertifikasi) == 'Tidak Lulus' ? 'selected' : '' }}>
                            Tidak Lulus</option>
                    </select>
                    @error('status_sertifikasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pesertas.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
