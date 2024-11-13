@extends('layouts.app')

@section('title', 'Edit Data Kasir')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Edit Kasir</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kasirs.update', $kasir->id) }}" method="POST" class="shadow p-4 rounded" style="max-width: 600px; margin: auto;">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nama_kasir" class="form-label">Nama Kasir:</label>
            <input type="text" name="nama_kasir" id="nama_kasir" class="form-control" value="{{ $kasir->nama_kasir }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update</button>
        <a href="{{ route('kasirs.index') }}" class="btn btn-primary">Kembali</a>

    </form>
</div>
@endsection
