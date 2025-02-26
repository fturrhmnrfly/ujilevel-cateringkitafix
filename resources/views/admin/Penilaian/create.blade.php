
<div class="container">
    <h2>Tambah Penilaian</h2>
    <form action="{{ route('admin.penilaian.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Pembeli</label>
            <input type="text" name="nama_pembeli" required>
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" required>
        </div>
        <div class="mb-3">
            <label>Rating (1-5)</label>
            <input type="number" name="rating" min="1" max="5" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
</div>
