@extends('layouts.app')

@section('content')
    <h1>Buat Transaksi Baru</h1>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kasir_id">Kasir</label>
            <select name="kasir_id" id="kasir_id" class="form-control" required>
                <option value="">--- Pilih Kasir ---</option>
                @foreach($kasirs as $kasir)
                    <option value="{{ $kasir->id }}">{{ $kasir->nama_kasir }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran_id">Metode Pembayaran</label>
            <select name="metode_pembayaran_id" id="metode_pembayaran_id" class="form-control" required>
                <option value="">--- Pilih Metode ---</option>
                @foreach($metodePembayaran as $metode)
                    <option value="{{ $metode->id }}" data-no-rekening="{{ $metode->no_rekening }}" data-gambar="{{ $metode->gambar }}">
                        {{ $metode->nama }} ({{ $metode->kategori }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Menampilkan No Rekening dan Gambar -->
        <div class="form-group">
            <label for="no_rekening">No Rekening</label>
            <div id="no_rekening"></div>
        </div>

        <div class="form-group">
            <label for="gambar">Gambar Metode Pembayaran</label>
            <div id="gambar"></div>
        </div>

        <h4>Produk</h4>

        <!-- Input pencarian produk -->
        <div class="form-group">
            <label for="search-produk">Cari Produk</label>
            <input type="text" id="search-produk" class="form-control" placeholder="Cari produk..." oninput="searchProduk()" />
        </div>

        <div id="produk-list">
            <!-- Daftar produk akan dimuat secara dinamis disini -->
        </div>

        <!-- Menampilkan total harga transaksi -->
        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" id="total" class="form-control" value="0" readonly>
        </div>

        <!-- Uang yang diberikan oleh pelanggan -->
        <div class="form-group">
            <label for="uang_diberikan">Uang Diberikan</label>
            <input type="number" name="uang_diberikan" id="uang_diberikan" class="form-control" min="0" required>
        </div>

        <!-- Kembalian -->
        <div class="form-group">
            <label for="kembalian">Kembalian</label>
            <input type="text" id="kembalian" class="form-control" value="0" readonly>
        </div>

        <button type="submit" class="btn btn-success">Proses Transaksi</button>
    </form>

    <script>
        // Daftar produk dari server
        const barangs = @json($barangs);

        // Fungsi untuk menampilkan daftar produk yang dicari
        function searchProduk() {
            const searchTerm = document.getElementById('search-produk').value.toLowerCase();
            const produkList = document.getElementById('produk-list');
            produkList.innerHTML = '';  // Clear previous list

            // Filter produk berdasarkan pencarian
            const filteredBarangs = barangs.filter(barang => barang.nama_barang.toLowerCase().includes(searchTerm));

            // Tampilkan produk yang ditemukan
            filteredBarangs.forEach(barang => {
                const div = document.createElement('div');
                div.classList.add('form-group');
                
                div.innerHTML = `
                    <label>${barang.nama_barang}</label>
                    <input type="number" name="produk[${barang.id}][jumlah]" class="form-control jumlah-produk" min="0" max="${barang.stok}" value="0" data-harga="${barang.harga}">
                    <input type="hidden" name="produk[${barang.id}][barang_id]" value="${barang.id}">
                `;
                produkList.appendChild(div);
            });
        }

        // Fungsi untuk menghitung total harga dan kembalian
        function calculateTotal() {
            let total = 0;
            const produkList = document.querySelectorAll('.jumlah-produk');
            produkList.forEach(input => {
                const jumlah = parseInt(input.value) || 0;
                const harga = parseFloat(input.dataset.harga) || 0;

                if (jumlah > 0 && harga > 0) {
                    total += harga * jumlah;
                }
            });

            document.getElementById('total').value = total.toFixed(2);
            calculateChange();
        }

        // Fungsi untuk menghitung kembalian
        function calculateChange() {
            const uangDiberikan = parseFloat(document.getElementById('uang_diberikan').value) || 0;
            const total = parseFloat(document.getElementById('total').value) || 0;
            const kembalian = uangDiberikan - total;
            document.getElementById('kembalian').value = kembalian >= 0 ? kembalian.toFixed(2) : 0;
        }

        // Event listener untuk perubahan jumlah produk
        document.getElementById('produk-list').addEventListener('input', calculateTotal);

        // Event listener untuk uang yang diberikan
        document.getElementById('uang_diberikan').addEventListener('input', calculateChange);

        // Event listener untuk perubahan metode pembayaran
        document.getElementById('metode_pembayaran_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const noRekening = selectedOption.getAttribute('data-no-rekening');
            const gambar = selectedOption.getAttribute('data-gambar');

            // Menampilkan data no_rekening
            document.getElementById('no_rekening').textContent = `No Rekening: ${noRekening}`;

            // Menampilkan gambar metode pembayaran
            const gambarElement = document.getElementById('gambar');
            gambarElement.innerHTML = '';
            if (gambar) {
                const img = document.createElement('img');
                img.src = `/storage/${gambar}`;  // Pastikan gambar disimpan di folder storage
                img.alt = 'Gambar Metode Pembayaran';
                img.width = 100;
                gambarElement.appendChild(img);
            } else {
                gambarElement.textContent = 'Gambar tidak tersedia.';
            }
        });
    </script>
@endsection
