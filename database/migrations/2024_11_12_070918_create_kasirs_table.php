<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kasirs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kasir');
            $table->string('id_pegawai')->unique();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('kasirs');
    }
    
};
