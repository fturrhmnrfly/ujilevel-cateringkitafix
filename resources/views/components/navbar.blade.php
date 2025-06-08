<link rel="stylesheet" href="{{ asset('navbar.css') }}">
<!-- Pastikan Font Awesome juga di-load -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<nav class="navbar">
    <!-- Logo -->
    <div class="logo">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="width: 70px; height: 70px;">
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

    <!-- Search Container with Suggestions -->
    <div class="search-container" id="search-container">
        <input type="text" 
               class="search-bar" 
               id="search-input" 
               placeholder="Cari makanan..." 
               autocomplete="off">
        <button type="button" id="search-btn">
            <i class="fas fa-search"></i>
        </button>
        
        <div class="search-suggestions" id="search-suggestions">
            <!-- Suggestions will be populated here -->
        </div>
    </div>

    <!-- Navigation Links -->
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}">Home</a></li>
        <li><a href="{{ route('about.index') }}">Tentang Kami</a></li>
        <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
        <li><a href="{{ route('contact.index') }}">Contact</a></li>
    </ul>

    <div class="navbar-right">
        <!-- Notification -->
        <div class="notification-wrapper">
            <div class="notification-icon" id="notification-bell">
                <i class="fas fa-bell"></i>
                <span class="notification-badge" id="notification-badge">0</span>
            </div>
        </div>

        <!-- Cart -->
        <a href="{{ route('keranjang.index') }}" class="cart-icon">
            <img src="{{ asset('assets/keranjang.png') }}" alt="cart-icon">
        </a>

        <!-- Profile Section -->
        <div class="profile">
            <a href="{{ route('profile.show') }}">
                <img src="{{ asset('assets/profil.png') }}" alt="Profile">
            </a>
        </div>
    </div>
</nav>

<!-- Notification Modal -->
<div class="notification-modal" id="notification-modal">
    <div class="notification-modal-content">
        <div class="notification-modal-header">
            <h2 class="notification-modal-title">Notifikasi</h2>
            <button class="notification-modal-close" id="notification-modal-close">×</button>
        </div>
        <div class="notification-modal-body" id="notification-modal-body">
            <!-- Notifications will be loaded here -->
        </div>
        <div class="notification-delete-controls" id="notification-delete-controls">
            <span class="selected-count" id="selected-count">0 dipilih</span>
            <button class="delete-selected-btn" id="delete-selected-btn" disabled>Hapus Terpilih</button>
        </div>
    </div>
</div>

<!-- Pastikan script di-load setelah HTML -->
<script src="{{ asset('navbar.js') }}"></script>