<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSkema = Skema::count();
        $totalPeserta = Peserta::count();
        $pesertaLulus = Peserta::where('status_sertifikasi', 'Lulus')->count();

        return view('dashboard', compact('totalSkema', 'totalPeserta', 'pesertaLulus'));
    }
}
