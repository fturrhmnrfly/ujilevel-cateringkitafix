<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan</title>
    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="form-container">
            <h2>Tambah Pesanan Baru</h2>

            <form action="{{ route('admin.daftarpesanan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_pesanan">Nama Pesanan</label>
                    <input type="text" id="nama_pesanan" name="nama_pesanan" required>
                </div>

                <div class="form-group">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_pesanan">Tanggal Pesanan</label>
                    <input type="date" id="tanggal_pesanan" name="tanggal_pesanan" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_pesanan">Jumlah Pesanan</label>
                    <input type="number" id="jumlah_pesanan" name="jumlah_pesanan" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_acara">Tanggal Acara</label>
                    <input type="date" id="tanggal_acara" name="tanggal_acara" required>
                </div>

                <div class="form-group">
                    <label for="lokasi_pengiriman">Lokasi Pengiriman</label>
                    <textarea id="lokasi_pengiriman" name="lokasi_pengiriman" required></textarea>
                </div>

                <div class="form-group">
                    <label for="total_harga">Total Harga</label>
                    <input type="number" id="total_harga" name="total_harga" required>
                </div>

                <div class="form-group">
                    <label for="status_pengiriman">Status Pengiriman</label>
                    <select id="status_pengiriman" name="status_pengiriman" required>
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pesan_untuk_penjual">Pesan untuk Penjual</label>
                    <textarea id="pesan_untuk_penjual" name="pesan_untuk_penjual" rows="3"></textarea>
                </div>

                <button type="submit" class="submit-btn">Simpan Pesanan</button>
            </form>
        </div>
    </div>
</body>
</html>
