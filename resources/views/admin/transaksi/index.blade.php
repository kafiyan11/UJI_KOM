@extends('layouts.app')

@section('content')
    <h1>Daftar Transaksi</h1>

    <!-- Tombol untuk membuat transaksi baru -->
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Buat Transaksi Baru</a>
    
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut transaksi -->
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
                    
                    <td>
                        <!-- Tombol Edit Transaksi -->
                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Form delete transaksi -->
                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                        @if($transaksi->status != 'selesai')
                        <form action="{{ route('transaksi.selesai', $transaksi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan transaksi ini?')">
                                Tandai Selesai
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
