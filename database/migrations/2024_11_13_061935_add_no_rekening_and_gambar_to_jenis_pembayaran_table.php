<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jenis_pembayaran', function (Blueprint $table) {
            $table->string('no_rekening')->nullable();
            $table->string('gambar')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('jenis_pembayaran', function (Blueprint $table) {
            $table->dropColumn('no_rekening');
            $table->dropColumn('gambar');
        });
    }
    
};
