<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    /* Navbar Styles */
    nav.navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #2c2c77;
        /* Warna biru navbar */
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
        /* Ukuran logo */
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
        /* Warna hover */
    }

    .cart-icon {
        position: relative;
        font-size: 24px;
        color: #ffffff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .cart-icon:hover {
        transform: scale(1.1);
    }

    .cart-icon::after {
        content: attr(data-count);
        position: absolute;
        top: -5px;
        right: -5px;
        background: red;
        color: white;
        font-size: 12px;
        font-weight: bold;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 1px 1px 6px rgba(0, 0, 0, 0.2);
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
        text-decoration: none;
    }

    .menu-section {
        padding: 40px;
        background-color: #fff;
    }

    .section-title {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    /* Updated menu section and grid styles */
    .menu-section {
        padding: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        justify-content: center;
        padding: 20px;
    }

    .menu-item {
        background: #F8F8FB;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        padding: 15px;
        margin: 0 auto;
        width: 280px;
    }

    .menu-item-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px
    }

    .menu-item-price {
        color: #2c2c77;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .menu-item-button {
        display: inline-block;
        padding: 8px 20px;
        background-color: #2c2c77;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .menu-item-button:hover {
        background-color: #1a1a5c;
    }

    .menu-item-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .menu-item img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        display: block;
        margin: 0 auto;
    }
</style>

<body>
    <header>
        <nav class="navbar">
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                <div class="text-navbar">
                    <p>CATERING</p>
                    <p>KITA</p>
                </div>
            </div>

            <!-- Search Bar -->
            <form class="search-bar">
                <input type="text" placeholder="Search products...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>

            <!-- Navigation Links -->
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('catering.index') }}">Catering</a></li>
                <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
                <li><a href="{{ route('contact.index') }}">Contact</a></li>
            </ul>

            <!-- Profile Section -->
            <div class="cart-icon">
                <img src="{{ asset('assets/keranjang.png') }}" alt="cart-icon">
            </div>
        </nav>
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <div class="breadcrumb-title">Catering</div>
                <div class="breadcrumb-nav">
                    <a href="{{ route('home') }}">Home</a> » Catering
                </div>
            </div>
        </div>

        <!-- Prasmanan Section -->
        <div class="menu-section">
            <h2 class="section-title">Prasmanan</h2>
            <div class="menu-grid">
                <!-- Item 1 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/homeassets3.jpg') }}" alt="Ayam Geprek">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Geprek</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 12.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/homeassets6.jpg') }}" alt="Ayam Kecap">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Kecap</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 9.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/ikanbunjaergulai.png') }}" alt="Ikan Goreng">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ikan Bunjer Gulai</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 10.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/cumibalado.png') }}" alt="Cumi Balado">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Cumi Balado</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 15.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/homeassets5.jpg') }}" alt="Ikan Goreng">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ikan Goreng</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 20.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/kentangbalado.png') }}" alt="Kentang Balado">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Kentang Balado</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 8.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 7 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/tempeorek.png') }}" alt="Tempe Orek">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Tempe Orek</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 5.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 8 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/ayamgoreng.png') }}" alt="Ayam Goreng">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Goreng</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 8.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 9 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/homeassets4.jpg') }}" alt="Telur Balado">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Telur Balado</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 6.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="/keranjang" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.querySelectorAll(".menu-item").forEach(item => {
            let count = 0;
            const countSpan = item.querySelector(".count");
            const minusButton = item.querySelector(".minus");
            const plusButton = item.querySelector(".plus");

            minusButton.addEventListener("click", () => {
                if (count > 0) {
                    count--;
                    countSpan.textContent = count;
                }
            });

            plusButton.addEventListener("click", () => {
                count++;
                countSpan.textContent = count;
            });
        });

        // Cart Management System
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all menu items
            document.querySelectorAll('.menu-item').forEach(menuItem => {
                const itemId = menuItem.dataset.id;
                const countElement = menuItem.querySelector('.count');
                const minusButton = menuItem.querySelector('.minus');
                const plusButton = menuItem.querySelector('.plus');
                const addToCartButton = menuItem.querySelector('.menu-item-button');
                const itemName = menuItem.querySelector('.menu-item-title').textContent;
                const itemPrice = parseInt(menuItem.querySelector('.menu-item-price').textContent);

                // Handle minus button click
                minusButton.addEventListener('click', () => {
                    let count = parseInt(countElement.textContent);
                    if (count > 0) {
                        count--;
                        countElement.textContent = count;
                    }
                });

                // Handle plus button click
                plusButton.addEventListener('click', () => {
                    let count = parseInt(countElement.textContent);
                    count++;
                    countElement.textContent = count;
                });

                // Handle add to cart button click
                addToCartButton.addEventListener('click', () => {
                    const quantity = parseInt(countElement.textContent);
                    if (quantity > 0) {
                        addToCart(itemId, itemName, itemPrice, quantity);
                        window.location.href = '/keranjang';
                    }
                });
            });
        });

        function addToCart(itemId, name, price, quantity) {
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

            // Check if item already exists in cart
            const existingItemIndex = cart.findIndex(item => item.id === itemId);

            if (existingItemIndex !== -1) {
                // Update existing item
                cart[existingItemIndex].quantity += quantity;
                cart[existingItemIndex].total = cart[existingItemIndex].quantity * price;
            } else {
                // Add new item
                cart.push({
                    id: itemId,
                    name: name,
                    price: price,
                    quantity: quantity,
                    total: price * quantity
                });
            }

            sessionStorage.setItem('cart', JSON.stringify(cart));
        }

        // Initialize cart page if we're on the cart page
        if (window.location.pathname === '/keranjang') {
            initializeCartPage();
        }

        function initializeCartPage() {
            const cartContainer = document.getElementById('cartItems');
            const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            let subtotal = 0;
            const deliveryFee = 10000;

            cartContainer.innerHTML = '';

            cart.forEach(item => {
                subtotal += item.total;

                const cartItemElement = document.createElement('div');
                cartItemElement.className = 'cart-item';
                cartItemElement.innerHTML = `
                    <img src="/assets/paketassets${item.id}.png" alt="${item.name}">
                    <div class="cart-item-details">
                        <div class="cart-item-title">${item.name}</div>
                        <div class="cart-item-price">Rp ${item.price.toLocaleString()}</div>
                        <div class="cart-item-quantity">
                            Jumlah: 
                            <button onclick="updateCartQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="updateCartQuantity(${item.id}, ${item.quantity + 1})">+</button>
                        </div>
                    </div>
                    <button class="remove-item" onclick="removeCartItem(${item.id})">×</button>
                `;

                cartContainer.appendChild(cartItemElement);
            });

            // Update summary
            const total = subtotal + deliveryFee;
            document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString()}`;
            document.getElementById('total').textContent = `Rp ${total.toLocaleString()}`;
        }

        function updateCartQuantity(itemId, newQuantity) {
            if (newQuantity < 1) return;

            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            const item = cart.find(item => item.id === itemId);

            if (item) {
                item.quantity = newQuantity;
                item.total = item.price * newQuantity;
                sessionStorage.setItem('cart', JSON.stringify(cart));
                initializeCartPage();
            }
        }

        function removeCartItem(itemId) {
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            cart = cart.filter(item => item.id !== itemId);
            sessionStorage.setItem('cart', JSON.stringify(cart));
            initializeCartPage();
        }
        </script>
</body>

</html>
