<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
    /* Update body styles */
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        padding-top: 80px;
        position: relative;
        background: #f5f5f5; /* Warna background polos */
    }

    /* Hapus overlay yang tidak diperlukan */
    body::before {
        display: none;
    }

    /* Update container styles */
    .container {
        max-width: 600px;
        margin: 20px auto;
        padding: 30px;
        position: relative;
        z-index: 1;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* Judul halaman */
    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 24px;
    }

    /* Update profile header */
    .user-profile-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 40px;
        padding: 0;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 3px solid #ffffff;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-name {
        font-size: 24px;
        font-weight: 600;
        color: #2c2c77;
        margin-top: 12px;
        text-align: center;
    }

    /* Container untuk informasi profil */
    .profile-info {
        background-color: #ffffff;
        padding: 25px;
        margin-bottom: 30px;
        border-radius: 12px;
        border: 1px solid #eaeaea;
    }

    /* Style untuk setiap baris informasi */
    .profile-info p {
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
        margin: 0;
        font-size: 15px;
        line-height: 1.6;
        color: #333;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .profile-info p:last-child {
        border-bottom: none;
    }

    /* Style untuk label yang dibold */
    .profile-info strong {
        color: #666;
        font-weight: 500;
        width: auto;
    }

    /* Update button styles */
    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        justify-content: center;
    }

    .btn {
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 15px;
        transition: all 0.3s ease;
        min-width: 140px;
    }

    .btn-primary {
        background-color: #2c2c77;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-primary:hover {
        background-color: #3949cc;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        .container {
            margin: 15px;
            padding: 20px;
        }
        
        .profile-image {
            width: 100px;
            height: 100px;
        }
        
        .user-name {
            font-size: 20px;
        }
        
        .btn {
            padding: 10px 20px;
            font-size: 14px;
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
        background-color: transparent;
        padding: 1rem;
        border-bottom: none;
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
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

    /* Media queries untuk responsivitas */
    @media (max-width: 768px) {
        body {
            background: linear-gradient(135deg, #e7eaf6 0%, #f5f5f5 100%);
        }
        
        .container {
            margin: 10px;
            padding: 20px;
        }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        body {
            background: linear-gradient(135deg, #e7eaf6 0%, #f5f5f5 100%);
        }
    }

    @media (min-width: 1025px) {
        body {
            background: linear-gradient(135deg, #e7eaf6 0%, #f5f5f5 100%);
        }
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
