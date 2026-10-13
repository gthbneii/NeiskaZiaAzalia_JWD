@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Tambah Skema Sertifikasi</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('skemas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kode Skema</label>
                            <input type="text" name="kode_skema"
                                class="form-control @error('kode_skema') is-invalid @enderror"
                                value="{{ old('kode_skema') }}" placeholder="SKM-001">
                            @error('kode_skema')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Skema</label>
                            <input type="text" name="nama_skema"
                                class="form-control @error('nama_skema') is-invalid @enderror"
                                value="{{ old('nama_skema') }}" placeholder="Junior Web Developer">
                            @error('nama_skema')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Skema</label>
                            <select name="jenis_skema" class="form-select @error('jenis_skema') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Jenis Skema --</option>
                                <option value="Okupasi" {{ old('jenis_skema') == 'Okupasi' ? 'selected' : '' }}>Okupasi
                                </option>
                                <option value="KKNI" {{ old('jenis_skema') == 'KKNI' ? 'selected' : '' }}>KKNI</option>
                                <option value="Klaster" {{ old('jenis_skema') == 'Klaster' ? 'selected' : '' }}>Klaster
                                </option>
                            </select>
                            @error('jenis_skema')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                         <button type="submit" class="btn text-white fw-bold" style="background-color: #43c7d6;">Simpan
                            Data</button>
                        <a href="{{ route('skemas.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
