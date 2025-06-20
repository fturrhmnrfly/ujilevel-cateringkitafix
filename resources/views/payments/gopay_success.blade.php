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
        
        .shipping-detail:last-child {
            margin-bottom: 0;
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
                <span>Gopay</span>
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
        
        <a href="{{ route('pesanan.index') }}" class="order-button">Lihat Pesanan</a>
    </div>

    <script>
        function generateOrderId() {
            const timestamp = new Date().getTime();
            const random = Math.floor(Math.random() * 1000);
            return `ORD${timestamp}${random}`;
        }

        function formatDate(dateString) {
            if (!dateString) return '-';
            try {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            } catch (e) {
                return dateString;
            }
        }

        function formatTime(timeString) {
            if (!timeString) return '-';
            try {
                // Jika format sudah HH:MM, langsung return
                if (timeString.match(/^\d{2}:\d{2}$/)) {
                    return timeString;
                }
                // Jika format datetime, extract time
                const date = new Date(timeString);
                return date.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            } catch (e) {
                return timeString;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('=== GOPAY SUCCESS PAGE DEBUG ===');
            
            try {
                // Ambil data dari localStorage dengan prioritas yang benar
                const orderData = JSON.parse(localStorage.getItem('currentOrder')) || {};
                const shippingData = JSON.parse(localStorage.getItem('shippingData')) || {};
                const orderTotal = localStorage.getItem('orderTotal');
                
                console.log('Order Data:', orderData);
                console.log('Shipping Data:', shippingData);
                console.log('Order Total:', orderTotal);
                
                // Display order info
                document.getElementById('orderId').textContent = orderData.id || generateOrderId();
                
                // Format tanggal pemesanan
                const orderDate = orderData.date || new Date().toISOString();
                document.getElementById('orderDate').textContent = formatDate(orderDate);
                
                // Display payment total
                if (orderTotal) {
                    document.getElementById('totalPayment').textContent = `Rp ${parseInt(orderTotal).toLocaleString('id-ID')}`;
                } else if (orderData.total) {
                    document.getElementById('totalPayment').textContent = `Rp ${parseInt(orderData.total).toLocaleString('id-ID')}`;
                } else {
                    document.getElementById('totalPayment').textContent = 'Rp 0';
                }

                // Display shipping info dengan prioritas data
                // Prioritas: orderData > shippingData > fallback
                const deliveryDate = orderData.deliveryDate || shippingData.deliveryDate || '-';
                const deliveryTime = orderData.deliveryTime || shippingData.deliveryTime || '-';
                const deliveryAddress = orderData.address || shippingData.address || '-';
                
                console.log('Final Delivery Data:', {
                    deliveryDate,
                    deliveryTime,
                    deliveryAddress
                });
                
                document.getElementById('deliveryDate').textContent = formatDate(deliveryDate);
                document.getElementById('deliveryTime').textContent = formatTime(deliveryTime);
                document.getElementById('deliveryAddress').textContent = deliveryAddress;

                // Clear localStorage setelah 2 detik untuk memastikan data sudah tampil
                setTimeout(() => {
                    localStorage.removeItem('currentOrder');
                    localStorage.removeItem('orderTotal');
                    localStorage.removeItem('cartItems');
                    localStorage.removeItem('selectedPaymentMethod');
                    localStorage.removeItem('shippingData');
                    console.log('LocalStorage cleared');
                }, 2000);

            } catch (error) {
                console.error('Error displaying order data:', error);
                // Set default values if there's an error
                document.getElementById('orderId').textContent = generateOrderId();
                document.getElementById('orderDate').textContent = formatDate(new Date().toISOString());
                document.getElementById('totalPayment').textContent = 'Rp 0';
                document.getElementById('deliveryDate').textContent = '-';
                document.getElementById('deliveryTime').textContent = '-';
                document.getElementById('deliveryAddress').textContent = '-';
            }
        });
    </script>
</body>
</html>