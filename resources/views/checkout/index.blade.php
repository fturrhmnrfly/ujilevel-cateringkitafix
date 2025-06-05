<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Catering Kita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('checkout.css') }}">
    <style>
        body {
            background: url('{{ asset("assets/backgroundcheckout.jpeg") }}') center/cover fixed no-repeat;
        }
    </style>
</head>

<body>
    <x-navbar></x-navbar>

    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <div class="breadcrumb-title">Paket Nasi Box</div>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> » Paket Nasi Box
            </div>
        </div>
    </div>

    <div class="container">
        <input type="hidden" id="user-name" value="{{ Auth::user()->name }}">
        <a href="/keranjang" class="back-button">← Kembali Ke Menu</a>
        <h1 class="checkout-title">Checkout</h1>

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
                    <textarea id="address" required></textarea>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="tel" id="phone" required>
                </div>

                <div class="form-group">
                    <label>Pesan Untuk Penjual</label>
                    <textarea id="notes"></textarea>
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
</body>

</html>