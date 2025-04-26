<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Menu - {{ $menu->nama_produk }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->nama_produk }}">
            </div>
            
            <div class="menu-info">
                <h1 class="menu-title">{{ $menu->nama_produk }}</h1>
                
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
                    Rp {{ number_format($menu->price, 0, ',', '.') }}
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

            minusButton.addEventListener('click', () => {
                let value = parseInt(countInput.value) || 0;
                if (value > 0) {
                    countInput.value = value - 1;
                }
            });

            plusButton.addEventListener('click', () => {
                let value = parseInt(countInput.value) || 0;
                countInput.value = value + 1;
            });

            // Make cart icon clickable and redirect to cart page
    document.querySelector('.cart-icon').addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = '{{ route("keranjang.index") }}';
    });

    // Update cart counter function
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

    // Call updateCartCounter when page loads
    updateCartCounter();

    // Update counter when items are added to cart
    addToCartButton.addEventListener('click', async (e) => {
        e.preventDefault();
        const quantity = parseInt(countInput.value) || 0;
        
        if (quantity > 0) {
            try {
                // Get existing cart items or initialize empty array
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Create new item
                const newItem = {
                    id: {{ $menu->id }},
                    nama_produk: '{{ $menu->nama_produk }}',
                    price: {{ $menu->price }},
                    quantity: quantity,
                    image: '{{ $menu->image }}'
                };

                // Check if item already exists in cart
                const existingItemIndex = cartItems.findIndex(item => item.id === newItem.id);
                
                if (existingItemIndex !== -1) {
                    // Update quantity if item exists
                    cartItems[existingItemIndex].quantity += quantity;
                } else {
                    // Add new item if it doesn't exist
                    cartItems.push(newItem);
                }

                // Save updated cart to localStorage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));

                // Update cart total for next checkout
                let cartTotal = cartItems.reduce((total, item) => {
                    return total + (item.price * item.quantity);
                }, 0);
                localStorage.setItem('orderTotal', cartTotal);

                alert('Item berhasil ditambahkan ke keranjang!');
                countInput.value = 0;

                // Optional: Update cart icon counter if you have one
                const cartCounter = document.querySelector('.cart-count');
                if (cartCounter) {
                    const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);
                    cartCounter.textContent = totalItems;
                }

            } catch (error) {
                alert('Gagal menambahkan ke keranjang: ' + error.message);
                console.error(error);
            }
        } else {
            alert('Silakan pilih jumlah item terlebih dahulu!');
        }
    });
        });
    </script>
</body>
</html>