<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        /* Style utama untuk container profil */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* Judul halaman */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
        }

        /* Container untuk informasi profil */
        .profile-info {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Style untuk setiap baris informasi */
        .profile-info p {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            margin: 0;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .profile-info p:last-child {
            border-bottom: none;
        }

        /* Style untuk label yang dibold */
        .profile-info strong {
            display: inline-block;
            width: 150px;
            color: #555;
        }

        /* Style untuk tombol Edit Profil */
        .btn-primary {
            background-color: #5165ff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #3949cc;
        }

        /* Style untuk header profil dan gambar user */
        .user-profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c2c77;
            margin-top: 10px;
            text-align: center;
        }

        /* Menambahkan header app seperti di desain */
        .app-header {
            background-color: #2d2d8b;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .app-logo {
            font-weight: bold;
            font-size: 18px;
        }

        /* Button group di bagian bawah form */
        .button-group {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .profile-info strong {
                width: 120px;
            }
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

        .navbar .search-bar {
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            width: 40%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar .search-bar input[type="text"] {
            border: none;
            outline: none;
            flex: 1;
            padding: 5px;
            font-size: 14px;
        }

        .navbar .search-bar button {
            border: none;
            background: none;
            cursor: pointer;
            color: #2c2c77;
            font-size: 16px;
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
            text-decoration: none;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 120px;
        }

        .btn-primary {
            background-color: #5165ff;
            color: white;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: #3949cc;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
   <x-navbar></x-navbar>

        {{-- <!-- Search Bar -->
        <form class="search-bar">
            <input type="text" placeholder="Search products...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form> --}}

        {{-- <!-- Navigation Links -->
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('about.index') }}">About</a></li>
            <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
            <li><a href="{{ route('contact.index') }}">Contact</a></li>
        </ul> --}}

        <!-- Profile Section -->
        <div class="profile">
            <a href="{{ route('profile.show') }}">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($profile->first_name) }}&background=2c2c77&color=fff&size=120" alt="Profile">
            </a>
        </div>
    </nav>

    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <div class="breadcrumb-title">Profil Pengguna</div>
            <div class="breadcrumb-nav">
                <a href="{{ route('dashboard') }}">Home</a> » Profil Pengguna
            </div>
        </div>
    </div>

    <div class="container">
        <div class="user-profile-header">
            <div class="profile-image">
                @if($profile->avatar_url)
                    <img src="{{ $profile->avatar_url }}" alt="{{ $profile->first_name }}'s Profile" />
                @else
                    <img src="https://ui-avatars.com/api/?name={{ substr($profile->first_name, 0, 1) }}&background=2c2c77&color=fff&size=120" alt="Profile">
                @endif
            </div>
            <div class="user-name">{{ $profile->first_name }} {{ $profile->last_name }}</div>
        </div>

        <div class="profile-info">
            <p><strong>Nama Lengkap:</strong> {{ $profile->first_name }} {{ $profile->last_name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>  
            <p><strong>Nomor Telepon:</strong> {{ $profile->phone }}</p>
            <p><strong>Alamat Rumah:</strong> {{ $profile->address }}</p>
            @if($profile->bio)
                <p><strong>Bio:</strong> {{ $profile->bio }}</p>
            @endif
        </div>

        <div class="button-group">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <script>
        // Add confirmation before logout
        document.querySelector('form[action="{{ route('logout') }}"]').addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                localStorage.removeItem('cartItems'); // Clear cart items on logout
                this.submit();
            }
        });
    </script>
</body>
</html>
