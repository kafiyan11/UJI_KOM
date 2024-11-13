@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<form action="{{ route('barang.update', $barang->id) }}" method="POST" class="border p-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}" required>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" name="harga" value="{{ $barang->harga }}" required>
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" class="form-control" name="stok" value="{{ $barang->stok }}" required>
    </div>
    <br>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('barang.index') }}" class="btn btn-warning mb-3">Kembali</a>
</form>
@endsection
