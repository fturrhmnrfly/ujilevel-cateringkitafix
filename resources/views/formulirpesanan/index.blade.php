<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan</title>
    <style>
        nav.navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c2c77;
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .steps {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }

        .step {
            display: flex;
            align-items: center;
            margin: 0 15px;
        }

        .step-number {
            width: 30px;
            height: 30px;
            background-color: #ddd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 14px;
        }

        .step-text {
            color: #333;
            font-size: 14px;
        }

        .package {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .package:hover {
            border-color: #4e73f8;
            box-shadow: 0 2px 8px rgba(78, 115, 248, 0.1);
        }

        .package.selected {
            border-color: #4e73f8;
            background-color: #f8faff;
        }

        .package.selected::after {
            content: '';
            position: absolute;
            top: -1px;
            right: -1px;
            bottom: -1px;
            width: 4px;
            background-color: #4e73f8;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .package-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .package-price {
            color: #4e73f8;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .package-details {
            list-style: none;
        }

        .package-details li {
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }

        .button-container {
            text-align: right;
            margin-top: 30px;
        }

        .next-button {
            background-color: #4e73f8;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .next-button:hover {
            background-color: #3558d6;
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
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <div class="text-navbar">
                <p>CATERING</p>
                <p>KITA</p>
            </div>
        </div>

        <div class="profile">
            <img src="{{ asset('assets/profil.png') }}" alt="Profile">
        </div>
    </nav>
    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <div class="breadcrumb-title">Paket Nasi Box</div>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> » Paket Nasi Box
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Formulir Pemesanan</h1>
        <p class="subtitle">Lengkapi informasi pemesanan anda</p>

        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-text">Pilih Paket</div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-text">Detail Acara</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-text">Konfirmasi</div>
            </div>
        </div>

        <div class="package" onclick="selectPackage(this)">
            <h2 class="package-title">Paket Prasmanan</h2>
            <p class="package-price">Rp 30.000/porsi</p>
            <ul class="package-details">
                <li>Min. order: 100 porsi</li>
                <li>10 menu utama</li>
                <li>3 menu pembuka</li>
                <li>2 menu penutup</li>
                <li>Setup lengkap</li>
            </ul>
        </div>

        <div class="package" onclick="selectPackage(this)">
            <h2 class="package-title">Paket Nasi Box</h2>
            <p class="package-price">Rp 25.000/box</p>
            <ul class="package-details">
                <li>Min. order: 50 box</li>
                <li>3 snack asin</li>
                <li>3 snack manis</li>
                <li>Nasi tradisional</li>
                <li>Air mineral</li>
            </ul>
        </div>

        <div class="button-container">
            <a href="/detailacara" class="next-button">lanjutkan</a>
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

    <script>
        function selectPackage(element) {
            // Remove selected class from all packages
            document.querySelectorAll('.package').forEach(pkg => {
                pkg.classList.remove('selected');
            });

            // Add selected class to clicked package
            element.classList.add('selected');
        }
    </script>
</body>

</html>
