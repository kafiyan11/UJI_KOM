<!-- resources/views/transaksi/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Transaksi #{{ $transaksi->id }}</h1>

    <!-- Form untuk mengedit transaksi -->
    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kasir_id">Kasir</label>
            <select name="kasir_id" id="kasir_id" class="form-control" required>
                @foreach($kasirs as $kasir)
                    <option value="{{ $kasir->id }}" {{ $kasir->id == $transaksi->kasir_id ? 'selected' : '' }}>
                        {{ $kasir->nama_kasir }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran_id">Metode Pembayaran</label>
            <select name="metode_pembayaran_id" id="metode_pembayaran_id" class="form-control" required>
                @foreach($metodePembayaran as $metode)
                    <option value="{{ $metode->id }}" {{ $metode->id == $transaksi->metode_pembayaran_id ? 'selected' : '' }}>
                        {{ $metode->nama }} ({{ $metode->kategori }})
                    </option>
                @endforeach
            </select>
        </div>

        <h4>Produk</h4>
        <div id="produk-list">
            @foreach($barangs as $barang)
                <div class="form-group">
                    <label>{{ $barang->nama }} (Stok: {{ $barang->stok }})</label>
                    <input type="number" name="produk[{{ $barang->id }}][jumlah]" class="form-control" min="1" max="{{ $barang->stok }}" 
                        value="{{ old('produk.' . $barang->id . '.jumlah', $transaksi->detail->where('barang_id', $barang->id)->first()->jumlah ?? 1) }}">
                    <input type="hidden" name="produk[{{ $barang->id }}][barang_id]" value="{{ $barang->id }}">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-warning">Update Transaksi</button>
    </form>
@endsection
