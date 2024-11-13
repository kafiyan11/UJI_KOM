@extends('layouts.app')

@section('title', 'Data Kasir')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Daftar Kasir</h1>
    
    <!-- Tombol Tambah Kasir -->
    <a href="{{ route('kasirs.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus-circle"></i> Tambah Kasir
    </a>

    <!-- Tabel Kasir -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Kasir</th>
                    <th>ID Pegawai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kasirs as $index => $kasir)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td >{{ $kasir->nama_kasir }}</td>
                        <td>{{ $kasir->id_pegawai }}</td>
                        <td>
                            <!-- Tombol Edit dengan Icon -->
                            <a class="btn btn-warning btn-sm" href="{{ route('kasirs.edit', $kasir->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <!-- Tombol Hapus dengan Icon -->
                            <form action="{{ route('kasirs.destroy', $kasir->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
