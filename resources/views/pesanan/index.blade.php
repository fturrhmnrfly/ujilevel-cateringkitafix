<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Add Font Awesome CDN in the head section -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita User - Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 80px;
            background: url('{{ asset('assets/backgroundpesanan.jpeg') }}') center center/cover no-repeat;
            /* Ganti 'assets/bg-pesanan.jpg' dengan nama file dan lokasi gambar background yang baru saja Anda upload */
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar Styles - Unchanged */
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

        /* Fixed Tab Navigation - Modified with spacing */
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
            margin-top: 30px; /* Increased margin-top */
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

        /* Add this for the content container */
        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 15px;
        }

        /* Add these styles to your existing CSS */
        .page-content {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .order-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .order-number {
            color: #27276e;
            font-weight: 600;
            font-size: 16px;
        }

        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-badge.pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .order-info {
            margin-bottom: 15px;
        }

        .order-info p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .order-summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .summary-row.total {
            border-top: 1px solid #ddd;
            padding-top: 8px;
            margin-top: 8px;
            font-weight: 600;
        }

        .action-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #27276e;
            color: white;
            text-align: center;
            border-radius: 8px;
            margin-top: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            background-color: #1a1a5c;
            transform: translateY(-1px);
        }

        /* New styles for the updated order card */
        .order-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .order-number {
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.pending {
            background-color: #e2e3f3;
            color: #6c757d;
        }

        .status-badge.process {
            background-color: #cfe2ff;
            color: #1e90ff;
        }

        .status-badge.shipped {
            background-color: #d1e7dd;
            color: #198754;
        }

        .status-badge.completed {
            background-color: #d4edda;
            color: #155724;
        }

        .order-info {
            margin-bottom: 15px;
            font-size: 14px;
            color: #555;
        }

        .order-info p {
            margin: 5px 0;
        }

        .order-summary {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #333;
        }

        .summary-row.total {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
            font-weight: 700;
            color: #000;
        }

        .action-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border-radius: 5px;
            margin-top: 15px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .action-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Empty state styles */
        .empty-state {
            text-align: center;
            padding: 50px 0;
        }

        .empty-state img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .empty-state .action-button {
            display: inline-block;
            padding: 12px 30px;
            background: #2c2c77;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .empty-state .action-button:hover {
            background-color: #1a1a5c;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<x-navbar></x-navbar>

<div class="container">
    
    <div class="tab-navigation">
        <a href="{{ route('pesanan.index') }}" class="tab-btn {{ request()->routeIs('pesanan.index') ? 'active' : '' }}">Semua Pesanan</a>
        <a href="{{ route('pesanan.unpaid') }}" class="tab-btn {{ request()->routeIs('pesanan.unpaid') ? 'active' : '' }}">Belum Bayar</a>
        <a href="{{ route('pesanan.process') }}" class="tab-btn {{ request()->routeIs('pesanan.process') ? 'active' : '' }}">Diproses</a>
        <a href="{{ route('pesanan.shipped') }}" class="tab-btn {{ request()->routeIs('pesanan.shipped') ? 'active' : '' }}">Dikirim</a>
        <a href="{{ route('pesanan.completed') }}" class="tab-btn {{ request()->routeIs('pesanan.completed') ? 'active' : '' }}">Selesai</a>
        <a href="{{ route('pesanan.penilaian') }}" class="tab-btn {{ request()->routeIs('pesanan.penilaian') ? 'active' : '' }}">Penilaian</a>
    </div>
</div>

<div class="container">
    <div class="page-content">
        @if(isset($orders) && count($orders) > 0)
            @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-number">Order #{{ $order->order_number }}</div>
                        <div style="color: #666; font-size: 14px;">{{ $order->created_at->format('d F Y') }}</div>
                    </div>
                    <span class="status-badge {{ strtolower($order->status) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="order-info">
                    <p>Pengiriman: {{ $order->delivery_date->format('d F Y') }}</p>
                    <p>Waktu: {{ $order->delivery_time }}</p>
                    <p>Alamat: {{ $order->address }}</p>
                </div>

                <div class="order-summary">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Pengiriman</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <a href="{{ route('pesanan.show', $order->id) }}" class="action-button">
                    Lihat Detail
                </a>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <img src="{{ asset('assets/empty-order.png') }}" alt="Tidak ada pesanan">
                <h3>Belum Ada Pesanan</h3>
                <p>Anda belum memiliki pesanan. Silahkan pesan makanan terlebih dahulu.</p>
                <a href="{{ route('dashboard') }}" class="action-button">
                    Pesan Sekarang
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Rest of your HTML remains the same -->
</body>
</html>