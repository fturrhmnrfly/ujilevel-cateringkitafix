<style>
    nav.navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #2c2c77;
        /* Warna biru navbar */
        padding: 15px 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
</style>
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
    <div class="about">
        <div class="about-image">
            <img src="{{ asset('assets/homeassets2.png') }}" alt="Nasi Box">
        </div>
        <div class="about-content">
            <h1>About us</h1>
            <h3>Always the Best Choice - SoDelicious, You'll Crave for More!</h3>
            <p>Catering Nikmat Rasa menyediakan nasi box dan snack box untuk berbagai acara seperti ulang tahun, arisan,
                syukuran, hingga acara kantor. Menu utama kami mencakup nasi bakar, nasi liwet, nasi ayam geprek, nasi
                kebuli, nasi tumpeng, dan banyak lagi, lengkap dengan sayur dan sambal khas. Dengan pengalaman lebih
                dari 10
                tahun melayani area Jabodetabek, kami siap menerima pesanan besar maupun kecil dengan rasa lezat, porsi
                pas,
                dan harga terjangkau. Hubungi kami sekarang untuk hidangan terbaik di acara Anda!</p>
            <a href="#" class="btn-shop">Competely</a>
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
