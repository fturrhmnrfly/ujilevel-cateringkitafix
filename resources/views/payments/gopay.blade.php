<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran - Catering Kita</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .back-button {
            text-decoration: none;
            color: #333;
            display: inline-block;
            margin-bottom: 20px;
        }

        nav.navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c2c77;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        /* Breadcrumb Styles */
        .breadcrumb-container {
            background-color: #f3f4f6;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .breadcrumb {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .breadcrumb-title {
            font-size: 1.25rem;
            color: #374151;
        }

        .breadcrumb-nav {
            color: #6b7280;
        }

        .breadcrumb-nav a {
            color: #6b7280;
        }

        /* Payment Page Styles */
        .payment-container {
            background: white;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .payment-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .payment-header i {
            margin-right: 10px;
            font-size: 20px;
        }

        .payment-title {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .payment-info {
            margin-bottom: 20px;
        }

        .total-section {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .confirmation-form {
            margin-top: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2c3e50;
        }

        .payment-account-info {
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            margin-bottom: 15px;
        }

        .account-name {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .account-number-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 10px 15px;
        }

        .account-number {
            font-size: 16px;
            color: #4a5568;
            letter-spacing: 0.05em;
        }

        .copy-btn {
            background: #4e73f8;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }

        .copy-btn:hover {
            background: #3558d6;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .file-upload {
            display: block;
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #4f46e5;
        }

        .order-complete {
            text-align: center;
            padding: 30px 0;
        }

        .order-complete h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .order-details {
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: 500;
            color: #2c3e50;
        }

        .payment-success {
            background-color: #f0fff4;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: center;
        }

        .payment-success h3 {
            color: #2f855a;
            margin-bottom: 10px;
        }

        .payment-success p {
            color: #4a5568;
        }

        .detail-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .detail-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .order-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item-name {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .order-item-price {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 14px;
        }

        .shipping-info {
            margin-top: 20px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .info-value {
            color: #666;
        }

        .copy-tooltip {
            position: relative;
            display: inline-block;
        }

        .copy-tooltip .tooltip-text {
            visibility: hidden;
            width: 80px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 4px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -40px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 12px;
        }

        .copy-tooltip .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }

        .copy-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .payment-instructions {
            background-color: #f7fafc;
            border-left: 4px solid #4e73f8;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
            color: #4a5568;
        }

        .payment-instructions h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .payment-instructions ol {
            margin-left: 20px;
            line-height: 1.6;
        }

        .payment-instructions li {
            margin-bottom: 8px;
        }

        .payment-deadline {
            font-size: 14px;
            color: #e53e3e;
            margin-top: 15px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="/images/logo.png" alt="Catering Kita">
            <div class="text-navbar">
                <p>Catering</p>
                <p>Kita</p>
            </div>
        </div>
        <div class="profile">
            <img src="/images/user.jpg" alt="User">
            <span>John Doe</span>
        </div>
    </nav>

    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <div class="breadcrumb-title">Pembayaran</div>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> » <a href="{{ route('checkout') }}">Checkout</a> » Pembayaran
            </div>
        </div>
    </div>

    <div class="container">
        <a href="/checkout" class="back-button">← Kembali</a>

        <div class="payment-container">
            <h1 class="payment-title">Pembayaran</h1>

            <div class="payment-info">
                <div class="total-section">
                    <span>Total</span>
                    <span id="payment-total">Rp 925.000</span>
                </div>
            </div>

            <div class="confirmation-form">
                <h2 class="detail-title">Konfirmasi</h2>

                <div class="payment-instructions">
                    <h3>Petunjuk Pembayaran:</h3>
                    <ol>
                        <li>Transfer ke rekening bank di bawah ini sesuai dengan total pembayaran.</li>
                        <li>Gunakan ATM, Mobile Banking, atau Internet Banking untuk melakukan transfer.</li>
                        <li>Upload bukti transfer pada form di bawah ini.</li>
                        <li>Klik tombol "Buat Pesanan" untuk menyelesaikan pesanan.</li>
                    </ol>
                    <div class="payment-deadline">Harap selesaikan pembayaran dalam 24 jam.</div>
                </div>

                <div class="form-group">
                    <label>Nama Rekening</label>
                    <div class="payment-account-info">
                        <div class="account-name">PT Catering Kita Indonesia</div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nomor Rekening</label>
                    <div class="payment-account-info">
                        <div class="account-number-container">
                            <span class="account-number" id="account-number">2233 4455 6666 8855</span>
                            <div class="copy-tooltip">
                                <button class="copy-btn" onclick="copyAccountNumber()">Salin</button>
                                <span class="tooltip-text" id="copy-tooltip">Disalin!</span>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="payment-form">
                    <div class="form-group">
                        <label for="proof">Bukti Transferan</label>
                        <input type="file" id="proof" class="file-upload" required>
                    </div>

                    <button type="submit" class="btn-primary">Buat Pesanan</button>
                </form>
            </div>
        </div>

        <div class="detail-section">
            <h2 class="detail-title">Detail Pesanan</h2>
            <div id="order-items">
                <!-- Order items will be populated here -->
            </div>

            <div class="shipping-info">
                <h3 class="detail-title">Informasi Pengiriman</h3>
                <div class="info-item">
                    <div class="info-label">Tanggal Pengiriman</div>
                    <div class="info-value" id="delivery-date">20 Januari 2025</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Waktu Pengiriman</div>
                    <div class="info-value" id="delivery-time">10:00 - 11:00</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Alamat Pengiriman</div>
                    <div class="info-value" id="delivery-address">Jl. Sudirman No. 123</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get order data from sessionStorage (would be set during checkout)
            const orderData = JSON.parse(sessionStorage.getItem('orderData')) || {};
            
            // Get URL parameters to extract order ID if needed
            const urlParams = new URLSearchParams(window.location.search);
            const orderId = urlParams.get('order_id') || 'ORD123456789';
            
            // Format price in Rupiah
            function formatPrice(price) {
                return "Rp " + price.toLocaleString('id-ID');
            }
            
            // Display total from orderData or localStorage
            function displayOrderTotal() {
                let total = 0;
                
                // First try to get total from orderData
                if (orderData && orderData.total) {
                    total = orderData.total;
                } else {
                    // Otherwise try to calculate from cart items
                    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                    const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                    const shipping = 20000; // Fixed shipping cost
                    total = subtotal + shipping;
                }
                
                document.getElementById('payment-total').textContent = formatPrice(total);
            }
            
            // Display order items
            function displayOrderItems() {
                const orderItemsContainer = document.getElementById('order-items');
                orderItemsContainer.innerHTML = '';
                
                const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                
                if (cartItems.length === 0) {
                    // Default items if cart is empty (for demo)
                    orderItemsContainer.innerHTML = `
                        <div class="order-item">
                            <div class="order-item-name">Paket Nasi Kotak Premium</div>
                            <div class="order-item-price">
                                <span>25 x Rp 30,000</span>
                                <span>Rp 750,000</span>
                            </div>
                        </div>
                        <div class="order-item">
                            <div class="order-item-name">Snack Box Meetings</div>
                            <div class="order-item-price">
                                <span>10 x Rp 25,000</span>
                                <span>Rp 250,000</span>
                            </div>
                        </div>
                    `;
                } else {
                    cartItems.forEach(item => {
                        const itemElement = document.createElement('div');
                        itemElement.className = 'order-item';
                        itemElement.innerHTML = `
                            <div class="order-item-name">${item.name}</div>
                            <div class="order-item-price">
                                <span>${item.quantity} x ${formatPrice(item.price)}</span>
                                <span>${formatPrice(item.price * item.quantity)}</span>
                            </div>
                        `;
                        orderItemsContainer.appendChild(itemElement);
                    });
                }
            }
            
            // Display shipping information
            function displayShippingInfo() {
                if (orderData.deliveryDate) {
                    document.getElementById('delivery-date').textContent = new Date(orderData.deliveryDate).toLocaleDateString('id-ID', { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                }
                
                if (orderData.deliveryTime) {
                    document.getElementById('delivery-time').textContent = orderData.deliveryTime;
                }
                
                if (orderData.address) {
                    document.getElementById('delivery-address').textContent = orderData.address;
                }
            }
            
            // Handle payment form submission
            document.getElementById('payment-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const paymentData = {
                    orderId: orderId,
                    // Note: In a real app, you'd handle file upload differently
                    proofUploaded: true
                };
                
                // Here you would typically send the payment data to your backend
                console.log('Payment Data:', paymentData);
                
                // For demo purposes, show a success message
                alert('Pembayaran berhasil! Pesanan Anda sedang diproses.');
                
                // Redirect to order confirmation page
                // window.location.href = `/order-confirmation/${orderId}`;
                
                // Or alternatively, show success message in the current page
                const paymentContainer = document.querySelector('.payment-container');
                paymentContainer.innerHTML = `
                    <div class="payment-success">
                        <h3>Pembayaran Berhasil!</h3>
                        <p>Terima kasih telah melakukan pembayaran. Pesanan Anda sedang diproses.</p>
                    </div>
                    <div class="order-details">
                        <div class="detail-item">
                            <span class="detail-label">Order ID</span>
                            <span>${orderId}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Total Pembayaran</span>
                            <span>${document.getElementById('payment-total').textContent}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Metode Pembayaran</span>
                            <span>Gopay</span>
                        </div>
                    </div>
                `;
            });
            
            // Initialize page
            displayOrderTotal();
            displayOrderItems();
            displayShippingInfo();
        });

        // Function to copy account number to clipboard
        function copyAccountNumber() {
            const accountNumber = document.getElementById('account-number');
            const tooltip = document.getElementById('copy-tooltip');
            
            // Create a temporary input element
            const tempInput = document.createElement('input');
            tempInput.value = accountNumber.textContent;
            document.body.appendChild(tempInput);
            
            // Select the text
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices
            
            // Copy the text
            document.execCommand('copy');
            
            // Remove the temporary element
            document.body.removeChild(tempInput);
            
            // Show "Copied" tooltip
            tooltip.style.visibility = 'visible';
            tooltip.style.opacity = '1';
            
            // Hide tooltip after 2 seconds
            setTimeout(function() {
                tooltip.style.visibility = 'hidden';
                tooltip.style.opacity = '0';
            }, 2000);
        }
    </script>
</body>

</html>