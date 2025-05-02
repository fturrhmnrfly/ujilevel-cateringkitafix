<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Menu - {{ $menu->nama_makanan }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 80px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #2c2c77;
            font-size: 24px;
        }

        .detail-container {
            display: flex;
            gap: 40px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .menu-image {
            flex: 1;
            max-width: 500px;
        }

        .menu-image img {
            width: 100%;
            border-radius: 10px;
            height: auto;
        }

        .menu-info {
            flex: 1;
        }

        .menu-title {
            font-size: 28px;
            color: #333;
            margin: 0 0 15px;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .stars {
            color: #FFD700;
        }

        .review-count {
            color: #666;
        }

        .menu-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .menu-price {
            font-size: 24px;
            font-weight: bold;
            color: #2c2c77;
            margin-bottom: 20px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .counter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .counter button {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            background: #2c2c77;
            color: white;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .counter input {
            width: 50px;
            height: 30px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .add-to-cart {
            display: inline-block;
            background: #2c2c77;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .add-to-cart:hover {
            background: #1a1a5c;
        }

        .cart-icon {
    cursor: pointer;
    transition: transform 0.2s ease;
}

.cart-icon:hover {
    transform: scale(1.1);
}

/* SweetAlert custom styles */
.swal2-confirm {
    background-color: #2c2c77 !important;
    color: white !important;
}

.swal2-cancel {
    background-color: #6c757d !important;
    color: white !important;
}
    </style>
</head>
<body>
    <x-navbar />

    <div class="container">
        <a href="{{ route('menunasibox.index') }}" class="back-link">
            <i class="fas fa-chevron-left"></i>
        </a>

        <div class="detail-container">
            <div class="menu-image">
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->nama_makanan }}">
            </div>
            
            <div class="menu-info">
                <h1 class="menu-title">{{ $menu->nama_makanan }}</h1>
                
                <div class="rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="review-count">(1.200 Review)</span>
                </div>

                <p class="menu-description">{{ $menu->deskripsi }}</p>
                
                <div class="menu-price">
                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                </div>

                <div class="quantity-control">
                    <span>Jumlah:</span>
                    <div class="counter">
                        <button class="minus">-</button>
                        <input type="number" class="count" value="0" min="0">
                        <button class="plus">+</button>
                    </div>
                </div>

                <a href="#" class="add-to-cart">Tambah Ke Keranjang</a>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const countInput = document.querySelector('.count');
    const minusButton = document.querySelector('.minus');
    const plusButton = document.querySelector('.plus');
    const addToCartButton = document.querySelector('.add-to-cart');
    const cartIcon = document.querySelector('.cart-icon');
    
    const menuId = {{ $menu->id }};
    
    // Get saved quantity from localStorage
    const savedQuantity = localStorage.getItem(`menu_${menuId}_quantity`) || 0;
    countInput.value = savedQuantity;

    minusButton.addEventListener('click', () => {
        let value = parseInt(countInput.value) || 0;
        if (value > 0) {
            value -= 1;
            countInput.value = value;
            localStorage.setItem(`menu_${menuId}_quantity`, value);
        }
    });

    plusButton.addEventListener('click', () => {
        let value = parseInt(countInput.value) || 0;
        value += 1;
        countInput.value = value;
        localStorage.setItem(`menu_${menuId}_quantity`, value);
    });

    countInput.addEventListener('input', function() {
        let value = parseInt(this.value) || 0;
        if (value < 0) value = 0;
        this.value = value;
        localStorage.setItem(`menu_${menuId}_quantity`, value);
    });

    // Enhanced add to cart with SweetAlert2
    addToCartButton.addEventListener('click', async (e) => {
        e.preventDefault();
        const quantity = parseInt(countInput.value) || 0;
        
        if (quantity > 0) {
            try {
                const response = await fetch('/keranjang/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        id: {{ $menu->id }},
                        nama_produk: '{{ $menu->nama_makanan }}',
                        price: {{ $menu->harga }},
                        quantity: quantity,
                        image: '{{ Storage::url($menu->image) }}'
                    })
                });

                const data = await response.json();
                
                if (data.success) {
                    // Enhanced success message with SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Ditambahkan!',
                        text: `${quantity} ${quantity > 1 ? 'items' : 'item'} telah ditambahkan ke keranjang`,
                        showConfirmButton: true,
                        confirmButtonText: 'Lihat Keranjang',
                        showCancelButton: true,
                        cancelButtonText: 'Lanjut Belanja',
                        customClass: {
                            confirmButton: 'swal2-confirm',
                            cancelButton: 'swal2-cancel'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("keranjang.index") }}';
                        }
                    });
                    
                    countInput.value = 0;
                    localStorage.setItem(`menu_${menuId}_quantity`, 0);
                    
                    // Update cart counter
                    if (cartIcon) {
                        const currentCount = parseInt(cartIcon.getAttribute('data-count')) || 0;
                        cartIcon.setAttribute('data-count', currentCount + quantity);
                    }
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal menambahkan ke keranjang: ' + error.message
                });
            }
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Silakan pilih jumlah item terlebih dahulu!'
            });
        }
    });

    // Cart icon click handler
    if (cartIcon) {
        cartIcon.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '{{ route("keranjang.index") }}';
        });
    }
});
    </script>
</body>
</html>