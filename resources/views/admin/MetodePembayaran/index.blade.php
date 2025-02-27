<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
</head>

<body>
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
            <span class="brand-name">CATERING KITA</span>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="menu-item">
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
        <a href="{{ route('admin.metodepembayaran.index') }}" class="menu-item active">
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
            <span class="page-title">Metode Pembayaran</span>
            <div class="admin-profile">
                <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
                <span>Admin</span>
            </div>
        </div>

        <div class="content">
            <div class="content-header">
                <a href="{{ route('admin.metodepembayaran.create') }}" class="btn-primary">Buat Metode Pembayaran</a>
                <input type="text" class="search-input" placeholder="Search metode pembayaran...">
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Metode Pembayaran</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Tanggal Ditambahkan</th>
                            <th>Admin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($metodePembayaran as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->metode_pembayaran }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>{{ $item->admin }}</td>
                            <td>
                                <a href="{{ route('admin.metodepembayaran.edit', $item->id) }}" class="btn-warning">Edit</a>
                                <form action="{{ route('admin.metodepembayaran.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>