<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Catering Kita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            width: 100%;
            background-image: url("{{ asset('assets/paketassets5.png') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 20px;
        }

        .hero-title {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: white; /* Make the default text color white */
        }

        .hero-title span {
            color: #ffd700; /* Make the word "kita" yellow */
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .cta-button {
            padding: 1rem 2rem;
            background: #ffd700;
            color: #000;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .cta-button:hover {
            background: #e6c200;
        }

        .about {
            position: relative; /* Add relative positioning */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
            background-color: #ffffff;
            overflow: hidden; /* Ensure the lengkungan stays within bounds */
        }

        .about-image {
            width: 500px;
            position: relative;
            z-index: 2;
            /* Higher z-index to appear in front */
            top: 100px;
            right: -50px;
        }

        .about-image img {
            width: 500px;
            position: relative;
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

        .background-curve {
            position: absolute;
            bottom: 0;
            right: 50px;
            z-index: 1;
            /* Lower z-index to appear behind */
            top: -400px;
            right: 10%;
            width: 100%;
            height: 100%;
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
            /* Update existing styles */
            display: flex;
            flex-wrap: nowrap;
            gap: 20px;
            overflow-x: hidden;
            /* Change to hidden */
            padding: 20px 0;
            position: relative;
            width: 100%;
            cursor: default;
            /* Change to default cursor */
            pointer-events: none;
            /* Prevent all interactions */
        }

        .menu-item,
        .menu-item-p {
            flex: 0 0 300px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideIn 20s linear infinite;
            margin: 10px;
        }

        /* Update animation for continuous movement */
        @keyframes slideIn {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Remove hover effects */
        .menu-item:hover,
        .menu-item-p:hover {
            transform: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Remove interactive button styles */
        .menu-item-button {
            pointer-events: none;
            cursor: default;
            opacity: 0.7;
        }

        /* Add smooth infinite scroll */
        .menu-grid::after {
            content: "";
            display: block;
            clear: both;
        }

        /* Hide scrollbar */
        .menu-grid::-webkit-scrollbar {
            height: 8px;
        }

        .menu-grid::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .menu-grid::-webkit-scrollbar-thumb {
            background: #2c2c77;
            border-radius: 4px;
        }

        .menu-grid::-webkit-scrollbar-thumb:hover {
            background: #1a1a5c;
        }

        .menu-item img,
        .menu-item-p img {
            width: 100%;
            height: 250px;
            /* Increased height */
            object-fit: cover;
        }

        .menu-item-content {
            padding: 20px;
        }

        .menu-item-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .menu-item h4 {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
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
            background-color: #D38524;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .menu-item-button:hover {
            background-color: #D38524;
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
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            font-size: 14px;
            -moz-appearance: textfield;
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
            background-color: #FFFFFF;
            border-radius: 15px;
            padding: 40px;
            margin: 40px auto;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .promo-image {
            width: 300px;
            height: 300px;
            object-fit: cover;
        }

        .promo-image.left {
            transform: rotate(-5deg);
        }

        .promo-image.right {
            transform: rotate(5deg);
        }

        .promo-content {
            text-align: center;
            padding: 0 40px;
            flex: 1;
        }

        .promo-title {
            font-size: 36px;
            font-weight: bold;
            color: #C17F3B;
            margin-bottom: 20px;
        }

        .promo-description {
            font-size: 16px;
            color: #9F7E6B;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .promo-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #E6C9B3;
            color: #7B5E4B;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .promo-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            padding: 40px 20px;
            max-width: 100%;
            margin-top: 100px;
            margin: 50px 100; /* Increased top and bottom margin to 80px */
            background-color: #4B3E2F;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            background-color: #B19370;
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
            color: #fff;
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
            color: #fff;
            font-size: 14px;
        }

        .contact-icon {
            width: 20px;
            height: 20px;
            color: #F61515;
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
            top: -30px;
            left: -80px;
            /* Adjust left position */
            z-index: 1;
            margin-left: 60px
        }

        .hero-content h1 {
            font-size: 110px;
            color: #ffffff;
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
        /* Update/tambahkan CSS berikut */
        .comments-section {
            padding: 40px;
            margin: 40px 0;
            background-color: #fff;
        }

        .comments-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .section-title {
            font-family: 'Poppins', serif;
            font-size: 48px;
            color: #4B3E2F;
            text-align: center;
            margin-bottom: 40px;
        }

        .comment-card {
            flex: 1;
            min-width: 300px;
            background: #FFFFFF;
            border-radius: 15px;
            padding: 10px;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
            height: 280px;
            /* Set fixed height */
            display: flex;
            flex-direction: column;
        }

        .rating {
            color: #FFD700;
            font-size: 24px;
            margin-bottom: 20px;
            justify-content: center;
            align-items: center;
        }

        .comment-text {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
            font-style: italic;
            flex-grow: 1;
            /* Allow text to take available space */
            margin-bottom: 80px;
            /* Space for commenter info */
        }

        .commenter-info {
            display: flex;
            align-items: center;
            gap: 15px;
            position: absolute;
            bottom: 25px;
            /* Adjust position from bottom */
            left: 30px;
            z-index: 1;
        }

        .commenter-avatar {
            width: 40px;
            /* Slightly smaller avatar */
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .commenter-name {
            font-size: 16px;
            /* Slightly smaller font */
            font-weight: 500;
            color: #333;
        }

        .comment-curve {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20px;
            /* Reduced height of orange area */
            background: #FFB800;
            border-radius: 0 0 15px 15px;
            z-index: 0;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .features {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .features {
                grid-template-columns: 1fr;
            }
        }

        .category-section {
            padding: 40px;
            text-align: center;
            background-color: #f8f8f8;
        }

        .category-title {
            font-family: 'Poppins', serif;
            font-size: 48px;
            color: #4B3E2F;
            text-align: center;
            margin-bottom: 40px;
        }

        .category-container {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .category-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none; /* Remove default link styling */
            display: block; /* Make the entire card clickable */
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background-color: #f8f8f8;
        }

        .category-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-icon {
            transform: scale(1.1);
        }

        .category-name {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .category-desc {
            font-size: 16px;
            color: #666;
            margin-bottom: 15px;
        }

        .category-menu-count {
            color: #FF8C00;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <header>
        <x-navbar></x-navbar>
            
        <div class="hero">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="hero-title">Selamat datang di catering <span>kita</span></h1>
                <p class="hero-subtitle">Kami senang memenuhi acara spesial anda</p>
                <a href="#categories" class="cta-button" onclick="scrollToCategories(event)">Pesan Sekarang</a>
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
                <img src="{{ asset('assets/freebox.png') }}" alt="Free Box" class="feature-icon">
                <h3 class="feature-title">Free box</h3>
            </div>

            <!-- Payment Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/homeassets14.png') }}" alt="Payment" class="feature-icon">
                <h3 class="feature-title">Pembayaran</h3>
            </div>
        </div>
        
        <div class="about">
            <div class="about-image">
                <img src="{{ asset('assets/homeassets1.jpg') }}" alt="Nasi Box" class="about-image">
                <img src="{{ asset('assets/lengkungan.png') }}" alt="lengkung" class="background-curve">
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

        <section class="category-section">
            <h2 class="category-title">Kategori</h2>
            
            <div class="category-container">
                <!-- Prasmanan Category -->
                <a href="{{ route('menuprasmanan.index') }}" class="category-card">
                    <img src="{{ asset('assets/kategoriassets1.png') }}" alt="Prasmanan" class="category-icon">
                    <h3 class="category-name">Prasmanan</h3>
                    <p class="category-desc">Hidangan lengkap dengan konsep prasmanan untuk berbagai acara</p>
                    <span class="category-menu-count">11 Menu</span>
                </a>

                <!-- Nasi Box Category -->
                <a href="{{ route('menunasibox.index') }}" class="category-card">
                    <img src="{{ asset('assets/kategoriassets2.png') }}" alt="Nasi Box" class="category-icon">
                    <h3 class="category-name">Nasi Box</h3>
                    <p class="category-desc">Paket nasi lengkap dengan lauk dalam kemasan praktis</p>
                    <span class="category-menu-count">17 Box</span>
                </a>
            </div>
        </section>

        <div class="menu-section">
            <!-- Popular Menu Section -->
            <h2 class="section-title">Paket Nasi Box</h2>
            <div class="menu-grid" id="nasi-box">
                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets1.png') }}" alt="Paket Nasi Box A">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium A</h3>
                        <h4>Nasi Liwet, Ayam Bakar, Tumis Jagung Manis, Telur Ceplok, Sambal</h4>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets2.png') }}" alt="Paket Nasi Box B">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium B</h3>
                        <h4>Nasi putih, Ayam Bakar, Tumis Sayur, Tempe Goreng</h4>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakpremium2.png') }}" alt="Paket Nasi Box C">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium C</h3>
                        <h4>Nasi putih, Ayam Goreng, daging cincang,tempe orak arik,
                            samba, lalapan</h4>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakpremium3.png') }}" alt="Paket Nasi Box D">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium D</h4>
                            <h4>Nasi putih, daging sapi,sate,naget,sayur,telur kuning,kacang , sambal saus </h4>
                    </div>
                </div>
                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakpremium4.png') }}" alt="Paket Nasi Box E">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium E</h3>
                        <h4>Nasi putih, telur, mie, capcay, ayam suir, sambal, kentang</h4>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakthailand.png') }}" alt="Paket Nasi Thailand">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Campur Thailand</h3>
                        <h4>Nasi kecap, udang, chicken, sayur</h4>
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
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/homeassets5.jpg') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Ikan Goreng</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/capcay.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Capcay</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/bihungoreng.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Bihun Goreng</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 8.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/miegoreng.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Mie Goreng</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/homeassets4.jpg') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Telur Balado</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 5.000</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add this section before the promo banner -->
        <div class="comments-section">
            <h2 class="section-title">Penilaian Pelanggan</h2>
            <div class="comments-container">
                <!-- Comment 1 -->
                <div class="comment-card">
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                    <p class="comment-text">
                        "Saya sangat puas dengan pelayanan yang diberikan. Tim profesional dan produk berkualitas tinggi. Saya pasti akan merekomendasikan layanan ini kepada teman dan keluarga!"
                    </p>
                    <div class="commenter-info">
                        <img src="{{ asset('assets/profile.png') }}" alt="Wildan" class="commenter-avatar">
                        <span class="commenter-name">Wildan Syah Nugraha</span>
                    </div>
                    <div class="comment-curve"></div>
                </div>

                <!-- Comment 2 -->
                <div class="comment-card">
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                    <p class="comment-text">
                        "Saya sangat puas dengan pelayanan yang diberikan. Tim profesional dan produk berkualitas tinggi. Saya pasti akan merekomendasikan layanan ini kepada teman dan keluarga!"
                    </p>
                    <div class="commenter-info">
                        <img src="{{ asset('assets/profil-raffy.png') }}" alt="Raffy" class="commenter-avatar">
                        <span class="commenter-name">Raffy Faturacman</span>
                    </div>
                    <div class="comment-curve"></div>
                </div>

                <!-- Comment 3 -->
                <div class="comment-card">
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                    <p class="comment-text">
                        "Saya sangat puas dengan pelayanan yang diberikan. Tim profesional dan produk berkualitas tinggi. Saya pasti akan merekomendasikan layanan ini kepada teman dan keluarga!"
                    </p>
                    <div class="commenter-info">
                        <img src="{{ asset('assets/profil-siti.png') }}" alt="Siti" class="commenter-avatar">
                        <span class="commenter-name">Siti Fadya Sari</span>
                    </div>
                    <div class="comment-curve"></div>
                </div>
            </div>
        </div>

        <!-- Update promo banner HTML -->
    <div class="promo-banner">
        <img src="{{ asset('assets/ayambakar.png') }}" alt="Ayam Bakar" class="promo-image left">
        
        <div class="promo-content">
            <h2 class="promo-title">Siap Memesan untuk Acara Anda?</h2>
            <p class="promo-description">
                Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan konsultasi menu yang sesuai dengan acara Anda.
            </p>
            <a href="/contact" class="promo-button">Hubungi Kami</a>
        </div>

        <img src="{{ asset('assets/nasiayam.png') }}" alt="Nasi Ayam" class="promo-image right">
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
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation configuration
    const animationConfig = {
        threshold: 0.2,
        rootMargin: '50px',
        elements: {
            '.hero-content': { delay: 0, duration: 1 },
            '.feature-card': { delay: 0.2, duration: 0.8 },
            '.about-content': { delay: 0.3, duration: 0.8 },
            '.about-image': { delay: 0.4, duration: 0.8 },
            '.category-card': { delay: 0.2, duration: 0.6 },
            '.menu-item, .menu-item-p': { delay: 0.15, duration: 0.8 },
            '.comment-card': { delay: 0.25, duration: 0.7 },
            '.promo-banner': { delay: 0.3, duration: 0.9 }
        }
    };

    // Create intersection observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const config = Object.entries(animationConfig.elements).find(([selector]) => 
                    element.matches(selector)
                );

                if (config) {
                    const [, { delay }] = config;
                    setTimeout(() => {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, delay * 1000);
                }
                observer.unobserve(element);
            }
        });
    }, {
        threshold: animationConfig.threshold,
        rootMargin: animationConfig.rootMargin
    });

    // Initialize elements for animation
    Object.entries(animationConfig.elements).forEach(([selector, { duration }]) => {
        document.querySelectorAll(selector).forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = `all ${duration}s cubic-bezier(0.4, 0, 0.2, 1)`;
            observer.observe(element);
        });
    });

    // Smooth scroll for navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Subtle parallax effect for hero section
    const hero = document.querySelector('.hero');
    window.addEventListener('scroll', () => {
        if (hero) {
            const scrolled = window.pageYOffset;
            hero.style.backgroundPositionY = `${scrolled * 0.5}px`;
        }
    });

    // Add hover animations for interactive elements
    const interactiveElements = document.querySelectorAll('.cta-button, .btn-shop, .feature-card, .category-card');
    interactiveElements.forEach(element => {
        element.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
        
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
        });

        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });
});

function scrollToCategories(e) {
    e.preventDefault();
    const categoriesSection = document.querySelector('.category-section');
    if (categoriesSection) {
        categoriesSection.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
}
    </script>
    <main>
        @yield('content')
    </main>
</body>

</html>
