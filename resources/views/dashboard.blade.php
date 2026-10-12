@extends('layouts.app')

@section('content')
    <h3 class="mb-4 font-weight-bold">Dashboard Admin</h3>

    <div class="row">
        <div class="col-12">
            <div class="card bg-primary text-white shadow border-0 mb-3">
                <div class="card-body py-4">
                    <h6 class="card-title text-uppercase">Total Skema</h6>
                    <h2 class="display-5 fw-bold">{{ $totalSkema }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card bg-warning text-white shadow border-0 mb-3">
                <div class="card-body py-4">
                    <h6 class="card-title text-uppercase">Total Peserta</h6>
                    <h2 class="display-5 fw-bold">{{ $totalPeserta }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card bg-success text-white shadow border-0 mb-3">
                <div class="card-body py-4">
                    <h6 class="card-title text-uppercase">Peserta Lulus</h6>
                    <h2 class="display-5 fw-bold">{{ $pesertaLulus }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
    