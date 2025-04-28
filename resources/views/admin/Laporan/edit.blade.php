<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan - Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f3f4f6;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f8f9fa;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .btn-submit {
            background-color: #4040ff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-submit:hover {
            background-color: #3333cc;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin-right: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1>Edit Laporan</h1>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Laporan</label>
                    <input type="text" name="laporan" value="{{ $laporan->laporan }}" placeholder="Laporan apa: penjuala / pengeluaran" required>
                </div>

                <div class="form-group">
                    <label>Jenis Laporan</label>
                    <input type="text" name="jenis_laporan" value="{{ $laporan->jenis_laporan }}" placeholder="Hari / perbulan / mingguan" required>
                </div>

                <div class="form-group">
                    <label>Tanggal buat laporannya</label>
                    <input type="date" name="tanggal" value="{{ $laporan->tanggal }}" required>
                </div>

                <div class="form-group">
                    <label>Admin Yang buat</label>
                    <input type="text" name="admin" value="{{ $laporan->admin }}" placeholder="Admin 1/2/3" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Maksudnya laporan ini di buat untuk laporan apa ?" required>{{ $laporan->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" name="status" value="{{ $laporan->status }}" placeholder="selesai / masih belum lengkap /pending" required>
                </div>

                <div>
                    <a href="{{ route('admin.laporan.index') }}" class="btn-back">Kembali</a>
                    <button type="submit" class="btn-submit">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
