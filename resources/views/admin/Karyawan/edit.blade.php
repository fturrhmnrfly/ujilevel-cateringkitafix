<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan - Admin</title>
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
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
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
        
        /* Tambahan styling untuk form yang lebih baik */
        .form-row {
            display: flex;
            gap: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .required {
            color: red;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1>Edit Karyawan</h1>
        </div>

        <div class="content">
            <div class="form-container">
                <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- ✅ HANYA FIELD YANG ADA DI INDEX ✅ -->
                    
                    <!-- Nama dan Email dalam satu baris -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama_karyawan">Nama Karyawan <span class="required">*</span></label>
                            <input type="text" name="nama_karyawan" id="nama_karyawan" required 
                                   value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}" 
                                   placeholder="Masukan nama karyawan">
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" name="email" id="email" required 
                                   value="{{ old('email', $karyawan->email) }}" 
                                   placeholder="contoh@email.com">
                        </div>
                    </div>

                    <!-- Kontak dan Tipe Pengguna dalam satu baris -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="kontak">Kontak <span class="required">*</span></label>
                            <input type="text" name="kontak" id="kontak" required 
                                   value="{{ old('kontak', $karyawan->kontak) }}" 
                                   placeholder="nomor karyawan">
                        </div>

                        <div class="form-group">
                            <label for="tipe_pengguna">Tipe Pengguna <span class="required">*</span></label>
                            <select name="tipe_pengguna" id="tipe_pengguna" required>
                                <option value="">Pilih Tipe Pengguna</option>
                                <option value="admin" {{ (old('tipe_pengguna', $karyawan->tipe_pengguna) == 'admin') ? 'selected' : '' }}>Admin</option>
                                <option value="karyawan" {{ (old('tipe_pengguna', $karyawan->tipe_pengguna) == 'karyawan') ? 'selected' : '' }}>Karyawan</option>
                                <option value="user" {{ (old('tipe_pengguna', $karyawan->tipe_pengguna) == 'user') ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('admin.karyawan.index') }}" class="btn-back">Kembali</a>
                        <button type="submit" class="btn-submit">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>