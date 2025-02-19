<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Catering Kita</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .nav-bg {
            background-color: #2A2879;
            height: 80px;
        }
        .login-card {
            background-color: #F4F4F5;
            border-radius: 24px;
            width: 460px;
            padding: 40px;
            margin: 60px auto;
        }
        .login-btn {
            background-color: #6366F1;
            padding: 12px 0;
            border-radius: 8px;
            width: 100%;
            margin-top: 24px;
        }
        .page-bg {
            background-color: #F9FAFB;
            min-height: calc(100vh - 80px);
        }
        .breadcrumb-section {
            background-color: #F9FAFB;
            padding: 20px 40px;
            border-bottom: 1px solid #E5E7EB;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
        }
        .input-field {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            background-color: white;
            margin-bottom: 4px;
        }
        .logo-section {
            display: flex;
            align-items: center;
            padding-left: 40px;
        }
        .logo-section img {
            width: 48px;
            height: 48px;
        }
        .logo-text {
            color: #FFFFFF; /* Diubah menjadi putih */
            margin-left: 12px;
            font-weight: bold;
            font-size: 14px;
            line-height: 1.2;
        }
        /* Menambahkan class khusus untuk kata KITA */
        .logo-text-kita {
            color: #FFB800; /* Warna kuning untuk kata KITA */
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
    <!-- Navigation -->
    <nav class="nav-bg">
        <div class="logo-section h-full flex items-center">
            <img src="assets/logo.png" alt="Catering Kita">
            <div class="logo-text">
                CATERING<br>
                <span class="logo-text-kita">KITA</span>
            </div>
        </div>
    </nav>

    <div class="page-bg">
        <!-- Breadcrumb -->
        <div class="breadcrumb-section flex justify-between items-center">
            <h1 class="text-xl text-gray-700">Login</h1>
            <div class="text-sm text-gray-600">
                <a href="/" class="text-gray-600">Home</a>
                <span class="mx-2">»</span>
                <span class="text-gray-400">Login</span>
            </div>
        </div>

        <!-- Login Form -->
        <div class="login-card">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-medium text-gray-800">Log <span class="text-indigo-500">In</span></h2>
                <p class="text-gray-500 mt-2 text-sm">Best place to buy and sell digital products</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="input-group">
                    <label class="input-label">Email</label>
                    <input type="email" name="email" 
                           class="input-field"
                           placeholder="Enter your Email">
                </div>

                <div class="input-group">
                    <label class="input-label">Password</label>
                    <input type="password" name="password" 
                           class="input-field"
                           placeholder="Enter Your Password">
                </div>

                <div class="text-right">
                    <a href="{{ route('password.request') }}" class="text-gray-500 text-sm">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" class="login-btn text-white font-medium">
                    Login
                </button>
            </form>
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
                    "Catering Kita adalah solusi lengkap untuk kebutuhan belanja makanan Anda. Temukan berbagai produk segar dan berkualitas hanya di sini!" "Belanja mudah dan cepat untuk semua kebutuhan katering Anda. Bergabunglah dengan ribuan pelanggan kami!"
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
                        <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Jln E.sumawijaya GG.amin RT 02/02 Desa pasireurih Kec tamansari</span>
                    </div>
                    <div class="contact-item">
                        <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>+62 831-1582-6505</span>
                    </div>
                </div>
            </div>
        </div>
        </footer>
</body>
</html>