<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');    // Menyimpan kategori seperti "e-wallet" atau "bank"
            $table->string('nama');        // Nama detail, contoh "GoPay" atau "BCA"
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_pembayaran');
    }
};
