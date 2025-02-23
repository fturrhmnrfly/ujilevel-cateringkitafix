@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Status Pengiriman</h2>

    <form action="{{ route('admin.statuspengiriman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status_pengiriman" class="form-label">Status Pengiriman</label>
            <input type="text" name="status_pengiriman" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
