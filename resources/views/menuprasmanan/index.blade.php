<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu Prasmanan</title>
    <!-- Add SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: url('{{ asset("assets/backgroundmenu.jpeg") }}') center/cover fixed no-repeat;
        position: relative;
    }

    /* Add this to create an overlay */
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
        background-color: #fff;
        /* Warna biru navbar */
        padding: 15px 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar .logo {
        display: flex;
        align-items: center;
        color: #000000;
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
        color: #000000;
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
        color: #000000;
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
        color: #000000;
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
        color: black;
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

    /* Updated Menu Section Styles */
    .menu-section {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        position: relative;
        z-index: 1;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-out;
    }

    .section-title {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        text-align: center;
        position: relative;
        padding: 0 0 15px;
        margin-bottom: 30px;
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
        font-size: 14px; /* Dinaikkan dari 12px ke 14px */
        color: #666;
        margin-bottom: 10px; /* Dinaikkan dari 8px ke 10px */
        line-height: 1.5; /* Dinaikkan dari 1.4 ke 1.5 untuk readability */
        min-height: auto; /* Hilangkan fixed height */
        word-wrap: break-word; /* Memastikan text wrap dengan baik */
        overflow-wrap: break-word; /* Untuk browser compatibility */
        white-space: normal; /* Memastikan text bisa wrap ke baris baru */
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

    /* Updated button styles untuk add to cart dengan warna #D38524 */
    .add-to-cart-btn {
        background: #D38524;
        color: white;
        padding: 8px 12px;
        font-size: 12px;
        border-radius: 6px;
        text-align: center;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        width: 100%;
        margin-top: 8px;
    }

    .add-to-cart-btn:hover {
        background: #B8721C;
        transform: scale(1.02);
    }

    .add-to-cart-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
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
        <x-navbar></x-navbar>
        
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <div class="breadcrumb-title">Catering</div>
                <div class="breadcrumb-nav">
                    <a href="{{ route('home') }}">Home</a> » Menu Prasmanan
                </div>
            </div>
        </div>

        <!-- Prasmanan Section -->
        <div class="menu-section">
            <h2 class="section-title">Prasmanan</h2>
            <div class="menu-grid">
                @foreach($menuItems as $menu)
                <div class="menu-item" data-id="{{ $menu->id }}">
                    @if($menu->image && Storage::disk('public')->exists($menu->image))
                        <img src="{{ Storage::url($menu->image) }}" alt="{{ $menu->nama_makanan }}">
                    @else
                        <img src="{{ asset('assets/default-food.png') }}" alt="Default food image">
                    @endif
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">{{ $menu->nama_makanan }}</h3>
                        <p class="menu-item-description">{{ Str::limit($menu->deskripsi, 80, '...') }}</p>
                        <div class="menu-item-details">
                            <p class="menu-item-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            <div class="counter">
                                <button class="minus">-</button>
                                <input type="number" class="count" value="0" min="0">
                                <button class="plus">+</button>
                            </div>
                        </div>
                        <button class="add-to-cart-btn" data-menu-id="{{ $menu->id }}" 
                                data-menu-name="{{ $menu->nama_makanan }}" 
                                data-menu-price="{{ $menu->harga }}" 
                                data-menu-image="{{ $menu->image ? Storage::url($menu->image) : asset('assets/default-food.png') }}">
                            + Keranjang
                        </button>
                    </div>
                </div>
                @endforeach
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
        const addToCartBtn = item.querySelector('.add-to-cart-btn');
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

        // Add to cart button click
        addToCartBtn.addEventListener('click', async function() {
            const quantity = parseInt(countInput.value) || 0;
            
            if (quantity <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Silakan pilih jumlah item terlebih dahulu!',
                    confirmButtonColor: '#2c2c77'
                });
                return;
            }

            const menuData = {
                id: this.dataset.menuId,
                nama_produk: this.dataset.menuName,
                price: this.dataset.menuPrice,
                quantity: quantity,
                image: this.dataset.menuImage
            };

            // Disable button during request
            this.disabled = true;
            this.textContent = 'Adding...';

            try {
                const response = await fetch('/keranjang/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(menuData)
                });

                const data = await response.json();

                if (data.success) {
                    // Reset quantity
                    countInput.value = 0;
                    localStorage.setItem(`menu_${menuId}_quantity`, 0);
                    updateCartCounter();

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `${quantity} ${menuData.nama_produk} berhasil ditambahkan ke keranjang`,
                        showConfirmButton: true,
                        confirmButtonText: 'Lihat Keranjang',
                        showCancelButton: true,
                        cancelButtonText: 'Lanjut Belanja',
                        confirmButtonColor: '#2c2c77',
                        cancelButtonColor: '#6c757d'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("keranjang.index") }}';
                        }
                    });
                } else {
                    throw new Error(data.message || 'Gagal menambahkan ke keranjang');
                }
            } catch (error) {
                console.error('Add to cart error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal menambahkan ke keranjang: ' + error.message,
                    confirmButtonColor: '#dc3545'
                });
            } finally {
                // Re-enable button
                this.disabled = false;
                this.textContent = '+ Keranjang';
            }
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