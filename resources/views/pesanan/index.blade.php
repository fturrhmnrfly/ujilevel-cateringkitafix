<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita User - Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 80px; /* Make room for the fixed navbar */
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar Styles - Unchanged */
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
            border-radius: 50%;
        }

        /* Fixed Tab Navigation - Modified with better spacing */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 15px; /* Added top padding for spacing */
        }
        
        .tab-navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }
        
        .tab-btn {
            flex: 1;
            padding: 12px 20px; /* Increased horizontal padding */
            text-align: center;
            background-color: #f0f0f0;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
            margin: 0 5px; /* Added margin between buttons */
            border-radius: 4px;
        }
        
        .tab-btn:first-child {
            margin-left: 0;
        }
        
        .tab-btn:last-child {
            margin-right: 0;
        }
        
        .tab-btn.active {
            background-color: #2c2c7b;
            color: white;
        }

        /* Rest of your CSS remains unchanged */
        .order-card {
            background-color: white;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        /* Other CSS remains the same */
    </style>
</head>
<body>
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
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('about.index') }}">About</a></li>
            <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
            <li><a href="{{ route('contact.index') }}">Contact</a></li>
        </ul>

        <!-- Profile Section -->
        <div class="profile">
            <a href="{{ route('profile.show') }}">
                <img src="{{ asset('assets/profil.png') }}" alt="Profile">
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="tab-navigation">
            <a href="{{ route('pesanan.index') }}" class="tab-btn {{ request()->routeIs('pesanan.index') ? 'active' : '' }}">Semua Pesanan</a>
            <a href="{{ route('pesanan.process') }}" class="tab-btn {{ request()->routeIs('pesanan.process') ? 'active' : '' }}">Diproses</a>
            <a href="{{ route('pesanan.shipped') }}" class="tab-btn {{ request()->routeIs('pesanan.shipped') ? 'active' : '' }}">Dikirim</a>
            <a href="{{ route('pesanan.completed') }}" class="tab-btn {{ request()->routeIs('pesanan.completed') ? 'active' : '' }}">Selesai</a>
        </div>

        <!-- Tab content sections remain the same -->
    </div>

    <!-- Rest of your HTML remains the same -->
</body>
</html>