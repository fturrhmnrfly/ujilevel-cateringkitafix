<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <style>
        /* Use the same styles as create.blade.php */
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

        .content {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .form-wrapper {
            max-width: 1000px;
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

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar {
                display: none;
            }

            .btn-tambahkan {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="form-container">
            <h2>Edit Pesanan</h2>

            <form action="{{ route('admin.daftarpesanan.update', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="nama_pesanan">Nama Pesanan</label>
                    <input type="text" id="nama_pesanan" name="nama_pesanan" value="{{ $pesanan->nama_pesanan }}" required>
                </div>

                <div class="form-group">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ $pesanan->nama_pelanggan }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_pesanan">Tanggal Pesanan</label>
                    <input type="date" id="tanggal_pesanan" name="tanggal_pesanan" value="{{ $pesanan->tanggal_pesanan->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_pesanan">Jumlah Pesanan</label>
                    <input type="number" id="jumlah_pesanan" name="jumlah_pesanan" value="{{ $pesanan->jumlah_pesanan }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_acara">Tanggal Acara</label>
                    <input type="date" id="tanggal_acara" name="tanggal_acara" value="{{ $pesanan->tanggal_acara->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="lokasi_pengiriman">Lokasi Pengiriman</label>
                    <textarea id="lokasi_pengiriman" name="lokasi_pengiriman" required>{{ $pesanan->lokasi_pengiriman }}</textarea>
                </div>

                <div class="form-group">
                    <label for="total_harga">Total Harga</label>
                    <input type="number" id="total_harga" name="total_harga" value="{{ $pesanan->total_harga }}" required>
                </div>

                <div class="form-group">
                    <label for="status_pengiriman">Status Pengiriman</label>
                    <select id="status_pengiriman" name="status_pengiriman" required>
                        <option value="pending" {{ $pesanan->status_pengiriman === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $pesanan->status_pengiriman === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $pesanan->status_pengiriman === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pesan_untuk_penjual">Pesan untuk Penjual</label>
                    <textarea id="pesan_untuk_penjual" name="pesan_untuk_penjual" rows="3">{{ $pesanan->pesan_untuk_penjual }}</textarea>
                </div>

                <button type="submit" class="submit-btn">Update Pesanan</button>
            </form>
        </div>
    </div>
</body>
</html>
