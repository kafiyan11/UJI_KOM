<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kasir;
use App\Models\JenisPembayaran;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksis = Transaksi::with(['kasir', 'metodePembayaran'])->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }
    // Menampilkan daftar transaksi
    public function lihathistori()
    {
        $transaksis = Transaksi::with(['kasir', 'metodePembayaran'])->get();
        return view('admin.transaksi.histori', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all(); // Ambil semua produk dari database
        $kasirs = Kasir::all();
        $metodePembayaran = JenisPembayaran::all();
        return view('admin.transaksi.create', compact('barangs', 'kasirs', 'metodePembayaran'));
    }
    

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'kasir_id' => 'required|exists:kasirs,id',
            'metode_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
            'produk' => 'nullable|array', // Produk bisa kosong
            'produk.*.barang_id' => 'nullable|exists:barangs,id', // Produk barang_id bisa kosong
            'produk.*.jumlah' => 'nullable|integer|min:1', // Produk jumlah bisa kosong atau min 1
        ]);
    
        // Buat transaksi baru
        $transaksi = Transaksi::create([
            'kasir_id' => $request->kasir_id,
            'metode_pembayaran_id' => $request->metode_pembayaran_id,
            'total' => 0, // Sementara total
            'status' => 'pending', // Status awal
        ]);
    
        $total = 0;
    
        // Jika produk tidak kosong, lakukan perhitungan total dan detail
        if (!empty($request->produk)) {
            foreach ($request->produk as $item) {
                if (!empty($item['barang_id']) && $item['jumlah'] > 0) {
                    $barang = Barang::find($item['barang_id']);
                    $total += $barang->harga * $item['jumlah'];
    
                    // Kurangi stok barang
                    $barang->stok -= $item['jumlah'];
                    $barang->save();
    
                    // Simpan detail transaksi
                    TransaksiDetail::create([
                        'transaksi_id' => $transaksi->id,
                        'barang_id' => $barang->id,
                        'jumlah' => $item['jumlah'],
                        'harga' => $barang->harga,
                    ]);
                }
            }
        }
    
        // Update total transaksi
        $transaksi->update(['total' => $total]);
    
        return redirect()->route('transaksi.index');
    }
    
    

    // Menampilkan form untuk mengedit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::with(['kasir', 'metodePembayaran', 'detail'])->findOrFail($id);
        $barangs = Barang::all();
        $kasirs = Kasir::all();
        $metodePembayaran = JenisPembayaran::all();
        return view('admin.transaksi.edit', compact('transaksi', 'barangs', 'kasirs', 'metodePembayaran'));
    }

    // Mengupdate transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'kasir_id' => 'required|exists:kasirs,id',
            'metode_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
            'produk' => 'nullable|array', 
            'produk.*.barang_id' => 'nullable|exists:barangs,id', 
            'produk.*.jumlah' => 'nullable|integer|min:1', 
        ]);
    
        // Update transaksi
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'kasir_id' => $request->kasir_id,
            'metode_pembayaran_id' => $request->metode_pembayaran_id,
            'status' => 'pending', 
        ]);
    
        // Hapus detail transaksi lama
        $transaksi->detail()->delete();
    
        $total = 0;
    
        // Pastikan produk adalah array yang valid
        $produk = $request->input('produk', []); // Default menjadi array kosong jika tidak ada produk
    
        if (!empty($produk)) {
            foreach ($produk as $item) {
                if (isset($item['barang_id']) && $item['barang_id']) {
                    $barang = Barang::find($item['barang_id']);
                    
                    if ($barang && $barang->stok >= $item['jumlah']) {
                        $total += $barang->harga * $item['jumlah'];
    
                        $barang->stok -= $item['jumlah'];
                        $barang->save();
    
                        // Simpan detail transaksi
                        TransaksiDetail::create([
                            'transaksi_id' => $transaksi->id,
                            'barang_id' => $barang->id,
                            'jumlah' => $item['jumlah'],
                            'harga' => $barang->harga,
                        ]);
                    } else {
                        return back()->withErrors(['produk' => 'Stok produk tidak cukup untuk ' . $barang->nama_barang]);
                    }
                }
            }
        }
    
        $transaksi->update(['total' => $total]);
    
        return redirect()->route('transaksi.index');
    }

    public function destroy($id)
    {
        // Temukan transaksi
        $transaksi = Transaksi::findOrFail($id);
    
        // Hapus semua detail transaksi terkait
        $transaksi->detail()->delete();
    
        // Hapus transaksi utama
        $transaksi->delete();
    
        return redirect()->route('transaksi.index');
    }
    public function selesai($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'selesai';
        $transaksi->save();
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diselesaikan.');
    }
        
}
