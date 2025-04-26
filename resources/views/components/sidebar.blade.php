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
    }

    .header {
        background: white;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 15px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .logo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        padding: 5px;
    }

    .brand-name {
        font-size: 1.2rem;
        font-weight: bold;
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

    .main-content {
        margin-left: 250px;
        flex: 1;
        padding: 20px;
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

    .notification-badge {
        background-color: red;
        border-radius: 50%;
        padding: 5px 10px;
        color: white;
        font-size: 0.8rem;
        margin-left: auto;
    }
</style>
<div class="sidebar">
    <div class="logo-container">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
        <span class="brand-name">CATERING KITA</span>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="menu-item active">
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>
    <a href="{{ route('admin.tentangkami.index') }}" class="menu-item active">
        <i class="fa-solid fa-house"></i>
        Tentang Kami
    </a>
    <a href="{{ route('admin.kategori.index') }}" class="menu-item active">
        <i class="fa-solid fa-house"></i>
        Kategori
    </a>
    <a href="{{ route('admin.kelolamakanan.index') }}" class="menu-item">
        <i class="fa-solid fa-mug-hot"></i>
        Kelola Makanan
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
    <a href="{{ route('admin.penilaian.index') }}" class="menu-item">
        <i class="fa-solid fa-medal"></i>
        Penilaian
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </button>
    </form>
    
</div>
