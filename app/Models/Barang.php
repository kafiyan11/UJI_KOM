<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = ['nama_barang', 'harga', 'stok'];

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}

