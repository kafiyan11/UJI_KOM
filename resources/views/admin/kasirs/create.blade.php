@extends('layouts.app')

@section('title', 'Tambah Data Kasir')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Tambah Kasir</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kasirs.store') }}" method="POST" class="shadow p-4 rounded" style="max-width: 600px; margin: auto;">
        @csrf

        <div class="form-group mb-3">
            <label for="nama_kasir" class="form-label">Nama Kasir:</label>
            <input type="text" name="nama_kasir" id="nama_kasir" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
        <a href="{{ route('kasirs.index') }}" class="btn btn-primary">Kembali</a>
    </form>
</div>
@endsection
