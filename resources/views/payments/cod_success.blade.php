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
        
        /* Payment info */
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
        
        /* Shipping info */
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
        .home-button {
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
        
        .home-button:hover {
            background-color: rgb(63, 75, 154);
        }
        
        /* Price formatting */
        .price {
            font-weight: 600;
            color: #333;
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
                <span>COD (Cash On Delivery)</span>
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
        function generateOrderId() {
            const timestamp = new Date().getTime();
            const random = Math.floor(Math.random() * 1000);
            return `ORD${timestamp}${random}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Get data from localStorage
                const orderData = JSON.parse(localStorage.getItem('currentOrder')) || {};
                const shippingData = JSON.parse(localStorage.getItem('shippingData')) || {};
                const orderTotal = localStorage.getItem('orderTotal');
                
                // Display order info
                if (orderData.id) {
                    document.getElementById('orderId').textContent = orderData.id;
                } else {
                    // Generate new order ID if not exists
                    document.getElementById('orderId').textContent = generateOrderId();
                }
                
                // Display current date as order date
                document.getElementById('orderDate').textContent = new Date().toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                
                // Display payment total
                if (orderTotal) {
                    document.getElementById('totalPayment').textContent = `Rp ${parseInt(orderTotal).toLocaleString('id-ID')}`;
                }

                // Display shipping info
                if (shippingData) {
                    document.getElementById('deliveryDate').textContent = shippingData.deliveryDate || '-';
                    document.getElementById('deliveryTime').textContent = shippingData.deliveryTime || '-';
                    document.getElementById('deliveryAddress').textContent = shippingData.address || '-';
                }

                // Clear localStorage after displaying
                setTimeout(() => {
                    localStorage.removeItem('currentOrder');
                    localStorage.removeItem('shippingData');
                    localStorage.removeItem('orderTotal');
                    localStorage.removeItem('cartItems');
                    localStorage.removeItem('selectedPaymentMethod');
                }, 1000);

            } catch (error) {
                console.error('Error displaying order data:', error);
                // Set default values if there's an error
                document.getElementById('deliveryDate').textContent = '-';
                document.getElementById('deliveryTime').textContent = '-';
                document.getElementById('deliveryAddress').textContent = '-';
            }
        });
    </script>
</body>
</html>