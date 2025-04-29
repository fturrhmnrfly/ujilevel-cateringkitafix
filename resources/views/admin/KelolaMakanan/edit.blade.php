{{-- <x-sidebar></x-sidebar> --}}
<div class="form-container">
    <h2>Edit Makanan</h2>
    <form action="{{ route('admin.kelolamakanan.update', $kelolamakanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Upload Gambar:</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            <small>Biarkan kosong jika tidak ingin mengganti gambar.</small>
        </div>
        <div class="form-group">
            <label for="nama_makanan">Nama Makanan:</label>
            <input type="text" id="nama_makanan" name="nama_makanan" class="form-control" value="{{ $kelolamakanan->nama_makanan }}" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori:</label>
            <select id="kategori" name="kategori" class="form-control" required>
                <option value="Prasmanan" {{ $kelolamakanan->kategori == 'Prasmanan' ? 'selected' : '' }}>Prasmanan</option>
                <option value="Nasi Box" {{ $kelolamakanan->kategori == 'Nasi Box' ? 'selected' : '' }}>Nasi Box</option>
                <option value="Paket Pernikahan" {{ $kelolamakanan->kategori == 'Paket Pernikahan' ? 'selected' : '' }}>Paket Pernikahan</option>
                <option value="Paket Harian" {{ $kelolamakanan->kategori == 'Paket Harian' ? 'selected' : '' }}>Paket Harian</option>
                <option value="Ala Carte" {{ $kelolamakanan->kategori == 'Ala Carte' ? 'selected' : '' }}>Ala Carte</option>
            </select>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" class="form-control" value="{{ $kelolamakanan->harga }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="Tersedia" {{ $kelolamakanan->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Tidak Tersedia" {{ $kelolamakanan->status == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required>{{ $kelolamakanan->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn-primary">Update</button>
    </form>
</div>
