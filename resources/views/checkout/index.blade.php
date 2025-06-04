<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Catering Kita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preload" as="image" href="{{ asset('assets/backgroundcheckout.jpeg') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
            position: relative;
            background: url('{{ asset("assets/backgroundchekout.jpeg") }}') center/cover fixed no-repeat;
        }

        /* Add semi-transparent overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.75);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
        }

        .order-section {
            background: rgba(255, 255, 255, 0.9);
            /* Buat section lebih transparan */
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(237, 242, 247, 0.8);
        }

        /* Update order section */
        .order-section {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #edf2f7;
        }

        /* Update section title */
        .section-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #1a1a1a;
            font-weight: 600;
        }

        /* Update existing styles */
        body {
            background: url('{{ asset("assets/backgroundcheckout.jpeg") }}') center/cover fixed no-repeat;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .checkout-title {
            font-size: 24px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .order-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .order-item {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .item-description {
            color: #666;
            font-size: 13px;
        }

        .item-price {
            color: #333;
            font-weight: 500;
            margin-top: 4px;
        }

        .remove-item {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #e74c3c;
            cursor: pointer;
            font-size: 20px;
        }

        .shipping-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .order-summary {
            margin-top: 20px;
            padding: 15px;
            background: white;
            border-radius: 12px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #666;
        }

        .summary-total {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-weight: 600;
            color: #333;
        }

        .checkout-btn {
            width: 100%;
            padding: 15px;
            background: #D38524;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background: #bf7420;
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

        /* Add to your existing CSS */
        .button-group {
            margin-top: 20px;
        }

        .btn-lanjutkan {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #2c2c77;
            color: white;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-lanjutkan:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .btn-lanjutkan:not(:disabled):hover {
            background-color: #1a1a5c;
            transform: translateY(-1px);
        }

        #proceed-payment {
            background-color: #28a745;
        }

        #proceed-payment:hover {
            background-color: #218838;
        }

        .shipping-options {
            margin-top: 15px;
        }

        .shipping-option {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .shipping-option:hover {
            border-color: #2c2c77;
        }

        .option-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .option-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .option-badge {
            background-color: #f0ad4e;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .option-price {
            font-weight: 500;
            color: #2c3e50;
        }

        .option-description {
            display: flex;
            align-items: center;
            color: #666;
            font-size: 13px;
            margin-top: 5px;
        }

        .delivery-icon {
            margin-right: 8px;
            font-size: 16px;
        }

        /* Show delivery date/time only when scheduled delivery is selected */
        #delivery-date-container,
        #delivery-time-container {
            display: none;
        }

        .shipping-option input[value="scheduled"]:checked~.form-group #delivery-date-container,
        .shipping-option input[value="scheduled"]:checked~.form-group #delivery-time-container {
            display: block;
        }

        .modal-body {
            padding: 20px;
        }

        .shipping-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .shipping-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .shipping-option input[type="radio"] {
            display: none;
        }

        .shipping-option-label {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .shipping-option:hover {
            background-color: #f9f9f9;
        }

        .shipping-option input[type="radio"]:checked+.shipping-option-label {
            border: 2px solid #2c2c77;
            background-color: #f0f7ff;
        }

        .shipping-price {
            font-weight: bold;
            color: #333;
        }

        .konfirmasi-btn {
            width: 100%;
            padding: 12px;
            background-color: #2c2c77;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .konfirmasi-btn:hover {
            background-color: #1a1a5c;
        }

        .date-notice {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .form-group input[type="date"],
        .form-group input[type="time"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
        }

        .form-group input[type="date"]:invalid,
        .form-group input[type="time"]:invalid {
            border-color: #e74c3c;
        }

        .form-group input[type="date"]:valid,
        .form-group input[type="time"]:valid {
            border-color: #2ecc71;
        }

        .shipping-options {
            margin-top: 15px;
        }

        .shipping-option {
            margin-bottom: 10px;
        }

        .shipping-option-label {
            display: block;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
        }

        .shipping-option input[type="radio"] {
            display: none;
        }

        .shipping-option input[type="radio"]:checked+.shipping-option-label {
            background: #fff;
            border: 2px solid #2c2c77;
        }

        .option-content {
            width: 100%;
        }

        .option-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .option-title {
            font-weight: 600;
            color: #1a1a1a;
        }

        .option-price {
            font-weight: 600;
            color: #1a1a1a;
        }

        .option-description {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
        }

        .delivery-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 14px;
        }

        .delivery-icon {
            font-size: 20px;
        }

        /* Update existing payment method section */
        .payment-method {
            margin-top: 20px;
            background: #f8fafc;
            padding: 16px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .payment-method-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .payment-icon {
            width: 24px;
            height: 24px;
        }

        .payment-text {
            font-weight: 500;
            color: #1a1a1a;
        }

        .payment-method-arrow {
            color: #666;
        }

        /* Add these styles to your existing CSS */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            display: block;
            opacity: 1;
        }

        .modal-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal.show .modal-content {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .close {
            font-size: 24px;
            color: #666;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #1a1a1a;
        }

        .shipping-options-modal .shipping-option {
            margin-bottom: 10px;
        }

        .shipping-options-modal .shipping-option-label {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .shipping-options-modal .shipping-option input[type="radio"]:checked+.shipping-option-label {
            border-color: #2c2c77;
            background-color: #F5F9FF;
        }

        .konfirmasi-btn {
            width: 100%;
            padding: 12px;
            background-color: #2c2c77;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .konfirmasi-btn:hover {
            background-color: #1a1a5c;
        }

        /* Add these styles to your existing CSS */
        .payment-option-section {
            margin-top: 20px;
        }

        .payment-method-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .payment-header {
            background: #f8fafc;
            padding: 16px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .payment-header:hover {
            border-color: #2c2c77;
            background: #fff;
        }

        .payment-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .payment-icon {
            font-size: 20px;
        }

        .payment-text {
            font-size: 16px;
            font-weight: 500;
            color: #1a1a1a;
        }

        .payment-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payment-type {
            color: #666;
            font-size: 14px;
        }

        .payment-arrow {
            color: #666;
            font-size: 18px;
        }

        /* Add this section for the payment summary */
        .rincian-pembayaran {
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
        }

        .rincian-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 16px;
        }

        .rincian-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            color: #666;
            font-size: 14px;
        }

        .rincian-total {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 16px;
        }

        /* Payment Modal Styles - TAMBAHAN */
        .payment-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .payment-modal.show {
            display: block;
            opacity: 1;
        }

        .payment-modal-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 450px;
            opacity: 0;
            transition: all 0.3s ease;
            max-height: 80vh;
            overflow-y: auto;
        }

        .payment-modal.show .payment-modal-content {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .payment-options {
            margin: 20px 0;
        }

        .payment-option {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .payment-option input[type="radio"] {
            display: none;
        }

        .payment-option label {
            display: flex;
            align-items: center;
            padding: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .payment-option label:hover {
            background-color: #f8f9fa;
        }

        .payment-option input[type="radio"]:checked+label {
            background-color: #e7f3ff;
            border-color: #2c2c77;
        }

        .payment-option img {
            width: 32px;
            height: 32px;
            margin-right: 12px;
            object-fit: contain;
        }

        .payment-option span {
            font-size: 14px;
            font-weight: 500;
        }

        .order-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .countdown {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>

<body style="background: url('{{ asset('assets/backgroundcheckout.jpeg') }}') center/cover fixed no-repeat;">

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
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}"
                        required>
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
                        <button id="proceed-payment" class="btn-lanjutkan" style="display: none;">Lanjutkan ke
                            Pembayaran</button>
                    </div>

            </form>
        </div>
    </div>

    <!-- MODAL PENGIRIMAN -->
    <div class="modal" id="shippingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pilih Jasa Pengiriman</h3>
                <span class="close" id="close-shipping-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div class="shipping-options-modal">
                    <div class="shipping-option">
                        <input type="radio" id="self-pickup" name="modal_shipping_option" value="self">
                        <label for="self-pickup" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">🏪 Ambil Sendiri</div>
                                    <div class="option-price">Rp0</div>
                                </div>
                                <div class="option-description">Ambil pesanan di outlet kami</div>
                            </div>
                        </label>
                    </div>

                    <div class="shipping-option">
                        <input type="radio" id="instant-delivery" name="modal_shipping_option" value="instant">
                        <label for="instant-delivery" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">⚡ Garansi Tepat Waktu</div>
                                    <div class="option-price">Rp10.000</div>
                                </div>
                                <div class="option-description">Estimasi 30-60 menit</div>
                            </div>
                        </label>
                    </div>

                    <div class="shipping-option">
                        <input type="radio" id="regular-delivery" name="modal_shipping_option" value="regular">
                        <label for="regular-delivery" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">🚚 Regular</div>
                                    <div class="option-price">Rp5.000</div>
                                </div>
                                <div class="option-description">Estimasi 2-4 jam</div>
                            </div>
                        </label>
                    </div>

                    <div class="shipping-option">
                        <input type="radio" id="economy" name="modal_shipping_option" value="economy">
                        <label for="economy" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">💰 Hemat</div>
                                    <div class="option-price">Rp2.000</div>
                                </div>
                                <div class="option-description">Estimasi 3-6 jam</div>
                            </div>
                        </label>
                    </div>
                </div>
                <button class="konfirmasi-btn" id="confirm-shipping">Konfirmasi</button>
            </div>
        </div>
    </div>

    <script>
        // GLOBAL VARIABLES
        let cartItems = [];
        let currentOrderId = null;

        // UTILITY FUNCTIONS
        function formatPrice(price) {
            return "Rp " + price.toLocaleString('id-ID');
        }

        function generateOrderId() {
            const timestamp = new Date().getTime();
            const random = Math.floor(Math.random() * 1000);
            return `ORD${timestamp}${random}`;
        }

        function validateFields(fields) {
            for (const field of fields) {
                const el = document.getElementById(field.id);
                if (!el || !el.value.trim()) {
                    alert(field.message);
                    el?.focus();
                    return false;
                }
            }
            return true;
        }

        // CART AND ITEM FUNCTIONS
        function renderCheckoutItems() {
            const checkoutContainer = document.getElementById('checkout-items');
            cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            checkoutContainer.innerHTML = '';

            cartItems.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = 'order-item';
                itemElement.innerHTML = `
                    <img src="${item.image}" alt="${item.nama_produk}" class="item-image">
                    <div class="item-details">
                        <div class="item-name">${item.nama_produk || 'Nama tidak tersedia'}</div>
                        <div class="item-price">
                            ${formatPrice(item.price)} x ${item.quantity}
                        </div>
                    </div>
                    <button class="remove-item" onclick="removeItem(${item.id})">×</button>
                `;
                checkoutContainer.appendChild(itemElement);
            });
            
            updateTotals();
        }

        function updateTotals() {
            cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            // Update subtotal display
            document.getElementById('subtotal').textContent = formatPrice(subtotal);

            // Get selected shipping option cost
            const selectedShipping = document.querySelector('input[name="shipping_option"]:checked');
            const shippingCosts = {
                'self': 0,
                'instant': 10000,
                'regular': 5000,
                'economy': 2000
            };

            const shippingCost = selectedShipping ? shippingCosts[selectedShipping.value] : 0;

            // Update shipping cost display
            const shippingDisplay = document.querySelector('.summary-item:nth-child(2) span:last-child');
            shippingDisplay.textContent = shippingCost ? formatPrice(shippingCost) : '-';

            // Calculate and update total
            const total = subtotal + shippingCost;
            document.getElementById('total').textContent = formatPrice(total);

            // Save total to localStorage
            localStorage.setItem('orderTotal', total.toString());
        }

        window.removeItem = function(itemId) {
            const index = cartItems.findIndex(item => item.id === itemId);
            if (index !== -1) {
                cartItems.splice(index, 1);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                renderCheckoutItems();
            }
        }

        // SHIPPING MODAL FUNCTIONS
        function updateShippingDisplay(option) {
            const mainShippingOptions = document.querySelector('.shipping-options');
            const shippingCostSpan = document.querySelector('.summary-item:nth-child(2) span:last-child');
            const totalSpan = document.getElementById('total');

            if (!option) {
                mainShippingOptions.innerHTML = `
                    <div class="shipping-option">
                        <div class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-description">
                                    <div>Silakan pilih opsi pengiriman</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                shippingCostSpan.textContent = '-';
                const subtotal = parseFloat(document.getElementById('subtotal').textContent.replace(/[^0-9]/g, ''));
                totalSpan.textContent = formatPrice(subtotal);
                return;
            }

            cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const totalQuantity = cartItems.reduce((sum, item) => sum + item.quantity, 0);

            const shippingOptions = {
                'self': {
                    title: 'Ambil Sendiri',
                    price: 0,
                    icon: '🏪',
                    description: () => 'Ambil Pesanan mu di outlet kami'
                },
                'instant': {
                    title: 'Garansi Tepat Waktu',
                    price: 10000,
                    icon: '⚡',
                    description: () => {
                        if (totalQuantity <= 5) return 'Garansi tiba dalam 30-45 menit';
                        if (totalQuantity <= 10) return 'Garansi tiba dalam 45-60 menit';
                        return 'Estimasi tiba dalam 5 Jam';
                    }
                },
                'regular': {
                    title: 'Regular',
                    price: 5000,
                    icon: '🚚',
                    description: () => {
                        if (totalQuantity <= 20) return 'Estimasi tiba: 2-3 jam';
                        if (totalQuantity <= 50) return 'Estimasi tiba: 3-4 jam';
                        return 'Estimasi tiba: 4-5 jam';
                    }
                },
                'economy': {
                    title: 'Hemat',
                    price: 2000,
                    icon: '💰',
                    description: () => {
                        if (totalQuantity <= 20) return 'Estimasi tiba: 3-4 jam';
                        if (totalQuantity <= 50) return 'Estimasi tiba: 4-6 jam';
                        return 'Estimasi tiba: 5-7 jam';
                    }
                }
            };

            const selectedOption = shippingOptions[option];

            mainShippingOptions.innerHTML = `
                <div class="shipping-option">
                    <input type="radio" id="selected-delivery" name="shipping_option" value="${option}" checked>
                    <label for="selected-delivery" class="shipping-option-label">
                        <div class="option-content">
                            <div class="option-header">
                                <div class="option-title">
                                    <span class="delivery-icon">${selectedOption.icon}</span>
                                    ${selectedOption.title}
                                </div>
                                <div class="option-price">${formatPrice(selectedOption.price)}</div>
                            </div>
                            <div class="option-description">
                                <div>${selectedOption.description()}</div>
                                ${totalQuantity > 50 ? '<div class="quantity-notice">* Pesanan dalam jumlah besar memerlukan waktu lebih lama</div>' : ''}
                            </div>
                        </div>
                    </label>
                </div>
            `;

            const subtotal = parseFloat(document.getElementById('subtotal').textContent.replace(/[^0-9]/g, ''));
            shippingCostSpan.textContent = formatPrice(selectedOption.price);
            const newTotal = subtotal + selectedOption.price;
            totalSpan.textContent = formatPrice(newTotal);

            checkFormCompletion();
        }

        function showShippingModal() {
            const modal = document.getElementById('shippingModal');
            modal.style.display = 'block';
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
        }

        function closeShippingModal() {
            const modal = document.getElementById('shippingModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        function confirmShippingOption() {
            const selectedOption = document.querySelector('input[name="modal_shipping_option"]:checked');
            if (selectedOption) {
                updateShippingDisplay(selectedOption.value);
                closeShippingModal();
            } else {
                alert('Silakan pilih opsi pengiriman');
            }
        }

        // PAYMENT MODAL FUNCTIONS
        function showPaymentModal(e) {
            e.preventDefault();

            // Check if shipping is selected
            const selectedShipping = document.querySelector('input[name="shipping_option"]:checked');
            if (!selectedShipping) {
                alert('Silakan pilih opsi pengiriman terlebih dahulu');
                return;
            }

            // Generate unique order ID
            const orderId = generateOrderId();
            currentOrderId = orderId;

            // Set expiry time to 24 hours from now
            const expiryTime = new Date(Date.now() + 24 * 60 * 60 * 1000);

            const modal = document.createElement('div');
            modal.className = 'payment-modal';
            modal.id = 'paymentModal';
            modal.innerHTML = `
                <div class="payment-modal-content">
                    <div class="modal-header">
                        <h3>Metode Pembayaran</h3>
                        <span class="close" id="close-payment-modal">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="order-info">
                            <div class="order-row">
                                <span>Order ID</span>
                                <span>${orderId}</span>
                            </div>
                            <div class="order-row">
                                <span>Batas Waktu Pembayaran</span>
                                <span class="countdown">23:59:59</span>
                            </div>
                        </div>
                        <div class="payment-options">
                            <div class="payment-option">
                                <input type="radio" id="bca" name="payment_method" value="bca">
                                <label for="bca">
                                    <img src="{{ asset('assets/kartubca.png') }}" alt="BCA">
                                    <span>BCA Virtual Account</span>
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio" id="dana" name="payment_method" value="dana">
                                <label for="dana">
                                    <img src="{{ asset('assets/dana.png') }}" alt="DANA">
                                    <span>Dana</span>
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio" id="gopay" name="payment_method" value="gopay">
                                <label for="gopay">
                                    <img src="{{ asset('assets/gopay.png') }}" alt="Gopay">
                                    <span>Gopay</span>
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio" id="cod" name="payment_method" value="cod">
                                <label for="cod">
                                    <img src="{{ asset('assets/cod.png') }}" alt="COD">
                                    <span>COD</span>
                                </label>
                            </div>
                        </div>
                        <button class="konfirmasi-btn" id="confirm-payment">Konfirmasi</button>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('show'), 10);

            // Add event listeners for payment methods
            const paymentOptions = modal.querySelectorAll('input[name="payment_method"]');
            paymentOptions.forEach(option => {
                option.addEventListener('change', function() {
                    localStorage.setItem('selectedPaymentMethod', this.value);
                    checkFormCompletion();
                });
            });

            // Store order data
            const orderData = {
                id: orderId,
                expiryTime: expiryTime.toISOString(),
                status: 'pending'
            };
            localStorage.setItem('currentOrder', JSON.stringify(orderData));

            // Start countdown
            startCountdown(expiryTime);
            localStorage.setItem('currentOrderId', orderId);

            // Close button handler
            document.getElementById('close-payment-modal').addEventListener('click', () => {
                closePaymentModal();
            });

            // Confirm button handler
            document.getElementById('confirm-payment').addEventListener('click', () => {
                confirmPaymentMethod(orderId);
            });

            // Close on outside click
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closePaymentModal();
                }
            });
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            if (modal) {
                modal.classList.remove('show');
                setTimeout(() => modal.remove(), 300);
            }
        }

        function confirmPaymentMethod(orderId) {
            const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
            if (!selectedPayment) {
                alert('Silakan pilih metode pembayaran');
                return;
            }

            // Update the payment method display
            const paymentTypeDisplay = document.getElementById('selected-payment');
            const paymentLabels = {
                'bca': 'BCA Virtual Account',
                'dana': 'Dana',
                'gopay': 'Gopay',
                'cod': 'COD'
            };
            paymentTypeDisplay.textContent = paymentLabels[selectedPayment.value];

            // Store payment method
            localStorage.setItem('selectedPaymentMethod', selectedPayment.value);

            // Close modal
            closePaymentModal();
            
            // Update form completion status
            checkFormCompletion();
        }

        // COUNTDOWN AND ORDER FUNCTIONS
        function startCountdown(expiryTime) {
            const countdownElement = document.querySelector('.countdown');
            if (!countdownElement) return;

            const timer = setInterval(() => {
                const now = new Date().getTime();
                const target = new Date(expiryTime).getTime();
                const distance = target - now;

                if (distance <= 0) {
                    clearInterval(timer);
                    countdownElement.textContent = "Waktu Habis";
                    countdownElement.style.color = "#e74c3c";
                    cancelOrder();
                    return;
                }

                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownElement.textContent =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }, 1000);

            return timer;
        }

        function cancelOrder() {
            const orderData = JSON.parse(localStorage.getItem('currentOrder'));
            if (!orderData) return;

            fetch('{{ route('orders.cancel') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    order_id: orderData.id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    localStorage.removeItem('currentOrder');
                    localStorage.removeItem('selectedPaymentMethod');
                    alert('Pesanan dibatalkan karena melebihi batas waktu pembayaran');
                    window.location.href = '/keranjang';
                }
            })
            .catch(error => {
                console.error('Error cancelling order:', error);
            });
        }

        function determineOrderCategory(cartItems) {
            const nasiBoxItems = cartItems.some(item => 
                item.nama_produk?.toLowerCase().includes('nasi box')
            );
            const prasmananItems = cartItems.some(item => 
                item.nama_produk?.toLowerCase().includes('prasmanan')
            );

            if (nasiBoxItems && prasmananItems) return 'Nasi Box & Prasmanan';
            if (nasiBoxItems) return 'Nasi Box';
            if (prasmananItems) return 'Prasmanan';
            return 'Lainnya';
        }

        function submitOrder(e) {
            e.preventDefault();
            
            // Show loading state
            const submitBtn = document.getElementById('submit-order');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Memproses...';

            // Validasi keranjang
            cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            if (!cartItems.length) {
                alert('Keranjang belanja kosong');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Buat Pesanan';
                return;
            }

            // Validasi form
            const isValid = validateFields([
                { id: 'delivery-date', message: 'Tanggal pengiriman wajib diisi.' },
                { id: 'delivery-time', message: 'Waktu pengiriman wajib diisi.' },
                { id: 'address', message: 'Alamat pengiriman wajib diisi.' },
                { id: 'phone', message: 'Nomor telepon wajib diisi.' }
            ]);
            
            if (!isValid) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Buat Pesanan';
                return;
            }

            // Validasi opsi pengiriman
            const shippingOptionElement = document.querySelector('input[name="shipping_option"]:checked');
            if (!shippingOptionElement) {
                alert('Silakan pilih opsi pengiriman.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Buat Pesanan';
                return;
            }

            // Validasi metode pembayaran
            const selectedPayment = localStorage.getItem('selectedPaymentMethod');
            if (!selectedPayment) {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Buat Pesanan';
                return;
            }

            const userName = document.getElementById('user-name').value;

            // Siapkan data pesanan
            const orderData = {
                order_id: currentOrderId || generateOrderId(),
                nama_pelanggan: userName,
                kategori_pesanan: determineOrderCategory(cartItems),
                tanggal_pesanan: new Date().toISOString().split('T')[0],
                jumlah_pesanan: cartItems.reduce((sum, item) => sum + item.quantity, 0),
                tanggal_pengiriman: document.getElementById('delivery-date').value,
                waktu_pengiriman: document.getElementById('delivery-time').value,
                lokasi_pengiriman: document.getElementById('address').value,
                nomor_telepon: document.getElementById('phone').value,
                pesan: document.getElementById('notes').value || null,
                opsi_pengiriman: shippingOptionElement.value,
                total_harga: parseFloat(document.getElementById('total').textContent.replace(/[^\d]/g, '')),
                status_pengiriman: 'diproses',
                status_pembayaran: 'pending',
                items: cartItems
            };

            // Kirim pesanan ke server
            fetch('{{ route('checkout.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(orderData)
            })
            .then(async response => {
                const text = await response.text();
                
                if (!response.ok) {
                    if (response.status === 500) {
                        throw new Error('Server error. Silakan coba lagi atau hubungi admin.');
                    } else if (response.status === 422) {
                        const errorData = JSON.parse(text);
                        throw new Error('Data tidak valid: ' + JSON.stringify(errorData.errors));
                    } else {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                }
                
                return JSON.parse(text);
            })
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message || 'Gagal membuat pesanan');
                }
                
                // Success handling
                localStorage.removeItem('cartItems');
                alert('Pesanan berhasil dibuat!');
                
                // FIX: Redirect ke route yang benar
                window.location.href = `/payment/metodepembayaran/${selectedPayment}`;
            })
            .catch(error => {
                console.error('Detailed error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Buat Pesanan';
            });
        }

        function checkFormCompletion() {
            const requiredFields = [
                'delivery-date',
                'delivery-time',
                'address',
                'phone'
            ];

            // Cek apakah semua field terisi
            const allFieldsFilled = requiredFields.every(fieldId => {
                const field = document.getElementById(fieldId);
                return field && field.value.trim() !== '';
            });

            // Cek opsi pengiriman dipilih
            const shippingSelected = document.querySelector('input[name="shipping_option"]:checked');
            // Cek metode pembayaran dipilih
            const paymentSelected = localStorage.getItem('selectedPaymentMethod');

            const submitButton = document.getElementById('submit-order');
            if (submitButton) {
                submitButton.disabled = !(allFieldsFilled && shippingSelected && paymentSelected);
            }
        }

        // PHONE VALIDATION
        function setupPhoneValidation() {
            const phoneInput = document.getElementById('phone');
            if (!phoneInput) return;

            phoneInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/(?!^\+)\D/g, '');

                if (this.value.length > 13) {
                    this.value = this.value.slice(0, 13);
                }

                const phoneRegex = /^(?:(?:\+62|62)|0)(?:8[1-9][0-9]{8,10})$/;
                const cleanNumber = this.value;

                let errorMessage = '';

                if (cleanNumber.length < 10) {
                    errorMessage = 'Nomor telepon terlalu pendek (minimal 10 digit)';
                } else if (cleanNumber.length > 13) {
                    errorMessage = 'Nomor telepon terlalu panjang (maksimal 13 digit)';
                } else if (!phoneRegex.test(cleanNumber)) {
                    errorMessage = 'Format nomor telepon tidak valid. Gunakan format: 08xx, +62xx, atau 62xx';
                }

                if (errorMessage) {
                    this.setCustomValidity(errorMessage);
                    this.style.borderColor = '#e74c3c';
                } else {
                    this.setCustomValidity('');
                    this.style.borderColor = '#2ecc71';
                }

                checkFormCompletion();
            });

            phoneInput.addEventListener('keypress', function(e) {
                const char = String.fromCharCode(e.keyCode);
                if (!/[\d+]/.test(char) || (char === '+' && this.value.length > 0)) {
                    e.preventDefault();
                }
            });
        }

        // DATE VALIDATION
        function setupDateValidation() {
            const deliveryDateInput = document.getElementById('delivery-date');
            const deliveryTimeInput = document.getElementById('delivery-time');

            if (deliveryDateInput) {
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                const maxDate = new Date();
                maxDate.setDate(maxDate.getDate() + 30);

                deliveryDateInput.min = tomorrow.toISOString().split('T')[0];
                deliveryDateInput.max = maxDate.toISOString().split('T')[0];

                deliveryDateInput.addEventListener('change', function() {
                    const selectedDate = new Date(this.value);
                    const today = new Date();
                    const dayOfWeek = selectedDate.getDay();

                    if (dayOfWeek === 0) {
                        alert('Maaf, kami tidak melayani pengiriman di hari Minggu.');
                        this.value = '';
                        return;
                    }

                    if (selectedDate <= today) {
                        alert('Pemesanan harus dilakukan minimal H-1 (1 hari sebelum pengiriman).');
                        this.value = '';
                        return;
                    }

                    const thirtyDaysFromNow = new Date();
                    thirtyDaysFromNow.setDate(thirtyDaysFromNow.getDate() + 30);
                    if (selectedDate > thirtyDaysFromNow) {
                        alert('Pemesanan hanya dapat dilakukan maksimal 30 hari ke depan.');
                        this.value = '';
                        return;
                    }

                    checkFormCompletion();
                });
            }

            if (deliveryTimeInput) {
                deliveryTimeInput.addEventListener('change', function() {
                    const selectedTime = this.value;
                    const [hours, minutes] = selectedTime.split(':').map(Number);

                    if (hours < 8 || hours > 20) {
                        alert('Waktu pengiriman hanya tersedia antara jam 08:00 - 20:00');
                        this.value = '';
                        return;
                    }

                    checkFormCompletion();
                });
            }
        }

        // MAIN INITIALIZATION
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize page elements
            renderCheckoutItems();
            setupPhoneValidation();
            setupDateValidation();

            // Shipping modal event listeners
            const seeAllShipping = document.getElementById('see-all-shipping');
            const closeShippingBtn = document.getElementById('close-shipping-modal');
            const confirmShippingBtn = document.getElementById('confirm-shipping');

            if (seeAllShipping) {
                seeAllShipping.addEventListener('click', function(e) {
                    e.preventDefault();
                    showShippingModal();
                });
            }

            if (closeShippingBtn) {
                closeShippingBtn.addEventListener('click', closeShippingModal);
            }

            if (confirmShippingBtn) {
                confirmShippingBtn.addEventListener('click', confirmShippingOption);
            }

            // Payment modal event listener
            const paymentMethodLink = document.getElementById('payment-method-link');
            if (paymentMethodLink) {
                paymentMethodLink.addEventListener('click', showPaymentModal);
            }

            // Submit order event listener
            const submitBtn = document.getElementById('submit-order');
            if (submitBtn) {
                submitBtn.addEventListener('click', submitOrder);
            }

            // Form field change listeners
            const formFields = document.querySelectorAll('input, textarea');
            formFields.forEach(field => {
                field.addEventListener('change', checkFormCompletion);
                field.addEventListener('input', checkFormCompletion);
            });

            // Close modal on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const shippingModal = document.getElementById('shippingModal');
                    const paymentModal = document.getElementById('paymentModal');
                    
                    if (shippingModal && shippingModal.classList.contains('show')) {
                        closeShippingModal();
                    }
                    if (paymentModal && paymentModal.classList.contains('show')) {
                        closePaymentModal();
                    }
                }
            });

            // Close modal on outside click
            const shippingModal = document.getElementById('shippingModal');
            if (shippingModal) {
                shippingModal.addEventListener('click', function(e) {
                    if (e.target === shippingModal) {
                        closeShippingModal();
                    }
                });
            }

            // Initial form completion check
            checkFormCompletion();
        });
    </script>

</body>
</html>