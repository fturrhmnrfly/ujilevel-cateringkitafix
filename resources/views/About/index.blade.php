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
        padding: 1rem 2rem;
        border-bottom: 1px solid #e5e7eb;
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

    .about {
            position: relative; /* Add relative positioning */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
            background-color: #C373131A;
            overflow: hidden; /* Ensure the lengkungan stays within bounds */
        }

        .about-image {
            width: 500px;
            position: relative;
            z-index: 2;
            /* Higher z-index to appear in front */
            top: 100px;
            right: -20px;
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
</style>
<x-navbar></x-navbar>
<div class="breadcrumb-container">
    <div class="breadcrumb">
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
