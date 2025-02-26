<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar Styles */
        nav.navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c2c77;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .navbar .logo img {
            width: 50px;
            /* Ukuran logo */
            height: 50px;
            margin-right: 10px;
        }

        .navbar .logo .text-navbar p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #ffcc00;
            text-transform: uppercase;
        }

        .navbar .logo .text-navbar p:nth-child(2) {
            color: #fff;
        }

        .navbar .search-bar {
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            width: 40%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar .search-bar input[type="text"] {
            border: none;
            outline: none;
            flex: 1;
            padding: 5px;
            font-size: 14px;
        }

        .navbar .search-bar button {
            border: none;
            background: none;
            cursor: pointer;
            color: #2c2c77;
            font-size: 16px;
        }

        .navbar .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        @media (max-width: 768px) {
            nav.navbar {
                padding: 10px 15px;
            }

            body {
                padding-top: 60px;
            }

            .breadcrumb-container {
                margin-top: 60px;
            }
        }

        .navbar .nav-links li {
            display: inline-block;
        }

        .navbar .nav-links li a {
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .navbar .nav-links li a:hover {
            color: #ffcc00;
            /* Warna hover */
        }

        .navbar .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .navbar .profile img {
            width: 40px;
            height: 40px;
        }

        .navbar .profile span {
            font-size: 14px;
            font-weight: bold;
        }

        /* Breadcrumb Styles */
        .breadcrumb-container {
            background-color: #f3f4f6;
            border-bottom: 1px solid #e5e7eb;
            margin-top: 80px;
            /* Add margin to prevent overlap with fixed navbar */
        }

        .breadcrumb {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .breadcrumb-title {
            font-size: 1.25rem;
            color: #374151;
        }

        .breadcrumb-nav {
            color: #6b7280;
        }

        .breadcrumb-nav a {
            color: #6b7280;
            text-decoration: none;
        }

        .pesanan-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .pesanan-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 2rem;
            text-align: left;
            padding: left;
        }

        .status-cards {
            display: flex;
            gap: 2rem;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin: 0 auto;
            max-width: 800px;
            padding: 1
            0rem;
        }

        .status-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .status-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .status-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
        }

        .status-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .status-label {
            font-size: 1rem;
            color: #333;
            margin: 0;
        }

        .status-sublabel {
            font-size: 1rem;
            color: #333;
            margin: 0.5rem 0 0;
        }
    </style>
</head>

<body>
    <header>
    <nav class="navbar">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <div class="text-navbar">
                <p>CATERING</p>
                <p>KITA</p>
            </div>
        </div>

        <!-- Search Bar -->
        <form class="search-bar">
            <input type="text" placeholder="Search products...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>

        <!-- Navigation Links -->
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about.index') }}">About</a></li>
            <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
            <li><a href="{{ route('contact.index') }}">Contact</a></li>
        </ul>

        <!-- Profile Section -->
        <div class="profile">
            <img src="{{ asset('assets/profil.png') }}" alt="Profile">
        </div>
    </nav>

    <div class="pesanan-container">
        <h1 class="pesanan-title">Pesanan saya</h1>
        <div class="status-cards">
            <div class="status-card pembayaran" onclick="navigateTo('pembayaran')">
                <div class="status-icon">
                    <img src="{{ asset('assets/homeassets14.png') }}" alt="Status Pembayaran">
                </div>
                <h3 class="status-label">Status</h3>
                <p class="status-sublabel">Pembayaran</p>
            </div>

            <div class="status-card pengiriman" onclick="navigateTo('pengiriman')">
                <div class="status-icon">
                    <img src="{{ asset('assets/dikirim.png') }}" alt="Status Pengiriman">
                </div>
                <h3 class="status-label">Status</h3>
                <p class="status-sublabel">Pengiriman</p>
            </div>

            <div class="status-card penilaian" onclick="navigateTo('penilaian')">
                <div class="status-icon">
                    <img src="{{ asset('assets/penilaian.png') }}" alt="Penilaian Produk">
                </div>
                <h3 class="status-label">Penilaian</h3>
                <p class="status-sublabel">Produk</p>
            </div>
        </div>
    </div>

    <script>
        function navigateTo(status) {
            const routes = {
                'pembayaran': '/metodepembayaranuser',
                'pengiriman': '/status-pengiriman',
                'penilaian': '/penilaian-produk'
            };
            window.location.href = routes[status];
        }
    </script>
    </header>
</body>

</html>
