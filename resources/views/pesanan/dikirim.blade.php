<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita User - Pesanan Dikirim</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 80px;
        }

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

        .order-card {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .order-header {
            margin-bottom: 15px;
        }

        .order-header-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-header-left h3 {
            font-size: 16px;
            margin: 0;
            color: #333;
        }

        .order-id {
            color: #333;
            font-weight: 500;
            margin: 5px 0;
        }

        .order-date {
            color: #666;
            font-size: 14px;
            margin: 5px 0;
        }

        .status-badge {
            padding: 5px 12px;
            background: #E7F5FF;  /* Light blue background */
            color: #0077CC;       /* Blue text */
            border-radius: 15px;
            font-size: 13px;
            display: inline-block;
        }

        .order-item {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .item-image {
            width: 40px;
            height: 40px;
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
            font-size: 14px;
            color: #333;
        }

        .order-summary {
            margin-bottom: 15px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .summary-row span {
            color: #666;
            font-size: 14px;
        }

        .summary-row span:last-child {
            color: #333;
        }

        .delivery-schedule {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
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

        .btn-terima {
            display: block;
            text-align: center;
            padding: 12px;
            background: #27276e;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            flex: 1;
            border: none;
            cursor: pointer;
        }

        .btn-lacak {
            display: block;
            text-align: center;
            padding: 12px;
            background: white;
            color: #27276e;
            border: 1px solid #27276e;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            flex: 1;
        }

        .btn-terima:hover {
            background: #1f1f5c;
        }

        .btn-lacak:hover {
            background: #f5f5f5;
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
    <div class="order-card">
        <!-- Header dengan Order ID dan Status -->
        <div class="order-header">
            <div class="order-header-left">
                <h3>Order ID</h3>
                <p class="order-id">ORD123456789</p>
                <p class="order-date">Tanggal Pemesanan : 16 Januari 2025</p>
            </div>
            <span class="status-badge">Sedang Dikirim</span>
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
        <div class="order-summary">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rp. 17.000</span>
            </div>
            <div class="summary-row">
                <span>Biaya Pengiriman</span>
                <span>Rp. 3000</span>
            </div>
            <div class="summary-row">
                <span>Total</span>
                <span>Rp. 20.000</span>
            </div>
            <div class="summary-row">
                <span>Metode Pembayaran</span>
                <span>COD</span>
            </div>
        </div>

        <!-- Delivery Schedule -->
        <div class="delivery-schedule">
            <i class="far fa-calendar delivery-icon"></i>
            <span class="delivery-text">Pengiriman dijadwalkan: 20 Januari 2025, 10:00 - 11:00</span>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn-terima">Terima Pesanan</button>
            <a href="#" class="btn-lacak">Lacak Pesanan</a>
        </div>
    </div>
</div>

</body>
</html>