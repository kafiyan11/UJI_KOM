@extends('layouts.app')

@section('title', 'Data Kasir')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header text-white text-center">
                    <h2 class="mb-0">Daftar Data Kasir</h2>
                </div>
                <div class="card-body">
                    <!-- Tabel Kasir -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center" style="width: 10%;">No</th>
                                    <th class="text-center" style="width: 45%;">Nama Kasir</th>
                                    <th class="text-center" style="width: 45%;">ID Pegawai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kasirs as $index => $kasir)
                                    <tr>
                                        <td class="text-center" class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $kasir->nama_kasir }}</td>
                                        <td class="text-center">{{ $kasir->id_pegawai }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Data kasir tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
