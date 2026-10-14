<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;


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

        return view('pesertas.index', compact('pesertas', 'search'));
    }

    public function create()
    {
        $skemas = \App\Models\Skema::all();
        $existingUserIds = \App\Models\Peserta::pluck('user_id');

        $users = \App\Models\User::where('role', 'user')
            ->whereNotIn('id', $existingUserIds)
            ->get();

        return view('pesertas.create', compact('skemas', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'skema_id' => 'required',
            'status_sertifikasi' => 'required',
        ]);

        $peserta = Peserta::where('user_id', $request->user_id)->first();

        if ($peserta) {
            $peserta->update([
                'skema_id' => $request->skema_id,
                'status_sertifikasi' => $request->status_sertifikasi,
            ]);
        } else {
            $user = \App\Models\User::findOrFail($request->user_id);
            Peserta::create([
                'user_id' => $user->id,
                'skema_id' => $request->skema_id,
                'nama_lengkap' => $user->name,
                'email' => $user->email,
                'no_hp' => $request->no_hp ?? '-',
                'alamat' => $request->alamat ?? '-',
                'status_sertifikasi' => $request->status_sertifikasi,
            ]);
        }

        return redirect()->route('pesertas.index')->with('success', 'Data peserta berhasil ditambahkan dan disimpan!');
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
        $users = \App\Models\User::where('role', 'user')->get(); // Ambil daftar user terdaftar

        return view('pesertas.edit', compact('peserta', 'skemas', 'users'));
    }

    public function update(Request $request, $id)
    {
        $peserta = \App\Models\Peserta::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $peserta->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah data ini.');
        }

        $request->validate([
            'user_id' => 'required',
            'skema_id' => 'required',
            'status_sertifikasi' => 'required',
        ]);

        $user = \App\Models\User::findOrFail($request->user_id);

        $peserta->update([
            'user_id' => $request->user_id,
            'skema_id' => $request->skema_id,
            'nama_lengkap' => $user->name,
            'email' => $user->email,
            'status_sertifikasi' => $request->status_sertifikasi,
        ]);

        // UBAH INI JUGA KE pesertas.index:
        return redirect()->route('pesertas.index')->with('success', 'Data peserta berhasil diperbarui!');
    }

    public function destroy(Peserta $peserta)
{
    // Jika ingin akun user-nya ikut terhapus dari database agar benar-benar registrasi dari awal:
    if ($peserta->user) {
        $peserta->user->delete();
    }

    $peserta->delete();

    return redirect()->route('pesertas.index')->with('success', 'Peserta dan akun berhasil dihapus!');
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

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_hp' => 'required|numeric|digits_between:10,12',
            'alamat' => 'required|string',
        ], [
            'nama_lengkap.regex' => 'Nama lengkap tidak boleh mengandung angka atau simbol khusus.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 12 digit angka.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
        ]);

        $user->update([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    public function userDashboard()
    {
        $peserta = \App\Models\Peserta::where('user_id', auth()->id())->first();

        return view('user.dashboard', compact('peserta'));
    }
}
