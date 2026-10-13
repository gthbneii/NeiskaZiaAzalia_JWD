<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peserta;
use App\Models\Skema;


class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pesertas = Peserta::when($search, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->with('skema')
            ->latest()
            ->paginate(10);

        // Pastikan 'search' dimasukkan ke dalam compact()
        return view('pesertas.index', compact('pesertas', 'search'));
    }

    public function create()
    {
        $skemas = Skema::all();
        $users = \App\Models\User::where('role', 'user')->get(); 

        return view('pesertas.create', compact('skemas', 'users'));
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
            'status_sertifikasi' => $request->status_sertifikasi ?? 'Pending',
        ]);

        return redirect()->route('pesertas.index')->with('success', 'Data peserta berhasil ditambahkan!');
    }
    public function show(Peserta $peserta)
    {
        $peserta->load('skema');
        return view('pesertas.show', compact('peserta'));
    }

    public function edit($id)
    {
        $peserta = \App\Models\Peserta::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $peserta->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengedit data ini.');
        }

        $skemas = \App\Models\Skema::all();

        return view('pesertas.edit', compact('peserta', 'skemas'));
    }

    public function update(Request $request, $id)
    {
        $peserta = \App\Models\Peserta::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $peserta->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah data ini.');
        }

        $peserta->update($request->all());

        return redirect()->route('pesertas.index')->with('success', 'Data peserta berhasil diperbarui!');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil dihapus !');
    }

    public function userProfile()
    {
        $peserta = \App\Models\Peserta::where('user_id', auth()->id())->first();
        $skemas = \App\Models\Skema::all();

        return view('user.profile', compact('peserta', 'skemas'));
    }
    public function userUpdateProfile(Request $request)
    {
        $user = auth()->user();

        $peserta = Peserta::where('user_id', $user->id)->first();

        $request->validate([
            'skema_id' => 'required|exists:skemas,id',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pesertas,email,' . optional($peserta)->id,
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        if ($peserta) {
            $peserta->update([
                'skema_id' => $request->skema_id,
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        } else {
            $existingPeserta = Peserta::where('email', $request->email)->first();

            if ($existingPeserta) {
                $existingPeserta->update([
                    'user_id' => $user->id,
                    'skema_id' => $request->skema_id,
                    'nama_lengkap' => $request->nama_lengkap,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } else {
                Peserta::create([
                    'user_id' => $user->id,
                    'skema_id' => $request->skema_id,
                    'nama_lengkap' => $request->nama_lengkap,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'status_sertifikasi' => 'Pending',
                ]);
            }
        }

        return redirect()->route('user.dashboard')->with('success', 'Data profil/peserta berhasil disimpan!');
    }

    public function userDashboard()
    {
        $peserta = \App\Models\Peserta::where('user_id', auth()->id())->first();

        return view('user.dashboard', compact('peserta'));
    }
}
