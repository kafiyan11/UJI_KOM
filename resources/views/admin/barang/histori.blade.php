@extends('layouts.app')

@section('title', 'Stok Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Stok Barang</h2>

</div>
<br>
<div class="table-responsive">
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $index => $barang)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>Rp{{ number_format($barang->harga, 0, ',', '.') }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>
                        @if ($barang->stok > 20)
                            <span class="badge btn-primary">Stok Aman</span>
                        @elseif ($barang->stok >= 10)
                            <span class="badge btn-warning text-dark">Stok Menipis</span>
                        @else
                            <span class="badge btn-danger">Stok Habis</span>
                        @endif
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data barang</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
