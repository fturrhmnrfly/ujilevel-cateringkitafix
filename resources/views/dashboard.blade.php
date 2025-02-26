<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
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

        /* Hero Section */
        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
            background-color: #ffffff;
        }

        .hero-content {
            max-width: 50%;
        }

        .hero-content h1 {
            font-size: 110px;
            color: #3d4750;
        }

        .hero-content .highlight {
            color: #3d4750;
        }

        .hero-content p {
            font-size: 18px;
            margin: 20px 0;
            color: #3d4750;
        }

        .hero-content .btn-shop {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            border: 2px solid #2c2c77;
            color: #2c2c77;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .hero-content .btn-shop:hover {
            background-color: #1a1a5c;
        }

        .hero-image img {
            width: 500px;
        }

        .about {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
            background-color: #ffffff;
        }

        .about-content {
            max-width: 50%;
        }

        .about-content h1 {
            font-size: 110px;
            color: #3d4750;
        }

        .about-content p {
            font-size: 18px;
            margin: 20px 0;
            color: #3d4750;
        }

        .about-content .btn-shop {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            border: 2px solid #2c2c77;
            color: #2c2c77;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .about-content .btn-shop:hover {
            background-color: #1a1a5c;
        }

        .about-image img {
            width: 500px;
        }

        .menu-section {
            padding: 40px;
            background-color: #fff;
        }

        .section-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        .menu-grid {
            display: flex;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 50px;
        }

        .menu-item {
            background: #fff;
            border-radius: 15px;
            width: 60%;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .menu-item-p {
            background: #F8F8FB;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
        }

        .menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .menu-item-content {
            padding: 20px;
        }

        .menu-item-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .menu-item-price {
            color: #2c2c77;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .menu-item-button {
            display: inline-block;
            padding: 8px 20px;
            background-color: #2c2c77;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .menu-item-button:hover {
            background-color: #1a1a5c;
        }

        .menu-item-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .counter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .counter button {
            background-color: #ff9800;
            border: none;
            color: white;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .counter button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .category {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin: 10px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .category-image {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
            border-radius: 50%;
            background-color: #E4E5FA;
            padding: 10px;
        }

        .category-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .category-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .section-title {
            margin-bottom: 40px;
            font-size: 36px;
            color: #333;
            justify-content: center;
            text-align: center;
        }

        .menu-link {
            color: #6A5ACD;
            text-decoration: none;
            font-size: 14px;
        }

        .promo-banner {
            background-color: #6C7FD8;
            border-radius: 15px;
            padding: 40px;
            color: white;
            text-align: center;
            margin-bottom: 50px;
        }

        .promo-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .promo-description {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .promo-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: white;
            color: #4a4af4;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .promo-button:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .program-grid {
                grid-template-columns: 1fr;
            }
        }

        .features-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            background: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            object-fit: contain;
        }

        .feature-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin: 0;
        }

        /* Responsive styling */
        @media (max-width: 992px) {
            .features-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .features-container {
                grid-template-columns: 1fr;
            }
        }

        .contact-section {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 60px 40px;
            max-width: 1200px;
            margin: 0 auto;
            gap: 50px;
        }

        .contact-title {
            text-align: center;
            font-size: 48px;
            font-weight: bold;
            color: #333;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .contact-logo {
            width: 300px;
            height: auto;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .contact-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .contact-text {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }

        @media (max-width: 768px) {
            .contact-section {
                flex-direction: column;
                text-align: center;
            }

            .contact-info {
                align-items: center;
            }

            .contact-item {
                width: 100%;
                justify-content: center;
            }
        }

        .footer {
            background-color: #E5E5E5;
            padding: 40px 0;
            margin-top: 60px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.5fr 2px 2fr 2fr 2fr;
            gap: 30px;
            padding: 0 20px;
        }

        .footer-divider {
            width: 2px;
            background-color: #999;
            height: 100%;
        }

        .footer-logo {
            display: flex;
            flex-direction: column;
        }

        .footer-logo img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .footer-brand-text {
            font-size: 24px;
            font-weight: bold;
        }

        .brand-catering {
            color: #FFA500;
        }

        .brand-kita {
            color: #333;
        }

        .footer-section {
            padding: 0 20px;
        }

        .footer-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .footer-text {
            color: #666;
            line-height: 1.6;
            font-size: 14px;
        }

        .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            font-size: 14px;
        }

        .contact-icon {
            width: 20px;
            height: 20px;
            color: #666;
        }

        @media (max-width: 992px) {
            .footer-container {
                grid-template-columns: 1fr;
            }

            .footer-divider {
                display: none;
            }

            .footer-section {
                padding: 0;
            }
        }

        /* Base animation classes */
        .animate {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .animate.fade-in {
            opacity: 1;
            transform: translateY(0);
        }

        /* Specific animations for different elements */
        .hero-content.animate {
            transform: translateX(-50px);
        }

        .hero-image.animate {
            transform: translateX(50px);
        }

        .feature-card.animate {
            transform: translateY(40px);
            transition-delay: calc(var(--delay) * 0.2s);
        }

        .category.animate {
            transform: scale(0.9);
        }

        .menu-item.animate,
        .menu-item-p.animate {
            transform: translateY(30px);
            transition-delay: calc(var(--delay) * 0.15s);
        }

        .promo-banner.animate {
            transform: scale(0.95);
        }

        /* Animated states */
        .hero-content.animate.fade-in,
        .hero-image.animate.fade-in {
            transform: translateX(0);
        }

        .feature-card.animate.fade-in {
            transform: translateY(0);
        }

        .category.animate.fade-in {
            transform: scale(1);
        }

        .menu-item.animate.fade-in,
        .menu-item-p.animate.fade-in {
            transform: translateY(0);
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
        <div class="breadcrumb-container">
            <div class="breadcrumb">
            </div>
        </div>
        <div class="hero">
            <div class="hero-content">
                <h1>Catering <span class="highlight">Kita</span></h1>
                <p>Delicious food delivered to your door.</p>
                <a href="#" class="btn-shop">Shop Now</a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('assets/homeassets1.jpg') }}" alt="Nasi Box">
            </div>
        </div>
        <div class="about">
            <div class="about-image">
                <img src="{{ asset('assets/homeassets2.png') }}" alt="Nasi Box">
            </div>
            <div class="about-content">
                <h1>About us</h1>
                <h3>Always the Best Choice - SoDelicious, You'll Crave for More!</h3>
                <p>Catering Nikmat Rasa menyediakan nasi box dan snack box untuk berbagai acara seperti ulang tahun,
                    arisan,
                    syukuran, hingga acara kantor. Menu utama kami mencakup nasi bakar, nasi liwet, nasi ayam geprek,
                    nasi
                    kebuli, nasi tumpeng, dan banyak lagi, lengkap dengan sayur dan sambal khas. Dengan pengalaman lebih
                    dari 10
                    tahun melayani area Jabodetabek, kami siap menerima pesanan besar maupun kecil dengan rasa lezat,
                    porsi pas,
                    dan harga terjangkau. Hubungi kami sekarang untuk hidangan terbaik di acara Anda!</p>
                <a href="about" class="btn-shop">Competely</a>
            </div>
        </div>

        <div class="features-container">
            <!-- Fast Delivery Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/homeassets11.png') }}" alt="Fast Delivery" class="feature-icon">
                <h3 class="feature-title">fast delivery</h3>
            </div>

            <!-- Halal Certificate Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/homeassets12.png') }}" alt="Halal Certificate" class="feature-icon">
                <h3 class="feature-title">bersertifikat halal</h3>
            </div>

            <!-- Free Box Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/homeassets13.png') }}" alt="Free Box" class="feature-icon">
                <h3 class="feature-title">Free box</h3>
            </div>

            <!-- Payment Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/homeassets14.png') }}" alt="Payment Methods" class="feature-icon">
                <h3 class="feature-title">Pembayaran</h3>
            </div>
        </div>

        <!-- Categories -->
        <h2 class="section-title">Kategori</h2>
        <div class="category">
            <img src="{{ asset('assets/kategoriassets1.png') }}" alt="Prasmanan" class="category-image">
            <div class="category-title">Prasmanan</div>
            <div class="category-description">Hidangan lengkap dengan konsep prasmanan untuk berbagai acara</div>
            <a href="/menuprasmanan" class="menu-link">50+ Menu</a>
        </div>

        <div class="category">
            <img src="{{ asset('assets/kategoriassets2.png') }}" alt="Nasi Box" class="category-image">
            <div class="category-title">Nasi Box</div>
            <div class="category-description">Paket nasi lengkap dengan lauk dalam kemasan praktis</div>
            <a href="/menunasibox" class="menu-link">50+ Menu</a>
        </div>

        <div class="category">
            <img src="{{ asset('assets/kategoriassets3.png') }}" alt="Perusahaan" class="category-image">
            <div class="category-title">Perusahaan</div>
            <div class="category-description">Nasi tumpeng tradisional untuk acara spesial</div>
            <a href="#" class="menu-link">50+ Menu</a>
        </div>
        </div>

        <div class="menu-section">
            <!-- Popular Menu Section -->
            <h2 class="section-title">Paket Nasi Box</h2>
            <div class="menu-grid">
                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets1.png') }}" alt="Paket Nasi Box A">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Kotak Premium</h3>
                        <h4>Nasi putih, Ayam Goreng, Capcay, Mie Goreng, Telur Balado</h4>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 25.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/menunasibox" class="menu-item-button">Pesan</a>
                    </div>
                </div>
                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets2.png') }}" alt="Paket Nasi Box B">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium</h3>
                        <h4>Nasi putih, Ayam Goreng, Capcay, Mie Goreng, Telur Balado</h4>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 35.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/menunasibox" class="menu-item-button">Pesan</a>
                    </div>
                </div>
            </div>

            <!-- Prasmanan Section -->
            <h2 class="section-title">Prasmanan</h2>
            <div class="menu-grid">
                <div class="menu-item">
                    <img src="{{ asset('assets/homeassets3.jpg') }}" alt="Paket Prasmanan Silver">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Geprek</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 12.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="menuprasmanan" class="menu-item-button">Pesan</a>
                    </div>
                </div>
                <div class="menu-item">
                    <img src="{{ asset('assets/homeassets6.jpg') }}" alt="Paket Prasmanan Gold">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Kecap</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 9.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/menuprasmanan" class="menu-item-button">Pesan</a>
                    </div>
                </div>
                <div class="menu-item">
                    <img src="{{ asset('assets/homeassets5.jpg') }}" alt="Paket Prasmanan Gold">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ikan Goreng</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 10.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/menuprasmanan" class="menu-item-button">Pesan</a>
                    </div>
                </div>
            </div>

            <!-- Promotional Banner -->
            <div class="promo-banner">
                <h2 class="promo-title">Siap Memesan untuk Acara Anda?</h2>
                <p class="promo-description">Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan konsultasi
                    menu
                    yang sesuai dengan acara Anda.</p>
                <a href="#" class="promo-button">Hubungi Kami</a>
            </div>

            <footer class="footer">
                <div class="footer-container">
                    <!-- Logo and Brand Section -->
                    <div class="footer-logo">
                        <div class="footer-brand">
                            <img src="{{ asset('assets/logo.png') }}" alt="Catering Kita Logo">
                            <div class="footer-brand-text">
                                <span class="brand-catering">CATERING</span>
                                <span class="brand-kita">KITA</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vertical Divider -->
                    <div class="footer-divider"></div>

                    <!-- Description Section -->
                    <div class="footer-section">
                        <h3 class="footer-title">Deskripsi</h3>
                        <p class="footer-text">
                            "Catering Kita adalah solusi lengkap untuk kebutuhan belanja makanan Anda. Temukan berbagai
                            produk segar dan berkualitas hanya di sini!" "Belanja mudah dan cepat untuk semua kebutuhan
                            katering Anda. Bergabunglah dengan ribuan pelanggan kami!"
                        </p>
                    </div>

                    <!-- Product Categories Section -->
                    <div class="footer-section">
                        <h3 class="footer-title">Kategori Produk</h3>
                        <p class="footer-text">
                            "Temukan berbagai kategori produk terbaik kami."
                        </p>
                    </div>

                    <!-- Contact Section -->
                    <div class="footer-section">
                        <h3 class="footer-title">Contact</h3>
                        <div class="footer-contact">
                            <div class="contact-item">
                                <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Jln E.sumawijaya GG.amin RT 02/02 Desa pasireurih Kec tamansari</span>
                            </div>
                            <div class="contact-item">
                                <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span>+62 831-1582-6505</span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
    </header>
    <script>
        document.querySelectorAll(".menu-item").forEach(item => {
            let count = 0;
            const countSpan = item.querySelector(".count");
            const minusButton = item.querySelector(".minus");
            const plusButton = item.querySelector(".plus");

            minusButton.addEventListener("click", () => {
                if (count > 0) {
                    count--;
                    countSpan.textContent = count;
                }
            });

            plusButton.addEventListener("click", () => {
                count++;
                countSpan.textContent = count;
            });
        });
        document.querySelectorAll(".menu-item-p").forEach(item => {
            let count = 0;
            const countSpan = item.querySelector(".count");
            const minusButton = item.querySelector(".minus");
            const plusButton = item.querySelector(".plus");

            minusButton.addEventListener("click", () => {
                if (count > 0) {
                    count--;
                    countSpan.textContent = count;
                }
            });

            plusButton.addEventListener("click", () => {
                count++;
                countSpan.textContent = count;
            });
        });

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        // Add animation classes to elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add animate class to elements
            const heroContent = document.querySelector('.hero-content');
            const heroImage = document.querySelector('.hero-image');
            const featureCards = document.querySelectorAll('.feature-card');
            const categories = document.querySelectorAll('.category');
            const menuItems = document.querySelectorAll('.menu-item, .menu-item-p');
            const promoBanner = document.querySelector('.promo-banner');

            // Add animate class and delay attributes
            [heroContent, heroImage].forEach(el => el?.classList.add('animate'));

            featureCards.forEach((card, index) => {
                card.classList.add('animate');
                card.style.setProperty('--delay', index);
            });

            categories.forEach(category => category.classList.add('animate'));

            menuItems.forEach((item, index) => {
                item.classList.add('animate');
                item.style.setProperty('--delay', index);
            });

            if (promoBanner) promoBanner.classList.add('animate');

            // Intersection Observer for scroll animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe all animated elements
            document.querySelectorAll('.animate').forEach(el => observer.observe(el));
        });
    </script>
    <main>
        @yield('content')
    </main>
</body>

</html>
