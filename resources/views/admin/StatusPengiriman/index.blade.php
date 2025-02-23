@section('content')
<div class="sidebar">
    <div class="logo-container">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
        <span class="brand-name">CATERING KITA</span>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="menu-item active">
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>
    <a href="{{ route('admin.kelolamakanan.index') }}" class="menu-item">
        <i class="fa-solid fa-mug-hot"></i>
        Kelola Makanan
    </a>
    <a href="{{ route('admin.stokbahan.index') }}" class="menu-item">
        <i class="fa-solid fa-box-open"></i>
        Stok Bahan
    </a>
    <a href="{{ route('admin.daftarpesanan.index') }}" class="menu-item">
        <i class="fa-solid fa-clipboard-list"></i>
        Daftar Pesanan
    </a>
    <a href="{{ route('admin.laporan.index') }}" class="menu-item">
        <i class="fa-solid fa-file"></i>
        Laporan
    </a>
    <a href="{{ route('admin.transaksi.index') }}" class="menu-item">
        <i class="fa-solid fa-credit-card"></i>
        Transaksi
    </a>
    <a href="{{ route('admin.metodepembayaran.index') }}" class="menu-item">
        <i class="fa-solid fa-circle-dollar-to-slot"></i>
        Metode Pembayaran
    </a>
    <a href="{{ route('admin.statuspembayaran.index') }}" class="menu-item">
        <i class="fa-solid fa-box-open"></i>
        Status Pembayaran
    </a>
    <a href="{{ route('admin.statuspengiriman.index') }}" class="menu-item">
        <i class="fa-solid fa-truck-fast"></i>
        Status Pengiriman
    </a>
    {{-- <a href="{{ route('admin.penilaian.index') }}" class="menu-item">
        <i class="fa-solid fa-medal"></i>
        Penilaian
    </a> --}}

    <button class="logout-btn">
        <i data-lucide="log-out"></i>
        Logout
    </button>
</div>
<div class="container">
    <h2>Status Pengiriman</h2>
    <a href="{{ route('admin.statuspengiriman.create') }}" class="btn btn-primary">Tambah Status</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pembeli</th>
                <th>Nama Produk</th>
                <th>Tanggal Transaksi</th>
                <th>Status Pengiriman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->nama_pembeli }}</td>
                    <td>{{ $status->nama_produk }}</td>
                    <td>{{ $status->tanggal_transaksi }}</td>
                    <td>{{ $status->status_pengiriman }}</td>
                    <td>
                        <a href="{{ route('admin.statuspengiriman.edit', $status->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.statuspengiriman.destroy', $status->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
