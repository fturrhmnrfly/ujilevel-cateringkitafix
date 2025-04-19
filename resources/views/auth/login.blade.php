<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User - Catering Kita</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .nav-bg {
            background-color: #2A2879;
            padding: 1rem;
        }
        .logo-section {
            display: flex;
            align-items: center;
        }
        .logo-section img {
            width: 32px;
            height: 32px;
        }
        .brand-text {
            color: white;
            font-size: 14px;
            margin-left: 8px;
        }
        .login-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin-bottom: 1.5rem;
        }
        .input-label {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 0.5rem;
        }
        .input-field {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }
        .login-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #6366F1;
            color: white;
            border-radius: 4px;
            font-weight: 500;
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        .divider span {
            padding: 0 1rem;
            color: #666;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="nav-bg">
        <div class="max-w-7xl mx-auto">
            <div class="logo-section">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                <div class="brand-text">CATERING<br>KITA</div>
            </div>
        </div>
    </nav>

    <div class="flex items-center justify-between max-w-7xl mx-auto py-4 px-4">
        <h1 class="text-xl">Login</h1>
        <div class="text-sm text-gray-600">
            <a href="/" class="hover:text-gray-800">Home</a>
            <span class="mx-2">»</span>
            <span class="text-gray-400">Login</span>
        </div>
    </div>

    <div class="login-container">
        <h2 class="text-2xl font-medium text-center mb-6">Log <span class="text-indigo-500">In</span></h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="input-group">
                <label class="input-label">Email*</label>
                <input type="email" name="email" class="input-field" 
                       placeholder="Enter your Email" required>
            </div>

            <div class="input-group">
                <label class="input-label">Password*</label>
                <input type="password" name="password" class="input-field" 
                       placeholder="Enter Your Password" required>
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2" name="remember">
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                    Forgot Password?
                </a>
            </div>

            <button type="submit" class="login-btn">
                Login
            </button>
        </form>

        <div class="divider">
            <span>Atau</span>
        </div>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Belum Memiliki Akun? 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">
                    Register sekarang
                </a>
            </p>
        </div>
    </div>
</body>
</html>