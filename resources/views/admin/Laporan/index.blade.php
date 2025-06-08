<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
            width: calc(100% - 250px);
        }

        .content {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-group label {
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .filter-group select,
        .filter-group input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-filter {
            background: #4F46E5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 12px;
            font-weight: 500;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .badge-pemasukan {
            background-color: #4CAF50;
            color: white;
        }

        .badge-pengeluaran {
            background-color: #ff6b6b;
            color: white;
        }

        .btn-view {
            background-color: #e2e2e2;
            color: black;
            padding: 4px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
        }

        .btn-edit {
            background-color: #ffc107;
            color: black;
            padding: 4px 12px;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <x-admin-header title="Laporan Keuangan" />

        <div class="content">
            <div class="filters">
                <div class="filter-group">
                    <label>Periode</label>
                    <select id="periode-filter">
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan" selected>Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Bulan</label>
                    <select id="bulan-filter">
                        <option value="">Semua Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Tahun</label>
                    <input type="number" id="tahun-filter" value="{{ date('Y') }}" min="2020" max="2030">
                </div>
                <div class="filter-group">
                    <label>Jenis</label>
                    <select id="jenis-filter">
                        <option value="">Semua</option>
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                </div>
                <button class="btn-filter" onclick="applyFilter()">Filter</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="laporan-table-body">
                    <!-- Data akan diisi melalui JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function applyFilter() {
            // Implementasi filter laporan
            console.log('Filter applied');
        }
    </script>
</body>
</html>
