
<div class="container">
    <h2>Tambah Status Pengiriman</h2>

    <form action="{{ route('admin.statuspengiriman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status Pengiriman</label>
            <select name="status_pengiriman" class="form-control" required>
                <option value="Dikirim">Dikirim</option>
                <option value="Selesai">Selesai</option>
                <option value="Batal">Batal</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>