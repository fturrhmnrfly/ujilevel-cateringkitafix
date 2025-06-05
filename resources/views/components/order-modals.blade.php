{{-- filepath: resources/views/components/order-modals.blade.php --}}
<!-- Modal Detail Pesanan -->
<div id="orderDetailModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Detail Pesanan</h3>
            <button class="modal-close" onclick="closeModal('orderDetailModal')">&times;</button>
        </div>
        <div class="modal-body">
            @php
                $modalFields = [
                    'modal-order-id' => 'Order ID',
                    'modal-order-date' => 'Tanggal Pemesanan', 
                    'modal-order-status' => 'Status Pesanan',
                    'modal-kategori' => 'Kategori Pesanan',
                    'modal-jumlah' => 'Jumlah Pesanan',
                    'modal-delivery-date' => 'Tanggal Pengiriman',
                    'modal-delivery-time' => 'Waktu Pengiriman',
                    'modal-address' => 'Alamat Pengiriman',
                    'modal-phone' => 'Nomor Telepon',
                    'modal-shipping' => 'Opsi Pengiriman',
                    'modal-total' => 'Total Harga',
                    'modal-payment-status' => 'Status Pembayaran'
                ];
            @endphp
            
            @foreach($modalFields as $id => $label)
                <div class="detail-row">
                    <span class="detail-label">{{ $label }}</span>
                    <span class="detail-value {{ in_array($id, ['modal-order-status', 'modal-payment-status']) ? 'status-indicator' : '' }}" id="{{ $id }}">-</span>
                </div>
            @endforeach
            
            <div class="detail-row" id="modal-message-row" style="display: none;">
                <span class="detail-label">Pesan</span>
                <span class="detail-value" id="modal-message">-</span>
            </div>
        </div>
        <div class="modal-actions">
            <button class="btn-modal btn-secondary" onclick="closeModal('orderDetailModal')">Tutup</button>
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
            <p style="margin: 0; font-size: 16px; color: #333; text-align: center;">Apakah Anda yakin telah menerima pesanan ini dengan baik?</p>
            <p style="margin: 10px 0 0 0; font-size: 14px; color: #666; text-align: center;">Setelah dikonfirmasi, status pesanan akan berubah menjadi "Diterima".</p>
        </div>
        <div class="modal-actions">
            <button class="btn-modal btn-secondary" onclick="closeModal('acceptOrderModal')">Batal</button>
            <button class="btn-modal btn-success" id="confirmAcceptBtn" onclick="confirmAcceptOrder()">Ya, Terima Pesanan</button>
        </div>
    </div>
</div>