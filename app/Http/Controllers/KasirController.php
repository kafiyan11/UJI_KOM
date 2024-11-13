<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $kasirs = Kasir::all();
        return view('admin.kasirs.index', compact('kasirs'));
    }
    public function lihatdata()
    {
        $kasirs = Kasir::all();
        return view('admin.kasirs.datakasir', compact('kasirs'));
    }

    public function create()
    {
        return view('admin.kasirs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kasir' => 'required|string|max:255',
        ]);
    
        // Menggunakan metode generateIdPegawai untuk mendapatkan ID otomatis
        $idPegawai = Kasir::generateIdPegawai();
    
        Kasir::create([
            'nama_kasir' => $request->nama_kasir,
            'id_pegawai' => $idPegawai,
        ]);
    
        return redirect()->route('kasirs.index')->with('success', 'Data kasir berhasil ditambahkan.');
    }

    public function edit(Kasir $kasir)
    {
        return view('admin.kasirs.edit', compact('kasir'));
    }

    public function update(Request $request, Kasir $kasir)
    {
        $request->validate([
            'nama_kasir' => 'required|string|max:255',
        ]);

        $kasir->update($request->all());

        return redirect()->route('kasirs.index')->with('success', 'Data kasir berhasil diperbarui.');
    }

    public function destroy(Kasir $kasir)
    {
        $kasir->delete();

        return redirect()->route('kasirs.index')->with('success', 'Data kasir berhasil dihapus.');
    }
}
