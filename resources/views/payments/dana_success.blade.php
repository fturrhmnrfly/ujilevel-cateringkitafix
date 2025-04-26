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
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 24px;
            margin-top: 24px;
        }
        
        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #48bb78;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .success-title {
            color: #2c2c77;
            text-align: center;
            font-size: 24px;
            margin-bottom: 12px;
        }
        
        .success-subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 24px;
        }
        
        .payment-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
        }
        
        .order-details {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        
        .order-details:last-child {
            border-bottom: none;
        }
        
        .shipping-info-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }
        
        .shipping-title {
            color: #2c2c77;
            margin-bottom: 16px;
            font-size: 18px;
        }
        
        .shipping-detail {
            margin-bottom: 12px;
        }
        
        .shipping-detail strong {
            display: block;
            color: #444;
            margin-bottom: 4px;
        }
        
        .home-button {
            display: block;
            background-color: #2c2c77;
            color: white;
            text-align: center;
            padding: 12px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 24px;
            font-weight: 500;
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
                <span>Dana</span>
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
            localStorage.removeItem('cartItems');
            localStorage.removeItem('currentOrder');
            localStorage.removeItem('orderTotal');
            localStorage.removeItem('selectedPaymentMethod');
            localStorage.removeItem('shippingData');
        });
    </script>
</body>
</html>