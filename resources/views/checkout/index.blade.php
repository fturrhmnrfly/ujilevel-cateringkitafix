<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Catering Kita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('checkout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Background responsive untuk berbagai ukuran layar */
        body {
            background: url('{{ asset("assets/backgroundcheckout.jpeg") }}') no-repeat;
            background-attachment: fixed;
            background-position: center center;
            min-height: 100vh;
            
            /* Desktop dan laptop (landscape) */
            background-size: cover;
        }

        /* Tablet landscape */
        @media screen and (max-width: 1024px) and (orientation: landscape) {
            body {
                background-size: cover;
                background-position: center top;
            }
        }

        /* Tablet portrait */
        @media screen and (max-width: 768px) and (orientation: portrait) {
            body {
                background-size: cover;
                background-position: center center;
            }
        }

        /* Mobile devices portrait */
        @media screen and (max-width: 480px) and (orientation: portrait) {
            body {
                background-size: cover;
                background-position: center top;
                background-attachment: scroll; /* Untuk performa mobile yang lebih baik */
            }
        }

        /* Mobile devices landscape */
        @media screen and (max-width: 812px) and (orientation: landscape) {
            body {
                background-size: cover;
                background-position: center center;
                background-attachment: scroll;
            }
        }

        /* Untuk layar yang sangat kecil */
        @media screen and (max-width: 320px) {
            body {
                background-size: cover;
                background-position: center top;
                background-attachment: scroll;
            }
        }

        /* Untuk layar yang sangat besar */
        @media screen and (min-width: 1920px) {
            body {
                background-size: cover;
                background-position: center center;
            }
        }

        /* Untuk ratio layar yang sesuai dengan gambar (763:1105 ≈ 0.69) */
        @media screen and (aspect-ratio: 0.69/1) {
            body {
                background-size: 100% 100%; /* Fit exact untuk ratio yang sama */
            }
        }

        /* Alternative untuk layar dengan aspect ratio mendekati gambar */
        @media screen and (min-aspect-ratio: 0.6/1) and (max-aspect-ratio: 0.8/1) {
            body {
                background-size: contain;
                background-position: center center;
            }
        }

        /* Fallback untuk browser yang tidak support aspect-ratio */
        @supports not (aspect-ratio: 1/1) {
            @media screen and (max-width: 763px) {
                body {
                    background-size: 100% auto;
                    background-position: center top;
                }
            }
        }

        /* Ensure container visibility over background */
        .container {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            /* TAMBAHAN UNTUK MEMPERLEBAR CONTAINER */
            max-width: 1200px; /* Dari default yang mungkin 800px-1000px */
            width: 95%; /* Gunakan 95% dari lebar layar */
            margin: 0 auto; /* Center container */
            padding: 30px 40px; /* Tambah padding kiri-kanan */
        }

        /* Responsive adjustments untuk container yang lebih lebar */
        @media (max-width: 1400px) {
            .container {
                max-width: 1000px;
                width: 90%;
                padding: 25px 35px;
            }
        }

        @media (max-width: 1200px) {
            .container {
                max-width: 900px;
                width: 90%;
                padding: 25px 30px;
            }
        }

        @media (max-width: 992px) {
            .container {
                max-width: 750px;
                width: 95%;
                padding: 20px 25px;
            }
        }

        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                width: 95%;
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
                padding: 15px;
                margin: 0;
            }
        }

        /* Optional: Jika ingin container lebih lebar pada layar sangat besar */
        @media (min-width: 1600px) {
            .container {
                max-width: 1400px;
                padding: 40px 50px;
            }
        }

        @media (min-width: 1920px) {
            .container {
                max-width: 1600px;
                padding: 50px 60px;
            }
        }

        /* Optional: Dark overlay untuk readability yang lebih baik */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            z-index: 0;
            pointer-events: none;
        }

        /* Pastikan navbar dan elemen lain di atas overlay */
        .navbar,
        .breadcrumb-container,
        .container {
            position: relative;
            z-index: 2;
        }

        /* High DPI displays (Retina, etc.) */
        @media screen and (-webkit-min-device-pixel-ratio: 2),
               screen and (min-resolution: 192dpi) {
            body {
                background-size: cover;
                /* Bisa tambahkan gambar dengan resolusi lebih tinggi jika ada */
                /* background-image: url('{{ asset("assets/backgroundcheckout@2x.jpeg") }}'); */
            }
        }

        /* SUBTLE BACK BUTTON STYLING */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.8);
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid rgba(209, 213, 219, 0.8);
            transition: all 0.2s ease;
            margin-bottom: 0;
            cursor: pointer;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.95);
            color: #1f2937;
            border-color: rgba(156, 163, 175, 0.8);
            transform: translateX(-2px);
        }

        .back-button:active {
            transform: translateX(0);
        }

        .back-button i {
            font-size: 14px;
            transition: transform 0.2s ease;
        }

        .back-button:hover i {
            transform: translateX(-2px);
        }

        /* SUBTLE BREADCRUMB STYLING */
        .checkout-breadcrumb {
            background: rgba(249, 250, 251, 0.9);
            padding: 14px 20px;
            border-radius: 8px;
            margin: 16px 0 24px 0;
            border: 1px solid rgba(229, 231, 235, 0.8);
        }

        .breadcrumb-path {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #6b7280;
            margin: 0;
            flex-wrap: wrap;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .breadcrumb-item a {
            color: #6b7280;
            text-decoration: none;
            padding: 2px 6px;
            border-radius: 4px;
            transition: color 0.2s ease;
        }

        .breadcrumb-item a:hover {
            color: #374151;
            background: rgba(243, 244, 246, 0.8);
        }

        .breadcrumb-separator {
            color: #9ca3af;
            font-size: 11px;
            margin: 0 2px;
        }

        .breadcrumb-current {
            color: #1f2937;
            font-weight: 500;
            padding: 2px 6px;
            background: rgba(243, 244, 246, 0.8);
            border-radius: 4px;
        }

        /* SUBTLE CHECKOUT TITLE */
        .checkout-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 28px 0;
            text-align: center;
        }

        /* NAVIGATION HEADER SECTION - UPDATED WITHOUT BORDER AND LEFT ALIGNED */
        .navigation-header {
            background: transparent; /* Hilangkan background */
            padding: 16px 0; /* Hilangkan padding samping, biarkan hanya atas-bawah */
            margin-bottom: 24px;
            border: none; /* Hilangkan border */
            border-radius: 0; /* Hilangkan border radius */
            text-align: left; /* Rata kiri */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .back-button {
                padding: 8px 14px;
                font-size: 13px;
            }

            .checkout-breadcrumb {
                padding: 12px 16px;
                margin: 12px 0 20px 0;
            }

            .breadcrumb-path {
                font-size: 12px;
            }

            .checkout-title {
                font-size: 1.5rem;
                margin-bottom: 20px;
            }

            .navigation-header {
                padding: 12px 0; /* Update responsive padding */
                margin-bottom: 16px;
            }
        }

        @media (max-width: 480px) {
            .breadcrumb-path {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .breadcrumb-separator {
                display: none;
            }

            .breadcrumb-item {
                width: auto; /* Update: tidak perlu 100% width */
            }

            .back-button {
                width: auto; /* Update: tidak perlu full width */
                justify-content: flex-start; /* Update: align left */
            }
        }

        /* ENHANCED INTERACTIVE ELEMENTS */
        .back-button:focus {
            outline: 2px solid rgba(59, 130, 246, 0.5);
            outline-offset: 2px;
        }

        .breadcrumb-item a:focus {
            outline: 2px solid rgba(59, 130, 246, 0.5);
            outline-offset: 2px;
        }

        /* LOADING STATE FOR BACK BUTTON */
        .back-button.loading {
            pointer-events: none;
            opacity: 0.6;
        }

        .back-button.loading::after {
            content: '';
            position: absolute;
            width: 14px;
            height: 14px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ACCESSIBILITY IMPROVEMENTS */
        @media (prefers-reduced-motion: reduce) {
            .back-button,
            .breadcrumb-item a,
            .back-button i {
                transition: none;
            }
        }

        /* SUBTLE VISUAL FEEDBACK */
        .breadcrumb-item a::before {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 6px;
            right: 6px;
            height: 1px;
            background: transparent;
            transition: background 0.2s ease;
        }

        .breadcrumb-item a:hover::before {
            background: #d1d5db;
        }
    </style>
</head>

<body>
    <x-navbar></x-navbar>

    {{-- <div class="breadcrumb-container">
        <div class="breadcrumb">
            <div class="breadcrumb-title">Checkout</div>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> » <a href="{{ route('keranjang.index') }}">Keranjang</a> » Checkout
            </div>
        </div>
    </div> --}}

    <div class="container">
        <!-- Update input hidden untuk menyimpan user data -->
        <input type="hidden" id="user-name" 
               value="{{ Auth::user()->name }}" 
               data-user-id="{{ Auth::id() }}"
               data-user-email="{{ Auth::user()->email }}">
        
        <!-- UPDATED NAVIGATION HEADER - NO BORDER, LEFT ALIGNED -->
        <div class="navigation-header">
            <a href="{{ route('keranjang.index') }}" class="back-button" id="back-button">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Keranjang</span>
            </a>
            
            <!-- IMPROVED BREADCRUMB -->
            <div class="checkout-breadcrumb">
                <nav class="breadcrumb-path" aria-label="Breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" aria-label="Kembali ke Home">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </div>
                    <span class="breadcrumb-separator">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <div class="breadcrumb-item">
                        <a href="{{ route('menunasibox.index') }}" aria-label="Kembali ke Menu">
                            <i class="fas fa-utensils"></i>
                            Menu
                        </a>
                    </div>
                    <span class="breadcrumb-separator">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <div class="breadcrumb-item">
                        <a href="{{ route('keranjang.index') }}" aria-label="Kembali ke Keranjang">
                            <i class="fas fa-shopping-cart"></i>
                            Keranjang
                        </a>
                    </div>
                    <span class="breadcrumb-separator">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <div class="breadcrumb-current">
                        <i class="fas fa-credit-card"></i>
                        Checkout
                    </div>
                </nav>
            </div>
        </div>
        
        <h1 class="checkout-title">Checkout Disini</h1>

        <div class="order-section">
            <h2 class="section-title">Pesanan Anda</h2>
            <div id="checkout-items"></div>
        </div>

        <div class="order-section">
            <h2 class="section-title">Informasi Pengiriman</h2>
            <form class="shipping-form" id="shipping-form">
                <div class="form-group">
                    <label>Tanggal Pengiriman</label>
                    <input type="date" id="delivery-date" name="delivery_date"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        max="{{ date('Y-m-d', strtotime('+30 days')) }}" required>
                    <small class="date-notice">*Pemesanan minimal H-1 dan maksimal 30 hari ke depan</small>
                </div>

                <div class="form-group">
                    <label>Waktu Pengiriman</label>
                    <input type="time" id="delivery-time" required>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea id="address" required placeholder="Masukkan alamat lengkap untuk pengiriman..."></textarea>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="tel" id="phone" required placeholder="08xxxxxxxxxx">
                </div>

                <div class="form-group">
                    <label>Pesan Untuk Penjual (Opsional)</label>
                    <textarea id="notes" placeholder="Tambahkan catatan khusus untuk pesanan Anda..."></textarea>
                </div>

                <div class="order-section">
                    <div class="section-header">
                        <h2 class="section-title">Opsi Pengiriman</h2>
                        <a href="#" class="see-all" id="see-all-shipping">Lihat Semua</a>
                    </div>

                    <div class="shipping-options">
                        <!-- This content will be dynamically updated by JavaScript -->
                    </div>
                </div>

                <div class="order-section">
                    <div class="payment-option-section">
                        <a href="#" class="payment-method-link" id="payment-method-link">
                            <div class="payment-header">
                                <div class="payment-left">
                                    <span class="payment-icon">💳</span>
                                    <span class="payment-text">Pilih Metode Pembayaran</span>
                                </div>
                                <div class="payment-right">
                                    <span class="payment-type" id="selected-payment">Pilih Metode</span>
                                    <span class="payment-arrow">→</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="order-summary">
                        <div class="summary-item">
                            <span>Subtotal</span>
                            <span id="subtotal">Rp 0</span>
                        </div>
                        <div class="summary-item">
                            <span>Biaya Pengiriman</span>
                            <span>-</span>
                        </div>
                        <div class="summary-total">
                            <span>Total</span>
                            <span id="total">Rp 0</span>
                        </div>
                    </div>

                    <div class="button-group">
                        <button id="submit-order" class="btn-lanjutkan" disabled>Buat Pesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Shipping Modal -->
    <div class="modal" id="shippingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pilih Jasa Pengiriman</h3>
                <span class="close" id="close-shipping-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div class="shipping-options-modal">
                    @foreach([
                        ['id' => 'self-pickup', 'value' => 'self', 'title' => '🏪 Ambil Sendiri', 'price' => 'Rp0', 'desc' => 'Ambil pesanan di outlet kami'],
                        ['id' => 'instant-delivery', 'value' => 'instant', 'title' => '⚡ Garansi Tepat Waktu', 'price' => 'Rp10.000', 'desc' => 'Estimasi 30-60 menit'],
                        ['id' => 'regular-delivery', 'value' => 'regular', 'title' => '🚚 Regular', 'price' => 'Rp5.000', 'desc' => 'Estimasi 2-4 jam'],
                        ['id' => 'economy', 'value' => 'economy', 'title' => '💰 Hemat', 'price' => 'Rp2.000', 'desc' => 'Estimasi 3-6 jam']
                    ] as $option)
                    <div class="shipping-option">
                        <input type="radio" id="{{ $option['id'] }}" name="modal_shipping_option" value="{{ $option['value'] }}">
                        <label for="{{ $option['id'] }}" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">{{ $option['title'] }}</div>
                                    <div class="option-price">{{ $option['price'] }}</div>
                                </div>
                                <div class="option-description">{{ $option['desc'] }}</div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
                <button class="konfirmasi-btn" id="confirm-shipping">Konfirmasi</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('checkout.js') }}"></script>
    <script>
        // Enhanced back button functionality
        document.getElementById('back-button').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Add loading state
            this.classList.add('loading');
            
            // Simulate brief loading for better UX
            setTimeout(() => {
                window.location.href = this.href;
            }, 150);
        });

        // Enhanced breadcrumb interactions
        document.querySelectorAll('.breadcrumb-item a').forEach(link => {
            link.addEventListener('click', function(e) {
                // Add subtle animation feedback
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 100);
            });
        });
    </script>
</body>

</html>