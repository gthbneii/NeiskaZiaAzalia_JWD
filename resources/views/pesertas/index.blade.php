@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Peserta Sertifikasi</h4>
        <a href="{{ route('pesertas.create') }}" class="btn btn-primary">Tambah Peserta</a>
    </div>

    <div class="card shadow border-0 mb-3">
        <div class="card-body">
            <form action="{{ route('pesertas.index') }}" method="GET" class="row g-2">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau email peserta..."
                        value="{{ $search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>Skema Sertifikasi</th>
                        <th>Status</th>
                        <th>Alat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesertas as $index => $peserta)
                        <tr>
                            <td>{{ $pesertas->firstItem() + $index }}</td>
                            <td>{{ $peserta->nama_peserta }}</td>
                            <td>{{ $peserta->email }}</td>
                            <td><span class="badge bg-secondary">{{ $peserta->skema->nama_skema ?? '-' }}</span></td>
                            <td>
                                <span
                                    class="badge bg-{{ $peserta->status_sertifikasi == 'Lulus'
                                        ? 'success'
                                        : ($peserta->status_sertifikasi == 'Pending'
                                            ? 'warning'
                                            : 'danger') }}">
                                    {{ $peserta->status_sertifikasi }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('pesertas.show', $peserta->id) }}"
                                    class="btn btn-info btn-sm text-white">Detail</a>
                                <a href="{{ route('pesertas.edit', $peserta->id) }}"
                                    class="btn btn-warning btn-sm text-white">Edit</a>
                                <form action="{{ route('pesertas.destroy', $peserta->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Data Peserta Tidak Ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $pesertas->links() }}
        </div>
    </div>
@endsection
