@extends('layouts.app')

@section('title', 'Edit Data Jenis Pembayaran')

@section('content')
<h1>Edit Jenis Pembayaran</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('jenis_pembayaran.update', $jenisPembayaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="" disabled>Pilih Kategori</option>
                    <option value="E-Wallet" {{ $jenisPembayaran->kategori == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    <option value="BANK" {{ $jenisPembayaran->kategori == 'BANK' ? 'selected' : '' }}>BANK</option>
                </select>
            </div>            

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $jenisPembayaran->nama }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $jenisPembayaran->deskripsi }}</textarea>
            </div>

            <!-- Input untuk No Rekening -->
            <div class="mb-3">
                <label for="no_rekening" class="form-label">No Rekening</label>
                <input type="text" name="no_rekening" id="no_rekening" class="form-control" value="{{ $jenisPembayaran->no_rekening }}">
            </div>

            <!-- Input untuk Gambar -->
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control-file">
                
                @if ($jenisPembayaran->gambar)
                    <div class="mt-2">
                        <label>Gambar Saat Ini:</label><br>
                        <img src="{{ asset('storage/' . $jenisPembayaran->gambar) }}" alt="Gambar" style="width: 100px; height: auto;">
                    </div>
                @endif
            </div>

            <br>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('jenis_pembayaran.index') }}" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>

@endsection
