<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register - Catering Kita</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 100px
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

            .navbar .profile span {
                font-size: 14px;
                font-weight: bold;
            }

            /* Breadcrumb Styles */
            .breadcrumb-container {
                background-color: #f3f4f6;
                padding: 2.5rem 2rem;
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

            /* Form Container Styles */
            .form-container {
                max-width: 600px;
                margin: 2rem auto;
                padding: 2rem;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-group label {
                display: block;
                font-weight: bold;
                margin-bottom: 0.5rem;
            }

            .form-group input,
            .form-group textarea {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e5e7eb;
                border-radius: 0.375rem;
            }

            .form-group textarea {
                resize: vertical;
            }

            .form-group .input-error {
                color: #e3342f;
                font-size: 0.875rem;
                margin-top: 0.5rem;
            }

            .form-actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 1.5rem;
            }

            .form-actions a {
                color: #2c2c77;
                text-decoration: underline;
            }

            .form-actions button {
                background-color: #2c2c77;
                color: white;
                padding: 0.75rem 1.5rem;
                border: none;
                border-radius: 0.375rem;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .form-actions button:hover {
                background-color: #1a1a5e;
            }

            .password-strength {
                margin-top: 0.5rem;
                font-size: 0.875rem;
                font-weight: bold;
            }

            .form-group input:invalid {
                border-color: #ff4d4d;
            }

            .form-group input:valid {
                border-color: #4dff4d;
            }
        </style>
    </head>
    <body>
        <nav class="navbar">
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                <div class="text-navbar">
                    <p>CATERING</p>
                    <p>KITA</p>
                </div>
            </div>
            
        </nav>

        <div class="form-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First Name -->
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="first_name">
                    @if ($errors->has('first_name'))
                        <div class="input-error">{{ $errors->first('first_name') }}</div>
                    @endif
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                    @if ($errors->has('last_name'))
                        <div class="input-error">{{ $errors->first('last_name') }}</div>
                    @endif
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    @if ($errors->has('email'))
                        <div class="input-error">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                    @if ($errors->has('phone'))
                        <div class="input-error">{{ $errors->first('phone') }}</div>
                    @endif
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" required>{{ old('address') }}</textarea>
                    @if ($errors->has('address'))
                        <div class="input-error">{{ $errors->first('address') }}</div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    @if ($errors->has('password'))
                        <div class="input-error">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                    @if ($errors->has('password_confirmation'))
                        <div class="input-error">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>

                <div class="form-actions">
                    <a href="{{ route('login') }}">Already registered?</a>
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Oke',
                confirmButtonColor: '#2c2c77'
            });
        </script>
        @endif

        @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mohon periksa kembali data yang dimasukkan',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#2c2c77'
            });
        </script>
        @endif

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            
            form.addEventListener('submit', function(e) {
                const firstName = document.getElementById('first_name').value;
                const lastName = document.getElementById('last_name').value;
                const email = document.getElementById('email').value;
                const phone = document.getElementById('phone').value;
                const address = document.getElementById('address').value;
                const password = document.getElementById('password').value;
                const passwordConfirm = document.getElementById('password_confirmation').value;

                let isValid = true;
                let errors = [];

                // Validasi nama
                if (firstName.length < 2) {
                    errors.push('Nama depan minimal 2 karakter');
                    isValid = false;
                }

                if (lastName.length < 2) {
                    errors.push('Nama belakang minimal 2 karakter');
                    isValid = false;
                }

                // Validasi email sederhana
                if (!email.includes('@')) {
                    errors.push('Format email tidak valid');
                    isValid = false;
                }

                // Validasi nomor telepon sederhana
                if (phone.length < 10 || phone.length > 13) {
                    errors.push('Nomor telepon harus 10-13 digit');
                    isValid = false;
                }

                // Validasi alamat
                if (address.length < 10) {
                    errors.push('Alamat terlalu pendek (minimal 10 karakter)');
                    isValid = false;
                }

                // Validasi password sederhana
                if (password.length < 8) {
                    errors.push('Password minimal 8 karakter');
                    isValid = false;
                }

                if (password !== passwordConfirm) {
                    errors.push('Konfirmasi password tidak cocok');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    alert(errors.join('\n'));
                }
            });
        });
        </script>
    </body>
    </html>
