<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pembayaran - Catering Kita</title>
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
            background-color: #EEEEEE;
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

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #333;
            margin-bottom: 20px;
        }

        /* Added style for the back arrow SVG */
        .back-button svg {
            width: 20px;
            height: 20px;
        }

        .merchant-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .merchant-info img {
            width: 24px;
            height: 24px;
        }

        .payment-section {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
        }

        .payment-header {
            background-color: #2c2c77;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            text-align: center;
        }

        .payment-methods {
            padding: 20px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .payment-option:hover {
            border-color: #2c2c77;
            background-color: #f8f9ff;
        }

        .payment-option.selected {
            border-color: #2c2c77;
            background-color: #f8f9ff;
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .payment-name {
            flex: 1;
            font-size: 16px;
            color: #333;
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
            <div class="breadcrumb-title">Status Pembayaran</div>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> » Status Pembayaran
            </div>
        </div>
    </div>

    <div class="container">
        <a href="/pesanan" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
            <span>Kembali</span>
        </a>

        <div class="merchant-info">
            <img src="{{ asset('assets/market.png') }}" alt="Store">
            <span>Catering Kita</span>
        </div>

        <div class="payment-section">
            <div class="payment-header">
                Metode Pembayaran
            </div>
            <div class="payment-methods">
                <a href="/pembayaran/bca" class="payment-option" data-method="bca">
                    <div class="payment-icon">
                        <img src="{{ asset('assets/kartubca.png') }}" alt="BCA Virtual Account">
                    </div>
                    <div class="payment-name">BCA Virtual Account</div>
                </a>

                <a href="/pembayaran/dana" class="payment-option" data-method="dana">
                    <div class="payment-icon">
                        <img src="{{ asset('assets/dana.png') }}" alt="Dana">
                    </div>
                    <div class="payment-name">Dana</div>
                </a>

                <a href="/pembayaran/gopay" class="payment-option" data-method="gopay">
                    <div class="payment-icon">
                        <img src="{{ asset('assets/gopay.png') }}" alt="Gopay">
                    </div>
                    <div class="payment-name">Gopay</div>
                </a>

                <a href="/pembayaran/cod" class="payment-option" data-method="cod">
                    <div class="payment-icon">
                        <img src="{{ asset('assets/cod.png') }}" alt="COD">
                    </div>
                    <div class="payment-name">COD</div>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                this.classList.add('selected');
                
                const method = this.getAttribute('data-method');
                
                const routes = {
                    'bca': '/metodepembayaran/bca',
                    'dana': '/metodepembayaran/dana',
                    'gopay': '/metodepembayaran/gopay',
                    'cod': '/metodepembayaran/cod'
                };
                
                setTimeout(() => {
                    window.location.href = routes[method];
                }, 200);
            });
        });
    </script>
</body>
</html>