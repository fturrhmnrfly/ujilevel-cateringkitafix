<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - Admin</title>
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
            padding: 20px;
        }

        .content {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #D2B48C;
        }

        .form-group {
            margin-bottom: 25px;
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
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #D2B48C;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(210, 180, 140, 0.1);
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
            background: #D38524;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #B8731F;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }

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
        <div class="content">
            <h2 class="page-title">Tambah Laporan Keuangan Baru</h2>

            <form action="{{ route('admin.laporan.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="laporan">Nama Laporan</label>
                    <input type="text" id="laporan" name="laporan" class="form-control" 
                           placeholder="Contoh: Laporan Penjualan Bulan Januari" 
                           value="{{ old('laporan') }}" required>
                    @error('laporan')
                        <small style="color: #dc3545;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jenis_laporan">Jenis Laporan</label>
                        <select id="jenis_laporan" name="jenis_laporan" class="form-control" required>
                            <option value="">Pilih Jenis Laporan</option>
                            <option value="pemasukan" {{ old('jenis_laporan') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="pengeluaran" {{ old('jenis_laporan') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                        @error('jenis_laporan')
                            <small style="color: #dc3545;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Laporan</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" 
                               value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        @error('tanggal')
                            <small style="color: #dc3545;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="total">Jumlah (Rp)</label>
                    <input type="number" id="total" name="total" class="form-control" 
                           placeholder="Masukkan jumlah dalam rupiah" 
                           value="{{ old('total') }}" min="0" step="1000" required>
                    @error('total')
                        <small style="color: #dc3545;">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">
                    Buat
                </button>
            </form>
        </div>
    </div>
</body>
</html>
