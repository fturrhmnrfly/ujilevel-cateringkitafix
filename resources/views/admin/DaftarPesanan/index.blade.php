<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Include existing styles here -->
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
            padding: 20px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .stat-card p {
            margin: 5px 0 0;
            color: #666;
        }

        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f7f7f7;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #e0e0e0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-diproses {
            background: #ffc107;
            color: #000;
        }

        .badge-dikirim {
            background: #17a2b8;
            color: #fff;
        }

        .badge-diterima {
            background: #28a745;
            color: #fff;
        }

        .badge-dibatalkan {
            background: #dc3545;
            color: #fff;
        }

        .badge-pending {
            background: #6c757d;
            color: #fff;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
        }

        .btn-next-status {
            background-color: #28a745;
            color: white;
        }

        .btn-disabled {
            background-color: #6c757d;
            color: white;
            cursor: not-allowed;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <x-sidebar />

    <div class="main-content">
        <x-admin-header title="Daftar Pesanan" />

        <div class="content">
            <!-- Real-time Statistics -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3 id="stat-total">{{ $stats['total'] }}</h3>
                    <p>Semua Pesanan</p>
                </div>
                <div class="stat-card">
                    <h3 id="stat-pending">{{ $stats['belum_bayar'] }}</h3>
                    <p>Belum Bayar</p>
                </div>
                <div class="stat-card">
                    <h3 id="stat-diproses">{{ $stats['diproses'] }}</h3>
                    <p>Diproses</p>
                </div>
                <div class="stat-card">
                    <h3 id="stat-dikirim">{{ $stats['dikirim'] }}</h3>
                    <p>Dikirim</p>
                </div>
                <div class="stat-card">
                    <h3 id="stat-selesai">{{ $stats['selesai'] }}</h3>
                    <p>Selesai</p>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pesanan</th>
                            <th>Nama pelanggan</th>
                            <th>Kategori Pesanan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Jumlah Pesanan</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Waktu Pengiriman</th>
                            <th>Alamat Pengiriman</th>
                            <th>Nomor Telepon</th>
                            <th>Pesan</th>
                            <th>Opsi Pengiriman</th>
                            <th>Total Harga</th>
                            <th>Status pengiriman</th>
                            <th>Status pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanans as $pesanan)
                        <tr data-order-id="{{ $pesanan->id }}" data-order-status="{{ $pesanan->status_pengiriman }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pesanan->order_id }}</td>
                            <td>{{ $pesanan->nama_pelanggan }}</td>
                            <td>{{ $pesanan->kategori_pesanan }}</td>
                            <td>{{ $pesanan->tanggal_pesanan->format('d/m/Y') }}</td>
                            <td>{{ $pesanan->jumlah_pesanan }}</td>
                            <td>{{ $pesanan->tanggal_pengiriman }}</td>
                            <td>{{ $pesanan->waktu_pengiriman }}</td>
                            <td>{{ $pesanan->lokasi_pengiriman }}</td>
                            <td>{{ $pesanan->nomor_telepon }}</td>
                            <td>{{ $pesanan->pesan }}</td>
                            <td>{{ $pesanan->opsi_pengiriman }}</td>
                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status_pengiriman }}">
                                    {{ ucfirst($pesanan->status_pengiriman) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status_pembayaran }}">
                                    {{ strtoupper($pesanan->status_pembayaran) }}
                                </span>
                            </td>
                            <td>
                                @if($pesanan->status_pengiriman === 'diterima' || $pesanan->status_pengiriman === 'dibatalkan')
                                    <button class="btn-action btn-disabled" disabled>
                                        Selesai
                                    </button>
                                @elseif($pesanan->status_pengiriman === 'dikirim')
                                    <button class="btn-action btn-disabled" disabled>
                                        Menunggu Konfirmasi Pelanggan
                                    </button>
                                @else
                                    <button class="btn-action btn-next-status" onclick="showUpdateModal('{{ $pesanan->id }}', '{{ $pesanan->status_pengiriman }}', '{{ $pesanan->order_id }}')">
                                        @if($pesanan->status_pengiriman === 'diproses')
                                            Kirim Pesanan
                                        @endif
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include existing modals and scripts here -->
</body>
</html>