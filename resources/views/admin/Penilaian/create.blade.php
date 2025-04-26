create.blade.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penilaian</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background-color: #f3f4f6;
        }

        .content {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .form-wrapper {
            max-width: 800px;
            width: 100%;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f8f9fa;
            color: #495057;
        }

        .form-control::placeholder {
            color: #999;
            font-size: 14px;
        }

        .btn-tambahkan {
            background-color: #4040ff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-tambahkan:hover {
            background-color: #3333ff;
        }

        .header {
            background-color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>
    
    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Penilaian</h1>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
            </div>
        </div><br><br>

        <h2 class="page-title" style="text-align: center">Tambah Penilaian</h2>
        <div class="content">
            <div class="form-wrapper">
                <form action="{{ route('admin.penilaian.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_pembeli">Nama Pembeli</label>
                        <input type="text" class="form-control" name="nama_pembeli" placeholder="Masukkan nama pembeli" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" placeholder="Masukkan nama produk" required>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating (1-5)</label>
                        <input type="number" class="form-control" name="rating" min="1" max="5" placeholder="Masukkan rating" required>
                    </div>
                    <button type="submit" class="btn-tambahkan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>