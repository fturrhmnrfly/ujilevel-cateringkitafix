<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        
        .container {
            max-width: 480px;
            margin: 0 auto;
            background-color: white;
            min-height: calc(100vh - 48px);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px auto;
        }
        
        .success-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .success-subtitle {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }
        
        .order-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .payment-info {
            margin-top: 16px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #eee;
        }
        
        .detail-title {
            font-weight: bold;
            margin: 16px 0 8px 0;
        }
        
        .item-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .shipping-info-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin: 16px 0;
        }
        
        .shipping-title {
            font-weight: bold;
            margin-bottom: 12px;
        }
        
        .shipping-detail {
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .home-button {
            background-color: #2c2c77;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            margin-top: auto;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
            display: block;
            text-align: center;
        }
        
        .price {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        Catering Kita
    </div>
    
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
        
        <a href="{{ route('dashboard') }}" class="home-button">Kembali ke Home</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get order data from localStorage
            const orderData = JSON.parse(localStorage.getItem('currentOrder'));
            const shippingData = JSON.parse(localStorage.getItem('shippingData'));
            
            if (orderData) {
                document.getElementById('orderId').textContent = orderData.id;
                document.getElementById('orderDate').textContent = new Date().toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                document.getElementById('totalPayment').textContent = `Rp ${parseInt(localStorage.getItem('orderTotal')).toLocaleString('id-ID')}`;
            }

            if (shippingData) {
                document.getElementById('deliveryDate').textContent = shippingData.deliveryDate;
                document.getElementById('deliveryTime').textContent = shippingData.deliveryTime;
                document.getElementById('deliveryAddress').textContent = shippingData.address;
            }

            // Clear localStorage after displaying
            localStorage.removeItem('currentOrder');
            localStorage.removeItem('shippingData');
            localStorage.removeItem('orderTotal');
            localStorage.removeItem('cartItems');
        });
    </script>
</body>
</html>