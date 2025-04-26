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
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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
            font-size: 24px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .cart-table {
            width: 100%;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cart-header {
            background: white;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .cart-header th {
            text-align: left;
            font-weight: 500;
            color: #2c3e50;
            padding: 10px;
        }

        .cart-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .cart-item td {
            padding: 10px;
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .product-name {
            font-weight: 500;
            color: #2c3e50;
        }

        .price {
            color: #2c3e50;
            font-weight: 500;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            background: none;
            border: 1px solid #ddd;
            width: 30px;
            height: 30px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            color: #2c3e50;
        }

        .quantity-btn:hover {
            background: #f5f5f5;
        }

        .quantity {
            width: 40px;
            text-align: center;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #e74c3c;
            cursor: pointer;
            font-size: 20px;
        }

        .checkout-btn {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 12px 0;
            background-color: #4e73f8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }

        .checkout-btn:hover {
            background-color: #3558d6;
        }
    </style>
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
    <div class="breadcrumb-container">
        <div class="breadcrumb">
        </div>
    </div>

    <div class="container">
        <h1 class="page-title">Keranjang</h1>

        <table class="cart-table">
            <thead class="cart-header">
                <tr>
                    <th style="width: 50%">Produk</th>
                    <th style="width: 15%">Harga</th>
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

        <a href="{{ route('checkout') }}" class="checkout-btn">Checkout</a>
    </div>

    <script>
        async function removeItem(itemId) {
            if (confirm('Apakah anda yakin ingin menghapus item ini?')) {
                try {
                    const response = await fetch(`/keranjang/remove/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Hapus elemen dari tampilan
                        const itemRow = document.querySelector(`tr.cart-item[data-id="${itemId}"]`);
                        if (itemRow) {
                            itemRow.remove();
                        }
                        
                        // Refresh halaman setelah menghapus
                        window.location.reload();
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    alert('Gagal menghapus item: ' + error.message);
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