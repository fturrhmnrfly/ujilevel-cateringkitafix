
<div class="container">
    <h2>Edit Penilaian</h2>
    <form action="{{ route('admin.penilaian.update', $penilaian->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Pembeli</label>
            <input type="text" name="nama_pembeli" value="{{ $penilaian->nama_pembeli }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ $penilaian->nama_produk }}" required>
        </div>
        <div class="mb-3">
            <label>Rating (1-5)</label>
            <input type="number" name="rating" min="1" max="5" value="{{ $penilaian->rating }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
</div>

