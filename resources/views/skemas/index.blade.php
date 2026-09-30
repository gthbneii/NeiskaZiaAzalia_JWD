@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Skema Sertifikasi</h4>
        <a href="{{ route('skemas.create') }}" class="btn btn-primary">Tambah Skema</a>
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
@endsection
