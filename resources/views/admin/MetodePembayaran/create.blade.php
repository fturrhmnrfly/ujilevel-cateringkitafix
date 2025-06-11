<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Metode Pembayaran - Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px 0; /* Hilangkan padding kiri-kanan */
        }

        .container {
            background: white;
            border-radius: 10px;
            padding: 30px; /* Perbesar dari 20px ke 30px */
            margin-top: 20px;
            width: 100%; /* Full width */
            max-width: none; /* Hilangkan max-width */
            margin-left: 0; /* Reset margin */
            margin-right: 0; /* Reset margin */
        }

        .page-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 25px; /* Perbesar dari 20px ke 25px */
        }

        .form-label {
            display: block;
            margin-bottom: 8px; /* Perbesar dari 5px ke 8px */
            color: #555;
            font-weight: 500;
            font-size: 15px; /* Tambahkan ukuran font */
        }

        .form-control {
            width: 100%;
            padding: 12px 15px; /* Perbesar dari 8px 12px ke 12px 15px */
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 15px; /* Perbesar dari 14px ke 15px */
        }

        .form-control:focus {
            outline: none;
            border-color: #B19370;
        }

        textarea.form-control {
            min-height: 120px; /* Perbesar dari 100px ke 120px */
            resize: vertical;
        }

        .btn {
            padding: 12px 20px; /* Perbesar dari 8px 16px ke 12px 20px */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px; /* Perbesar dari 14px ke 15px */
            font-weight: 500;
        }

        .btn-primary {
            background-color: #B19370;
            color: white;
        }

        .btn-primary:hover {
            background-color: #9a7f5e;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .action-buttons {
            display: flex;
            gap: 15px; /* Perbesar dari 10px ke 15px */
            margin-top: 30px; /* Perbesar dari 20px ke 30px */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 0 30px; /* Tambahkan padding untuk header */
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-profile span {
            color: #666;
        }
    </style>
</head>
<body>
    <x-sidebar/>
    
    <div class="main-content">
        <div class="header">
            <h2>Tambah Metode Pembayaran</h2>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="{{ asset('assets/profil.png') }}" alt="Admin" width="40" height="40">
            </div>
        </div>

        <div class="container">
            <form action="{{ route('admin.metodepembayaran.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="metode_pembayaran">Metode Pembayaran</label>
                    <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="form-control" value="{{ old('metode_pembayaran') }}" placeholder="Masukan metode pembayaran" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi metode pembayaran">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="admin">Admin</label>
                    <input type="text" name="admin" id="admin" class="form-control" value="{{ old('admin') }}" placeholder="Nama admin" required>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.metodepembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>