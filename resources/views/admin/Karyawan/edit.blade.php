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
                    
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" name="nama_karyawan" id="nama_karyawan" required 
                               value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}" 
                               placeholder="Masukan nama karyawan">
                    </div>

                    <div class="form-group">
                        <label for="username_karyawan">Username Karyawan</label>
                        <input type="text" name="username_karyawan" id="username_karyawan" required 
                               value="{{ old('username_karyawan', $karyawan->username_karyawan) }}" 
                               placeholder="Masukan Username karyawan">
                    </div>

                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" name="posisi" id="posisi" required 
                               value="{{ old('posisi', $karyawan->posisi) }}" 
                               placeholder="Posisi nya bagian apa">
                    </div>

                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="text" name="kontak" id="kontak" required 
                               value="{{ old('kontak', $karyawan->kontak) }}" 
                               placeholder="nomor karyawan">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_bergabung">Tanggal Bergabung</label>
                        <input type="date" name="tanggal_bergabung" id="tanggal_bergabung" required 
                               value="{{ old('tanggal_bergabung', $karyawan->tanggal_bergabung) }}">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ $karyawan->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Cuti" {{ $karyawan->status == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                            <option value="Nonaktif" {{ $karyawan->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keahlian">Keahlian</label>
                        <input type="text" name="keahlian" id="keahlian" required 
                               value="{{ old('keahlian', $karyawan->keahlian) }}" 
                               placeholder="keahlian karyawannya apa">
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