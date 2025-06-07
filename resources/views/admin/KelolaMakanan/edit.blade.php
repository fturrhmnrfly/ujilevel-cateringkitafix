<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Makanan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border: 2px solid #26276B;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #26276B;
            background-color: white;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%23999' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        .btn-primary {
            background-color: #26276B;
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
            display: block;
            margin: 0 auto;
            margin-top: 30px;
        }

        .btn-primary:hover {
            background-color: #1e1f5a;
        }

        .form-group small {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        /* File input styling */
        input[type="file"] {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            background-color: #fafafa;
            position: relative;
        }

        input[type="file"]:hover {
            border-color: #26276B;
            background-color: #f8f9ff;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .form-container {
                padding: 20px;
                margin: 10px;
            }

            .page-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>
    
    <div class="main-content">
        <h1 class="page-title">Edit Kelola Makanan</h1>
        
        <div class="form-container">
            <form action="{{ route('admin.kelolamakanan.update', $kelolamakanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="image">Foto Produk</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    <small>Biarkan kosong jika tidak ingin mengganti gambar.</small>
                </div>
                
                <div class="form-group">
                    <label for="nama_makanan">Nama Makanan:</label>
                    <input type="text" id="nama_makanan" name="nama_makanan" class="form-control" value="{{ $kelolamakanan->nama_makanan }}" required placeholder="Masukkan nama makanan">
                </div>
                
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori" class="form-control" required>
                        <option value="Prasmanan" {{ $kelolamakanan->kategori == 'Prasmanan' ? 'selected' : '' }}>Prasmanan</option>
                        <option value="Nasi Box" {{ $kelolamakanan->kategori == 'Nasi Box' ? 'selected' : '' }}>Nasi Box</option>
                        <option value="Paket Pernikahan" {{ $kelolamakanan->kategori == 'Paket Pernikahan' ? 'selected' : '' }}>Paket Pernikahan</option>
                        <option value="Paket Harian" {{ $kelolamakanan->kategori == 'Paket Harian' ? 'selected' : '' }}>Paket Harian</option>
                        <option value="Ala Carte" {{ $kelolamakanan->kategori == 'Ala Carte' ? 'selected' : '' }}>Ala Carte</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" class="form-control" value="{{ $kelolamakanan->harga }}" required placeholder="Harga sesuai kategori">
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="Tersedia" {{ $kelolamakanan->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Tidak Tersedia" {{ $kelolamakanan->status == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required placeholder="Deskripsi apa saja yang mau ditambahkan dan ditanyakan">{{ $kelolamakanan->deskripsi }}</textarea>
                </div>
                
                <button type="submit" class="btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</body>
</html>
