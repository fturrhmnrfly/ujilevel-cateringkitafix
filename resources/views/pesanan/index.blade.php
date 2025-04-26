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
            justify-content: space-between;
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

        /* Rest of your CSS remains unchanged */
        .order-card {
            background-color: white;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Add these new styles in your <style> section */
        .back-button {
            margin: 20px 0 0 20px;
            display: inline-block;
            font-size: 24px;
            color: #27276e;
            text-decoration: none;
            font-weight: bold;
        }

        .back-button:hover {
            color: #3a3a8c;
        }
    </style>
</head>
<body>
<x-navbar></x-navbar>

<div class="container">
    <!-- Fix the back button syntax -->
    <a href="{{ url()->previous() }}" class="back-button">
        <i class="fas fa-chevron-left"></i>
    </a>
    
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
    <h1>Pesanan Saya</h1>
    
    @if(isset($orders) && count($orders) > 0)
        @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header" style="padding: 15px; border-bottom: 1px solid #eee;">
                    <h3>Order ID: {{ $order->id }}</h3>
                    <p>Tanggal Pemesanan: {{ $order->created_at->format('d F Y') }}</p>
                    <p>Status: 
                        <span class="status-badge" style="
                            padding: 5px 10px;
                            border-radius: 4px;
                            font-weight: bold;
                            background-color: 
                                @if($order->status == 'pending') #FFD700
                                @elseif($order->status == 'processing') #1E90FF
                                @elseif($order->status == 'shipped') #FFA500
                                @elseif($order->status == 'completed') #32CD32
                                @else #ccc
                                @endif;
                            color: #333;
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
                
                <div class="order-items" style="padding: 15px;">
                    @foreach($order->items as $item)
                        <div class="item-row" style="display: flex; align-items: center; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #f5f5f5;">
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
                            <div style="flex-grow: 1;">
                                <p style="font-weight: bold; margin: 0;">{{ $item->product->name }}</p>
                                <p style="margin: 5px 0 0;">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p style="font-weight: bold; margin: 0;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="order-footer" style="padding: 15px; background-color: #f9f9f9; border-top: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <p>Subtotal:</p>
                        <p>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</p>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <p>Biaya Pengiriman:</p>
                        <p>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-weight: bold;">
                        <p>Total:</p>
                        <p>Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                    
                    <a href="{{ route('pesanan.show', $order->id) }}" class="detail-btn" style="
                        display: inline-block;
                        background-color: #2c2c7b;
                        color: white;
                        padding: 10px 15px;
                        border-radius: 5px;
                        text-decoration: none;
                        margin-top: 10px;
                        text-align: center;
                    ">Lihat Detail</a>
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-state" style="text-align: center; padding: 50px 0;">
            <img src="{{ asset('assets/empty-order.png') }}" alt="Tidak ada pesanan" style="max-width: 150px; margin-bottom: 20px;">
            <h3>Belum Ada Pesanan</h3>
            <p>Anda belum memiliki pesanan. Silahkan pesan makanan terlebih dahulu.</p>
            <a href="{{ route('dashboard') }}" class="btn" style="
                display: inline-block;
                background-color: #2c2c7b;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
                margin-top: 15px;
            ">Pesan Sekarang</a>
        </div>
    @endif
</div>

<!-- Rest of your HTML remains the same -->
</body>
</html>