<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $menu->nama_produk }} - Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .product-detail {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .back-button:hover {
            color: #2c2c77;
        }

        .product-container {
            display: flex;
            gap: 40px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            flex: 1;
        }

        .product-image img {
            width: 100%;
            border-radius: 10px;
            height: 400px;
            object-fit: cover;
        }

        .product-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
        }

        .stars {
            color: #FFD700;
        }

        .product-description {
            color: #666;
            line-height: 1.6;
            margin-top: 20px;
        }

        .product-price {
            font-size: 24px;
            font-weight: bold;
            color: #2c2c77;
        }

        .section-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .ingredients {
            list-style: none;
            padding: 0;
            margin: 0;
            color: #666;
        }

        .ingredients li {
            margin-bottom: 5px;
        }

        .quantity {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 20px;
        }

        .quantity button {
            width: 30px;
            height: 30px;
            border: none;
            background: #2c2c77;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity input {
            width: 50px;
            height: 30px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .quantity input::-webkit-outer-spin-button,
        .quantity input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .product-actions {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .add-to-cart {
            flex: 1;
            padding: 12px 30px;
            background-color: #2c2c77;
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-to-cart:hover {
            background-color: #1a1a5c;
        }
    </style>
</head>
<body>
    <div class="product-detail">
        <a href="{{ route('menuprasmanan.index') }}" class="back-button">
            <span>←</span> Kembali
        </a>

        <div class="product-container">
            <div class="product-image">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->nama_produk }}">
            </div>
            <div class="product-info">
                <h1 class="product-title">{{ $menu->nama_produk }}</h1>
                <div class="product-rating">
                    <div class="stars">★★★★★</div>
                    <span>(5.0) ratings</span>
                </div>
                <p class="product-description">{{ $menu->deskripsi }}</p>
                
                <div class="section-title">Bahan Utama:</div>
                <ul class="ingredients">
                    @foreach(explode(',', $menu->deskripsi) as $item)
                        <li>{{ trim($item) }}</li>
                    @endforeach
                </ul>

                <div class="product-price">
                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                </div>

                <div class="product-actions">
                    <div class="quantity">
                        <button class="minus">-</button>
                        <input type="number" class="count" value="0" min="0">
                        <button class="plus">+</button>
                    </div>
                    <button class="add-to-cart">Tambah Ke Keranjang</button>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const countInput = document.querySelector('.count');
    const minusButton = document.querySelector('.minus');
    const plusButton = document.querySelector('.plus');
    const addToCartButton = document.querySelector('.add-to-cart');

    // Handle minus button
    minusButton.addEventListener('click', () => {
        let value = parseInt(countInput.value) || 0;
        if (value > 0) {
            countInput.value = value - 1;
        }
    });

    // Handle plus button  
    plusButton.addEventListener('click', () => {
        let value = parseInt(countInput.value) || 0;
        countInput.value = value + 1;
    });

    // Handle add to cart
    addToCartButton.addEventListener('click', async () => {
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
                        nama_produk: '{{ $menu->nama_produk }}',
                        price: {{ $menu->price }},
                        quantity: quantity,
                        image: '{{ $menu->image }}'
                    })
                });

                const data = await response.json();
                if (data.success) {
                    alert('Item berhasil ditambahkan ke keranjang!');
                    countInput.value = 0;
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                alert('Gagal menambahkan ke keranjang: ' + error.message);
            }
        } else {
            alert('Silakan pilih jumlah item terlebih dahulu!');
        }
    });
});
</script>
</body>
</html>