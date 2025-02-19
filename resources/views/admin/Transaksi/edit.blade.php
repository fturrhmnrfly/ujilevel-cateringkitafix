@section('content')
<div class="container">
    <h1>Edit Transaksi</h1>
    <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_admin" class="form-label">Nama Admin</label>
            <input type="text" class="form-control" name="nama_admin" value="{{ $transaksi->nama_admin }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" name="nama_pelanggan" value="{{ $transaksi->nama_pelanggan }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" required>
        </div>
        <div class="mb-3">
            <label for="id_transaksi" class="form-label">ID Transaksi</label>
            <input type="text" class="form-control" name="id_transaksi" value="{{ $transaksi->id_transaksi }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis_tindakan" class="form-label">Jenis Tindakan</label>
            <input type="text" class="form-control" name="jenis_tindakan" value="{{ $transaksi->jenis_tindakan }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_tindakan" class="form-label">Deskripsi Tindakan</label>
            <textarea class="form-control" name="deskripsi_tindakan" required>{{ $transaksi->deskripsi_tindakan }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status_transaksi" class="form-label">Status Transaksi</label>
            <select class="form-select" name="status_transaksi" required>
                <option value="Selesai" {{ $transaksi->status_transaksi === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Dibatalkan" {{ $transaksi->status_transaksi === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
