
<div class="container">
    <h2>Edit Status Pengiriman</h2>

    <form action="{{ route('admin.statuspengiriman.update', $statusPengiriman->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="nama_pembeli" class="form-control" value="{{ $statusPengiriman->nama_pembeli }}" required>
        <input type="text" name="nama_produk" class="form-control" value="{{ $statusPengiriman->nama_produk }}" required>
        <input type="date" name="tanggal_transaksi" class="form-control" value="{{ $statusPengiriman->tanggal_transaksi }}" required>
        <select name="status_pengiriman" class="form-control" required>
            <option value="Dikirim" {{ $statusPengiriman->status_pengiriman == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
            <option value="Selesai" {{ $statusPengiriman->status_pengiriman == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
