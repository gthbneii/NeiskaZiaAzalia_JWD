<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $skemas = Skema::when($search, function ($query, $search) {
            return $query->where('nama_skema', 'like', "%{$search}%")
                ->orWhere('kode_skema', 'like', "%{$search}%")
                ->orWhere('jenis_skema', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10);
        return view('skemas.index', compact('skemas', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_skema' => [
                'required',
                'string',
                'unique:skemas,kode_skema',
                'regex:/^SKM-\d{3}$/'
            ],
            'nama_skema' => 'required|string|max:255',
        ], [
            'kode_skema.required' => 'Kode skema wajib diisi.',
            'kode_skema.unique' => 'Kode skema tersebut sudah terdaftar! Gunakan kode lain.',
            'kode_skema.regex' => 'Format kode skema harus berawalan SKM- diikuti 3 digit angka (Contoh: SKM-001).',
            'nama_skema.required' => 'Nama skema wajib diisi.',
        ]);

        \App\Models\Skema::create($request->all());

        return redirect()->route('skemas.index')->with('success', 'Skema sertifikasi berhasil ditambahkan!');
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

    public function edit(Skema $skema)
    {
        return view('skemas.edit', compact('skema'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Add unique rule ignoring the current record ID
            'kode_skema' => 'required|string|max:255|unique:skemas,kode_skema,' . $id,
            'nama_skema' => 'required|string|max:255',
            'jenis_skema' => 'required',
        ]);

        $skema = Skema::findOrFail($id);
        $skema->fill($request->all());

        if (!$skema->isDirty()) {
            return redirect()->route('skemas.index')->with('info', 'Tidak ada perubahan data yang dilakukan.');
        }
        $skema->save();

        return redirect()->route('skemas.index')->with('success', 'Skema berhasil diupdate!');
    }

    public function destroy(Skema $skema)
    {
        $skema->delete();
        return redirect()->route('skemas.index')->with('success', 'Skema berhasil dihapus !');
    }
}
