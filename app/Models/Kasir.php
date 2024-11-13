<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kasir', 'id_pegawai'];

    public static function generateIdPegawai()
    {
        // Mengambil kasir terakhir yang disimpan di database
        $lastKasir = self::orderBy('id', 'desc')->first();

        if (!$lastKasir) {
            // Jika belum ada kasir, mulai dari KS0001
            return 'KS0001';
        }

        // Ambil nomor dari ID terakhir dan tambahkan 1
        $lastIdNumber = (int) substr($lastKasir->id_pegawai, 2);
        $newIdNumber = $lastIdNumber + 1;

        // Format ID Pegawai menjadi KS0001, KS0002, dst.
        return 'KS' . str_pad($newIdNumber, 4, '0', STR_PAD_LEFT);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}

