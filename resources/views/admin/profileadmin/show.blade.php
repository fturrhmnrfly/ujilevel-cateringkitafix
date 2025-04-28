<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #2c2c77;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: bold;
        }

        .admin-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .admin-role {
            color: #666;
            margin-bottom: 20px;
        }

        .info-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .info-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: #666;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e2e2;
            border-radius: 8px;
            font-size: 14px;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: #4F46E5;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 25px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: opacity 0.3s;
        }

        .btn-reset {
            background: #e2e2e2;
            color: #666;
        }

        .btn-save {
            background: #4F46E5;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .info-value {
            width: 100%;
            padding: 12px;
            background: #f8f9fa;
            border: 1px solid #e2e2e2;
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            min-height: 45px;
            display: flex;
            align-items: center;
        }

        .info-value.bio {
            min-height: 100px;
            align-items: flex-start;
            white-space: pre-wrap;
        }

        .btn-save {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #2c2c77;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .sign-out {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        /* Breadcrumb Styles */
        .breadcrumb-container {
            background-color: #f3f4f6;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            margin-top: 70px;
            width: 100%;
        }

        .breadcrumb {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
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

        .container {
            margin-top: 120px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('assets/logo.png') }}" alt="Catering Kita">
            <span style="color: white; font-weight: bold;">CATERING KITA</span>
        </div>
        <div class="nav-right">
            <a href="{{ route('logout') }}" class="sign-out" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <div class="breadcrumb-title">Profile</div>
            <div class="breadcrumb-nav">
                <a href="{{ route('admin.dashboard') }}">Home</a> » Profile
            </div>
        </div>
    </div>

    <!-- Existing Content -->
    <div class="container">
        <div class="profile-header">
            <div class="profile-image">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h2 class="admin-name">{{ $user->name }}</h2>
            <p class="admin-role">Admin 1</p>
        </div>

        <div class="info-container">
            <h3 class="info-title">Informasi Profil</h3>
            <div class="profile-info">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="info-value">{{ $user->name }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <div class="info-value">{{ strtolower(str_replace(' ', '', $user->name)) }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="info-value">{{ $user->email }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <div class="info-value">{{ $profile->phone ?? '-' }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <div class="info-value bio">{{ $profile->bio ?? 'hello guys' }}</div>
                </div>

                <div class="btn-container">
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-save">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
