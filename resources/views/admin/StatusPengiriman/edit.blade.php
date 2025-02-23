@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Status Pengiriman</h2>

    <form action="{{ route('admin.statuspengiriman.update', $status->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" value="{{ $status->nama_pembeli }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $status->nama_produk }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control" value="{{ $status->tanggal_transaksi }}" required>
        </div>
        <div class="mb-3">
            <label for="status_pengiriman" class="form-label">Status Pengiriman</label>
            <input type="text" name="status_pengiriman" class="form-control" value="{{ $status->status_pengiriman }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
