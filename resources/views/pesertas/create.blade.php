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
                            <label class="form-label">Skema Sertifikasi</label>
                            <select name="skema_id" class="form-select @error('skema_id') is-invalid @enderror"
                                onfocus="this.size=4;" onblur="this.size=1;" onchange="this.size=1; this.blur();">
                                <option value="">--- Pilih Skema ---</option>
                                @foreach ($skemas as $skema)
                                    <option value="{{ $skema->id }}"
                                        {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                                        - {{ $skema->kode_skema }} {{ $skema->nama_skema }}
                                    </option>
                                @endforeach
                            </select>
                            @error('skema_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap"
                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                value="{{ old('nama_lengkap') }}" placeholder="Contoh: Neiska Zia Azalia"
                                autocomplete="off">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="Contoh: nza@gmail.com" autocomplete="off">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. Telepon/HP</label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" maxlength="12"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
                                placeholder="Alamat lengkap...">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Sertifikasi</label>
                            <select name="status_sertifikasi"
                                class="form-select @error('status_sertifikasi') is-invalid @enderror">
                                <option value="">--- Tentukan Status Kelulusan ---</option>
                                <option value="Pending" {{ old('status_sertifikasi') == 'Pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="Lulus" {{ old('status_sertifikasi') == 'Lulus' ? 'selected' : '' }}>Lulus
                                </option>
                                <option value="Tidak Lulus"
                                    {{ old('status_sertifikasi') == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                            </select>
                            @error('status_sertifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn text-white fw-bold" style="background-color: #43c7d6;">Simpan
                            Data</button>
                        <a href="{{ route('pesertas.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
