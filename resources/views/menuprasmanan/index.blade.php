<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu Prasmanan</title>
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
        display
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

    /* Update style untuk menu-item dan gambar */
    .menu-item {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%; /* Tambahkan height 100% */
    }

    .menu-item img {
        width: 100%;
        height: 250px; /* Sesuaikan tinggi gambar */
        object-fit: contain; /* Ubah dari cover ke contain */
        padding: 10px; /* Tambahkan padding */
        background: #f8f8f8; /* Tambahkan background color */
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px; /* Tambah gap */
        padding: 20px;
    }

    .menu-item-content {
        padding: 20px; /* Tambah padding */
        display: flex;
        flex-direction: column;
        gap: 15px; /* Sesuaikan gap */
        flex: 1;
    }

    .menu-item-title {
        font-size: 16px;
        font-weight: bold;
        margin: 0;
        color: #333;
    }

    .menu-item-details {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .menu-item-price {
        font-size: 14px;
        font-weight: bold;
        color: #2c2c77;
    }

    .counter {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .counter input {
        width: 30px;
        height: 25px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .counter button {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        border: none;
        background: #2c2c77;
        color: white;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .menu-item-button {
        width: 100%;
        padding: 8px 0;
        background-color: #2c2c77;
        color: white;
        text-align: center;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        margin-top: 10px;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .menu-item-button:hover {
        background-color: #1a1a5c;
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
                <div class="menu-item" data-id="1">
                    <img src="{{ asset('assets/homeassets3.jpg') }}" alt="Ayam Geprek">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Geprek</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 12.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 1) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>
                

                <!-- Item 2 -->
                <div class="menu-item" data-id="2">
                    <img src="{{ asset('assets/homeassets6.jpg') }}" alt="Ayam Kecap">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Kecap</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 9.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 2) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="menu-item" data-id="3">
                    <img src="{{ asset('assets/ikanbunjaergulai.png') }}" alt="Ikan Goreng">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ikan Bunjer Gulai</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 10.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 3) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="menu-item" data-id="4">
                    <img src="{{ asset('assets/cumibalado.png') }}" alt="Cumi Balado">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Cumi Balado</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 15.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 4) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="menu-item" data-id="5">
                    <img src="{{ asset('assets/homeassets5.jpg') }}" alt="Ikan Goreng">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ikan Goreng</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 20.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 5) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="menu-item" data-id="6">
                    <img src="{{ asset('assets/kentangbalado.png') }}" alt="Kentang Balado">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Kentang Balado</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 8.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 6) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>

                <!-- Item 7 -->
                <div class="menu-item" data-id="7">
                    <img src="{{ asset('assets/tempeorek.png') }}" alt="Tempe Orek">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Tempe Orek</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 5.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 7) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>

                <!-- Item 8 -->
                <div class="menu-item" data-id="8">
                    <img src="{{ asset('assets/ayamgoreng.png') }}" alt="Ayam Goreng">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Ayam Goreng</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 8.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 8) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>

                <!-- Item 9 -->
                <div class="menu-item" data-id="9">
                    <img src="{{ asset('assets/homeassets4.jpg') }}" alt="Telur Balado">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Telur Balado</h3>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp 6.000</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menuprasmanan.show', 9) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const cartIcon = document.querySelector('.cart-icon');
    let cartUpdateTimeout;

    // Fungsi untuk update counter dengan debouncing
    function updateCartCounter() {
        clearTimeout(cartUpdateTimeout);
        cartUpdateTimeout = setTimeout(() => {
            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
            
            if (totalItems > 0) {
                cartIcon.setAttribute('data-count', totalItems);
            } else {
                cartIcon.removeAttribute('data-count');
            }
        }, 100); // Delay 100ms untuk debouncing
    }

    // Handle menu item interactions
    document.querySelectorAll('.menu-item').forEach(item => {
        const countInput = item.querySelector('.count');
        const minusButton = item.querySelector('.minus');
        const plusButton = item.querySelector('.plus');
        const menuId = item.dataset.id;

        // Set initial value
        countInput.value = localStorage.getItem(`menu_${menuId}_quantity`) || 0;

        // Minus button click
        minusButton.addEventListener('click', () => {
            let value = parseInt(countInput.value) || 0;
            if (value > 0) {
                value -= 1;
                countInput.value = value;
                localStorage.setItem(`menu_${menuId}_quantity`, value);
                updateCartCounter();
            }
        });

        // Plus button click
        plusButton.addEventListener('click', () => {
            let value = parseInt(countInput.value) || 0;
            value += 1;
            countInput.value = value;
            localStorage.setItem(`menu_${menuId}_quantity`, value);
            updateCartCounter();
        });

        // Manual input
        countInput.addEventListener('input', function() {
            let value = parseInt(this.value) || 0;
            if (value < 0) value = 0;
            this.value = value;
            localStorage.setItem(`menu_${menuId}_quantity`, value);
            updateCartCounter();
        });

        // Detail menu link click
        const detailLink = item.querySelector('.menu-item-button');
        detailLink.addEventListener('click', function(e) {
            const quantity = parseInt(countInput.value) || 0;
            localStorage.setItem(`menu_${menuId}_quantity`, quantity);
        });
    });

    // Listen for storage changes from other tabs/windows
    window.addEventListener('storage', (e) => {
        if (e.key === 'cartItems') {
            updateCartCounter();
        }
    });

    // Initial counter update
    updateCartCounter();

    // Cart icon click handler
    cartIcon.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = '{{ route("keranjang.index") }}';
    });
});
</script>

</html>
