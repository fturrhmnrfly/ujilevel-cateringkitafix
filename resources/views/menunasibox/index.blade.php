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
        background: url('{{ asset("assets/backgroundmenu.jpeg") }}') center/cover fixed no-repeat;
        position: relative;
    }

    /* Add overlay for better readability */
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
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
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
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
        margin-top: 0;
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
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        position: relative;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-out;
    }

    .section-title {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin: 0 auto 30px;
        text-align: center;
        position: relative;
        padding: 0 0 15px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: #e67e22;
        border-radius: 2px;
    }

    /* Menu Grid Styles */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        padding: 10px;
    }

    .menu-item {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 10px;
        transform: translateY(20px);
        opacity: 0;
        animation: slideUp 0.5s ease-out forwards;
    }

    .menu-item img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 8px;
    }

    .menu-item-content {
        padding: 12px 0;
    }

    .menu-item-title {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
    }

    .menu-item-description {
        font-size: 12px;
        color: #666;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .menu-item-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .menu-item-price {
        font-size: 14px;
        color: #000;
        font-weight: 600;
    }

    .counter {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .counter button {
        width: 24px;
        height: 24px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: #fff;
        color: #333;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .counter button:hover {
        background-color: #f5f5f5;
        transform: scale(1.1);
    }

    .counter input {
        width: 30px;
        height: 24px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .menu-item-button {
        background: #e67e22;
        color: white;
        padding: 8px 0;
        font-size: 14px;
        border-radius: 6px;
        text-align: center;
        display: block;
        width: 100%;
        border: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .menu-item-button:hover {
        background: #d35400;
        transform: scale(1.02);
    }

    /* Animation keyframes */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Stagger menu item animations */
    .menu-item {
        animation-delay: calc(var(--index) * 0.1s);
    }

    /* Hover animations */
    .menu-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <header>
        <x-navbar />
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
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_makanan }}">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">{{ $item->nama_makanan }}</h3>
                        <p class="menu-item-description">{{ $item->deskripsi }}</p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <div class="counter">
                                <button class="minus" type="button">-</button>
                                <input type="number" class="count" value="0" min="0" readonly>
                                <button class="plus" type="button">+</button>
                            </div>
                        </div>
                        <a href="{{ route('menunasibox.show', $item->id) }}" class="menu-item-button">Keranjang</a>
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