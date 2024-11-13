<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPembayaran;
use Illuminate\Support\Facades\Storage;

class JenisPembayaranController extends Controller
{
    // Menampilkan daftar jenis pembayaran
    public function index()
    {
        $jenisPembayaran = JenisPembayaran::all();
        return view('admin.jenis_pembayaran.index', compact('jenisPembayaran'));
        
    }

    // Menampilkan form untuk menambah jenis pembayaran baru
    public function create()
    {
        return view('admin.jenis_pembayaran.create');
    }

    public function store(Request $request)
    {
        // Validasi input tanpa 'tipe_input'
        $request->validate([
            'kategori' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'no_rekening' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->all();
        
        // Cek jika ada gambar yang diupload
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }
        
        // Cek jika ada no_rekening yang diisi
        if ($request->filled('no_rekening')) {
            $data['no_rekening'] = $request->input('no_rekening');
        }
        
        // Buat jenis pembayaran baru
        JenisPembayaran::create($data);
        
        return redirect()->route('jenis_pembayaran.index')
                         ->with('success', 'Jenis Pembayaran berhasil ditambahkan.');
    }
    

    // Menampilkan form untuk mengedit jenis pembayaran
    public function edit(JenisPembayaran $jenisPembayaran)
    {
        return view('admin.jenis_pembayaran.edit', compact('jenisPembayaran'));
    }

    public function update(Request $request, JenisPembayaran $jenisPembayaran)
    {
        // Validasi input tanpa 'tipe_input'
        $request->validate([
            'kategori' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'no_rekening' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->all();
        
        // Cek jika ada gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($jenisPembayaran->gambar) {
                Storage::disk('public')->delete($jenisPembayaran->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        // Jika tidak ada gambar yang diupload dan ada no_rekening, pastikan gambar bernilai null
        if (!$request->hasFile('gambar') && $request->filled('no_rekening')) {
            $data['gambar'] = null; // Null-kan gambar jika ada no_rekening
        }
        
        // Update data jenis pembayaran
        $jenisPembayaran->update($data);
        
        return redirect()->route('jenis_pembayaran.index')
                        ->with('success', 'Jenis Pembayaran berhasil diperbarui.');
    }


    public function destroy(JenisPembayaran $jenisPembayaran)
    {
        // Cek dan update transaksi yang menggunakan jenis pembayaran ini
        $transaksiCount = \App\Models\Transaksi::where('metode_pembayaran_id', $jenisPembayaran->id)->count();
    
        if ($transaksiCount > 0) {
            // Jika ada transaksi, ubah metode pembayaran ke ID lain atau NULL
            \App\Models\Transaksi::where('metode_pembayaran_id', $jenisPembayaran->id)
                ->update(['metode_pembayaran_id' => null]);  // Atau gunakan ID metode pembayaran lain yang valid
    
            // Jika ingin memberi peringatan dan hanya mereset data transaksi
            return redirect()->route('jenis_pembayaran.index')
                             ->with('info', 'Jenis Pembayaran sudah digunakan di transaksi, telah direset.');
        }
    
        // Hapus gambar jika ada
        if ($jenisPembayaran->gambar) {
            Storage::disk('public')->delete($jenisPembayaran->gambar);
        }
    
        // Hapus jenis pembayaran
        $jenisPembayaran->delete();
    
        return redirect()->route('jenis_pembayaran.index')
                         ->with('success', 'Jenis Pembayaran berhasil dihapus.');
    }
    
}
