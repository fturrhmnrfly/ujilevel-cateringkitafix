<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Catering Kita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('{{ asset("assets/nasikotakpremium2.png") }}') no-repeat center center;
            background-size: cover;
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-color: rgba(0,0,0,0.6);
            }
            50% {
                background-color: rgba(0,0,0,0.7);
            }
            100% {
                background-color: rgba(0,0,0,0.6);
            }
        }

        .navbar {
            background-color: #E78B24;
            width: 100%;
            padding: 0.5rem;
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nav-brand {
            display: flex;
            align-items: center;
        }

        .nav-brand img {
            width: 50px;
            height: 50px;
        }

        .nav-brand-text {
            color: white;
            margin-left: 10px;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            max-width: 500px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .login-title {
            color: white;
            text-align: center;
            font-size: 64px;
            margin-bottom: 30px;
            font-family: "Times New Roman", serif;
            animation: fadeIn 1.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .form-group label {
            display: block;
            color: white;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid transparent;
            border-radius: 5px;
            font-size: 16px;
            background: white;
            transition: border-color 0.3s ease;
        }

        .form-group input.error {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .form-group input:focus {
            outline: none;
            border-color: #E78B24;
        }

        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.5s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.8s;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
            animation-delay: 1.1s;
        }

        .form-check input {
            margin-right: 8px;
            width: 20px;
            height: 20px;
        }

        .form-check label {
            color: white;
            font-size: 16px;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background-color: #E78B24;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-out;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
            animation-delay: 1.4s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-login:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            text-align: center;
            color: white;
            margin: 20px 0;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
            animation-delay: 1.7s;
        }

        .register-prompt {
            text-align: center;
            color: white;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
            animation-delay: 2s;
        }

        .register-prompt a {
            color: #E78B24;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .register-prompt a:hover {
            color: #ffa640;
        }

        .server-error {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <img src="{{ asset('assets/logo.png') }}" alt="Catering Kita">
            <span class="nav-brand-text">CATERING KITA</span>
        </div>
    </nav>

    <div class="container">
        <h1 class="login-title">Login</h1>
        
        <!-- Server Error Messages -->
        @if ($errors->any())
            <div class="server-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            
            <div class="form-group">
                <label>Email*</label>
                <input type="email" name="email" id="email" placeholder="Enter Your Email" value="{{ old('email') }}" required>
                <div class="error-message" id="email-error">Email harus diisi dengan format yang benar</div>
            </div>

            <div class="form-group">
                <label>Password*</label>
                <input type="password" name="password" id="password" placeholder="Enter Your Password" required>
                <div class="error-message" id="password-error">Password harus diisi</div>
            </div>

            <div class="form-check">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login" id="loginBtn">Login</button>
        </form>

        <div class="divider">Atau</div>

        <div class="register-prompt">
            Belum Memiliki Akun? <a href="{{ route('register') }}">Daftar</a> sekarang
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const loginBtn = document.getElementById('loginBtn');

            // Clear server errors on page load and clear fields if there were errors
            @if ($errors->any())
                emailInput.value = '';
                passwordInput.value = '';
            @endif

            // Validation functions
            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function showError(input, errorId, message) {
                input.classList.add('error');
                const errorElement = document.getElementById(errorId);
                errorElement.textContent = message;
                errorElement.classList.add('show');
            }

            function hideError(input, errorId) {
                input.classList.remove('error');
                const errorElement = document.getElementById(errorId);
                errorElement.classList.remove('show');
            }

            function validateForm() {
                let isValid = true;

                // Reset all errors
                hideError(emailInput, 'email-error');
                hideError(passwordInput, 'password-error');

                // Validate email
                if (!emailInput.value.trim()) {
                    showError(emailInput, 'email-error', 'Email harus diisi');
                    isValid = false;
                } else if (!validateEmail(emailInput.value)) {
                    showError(emailInput, 'email-error', 'Format email tidak valid');
                    isValid = false;
                }

                // Validate password
                if (!passwordInput.value.trim()) {
                    showError(passwordInput, 'password-error', 'Password harus diisi');
                    isValid = false;
                }

                return isValid;
            }

            // Real-time validation
            emailInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    if (validateEmail(this.value)) {
                        hideError(this, 'email-error');
                    } else {
                        showError(this, 'email-error', 'Format email tidak valid');
                    }
                } else {
                    hideError(this, 'email-error');
                }
            });

            passwordInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    hideError(this, 'password-error');
                } else {
                    showError(this, 'password-error', 'Password harus diisi');
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (validateForm()) {
                    loginBtn.disabled = true;
                    loginBtn.textContent = 'Loading...';
                    this.submit();
                } else {
                    // Clear fields if validation fails
                    emailInput.value = '';
                    passwordInput.value = '';
                    
                    // Focus on first error field
                    const firstErrorField = document.querySelector('.error');
                    if (firstErrorField) {
                        firstErrorField.focus();
                    }
                }
            });

            // Clear errors when input gets focus
            [emailInput, passwordInput].forEach(input => {
                input.addEventListener('focus', function() {
                    this.classList.remove('error');
                });
            });
        });
    </script>
</body>
</html>