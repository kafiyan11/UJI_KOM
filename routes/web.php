<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\JenisPembayaranController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login',[AuthController::class, 'login']);
Route::post('logout',[AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'RoleMiddleware:Admin'])->group(function () {

    Route::get('/dashboard/admin',[DashboardController::class, 'admin'])->name('admin.index');

    // bagian data kasir
    Route::get('/kasirs', [KasirController::class, 'index'])->name('kasirs.index'); // Menampilkan daftar kasir
    Route::get('/kasirs/datakasir', [KasirController::class, 'lihatdata'])->name('kasirs.lihatdata'); // Menampilkan daftar kasir
    Route::get('/kasirs/create', [KasirController::class, 'create'])->name('kasirs.create'); // Form tambah kasir baru
    Route::post('/kasirs', [KasirController::class, 'store'])->name('kasirs.store'); // Menyimpan kasir baru
    Route::get('/kasirs/{kasir}', [KasirController::class, 'show'])->name('kasirs.show'); // Menampilkan detail kasir
    Route::get('/kasirs/{kasir}/edit', [KasirController::class, 'edit'])->name('kasirs.edit'); // Form edit kasir
    Route::put('/kasirs/{kasir}', [KasirController::class, 'update'])->name('kasirs.update'); // Memperbarui kasir
    Route::delete('/kasirs/{kasir}', [KasirController::class, 'destroy'])->name('kasirs.destroy'); // Menghapus kasir

    // bagian data barang
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/histori', [BarangController::class, 'histori'])->name('barang.histori');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // bagian jenis pembayaran
    Route::get('jenis_pembayaran', [JenisPembayaranController::class, 'index'])->name('jenis_pembayaran.index');
    Route::get('jenis_pembayaran/create', [JenisPembayaranController::class, 'create'])->name('jenis_pembayaran.create');
    Route::post('jenis_pembayaran', [JenisPembayaranController::class, 'store'])->name('jenis_pembayaran.store');
    Route::get('jenis_pembayaran/{jenis_pembayaran}/edit', [JenisPembayaranController::class, 'edit'])->name('jenis_pembayaran.edit');
    Route::put('jenis_pembayaran/{jenis_pembayaran}', [JenisPembayaranController::class, 'update'])->name('jenis_pembayaran.update');
    Route::delete('jenis_pembayaran/{jenis_pembayaran}', [JenisPembayaranController::class, 'destroy'])->name('jenis_pembayaran.destroy');

    // bagian transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/histori', [TransaksiController::class, 'lihathistori'])->name('transaksi.histori');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::patch('/transaksi/{id}/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');

});
Route::middleware(['auth', 'RoleMiddleware:Kasir'])->group(function () {

    Route::get('/dashboard/kasir',[DashboardController::class, 'kasir'])->name('kasir.index');

});
Route::middleware(['auth', 'RoleMiddleware:Owner'])->group(function () {

    Route::get('/dashboard/owner',[DashboardController::class, 'owner'])->name('owner.index');

});