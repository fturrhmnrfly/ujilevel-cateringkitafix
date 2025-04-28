<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Catering Kita</title>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .back-button {
            text-decoration: none;
            color: #333;
            display: inline-block;
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
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            position: relative;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .item-price {
            color: #666;
            font-size: 14px;
        }

        .item-quantity {
            color: #666;
            font-size: 14px;
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
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            color: #2c3e50;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .order-summary {
            margin-top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #666;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #eee;
            font-weight: bold;
            color: #2c3e50;
        }

        .checkout-button {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #4e73f8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

        .checkout-button:hover {
            background-color: #3558d6;
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
            margin-bottom: 15px;
            position: relative;
        }

        .shipping-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .shipping-option-label {
            display: block;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .shipping-option input[type="radio"]:checked+.shipping-option-label {
            border-color: #4e73f8;
            background-color: #f0f7ff;
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
            margin-bottom: 15px;
        }

        .shipping-option-label {
            display: block;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .shipping-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .shipping-option input[type="radio"]:checked+.shipping-option-label {
            border-color: #0066FF;
            background-color: #F5F9FF;
        }

        .option-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .option-title {
            font-weight: 500;
        }

        .option-description {
            color: #666;
            font-size: 13px;
        }

        .option-description small {
            display: block;
            line-height: 1.4;
        }

        .delivery-estimate {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .delivery-icon {
            font-size: 20px;
        }

        /* Add/update these styles */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .see-all {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .see-all::after {
            content: '→';
        }

        .shipping-options {
            background: #fff;
            border-radius: 12px;
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

        /* Add these styles */
        .payment-modal .modal-content {
            max-width: 450px;
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
            margin-bottom: 10px;
            color: #666;
            font-size: 14px;
        }

        .countdown {
            color: #f0ad4e;
            font-weight: 500;
        }

        .payment-options {
            margin-bottom: 20px;
        }

        .payment-options h4 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }

        .payment-option {
            margin-bottom: 12px;
        }

        .payment-option input[type="radio"] {
            display: none;
        }

        .payment-option label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option label img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .payment-option input[type="radio"]:checked+label {
            border-color: #2c2c77;
            background-color: #f8f9ff;
        }

        /* Animation styles */
        .payment-modal {
            animation: fadeIn 0.3s ease;
        }

        .payment-modal .modal-content {
            animation: slideIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translate(-50%, -60%);
                opacity: 0;
            }

            to {
                transform: translate(-50%, -50%);
                opacity: 1;
            }
        }

        /* Add these styles to your existing CSS */
        .payment-summary {
            margin-top: 30px;
            background: white;
            border-radius: 12px;
            padding: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            color: #333;
        }

        .summary-row:not(:last-child) {
            margin-bottom: 8px;
        }

        .summary-row.total {
            border-top: 1px solid #eee;
            margin-top: 12px;
            padding-top: 12px;
            font-weight: 600;
            font-size: 16px;
        }

        .summary-label {
            color: #666;
        }

        .summary-value {
            font-weight: 500;
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
                        <a href="#" class="see-all">Lihat Semua</a>
                    </div>

                    <div class="shipping-options">
                        <!-- This content will be dynamically updated by JavaScript -->
                    </div>
                </div>

                <div class="order-section">
                    <div class="payment-option-section">
                        <a href="#" class="payment-method-link" onclick="showPaymentModal(event)">
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
    </div>
    <div class="modal" id="shippingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pilih Jasa Pengiriman</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="shipping-options-modal">
                    <div class="shipping-option">
                        <input type="radio" id="self-pickup" name="shipping_option" value="self">
                        <label for="self-pickup" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">Ambil Sendiri</div>
                                    <div class="option-price">Rp0</div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="shipping-option">
                        <input type="radio" id="instant-delivery" name="shipping_option" value="instant">
                        <label for="instant-delivery" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">Garansi Tepat Waktu</div>
                                    <div class="option-price">Rp10.000</div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="shipping-option">
                        <input type="radio" id="regular-delivery" name="shipping_option" value="regular">
                        <label for="regular-delivery" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">Regular</div>
                                    <div class="option-price">Rp5.000</div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="shipping-option">
                        <input type="radio" id="economy" name="shipping_option" value="economy">
                        <label for="economy" class="shipping-option-label">
                            <div class="option-content">
                                <div class="option-header">
                                    <div class="option-title">Hemat</div>
                                    <div class="option-price">Rp2.000</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <button class="konfirmasi-btn" onclick="confirmShippingOption()">Konfirmasi</button>
            </div>
        </div>
    </div>
    <script>
        // Letakkan di dalam file checkout.js atau dalam tag <script> di halaman checkout
        document.addEventListener('DOMContentLoaded', function() {
            const checkoutForm = document.getElementById('checkoutForm');

            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Kumpulkan data formulir
                    const formData = new FormData(checkoutForm);
                    const orderData = {
                        address: formData.get('address'),
                        phone: formData.get('phone'),
                        notes: formData.get('notes'),
                        deliveryDate: formData.get('delivery_date'),
                        deliveryTime: formData.get('delivery_time'),
                        total: formData.get('total'),
                        items: JSON.parse(formData.get('items') || '[]')
                    };

                    // Kirim data pesanan ke server
                    fetch('/orders', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify(orderData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Arahkan ke halaman pesanan jika berhasil
                                window.location.href = data.redirect;
                            } else {
                                // Tampilkan pesan error
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memproses pesanan');
                        });
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Get cart items from localStorage
            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

            // Function to format price in Rupiah
            function formatPrice(price) {
                return "Rp " + price.toLocaleString('id-ID');
            }

            // Function to render checkout items
            function renderCheckoutItems() {
                const checkoutContainer = document.getElementById('checkout-items');
                checkoutContainer.innerHTML = '';

                cartItems.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'order-item';
                    itemElement.innerHTML = `
                        <img src="${item.image}" alt="${item.name}" class="item-image">
                        <div class="item-details">
                            <div class="item-name">${item.name}</div>
                            <div class="item-price">${formatPrice(item.price)} x ${item.quantity}</div>
                        </div>
                        <button class="remove-item" onclick="removeItem(${item.id})">×</button>
                    `;
                    checkoutContainer.appendChild(itemElement);
                });

                updateTotals();
            }

            // Function to update totals
            function updateTotals() {
                const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

                // Update subtotal display
                document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;

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
                shippingDisplay.textContent = shippingCost ? `Rp ${shippingCost.toLocaleString('id-ID')}` : '-';

                // Calculate and update total
                const total = subtotal + shippingCost;
                document.getElementById('total').textContent = `Rp ${total.toLocaleString('id-ID')}`;

                // Save total to localStorage
                localStorage.setItem('orderTotal', total.toString());
            }

            // Panggil updateTotals saat:
            // 1. Halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                renderCheckoutItems();
                updateTotals();
            });

            // 2. Saat opsi pengiriman berubah
            document.querySelectorAll('input[name="shipping_option"]').forEach(option => {
                option.addEventListener('change', updateTotals);
            });

            // 3. Update fungsi confirmShippingOption
            function confirmShippingOption() {
                const selectedOption = document.querySelector(
                '.shipping-options-modal input[type="radio"]:checked');
                if (selectedOption) {
                    updateShippingDisplay(selectedOption.value);
                    updateTotals(); // Tambahkan ini
                    closeModal();
                } else {
                    alert('Silakan pilih opsi pengiriman');
                }
            }

            // Function to remove item
            window.removeItem = function(itemId) {
                const index = cartItems.findIndex(item => item.id === itemId);
                if (index !== -1) {
                    cartItems.splice(index, 1);
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    renderCheckoutItems();
                }
            }

            // Handle form submission
            document.getElementById('shipping-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const orderData = {
                    items: cartItems,
                    deliveryDate: document.getElementById('delivery-date').value,
                    deliveryTime: document.getElementById('delivery-time').value,
                    address: document.getElementById('address').value,
                    phone: document.getElementById('phone').value,
                    notes: document.getElementById('notes').value,
                    subtotal: cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0),
                    shipping: 20000,
                    total: cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0) +
                        20000
                };

                // Here you would typically send the order data to your backend
                console.log('Order Data:', orderData);

                // Clear cart and redirect to payment page
                localStorage.removeItem('cartItems');
                alert('Redirecting to payment page...');
                // window.location.href = 'payment.html';
            });

            // Initial render
            renderCheckoutItems();
        });
        // Replace the form submission handler in your checkout page
        document.getElementById('shipping-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Kumpulkan data dari form
            const orderData = {
                address: document.getElementById('address').value,
                phone: document.getElementById('phone').value,
                notes: document.getElementById('notes').value,
                deliveryDate: document.getElementById('delivery-date').value,
                deliveryTime: document.getElementById('delivery-time').value,
                total: cartTotal,
                items: cartItems.map(item => ({
                    id: item.id,
                    quantity: item.quantity,
                    price: item.price
                }))
            };

            // Kirim data ke server
            fetch('{{ route('orders.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        localStorage.removeItem('cartItems');
                        window.location.href = `/payment/${data.order_id}`;
                    }
                });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const deliveryDateInput = document.getElementById('delivery-date');
            const deliveryTimeInput = document.getElementById('delivery-time');

            // Set minimum and maximum dates
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 30);

            // Format dates for input min/max attributes
            deliveryDateInput.min = tomorrow.toISOString().split('T')[0];
            deliveryDateInput.max = maxDate.toISOString().split('T')[0];

            // Validate selected date
            deliveryDateInput.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const today = new Date();
                const dayOfWeek = selectedDate.getDay();

                // Check if selected date is a valid business day
                if (dayOfWeek === 0) { // Sunday
                    alert('Maaf, kami tidak melayani pengiriman di hari Minggu.');
                    this.value = '';
                    return;
                }

                // Check if it's at least next day
                if (selectedDate <= today) {
                    alert('Pemesanan harus dilakukan minimal H-1 (1 hari sebelum pengiriman).');
                    this.value = '';
                    return;
                }

                // Check if within 30 days
                const thirtyDaysFromNow = new Date();
                thirtyDaysFromNow.setDate(thirtyDaysFromNow.getDate() + 30);
                if (selectedDate > thirtyDaysFromNow) {
                    alert('Pemesanan hanya dapat dilakukan maksimal 30 hari ke depan.');
                    this.value = '';
                    return;
                }
            });

            // Validate delivery time
            deliveryTimeInput.addEventListener('change', function() {
                const selectedTime = this.value;
                const [hours, minutes] = selectedTime.split(':').map(Number);

                // Restrict delivery hours (example: 8 AM - 8 PM)
                if (hours < 8 || hours > 20) {
                    alert('Waktu pengiriman hanya tersedia antara jam 08:00 - 20:00');
                    this.value = '';
                    return;
                }
            });
        });
        // Add this to the existing script
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('phone');

            // Enhanced phone number validation
            phoneInput.addEventListener('input', function(e) {
                // Remove all non-numeric characters except + at the beginning
                this.value = this.value.replace(/(?!^\+)\D/g, '');

                // Limit the total length
                if (this.value.length > 13) {
                    this.value = this.value.slice(0, 13);
                }

                // Comprehensive validation for Indonesian phone numbers
                const phoneRegex = /^(?:(?:\+62|62)|0)(?:8[1-9][0-9]{8,10})$/;
                const cleanNumber = this.value;

                let errorMessage = '';

                // Series of validation checks
                if (cleanNumber.length < 10) {
                    errorMessage = 'Nomor telepon terlalu pendek (minimal 10 digit)';
                } else if (cleanNumber.length > 13) {
                    errorMessage = 'Nomor telepon terlalu panjang (maksimal 13 digit)';
                } else if (!phoneRegex.test(cleanNumber)) {
                    errorMessage =
                        'Format nomor telepon tidak valid. Gunakan format: 08xx, +62xx, atau 62xx';
                } else if (!/^(?:0|62|\\+62)8[1-9]/.test(cleanNumber)) {
                    errorMessage = 'Nomor telepon harus dimulai dengan 08, +628, atau 628';
                }

                // Additional validation for specific prefixes
                const prefix = cleanNumber.replace(/^(\+62|62|0)/, '').substring(0, 2);
                const validPrefixes = ['81', '82', '83', '85', '86', '87', '88', '89'];

                if (!validPrefixes.includes(prefix)) {
                    errorMessage = 'Prefix operator tidak valid';
                }

                // Visual feedback
                if (errorMessage) {
                    this.setCustomValidity(errorMessage);
                    this.style.borderColor = '#e74c3c';

                    // Show error message below input
                    let errorDiv = this.parentElement.querySelector('.error-message');
                    if (!errorDiv) {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message';
                        errorDiv.style.color = '#e74c3c';
                        errorDiv.style.fontSize = '12px';
                        errorDiv.style.marginTop = '5px';
                        this.parentElement.appendChild(errorDiv);
                    }
                    errorDiv.textContent = errorMessage;
                } else {
                    this.setCustomValidity('');
                    this.style.borderColor = '#2ecc71';

                    // Remove error message if exists
                    const errorDiv = this.parentElement.querySelector('.error-message');
                    if (errorDiv) {
                        errorDiv.remove();
                    }
                }
            });

            // Format phone number as user types
            phoneInput.addEventListener('blur', function() {
                if (!this.value) return;

                let formatted = this.value;
                // Remove all non-numeric characters
                formatted = formatted.replace(/\D/g, '');

                // Format based on number length and prefix
                if (formatted.startsWith('0')) {
                    formatted = formatted.replace(/^0/, '+62');
                } else if (formatted.startsWith('62')) {
                    formatted = '+' + formatted;
                } else if (!formatted.startsWith('+62')) {
                    formatted = '+62' + formatted;
                }

                // Add spaces for readability
                formatted = formatted.replace(/(\+62)(\d{3})(\d{4})(\d{3,4})/, '$1 $2 $3 $4');

                this.value = formatted;
            });

            // Prevent invalid input on keypress
            phoneInput.addEventListener('keypress', function(e) {
                const char = String.fromCharCode(e.keyCode);

                // Allow only numbers and + at the beginning
                if (!/[\d+]/.test(char) || (char === '+' && this.value.length > 0)) {
                    e.preventDefault();
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('shippingModal');
            const seeAllBtn = document.querySelector('.see-all');
            const closeBtn = document.querySelector('.close');
            const konfirmasiBtn = document.querySelector('.konfirmasi-btn');

            // Show modal when clicking "Lihat Semua"
            seeAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'block';
                setTimeout(() => {
                    modal.classList.add('show');
                }, 10);
            });

            // Close modal functions
            function closeModal() {
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }

            // Close when clicking X button
            closeBtn.addEventListener('click', closeModal);

            // Close when clicking outside modal
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Handle shipping option selection
            konfirmasiBtn.addEventListener('click', function() {
                const selectedOption = document.querySelector(
                    '.shipping-options-modal input[type="radio"]:checked');
                if (selectedOption) {
                    // Update the selected shipping option in the main form
                    const mainFormOption = document.querySelector(`#${selectedOption.id}`);
                    if (mainFormOption) {
                        mainFormOption.checked = true;
                    }
                    closeModal();
                } else {
                    alert('Silakan pilih opsi pengiriman');
                }
            });

            // Close modal when pressing Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('show')) {
                    closeModal();
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('shippingModal');
            const seeAllBtn = document.querySelector('.see-all');
            const closeBtn = document.querySelector('.close');
            const konfirmasiBtn = document.querySelector('.konfirmasi-btn');
            const mainShippingOptions = document.querySelector('.shipping-options');
            const shippingCostSpan = document.querySelector('.summary-item:nth-child(2) span:last-child');
            const totalSpan = document.getElementById('total');

            // Show modal when clicking "Lihat Semua"
            seeAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'block';
                setTimeout(() => {
                    modal.classList.add('show');
                }, 10);
            });

            // Close modal functions
            function closeModal() {
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }

            // Function to update shipping display
            function updateShippingDisplay(option) {
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
                    const subtotal = parseFloat(document.getElementById('subtotal').textContent.replace(/[^0-9]/g,
                        ''));
                    totalSpan.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                    return;
                }

                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);
                const dateOptions = {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long'
                };

                // Calculate total quantity from cart items
                const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                const totalQuantity = cartItems.reduce((sum, item) => sum + item.quantity, 0);

                const shippingOptions = {
                    'self': {
                        title: 'Ambil Sendiri',
                        price: 0,
                        icon: '🏪',
                        description: () => {
                            if (totalQuantity <= 10) {
                                return 'Ambil Pesanan mu di outlet kami';
                            } else {
                                return 'Ambil Pesanan mu di outlet kami';
                            }
                        }
                    },
                    'instant': {
                        title: 'Garansi Tepat Waktu',
                        price: 10000,
                        icon: '⚡',
                        description: () => {
                            if (totalQuantity <= 5) {
                                return 'Garansi tiba dalam 30-45 menit';
                            } else if (totalQuantity <= 10) {
                                return 'Garansi tiba dalam 45-60 menit';
                            } else {
                                return 'Estimasi tiba dalam 5 Jam';
                            }
                        }
                    },
                    'regular': {
                        title: 'Regular',
                        price: 5000,
                        icon: '🚚',
                        description: () => {
                            if (totalQuantity <= 20) {
                                return 'Estimasi tiba: 2-3 jam';
                            } else if (totalQuantity <= 50) {
                                return 'Estimasi tiba: 3-4 jam';
                            } else {
                                return 'Estimasi tiba: 4-5 jam';
                            }
                        }
                    },
                    'economy': {
                        title: 'Hemat',
                        price: 2000,
                        icon: '💰',
                        description: () => {
                            if (totalQuantity <= 20) {
                                return 'Estimasi tiba: 3-4 jam';
                            } else if (totalQuantity <= 50) {
                                return 'Estimasi tiba: 4-6 jam';
                            } else {
                                return 'Estimasi tiba: 5-7 jam';
                            }
                        }
                    }
                };

                const selectedOption = shippingOptions[option];

                // Update main display
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
                            <div class="option-price">Rp${selectedOption.price.toLocaleString('id-ID')}</div>
                        </div>
                        <div class="option-description">
                            <div>${selectedOption.description()}</div>
                            ${totalQuantity > 50 ? '<div class="quantity-notice">* Pesanan dalam jumlah besar memerlukan waktu lebih lama</div>' : ''}
                        </div>
                    </div>
                </label>
            </div>
        `;

                // Update shipping cost and total
                const subtotal = parseFloat(document.getElementById('subtotal').textContent.replace(/[^0-9]/g, ''));
                shippingCostSpan.textContent = `Rp ${selectedOption.price.toLocaleString('id-ID')}`;
                const newTotal = subtotal + selectedOption.price;
                totalSpan.textContent = `Rp ${newTotal.toLocaleString('id-ID')}`;
            }

            // Handle shipping option selection
            konfirmasiBtn.addEventListener('click', function() {
                const selectedOption = document.querySelector(
                    '.shipping-options-modal input[type="radio"]:checked');
                if (selectedOption) {
                    updateShippingDisplay(selectedOption.value);
                    closeModal();
                } else {
                    alert('Silakan pilih opsi pengiriman');
                }
            });

            // Close modal handlers
            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('show')) {
                    closeModal();
                }
            });
        });
        // Update the form submission validation
        document.querySelector('.btn-lanjutkan').addEventListener('click', function(e) {
            const selectedShipping = document.querySelector('input[name="shipping_option"]:checked');
            if (!selectedShipping) {
                e.preventDefault();
                alert('Selesaikan form checkout terlebih dahulu');
                return false;
            }
        });
        // Add this to your existing JavaScript
        document.querySelector('.payment-method-link').addEventListener('click', function(e) {
            // Validate if shipping is selected before proceeding to payment
            const selectedShipping = document.querySelector('input[name="shipping_option"]:checked');
            if (!selectedShipping) {
                e.preventDefault();
                alert('Silakan pilih opsi pengiriman terlebih dahulu');
                return false;
            }

            // Get shipping cost from the summary span instead
            const shippingCostText = document.querySelector('.summary-item:nth-child(2) span:last-child')
                .textContent;
            const shippingCost = parseFloat(shippingCostText.replace(/[^\d]/g, '') || '0');

            // Save shipping selection to session/local storage
            const shippingData = {
                option: selectedShipping.value,
                price: shippingCost,
                deliveryDate: document.getElementById('delivery-date').value,
                deliveryTime: document.getElementById('delivery-time').value
            };
            localStorage.setItem('shippingData', JSON.stringify(shippingData));
        });
        // Add this to your existing JavaScript
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

            // Set expiry time to 24 hours from now
            const expiryTime = new Date(Date.now() + 24 * 60 * 60 * 1000);

            const modal = document.createElement('div');
            modal.className = 'modal payment-modal';
            modal.innerHTML = `
        <div class="modal-content payment-modal-content">
            <div class="modal-header">
                <h3>Metode Pembayaran</h3>
                <span class="close">&times;</span>
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
                <button class="konfirmasi-btn" onclick="confirmPaymentMethod('${orderId}')">Konfirmasi</button>
            </div>
        </div>
    `;

            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('show'), 10);

            // Store order data in localStorage
            const orderData = {
                id: orderId,
                expiryTime: expiryTime.toISOString(),
                status: 'pending'
            };
            localStorage.setItem('currentOrder', JSON.stringify(orderData));

            // Start countdown
            startCountdown(expiryTime);

            // Store order ID in localStorage
            localStorage.setItem('currentOrderId', orderId);

            // Close button handler
            const closeBtn = modal.querySelector('.close');
            closeBtn.onclick = () => {
                modal.classList.remove('show');
                setTimeout(() => modal.remove(), 300);
            };

            // Close on outside click
            modal.onclick = (e) => {
                if (e.target === modal) {
                    closeBtn.onclick();
                }
            };
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
            const modal = document.querySelector('.payment-modal');
            modal.classList.remove('show');
            setTimeout(() => modal.remove(), 300);
        }

        // Add this function to generate order ID
        function generateOrderId() {
            const timestamp = new Date().getTime();
            const random = Math.floor(Math.random() * 1000);
            return `ORD${timestamp}${random}`;
        }

        function submitOrder(e) {
            e.preventDefault();

            const shippingData = {
                deliveryDate: document.getElementById('delivery-date').value,
                deliveryTime: document.getElementById('delivery-time').value,
                address: document.getElementById('address').value,
                phone: document.getElementById('phone').value
            };
            localStorage.setItem('shippingData', JSON.stringify(shippingData));

            const requiredFields = [{
                    id: 'delivery-date',
                    message: 'Tanggal pengiriman harus diisi'
                },
                {
                    id: 'delivery-time',
                    message: 'Waktu pengiriman harus diisi'
                },
                {
                    id: 'address',
                    message: 'Alamat harus diisi'
                },
                {
                    id: 'phone',
                    message: 'Nomor telepon harus diisi'
                }
            ];

            for (const field of requiredFields) {
                const el = document.getElementById(field.id);
                if (!el.value.trim()) {
                    alert(field.message);
                    el.focus();
                    return;
                }
            }

            const selectedShipping = document.querySelector('input[name="shipping_option"]:checked');
            const selectedPayment = localStorage.getItem('selectedPaymentMethod');
            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

            if (!selectedShipping || !selectedPayment) {
                alert('Silakan pilih opsi pengiriman dan metode pembayaran terlebih dahulu');
                return;
            }

            if (cartItems.length === 0) {
                alert('Keranjang kosong');
                return;
            }

            const formattedItems = cartItems.map(item => ({
                name: item.nama_produk, // ✅ diambil dari nama_produk
                price: parseFloat(item.price), // konversi karena awalnya string
                quantity: item.quantity,
                image: item.image
            }));


            const orderData = {
                items: formattedItems,
                shipping: {
                    method: selectedShipping.value,
                    address: document.getElementById('address').value,
                    phone: document.getElementById('phone').value,
                    notes: document.getElementById('notes').value,
                    delivery_date: document.getElementById('delivery-date').value,
                    delivery_time: document.getElementById('delivery-time').value
                },
                payment_method: localStorage.getItem('selectedPaymentMethod'), // Tambahkan payment method
                total: parseFloat(document.getElementById('total').textContent.replace(/[^\d]/g, '')),
                shipping_cost: parseFloat(document.querySelector('.summary-item:nth-child(2) span:last-child')
                    .textContent.replace(/[^\d]/g, '')) || 0,
                subtotal: parseFloat(document.getElementById('subtotal').textContent.replace(/[^\d]/g, ''))
            };

            // Validasi payment method
            if (!orderData.payment_method) {
                alert('Silakan pilih metode pembayaran terlebih dahulu');
                return;
            }

            fetch('{{ route('orders.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        handleOrderSuccess(data.order_id);
                    } else {
                        throw new Error(data.message || 'Gagal membuat pesanan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim pesanan: ' + error.message);
                });
        }


        function startCountdown(expiryTime) {
            const countdownElement = document.querySelector('.countdown');
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

                // Calculate hours, minutes, seconds
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Format time as HH:MM:SS
                countdownElement.textContent =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }, 1000);

            return timer;
        }

        function cancelOrder() {
            const orderData = JSON.parse(localStorage.getItem('currentOrder'));
            if (!orderData) return;

            // Send cancellation request to server
            fetch('{{ route('orders.cancel') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        order_id: orderData.id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Clear order data from localStorage
                        localStorage.removeItem('currentOrder');
                        localStorage.removeItem('selectedPaymentMethod');

                        // Show cancellation message
                        alert('Pesanan dibatalkan karena melebihi batas waktu pembayaran');

                        // Redirect to home/cart page
                        window.location.href = '/keranjang';
                    }
                })
                .catch(error => {
                    console.error('Error cancelling order:', error);
                });
        }

        window.addEventListener('DOMContentLoaded', () => {
            console.log("DOM selesai dimuat, event listener dipasang"); // LOG DEBUG
            const submitBtn = document.getElementById('submit-order');
            if (submitBtn) {
                console.log("Tombol ditemukan dan listener dipasang"); // LOG DEBUG
                submitBtn.addEventListener('click', submitOrder);
            } else {
                console.log("Tombol submit-order tidak ditemukan");
            }
        });

        function handleOrderSuccess(orderId) {
            // Hide submit button and show proceed button
            document.getElementById('submit-order').style.display = 'none';
            const proceedButton = document.getElementById('proceed-payment');
            proceedButton.style.display = 'block';

            // Store order ID
            localStorage.setItem('currentOrderId', orderId);

            // Add click handler for proceed button
            proceedButton.addEventListener('click', function() {
                const selectedPayment = localStorage.getItem('selectedPaymentMethod');
                if (!selectedPayment) {
                    alert('Silakan pilih metode pembayaran terlebih dahulu');
                    return;
                }

                // Redirect to payment confirmation page
                window.location.href = `{{ url('/metodepembayaran') }}/${selectedPayment}`;
            });
        }

        // Add this function to check form completion
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
            submitButton.disabled = !(allFieldsFilled && shippingSelected && paymentSelected);

            // Tambahkan log untuk debug
            console.log({
                allFieldsFilled,
                shippingSelected: !!shippingSelected,
                paymentSelected,
                buttonDisabled: submitButton.disabled
            });
        }

        // Add listeners to all form fields
        document.addEventListener('DOMContentLoaded', function() {
            const formFields = document.querySelectorAll('input, textarea');
            formFields.forEach(field => {
                field.addEventListener('change', checkFormCompletion);
                field.addEventListener('input', checkFormCompletion);
            });

            // Initial check
            checkFormCompletion();
        });

        // Saat memilih metode pembayaran COD
        document.querySelector('input[value="cod"]').addEventListener('change', function() {
            localStorage.setItem('selectedPaymentMethod', 'cod');
            checkFormCompletion();
        });
    </script>
</body>

</html>