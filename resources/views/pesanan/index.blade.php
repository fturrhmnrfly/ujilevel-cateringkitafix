<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita User - Pesanan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 80px;
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar Styles */
        nav.navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c2c77;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
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

        .navbar .nav-links li {
            display: inline-block;
        }

        .navbar .nav-links li a {
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
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

        /* Tab Navigation */
        .container {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        .tab-navigation {
            display: flex;
            justify-content: center;
            background-color: #27276e;
            padding: 10px 20px;
            width: 100%;
            margin-top: 30px;
        }

        .tab-btn {
            flex: 1;
            padding: 12px 20px;
            text-align: center;
            background-color: #fff;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            margin: 0 5px;
            border-radius: 8px;
            color: black;
            text-decoration: none;
        }

        .tab-btn:first-child {
            margin-left: 0;
        }

        .tab-btn:last-child {
            margin-right: 0;
        }

        .tab-btn.active {
            background-color: #ffffff;
            color: #27276e;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .tab-btn:hover:not(.active) {
            background-color: #3a3a8c;
            color: white;
        }

        /* Order Card Styles */
        .order-card {
            max-width: 650px;
            margin: 20px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.1);
            padding: 25px;
            overflow: hidden;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .order-header-left h3 {
            margin: 0;
            font-size: 16px;
            font-weight: normal;
            color: #333;
        }

        .order-header-left p {
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        .order-id {
            color: #333;
            font-weight: 500;
        }

        .order-date {
            color: #666;
        }

        /* Status Badge Colors */
        .status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 500;
        }

        /* Status pembayaran pending */
        .status-badge.pending {
            background: #FFE7E7;
            color: #FF4C4C;
        }

        /* Status pengiriman */
        .status-badge.diproses {
            background: #FFF3CD;
            color: #856404;
        }

        .status-badge.dikirim {
            background: #E7F5FF;
            color: #0077CC;
        }

        .status-badge.diterima {
            background: #d1e7dd;
            color: #198754;
        }

        .status-badge.dibatalkan {
            background: #f8d7da;
            color: #721c24;
        }

        /* Order Items */
        .order-item {
            background: #FFFFFF;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
        }

        .item-image {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .item-quantity {
            color: #666;
            margin: 3px 0;
            font-size: 12px;
        }

        .item-price {
            text-align: right;
            font-size: 14px;
            color: #333;
        }

        .order-divider {
            height: 1px;
            background: #eee;
            margin: 20px 0;
        }

        /* Order Summary */
        .order-summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-label {
            color: #666;
            font-size: 14px;
        }

        .summary-value {
            color: #333;
            font-size: 14px;
        }

        .summary-row-total {
            font-weight: 500;
        }

        /* Order Info Styles */
        .order-info {
            margin-bottom: 20px;
        }

        .order-info p {
            margin: 8px 0;
            font-size: 14px;
            color: #555;
        }

        .order-info p strong {
            color: #333;
            margin-right: 8px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-detail {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: white;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-detail:hover {
            background: #f8f9fa;
        }

        .btn-pay {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: #FF4C4C;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-pay:hover {
            background: #dc3545;
        }

        .btn-accept {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: #28a745;
            color: white;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-accept:hover {
            background: #218838;
        }

        .btn-reorder {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: #007bff;
            color: white;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-reorder:hover {
            background: #0056b3;
        }

        .btn-review {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: #ffc107;
            color: #212529;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-review:hover {
            background: #e0a800;
        }

        .btn-single {
            width: 100%;
            text-align: center;
            padding: 12px;
            background: #27276e;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-single:hover {
            background: #1f1f5c;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #666;
        }

        .empty-state img {
            max-width: 150px;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .empty-state p {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .empty-state .btn-single {
            display: inline-block;
            padding: 12px 30px;
            width: auto;
        }

        /* Status Payment Colors */
        .status-payment.pending {
            color: #dc3545;
            font-weight: 600;
        }

        .status-payment.paid {
            color: #198754;
            font-weight: 600;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            background: white;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            border-radius: 12px;
            overflow: hidden;
            animation: slideIn 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
        }

        .modal-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #e9ecef;
            color: #333;
        }

        .modal-body {
            padding: 25px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 500;
            color: #666;
            flex: 1;
        }

        .detail-value {
            color: #333;
            text-align: right;
            flex: 1;
            font-weight: 500;
        }

        .status-indicator {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-indicator.pending {
            background: #FFE7E7;
            color: #FF4C4C;
        }

        .status-indicator.diproses {
            background: #FFF3CD;
            color: #856404;
        }

        .status-indicator.dikirim {
            background: #E7F5FF;
            color: #0077CC;
        }

        .status-indicator.diterima {
            background: #d1e7dd;
            color: #198754;
        }

        .modal-actions {
            padding: 20px 25px;
            border-top: 1px solid #eee;
            background: #f8f9fa;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-modal {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Loading State */
        .btn-loading {
            opacity: 0.7;
            cursor: not-allowed;
            position: relative;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modal-content {
                margin: 10px;
                max-height: 95vh;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-detail, .btn-pay, .btn-accept, .btn-reorder, .btn-review {
                flex: none;
            }
        }

        /* Debug styles - COMMENTED OUT */
        /*
        .debug-status {
            background: #f8f9fa;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 12px;
            border-left: 4px solid #007bff;
        }
        */
    </style>
</head>
<body>
<x-navbar></x-navbar>

<div class="container">
    <!-- Debug info - COMMENTED OUT -->
    {{-- 
    @if(config('app.debug'))
        <div style="background: #f0f0f0; padding: 10px; margin: 20px auto; max-width: 650px; border-radius: 5px; font-size: 12px;">
            <strong>🐛 Debug Info:</strong><br>
            User: {{ Auth::user()->name }}<br>
            Route: {{ Route::currentRouteName() }}<br>
            Current Tab: {{ request()->routeIs('pesanan.unpaid') ? 'BELUM BAYAR (payment-based)' : 'DELIVERY STATUS BASED' }}<br>
            Total Orders: {{ isset($orders) ? count($orders) : 0 }}<br>
            @if(isset($orders) && count($orders) > 0)
                Orders Status: 
                @foreach($orders as $order)
                    [{{ $order->order_id }}: {{ $order->status_pembayaran }}/{{ $order->status_pengiriman }}]
                @endforeach
            @endif
            <br>
            <a href="{{ route('pesanan.debug') }}" style="color: blue;">View Full Debug</a>
        </div>
    @endif
    --}}

    <div class="tab-navigation">
        <a href="{{ route('pesanan.index') }}" class="tab-btn {{ request()->routeIs('pesanan.index') ? 'active' : '' }}">Semua Pesanan</a>
        <a href="{{ route('pesanan.unpaid') }}" class="tab-btn {{ request()->routeIs('pesanan.unpaid') ? 'active' : '' }}">Belum Bayar</a>
        <a href="{{ route('pesanan.process') }}" class="tab-btn {{ request()->routeIs('pesanan.process') ? 'active' : '' }}">Diproses</a>
        <a href="{{ route('pesanan.shipped') }}" class="tab-btn {{ request()->routeIs('pesanan.shipped') ? 'active' : '' }}">Dikirim</a>
        <a href="{{ route('pesanan.completed') }}" class="tab-btn {{ request()->routeIs('pesanan.completed') ? 'active' : '' }}">Selesai</a>
        <a href="{{ route('pesanan.penilaian') }}" class="tab-btn {{ request()->routeIs('pesanan.penilaian') ? 'active' : '' }}">Penilaian</a>
    </div>

    @if(isset($orders) && count($orders) > 0)
        @foreach($orders as $order)
        @php
            // Logic: Tentukan status berdasarkan tab yang dipilih
            $currentRoute = request()->route()->getName();
            $isUnpaidTab = $currentRoute === 'pesanan.unpaid';
            
            // Jika tab "Belum Bayar" -> gunakan status_pembayaran
            // Jika tab lainnya -> gunakan status_pengiriman
            if ($isUnpaidTab) {
                $displayStatus = 'Belum Bayar';
                $badgeClass = 'pending';
                $usePaymentStatus = true;
            } else {
                // Untuk tab lainnya, gunakan status_pengiriman
                switch($order->status_pengiriman) {
                    case 'diproses':
                        $displayStatus = 'Diproses';
                        $badgeClass = 'diproses';
                        break;
                    case 'dikirim':
                        $displayStatus = 'Dikirim';
                        $badgeClass = 'dikirim';
                        break;
                    case 'diterima':
                        $displayStatus = 'Diterima';
                        $badgeClass = 'diterima';
                        break;
                    case 'dibatalkan':
                        $displayStatus = 'Dibatalkan';
                        $badgeClass = 'dibatalkan';
                        break;
                    default:
                        $displayStatus = ucfirst($order->status_pengiriman);
                        $badgeClass = strtolower($order->status_pengiriman);
                }
                $usePaymentStatus = false;
            }
        @endphp
        
        <div class="order-card" data-order-id="{{ $order->id }}" data-order-status="{{ $order->status_pengiriman }}">
            
            {{-- Debug info - COMMENTED OUT
            @if(config('app.debug'))
                <div class="debug-status">
                    <strong>Debug Order {{ $order->order_id }}:</strong><br>
                    - Current Route: {{ $currentRoute }}<br>
                    - Is Unpaid Tab: {{ $isUnpaidTab ? 'YES' : 'NO' }}<br>
                    - Use Payment Status: {{ $usePaymentStatus ? 'YES' : 'NO' }}<br>
                    - status_pembayaran: {{ $order->status_pembayaran }}<br>
                    - status_pengiriman: {{ $order->status_pengiriman }}<br>
                    - Display Status: {{ $displayStatus }}<br>
                    - Badge Class: {{ $badgeClass }}
                </div>
            @endif
            --}}
            
            <!-- Header dengan Order ID dan Status -->
            <div class="order-header">
                <div class="order-header-left">
                    <h3>Order ID</h3>
                    <p class="order-id">{{ $order->order_id }}</p>
                    <p class="order-date">Tanggal Pemesanan: {{ $order->created_at->format('d F Y') }}</p>
                </div>
                <span class="status-badge {{ $badgeClass }}">
                    {{ $displayStatus }}
                </span>
            </div>

            <!-- Order Info -->
            <div class="order-info">
                <p><strong>Kategori:</strong> {{ $order->kategori_pesanan }}</p>
                <p><strong>Jumlah:</strong> {{ $order->jumlah_pesanan }} porsi</p>
                <p><strong>Pengiriman:</strong> {{ $order->tanggal_pengiriman->format('d F Y') }}</p>
                <p><strong>Waktu:</strong> {{ $order->waktu_pengiriman }}</p>
                <p><strong>Alamat:</strong> {{ $order->lokasi_pengiriman }}</p>
                <p><strong>No. Telepon:</strong> {{ $order->nomor_telepon }}</p>
                @if($order->pesan)
                    <p><strong>Pesan:</strong> {{ $order->pesan }}</p>
                @endif
            </div>

            <div class="order-divider"></div>

            <!-- Order Summary -->
            <div class="order-summary-row">
                <span class="summary-label">Opsi Pengiriman</span>
                <span class="summary-value">{{ ucfirst($order->opsi_pengiriman) }}</span>
            </div>
            <div class="order-summary-row summary-row-total">
                <span class="summary-label">Total Harga</span>
                <span class="summary-value">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="order-summary-row">
                <span class="summary-label">Status Pembayaran</span>
                <span class="summary-value status-payment {{ $order->status_pembayaran }}">
                    {{ $order->status_pembayaran == 'pending' ? 'Belum Bayar' : 'Sudah Bayar' }}
                </span>
            </div>

            <!-- Dynamic Action Buttons Based on Status -->
            <div class="action-buttons">
                @if($isUnpaidTab)
                    {{-- Jika di tab "Belum Bayar" - gunakan logic payment status --}}
                    <button class="btn-detail" onclick="showOrderDetail({{ $order->id }})">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </button>
                    <button class="btn-pay" onclick="redirectToPayment('{{ $order->order_id }}')">
                        <i class="fas fa-credit-card"></i> Bayar Sekarang
                    </button>
                @else
                    {{-- Untuk tab lainnya - gunakan logic delivery status --}}
                    @if($order->status_pengiriman == 'diproses')
                        <!-- Status: Diproses -->
                        <button class="btn-single" onclick="showOrderDetail({{ $order->id }})">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </button>
                    @elseif($order->status_pengiriman == 'dikirim')
                        <!-- Status: Dikirim -->
                        <button class="btn-detail" onclick="showOrderDetail({{ $order->id }})">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </button>
                        <button class="btn-accept" onclick="acceptOrder({{ $order->id }})">
                            <i class="fas fa-check"></i> Terima Pesanan
                        </button>
                    @elseif($order->status_pengiriman == 'diterima')
                        <!-- Status: Diterima -->
                        <button class="btn-reorder" onclick="reorderItems({{ $order->id }})">
                            <i class="fas fa-redo"></i> Beli Lagi
                        </button>
                        <button class="btn-review" onclick="showReviewModal({{ $order->id }})">
                            <i class="fas fa-star"></i> Beri Ulasan
                        </button>
                    @else
                        <!-- Status lainnya (dibatalkan, dll.) -->
                        <button class="btn-single" onclick="showOrderDetail({{ $order->id }})">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </button>
                    @endif
                @endif
            </div>
        </div>
        @endforeach
    @else
        <div class="empty-state">
            <img src="{{ asset('assets/empty-order.png') }}" alt="Tidak ada pesanan">
            <h3>Belum Ada Pesanan</h3>
            <p>Anda belum memiliki pesanan. Silahkan pesan makanan terlebih dahulu.</p>
            <a href="{{ route('dashboard') }}" class="btn-single">
                Pesan Sekarang
            </a>
        </div>
    @endif
</div>

<!-- Modal Detail Pesanan -->
<div id="orderDetailModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Detail Pesanan</h3>
            <button class="modal-close" onclick="closeModal('orderDetailModal')">&times;</button>
        </div>
        
        <div class="modal-body">
            <div class="detail-row">
                <span class="detail-label">Order ID</span>
                <span class="detail-value" id="modal-order-id">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal Pemesanan</span>
                <span class="detail-value" id="modal-order-date">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status Pesanan</span>
                <span class="detail-value">
                    <span class="status-indicator" id="modal-order-status">-</span>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Kategori Pesanan</span>
                <span class="detail-value" id="modal-kategori">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Jumlah Pesanan</span>
                <span class="detail-value" id="modal-jumlah">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal Pengiriman</span>
                <span class="detail-value" id="modal-delivery-date">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Waktu Pengiriman</span>
                <span class="detail-value" id="modal-delivery-time">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Alamat Pengiriman</span>
                <span class="detail-value" id="modal-address">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Nomor Telepon</span>
                <span class="detail-value" id="modal-phone">-</span>
            </div>
            <div class="detail-row" id="modal-message-row" style="display: none;">
                <span class="detail-label">Pesan</span>
                <span class="detail-value" id="modal-message">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Opsi Pengiriman</span>
                <span class="detail-value" id="modal-shipping">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Harga</span>
                <span class="detail-value" id="modal-total" style="font-weight: bold; color: #28a745;">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status Pembayaran</span>
                <span class="detail-value">
                    <span class="status-indicator" id="modal-payment-status">-</span>
                </span>
            </div>
        </div>

        <div class="modal-actions">
            <button class="btn-modal btn-secondary" onclick="closeModal('orderDetailModal')">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Terima Pesanan -->
<div id="acceptOrderModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Terima Pesanan</h3>
            <button class="modal-close" onclick="closeModal('acceptOrderModal')">&times;</button>
        </div>
        
        <div class="modal-body">
            <p style="margin: 0; font-size: 16px; color: #333; text-align: center;">
                Apakah Anda yakin telah menerima pesanan ini dengan baik?
            </p>
            <p style="margin: 10px 0 0 0; font-size: 14px; color: #666; text-align: center;">
                Setelah dikonfirmasi, status pesanan akan berubah menjadi "Diterima".
            </p>
        </div>

        <div class="modal-actions">
            <button class="btn-modal btn-secondary" onclick="closeModal('acceptOrderModal')">
                Batal
            </button>
            <button class="btn-modal btn-success" id="confirmAcceptBtn" onclick="confirmAcceptOrder()">
                Ya, Terima Pesanan
            </button>
        </div>
    </div>
</div>

<script>
    // Global variables
    let currentOrderId = null;
    let ordersData = @json($orders ?? []);

    /**
     * Show order detail modal
     */
    function showOrderDetail(orderId) {
        const order = ordersData.find(o => o.id === orderId);
        if (!order) {
            alert('Data pesanan tidak ditemukan');
            return;
        }

        // Fill modal data
        document.getElementById('modal-order-id').textContent = order.order_id;
        document.getElementById('modal-order-date').textContent = formatDate(order.created_at);
        
        // Set status badge - prioritas delivery status kecuali untuk unpaid
        const statusElement = document.getElementById('modal-order-status');
        const paymentStatus = order.status_pembayaran;
        const deliveryStatus = order.status_pengiriman;
        const isUnpaidContext = paymentStatus === 'pending';
        
        if (isUnpaidContext) {
            statusElement.textContent = 'Belum Bayar';
            statusElement.className = 'status-indicator pending';
        } else {
            statusElement.textContent = capitalizeFirst(deliveryStatus);
            statusElement.className = `status-indicator ${deliveryStatus}`;
        }

        document.getElementById('modal-kategori').textContent = order.kategori_pesanan;
        document.getElementById('modal-jumlah').textContent = order.jumlah_pesanan + ' porsi';
        document.getElementById('modal-delivery-date').textContent = formatDate(order.tanggal_pengiriman);
        document.getElementById('modal-delivery-time').textContent = order.waktu_pengiriman;
        document.getElementById('modal-address').textContent = order.lokasi_pengiriman;
        document.getElementById('modal-phone').textContent = order.nomor_telepon;
        
        // Handle message (optional field)
        const messageRow = document.getElementById('modal-message-row');
        if (order.pesan) {
            document.getElementById('modal-message').textContent = order.pesan;
            messageRow.style.display = 'flex';
        } else {
            messageRow.style.display = 'none';
        }

        document.getElementById('modal-shipping').textContent = capitalizeFirst(order.opsi_pengiriman);
        document.getElementById('modal-total').textContent = formatCurrency(order.total_harga);
        
        // Set payment status
        const paymentStatusElement = document.getElementById('modal-payment-status');
        if (paymentStatus === 'pending') {
            paymentStatusElement.textContent = 'Belum Bayar';
            paymentStatusElement.className = 'status-indicator pending';
        } else {
            paymentStatusElement.textContent = 'Sudah Bayar';
            paymentStatusElement.className = 'status-indicator diterima';
        }

        // Show modal
        document.getElementById('orderDetailModal').classList.add('show');
    }

    /**
     * Accept order function
     */
    function acceptOrder(orderId) {
        currentOrderId = orderId;
        document.getElementById('acceptOrderModal').classList.add('show');
    }

    /**
     * Confirm accept order
     */
    function confirmAcceptOrder() {
        if (!currentOrderId) return;

        const confirmBtn = document.getElementById('confirmAcceptBtn');
        confirmBtn.disabled = true;
        confirmBtn.classList.add('btn-loading');
        confirmBtn.textContent = 'Memproses...';

        // Send request to update order status
        fetch(`{{ route('pesanan.accept', '') }}/${currentOrderId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update UI
                updateOrderCardStatus(currentOrderId, 'diterima');
                closeModal('acceptOrderModal');
                showSuccessMessage('Pesanan berhasil diterima!');
                
                // Refresh page after delay
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                throw new Error(data.message || 'Gagal memperbarui status pesanan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorMessage('Terjadi kesalahan: ' + error.message);
        })
        .finally(() => {
            confirmBtn.disabled = false;
            confirmBtn.classList.remove('btn-loading');
            confirmBtn.textContent = 'Ya, Terima Pesanan';
        });
    }

    /**
     * Redirect to payment
     */
    function redirectToPayment(orderId) {
        // Redirect to payment page
        window.location.href = `/payment/metodepembayaran/${orderId}`;
    }

    /**
     * Reorder items
     */
    function reorderItems(orderId) {
        const order = ordersData.find(o => o.id === orderId);
        if (!order) {
            alert('Data pesanan tidak ditemukan');
            return;
        }

        // Implement reorder logic - redirect to menu or add to cart
        if (confirm('Apakah Anda ingin memesan kembali item yang sama?')) {
            // Here you can implement the reorder logic
            // For now, redirect to dashboard
            window.location.href = '{{ route("dashboard") }}';
        }
    }

    /**
     * Show review modal
     */
    function showReviewModal(orderId) {
        // For now, just alert - you can implement full review modal later
        alert('Fitur ulasan akan segera hadir!');
    }

    /**
     * Update order card status in UI
     */
    function updateOrderCardStatus(orderId, newStatus) {
        const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
        if (!orderCard) return;

        // Update status badge
        const statusBadge = orderCard.querySelector('.status-badge');
        if (statusBadge) {
            statusBadge.className = `status-badge ${newStatus}`;
            statusBadge.textContent = capitalizeFirst(newStatus);
        }

        // Update action buttons
        const actionButtons = orderCard.querySelector('.action-buttons');
        if (actionButtons && newStatus === 'diterima') {
            actionButtons.innerHTML = `
                <button class="btn-reorder" onclick="reorderItems(${orderId})">
                    <i class="fas fa-redo"></i> Beli Lagi
                </button>
                <button class="btn-review" onclick="showReviewModal(${orderId})">
                    <i class="fas fa-star"></i> Beri Ulasan
                </button>
            `;
        }

        // Update data attribute
        orderCard.setAttribute('data-order-status', newStatus);
    }

    /**
     * Close modal
     */
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
        currentOrderId = null;
    }

    /**
     * Show success message
     */
    function showSuccessMessage(message) {
        const successDiv = document.createElement('div');
        successDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            z-index: 3000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        `;
        successDiv.textContent = message;
        document.body.appendChild(successDiv);

        setTimeout(() => {
            successDiv.remove();
        }, 3000);
    }

    /**
     * Show error message
     */
    function showErrorMessage(message) {
        const errorDiv = document.createElement('div');
        errorDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            z-index: 3000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        `;
        errorDiv.textContent = message;
        document.body.appendChild(errorDiv);

        setTimeout(() => {
            errorDiv.remove();
        }, 4000);
    }

    /**
     * Utility functions
     */
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    function capitalizeFirst(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    /**
     * Event Listeners
     */
    document.addEventListener('DOMContentLoaded', function() {
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modals = ['orderDetailModal', 'acceptOrderModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal('orderDetailModal');
                closeModal('acceptOrderModal');
            }
        });
    });
</script>

</body>
</html>