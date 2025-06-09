<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Catering Kita</title>
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
            padding-top: 70px;
        }

        .navbar {
            background-color: #E78B24;
            width: 100%;
            padding: 0.5rem;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
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
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            min-height: calc(100vh - 90px);
            display: flex;
            flex-direction: column;
        }

        .register-title {
            color: white; 
            text-align: center;
            font-size: 56px;
            margin-bottom: 30px;
            font-family: "Times New Roman", serif;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: white;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid transparent;
            border-radius: 5px;
            font-size: 16px;
            background: white;
            transition: border-color 0.3s ease;
        }

        .form-group input.error,
        .form-group textarea.error {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #E78B24;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
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

        .btn-register {
            width: 100%;
            padding: 15px;
            background-color: #E78B24;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background-color: #d67d1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-register:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            text-align: center;
            color: white;
            margin: 20px 0;
        }

        .login-prompt {
            text-align: center;
            color: white;
        }

        .login-prompt a {
            color: #E78B24;
            text-decoration: none;
            font-weight: bold;
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

        @media screen and (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 15px;
                margin: 10px;
            }

            .register-title {
                font-size: 48px;
            }

            .form-group input,
            .form-group textarea {
                padding: 12px;
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .register-title {
                font-size: 36px;
            }
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
        <h1 class="register-title">Register</h1>
        
        <!-- Server Error Messages -->
        @if ($errors->any())
            <div class="server-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf
            
            <div class="form-group">
                <label>Nama Depan*</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                <div class="error-message" id="first_name-error">Nama depan harus diisi minimal 2 karakter</div>
            </div>

            <div class="form-group">
                <label>Nama Belakang*</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                <div class="error-message" id="last_name-error">Nama belakang harus diisi minimal 2 karakter</div>
            </div>

            <div class="form-group">
                <label>Email*</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                <div class="error-message" id="email-error">Email harus diisi dengan format yang benar</div>
            </div>

            <div class="form-group">
                <label>No.Telepon*</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
                <div class="error-message" id="phone-error">Nomor telepon harus diisi dengan format Indonesia yang valid</div>
            </div>

            <div class="form-group">
                <label>Alamat*</label>
                <textarea name="address" id="address" required>{{ old('address') }}</textarea>
                <div class="error-message" id="address-error">Alamat harus diisi minimal 10 karakter</div>
            </div>

            <div class="form-group">
                <label>Password*</label>
                <input type="password" name="password" id="password" required>
                <div class="error-message" id="password-error">Password harus diisi minimal 8 karakter</div>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password*</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                <div class="error-message" id="password_confirmation-error">Konfirmasi password harus sama dengan password</div>
            </div>

            <button type="submit" class="btn-register" id="registerBtn">Register</button>
        </form>

        <div class="divider">Atau</div>

        <div class="login-prompt">
            Sudah memiliki akun? <a href="{{ route('login') }}">Login</a> sekarang
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const registerBtn = document.getElementById('registerBtn');
            
            const inputs = {
                first_name: document.getElementById('first_name'),
                last_name: document.getElementById('last_name'),
                email: document.getElementById('email'),
                phone: document.getElementById('phone'),
                address: document.getElementById('address'),
                password: document.getElementById('password'),
                password_confirmation: document.getElementById('password_confirmation')
            };

            // Clear all fields if there were server errors
            @if ($errors->any())
                Object.values(inputs).forEach(input => {
                    input.value = '';
                });
            @endif

            // Validation functions
            const validators = {
                first_name: (value) => value.trim().length >= 2,
                last_name: (value) => value.trim().length >= 2,
                email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
                phone: (value) => /^(?:(?:\+62|62)|0)[8][1-9][0-9]{8,10}$/.test(value),
                address: (value) => value.trim().length >= 10,
                password: (value) => value.length >= 8,
                password_confirmation: (value) => value === inputs.password.value
            };

            function showError(input, fieldName, message) {
                input.classList.add('error');
                const errorElement = document.getElementById(fieldName + '-error');
                errorElement.textContent = message;
                errorElement.classList.add('show');
            }

            function hideError(input, fieldName) {
                input.classList.remove('error');
                const errorElement = document.getElementById(fieldName + '-error');
                errorElement.classList.remove('show');
            }

            function validateField(fieldName, customMessage = null) {
                const input = inputs[fieldName];
                const value = input.value;

                if (!value.trim()) {
                    showError(input, fieldName, customMessage || `${fieldName.replace('_', ' ')} harus diisi`);
                    return false;
                }

                if (validators[fieldName] && !validators[fieldName](value)) {
                    const errorMessages = {
                        first_name: 'Nama depan harus minimal 2 karakter',
                        last_name: 'Nama belakang harus minimal 2 karakter',
                        email: 'Format email tidak valid',
                        phone: 'Format nomor telepon Indonesia tidak valid (contoh: 08123456789)',
                        address: 'Alamat harus minimal 10 karakter',
                        password: 'Password harus minimal 8 karakter',
                        password_confirmation: 'Konfirmasi password tidak sama dengan password'
                    };
                    showError(input, fieldName, errorMessages[fieldName]);
                    return false;
                }

                hideError(input, fieldName);
                return true;
            }

            function validateForm() {
                let isValid = true;
                
                // Validate all fields
                Object.keys(inputs).forEach(fieldName => {
                    if (!validateField(fieldName)) {
                        isValid = false;
                    }
                });

                return isValid;
            }

            // Real-time validation
            Object.entries(inputs).forEach(([fieldName, input]) => {
                input.addEventListener('input', function() {
                    if (this.value.trim()) {
                        validateField(fieldName);
                    } else {
                        hideError(this, fieldName);
                    }

                    // Special handling for password confirmation
                    if (fieldName === 'password' && inputs.password_confirmation.value) {
                        validateField('password_confirmation');
                    }
                });

                input.addEventListener('focus', function() {
                    this.classList.remove('error');
                });
            });

            // Phone number formatting
            inputs.phone.addEventListener('input', function(e) {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 13) {
                    value = value.slice(0, 13);
                }
                this.value = value;
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (validateForm()) {
                    registerBtn.disabled = true;
                    registerBtn.textContent = 'Mendaftar...';
                    this.submit();
                } else {
                    // Clear all fields if validation fails
                    Object.values(inputs).forEach(input => {
                        input.value = '';
                    });
                    
                    // Focus on first error field
                    const firstErrorField = document.querySelector('.error');
                    if (firstErrorField) {
                        firstErrorField.focus();
                    }
                }
            });
        });
    </script>
</body>
</html>
