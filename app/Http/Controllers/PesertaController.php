<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pesertas = Peserta::with('skema')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('pesertas.index', compact('pesertas', 'search'));
    }

    public function create()
    {
        $skemas = Skema::all();
        return view('pesertas.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skema_id' => 'required|exists:skemas,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pesertas,email',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'status_sertifikasi' => 'required',
        ]);

        // 2. Simpan data ke database
        Peserta::create([
            'skema_id' => $request->skema_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'status_sertifikasi' => $request->status_sertifikasi,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data peserta berhasil ditambahkan!');
    }

    public function show(Peserta $peserta)
    {
        $peserta->load('skema');
        return view('pesertas.show', compact('peserta'));
    }

    public function edit(Peserta $peserta)
    {
        $skemas = Skema::all();
        return view('pesertas.edit', compact('peserta', 'skemas'));
    }

    public function update(Request $request, Peserta $peserta)
    {
        $request->validate([
            'skema_id' => 'required|exists:skemas,id',
            'nama' => 'required|string|max:255', 
            'email' => 'required|email|unique:pesertas,email,' . $peserta->id,
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'status_sertifikasi' => 'required',
        ]);

        $peserta->update([
            'skema_id' => $request->skema_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'status_sertifikasi' => $request->status_sertifikasi,
        ]);

        return redirect()->route('pesertas.index')->with('success', 'Data Peserta berhasil diupdate !');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil dihapus !');
    }
}
