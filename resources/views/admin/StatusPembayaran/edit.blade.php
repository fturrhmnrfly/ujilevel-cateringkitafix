@section('content')
<div class="container">
    <h1>Edit Status Pembayaran</h1>
    <form action="{{ route('admin.statuspembayaran.update', $statusPembayaran->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Pembeli</label>
            <input type="text" name="namapembeli" class="form-control" value="{{ $statusPembayaran->namapembeli }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="namaproduk" class="form-control" value="{{ $statusPembayaran->namaproduk }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggaltransaksi" class="form-control" value="{{ $statusPembayaran->tanggaltransaksi }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Transaksi</label>
            <input type="text" name="statustransaksi" class="form-control" value="{{ $statusPembayaran->statustransaksi }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Bukti Transaksi</label>
            <input type="file" name="buktitransaksi" class="form-control">
            @if($statusPembayaran->buktitransaksi)
                <p>File saat ini: <a href="{{ asset('storage/' . $statusPembayaran->buktitransaksi) }}" target="_blank">Lihat</a></p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
