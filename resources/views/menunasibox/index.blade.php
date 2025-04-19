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
        background-color: #f5f5f5;
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

    .navbar .nav-links li a {
        color: #fff;
        font-size: 16px;
        font-weight: bold;
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
        opacity: 0; /* Hide by default */
        transform: scale(0); /* Start scaled down */
        transition: all 0.3s ease;
    }

    /* Only show the notification badge when cart has items */
    .cart-icon[data-count]:not([data-count=""]):not([data-count="0"])::after {
        opacity: 1;
        transform: scale(1);
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

    /* Updated Menu Section Styles */
    .menu-section {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .section-title {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    /* Updated Menu Grid Styles */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        justify-content: center;
    }

    .menu-item {
        background: #F8F8FB;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .menu-item:hover {
        transform: translateY(-5px);
    }

    .menu-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .menu-item-content {
        padding: 20px;
    }

    .menu-item-title {
        font-size: 18px;
        font-weight: bold;
        margin: 0 0 10px 0;
        color: #333;
    }

    .menu-item-title-p {
        font-size: 10px;
        font-weight: bold;
        margin: 0 0 10px 0;
        color: #333;
    }

    .menu-item-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .menu-item-price {
        color: #2c2c77;
        font-weight: bold;
        font-size: 16px;
        margin: 0;
    }

    .counter {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .counter button {
        background: #2c2c77;
        color: white;
        border: none;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
    }

    .counter .count {
        font-weight: bold;
    }

    .menu-item-button {
        display: block;
        width: 100%;
        padding: 10px 0;
        background-color: #2c2c77;
        color: white;
        text-align: center;
        border-radius: 25px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .menu-item-button:hover {
        background-color: #1a1a5c;
    }
</style>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                <div class="text-navbar">
                    <p>CATERING</p>
                    <p>KITA</p>
                </div>
            </div>

            <form class="search-bar">
                <input type="text" placeholder="Search products...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>

            <ul class="nav-links">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('about.index') }}">About</a></li>
                <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
                <li><a href="{{ route('contact.index') }}">Contact</a></li>
            </ul>

            <div class="cart-icon">
                <img src="{{ asset('assets/keranjang.png') }}" alt="cart-icon">
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

        <div class="menu-section">
            <h2 class="section-title">Paket Nasi Box</h2>
            <div class="menu-grid">
                <!-- Item 1 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/paketassets1.png') }}" alt="Paket Nasi Box Premium A">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium A</h3>
                        <p class="menu-item-title-p">Nasi putih, Ayam Goreng, Capcay, Mie Goreng, Telur Balado</p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 35.000</p>
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
                    <img src="{{ asset('assets/paketassets3.png') }}" alt="Paket Nasi Box Premium B">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium B</h3>
                        <p class="menu-item-title-p">Nasi putih, telur, perkedel, Mie Goreng, sayur bas jagung</p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 35.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="#" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/paketassets2.png') }}" alt="Paket Nasi Box Premium C">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium C</h3>
                        <p class="menu-item-title-p">Nasi putih, Ayam Goreng, Capcay, Mie Goreng, Telur Balado</p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 35.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="#" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/paketassets4.png') }}" alt="Paket Nasi Box Premium D">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium D</h3>
                        <p class="menu-item-title-p">Nasi putih, udang goreng, Capcay, kentang, daging,sambal </p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 35.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="#" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/paketassets1.png') }}" alt="Paket Nasi Box Premium E">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium E</h3>
                        <p class="menu-item-title-p">Nasi putih, Ayam Goreng, Capcay, Mie Goreng, Telur Balado</p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 35.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="#" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="menu-item">
                    <img src="{{ asset('assets/paketassets5.png') }}" alt="Paket Nasi Box Premium F">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium F</h3>
                        <p class="menu-item-title-p">Nasi putih, Ayam kecap, telur, Mie Goreng, Tempe orak arik,sambal
                        </p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 35.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <span class="count">0</span>
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="#" class="menu-item-button">Tambah Ke Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
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

        // Add this script at the bottom of your page, before the closing </body> tag
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update cart icon counter
            function updateCartCounter() {
                const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                const cartIcon = document.querySelector('.cart-icon');
                const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);

                if (totalItems > 0) {
                    cartIcon.setAttribute('data-count', totalItems.toString());
                } else {
                    cartIcon.removeAttribute('data-count');
                }
            }

            // Initial counter update
            updateCartCounter();

            document.querySelectorAll(".menu-item").forEach(item => {
                let count = 0;
                const countSpan = item.querySelector(".count");
                const minusButton = item.querySelector(".minus");
                const plusButton = item.querySelector(".plus");
                const addToCartButton = item.querySelector(".menu-item-button");

                // Get menu item details
                const menuItemName = item.querySelector(".menu-item-title").textContent;
                const menuItemPrice = parseInt(item.querySelector(".menu-item-price").textContent.replace(
                    "Rp ", "").replace(".", ""));
                const menuItemImage = item.querySelector("img").getAttribute("src");

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

                addToCartButton.addEventListener("click", (e) => {
                    e.preventDefault();
                    if (count > 0) {
                        // Get existing cart items from localStorage
                        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                        // Check if item already exists in cart
                        const existingItemIndex = cartItems.findIndex(item => item.name ===
                            menuItemName);

                        if (existingItemIndex !== -1) {
                            // Update quantity if item exists
                            cartItems[existingItemIndex].quantity += count;
                        } else {
                            // Add new item if it doesn't exist
                            cartItems.push({
                                id: cartItems.length + 1,
                                name: menuItemName,
                                price: menuItemPrice,
                                image: menuItemImage,
                                quantity: count
                            });
                        }

                        // Save updated cart to localStorage
                        localStorage.setItem('cartItems', JSON.stringify(cartItems));

                        // Update cart counter
                        updateCartCounter();

                        // Reset counter
                        count = 0;
                        countSpan.textContent = count;

                        // Show success message
                        alert('Item berhasil ditambahkan ke keranjang!');
                    } else {
                        alert('Silakan pilih jumlah item terlebih dahulu!');
                    }
                });
            });

            // Make cart icon clickable
            document.querySelector('.cart-icon').addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = '/keranjang';
            });
        });
    </script>
</body>

</html>
