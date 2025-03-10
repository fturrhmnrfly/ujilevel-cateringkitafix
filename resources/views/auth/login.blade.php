<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Catering Kita</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
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
        .nav-bg {
            background-color: #2A2879;
            height: 80px;
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

</body>
</html>