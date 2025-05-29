<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Catering Kita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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
            padding-top: 70px; /* Adjust this value based on your navbar height */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('{{ asset("assets/nasikotakpremium2.png") }}') no-repeat center center;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar {
            background-color: #E78B24;
            width: 100%;
            padding: 0.5rem;
            position: fixed; /* Make navbar fixed */
            top: 0; /* Stick to top */
            left: 0;
            z-index: 1000; /* Ensure navbar stays on top of other elements */
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
            min-height: calc(100vh - 90px); /* Mengurangi tinggi navbar */
            display: flex;
            flex-direction: column;
        }

        .register-title {
            color: white; 
            text-align: center;
            font-size: 64px;
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
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background: white;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
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
            transition: background-color 0.3s;
        }

        .btn-register:hover {
            background-color: #d47a1c;
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

        .input-error {
            color: #ff4444;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Tambahkan media queries untuk responsivitas */
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

            .form-group {
                margin-bottom: 15px;
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
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label>Nama Depan*</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}">
                @if ($errors->has('first_name'))
                    <div class="input-error">{{ $errors->first('first_name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Nama Belakang*</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" >
                @if ($errors->has('last_name'))
                    <div class="input-error">{{ $errors->first('last_name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Email*</label>
                <input type="email" name="email" value="{{ old('email') }}" >
                @if ($errors->has('email'))
                    <div class="input-error">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>No.Telepon*</label>
                <input type="text" name="phone" value="{{ old('phone') }}" >
                @if ($errors->has('phone'))
                    <div class="input-error">{{ $errors->first('phone') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Alamat*</label>
                <textarea name="address">{{ old('address') }}</textarea>
                @if ($errors->has('address'))
                    <div class="input-error">{{ $errors->first('address') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Password*</label>
                <input type="password" name="password" >
                @if ($errors->has('password'))
                    <div class="input-error">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Konfirmasi Password*</label>
                <input type="password" name="password_confirmation" >
            </div>

            <button type="submit" class="btn-register">Register</button>
        </form>

        <div class="divider">Atau</div>

        <div class="login-prompt">
            Sudah memiliki akun? <a href="{{ route('login') }}">Login</a> sekarang
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = {
        firstName: document.getElementById('first_name'),
        lastName: document.getElementById('last_name'),
        email: document.getElementById('email'),
        phone: document.getElementById('phone'),
        address: document.getElementById('address'),
        password: document.getElementById('password'),
        passwordConfirm: document.getElementById('password_confirmation')
    };

    // Remove default invalid styling
    const style = document.createElement('style');
    style.textContent = `
        .form-group input:invalid {
            border-color: #e5e7eb;
        }
    `;
    document.head.appendChild(style);

    // Update phone validation in validators object
    const validators = {
        firstName: (value) => value.length >= 2,
        lastName: (value) => value.length >= 2,
        email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
        phone: (value) => {
            // Allow +62, 62, or 0 prefix followed by 8 and 8-11 digits
            const phoneRegex = /^(?:\+62|62|0)8[1-9][0-9]{7,10}$/;
            return phoneRegex.test(value);
        },
        address: (value) => value.length >= 10,
        password: (value) => value.length >= 8
    };

    // Validasi input
    function validateInput(input, validatorFn, key) {
        // Hapus error message yang ada
        const errorDiv = input.parentElement.querySelector('.validation-error');
        if (errorDiv) {
            errorDiv.remove();
        }

        // Reset border color ke default untuk input kosong
        if (!input.value) {
            input.style.borderColor = '#e5e7eb';
            return;
        }

        // Validasi input
        if (!validatorFn(input.value)) {
            // Tampilkan border merah untuk input tidak valid
            input.style.borderColor = '#ef4444';
            
            // Tambahkan pesan error
            const errorMessage = document.createElement('div');
            errorMessage.className = 'validation-error';
            errorMessage.style.color = '#ef4444';
            errorMessage.style.fontSize = '0.875rem';
            errorMessage.style.marginTop = '0.5rem';
            
            // Pesan error untuk setiap field
            const errorMessages = {
                firstName: 'Nama depan harus minimal 2 karakter',
                lastName: 'Nama belakang harus minimal 2 karakter',
                email: 'Email Sudah Ter Daftar',
                phone: 'Silakan masukkan nomor telepon Indonesia yang valid',
                address: 'Alamat harus minimal 10 karakter',
                password: 'Password harus minimal 8 karakter'
            };
            
            errorMessage.textContent = errorMessages[key];
            input.parentElement.appendChild(errorMessage);
        } else {
            // Kembalikan ke warna default untuk input valid
            input.style.borderColor = '#e7e7eb';
        }
    }

    // Update event listeners
    Object.entries(inputs).forEach(([key, input]) => {
        if (key !== 'passwordConfirm') {
            input.addEventListener('input', () => {
                validateInput(input, validators[key], key);

                if (key === 'password') {
                    const confirmInput = inputs.passwordConfirm;
                    if (confirmInput.value) {
                        validatePasswordConfirmation(confirmInput, input.value);
                    }
                }
            });
        }
    });

    // Add password confirmation validation
    function validatePasswordConfirmation(input, passwordValue) {
        const errorDiv = input.parentElement.querySelector('.validation-error');
        if (errorDiv) {
            errorDiv.remove();
        }

        if (!input.value) {
            input.style.borderColor = '#e7e7eb';
            return;
        }

        if (input.value !== passwordValue) {
            input.style.borderColor = '#ef4444';
            
            const errorMessage = document.createElement('div');
            errorMessage.className = 'validation-error';
            errorMessage.style.color = '#ef4444';
            errorMessage.style.fontSize = '0.875rem';
            errorMessage.style.marginTop = '0.5rem';
            errorMessage.textContent = 'Passwords do not match';
            
            input.parentElement.appendChild(errorMessage);
        } else {
            input.style.borderColor = '#e7e7eb';
        }
    }

    // Update password confirmation handler
    inputs.passwordConfirm.addEventListener('input', function() {
        validatePasswordConfirmation(this, inputs.password.value);
    });

    // Special handler for password confirmation
    inputs.passwordConfirm.addEventListener('input', function() {
        if (!this.value) {
            this.style.borderColor = '#e7e7eb';
            return;
        }
        this.style.borderColor = this.value === inputs.password.value ? 
            '#e7e7eb' : '#ef4444';  // Only show red for mismatch
    });

    // Form submission handler
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let hasError = false;

        // Reset semua error sebelumnya
        Object.entries(inputs).forEach(([key, input]) => {
            input.style.borderColor = '#e7e7eb';
            const existingError = input.parentElement.querySelector('.validation-error');
            if (existingError) {
                existingError.remove();
            }
        });

        // Validasi format hanya untuk field yang sudah diisi
        Object.entries(inputs).forEach(([key, input]) => {
            if (input.value.trim()) { // Hanya validasi jika field diisi
                if (key !== 'passwordConfirm' && !validators[key](input.value)) {
                    hasError = true;
                    const errorMessages = {
                        firstName: 'Nama depan harus minimal 2 karakter',
                        lastName: 'Nama belakang harus minimal 2 karakter',
                        email: 'Format email tidak valid',
                        phone: 'Format nomor telepon tidak valid (contoh: 08123456789)',
                        address: 'Alamat harus minimal 10 karakter',
                        password: 'Password harus minimal 8 karakter'
                    };
                    showError(input, errorMessages[key]);
                }
            }
        });

        // Validasi konfirmasi password hanya jika kedua field password diisi
        if (inputs.password.value && inputs.passwordConfirm.value) {
            if (inputs.password.value !== inputs.passwordConfirm.value) {
                hasError = true;
                showError(inputs.passwordConfirm, 'Password tidak cocok');
            }
        }

        // Jika tidak ada error, submit form
        if (!hasError) {
            this.submit();
        } else {
            // Reset password fields jika ada error
            inputs.password.value = '';
            inputs.passwordConfirm.value = '';
        }
    });

    // Update showError function
    function showError(input, message) {
        input.style.borderColor = '#ef4444';
        const errorMessage = document.createElement('div');
        errorMessage.className = 'validation-error';
        errorMessage.style.color = '#ef4444';
        errorMessage.style.fontSize = '0.875rem';
        errorMessage.style.marginTop = '0.5rem';
        errorMessage.textContent = message;
        input.parentElement.appendChild(errorMessage);
    }
});
    </script>
</body>
</html>
