<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita - Admin</title>
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
        }

        .sidebar {
            width: 250px;
            background-color: #1e1b4b;
            min-height: 100vh;
            padding: 20px;
            color: white;
            position: fixed;
        }

        .logo-container {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 30px;
        }

        .logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .brand-name {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .menu-item {
            padding: 12px 15px;
            margin: 5px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color: #2d2a77;
        }

        .menu-item.active {
            background-color: #2d2a77;
        }

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .header {
            background-color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .content {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .form-wrapper {
            max-width: 1000px;
            width: 100%;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f8f9fa;
            color: #495057;
        }

        .form-control::placeholder {
            color: #999;
            font-size: 14px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%23999' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        .btn-tambahkan {
            background-color: #4040ff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-tambahkan:hover {
            background-color: #3333ff;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar {
                display: none;
            }

            .btn-tambahkan {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
            <span class="brand-name">CATERING KITA</span>
        </div>

        <div class="menu-item">Dashboard</div>
        <div class="menu-item">Kelola Makanan</div>
        <div class="menu-item active">Daftar Pesanan</div>
        <div class="menu-item">Laporan</div>
        <div class="menu-item">Transaksi</div>
        <div class="menu-item">Metode Pembayaran</div>
        <div class="menu-item">Status Pembayaran</div>
        <div class="menu-item">Status Pengiriman</div>
        <div class="menu-item">Penilaian</div>

        <div class="logout-btn">Logout</div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1 class="page-title"></h1>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
            </div>
        </div><br><br>      

        <h2 class="page-title" style="text-align: center">Edit Pesanan</h2>
        <div class="content">
            <div class="form-wrapper">
                <form action="{{ route('admin.daftarpesanan.update', $pesanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_pesanan">Nama Pesanan</label>
                        <input type="text" name="nama_pesanan" id="nama_pesanan" class="form-control" value="{{ old('nama_pesanan', $pesanan->nama_pesanan) }}" placeholder="Masukkan nama pesanan" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $pesanan->nama_pelanggan) }}" placeholder="Masukkan nama pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pesanan">Tanggal Pesanan</label>
                        <input type="date" name="tanggal_pesanan" id="tanggal_pesanan" class="form-control" value="{{ old('tanggal_pesanan', $pesanan->tanggal_pesanan) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pesanan">Jumlah Pesanan</label>
                        <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" class="form-control" value="{{ old('jumlah_pesanan', $pesanan->jumlah_pesanan) }}" placeholder="Masukkan jumlah pesanan" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_acara">Tanggal Acara</label>
                        <input type="date" name="tanggal_acara" id="tanggal_acara" class="form-control" value="{{ old('tanggal_acara', $pesanan->tanggal_acara) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_pengiriman">Lokasi Pengiriman</label>
                        <input type="text" name="lokasi_pengiriman" id="lokasi_pengiriman" class="form-control" value="{{ old('lokasi_pengiriman', $pesanan->lokasi_pengiriman) }}" placeholder="Masukkan lokasi pengiriman" required>
                    </div>
                    <div class="form-group">
                        <label for="total_harga">Total Harga</label>
                        <input type="number" name="total_harga" id="total_harga" class="form-control" value="{{ old('total_harga', $pesanan->total_harga) }}" placeholder="Masukkan total harga" required>
                    </div>
                    <div class="form-group">
                        <label for="status_pengiriman">Status Pengiriman</label>
                        <select name="status_pengiriman" id="status_pengiriman" class="form-control" required>
                            <option value="diproses" {{ $pesanan->status_pengiriman == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="pending" {{ $pesanan->status_pengiriman == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="selesai" {{ $pesanan->status_pengiriman == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-tambahkan">Simpan Perubahan</button>
                </form>
            </div>            
        </div>
    </div>
</body>
</html>
