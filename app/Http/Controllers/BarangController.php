<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('admin.barang.index', compact('barangs'));
    }
    public function histori()
    {
        $barangs = Barang::all();
        return view('admin.barang.histori', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
        ]);
    
        Barang::create($request->all());
    
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diupdate.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
