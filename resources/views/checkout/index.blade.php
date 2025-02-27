<!DOCTYPE html>
<html lang="id">

<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Catering Kita</title>
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

        .checkout-title {
            font-size: 24px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .order-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            position: relative;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .item-price {
            color: #666;
            font-size: 14px;
        }

        .item-quantity {
            color: #666;
            font-size: 14px;
        }

        .remove-item {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #e74c3c;
            cursor: pointer;
            font-size: 20px;
        }

        .shipping-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            color: #2c3e50;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .order-summary {
            margin-top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #666;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #eee;
            font-weight: bold;
            color: #2c3e50;
        }

        .checkout-button {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #4e73f8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

        .checkout-button:hover {
            background-color: #3558d6;
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
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <div class="text-navbar">
                <p>CATERING</p>
                <p>KITA</p>
            </div>
        </div>

        <div class="profile">
            <img src="{{ asset('assets/profil.png') }}" alt="Profile">
        </div>
    </nav>
    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <div class="breadcrumb-title">Paket Nasi Box</div>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> » Paket Nasi Box
            </div>
        </div>
    </div>

    <div class="container">
        <a href="/keranjang" class="back-button">← Kembali Ke Menu</a>
        <h1 class="checkout-title">Checkout</h1>

        <div class="order-section">
            <h2 class="section-title">Pesanan Anda</h2>
            <div id="checkout-items"></div>
        </div>

        <div class="order-section">
            <h2 class="section-title">Informasi Pengiriman</h2>
            <form class="shipping-form" id="shipping-form">
                <div class="form-group">
                    <label>Tanggal Pengiriman</label>
                    <input type="date" id="delivery-date" required>
                </div>
                <div class="form-group">
                    <label>Waktu Pengiriman</label>
                    <input type="time" id="delivery-time" required>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea id="address" required></textarea>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="tel" id="phone" required>
                </div>
                <div class="form-group">
                    <label>Catatan Tambahan</label>
                    <textarea id="notes"></textarea>
                </div>

                <div class="order-summary">
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span id="subtotal">Rp 0</span>
                    </div>
                    <div class="summary-item">
                        <span>Biaya Pengiriman</span>
                        <span>Rp 20.000</span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span id="total">Rp 0</span>
                    </div>
                </div>

                <button type="submit" class="checkout-button">Lanjutkan Ke Pembayaran</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get cart items from localStorage
            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

            // Function to format price in Rupiah
            function formatPrice(price) {
                return "Rp " + price.toLocaleString('id-ID');
            }

            // Function to render checkout items
            function renderCheckoutItems() {
                const checkoutContainer = document.getElementById('checkout-items');
                checkoutContainer.innerHTML = '';

                cartItems.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'order-item';
                    itemElement.innerHTML = `
                        <img src="${item.image}" alt="${item.name}" class="item-image">
                        <div class="item-details">
                            <div class="item-name">${item.name}</div>
                            <div class="item-price">${formatPrice(item.price)} x ${item.quantity}</div>
                        </div>
                        <button class="remove-item" onclick="removeItem(${item.id})">×</button>
                    `;
                    checkoutContainer.appendChild(itemElement);
                });

                updateTotals();
            }

            // Function to update totals
            function updateTotals() {
                const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                const shipping = 20000; // Fixed shipping cost
                const total = subtotal + shipping;

                document.getElementById('subtotal').textContent = formatPrice(subtotal);
                document.getElementById('total').textContent = formatPrice(total);
            }

            // Function to remove item
            window.removeItem = function(itemId) {
                const index = cartItems.findIndex(item => item.id === itemId);
                if (index !== -1) {
                    cartItems.splice(index, 1);
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    renderCheckoutItems();
                }
            }

            // Handle form submission
            document.getElementById('shipping-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const orderData = {
                    items: cartItems,
                    deliveryDate: document.getElementById('delivery-date').value,
                    deliveryTime: document.getElementById('delivery-time').value,
                    address: document.getElementById('address').value,
                    phone: document.getElementById('phone').value,
                    notes: document.getElementById('notes').value,
                    subtotal: cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0),
                    shipping: 20000,
                    total: cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0) +
                        20000
                };

                // Here you would typically send the order data to your backend
                console.log('Order Data:', orderData);

                // Clear cart and redirect to payment page
                localStorage.removeItem('cartItems');
                alert('Redirecting to payment page...');
                // window.location.href = 'payment.html';
            });

            // Initial render
            renderCheckoutItems();
        });
    </script>
</body>

</html>
