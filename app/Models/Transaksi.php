<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kasir_id', 'metode_pembayaran_id', 'total', 'status'
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function kasir()
    {
        return $this->belongsTo(Kasir::class);
    }

    public function metodePembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class);
    }
    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
