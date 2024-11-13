<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['metode_pembayaran_id']); // Hapus constraint foreign key
            $table->unsignedBigInteger('metode_pembayaran_id')->nullable()->change(); // Set kolom menjadi nullable
            $table->foreign('metode_pembayaran_id')->references('id')->on('jenis_pembayaran')->onDelete('set null'); // Menambahkan kembali constraint
        });
    }
    
    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['metode_pembayaran_id']); // Hapus constraint foreign key
            $table->unsignedBigInteger('metode_pembayaran_id')->nullable(false)->change(); // Set kembali kolom tidak nullable
            $table->foreign('metode_pembayaran_id')->references('id')->on('jenis_pembayaran'); // Menambahkan kembali constraint
        });
    }
    
};
