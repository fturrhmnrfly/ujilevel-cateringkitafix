<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* Update these styles in navbar.blade.php */
    .cart-icon {
    position: relative;
    color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
}

.cart-icon:hover {
    transform: scale(1.1);
}

.cart-icon img {
    width: 40px;   /* Match original size */
    height: 40px;  /* Match original size */
    filter: brightness(0); /* Tambahkan filter untuk membuat icon hitam */
}

.cart-icon::after {
    content: attr(data-count);
    position: absolute;
    top: -5px;
    right: -5px;
    color: black;
    font-size: 12px;
    font-weight: bold;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s ease;
}

.cart-icon.has-items::after {
    opacity: 1;
    transform: scale(1);
}

    /* Navbar Styles */
    nav.navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff;
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
        color: #333;
    }

    .navbar .hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
    }

    .navbar .hamburger span {
        height: 3px;
        width: 25px;
        background-color: #fff;
        margin: 4px 0;
        transition: 0.4s;
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

    @media (max-width: 768px) {
        nav.navbar {
            padding: 10px 15px;
            flex-wrap: wrap;
        }

        body {
            padding-top: 60px;
        }

        .breadcrumb-container {
            margin-top: 60px;
        }

        .navbar .hamburger {
            display: flex;
            order: 1;
        }

        .navbar .logo {
            flex-grow: 1;
            order: 0;
        }

        .navbar .search-bar {
            order: 3;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
            height: 0;
        }

        .navbar .search-bar.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: all;
            height: auto;
        }

        .navbar .nav-links {
            position: fixed;
            top: 0;
            right: -100%;
            width: 250px;
            height: 100vh;
            background-color: #2c2c77;
            flex-direction: column;
            padding: 80px 20px;
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }

        .navbar .nav-links.active {
            right: 0;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-links li {
            margin: 15px 0;
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.3s ease-in-out;
        }

        .navbar .nav-links.active li {
            opacity: 1;
            transform: translateX(0);
            transition-delay: calc(0.1s * var(--item-index));
        }

        .navbar .profile {
            order: 2;
            margin-right: 15px;
        }

        /* Hamburger animation */
        .hamburger span {
            transition: all 0.3s ease-in-out;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
            transform: translateX(-10px);
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
    }

    .navbar .nav-links li {
        display: inline-block;
    }

    .navbar .nav-links li a {
        color: #333;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease-in-out;
    }

    .navbar .nav-links li a:hover {
        color: #ffcc00;
    }

    .navbar .profile {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #000; /* Ubah dari white ke hitam */
    }

    .navbar .profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        filter: brightness(0); /* Tambahkan filter untuk membuat icon hitam */
    }

    /* Add these new styles to your existing navbar CSS */
    .hamburger {
        display: none;
        cursor: pointer;
        padding: 10px;
        z-index: 1001;
    }

    .hamburger span {
        display: block;
        width: 25px;
        height: 3px;
        background-color: white;
        margin: 5px 0;
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .hamburger {
            display: block;
        }

        .navbar .search-bar {
            display: none;
        }

        .navbar .nav-links {
            position: fixed;
            top: 0;
            right: -100%;
            width: 250px;
            height: 100vh;
            background-color: #2c2c77;
            flex-direction: column;
            padding: 80px 20px;
            transition: 0.3s ease;
        }

        .navbar .nav-links.active {
            right: 0;
        }

        .navbar .nav-links li {
            margin: 15px 0;
        }

        /* Hamburger animation classes */
        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        /* Adjust logo and profile sections */
        .navbar .logo {
            flex-grow: 1;
        }

        .navbar .profile {
            margin-right: 15px;
        }
    }

    .notification-wrapper {
        position: relative;
        margin-right: 20px;
    }

    .notification-icon {
        color: #000;
        font-size: 24px;
        position: relative;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .notification-icon:hover {
        color: #444; /* Darker on hover */
    }

    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #ff4444;
        color: white;
        font-size: 11px;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    /* Update the navbar-right style */
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 25px;
        margin-left: 20px;
    }

    /* Update notification wrapper style */
    .notification-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .notification-icon {
        color: #000;
        font-size: 24px;
        position: relative;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .notification-icon:hover {
        color: #444; /* Darker on hover */
    }

    /* Update cart icon style */
    .cart-icon {
        position: relative;
        display: flex;
        align-items: center;
    }

    .cart-icon img {
        width: 40px;
        height: 40px;
        filter: brightness(0); /* Tambahkan filter untuk membuat icon hitam */
    }

    .cart-icon:hover img {
        transform: scale(1.1);
    }

    /* Update profile style */
    .profile {
        display: flex;
        align-items: center;
    }

    .profile img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .profile img:hover {
        transform: scale(1.1);
    }

    /* Update notification badge */
    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #ff4444;
        color: white;
        font-size: 11px;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    /* Update media queries for responsive design */
    @media (max-width: 768px) {
        .navbar-right {
            gap: 15px;
            margin-left: 10px;
        }

        .notification-icon {
            font-size: 20px;
        }

        .cart-icon img,
        .profile img {
            width: 25px;
            height: 25px;
        }
    }
</style>
<nav class="navbar">
    <!-- Logo -->
    <div class="logo">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        <div class="text-navbar">
            <p>CATERING</p>
            <p>KITA</p>
        </div>
    </div>

    <!-- Hamburger Menu -->
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Search Bar -->
    <form class="search-bar" action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search products..." value="{{ request('query') }}">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>

    <!-- Navigation Links -->
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}">Home</a></li>
        <li><a href="{{ route('about.index') }}">Tentang Kami</a></li>
        <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
        <li><a href="{{ route('contact.index') }}">Contact</a></li>
    </ul>

        <a href="{{ route('notifications.index') }}" class="notification-icon">
    <i class="fas fa-bell"></i>
    <span class="notification-badge">0</span>
</a>

        <div class="cart-icon">
            <img src="{{ asset('assets/keranjang.png') }}" alt="cart-icon">
        </div>

        <!-- Profile Section -->
        <div class="profile">
            <a href="{{ route('profile.show') }}">
                <img src="{{ asset('assets/profil.png') }}" alt="Profile">
            </a>
        </div>
    </div>
</nav>

<script>
// Updated JavaScript for navbar.blade.php
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const searchBar = document.querySelector('.search-bar');
    
    // Add index to nav items for staggered animation
    document.querySelectorAll('.nav-links li').forEach((item, index) => {
        item.style.setProperty('--item-index', index);
    });
    
    hamburger.addEventListener('click', function(e) {
        e.stopPropagation();
        // Toggle active classes
        hamburger.classList.toggle('active');
        navLinks.classList.toggle('active');
        searchBar.classList.toggle('active');
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInside = navLinks.contains(event.target) || 
                            hamburger.contains(event.target) ||
                            searchBar.contains(event.target);
        
        if (!isClickInside) {
            hamburger.classList.remove('active');
            navLinks.classList.remove('active');
            searchBar.classList.remove('active');
        }
    });

    // Prevent clicks inside search bar from closing menu
    searchBar.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    // Function to update cart counter
    function updateCartCounter() {
        const cartIcon = document.querySelector('.cart-icon');
        const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        
        if (totalItems > 0) {
            cartIcon.setAttribute('data-count', totalItems);
            cartIcon.classList.add('has-items');
        } else {
            cartIcon.removeAttribute('data-count');
            cartIcon.classList.remove('has-items');
        }
    }

    // Update counter initially
    updateCartCounter();

    // Listen for storage changes to update counter
    window.addEventListener('storage', function(e) {
        if (e.key === 'cartItems') {
            updateCartCounter();
        }
    });

    // Update cart counter when items are added/removed
    const originalSetItem = localStorage.setItem;
    localStorage.setItem = function(key, value) {
        const event = new Event('storage');
        event.key = key;
        originalSetItem.apply(this, arguments);
        window.dispatchEvent(event);
    };

    // Panggil saat halaman dimuat
    syncCartCounter();
});

