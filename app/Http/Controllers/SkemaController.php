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
            'kode_skema' => 'required|unique:skemas,kode_skema',
            'nama_skema' => 'required|string|max:255',
            'jenis_skema' => 'required',
        ]);

        Skema::create($request->all());

        return redirect()->route('skemas.index')->with('success', 'Skema berhasil ditambahkan !');
    }

    public function create()
    {
        return view('skemas.create');
    }

    public function edit(Skema $skema)
    {
        return view('skemas.edit', compact('skema'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_skema' => 'required|string|max:255',
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
