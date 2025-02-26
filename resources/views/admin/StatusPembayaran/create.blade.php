
<div class="container">
    <h1>Tambah Status Pembayaran</h1>
    <form action="{{ route('admin.statuspembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Transaksi</label>
            <input type="text" name="status_transaksi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Bukti Transaksi</label>
            <input type="file" name="bukti_transaksi" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