// Tambahkan event listener untuk tombol logout
document.addEventListener('DOMContentLoaded', function() {
    const logoutForm = document.querySelector('form[action="{{ route('logout') }}"]');
    if (logoutForm) {
        logoutForm.addEventListener('submit', function() {
            localStorage.removeItem('cartItems'); // Hapus cart items saat logout
        });
    }
});

async function syncCartCounter() {
    try {
        const response = await fetch('/keranjang/count', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            const cartIcon = document.querySelector('.cart-icon');
            // Hanya tampilkan counter jika ada items
            if (data.count > 0) {
                cartIcon.setAttribute('data-count', data.count.toString());
            } else {
                cartIcon.removeAttribute('data-count');
            }
            
            // Clear localStorage dan set ulang sesuai database
            localStorage.removeItem('cartItems');
            if (data.items && data.items.length > 0) {
                localStorage.setItem('cartItems', JSON.stringify(data.items));
            }
        }
    } catch (error) {
        console.error('Error syncing cart:', error);
    }
}

// Tambahkan setelah syncCartCounter()

async function updateNotificationBadge() {
    try {
        const response = await fetch('/notifications/count');
        const data = await response.json();
        
        const badge = document.querySelector('.notification-badge');
        if (badge) {
            badge.textContent = data.count || '0';
            badge.style.display = data.count > 0 ? 'block' : 'none';
        }
    } catch (error) {
        console.error('Error updating notification badge:', error);
    }
}

// Update badge setiap 30 detik
setInterval(updateNotificationBadge, 30000);

// Update saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    updateNotificationBadge();
});
</script>