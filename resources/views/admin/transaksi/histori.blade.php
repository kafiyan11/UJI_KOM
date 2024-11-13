@extends('layouts.app')

@section('content')
    <h1>Daftar Transaksi</h1>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th> <!-- Menambahkan kolom No -->
                <th>Kasir</th>
                <th>Metode Pembayaran</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $index => $transaksi)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut transaksi -->
                    <td>{{ $transaksi->kasir->nama_kasir }}</td>
                    <td>
                        @if ($transaksi->metodePembayaran)
                            {{ $transaksi->metodePembayaran->nama }} ({{ $transaksi->metodePembayaran->kategori }})
                        @else
                            - 
                        @endif
                    </td>
                    <td>Rp {{ number_format($transaksi->total, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $transaksi->status == 'selesai' ? 'btn-success' : 'btn-warning' }}">
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 
