<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    use HasFactory;

    protected $table = 'jenis_pembayaran';

    protected $fillable = [
        'kategori', // "e-wallet" atau "bank"
        'nama',     // Nama detail, contoh "GoPay", "BCA"
        'deskripsi',
        'no_rekening',
        'gambar',
        
    ];

        public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

}
