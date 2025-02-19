<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        display: flex;
        background-color: #f3f4f6;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .sidebar {
        width: 250px;
        background-color: #1e1b4b;
        min-height: 100vh;
        padding: 20px;
        color: white;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
        padding: 10px;
    }

    .logo {
        width: 40px;
        height: 40px;
    }

    .brand-name {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .menu-item {
        display: block;
        text-decoration: none;
        color: white;
        padding: 12px 15px;
        margin: 8px 0;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .menu-item:hover {
        background-color: #2d2a77;
    }

    .menu-item.active {
        background-color: #2d2a77;
    }

    .main-content {
        flex: 1;
        margin-left: 250px;
        width: calc(100% - 250px);
        min-height: 100vh;
    }

    .header {
        background-color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .content {
        padding: 20px;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: white;
        color: #333;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        border: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
    }

    .search-input {
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        width: 300px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .table-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #f7f7f7;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #e0e0e0;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .btn-warning {
        background-color: #FFA500;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        margin-right: 5px;
        border: none;
        cursor: pointer;
    }

    .btn-danger {
        background-color: #DC3545;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .status-available {
        color: #28a745;
        font-weight: 500;
    }

    .admin-profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .admin-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .logout-btn {
        display: block;
        text-decoration: none;
        color: white;
        padding: 12px 15px;
        border-radius: 8px;
        margin-top: auto;
        transition: background-color 0.3s;
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
    }

    .logout-btn:hover {
        background-color: #2d2a77;
    }
</style>
<div class="sidebar">
    <div class="logo-container">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
        <span class="brand-name">CATERING KITA</span>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="menu-item">Dashboard</a>
    <a href="{{ route('admin.kelolamakanan.index') }}" class="menu-item">Kelola Makanan</a>
    <a href="{{ route('admin.stokbahan.index') }}" class="menu-item">Stok Bahan</a>
    <a href="{{ route('admin.daftarpesanan.index') }}" class="menu-item">Daftar Pesanan</a>
    <a href="{{ route('admin.laporan.index') }}" class="menu-item">Laporan</a>
    <a href="{{ route('admin.transaksi.index') }}" class="menu-item">Transaksi</a>
    <a href="{{ route('admin.metodepembayaran.index') }}" class="menu-item">Metode Pembayaran</a>
    {{-- <a href="{{ route('admin.statuspembayaran.index') }}" class="menu-item">Status Pembayaran</a>
    <a href="{{ route('admin.statuspengiriman.index') }}" class="menu-item">Status Pengiriman</a>
    <a href="{{ route('admin.penilaian.index') }}" class="menu-item">Penilaian</a> --}}

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>
<div class="form-container">
    <h2>Tambah Makanan</h2>
    <form action="{{ route('admin.kelolamakanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Image Produk:</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="nama_makanan">Nama Makanan:</label>
            <input type="text" id="nama_makanan" name="nama_makanan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori:</label>
            <select id="kategori" name="kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <option value="Paket Pernikahan">Paket Pernikahan</option>
                <option value="Paket Harian">Paket Harian</option>
                <option value="Ala Carte">Ala Carte</option>
            </select>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn-primary">Simpan</button>
    </form>
</div>
