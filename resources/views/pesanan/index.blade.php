<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita User - Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 80px;
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar Styles - Dari belumdibayar.blade.php */
        nav.navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c2c77;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .navbar .logo img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .navbar .logo .text-navbar p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #ffcc00;
            text-transform: uppercase;
        }

        .navbar .logo .text-navbar p:nth-child(2) {
            color: #fff;
        }

        .navbar .search-bar {
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            width: 40%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar .search-bar input[type="text"] {
            border: none;
            outline: none;
            flex: 1;
            padding: 5px;
            font-size: 14px;
        }

        .navbar .search-bar button {
            border: none;
            background: none;
            cursor: pointer;
            color: #2c2c77;
            font-size: 16px;
        }

        .navbar .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar .nav-links li {
            display: inline-block;
        }

        .navbar .nav-links li a {
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .navbar .nav-links li a:hover {
            color: #ffcc00;
        }

        .navbar .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .navbar .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        /* Tab Navigation - Dari belumdibayar.blade.php */
        .container {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        .tab-navigation {
            display: flex;
            justify-content: center;
            background-color: #27276e;
            padding: 10px 20px;
            width: 100%;
            margin-top: 30px;
        }

        .tab-btn {
            flex: 1;
            padding: 12px 20px;
            text-align: center;
            background-color: #fff;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            margin: 0 5px;
            border-radius: 8px;
            color: black;
            text-decoration: none;
        }

        .tab-btn:first-child {
            margin-left: 0;
        }

        .tab-btn:last-child {
            margin-right: 0;
        }

        .tab-btn.active {
            background-color: #ffffff;
            color: #27276e;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .tab-btn:hover:not(.active) {
            background-color: #3a3a8c;
            color: white;
        }

        /* Order Card Styles - Dari belumdibayar.blade.php */
        .order-card {
            max-width: 650px;
            margin: 20px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.1);
            padding: 25px;
            overflow: hidden;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .order-header-left h3 {
            margin: 0;
            font-size: 16px;
            font-weight: normal;
            color: #333;
        }

        .order-header-left p {
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        .order-id {
            color: #333;
            font-weight: 500;
        }

        .order-date {
            color: #666;
        }

        /* Status Badge Colors - Sesuai requirements */
        .status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 500;
        }

        /* Status pembayaran pending */
        .status-badge.pending {
            background: #FFE7E7;
            color: #FF4C4C;
        }

        /* Status pengiriman */
        .status-badge.diproses {
            background: #FFF3CD;
            color: #856404;
        }

        .status-badge.dikirim {
            background: #E7F5FF;
            color: #0077CC;
        }

        .status-badge.diterima {
            background: #d1e7dd;
            color: #198754;
        }

        .status-badge.dibatalkan {
            background: #f8d7da;
            color: #721c24;
        }

        /* Order Items - Dari belumdibayar.blade.php */
        .order-item {
            background: #FFFFFF;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
        }

        .item-image {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .item-quantity {
            color: #666;
            margin: 3px 0;
            font-size: 12px;
        }

        .item-price {
            text-align: right;
            font-size: 14px;
            color: #333;
        }

        .order-divider {
            height: 1px;
            background: #eee;
            margin: 20px 0;
        }

        /* Order Summary - Dari belumdibayar.blade.php */
        .order-summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-label {
            color: #666;
            font-size: 14px;
        }

        .summary-value {
            color: #333;
            font-size: 14px;
        }

        .summary-row-total {
            font-weight: 500;
        }

        /* Order Info Styles */
        .order-info {
            margin-bottom: 20px;
        }

        .order-info p {
            margin: 8px 0;
            font-size: 14px;
            color: #555;
        }

        .order-info p strong {
            color: #333;
            margin-right: 8px;
        }

        /* Action Buttons - Dari belumdibayar.blade.php */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-detail {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: white;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-pay {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: #FF4C4C;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-single {
            width: 100%;
            text-align: center;
            padding: 12px;
            background: #27276e;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-single:hover {
            background: #1f1f5c;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #666;
        }

        .empty-state img {
            max-width: 150px;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .empty-state p {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .empty-state .btn-single {
            display: inline-block;
            padding: 12px 30px;
            width: auto;
        }

        /* Status Payment Colors */
        .status-payment.pending {
            color: #dc3545;
            font-weight: 600;
        }

        .status-payment.paid {
            color: #198754;
            font-weight: 600;
        }
    </style>
</head>
<body>
<x-navbar></x-navbar>

<div class="container">
    <!-- Debug info - hapus setelah selesai -->
    @if(config('app.debug'))
        <div style="background: #f0f0f0; padding: 10px; margin: 20px auto; max-width: 650px; border-radius: 5px; font-size: 12px;">
            <strong>🐛 Debug Info:</strong><br>
            User: {{ Auth::user()->name }}<br>
            Route: {{ Route::currentRouteName() }}<br>
            Total Orders: {{ isset($orders) ? count($orders) : 0 }}<br>
            @if(isset($orders) && count($orders) > 0)
                Orders Status: 
                @foreach($orders as $order)
                    [{{ $order->order_id }}: {{ $order->status_pembayaran }}/{{ $order->status_pengiriman }}]
                @endforeach
            @endif
            <br>
            <a href="{{ route('pesanan.debug') }}" style="color: blue;">View Full Debug</a>
        </div>
    @endif

    <div class="tab-navigation">
        <a href="{{ route('pesanan.index') }}" class="tab-btn {{ request()->routeIs('pesanan.index') ? 'active' : '' }}">Semua Pesanan</a>
        <a href="{{ route('pesanan.unpaid') }}" class="tab-btn {{ request()->routeIs('pesanan.unpaid') ? 'active' : '' }}">Belum Bayar</a>
        <a href="{{ route('pesanan.process') }}" class="tab-btn {{ request()->routeIs('pesanan.process') ? 'active' : '' }}">Diproses</a>
        <a href="{{ route('pesanan.shipped') }}" class="tab-btn {{ request()->routeIs('pesanan.shipped') ? 'active' : '' }}">Dikirim</a>
        <a href="{{ route('pesanan.completed') }}" class="tab-btn {{ request()->routeIs('pesanan.completed') ? 'active' : '' }}">Selesai</a>
        <a href="{{ route('pesanan.penilaian') }}" class="tab-btn {{ request()->routeIs('pesanan.penilaian') ? 'active' : '' }}">Penilaian</a>
    </div>

    @if(isset($orders) && count($orders) > 0)
        @foreach($orders as $order)
        <div class="order-card">
            <!-- Header dengan Order ID dan Status -->
            <div class="order-header">
                <div class="order-header-left">
                    <h3>Order ID</h3>
                    <p class="order-id">{{ $order->order_id }}</p>
                    <p class="order-date">Tanggal Pemesanan: {{ $order->created_at->format('d F Y') }}</p>
                </div>
                <span class="status-badge {{ $order->status_pembayaran == 'pending' ? 'pending' : strtolower($order->status_pengiriman) }}">
                    @if($order->status_pembayaran == 'pending')
                        Belum Bayar
                    @else
                        {{ ucfirst($order->status_pengiriman) }}
                    @endif
                </span>
            </div>

            <!-- Order Info -->
            <div class="order-info">
                <p><strong>Kategori:</strong> {{ $order->kategori_pesanan }}</p>
                <p><strong>Jumlah:</strong> {{ $order->jumlah_pesanan }} porsi</p>
                <p><strong>Pengiriman:</strong> {{ $order->tanggal_pengiriman->format('d F Y') }}</p>
                <p><strong>Waktu:</strong> {{ $order->waktu_pengiriman }}</p>
                <p><strong>Alamat:</strong> {{ $order->lokasi_pengiriman }}</p>
                <p><strong>No. Telepon:</strong> {{ $order->nomor_telepon }}</p>
                @if($order->pesan)
                    <p><strong>Pesan:</strong> {{ $order->pesan }}</p>
                @endif
            </div>

            <div class="order-divider"></div>

            <!-- Order Summary -->
            <div class="order-summary-row">
                <span class="summary-label">Opsi Pengiriman</span>
                <span class="summary-value">{{ ucfirst($order->opsi_pengiriman) }}</span>
            </div>
            <div class="order-summary-row summary-row-total">
                <span class="summary-label">Total Harga</span>
                <span class="summary-value">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="order-summary-row">
                <span class="summary-label">Status Pembayaran</span>
                <span class="summary-value status-payment {{ $order->status_pembayaran }}">
                    {{ $order->status_pembayaran == 'pending' ? 'Belum Bayar' : 'Sudah Bayar' }}
                </span>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                @if($order->status_pembayaran == 'pending')
                    <a href="#" class="btn-detail">Lihat Detail</a>
                    <a href="#" class="btn-pay">Bayar Sekarang</a>
                @else
                    <a href="#" class="btn-single">Lihat Detail</a>
                @endif
            </div>
        </div>
        @endforeach
    @else
        <div class="empty-state">
            <img src="{{ asset('assets/empty-order.png') }}" alt="Tidak ada pesanan">
            <h3>Belum Ada Pesanan</h3>
            <p>Anda belum memiliki pesanan. Silahkan pesan makanan terlebih dahulu.</p>
            <a href="{{ route('dashboard') }}" class="btn-single">
                Pesan Sekarang
            </a>
        </div>
    @endif
</div>

</body>
</html>