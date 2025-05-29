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
            min-height: 100vh;
            padding-top: 80px;
            display: flex;
            flex-direction: column;
            background: url('{{ asset("assets/backgroundkeranjang.jpeg") }}') center/cover fixed no-repeat;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background: rgba(255, 255, 255, 0.5); */
            z-index: -1;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            flex: 1;
            overflow-y: auto;
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
            font-family: 'Playfair Display', serif;
            color: #4B3E2F;
            margin-bottom: 20px;
            text-align: center;
            font-style: italic;
        }

        .cart-table {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            border-spacing: 0 15px;
        }

        .cart-header th {
            color: #4B3E2F;
            font-size: 18px;
            padding: 10px;
            border-bottom: 2px solid #C17F3B;
            text-align: left;
        }

        .cart-item {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cart-item td {
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            gap: 15px;
            align-items: center;
            padding: 10px;
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-name {
            font-size: 18px;
            color: #4B3E2F;
            font-weight: 600;
        }

        .product-description {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f8f8;
            padding: 5px;
            border-radius: 8px;
            width: fit-content;
        }

        .quantity-btn {
            background: none;
            border: none;
            color: #4B3E2F;
            font-size: 20px;
            cursor: pointer;
            padding: 0 8px;
        }

        .quantity {
            font-size: 16px;
            min-width: 40px;
            text-align: center;
        }

        .price {
            font-size: 18px;
            color: #4B3E2F;
            font-weight: 600;
        }

        .delete-btn {
            background: #ff4444;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .delete-btn:hover {
            background: #cc0000;
        }

        .checkout-btn {
            display: block;
            width: 250px;
            margin: 40px auto 0;
            padding: 15px 30px;
            background-color: #D38524;
            color: white;
            text-align: center;
            border-radius: 30px;
            font-weight: 500;
            font-size: 18px;
            text-transform: none;
            letter-spacing: 0;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
        }

        .checkout-btn:hover {
            background-color: #bf7420;
            transform: translateY(-2px);
        }

        .footer {
            background-color: #B19370;
            padding: 20px 0;
            margin-top: auto;
            position: relative;
            z-index: 10;
            width: 100%;
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

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                padding: 15px;
            }

            .page-title {
                font-size: 36px;
            }

            .product-image {
                width: 80px;
                height: 80px;
            }

            .product-name {
                font-size: 16px;
            }

            .quantity-control {
                padding: 5px;
            }

            .checkout-btn {
                width: 200px;
                padding: 12px 24px;
                font-size: 16px;
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
            <thead>
                <tr>
                    <th style="width: 50%; text-align: left;">Produk</th>
                    <th style="width: 15%;">Harga</th>
                    <th style="width: 20%;">Jumlah</th>
                    <th style="width: 15%;">Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr class="cart-item" data-id="{{ $item->id }}">
                    <td>
                        <div class="product-info">
                            <img src="{{ $item->image }}" alt="{{ $item->nama_produk }}" class="product-image">
                            <div>
                                <div class="product-name">{{ $item->nama_produk }}</div>
                                <div class="product-description">Nasi putih, ayam bakar, lalapan, sambal, tahu tempe
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="price" style="text-align: center;">
                        Rp{{ number_format($item->price, 0, ',', '.') }}
                    </td>
                    <td>
                        <div class="quantity-control">
                            <button class="quantity-btn" onclick="updateQuantity({{ $item->id }}, -1)">−</button>
                            <span class="quantity">{{ $item->quantity }}</span>
                            <button class="quantity-btn" onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                        </div>
                    </td>
                    <td class="price" style="text-align: center;">
                        Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </td>
                    <td style="text-align: center;">
                        <button class="delete-btn" onclick="removeItem({{ $item->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('checkout.index') }}" class="checkout-btn">Checkout</a>
    </div>
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