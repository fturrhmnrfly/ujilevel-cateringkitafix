<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita User - Pesanan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('pesanan.css') }}">
    <style>
        /* Background Image Styling */
        body {
            background: url('{{ asset("assets/backgroundpesanan.jpeg") }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            position: relative;
            
            /* Fallback gradient jika gambar tidak load */
            background-color: #f5f5f5;
        }

        /* Overlay untuk readability yang lebih baik */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(1px);
            -webkit-backdrop-filter: blur(1px);
            z-index: 0;
            pointer-events: none;
        }

        /* Pastikan semua konten berada di atas overlay */
        nav.navbar,
        .container {
            position: relative;
            z-index: 1;
        }

        /* Enhance tab navigation appearance */
        .tab-navigation {
            background: rgba(39, 39, 110, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px 15px 0 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Enhance order cards appearance */
        .order-card,
        .order-card-new {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        /* Enhance empty state */
        .empty-state {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Responsive Background Adjustments */
        
        /* Desktop dan laptop (landscape) */
        @media screen and (min-width: 1024px) {
            body {
                background-size: cover;
                background-position: center center;
            }
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
                background-attachment: scroll; /* Better performance on mobile */
            }
            
            /* Adjust overlay for mobile */
            body::before {
                background: rgba(255, 255, 255, 0.25);
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

        /* Very small screens */
        @media screen and (max-width: 320px) {
            body {
                background-size: cover;
                background-position: center top;
                background-attachment: scroll;
            }
        }

        /* Very large screens */
        @media screen and (min-width: 1920px) {
            body {
                background-size: cover;
                background-position: center center;
            }
        }

        /* High DPI displays (Retina, etc.) */
        @media screen and (-webkit-min-device-pixel-ratio: 2),
               screen and (min-resolution: 192dpi) {
            body {
                background-size: cover;
                /* Bisa menggunakan gambar resolusi tinggi jika tersedia */
                /* background-image: url('{{ asset("assets/backgroundpesanan@2x.jpeg") }}'); */
            }
        }

        /* Dark mode support (optional) */
        @media (prefers-color-scheme: dark) {
            body::before {
                background: rgba(0, 0, 0, 0.3);
            }
            
            .tab-navigation {
                background: rgba(39, 39, 110, 0.98);
            }
            
            .order-card,
            .order-card-new {
                background: rgba(255, 255, 255, 0.9) !important;
            }
        }

        /* Loading state untuk background */
        body.loading {
            background-color: #f5f5f5;
        }

        /* Animation untuk smooth loading */
        body {
            transition: background-color 0.3s ease;
        }

        /* Enhance container */
        .container {
            background: transparent;
        }

        /* Orders grid container enhancement */
        .orders-grid-container {
            padding: 20px;
            border-radius: 0 0 15px 15px;
            background: rgba(255, 255, 255, 0.05);
        }

        /* Tab button enhancements */
        .tab-btn {
            background: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease !important;
        }

        .tab-btn.active {
            background: rgba(255, 255, 255, 1) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .tab-btn:hover:not(.active) {
            background: rgba(255, 255, 255, 0.95) !important;
            transform: translateY(-2px);
        }

        /* Modal enhancements */
        .modal {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(15px) !important;
            -webkit-backdrop-filter: blur(15px) !important;
        }

        /* Performance optimizations */
        @media (max-width: 768px) {
            body::before {
                backdrop-filter: none;
                -webkit-backdrop-filter: none;
            }
            
            .tab-navigation,
            .order-card,
            .order-card-new,
            .empty-state {
                backdrop-filter: none;
                -webkit-backdrop-filter: none;
            }
        }

        /* Preload background image */
        .preload-bg {
            position: absolute;
            top: -9999px;
            left: -9999px;
            width: 1px;
            height: 1px;
            background: url('{{ asset("assets/backgroundpesanan.jpeg") }}');
        }
    </style>
</head>
<body class="loading">
    <!-- Preload background image -->
    <div class="preload-bg"></div>
    
    <x-navbar></x-navbar>

    <div class="container">
        <div class="tab-navigation">
            @php
                $tabs = [
                    'pesanan.index' => 'Semua Pesanan',
                    'pesanan.unpaid' => 'Belum Bayar', 
                    'pesanan.process' => 'Diproses',
                    'pesanan.shipped' => 'Dikirim',
                    'pesanan.completed' => 'Selesai',
                    'pesanan.penilaian' => 'Penilaian'
                ];
            @endphp
            
            @foreach($tabs as $route => $label)
                <a href="{{ route($route) }}" class="tab-btn {{ request()->routeIs($route) ? 'active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>

        @if(isset($orders) && count($orders) > 0)
            <div class="orders-grid-container">
                @foreach($orders as $order)
                    <x-order-card :order="$order" />
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <img src="{{ asset('assets/empty-order.png') }}" alt="Tidak ada pesanan">
                <h3>Belum Ada Pesanan</h3>
                <p>Anda belum memiliki pesanan. Silahkan pesan makanan terlebih dahulu.</p>
                <a href="{{ route('dashboard') }}" class="btn-single">Pesan Sekarang</a>
            </div>
        @endif
    </div>

    {{-- Include the modals component --}}
    <x-order-modals />

    <script>
        // Remove loading class when page is fully loaded
        window.addEventListener('load', function() {
            document.body.classList.remove('loading');
        });

        // Initialize global order data
        window.orderData = window.orderData || {};
        console.log('Global order data initialized:', window.orderData);
        
        // Debug function
        function debugOrderData() {
            console.log('Current orderData:', window.orderData);
            console.log('Available order IDs:', Object.keys(window.orderData));
        }
        
        // Call debug after page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(debugOrderData, 1000);
        });

        // Background image error handling
        function checkBackgroundImage() {
            const img = new Image();
            img.onload = function() {
                console.log('Background image loaded successfully');
            };
            img.onerror = function() {
                console.warn('Background image failed to load, using fallback');
                document.body.style.backgroundColor = '#f5f5f5';
            };
            img.src = '{{ asset("assets/backgroundpesanan.jpeg") }}';
        }

        // Check background image on load
        document.addEventListener('DOMContentLoaded', checkBackgroundImage);
    </script>

    <script src="{{ asset('pesanan.js') }}"></script>
</body>
</html>