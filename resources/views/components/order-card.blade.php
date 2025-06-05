{{-- filepath: resources/views/components/order-card.blade.php --}}
@php
    $currentRoute = request()->route()->getName();
    $isUnpaidTab = $currentRoute === 'pesanan.unpaid';
    
    if ($isUnpaidTab) {
        $displayStatus = 'Belum Bayar';
        $badgeClass = 'pending';
    } else {
        $statusMap = [
            'diproses' => ['Diproses', 'diproses'],
            'dikirim' => ['Dikirim', 'dikirim'],
            'diterima' => ['Diterima', 'diterima'],
            'dibatalkan' => ['Dibatalkan', 'dibatalkan']
        ];
        [$displayStatus, $badgeClass] = $statusMap[$order->status_pengiriman] ?? [ucfirst($order->status_pengiriman), strtolower($order->status_pengiriman)];
    }
    
    // Check apakah order sudah direview
    $hasReview = $order->hasReviewByUser(auth()->id());
@endphp

<div class="order-card" data-order-id="{{ $order->id }}" data-order-status="{{ $order->status_pengiriman }}" data-has-review="{{ $hasReview ? 'true' : 'false' }}">
    <div class="order-header">
        <div class="order-header-left">
            <h3>Order ID</h3>
            <p class="order-id">{{ $order->order_id }}</p>
            <p class="order-date">Tanggal Pemesanan: {{ $order->created_at->format('d F Y') }}</p>
        </div>
        <span class="status-badge {{ $badgeClass }}">{{ $displayStatus }}</span>
    </div>

    <div class="order-info">
        <p><strong>Kategori:</strong> {{ $order->kategori_pesanan }}</p>
        <p><strong>Jumlah:</strong> {{ $order->jumlah_pesanan }} porsi</p>
        <p><strong>Pengiriman:</strong> {{ $order->tanggal_pengiriman->format('d F Y') }}</p>
        <p><strong>Waktu:</strong> {{ $order->waktu_pengiriman }}</p>
        <p><strong>Alamat:</strong> {{ $order->lokasi_pengiriman }}</p>
        <p><strong>No. Telepon:</strong> {{ $order->nomor_telepon }}</p>
        @if($order->pesan)<p><strong>Pesan:</strong> {{ $order->pesan }}</p>@endif
    </div>

    <div class="order-divider"></div>

    <div class="order-summary-row"><span class="summary-label">Opsi Pengiriman</span><span class="summary-value">{{ ucfirst($order->opsi_pengiriman) }}</span></div>
    <div class="order-summary-row summary-row-total"><span class="summary-label">Total Harga</span><span class="summary-value">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span></div>
    <div class="order-summary-row"><span class="summary-label">Status Pembayaran</span><span class="summary-value status-payment {{ $order->status_pembayaran }}">{{ $order->status_pembayaran == 'pending' ? 'Belum Bayar' : 'Sudah Bayar' }}</span></div>

    <div class="action-buttons">
        @if($isUnpaidTab)
            <button class="btn-detail" onclick="showOrderDetail({{ $order->id }})"><i class="fas fa-eye"></i> Lihat Detail</button>
            <button class="btn-pay" onclick="redirectToPayment('{{ $order->order_id }}')"><i class="fas fa-credit-card"></i> Bayar Sekarang</button>
        @else
            @if($order->status_pengiriman == 'diproses')
                <button class="btn-single" onclick="showOrderDetail({{ $order->id }})"><i class="fas fa-eye"></i> Lihat Detail</button>
            @elseif($order->status_pengiriman == 'dikirim')
                <button class="btn-detail" onclick="showOrderDetail({{ $order->id }})"><i class="fas fa-eye"></i> Lihat Detail</button>
                <button class="btn-accept" onclick="acceptOrder({{ $order->id }})"><i class="fas fa-check"></i> Terima Pesanan</button>
            @elseif($order->status_pengiriman == 'diterima')
                <button class="btn-reorder" onclick="reorderItems({{ $order->id }})"><i class="fas fa-redo"></i> Beli Lagi</button>
                @if($hasReview)
                    <button class="btn-reviewed" disabled><i class="fas fa-star"></i> Sudah Diulas</button>
                @else
                    <button class="btn-review" onclick="showReviewModal({{ $order->id }})"><i class="fas fa-star"></i> Beri Ulasan</button>
                @endif
            @else
                <button class="btn-single" onclick="showOrderDetail({{ $order->id }})"><i class="fas fa-eye"></i> Lihat Detail</button>
            @endif
        @endif
    </div>
</div>