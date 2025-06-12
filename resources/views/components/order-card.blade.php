{{-- filepath: resources/views/components/order-card.blade.php --}}
@php
    $currentRoute = request()->route()->getName();
    $isUnpaidTab = $currentRoute === 'pesanan.unpaid';
    
    // ✅ LOGIC BARU UNTUK BADGE STATUS PENGIRIMAN ✅
    if ($order->status_pembayaran === 'pending') {
        // Jika status pembayaran pending, tampilkan "Pending"
        $displayStatus = 'Pending';
        $badgeClass = 'pending';
    } else {
        // Jika status pembayaran selain pending, tampilkan status pengiriman asli
        $statusMap = [
            'diproses' => ['Diproses', 'diproses'],
            'dikirim' => ['Dikirim', 'dikirim'],
            'diterima' => ['Diterima', 'diterima'],
            'dibatalkan' => ['Dibatalkan', 'dibatalkan']
        ];
        [$displayStatus, $badgeClass] = $statusMap[$order->status_pengiriman] ?? [ucfirst($order->status_pengiriman), strtolower($order->status_pengiriman)];
    }
    
    // ✅ OVERRIDE KHUSUS UNTUK TAB UNPAID ✅
    if ($isUnpaidTab) {
        $displayStatus = 'Belum Bayar';
        $badgeClass = 'pending';
    }
    
    // Check apakah order sudah direview
    $hasReview = $order->hasReviewByUser(auth()->id());
    
    // PERBAIKI PERHITUNGAN SUBTOTAL
    $subtotal = 0;
    $biayaPengiriman = 0;
    
    // Hitung subtotal berdasarkan item yang ada
    if ($order->items && $order->items->count() > 0) {
        // Jika ada relasi items, hitung dari items
        $subtotal = $order->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
    } elseif ($order->kelolaMakanan) {
        // Jika ada relasi dengan KelolaMakanan
        $subtotal = $order->kelolaMakanan->harga * $order->jumlah_pesanan;
    } else {
        // Fallback: gunakan total_harga dan estimasi biaya pengiriman
        // Mapping biaya pengiriman berdasarkan opsi_pengiriman
        $shippingCosts = [
            'self' => 0,
            'instant' => 10000,
            'regular' => 5000,
            'economy' => 2000
        ];
        
        $biayaPengiriman = $shippingCosts[$order->opsi_pengiriman] ?? 3000;
        $subtotal = $order->total_harga - $biayaPengiriman;
        
        // Pastikan subtotal tidak negatif
        if ($subtotal < 0) {
            $subtotal = $order->total_harga;
            $biayaPengiriman = 0;
        }
    }
    
    // Jika biaya pengiriman belum dihitung, hitung berdasarkan opsi pengiriman
    if ($biayaPengiriman == 0 && $order->opsi_pengiriman) {
        $shippingCosts = [
            'self' => 0,
            'instant' => 10000,
            'regular' => 5000,
            'economy' => 2000
        ];
        $biayaPengiriman = $shippingCosts[$order->opsi_pengiriman] ?? 3000;
    }
@endphp

