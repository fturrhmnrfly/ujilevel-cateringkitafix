<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $menu->nama_makanan }} - Detail</title>
    <style>
        .detail-container {
            max-width: 1200px;
            margin: 120px auto 40px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .product-image {
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
        }

        .product-title {
            font-size: 32px;
            color: #2c2c77;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 24px;
            color: #2c2c77;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .product-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .quantity-control button {
            width: 40px;
            height: 40px;
            border: none;
            background: #2c2c77;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
        }

        .quantity-control input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 18px;
        }

        .add-to-cart-btn {
            width: 100%;
            padding: 15px;
            background: #2c2c77;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .add-to-cart-btn:hover {
            background: #1a1a5c;
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <x-navbar></x-navbar>

    <div class="detail-container">
        <div class="product-detail">
            <div class="product-image">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->nama_makanan }}">
            </div>
            
            <div class="product-info">
                <h1 class="product-title">{{ $menu->nama_makanan }}</h1>
                <div class="product-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                <div class="product-description">{{ $menu->deskripsi }}</div>
                
                <div class="quantity-control">
                    <button class="minus">-</button>
                    <input type="number" class="count" value="1" min="1">
                    <button class="plus">+</button>
                </div>
                
                <button class="add-to-cart-btn">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const minusBtn = document.querySelector('.minus');
        const plusBtn = document.querySelector('.plus');
        const countInput = document.querySelector('.count');
        const addToCartBtn = document.querySelector('.add-to-cart-btn');
        
        minusBtn.addEventListener('click', () => {
            let value = parseInt(countInput.value);
            if (value > 1) {
                countInput.value = value - 1;
            }
        });
        
        plusBtn.addEventListener('click', () => {
            let value = parseInt(countInput.value);
            countInput.value = value + 1;
        });
        
        addToCartBtn.addEventListener('click', async () => {
            const quantity = parseInt(countInput.value);
            
            try {
                const response = await fetch('/keranjang/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        id: {{ $menu->id }},
                        kelola_makanan_id: {{ $menu->id }},
                        nama_produk: '{{ $menu->nama_makanan }}',
                        price: {{ $menu->harga }},
                        quantity: quantity,
                        image: '{{ $menu->image }}'
                    })
                });

                const data = await response.json();

                if (data.success) {
                    alert('Item berhasil ditambahkan ke keranjang!');
                    window.location.reload();
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                alert('Gagal menambahkan ke keranjang: ' + error.message);
            }
        });
    });
    </script>
</body>
</html>