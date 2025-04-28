<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Admin</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <div class="profile-image">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h2 class="admin-name">{{ $user->name }}</h2>
            <p class="admin-role">Admin 1</p>
        </div>

        <div class="info-container">
            <h3 class="info-title">Edit Profil</h3>
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ strtolower(str_replace(' ', '', $user->name)) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" name="phone" value="{{ $profile->phone ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea class="form-control" name="bio" rows="4">{{ $profile->bio ?? 'hello guys' }}</textarea>
                </div>

                <div class="btn-container">
                    <button type="reset" class="btn btn-reset">Batal</button>
                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>