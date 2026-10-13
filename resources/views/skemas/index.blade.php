@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Skema Sertifikasi</h4>
        <a href="{{ route('skemas.create') }}" class="btn btn-primary">Tambah Skema</a>
    </div>

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 0.9rem;">
            <i class="fa-solid fa-circle-info me-1"></i> {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0 mb-3">
        <div class="card-body">
            <form action="{{ route('skemas.index') }}" method="GET" class="row g-2">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Cari skema..."
                        value="{{ $search ?? request('search') }}">
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
                        <th>Kode Skema</th>
                        <th>Nama Skema</th>
                        <th>Jenis Skema</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skemas as $index => $skema)
                        <tr>
                            <td>{{ $skemas->firstItem() + $index }}</td>
                            <td><code>{{ $skema->kode_skema }}</code></td>
                            <td>{{ $skema->nama_skema }}</td>
                            <td>{{ $skema->jenis_skema }}</td>
                            <td>
                                <a href="{{ route('skemas.edit', $skema->id) }}"
                                    class="btn btn-warning btn-sm text-white">Edit</a>
                                <form action="{{ route('skemas.destroy', $skema->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus skema ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Data Skema tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        {{ $skemas->appends(['search' => $search])->links() }}
    </div>
@endsection
