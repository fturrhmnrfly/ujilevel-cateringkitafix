<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran Berhasil - Catering Kita</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .header {
            background-color: #2c2c77;
            color: white;
            padding: 12px 20px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
        
        /* Container utama */
        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: white;
            min-height: auto;
            padding: 15px;
            display: flex;
            flex-direction: column;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        /* Informasi order detail */
        .payment-info {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }
        
        .order-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
            color: #333;
        }
        
        /* Detail pesanan section */
        .order-items {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .item-details {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        
        .item-name {
            color: #333;
            font-size: 14px;
        }
        
        .item-quantity {
            color: #666;
            font-size: 14px;
        }
        
        .item-price {
            font-weight: 500;
            color: #333;
        }
        
        /* Informasi pengiriman */
        .shipping-info-box {
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px; 
            margin: 15px 0;
        }
        
        .shipping-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
        }
        
        .shipping-detail {
            margin-bottom: 16px;
        }
        
        .shipping-detail strong {
            display: block;
            font-weight: 500;
            color: #666;
            margin-bottom: 4px;
        }
        
        .shipping-detail div {
            color: #333;
            font-size: 14px;
        }
        
        /* Button styles */
        .order-button {
            background-color: rgb(79, 94, 193);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .order-button:hover {
            background-color: rgb(63, 75, 154);
        }
        
        /* Success icon */
        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
        }
        
        /* Text styles */
        .success-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        
        .success-subtitle {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        
        /* Price formatting */
        .price {
            font-weight: 600;
            color: #333;
        }

        /* Add navbar styles */
        .simple-navbar {
            background-color: #2c2c77;
            padding: 12px 20px;
            display: flex;
            align-items: center;
        }

        .simple-navbar img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .brand-text {
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .brand-catering {
            color: #FFA500;
        }

        .brand-kita {
            color: white;
        }
    </style>
</head>
<body>
    <nav class="simple-navbar">
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <div class="brand-text">
                <span class="brand-catering">CATERING</span>
                <span class="brand-kita">KITA</span>
            </div>
        </a>
    </nav>

    <div class="container">
        <div class="success-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>
        
        <h1 class="success-title">Pembayaran Berhasil!!!</h1>
        <p class="success-subtitle">Terima kasih telah memesan. Pesanan Anda sedang diproses.</p>
        
        <div class="payment-info">
            <div class="order-details">
                <span>Order ID</span>
                <span id="orderId"></span>
            </div>
            <div class="order-details">
                <span>Tanggal Pemesanan</span>
                <span id="orderDate"></span>
            </div>
            <div class="order-details">
                <span>Total Pembayaran</span>
                <span class="price" id="totalPayment"></span>
            </div>
            <div class="order-details">
                <span>Metode Pembayaran</span>
                <span>Bank Central Asia (BCA)</span>
            </div>
        </div>
        
        <div class="shipping-info-box">
            <h3 class="shipping-title">Informasi Pengiriman</h3>
            
            <div class="shipping-detail">
                <strong>Tanggal Pengiriman</strong>
                <div id="deliveryDate"></div>
            </div>
            
            <div class="shipping-detail">
                <strong>Waktu Pengiriman</strong>
                <div id="deliveryTime"></div>
            </div>
            
            <div class="shipping-detail">
                <strong>Alamat Pengiriman</strong>
                <div id="deliveryAddress"></div>
            </div>
        </div>
        
        <a href="{{ route('pesanan.index') }}" class="order-button" onclick="clearOrderData()">Lihat Pesanan</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Ambil data dari localStorage
                const orderData = JSON.parse(localStorage.getItem('currentOrder')) || {};
                const orderTotal = localStorage.getItem('orderTotal');

                // Format date untuk display
                const formatDate = (dateString) => {
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    return new Date(dateString).toLocaleDateString('id-ID', options);
                };

                // Display order info
                document.getElementById('orderId').textContent = orderData.id || '-';
                document.getElementById('orderDate').textContent = formatDate(orderData.date) || '-';
                document.getElementById('totalPayment').textContent = 
                    `Rp ${parseInt(orderTotal || 0).toLocaleString('id-ID')}`;

                // Display delivery info
                document.getElementById('deliveryDate').textContent = orderData.deliveryDate || '-';
                document.getElementById('deliveryTime').textContent = orderData.deliveryTime || '-';
                document.getElementById('deliveryAddress').textContent = orderData.address || '-';

            } catch (error) {
                console.error('Error displaying order data:', error);
                // Set default values if there's an error
                document.getElementById('orderId').textContent = '-';
                document.getElementById('orderDate').textContent = '-';
                document.getElementById('totalPayment').textContent = '-';
                document.getElementById('deliveryDate').textContent = '-';
                document.getElementById('deliveryTime').textContent = '-';
                document.getElementById('deliveryAddress').textContent = '-';
            }
        });
        
        function clearOrderData() {
            localStorage.removeItem('currentOrder');
            localStorage.removeItem('orderTotal');
            localStorage.removeItem('cartItems');
            localStorage.removeItem('selectedPaymentMethod');
        }
    </script>
</body>
</html>