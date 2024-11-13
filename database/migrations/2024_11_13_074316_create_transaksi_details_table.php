<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis');
            $table->foreignId('barang_id')->constrained('barangs');
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
