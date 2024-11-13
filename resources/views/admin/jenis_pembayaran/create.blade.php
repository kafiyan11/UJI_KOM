@extends('layouts.app')

@section('title', 'Tambah Data Jenis Pembayaran')

@section('content')
<h1>Tambah Jenis Pembayaran</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('jenis_pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="BANK">BANK</option>
                </select>
            </div>            

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
            </div>

            <!-- Input untuk No Rekening -->
            <div class="mb-3">
                <label for="no_rekening" class="form-label">No Rekening</label>
                <input type="text" name="no_rekening" id="no_rekening" class="form-control">
            </div>

            <!-- Input untuk Gambar -->
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control-file">
            </div>

            <br>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('jenis_pembayaran.index') }}" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>

@endsection
