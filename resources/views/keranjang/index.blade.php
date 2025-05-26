<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Catering Kita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: url('{{ asset('assets/backgroundkeranjang.jpeg') }}') center/cover fixed no-repeat;
            min-height: 100vh;
            padding-top: 120px;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 40px 40px;
            background: url('{{ asset('assets/note-bg.png') }}') center/contain no-repeat;
            border-radius: 15px;
            position: relative;
            flex: 1;
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

        .navbar .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .logo {
            color: white;
            font-size: 20px;
            text-decoration: none;
        }

        .cart-icon {
            color: white;
            font-size: 24px;
            text-decoration: none;
        }

        .page-title {
            font-size: 48px;
            color: #4B3E2F;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            margin-bottom: 20px;
            position: relative;
        }

        .cart-table {
            margin-top: 20px;
            width: 100%;
            background: transparent;
            border-spacing: 0 15px;
        }

        .cart-header th {
            color: #4B3E2F;
            font-size: 18px;
            padding: 15px;
            border-bottom: 2px solid #C17F3B;
            text-align: left;
        }

        .cart-item {
            background: rgba(255, 255, 255, 0.9);
            margin-bottom: 15px;
        }

        .cart-item td {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px;
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .product-image {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-name {
            font-size: 16px;
            color: #4B3E2F;
            font-weight: 500;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .quantity-btn {
            background: #C17F3B;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        .checkout-btn {
            display: block;
            width: 200px;
            margin: 30px auto 0;
            padding: 15px 0;
            background-color: #C17F3B;
            color: white;
            text-align: center;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        .footer {
            background-color: #B19370;
            padding: 40px 0;
            margin-top: auto;
            position: relative;
            z-index: 10;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.5fr 2px 2fr 2fr 2fr;
            gap: 30px;
            padding: 0 20px;
        }

        .footer-divider {
            width: 2px;
            background-color: #999;
            height: 100%;
        }

        .footer-logo {
            display: flex;
            flex-direction: column;
            margin-left: 20px;
        }

        .footer-logo img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
            margin-left: -150px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .footer-brand-text {
            font-size: 24px;
            font-weight: bold;
        }

        .brand-catering {
            color: #FFA500;
        }

        .brand-kita {
            color: #333;
        }

        .footer-section {
            padding: 0 20px;
        }

        .footer-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .footer-text {
            color: #fff;
            line-height: 1.6;
            font-size: 14px;
        }

        .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-size: 14px;
        }

        .contact-icon {
            width: 20px;
            height: 20px;
            color: #F61515;
        }

        @media (max-width: 992px) {
            .footer-container {
                grid-template-columns: 1fr;
            }

            .footer-divider {
                display: none;
            }

            .footer-section {
                padding: 0;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <div class="text-navbar">
                <p>CATERING</p>
                <p>KITA</p>
            </div>
        </div>

       <x-navbar></x-navbar>

        <!-- Profile Section -->
        <div class="profile">
            <img src="{{ asset('assets/profil.png') }}" alt="Profile">
        </div>
    </nav>


    <div class="container">
        <h1 class="page-title">Keranjang</h1>

        <table class="cart-table">
            <thead class="cart-header">
                <tr>
                    <th style="width: 45%">Produk</th>
                    <th style="width: 20%">Harga</th>
                    <th style="width: 20%">Jumlah</th>
                    <th style="width: 15%">Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cart-items">
                @foreach($cartItems as $item)
                <tr class="cart-item" data-id="{{ $item->id }}">
                    <td>
                        <div class="product-info">
                            <img src="{{ $item->image }}" alt="{{ $item->nama_produk }}" class="product-image">
                            <span class="product-name">{{ $item->nama_produk }}</span>
                        </div>
                    </td>
                    <td class="price">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>
                        <div class="quantity-control">
                            <button class="quantity-btn" onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                            <span class="quantity">{{ $item->quantity }}</span>
                            <button class="quantity-btn" onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                        </div>
                    </td>
                    <td class="price">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    <td>
                        <button class="delete-btn" onclick="removeItem({{ $item->id }})">🗑️</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('checkout.index') }}" class="checkout-btn">Checkout</a>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <!-- Logo and Brand Section -->
            <div class="footer-logo">
                <div class="footer-brand">
                    <img src="{{ asset('assets/logo.png') }}" alt="Catering Kita Logo">
                    <div class="footer-brand-text">
                        <span class="brand-catering">CATERING</span>
                        <span class="brand-kita">KITA</span>
                    </div>
                </div>
            </div>

            <!-- Vertical Divider -->
            <div class="footer-divider"></div>

            <!-- Description Section -->
            <div class="footer-section">
                <h3 class="footer-title">Deskripsi</h3>
                <p class="footer-text">
                    "Catering Kita adalah solusi lengkap untuk kebutuhan belanja makanan Anda. Temukan berbagai
                    produk segar dan berkualitas hanya di sini!" "Belanja mudah dan cepat untuk semua kebutuhan
                    katering Anda. Bergabunglah dengan ribuan pelanggan kami!"
                </p>
            </div>

            <!-- Product Categories Section -->
            <div class="footer-section">
                <h3 class="footer-title">Kategori Produk</h3>
                <p class="footer-text">
                    "Temukan berbagai kategori produk terbaik kami."
                </p>
            </div>

            <!-- Contact Section -->
            <div class="footer-section">
                <h3 class="footer-title">Contact</h3>
                <div class="footer-contact">
                    <div class="contact-item">
                        <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Jln E.sumawijaya GG.amin RT 02/02 Desa pasireurih Kec tamansari</span>
                    </div>
                    <div class="contact-item">
                        <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span>+62 831-1582-6505</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        async function removeItem(itemId) {
    // Show SweetAlert2 confirmation dialog
    const result = await Swal.fire({
        title: 'Delete',
        text: 'apakah kamu yakin kamu akan menghapus produk tersebut',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok',
        cancelButtonText: 'Cancel'
    });

    // If user confirms deletion
    if (result.isConfirmed) {
        try {
            const response = await fetch(`/keranjang/delete/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();

            if (data.success) {
                // Show success message
                await Swal.fire({
                    icon: 'success',
                    title: 'Menu Berhasil Di Hapus',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Remove item from view
                const itemRow = document.querySelector(`tr.cart-item[data-id="${itemId}"]`);
                if (itemRow) {
                    itemRow.remove();
                }
                
                // Reload page to update totals
                window.location.reload();
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            // Show error message
            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal menghapus item: ' + error.message
            });
        }
    }
}

        // Tambahkan fungsi untuk update quantity
        async function updateQuantity(itemId, change) {
            try {
                const quantitySpan = document.querySelector(`tr[data-id="${itemId}"] .quantity`);
                let newQuantity = parseInt(quantitySpan.textContent) + change;
                
                if (newQuantity < 1) {
                    return;
                }

                const response = await fetch(`/keranjang/${itemId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Refresh halaman untuk memperbarui total
                    window.location.reload();
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                alert('Gagal mengupdate jumlah: ' + error.message);
            }
        }
    </script>
</body>

</html>