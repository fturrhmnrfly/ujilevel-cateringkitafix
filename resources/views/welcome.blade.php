<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Catering Kita - Layanan Catering Terbaik">
    <title>Welcome To Catering Kita</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Move CSS to separate file -->
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #f5f5f5;
    }

    .navbar {
        background-color: #2c2c77;
        padding: 15px 30px;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        display: flex;
        align-items: center;
        color: #fff;
    }

    .logo img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .logo .text-navbar p {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
        color: #ffcc00;
        text-transform: uppercase;
    }

    .logo .text-navbar p:nth-child(2) {
        color: #fff;
    }

    .auth-buttons {
        display: flex;
        gap: 20px;
    }

    .auth-button {
        padding: 8px 20px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .login-btn {
        background-color: transparent;
        border: 2px solid white;
    }

    .register-btn {
        background-color: #ffcc00;
        color: #2c2c77;
    }

    .main-content {
        margin-top: 100px;
        padding: 20px;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .menu-item {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
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
    }

    .login-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .menu-item:hover .login-overlay {
        opacity: 1;
    }

    .login-message {
        color: white;
        text-align: center;
        padding: 20px;
    }

    .login-link {
        display: inline-block;
        padding: 10px 20px;
        background: #ffcc00;
        color: #2c2c77;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        margin-top: 10px;
    }

    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            padding: 10px;
        }

        .auth-buttons {
            margin-top: 10px;
        }

        .menu-grid {
            grid-template-columns: 1fr;
        }
    }

    img {
        max-width: 100%;
        height: auto;
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

    .hero-image {
        background-color: #2d2e6c;
        width: 50%;
        height: 500px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 0 0 0 200px;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 20% 100%, 0 85%);
        overflow: hidden; /* Add this to contain the absolute positioned image */
    }

    .main-hero-image {
        width: 500px;
        position: relative;
        z-index: 2; /* Higher z-index to appear in front */
    }

    .background-curve {
        position: absolute;
        bottom: 0;
        right: 0;
        z-index: 1; /* Lower z-index to appear behind */
        width: 100%;
        height: auto;
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
        overflow: hidden;
    }

    .section-title {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
    }

    .menu-grid {
        display: flex;
        gap: 40px;
        margin-bottom: 50px;
        overflow-x: auto;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
        padding: 30px 0;
        cursor: grab;
    }

    .menu-grid::-webkit-scrollbar {
        display: none;
    }

    .menu-item, .menu-item-p {
        flex: 0 0 380px;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .menu-item img, .menu-item-p img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .menu-item-content {
        padding: 25px;
    }

    .menu-item-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
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

    .login-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .menu-item:hover .login-overlay {
        opacity: 1;
    }

    .menu-item,
    .menu-item-p {
        flex: 0 0 300px; /* Fixed width for items */
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        animation: slideLoop 20s linear infinite;
    }

    /* Sliding animation */
    @keyframes slideLoop {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* Navigation buttons styling */
    .menu-nav-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .menu-nav-button {
        background-color: #2c2c77;
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s;
    }

    .menu-nav-button:hover {
        background-color: #1a1a5c;
    }

    .hero-content {
        max-width: 50%;
        display: flex;
        justify-content: center;
        margin-right: 20px;
    }

    .hero-image {
        background-color: #2d2e6c;
        width: 50%;
        height: 500px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 0 0 0 200px;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 20% 100%, 0 85%);
    }

    .logo-container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 100px;
    }

    .chef-hat {
        width: 200px;
        height: auto;
        position: absolute;
        top: -40px;
        left: -80px;
        z-index: 1;
        margin-left: 20px;
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <div class="text-navbar">
                <p>CATERING</p>
                <p>KITA</p>
            </div>
        </div>
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="auth-button login-btn">Login</a>
            <a href="{{ route('register') }}" class="auth-button register-btn">Register</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Hero Section -->
        <div class="hero">
            <div class="hero-content animate">
                <h1>Catering <span class="highlight">Kita</span></h1>
            </div>
            <div class="hero-image">
                <img src="{{ asset('assets/homeassets1.jpg') }}" alt="Nasi Box" class="main-hero-image">
                <img src="{{ asset('assets/lengkung.png') }}" alt="lengkung" class="background-curve">
            </div>
        </div>

        <!-- About Section -->
        <div class="about">
            <div class="about-image animate">
                <img src="{{ asset('assets/homeassets2.png') }}" alt="Nasi Box">
            </div>
            <div class="about-content animate">
                <h1>Tentang Kami</h1>
                <p>Catering Nikmat Rasa menyediakan nasi box dan snack box untuk berbagai acara seperti ulang tahun,
                    arisan,
                    syukuran, hingga acara kantor. Menu utama kami mencakup nasi bakar, nasi liwet, nasi ayam geprek,
                    nasi
                    kebuli, nasi tumpeng, dan banyak lagi, lengkap dengan sayur dan sambal khas. Dengan pengalaman lebih
                    dari 10
                    tahun melayani area Jabodetabek, kami siap menerima pesanan besar maupun kecil dengan rasa lezat,
                    porsi pas,
                    dan harga terjangkau. Hubungi kami sekarang untuk hidangan terbaik di acara Anda!</p>
                <a href="about" class="btn-shop">Selengkapnya</a>
            </div>
        </div>

        <!-- Features Section -->
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

        <!-- Categories Section -->
        <section class="categories">
            <h2 class="section-title">Kategori</h2>
            <div class="category">
                <!-- Prasmanan Category -->
                <img src="{{ asset('assets/kategoriassets1.png') }}" alt="Prasmanan" class="category-image">
                <div class="category-title">Prasmanan</div>
                <div class="category-description">Hidangan lengkap dengan konsep prasmanan untuk berbagai acara</div>
                <a href="/menuprasmanan" class="menu-link">50+ Menu</a>
            </div>

            <div class="category">
                <!-- Nasi Box Category -->
                <img src="{{ asset('assets/kategoriassets2.png') }}" alt="Nasi Box" class="category-image">
                <div class="category-title">Nasi Box</div>
                <div class="category-description">Paket nasi lengkap dengan lauk dalam kemasan praktis</div>
                <a href="/menunasibox" class="menu-link">50+ Menu</a>
            </div>
        </section>

        <!-- Menu Section -->
        <div class="menu-section">
            <!-- Popular Menu Section -->
            <h2 class="section-title">Paket Nasi Box</h2>
            <div class="menu-grid" id="nasi-box">
                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets1.png') }}" alt="Paket Nasi Box A">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium A</h3>
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
                        <h3 class="menu-item-title">Paket Nasi Box Premium B</h3>
                        <h4>Nasi putih, Ayam Bakar, Tumis Sayur, Tempe Goreng</h4>
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

                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets1.png') }}" alt="Paket Nasi Box C">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium C</h3>
                        <h4>Nasi putih, Ikan Goreng, Oseng Tempe, Sayur Asem</h4>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 30.000</p>
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
                    <img src="{{ asset('assets/paketassets2.png') }}" alt="Paket Nasi Box D">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium D</h3>
                        <h4>Nasi Goreng Spesial, Ayam Crispy, Telur Dadar</h4>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 40.000</p>
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
            <div class="menu-grid" id="prasmanan">
                <div class="menu-item">
                    <img src="{{ asset('assets/homeassets3.jpg') }}" alt="Ayam Geprek">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Geprek</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 12.000</p>
                            <div class="counter">
                                <button type="button" class="minus">-</button>
                                <span class="count">0</span>
                                <button type="button" class="plus">+</button>
                            </div>
                        </div>
                        <form class="add-to-cart-form">
                            <input type="hidden" name="item_id" value="1">
                            <input type="hidden" name="item_name" value="Ayam Geprek">
                            <input type="hidden" name="item_price" value="12000">
                            <input type="hidden" name="quantity" class="quantity-input" value="0">
                            <button type="button" class="menu-item-button add-to-cart-btn" disabled>Pesan</button>
                        </form>
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
                        <form class="add-to-cart-form">
                            <input type="hidden" name="item_id" value="2">
                            <input type="hidden" name="item_name" value="Ayam Kecap">
                            <input type="hidden" name="item_price" value="9000">
                            <input type="hidden" name="quantity" class="quantity-input" value="0">
                            <button type="button" class="menu-item-button add-to-cart-btn" disabled>Pesan</button>
                        </form>
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
                        <form class="add-to-cart-form">
                            <input type="hidden" name="item_id" value="1">
                            <input type="hidden" name="item_name" value="Ikan Goreng">
                            <input type="hidden" name="item_price" value="10000">
                            <input type="hidden" name="quantity" class="quantity-input" value="0">
                            <button type="button" class="menu-item-button add-to-cart-btn" disabled>Pesan</button>
                        </form>
                    </div>
                </div>
            </div>

        <!-- Promo Banner -->
        <div class="promo-banner animate">
            <h2 class="promo-title">Siap Memesan untuk Acara Anda?</h2>
            <p class="promo-description">Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan konsultasi
                menu
                yang sesuai dengan acara Anda.</p>
        </div>
    </div>

    <!-- Footer -->
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

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mengambil item keranjang dari localStorage
            function getCartItems() {
                return JSON.parse(localStorage.getItem('cartItems')) || [];
            }

            // Fungsi untuk menyimpan item ke keranjang
            function saveCartItems(items) {
                localStorage.setItem('cartItems', JSON.stringify(items));
            }

            // Fungsi untuk menambah item ke keranjang
            function addToCart(item) {
                let cartItems = getCartItems();
                let existingItem = cartItems.find(cartItem => cartItem.id === item.id);

                if (existingItem) {
                    existingItem.quantity += item.quantity;
                } else {
                    cartItems.push(item);
                }

                saveCartItems(cartItems);
                alert('Item berhasil ditambahkan ke keranjang!');
            }

            // Event listener untuk tombol tambah ke keranjang
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    let menuItem = this.closest('.menu-item');
                    let itemId = parseInt(menuItem.querySelector('input[name="item_id"]').value);
                    let itemName = menuItem.querySelector('input[name="item_name"]').value;
                    let itemPrice = parseInt(menuItem.querySelector('input[name="item_price"]')
                        .value);
                    let itemQuantity = parseInt(menuItem.querySelector('.quantity-input').value);
                    let itemImage = menuItem.querySelector('img').src;

                    if (itemQuantity > 0) {
                        addToCart({
                            id: itemId,
                            name: itemName,
                            price: itemPrice,
                            quantity: itemQuantity,
                            image: itemImage
                        });
                    } else {
                        alert('Pilih jumlah terlebih dahulu!');
                    }
                });
            });

            // Update tombol "Pesan" jika jumlah berubah
            document.querySelectorAll('.counter button').forEach(button => {
                button.addEventListener('click', function() {
                    let counter = this.closest('.counter');
                    let quantityInput = counter.querySelector('.count');
                    let hiddenQuantityInput = counter.closest('.menu-item').querySelector(
                        '.quantity-input');
                    let addToCartButton = counter.closest('.menu-item').querySelector(
                        '.add-to-cart-btn');

                    let currentQuantity = parseInt(quantityInput.textContent);

                    if (this.classList.contains('plus')) {
                        currentQuantity++;
                    } else if (this.classList.contains('minus') && currentQuantity > 0) {
                        currentQuantity--;
                    }

                    quantityInput.textContent = currentQuantity;
                    hiddenQuantityInput.value = currentQuantity;

                    addToCartButton.disabled = currentQuantity === 0;
                });
            });
        });
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
        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const searchInput = document.getElementById('searchInput');

            // Prevent empty searches
            searchForm.addEventListener('submit', function(e) {
                if (searchInput.value.trim() === '') {
                    e.preventDefault();
                    alert('Please enter a search term');
                }
            });

            // Optional: Add live search as you type (for enhanced UX)
            searchInput.addEventListener('input', function() {
                // You can implement AJAX search here if desired
                // This would show results as the user types

                // Example placeholder for AJAX functionality:
                /*
                if (this.value.length > 2) {
                    fetch(`/api/search?query=${this.value}`)
                        .then(response => response.json())
                        .then(data => {
                            // Display search suggestions
                        })
                        .catch(error => console.error('Error:', error));
                }
                */
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Handle all menu items (both standard and premium)
            const menuItems = document.querySelectorAll('.menu-item, .menu-item-p');

            menuItems.forEach(item => {
                // Get elements
                const countSpan = item.querySelector(".count");
                const minusButton = item.querySelector(".minus");
                const plusButton = item.querySelector(".plus");
                const quantityInput = item.querySelector(".quantity-input");
                const addToCartBtn = item.querySelector(".add-to-cart-btn");

                let count = 0;

                // Minus button click
                minusButton.addEventListener("click", () => {
                    if (count > 0) {
                        count--;
                        countSpan.textContent = count;
                        quantityInput.value = count;

                        // Disable the order button if count is 0
                        if (count === 0) {
                            addToCartBtn.disabled = true;
                        }
                    }
                });

                // Plus button click
                plusButton.addEventListener("click", () => {
                    count++;
                    countSpan.textContent = count;
                    quantityInput.value = count;

                    // Enable the order button when count is > 0
                    if (addToCartBtn.disabled && count > 0) {
                        addToCartBtn.disabled = false;
                    }
                });

                // Form submission handling (optional: for immediate feedback)
                const form = item.querySelector('.add-to-cart-form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        // Only allow submission if quantity > 0
                        if (count === 0) {
                            e.preventDefault();
                            alert('Please select a quantity first');
                            return false;
                        }

                        // Optional: you can add AJAX submission here to avoid page refresh
                        // This is just an example of how you might do it
                        /*
                        e.preventDefault();
                        
                        fetch(this.action, {
                            method: 'POST',
                            body: new FormData(this),
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Show success message or update cart counter
                                alert('Item added to cart successfully!');
                                
                                // Reset counter after successful addition
                                count = 0;
                                countSpan.textContent = count;
                                quantityInput.value = count;
                                addToCartBtn.disabled = true;
                            } else {
                                alert('Error adding item to cart');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                        */
                    });
                }
            });


            // Make cart icon clickable
            document.querySelector('.cart-icon').addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = '/keranjang';
            });
        });
    </script>
</body>

</html>
