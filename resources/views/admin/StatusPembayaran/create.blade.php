
<div class="container">
    <h1>Tambah Status Pembayaran</h1>
    <form action="{{ route('admin.statuspembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Pembeli</label>
            <input type="text" name="namapembeli" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="namaproduk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggaltransaksi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Transaksi</label>
            <input type="text" name="statustransaksi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Bukti Transaksi</label>
            <input type="file" name="buktitransaksi" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
