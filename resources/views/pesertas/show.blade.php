@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">Detail Peserta Sertifikasi</h5>
                </div>
                <div class="card-body p-4">
                    <table class="table table-borderless">
                        <tr>
                            <th width="35%">Nama Peserta</th>
                            <td>: {{ $peserta->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $peserta->email }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon/HP</th>
                            <td>: {{ $peserta->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $peserta->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Skema Sertifikasi</th>
                            <td>: {{ $peserta->skema->nama_skema ?? '-' }} ({{ $peserta->skema->jenis_skema ?? '-' }})</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:
                                <span
                                    class="badge bg-{{ $peserta->status_sertifikasi == 'Lulus'
                                        ? 'success'
                                        : ($peserta->status_sertifikasi == 'Pending'
                                            ? 'warning'
                                            : 'danger') }}">
                                    {{ $peserta->status_sertifikasi }}
                                </span>
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('pesertas.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
