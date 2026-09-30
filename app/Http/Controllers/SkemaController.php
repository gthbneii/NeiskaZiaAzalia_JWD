<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index()
    {
        $skemas = Skema::latest()->paginate(10);
        return view('skemas.index', compact('skemas'));
    }

    public function create()
    {
        return view('skemas.create');
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

    public function edit(Skema $skema)
    {
        return view('skemas.edit', compact('skema'));
    }

    public function update(Request $request, Skema $skema)
    {
        $request->validate([
            'kode_skema' => 'required|unique:skemas,kode_skema,' . $skema->id,
            'nama_skema' => 'required|string|max:255',
            'jenis_skema' => 'required',
        ]);

        $skema->update($request->all());

        return redirect()->route('skemas.index')->with('success', 'Skema berhasil diupdate !');
    }

    public function destroy(Skema $skema)
    {
        $skema->delete();
        return redirect()->route('skemas.index')->with('success', 'Skema berhasil dihapus !');
    }
}
