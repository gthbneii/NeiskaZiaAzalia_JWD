@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header text-white d-flex justify-content-between align-items-center"
                        style="background-color: #43c7d6;">
                        <h4 class="mb-0">Tambah & Validasi Data Peserta</h4>
                        <a href="{{ route('pesertas.index') }}" class="btn btn-sm btn-light text-dark fw-bold">Kembali ke Daftar Peserta</a>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('pesertas.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Pilih User / Peserta yang Mendaftar</label>
                                <select name="user_id" id="user_select" class="form-select" required>
                                    <option value="">--- Pilih User ---</option>
                                    @foreach ($users as $user)
                                        {{-- Kita simpan data peserta ke dalam atribut data-* agar bisa dibaca JS --}}
                                        @php
                                            $pesertaData = \App\Models\Peserta::where('user_id', $user->id)->first();
                                        @endphp
                                        <option value="{{ $user->id }}" 
                                            data-email="{{ $user->email }}"
                                            data-nohp="{{ $pesertaData->no_hp ?? '-' }}"
                                            data-alamat="{{ $pesertaData->alamat ?? '-' }}"
                                            data-skema="{{ $pesertaData->skema_id ?? '' }}">
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kotak Informasi Data Diri User yang Muncul Otomatis -->
                            <div id="info_peserta" class="card bg-light mb-3 p-3 d-none">
                                <h6 class="fw-bold text-secondary mb-2">Informasi Data Diri Peserta:</h6>
                                <p class="mb-1"><strong>Email:</strong> <span id="val_email">-</span></p>
                                <p class="mb-1"><strong>No. HP:</strong> <span id="val_nohp">-</span></p>
                                <p class="mb-0"><strong>Alamat:</strong> <span id="val_alamat">-</span></p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Skema Sertifikasi</label>
                                <select name="skema_id" id="skema_id" class="form-select" required>
                                    <option value="">--- Pilih Skema ---</option>
                                    @foreach ($skemas as $skema)
                                        <option value="{{ $skema->id }}">{{ $skema->kode_skema }} - {{ $skema->nama_skema }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Sertifikasi</label>
                                <select name="status_sertifikasi" class="form-select" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Kompeten">Kompeten</option>
                                    <option value="Belum Kompeten">Belum Kompeten</option>
                                </select>
                            </div>

                            <button type="submit" class="btn text-white w-100 fw-bold py-2" style="background-color: #43c7d6;">Simpan Data Peserta</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script JavaScript untuk menampilkan data diri secara otomatis saat user dipilih --}}
    <script>
        document.getElementById('user_select').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var infoCard = document.getElementById('info_peserta');

            if (this.value) {
                document.getElementById('val_email').innerText = selectedOption.getAttribute('data-email');
                document.getElementById('val_nohp').innerText = selectedOption.getAttribute('data-nohp');
                document.getElementById('val_alamat').innerText = selectedOption.getAttribute('data-alamat');
                
                var skemaId = selectedOption.getAttribute('data-skema');
                if (skemaId) {
                    document.getElementById('skema_id').value = skemaId;
                }

                infoCard.classList.remove('d-none');
            } else {
                infoCard.classList.add('d-none');
            }
        });
    </script>
@endsection