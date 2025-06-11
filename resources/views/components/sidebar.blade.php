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
        margin-bottom: 20px; /* Kurangi margin bottom */
        padding-bottom: 20px; /* Tambahkan padding bottom untuk space sebelum divider */
        position: relative; /* Untuk positioning divider */
        flex-shrink: 0; /* Mencegah logo terpotong saat scroll */
    }

    /* Divider di bawah CATERING KITA */
    .logo-container::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #333; /* Abu-abu gelap, tidak terlalu hitam */
        opacity: 0.7;
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
        background-color: #B19370; /* Updated background color */
        min-height: 100vh;
        max-height: 100vh; /* Batasi tinggi maksimum */
        padding: 20px;
        color: white;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        overflow: hidden; /* Cegah overflow pada container utama */
    }

    .sidebar-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden; /* Cegah overflow pada content wrapper */
    }

    .menu-items {
        flex: 1;
        margin-top: 10px; /* Space setelah divider */
        overflow-y: auto; /* Enable vertical scrolling */
        overflow-x: hidden; /* Cegah horizontal scrolling */
        padding-right: 5px; /* Space untuk scrollbar */
    }

    /* Custom scrollbar styling */
    .menu-items::-webkit-scrollbar {
        width: 6px;
    }

    .menu-items::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }

    .menu-items::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .menu-items::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    /* Firefox scrollbar styling */
    .menu-items {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.3) rgba(255, 255, 255, 0.1);
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
        flex-shrink: 0; /* Mencegah item menu terpotong */
    }

    .menu-item:hover {
        background-color: #A08660; /* Darker shade for hover effect */
    }

    .menu-item i {
        width: 20px;
        height: 20px;
        flex-shrink: 0; /* Mencegah icon terpotong */
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
        /* Hilangkan position absolute */
        padding: 12px 15px;
        background: none;
        border: none;
        color: white;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s;
        margin-top: 20px; /* Space dari menu items */
        width: 100%;
        text-align: left;
        flex-shrink: 0; /* Mencegah logout button terpotong */
    }

    .logout-btn:hover {
        background-color: #A08660; /* Matching hover color */
    }

    .notification-badge {
        background-color: red;
        border-radius: 50%;
        padding: 5px 10px;
        color: white;
        font-size: 0.8rem;
        margin-left: auto;
    }

    /* Responsif untuk layar kecil */
    @media (max-height: 600px) {
        .sidebar {
            padding: 15px;
        }
        
        .logo-container {
            margin-bottom: 15px;
            padding-bottom: 15px;
        }
        
        .menu-item {
            padding: 10px 12px;
            margin: 6px 0;
        }
        
        .logout-btn {
            margin-top: 15px;
            padding: 10px 12px;
        }
    }
</style>
<div class="sidebar">
    <div class="sidebar-content">
        <div class="logo-container">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
            <span class="brand-name">CATERING KITA</span>
        </div>

        <div class="menu-items">
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.tentangkami.index') }}" class="menu-item active">
                <i class="fa-solid fa-user"></i>
                Tentang Kami
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="menu-item active">
                <i class="fa-solid fa-folder"></i>
                Kategori
            </a>
            <a href="{{ route('admin.karyawan.index') }}" class="menu-item active">
                <i class="fa-solid fa-users"></i>
                Daftar Pengguna
            </a>
            <a href="{{ route('admin.kelolamakanan.index') }}" class="menu-item">
                <i class="fa-solid fa-cube"></i>
                Kelola Makanan
            </a>
            <a href="{{ route('admin.daftarpesanan.index') }}" class="menu-item">
                <i class="fa-solid fa-clipboard-list"></i>
                Daftar Pesanan
            </a>
            <a href="{{ route('admin.laporan.index') }}" class="menu-item">
                <i class="fa-solid fa-chart-bar"></i>
                Laporan Keuangan
            </a>
            <a href="{{ route('admin.transaksi.index') }}" class="menu-item">
                <i class="fa-solid fa-credit-card"></i>
                Transaksi
            </a>
            <a href="{{ route('admin.metodepembayaran.index') }}" class="menu-item">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                Metode Pembayaran
            </a>
            <a href="{{ route('admin.penilaian.index') }}" class="menu-item">
                <i class="fa-solid fa-medal"></i>
                Penilaian
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</div>
