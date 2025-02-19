    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catering Kita Admin</title>
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

            .card-content {
                text-decoration: none;
            }

            .sidebar {
                width: 250px;
                background-color: #1e1b4b;
                min-height: 100vh;
                padding: 20px;
                color: white;
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
                flex: 1;
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
            }

            .dashboard-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
                padding: 20px;
            }

            .dashboard-card {
                background-color: white;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                position: relative;
                overflow: hidden;
                min-height: 100px;
                transition: box-shadow 0.3s;
            }

            .dashboard-card:hover {
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .card-indicator {
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 4px;
            }

            .blue {
                background-color: #3b82f6;
            }

            .green {
                background-color: #22c55e;
            }

            .orange {
                background-color: #f97316;
            }

            .red {
                background-color: #ef4444;
            }

            .yellow {
                background-color: #eab308;
            }

            .pink {
                background-color: #ec4899;
            }

            .purple {
                background-color: #a855f7;
            }

            .card-content {
                margin-left: 10px;
                font-size: 1rem;
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
            }

            .logout-btn:hover {
                background-color: #2d2a77;
            }

            .dashboard-card {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                /* Menghapus garis bawah */
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 20px;
                background-color: #f9f9f9;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            /* Menghapus efek biru saat link di-klik */
            .dashboard-card:focus {
                outline: none;
            }

            /* Menghapus efek hover standar dari link */
            .dashboard-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Menjaga style indikator tetap terlihat */
            .card-indicator {
                width: 16px;
                height: 16px;
                border-radius: 50%;
                margin-bottom: 8px;
            }
        </style>
    </head>

    <body>
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
            <a href="{{ route('admin.statuspembayaran.index') }}" class="menu-item">Status Pembayaran</a>
            {{-- <a href="{{ route('admin.statuspengiriman.index') }}" class="menu-item">Status Pengiriman</a>
            <a href="{{ route('admin.penilaian.index') }}" class="menu-item">Penilaian</a> --}}

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>



        <div class="main-content">
            <div class="header">
                <h1 class="page-title">Dashboard</h1>
                <div class="admin-profile">
                    <span>Admin</span>
                    <div class="admin-avatar"></div>
                    <img src="{{ asset('assets/profil.png') }}" alt="admin-avatar" class="admin-avatar">
                </div>
            </div>

            <div class="dashboard-grid">
                <a href="{{ route('admin.dashboard') }}" class="dashboard-card">
                    <div class="card-indicator blue"></div>
                    <div class="card-content">Dashboard</div>
                </a>
                <a href="{{ route('admin.kelolamakanan.index') }}" class="dashboard-card">
                    <div class="card-indicator green"></div>
                    <div class="card-content">Kelola Makanan</div>
                </a>
                <a href="{{ route('admin.stokbahan.index') }}" class="dashboard-card">
                    <div class="card-indicator orange"></div>
                    <div class="card-content">Stok Bahan</div>
                </a>
                <a href="{{ route('admin.daftarpesanan.index') }}" class="dashboard-card">
                    <div class="card-indicator red"></div>
                    <div class="card-content">Daftar Pesanan</div>
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="dashboard-card">
                    <div class="card-indicator yellow"></div>
                    <div class="card-content">Laporan</div>
                </a>
                <a href="{{ route('admin.transaksi.index') }}" class="dashboard-card">
                    <div class="card-indicator pink"></div>
                    <div class="card-content">Transaksi</div>
                </a>
                <a href="{{ route('admin.metodepembayaran.index') }}" class="dashboard-card">
                    <div class="card-indicator purple"></div>
                    <div class="card-content">Metode Pembayaran</div>
                </a>
                <a href="{{ route('admin.statuspembayaran.index') }}" class="dashboard-card">
                    <div class="card-indicator yellow"></div>
                    <div class="card-content">Status Pembayaran</div>
                </a>
                {{-- <a href="{{ route('admin.statuspengiriman.index') }}" class="dashboard-card">
                    <div class="card-indicator yellow"></div>
                    <div class="card-content">Status Pengiriman</div>
                </a>
                <a href="{{ route('admin.penilaian.index    ') }}" class="dashboard-card">
                    <div class="card-indicator pink"></div>
                    <div class="card-content">Penilaian</div>
                </a> --}}
            </div>

        </div>
    </body>

    </html>
