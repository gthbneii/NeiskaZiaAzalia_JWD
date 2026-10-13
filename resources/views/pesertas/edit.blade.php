@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header text-white d-flex justify-content-between align-items-center"
                        style="background-color: #43c7d6;">
                        <h4 class="mb-0">Edit Data Peserta</h4>
                        <a href="{{ route('pesertas.index') }}" class="btn btn-sm btn-light text-dark fw-bold">Kembali ke Daftar</a>
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

                        <form action="{{ route('pesertas.update', $peserta->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Pilih User / Peserta</label>
                                <select name="user_id" id="user_select" class="form-select" required>
                                    <option value="">--- Pilih User ---</option>
                                    @foreach ($users as $user)
                                        @php
                                            $pesertaData = \App\Models\Peserta::where('user_id', $user->id)->first();
                                        @endphp
                                        <option value="{{ $user->id }}" 
                                            data-email="{{ $user->email }}"
                                            data-nohp="{{ $pesertaData->no_hp ?? '-' }}"
                                            data-alamat="{{ $pesertaData->alamat ?? '-' }}"
                                            {{ $peserta->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kotak Informasi Data Diri User -->
                            <div id="info_peserta" class="card bg-light mb-3 p-3">
                                <h6 class="fw-bold text-secondary mb-2">Informasi Data Diri Peserta:</h6>
                                <p class="mb-1"><strong>Email:</strong> <span id="val_email">{{ $peserta->email ?? '-' }}</span></p>
                                <p class="mb-1"><strong>No. HP:</strong> <span id="val_nohp">{{ $peserta->no_hp ?? '-' }}</span></p>
                                <p class="mb-0"><strong>Alamat:</strong> <span id="val_alamat">{{ $peserta->alamat ?? '-' }}</span></p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Skema Sertifikasi</label>
                                <select name="skema_id" class="form-select" required>
                                    <option value="">--- Pilih Skema ---</option>
                                    @foreach ($skemas as $skema)
                                        <option value="{{ $skema->id }}" {{ $peserta->skema_id == $skema->id ? 'selected' : '' }}>
                                            {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Sertifikasi</label>
                                <select name="status_sertifikasi" class="form-select" required>
                                    <option value="Pending" {{ $peserta->status_sertifikasi == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Kompeten" {{ $peserta->status_sertifikasi == 'Kompeten' ? 'selected' : '' }}>Kompeten</option>
                                    <option value="Belum Kompeten" {{ $peserta->status_sertifikasi == 'Belum Kompeten' ? 'selected' : '' }}>Belum Kompeten</option>
                                </select>
                            </div>

                            <button type="submit" class="btn text-white w-100 fw-bold py-2" style="background-color: #43c7d6;">Perbarui Data Peserta</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk memperbarui info data diri otomatis saat user diganti --}}
    <script>
        document.getElementById('user_select').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            if (this.value) {
                document.getElementById('val_email').innerText = selectedOption.getAttribute('data-email');
                document.getElementById('val_nohp').innerText = selectedOption.getAttribute('data-nohp');
                document.getElementById('val_alamat').innerText = selectedOption.getAttribute('data-alamat');
            } else {
                document.getElementById('val_email').innerText = '-';
                document.getElementById('val_nohp').innerText = '-';
                document.getElementById('val_alamat').innerText = '-';
            }
        });
    </script>
@endsection