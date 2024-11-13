@extends('layouts.app')

@section('title', 'Data Jenis Pembayaran')

@section('content')
<h1>Daftar Jenis Pembayaran</h1>
<a href="{{ route('jenis_pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Jenis Pembayaran</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>No Rekening</th> <!-- Kolom baru untuk No Rekening -->
            <th>Gambar</th> <!-- Kolom baru untuk Gambar -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jenisPembayaran as $index => $jenis)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jenis->kategori }}</td>
                <td>{{ $jenis->nama }}</td>
                <td>{{ $jenis->deskripsi }}</td>
                
                <!-- Tampilkan No Rekening -->
                <td>
                    @if ($jenis->no_rekening)
                        {{ $jenis->no_rekening }}
                    @else
                        -
                    @endif
                </td>
                
                <!-- Tampilkan Gambar -->
                <td>
                    @if ($jenis->gambar)
                        <img src="{{ asset('storage/' . $jenis->gambar) }}" alt="Gambar" style="width: 50px; height: auto; max-height: 50px; object-fit: cover;">
                    @else
                        -
                    @endif
                </td>
                
                <td>
                    <a href="{{ route('jenis_pembayaran.edit', $jenis->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jenis_pembayaran.destroy', $jenis->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Data jenis pembayaran tidak tersedia</td>
            </tr>
        @endforelse
    </tbody>
    
</table>
@endsection
