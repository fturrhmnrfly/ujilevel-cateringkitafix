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
            padding-top: 80px; /* Keep this for navbar space */
            background-color: #f5f5f5;
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

        /* Fixed Tab Navigation */
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

        /* Order Card Styles - Updated to match the image */
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

        .status-badge {
            padding: 5px 12px;
            background: #FFF3CD;
            color: #856404;
            border-radius: 15px;
            font-size: 13px;
        }

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

        .delivery-schedule {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .delivery-icon {
            color: #666;
            margin-right: 8px;
        }

        .delivery-text {
            color: #666;
            font-size: 14px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-detail {
            display: block;
            text-align: center;
            padding: 12px;
            background: #27276e;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            width: 100%;
        }

        .btn-detail:hover {
            background: #1f1f5c;
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

    <div class="order-card">
        <!-- Header dengan Order ID dan Status -->
        <div class="order-header">
            <div class="order-header-left">
                <h3>Order ID</h3>
                <p class="order-id">ORD123456789</p>
                <p class="order-date">Tanggal Pemesanan : 16 Januari 2025</p>
            </div>
            <span class="status-badge" style="background: #FFF3CD; color: #856404;">Diproses</span>
        </div>

        <!-- Order Items -->
        <div class="order-item">
            <img src="{{ asset('assets/kentangbalado.png') }}" alt="Kentang Balado" class="item-image">
            <div class="item-details">
                <h4 class="item-name">Kentang Balado</h4>
                <p class="item-quantity">1x</p>
            </div>
            <div class="item-price">Rp.5000</div>
        </div>

        <div class="order-item">
            <img src="{{ asset('assets/homeassets3.jpg') }}" alt="Ayam Geprek" class="item-image">
            <div class="item-details">
                <h4 class="item-name">Ayam Geprek</h4>
                <p class="item-quantity">1x</p>
            </div>
            <div class="item-price">Rp.12.000</div>
        </div>

        <!-- Order Summary -->
        <div class="order-divider"></div>

        <div class="order-summary-row">
            <span class="summary-label">Subtotal</span>
            <span class="summary-value">Rp. 17.000</span>
        </div>
        <div class="order-summary-row">
            <span class="summary-label">Biaya Pengiriman</span>
            <span class="summary-value">Rp. 3000</span>
        </div>
        <div class="order-summary-row summary-row-total">
            <span class="summary-label">Total</span>
            <span class="summary-value">Rp. 20.000</span>
        </div>
        <div class="order-summary-row">
            <span class="summary-label">Metode Pembayaran</span>
            <span class="summary-value">COD</span>
        </div>

        <!-- Delivery Schedule -->
        <div class="delivery-schedule">
            <i class="far fa-calendar delivery-icon"></i>
            <span class="delivery-text">Pengiriman dijadwalkan: 20 Januari 2025, 10:00 - 11:00</span>
        </div>

        <!-- Action Button -->
        <div class="action-buttons">
            <a href="#" class="btn-detail">Lihat Detail</a>
        </div>
    </div>
</div>

</body>
</html>