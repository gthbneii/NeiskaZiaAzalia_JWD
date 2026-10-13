<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peserta;
use App\Models\Skema;


class PesertaController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $pesertas = Peserta::all();
        } else {
            $pesertas = Peserta::where('user_id', auth()->id())->get();
        }

        return view('pesertas.index', compact('pesertas'));
    }

    public function create()
    {
        $skemas = Skema::all();
        return view('pesertas.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skema_id' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Peserta::create([
            'user_id' => Auth::id(),
            'skema_id' => $request->skema_id,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'status_sertifikasi' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Data profil/peserta berhasil disimpan!');
    }
    public function show(Peserta $peserta)
    {
        $peserta->load('skema');
        return view('pesertas.show', compact('peserta'));
    }

    public function edit($id)
    {
        $peserta = \App\Models\Peserta::findOrFail($id);

        // Jika bukan admin dan data bukan milik user yang login, tolak akses
        if (auth()->user()->role !== 'admin' && $peserta->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengedit data ini.');
        }

        return view('pesertas.edit', compact('peserta'));
    }

    public function update(Request $request, $id)
    {
        $peserta = \App\Models\Peserta::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $peserta->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah data ini.');
        }

        $peserta->update($request->all());

        return redirect()->route('pesertas.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil dihapus !');
    }
}
