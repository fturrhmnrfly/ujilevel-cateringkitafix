<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita Admin - Daftar Pesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            border-radius: 50%;
            padding: 5px;
        }

        .brand-name {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
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

        .menu-item i {
            width: 20px;
            height: 20px;
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
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            padding: 12px;
            background: none;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #2d2a77;
        }
    </style>
</head>

<body>
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


    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Daftar Pesanan</h1>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
            </div>
        </div><br>

        <div class="content">
            <div class="content-header">
                <a href="{{ route('admin.daftarpesanan.create') }}" class="btn-primary">Tambah Pesanan</a>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari pesanan...">
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Jumlah</th>
                            <th>Tanggal Acara</th>
                            <th>Lokasi</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $index => $pesanan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pesanan->nama_pesanan }}</td>
                                <td>{{ $pesanan->nama_pelanggan }}</td>
                                <td>{{ $pesanan->tanggal_pesanan->format('d/m/Y') }}</td>
                                <td>{{ $pesanan->jumlah_pesanan }}</td>
                                <td>{{ $pesanan->tanggal_acara->format('d/m/Y') }}</td>
                                <td>{{ $pesanan->lokasi_pengiriman }}</td>
                                <td>Rp.{{ number_format($pesanan->total_harga, 2) }}</td>
                                <td class="status-{{ $pesanan->status_pengiriman }}">
                                    {{ ucfirst($pesanan->status_pengiriman) }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.daftarpesanan.edit', $pesanan) }}"
                                        class="btn-warning">Edit</a>
                                    <form action="{{ route('admin.daftarpesanan.destroy', $pesanan) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
