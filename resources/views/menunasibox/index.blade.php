<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu Nasi Box</title>
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
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .cart-icon[data-count]:after {
        content: attr(data-count);
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ff0000;
        color: white;
        font-size: 12px;
        font-weight: bold;
        padding: 2px 6px;
        border-radius: 50%;
        min-width: 16px;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
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
        gap: 8px;
    }

    .counter input {
        width: 40px;
        height: 25px;
        text-align: center;
        border: 1px solid #2c2c77;
        border-radius: 4px;
        font-size: 14px;
        -moz-appearance: textfield;
        /* Firefox */
    }

    /* Hilangkan tombol panah untuk Chrome, Safari, Edge, Opera */
    .counter input::-webkit-outer-spin-button,
    .counter input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
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
        display: flex;
        align-items: center;
        justify-content: center;
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
                @foreach($menuItems as $item)
                <div class="menu-item">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_makanan }}" class="menu-image">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">{{ $item->nama_makanan }}</h3>
                        <p class="menu-item-title-p">{{ $item->deskripsi }}</p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menunasibox.show', $item->id) }}" class="menu-item-button">Detail Menu</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </header>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Handle menu items
    document.querySelectorAll(".menu-item").forEach(item => {
        const countInput = item.querySelector(".count");
        const minusButton = item.querySelector(".minus");
        const plusButton = item.querySelector(".plus");
        const detailButton = item.querySelector(".menu-item-button");
        
        // Get menu id from the product URL
        const menuId = detailButton.href.split('/').pop();
        
        // Set initial value from localStorage or default to 0
        const savedQuantity = localStorage.getItem(`menu_${menuId}_quantity`) || 0;
        countInput.value = savedQuantity;

        minusButton.addEventListener("click", () => {
            let value = parseInt(countInput.value) || 0;
            if (value > 0) {
                value -= 1;
                countInput.value = value;
                // Save to localStorage
                localStorage.setItem(`menu_${menuId}_quantity`, value);
            }
        });

        plusButton.addEventListener("click", () => {
            let value = parseInt(countInput.value) || 0;
            value += 1;
            countInput.value = value;
            // Save to localStorage
            localStorage.setItem(`menu_${menuId}_quantity`, value);
        });

        // Save quantity when manually typing
        countInput.addEventListener("input", function() {
            let value = parseInt(this.value) || 0;
            if (value < 0) value = 0;
            this.value = value;
            // Save to localStorage
            localStorage.setItem(`menu_${menuId}_quantity`, value);
        });

        // Save quantity before going to detail page
        detailButton.addEventListener('click', function(e) {
            const quantity = parseInt(countInput.value) || 0;
            localStorage.setItem(`menu_${menuId}_quantity`, quantity);
        });
    });

    // Update cart icon counter
    function updateCartCounter() {
        const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const cartIcon = document.querySelector('.cart-icon');
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        
        if (totalItems > 0) {
            cartIcon.setAttribute('data-count', totalItems);
        } else {
            cartIcon.removeAttribute('data-count');
        }
    }

    // Update counter when page loads
    updateCartCounter();

    // Make cart icon redirect to cart page
    document.querySelector('.cart-icon').addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = '{{ route("keranjang.index") }}';
    });
});
    </script>
</body>

</html>