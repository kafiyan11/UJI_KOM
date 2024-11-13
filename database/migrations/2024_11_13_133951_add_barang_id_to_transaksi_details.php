<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksi_details', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_id')->nullable()->after('transaksi_id');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('transaksi_details', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->dropColumn('barang_id');
        });
    }
};