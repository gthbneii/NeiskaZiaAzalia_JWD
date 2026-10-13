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
                return $query->where('nama_lengkap', 'like', "%{$search}%")
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
            'skema_id' => 'required',
            'nama_lengkap' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => 'required|email|max:255|unique:pesertas,email',
            'no_hp' => 'required|numeric|digits_between:10,12',

            'alamat' => 'required|string',
            'status_sertifikasi' => 'required',
        ], [
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi, tidak boleh ada angka !.',
            'no_hp.numeric' => 'No. Telepon/HP wajib berupa angka.',
            'no_hp.digits_between' => 'No. Telepon/HP harus berdigit antara 10-12 digit.',
        ]);

        Peserta::create($request->all());

        return redirect()->route('pesertas.index')->with('success', 'Data peserta berhasil ditambahkan !');
    }
    public function show(Peserta $peserta)
    {
        $peserta->load('skema');
        return view('pesertas.show', compact('peserta'));
    }

    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        $skemas = Skema::all();

        return view('pesertas.edit', compact('peserta', 'skemas'));
    }

    public function update(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);

        $request->validate([
            'skema_id' => 'required',
            'nama_lengkap' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => 'required|email|max:255|unique:pesertas,email,' . $peserta->id,
            'no_hp' => 'required|numeric|digits_between:10,12',
            'alamat' => 'required|string',
            'status_sertifikasi' => 'required',
        ], [
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi, tidak boleh mengandung angka.',
            'no_hp.numeric' => 'No. Telepon/HP wajib berupa angka.',
            'no_hp.digits_between' => 'No. Telepon/HP harus memiliki panjang antara 10 sampai 12 digit.',
        ]);

        $peserta->fill($request->all());

        if (!$peserta->isDirty()) {
            return redirect()->route('pesertas.index')->with('info', 'Tidak ada perubahan data peserta yang dilakukan.');
        }

        $peserta->save();

        return redirect()->route('pesertas.index')->with('success', 'Data peserta berhasil diupdate!');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil dihapus !');
    }
}
