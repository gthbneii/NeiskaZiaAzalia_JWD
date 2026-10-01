@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header text-white fw-bold" style="background-color: #008080;">
                    Edit Skema
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('skemas.update', $skema->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Kode Skema</label>
                            <input type="text" name="kode_skema" class="form-control"
                                value="{{ old('kode_skema', $skema->kode_skema) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Skema</label>
                            <input type="text" name="nama_skema" class="form-control"
                                value="{{ old('nama_skema', $skema->nama_skema) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Skema</label>
                            <select name="jenis_skema" class="form-select" required>
                                <option value="">-- Jenis Skema --</option>
                                <option value="Okupasi"
                                    {{ old('jenis_skema', $skema->jenis_skema) == 'Okupasi' ? 'selected' : '' }}>Okupasi
                                </option>
                                <option value="KKNI"
                                    {{ old('jenis_skema', $skema->jenis_skema) == 'KKNI' ? 'selected' : '' }}>KKNI</option>
                                <option value="Klaster"
                                    {{ old('jenis_skema', $skema->jenis_skema) == 'Klaster' ? 'selected' : '' }}>Klaster
                                </option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('skemas.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn text-white" style="background-color: #008080;">Update
                                Skema</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
