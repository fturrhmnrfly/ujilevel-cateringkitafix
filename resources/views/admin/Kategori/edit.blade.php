<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - Admin</title>
    <style>
        .content {
            padding: 20px;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        textarea {
            min-height: 100px;
        }

        .btn-submit {
            background-color: #FFA500;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 10px;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1>Edit Kategori</h1>
        </div>

        <div class="content">
            <div class="form-container">
                <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" 
                               name="nama_kategori" 
                               id="nama_kategori" 
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                               required 
                               placeholder="Masukan nama karyawan">
                        @error('nama_kategori')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" 
                                  id="deskripsi" 
                                  required 
                                  placeholder="Masukan Username karyawan">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_item">Jumlah Item</label>
                        <input type="number" 
                               name="jumlah_item" 
                               id="jumlah_item" 
                               value="{{ old('jumlah_item', $kategori->jumlah_item) }}" 
                               required 
                               placeholder="Posisi nya bagian apa">
                        @error('jumlah_item')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="{{ route('admin.kategori.index') }}" class="btn-back">Kembali</a>
                        <button type="submit" class="btn-submit">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>