<div class="order-card-new" data-order-id="{{ $order->id }}" data-order-status="{{ $order->status_pengiriman }}" data-has-review="{{ $hasReview ? 'true' : 'false' }}">
    <!-- Header Section -->
    <div class="order-header-new">
        <div class="order-id-section">
            <span class="order-label">Order ID</span>
            <span class="order-id-value">{{ $order->order_id }}</span>
        </div>
        {{-- ✅ BADGE DENGAN LOGIC BARU ✅ --}}
        <div class="status-badge-new {{ $badgeClass }}">{{ $displayStatus }}</div>
    </div>
    
    <div class="order-date-new">
        Tanggal Pemesanan: {{ $order->created_at->format('d F Y') }}
    </div>

    <!-- Order Items Section -->
    <div class="order-items-section">
        @if($order->items && $order->items->count() > 0)
            {{-- Jika ada relasi items --}}
            @foreach($order->items as $item)
                <div class="order-item-new">
                    <div class="item-image-container">
                        <img src="{{ $item->product ? asset('storage/' . $item->product->image) : asset('assets/default-food.png') }}" 
                             alt="{{ $item->product ? $item->product->nama_produk : 'Product' }}" 
                             class="item-image-new">
                    </div>
                    <div class="item-details-new">
                        <h4 class="item-name-new">{{ $item->product ? $item->product->nama_produk : 'Product tidak ditemukan' }}</h4>
                        <p class="item-description">{{ $item->product ? Str::limit($item->product->deskripsi, 50) : '' }}</p>
                        <p class="item-quantity-new">x {{ $item->quantity }}</p>
                    </div>
                    <div class="item-price-new">
                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach
        @elseif($order->kelolaMakanan)
            {{-- Jika ada relasi dengan KelolaMakanan --}}
            <div class="order-item-new">
                <div class="item-image-container">
                    <img src="{{ $order->kelolaMakanan->image ? asset('storage/' . $order->kelolaMakanan->image) : asset('assets/default-food.png') }}" 
                         alt="{{ $order->kelolaMakanan->nama_makanan }}" 
                         class="item-image-new">
                </div>
                <div class="item-details-new">
                    <h4 class="item-name-new">{{ $order->kelolaMakanan->nama_makanan }}</h4>
                    <p class="item-description">{{ Str::limit($order->kelolaMakanan->deskripsi, 50) }}</p>
                    <p class="item-quantity-new">x {{ $order->jumlah_pesanan }}</p>
                </div>
                <div class="item-price-new">
                    Rp {{ number_format($order->kelolaMakanan->harga * $order->jumlah_pesanan, 0, ',', '.') }}
                </div>
            </div>
        @else
            {{-- Fallback jika tidak ada relasi --}}
            <div class="order-item-new">
                <div class="item-image-container">
                    <img src="{{ asset('assets/default-food.png') }}" alt="Default" class="item-image-new">
                </div>
                <div class="item-details-new">
                    <h4 class="item-name-new">{{ $order->kategori_pesanan }}</h4>
                    <p class="item-description">Pesanan katering</p>
                    <p class="item-quantity-new">x {{ $order->jumlah_pesanan }}</p>
                </div>
                <div class="item-price-new">
                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Summary Section - PERHITUNGAN YANG DIPERBAIKI -->
    <div class="order-summary-new">
        <div class="summary-row-new">
            <span>Subtotal</span>
            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row-new">
            <span>Biaya Pengiriman</span>
            <span>Rp {{ number_format($biayaPengiriman, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row-new total-row">
            <span>Total</span>
            <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Delivery Info -->
    <div class="delivery-info-new">
        <i class="far fa-calendar delivery-icon-new"></i>
        <span>Pengiriman dijadwalkan: {{ $order->tanggal_pengiriman->format('d F Y') }}, {{ $order->waktu_pengiriman }}</span>
    </div>

    <!-- TAMBAHKAN INFORMASI PEMBATALAN -->
    @if($order->status_pengiriman === 'dibatalkan' && $order->catatan_pembatalan)
        <div class="cancellation-info-new">
            <i class="fas fa-exclamation-triangle cancellation-icon-new"></i>
            <div class="cancellation-content-new">
                <div class="cancellation-title-new">Alasan Pembatalan:</div>
                <div class="cancellation-reason-new">{{ $order->catatan_pembatalan }}</div>
                @if($order->cancelled_at)
                    <div class="cancellation-date-new">
                        Dibatalkan pada: {{ $order->cancelled_at->format('d F Y, H:i') }}
                    </div>
                @endif
                @if($order->cancelled_by_name)
                    <div class="cancellation-by-new">
                        Dibatalkan oleh: {{ $order->cancelled_by_name }}
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="action-buttons-new">
        @if($isUnpaidTab)
            <button class="btn-detail-new" onclick="showOrderDetail({{ $order->id }})">
                <i class="fas fa-eye"></i> Lihat Detail
            </button>
        @else
            {{-- ✅ UPDATE KONDISI ACTION BUTTONS BERDASARKAN STATUS PEMBAYARAN ✅ --}}
            @if($order->status_pembayaran === 'pending')
                {{-- Jika pembayaran pending, hanya tampilkan detail --}}
                <button class="btn-detail-new" onclick="showOrderDetail({{ $order->id }})">
                    <i class="fas fa-eye"></i> Lihat Detail
                </button>
                <button class="btn-payment-pending" disabled>
                    <i class="fas fa-clock"></i> Menunggu Konfirmasi
                </button>
            @elseif($order->status_pengiriman == 'diproses')
                <button class="btn-detail-new" onclick="showOrderDetail({{ $order->id }})">
                    <i class="fas fa-eye"></i> Lihat Detail
                </button>
                <button class="btn-cancel-new" onclick="showCancelOrderModal({{ $order->id }})">
                    <i class="fas fa-times"></i> Batalkan Pesanan
                </button>
            @elseif($order->status_pengiriman == 'dikirim')
                <button class="btn-accept-new" onclick="acceptOrder({{ $order->id }})">
                    <i class="fas fa-check"></i> Terima Pesanan
                </button>
            @elseif($order->status_pengiriman == 'diterima')
                <button class="btn-reorder-new" onclick="reorderItems({{ $order->id }})">
                    <i class="fas fa-redo"></i> Beli Lagi
                </button>
                @if($hasReview)
                    <button class="btn-reviewed-new" disabled>
                        <i class="fas fa-star"></i> Sudah Diulas
                    </button>
                @else
                    <button class="btn-review-new" onclick="showReviewModal({{ $order->id }})">
                        <i class="fas fa-star"></i> Beri Ulasan
                    </button>
                @endif
            @elseif($order->status_pengiriman == 'dibatalkan')
                <button class="btn-reorder-new" onclick="reorderItems({{ $order->id }})">
                    <i class="fas fa-redo"></i> Pesan Lagi
                </button>
            @else
                <button class="btn-detail-full" onclick="showOrderDetail({{ $order->id }})">
                    <i class="fas fa-eye"></i> Lihat Detail
                </button>
            @endif
        @endif
    </div>
</div>

<!-- Style -->
<style>
/* New Order Card Styles - Matching the image */
.order-card-new {
    max-width: 500px;
    margin: 20px auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.order-header-new {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 8px;
}

.order-id-section {
    display: flex;
    flex-direction: column;
}

.order-label {
    font-size: 14px;
    color: #666;
    margin-bottom: 2px;
}

.order-id-value {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.status-badge-new {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.status-badge-new.pending { background: #fff3cd; color: #856404; }
.status-badge-new.diproses { background: #fff3cd; color: #856404; }
.status-badge-new.dikirim { background: #cce5ff; color: #0066cc; }
.status-badge-new.diterima { background: #d4edda; color: #155724; }
.status-badge-new.dibatalkan { 
    background: #f8d7da; 
    color: #721c24; 
    border: 1px solid #f5c6cb;
}

.order-date-new {
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
}

.order-items-section {
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.order-item-new {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f5f5f5;
}

.order-item-new:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.item-image-container {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 12px;
    flex-shrink: 0;
}

.item-image-new {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-details-new {
    flex: 1;
    margin-right: 12px;
}

.item-name-new {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    margin: 0 0 4px 0;
}

.item-description {
    font-size: 12px;
    color: #666;
    margin: 0 0 4px 0;
}

.item-quantity-new {
    font-size: 12px;
    color: #999;
    margin: 0;
}

.item-price-new {
    font-size: 14px;
    font-weight: 600;
    color: #333;
}

.order-summary-new {
    margin-bottom: 15px;
}

.summary-row-new {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 14px;
}

.summary-row-new span:first-child {
    color: #666;
}

.summary-row-new span:last-child {
    color: #333;
}

.total-row {
    font-weight: 600;
    border-top: 1px solid #eee;
    padding-top: 8px;
}

.delivery-info-new {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 13px;
    color: #666;
}

.delivery-icon-new {
    margin-right: 8px;
    color: #999;
}

/* STYLE UNTUK INFORMASI PEMBATALAN */
.cancellation-info-new {
    display: flex;
    align-items: flex-start;
    background: #fff5f5;
    border: 1px solid #fed7d7;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 13px;
}

.cancellation-icon-new {
    color: #e53e3e;
    margin-right: 10px;
    margin-top: 2px;
    flex-shrink: 0;
}

.cancellation-content-new {
    flex: 1;
}

.cancellation-title-new {
    font-weight: 600;
    color: #721c24;
    margin-bottom: 4px;
}

.cancellation-reason-new {
    color: #721c24;
    margin-bottom: 8px;
    line-height: 1.4;
}

.cancellation-date-new,
.cancellation-by-new {
    font-size: 11px;
    color: #a0a0a0;
    margin-bottom: 2px;
}

.action-buttons-new {
    display: flex;
    gap: 10px;
}

.btn-detail-new, .btn-detail-full, .btn-accept-new, 
.btn-reorder-new, .btn-review-new, .btn-reviewed-new, .btn-cancel-new {
    flex: 1;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.btn-detail-new, .btn-detail-full {
    background: white;
    color: #333;
    border: 1px solid #ddd;
}

.btn-detail-new:hover, .btn-detail-full:hover {
    background: #f8f9fa;
}

.btn-accept-new {
    background: #27276e;
    color: white;
}

.btn-accept-new:hover {
    background: #1f1f5c;
}

.btn-reorder-new, .btn-review-new {
    background: #27276e;
    color: white;
}

.btn-reorder-new:hover, .btn-review-new:hover {
    background: #1f1f5c;
}

.btn-reviewed-new {
    background: #6c757d;
    color: white;
    cursor: not-allowed;
    opacity: 0.7;
}

/* STYLE UNTUK BUTTON BATALKAN PESANAN */
.btn-cancel-new {
    background: #dc3545;
    color: white;
}

.btn-cancel-new:hover {
    background: #c82333;
}

/* ✅ TAMBAHAN STYLE UNTUK BUTTON MENUNGGU PEMBAYARAN ✅ */
.btn-payment-pending {
    background: #ffc107 !important;
    color: #000 !important;
    cursor: not-allowed !important;
    opacity: 0.8 !important;
}

.btn-payment-pending:hover {
    background: #ffc107 !important;
    color: #000 !important;
}

/* Responsive */
@media (max-width: 768px) {
    .order-card-new {
        margin: 10px;
        padding: 15px;
    }
    
    .action-buttons-new {
        flex-direction: column;
    }
    
    .btn-detail-new, .btn-detail-full, .btn-accept-new, 
    .btn-reorder-new, .btn-review-new, .btn-cancel-new {
        width: 100%;
    }
    
    .cancellation-info-new {
        padding: 10px;
        font-size: 12px;
    }
    
    .cancellation-date-new,
    .cancellation-by-new {
        font-size: 10px;
    }
}
</style>

{{-- Add this script at the bottom of the component --}}
<script>
// Pass order data to JavaScript for modal display
window.orderData = window.orderData || {};
window.orderData[{{ $order->id }}] = {
    id: {{ $order->id }},
    order_id: '{{ $order->order_id }}',
    created_at: '{{ $order->created_at->format('Y-m-d H:i:s') }}',
    tanggal_pesanan: '{{ $order->tanggal_pesanan->format('Y-m-d H:i:s') }}',
    tanggal_pengiriman: '{{ $order->tanggal_pengiriman->format('Y-m-d') }}',
    waktu_pengiriman: '{{ $order->waktu_pengiriman }}',
    status_pengiriman: '{{ $order->status_pengiriman }}',
    status_pembayaran: '{{ $order->status_pembayaran ?? "pending" }}',
    kategori_pesanan: '{{ $order->kategori_pesanan }}',
    jumlah_pesanan: {{ $order->jumlah_pesanan }},
    lokasi_pengiriman: '{{ addslashes($order->lokasi_pengiriman) }}',
    nomor_telepon: '{{ $order->nomor_telepon }}',
    opsi_pengiriman: '{{ $order->opsi_pengiriman }}',
    total_harga: {{ $order->total_harga }},
    pesan: '{{ addslashes($order->pesan ?? "") }}',
    // TAMBAHKAN DATA PEMBATALAN
    catatan_pembatalan: '{{ addslashes($order->catatan_pembatalan ?? "") }}',
    cancelled_at: '{{ $order->cancelled_at ? $order->cancelled_at->format('Y-m-d H:i:s') : "" }}',
    cancelled_by: {{ $order->cancelled_by ?? 'null' }},
    cancelled_by_type: '{{ $order->cancelled_by_type ?? "" }}',
    cancelled_by_name: '{{ addslashes($order->cancelled_by_name ?? "") }}'
};

// Debug log dengan lebih detail
console.log('=== ORDER CARD REGISTRATION ===');
console.log('Order ID {{ $order->id }} registered successfully');
console.log('Data:', window.orderData[{{ $order->id }}]);
console.log('Total orders in window.orderData:', Object.keys(window.orderData).length);
console.log('================================');
</script>