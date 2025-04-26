<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Catering Kita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
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
            background-color: #6b7280;
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
            display: flex;
            justify-content: center;
            margin-right: 20px;
        }

        .hero-content h1 {
            font-size: 110px;
            color: #3d4750;
            position: relative;
            z-index: 2;
            text-align: center;
            /* Center the text */
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
            /* Menangani overflow */
        }

        .section-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        /* Update menu grid styles */
        .menu-grid {
            display: flex;
            flex-wrap: nowrap;
            gap: 20px;
            overflow-x: hidden;
            padding: 20px 0;
            position: relative;
            width: 100%;
        }

        .menu-item,
        .menu-item-p {
            flex: 0 0 300px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            animation: slideIn 20s linear infinite;
            margin: 10px;
        }

        /* Update animation keyframes */
        @keyframes slideIn {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Update menu item content styles */
        .menu-item-content {
            padding: 15px;
        }

        .menu-item-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .menu-item-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .menu-item-price {
            color: #2c2c77;
            font-weight: bold;
        }

        /* Update button styles */
        .menu-item-button {
            display: block;
            width: 90%;
            padding: 10px;
            background-color: #2c2c77;
            color: white;
            text-align: center;
            border-radius: 8px;
            margin-top: 15px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .menu-item-button:hover {
            background-color: #1a1a5c;
        }

        /* Add smooth infinite scroll */
        .menu-grid::after {
            content: "";
            display: block;
            clear: both;
        }

        /* Hide scrollbar */
        .menu-grid::-webkit-scrollbar {
            display: none;
        }

        .menu-item img,
        .menu-item-p img {
            width: 100%;
            height: 250px;
            /* Increased height */
            object-fit: cover;
        }

        .menu-item-content {
            padding: 25px;
            /* Increased padding */
        }

        .menu-item-title {
            font-size: 22px;
            /* Increased font size */
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
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 5px;
            background: #fff;
        }

        .counter button {
            background-color: #2c2c77;
            border: none;
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .counter button:hover {
            background-color: #1a1a5c;
        }

        .counter button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .counter input.count {
            width: 50px;
            text-align: center;
            border: none;
            font-size: 14px;
            padding: 5px;
            -moz-appearance: textfield;
            background: transparent;
        }

        /* Remove spinner arrows */
        .counter input.count::-webkit-outer-spin-button,
        .counter input.count::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
            margin-left: 20px;
        }

        .footer-logo img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
            margin-left: -150px;
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

        /* Add navigation buttons */
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

        .logo-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 100px;
            /* Add margin to offset the chef hat */
        }

        .chef-hat {
            width: 200px;
            height: auto;
            position: absolute;
            top: -40px;
            left: -80px;
            /* Adjust left position */
            z-index: 1;
            margin-left: 20px
        }

        .hero-content h1 {
            font-size: 110px;
            color: #3d4750;
            position: relative;
            z-index: 2;
            text-align: center;
            /* Center the text */
        }

        .counter input.count {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            font-size: 14px;
            -moz-appearance: textfield;
        }

        .counter input.count::-webkit-inner-spin-button,
        .counter input.count::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Add these styles to your existing CSS */
        .comments-section {
            padding: 40px;
            background-color: #fff;
        }

        .comments-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .comment-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .comment-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .user-name {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .rating {
            color: #FFD700;
            font-size: 14px;
        }

        .comment-text {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        @media (max-width: 768px) {
            .comments-container {
                grid-template-columns: 1fr;
            }
        }

        /* Add this to your existing navbar styles */
        .notification-icon {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            position: relative;
            padding: 8px;
            transition: opacity 0.3s;
        }

        .notification-icon:hover {
            opacity: 0.8;
        }

        .notification-icon svg {
            width: 20px;
            height: 20px;
        }

        /* Add this if you want to show a notification badge */
        .notification-icon[data-count]:after {
            content: attr(data-count);
            position: absolute;
            top: 0;
            right: 0;
            background: #ff4444;
            color: white;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 50%;
            min-width: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <x-navbar></x-navbar>

        <div class="breadcrumb-container">
            <div class="breadcrumb">
            </div>
        </div>
        <div class="hero">
            <div class="hero-content">
                <div class="logo-container">
                    <img src="{{ asset('assets/topikoki.png') }}" alt="topikoki" class="chef-hat">
                    <h1>Catering <span class="highlight">Kita</span></h1>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('assets/homeassets1.jpg') }}" alt="Nasi Box" class="main-hero-image">
                <img src="{{ asset('assets/lengkung.png') }}" alt="lengkung" class="background-curve">
            </div>
        </div>
        <div class="about">
            <div class="about-image">
                <img src="{{ asset('assets/homeassets2.png') }}" alt="Nasi Box">
            </div>
            <div class="about-content">
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
                <img src="{{ asset('assets/homeassets14.png') }}" alt="Payment" class="feature-icon">
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
        </div>

        <div class="menu-section">
            <!-- Popular Menu Section -->
            <h2 class="section-title">Paket Nasi Box</h2>
            <div class="menu-grid" id="nasi-box">
                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets1.png') }}" alt="Paket Nasi Box A">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Kotak Premium A</h3>
                        <h4>Nasi Liwet, Ayam Bakar, Tumis Jagung Manis, Telur Ceplok, Sambal</h4>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 25.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Pesan</a>
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
                        <a href="/keranjang" class="menu-item-button">Pesan</a>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakpremium2.png') }}" alt="Paket Nasi Box C">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium C</h3>
                        <h4>Nasi putih, Ayam Goreng, daging cincang,tempe orak arik,
                            samba, lalapan</h4>
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
                    <img src="{{ asset('assets/nasikotakpremium3.png') }}" alt="Paket Nasi Box D">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium D</h4>
                            <h4>Nasi putih, daging sapi,sate,naget,sayur,telur kuning,kacang , sambal saus </h4>
                            <div class="menu-item-details">
                                <p class="menu-item-price">Rp 40.000</p>
                                <div class="counter">
                                    <button class="minus">-</button>
                                    <span class="count">0</span>
                                    <button class="plus">+</button>
                                </div>
                            </div>
                            <a href="/keranjang" class="menu-item-button">Pesan</a>
                    </div>
                </div>
                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakpremium4.png') }}" alt="Paket Nasi Box E">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium E</h3>
                        <h4>Nasi putih, telur, mie, capcay, ayam suir, sambal, kentang</h4>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 40.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Pesan</a>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakthailand.png') }}" alt="Paket Nasi Thailand">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Campur Thailand</h3>
                        <h4>Nasi kecap, udang, chicken, sayur</h4>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 40.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Pesan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prasmanan Section -->
        <h2 class="section-title">Prasmanan</h2>
        <div class="menu-grid" id="prasmanan">
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
                        <input type="hidden" name="item_id" value="1">
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
                        <input type="hidden" name="item_id" value="2">
                        <input type="hidden" name="item_name" value="Ikan Goreng">
                        <input type="hidden" name="item_price" value="10000">
                        <input type="hidden" name="quantity" class="quantity-input" value="0">
                        <button type="button" class="menu-item-button add-to-cart-btn" disabled>Pesan</button>
                    </form>
                </div>
            </div>
            <div class="menu-item">
                <img src="{{ asset('assets/capcay.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Capcay</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                        <div class="counter">
                            <button class="minus">-</button>
                            <span class="count">0</span>
                            <button class="plus">+</button>
                        </div>
                    </div>
                    <form class="add-to-cart-form">
                        <input type="hidden" name="item_id" value="3">
                        <input type="hidden" name="item_name" value="Capcay">
                        <input type="hidden" name="item_price" value="10000">
                        <input type="hidden" name="quantity" class="quantity-input" value="0">
                        <button type="button" class="menu-item-button add-to-cart-btn" disabled>Pesan</button>
                    </form>
                </div>
            </div>
            <div class="menu-item">
                <img src="{{ asset('assets/bihungoreng.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Bihun Goreng</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                        <div class="counter">
                            <button class="minus">-</button>
                            <span class="count">0</span>
                            <button class="plus">+</button>
                        </div>
                    </div>
                    <form class="add-to-cart-form">
                        <input type="hidden" name="item_id" value="4">
                        <input type="hidden" name="item_name" value="Bihun Goreng">
                        <input type="hidden" name="item_price" value="10000">
                        <input type="hidden" name="quantity" class="quantity-input" value="0">
                        <button type="button" class="menu-item-button add-to-cart-btn" disabled>Pesan</button>
                    </form>
                </div>
            </div>
            <div class="menu-item">
                <img src="{{ asset('assets/miegoreng.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Mie Goreng</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                        <div class="counter">
                            <button class="minus">-</button>
                            <span class="count">0</span>
                            <button class="plus">+</button>
                        </div>
                    </div>
                    <form class="add-to-cart-form">
                        <input type="hidden" name="item_id" value="5">
                        <input type="hidden" name="item_name" value="Mie Goreng">
                        <input type="hidden" name="item_price" value="10000">
                        <input type="hidden" name="quantity" class="quantity-input" value="0">
                        <button type="button" class="menu-item-button add-to-cart-btn" disabled>Pesan</button>
                    </form>
                </div>
            </div>
            <div class="menu-item">
                <img src="{{ asset('assets/homeassets4.jpg') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Telur Balado</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 5.000</p>
                        <div class="counter">
                            <button class="minus">-</button>
                            <span class="count">0</span>
                            <button class="plus">+</button>
                        </div>
                    </div>
                    <form class="add-to-cart-form">
                        <input type="hidden" name="item_id" value="6">
                        <input type="hidden" name="item_name" value="Telur Balado">
                        <input type="hidden" name="item_price" value="5000">
                        <input type="hidden" name="quantity" class="quantity-input" value="0">
                        <button type="button" class="menu-item-button add-to-cart-btn" disabled>Pesan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add this section before the promo banner -->
    <div class="comments-section">
        <h2 class="section-title">Komentar Pelanggan</h2>
        <div class="comments-container">
            <!-- Comment 1 -->
            <div class="comment-card">
                <div class="comment-header">
                    <img src="{{ asset('assets/profil.png') }}" alt="User" class="user-avatar">
                    <div class="comment-info">
                        <h4 class="user-name">Ahmad Faizin</h4>
                        <div class="rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
                <p class="comment-text">
                    "Saya sangat puas dengan pelayanan yang efektif. Tim profesional dan fast respon dalam berkomunikasi dan langgar ini sangat terasa ketika berkomunikasi dari awal sampai pesanan tiba dengan baik."
                </p>
            </div>

            <!-- Comment 2 -->
            <div class="comment-card">
                <div class="comment-header">
                    <img src="{{ asset('assets/profil.png') }}" alt="User" class="user-avatar">
                    <div class="comment-info">
                        <h4 class="user-name">Jhonarendra</h4>
                        <div class="rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
                <p class="comment-text">
                    "Sangat senang dengan pelayanan yang diberikan oleh tim Catering Kita. Telah order lebih dari 5x dan selalu puas dengan hasilnya."
                </p>
            </div>
        </div>
    </div>

        <!-- Promotional Banner -->
        <div class="promo-banner">
            <h2 class="promo-title">Siap Memesan untuk Acara Anda?</h2>
            <p class="promo-description">Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan konsultasi menu
                yang sesuai dengan acara Anda.</p>
            <a href="/contact" class="promo-button">Hubungi Kami</a>
        </div>
    </header>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Helper functions
            function getCartItems() {
                return JSON.parse(localStorage.getItem('cartItems')) || [];
            }

            function saveCartItems(items) {
                localStorage.setItem('cartItems', JSON.stringify(items));
            }

            function updateCartCounter() {
                const cartItems = getCartItems();
                const cartIcon = document.querySelector('.cart-icon');
                const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);

                if (totalItems > 0) {
                    cartIcon.setAttribute('data-count', totalItems.toString());
                } else {
                    cartIcon.removeAttribute('data-count');
                }
            }

            // Convert all count spans to input fields
            document.querySelectorAll('.counter .count').forEach(countSpan => {
                const input = document.createElement('input');
                input.type = 'number';
                input.className = 'count';
                input.value = '0';
                input.min = '0';
                input.addEventListener('input', function() {
                    let value = parseInt(this.value) || 0;
                    if (value < 0) {
                        value = 0;
                    }
                    this.value = value;

                    // Update hidden input if exists
                    const menuItem = this.closest('.menu-item, .menu-item-p');
                    const quantityInput = menuItem.querySelector('.quantity-input');
                    if (quantityInput) {
                        quantityInput.value = value;
                    }

                    // Update order button state
                    const orderBtn = menuItem.querySelector('.menu-item-button, .add-to-cart-btn');
                    if (orderBtn) {
                        orderBtn.disabled = value === 0;
                    }
                });
                countSpan.parentNode.replaceChild(input, countSpan);
            });

            // Handle all menu items (both nasi box and prasmanan)
            document.querySelectorAll('.menu-item, .menu-item-p').forEach(item => {
                const countInput = item.querySelector('.count');
                const minusButton = item.querySelector('.minus');
                const plusButton = item.querySelector('.plus');
                const orderButton = item.querySelector('.menu-item-button');
                const form = item.querySelector('.add-to-cart-form');

                // Get menu item details
                const menuItemName = item.querySelector('.menu-item-title').textContent;
                const menuItemPrice = parseInt(item.querySelector('.menu-item-price').textContent.replace(
                    'Rp ', '').replace('.', ''));
                const menuItemImage = item.querySelector('img').getAttribute('src');

                // Handle minus button
                minusButton.addEventListener('click', () => {
                    let value = parseInt(countInput.value) || 0;
                    if (value > 0) {
                        countInput.value = value - 1;
                        countInput.dispatchEvent(new Event('input'));
                    }
                });

                // Handle plus button
                plusButton.addEventListener('click', () => {
                    let value = parseInt(countInput.value) || 0;
                    countInput.value = value + 1;
                    countInput.dispatchEvent(new Event('input'));
                });

                // Handle add to cart
                const addToCart = async (quantity) => {
                    try {
                        const response = await fetch('/keranjang/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                nama_produk: menuItemName,
                                price: menuItemPrice,
                                quantity: quantity,
                                image: menuItemImage
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            let cartItems = getCartItems();
                            const existingItemIndex = cartItems.findIndex(item => item.name ===
                                menuItemName);

                            if (existingItemIndex !== -1) {
                                cartItems[existingItemIndex].quantity += quantity;
                            } else {
                                cartItems.push({
                                    id: cartItems.length + 1,
                                    name: menuItemName,
                                    price: menuItemPrice,
                                    image: menuItemImage,
                                    quantity: quantity
                                });
                            }

                            saveCartItems(cartItems);
                            updateCartCounter();
                            countInput.value = 0;
                            countInput.dispatchEvent(new Event('input'));
                            alert('Item berhasil ditambahkan ke keranjang!');
                        }
                    } catch (error) {
                        alert('Gagal menambahkan ke keranjang: ' + error.message);
                    }
                };

                // Handle order button click
                if (orderButton) {
                    orderButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        const quantity = parseInt(countInput.value) || 0;
                        if (quantity > 0) {
                            addToCart(quantity);
                        } else {
                            alert('Silakan pilih jumlah item terlebih dahulu!');
                        }
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
    <main>
        @yield('content')
    </main>
</body>

</html>
