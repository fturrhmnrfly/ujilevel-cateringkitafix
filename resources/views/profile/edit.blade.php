<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Profil - Catering Kita</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding-top: 70px; /* Add padding to account for fixed navbar */
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background-color: #2c2c77;
        }

        .profile-name {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }

        .edit-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-title {
            font-size: 20px;
            color: #2c2c77;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #2c2c77;
            outline: none;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-reset {
            background-color: #6c757d;
            color: white;
        }

        .btn-submit {
            background-color: #2c2c77;
            color: white;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-reset:hover {
            background-color: #5a6268;
        }

        .btn-submit:hover {
            background-color: #1a1a5c;
        }

        /* Update navbar styles if needed */
        nav.navbar, .x-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: #2c2c77;
        }

        /* Add responsive adjustments */
        @media (max-width: 768px) {
            body {
                padding-top: 60px; /* Smaller padding for mobile */
            }
            
            .container {
                margin: 10px auto;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <x-navbar></x-navbar>
    
    <div class="container">
        <div class="profile-header">
            <div class="profile-image">
                <img src="https://ui-avatars.com/api/?name={{ substr($profile->first_name, 0, 1) }}&background=2c2c77&color=fff&size=120" alt="{{ $profile->first_name }}'s Profile">
            </div>
            <h2 class="profile-name">{{ $profile->first_name }} {{ $profile->last_name }}</h2>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="edit-form">
            @csrf
            @method('PUT')
            
            <h3 class="form-title">Informasi Profil</h3>

            <div class="form-group">
                <label for="first_name">Nama Depan</label>
                <input type="text" class="form-control" name="first_name" value="{{ $profile->first_name }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Nama Belakang</label>
                <input type="text" class="form-control" name="last_name" value="{{ $profile->last_name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Nomor Telepon</label>  
                <input type="tel" class="form-control" name="phone" value="{{ $profile->phone }}" required>
            </div>

            <div class="form-group">
                <label for="address">Alamat Rumah</label>
                <textarea class="form-control" name="address" rows="3" required>{{ $profile->address }}</textarea>
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" name="bio" rows="3">{{ $profile->bio ?? '' }}</textarea>
            </div>

            <div class="button-group">
                <button type="reset" class="btn btn-reset">Batal</button>
                <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        // Phone number validation (existing code)
        document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
            // Remove all non-numeric characters except + at the beginning
            let value = this.value.replace(/(?!^\+)\D/g, '');
            
            // Limit length
            if (value.length > 13) {
                value = value.slice(0, 13);
            }
            
            this.value = value;
            
            // Validate Indonesian phone number format
            const phoneRegex = /^(?:(?:\+62|62)|0)[8][1-9][0-9]{8,10}$/;
            if (!phoneRegex.test(value)) {
                this.setCustomValidity('Gunakan format nomor telepon Indonesia yang valid');
            } else {
                this.setCustomValidity('');
            }
        });

        // Reset button functionality
        document.querySelector('.btn-reset').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin membatalkan perubahan?')) {
                window.location.href = '{{ route("profile.show") }}';
            }
        });
    </script>
</body>
</html>