<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('metode_pembayaran')->insert([
            ['kategori' => 'E-Wallet', 'nama' => 'GoPay', 'deskripsi' => 'Pembayaran melalui GoPay'],
            ['kategori' => 'E-Wallet', 'nama' => 'OVO', 'deskripsi' => 'Pembayaran melalui OVO'],
            ['kategori' => 'Bank', 'nama' => 'BCA', 'deskripsi' => 'Pembayaran melalui Bank BCA'],
            ['kategori' => 'Bank', 'nama' => 'Mandiri', 'deskripsi' => 'Pembayaran melalui Bank Mandiri'],
        ]);
    }
}
