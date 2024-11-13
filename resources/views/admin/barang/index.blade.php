@extends('layouts.app')

@section('title', 'Stok Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Stok Barang</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-success d-flex align-items-center">
        <i class="fas fa-plus-circle me-1"></i> Tambah Barang
    </a>
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
                <th>Aksi</th>
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
                    
                    <td>
                        <!-- Tombol Edit dengan Icon -->
                        <a class="btn btn-warning btn-sm" href="{{ route('barang.edit', $barang->id) }}">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>

                        <!-- Tombol Hapus dengan Icon -->
                        <button class="btn btn-danger btn-sm" onclick="confirmDeletion({{ $barang->id }})">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>

                        <!-- Form Hapus (tersembunyi) -->
                        <form id="delete-form-{{ $barang->id }}" action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
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

<!-- Script SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeletion(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data barang akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    @if(session('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
    @endif
</script>

@endsection
