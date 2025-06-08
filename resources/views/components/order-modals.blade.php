{{-- Modal Detail Pesanan --}}
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
                <span class="detail-value status-indicator" id="modal-order-status">-</span>
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
            <div class="detail-row">
                <span class="detail-label">Opsi Pengiriman</span>
                <span class="detail-value" id="modal-shipping">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Harga</span>
                <span class="detail-value" id="modal-total">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Metode Pembayaran</span>
                <span class="detail-value" id="modal-payment-method">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status Pembayaran</span>
                <span class="detail-value status-indicator" id="modal-payment-status">-</span>
            </div>
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

{{-- Modal Accept Order --}}
<div id="acceptOrderModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Penerimaan Pesanan</h3>
            <button class="modal-close" onclick="closeModal('acceptOrderModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin sudah menerima pesanan ini dengan baik?</p>
            <p style="color: #666; font-size: 14px;">Dengan mengkonfirmasi, pesanan akan dianggap selesai.</p>
        </div>
        <div class="modal-actions">
            <button class="btn-modal btn-secondary" onclick="closeModal('acceptOrderModal')">Batal</button>
            <button class="btn-modal btn-success" id="confirmAcceptBtn" onclick="confirmAcceptOrder()">Ya, Terima Pesanan</button>
        </div>
    </div>
</div>

{{-- Modal Cancel Order --}}
<div id="cancelOrderModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Batalkan Pesanan</h3>
            <button class="modal-close" onclick="closeModal('cancelOrderModal')">&times;</button>
        </div>
        
        <div class="modal-body">
            <div class="cancel-order-info">
                <h4>Order ID: <span id="cancel-order-id">-</span></h4>
                <p style="color: #666; font-size: 14px; margin-bottom: 20px;">
                    Silakan pilih alasan pembatalan pesanan Anda:
                </p>
            </div>

            <div class="cancellation-reasons">
                <div class="reason-option">
                    <input type="radio" id="reason1" name="cancellation_reason" value="Berubah pikiran, tidak jadi pesan">
                    <label for="reason1">Berubah pikiran, tidak jadi pesan</label>
                </div>
                <div class="reason-option">
                    <input type="radio" id="reason2" name="cancellation_reason" value="Menemukan harga yang lebih murah di tempat lain">
                    <label for="reason2">Menemukan harga yang lebih murah di tempat lain</label>
                </div>
                <div class="reason-option">
                    <input type="radio" id="reason3" name="cancellation_reason" value="Tanggal acara berubah">
                    <label for="reason3">Tanggal acara berubah</label>
                </div>
                <div class="reason-option">
                    <input type="radio" id="reason4" name="cancellation_reason" value="Kesalahan dalam pemesanan">
                    <label for="reason4">Kesalahan dalam pemesanan</label>
                </div>
                <div class="reason-option">
                    <input type="radio" id="reason5" name="cancellation_reason" value="Situasi darurat/mendesak">
                    <label for="reason5">Situasi darurat/mendesak</label>
                </div>
                <div class="reason-option">
                    <input type="radio" id="reasonOther" name="cancellation_reason" value="other">
                    <label for="reasonOther">Lainnya</label>
                </div>
            </div>

            <!-- Text area untuk alasan lainnya -->
            <div class="other-reason-container" id="otherReasonContainer" style="display: none;">
                <label for="otherReasonText" class="other-reason-label">Jelaskan alasan Anda:</label>
                <textarea 
                    id="otherReasonText" 
                    class="other-reason-textarea" 
                    placeholder="Tuliskan alasan pembatalan pesanan Anda..."
                    maxlength="500"
                ></textarea>
                <div class="char-count">0/500</div>
            </div>
        </div>

        <div class="modal-actions">
            <button class="btn-modal btn-secondary" onclick="closeModal('cancelOrderModal')">
                Batal
            </button>
            <button class="btn-modal btn-danger" id="confirmCancelBtn" onclick="confirmOrderCancellation()">
                Konfirmasi Pembatalan
            </button>
        </div>
    </div>
</div>

{{-- Modal Review Pesanan - Desain Baru Sesuai Gambar --}}
<div id="reviewModal" class="modal">
    <div class="review-modal-container">
        <div class="review-modal-header">
            <h2 class="review-title">Penilaian Produk</h2>
            <button class="review-close-btn" onclick="closeModal('reviewModal')">&times;</button>
        </div>
        
        <div class="review-modal-content">
            <form id="reviewForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="reviewOrderId" name="order_id">
                
                <!-- Photo Upload Section -->
                <div class="photo-upload-section">
                    <div class="photo-grid-container" id="photoGridContainer">
                        <div class="photo-upload-box add-photo-btn" onclick="document.getElementById('reviewPhotos').click()">
                            <div class="plus-icon">+</div>
                        </div>
                    </div>
                    <input type="file" id="reviewPhotos" name="photos[]" multiple accept="image/*" style="display: none;">
                </div>

                <!-- Rating Sections -->
                <div class="rating-group">
                    <div class="rating-section-new">
                        <label class="rating-label-new">Kualitas Produk</label>
                        <div class="star-rating-new" data-category="quality">
                            <span class="star-new" data-value="1">★</span>
                            <span class="star-new" data-value="2">★</span>
                            <span class="star-new" data-value="3">★</span>
                            <span class="star-new" data-value="4">★</span>
                            <span class="star-new" data-value="5">★</span>
                        </div>
                        <input type="hidden" name="quality_rating" id="qualityRating">
                    </div>

                    <div class="rating-section-new">
                        <label class="rating-label-new">Kecepatan Pengiriman</label>
                        <div class="star-rating-new" data-category="delivery">
                            <span class="star-new" data-value="1">★</span>
                            <span class="star-new" data-value="2">★</span>
                            <span class="star-new" data-value="3">★</span>
                            <span class="star-new" data-value="4">★</span>
                            <span class="star-new" data-value="5">★</span>
                        </div>
                        <input type="hidden" name="delivery_rating" id="deliveryRating">
                    </div>

                    <div class="rating-section-new">
                        <label class="rating-label-new">Pelayanan</label>
                        <div class="star-rating-new" data-category="service">
                            <span class="star-new" data-value="1">★</span>
                            <span class="star-new" data-value="2">★</span>
                            <span class="star-new" data-value="3">★</span>
                            <span class="star-new" data-value="4">★</span>
                            <span class="star-new" data-value="5">★</span>
                        </div>
                        <input type="hidden" name="service_rating" id="serviceRating">
                    </div>
                </div>

                <!-- Review Text Section -->
                <div class="review-text-section">
                    <label class="text-label">Tuliskan Ulasan Anda</label>
                    <textarea id="reviewText" name="review_text" class="review-textarea" 
                              placeholder="Bagikan Pengalaman Anda dengan produk ini..." maxlength="500"></textarea>
                    <div class="char-count-new">0/500</div>
                </div>

                <!-- Submit Button -->
                <button type="button" class="submit-review-btn" id="submitReviewBtn" onclick="submitReview()">
                    Kirim Penilaian
                </button>
            </form>
        </div>
    </div>
</div>

<style>
/* Modal Styles - Existing modals remain unchanged */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.modal.show {
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    border-radius: 12px;
    max-width: 500px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 20px 0 20px;
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
}

.modal-title {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #999;
    padding: 0;
}

.modal-close:hover {
    color: #333;
}

.modal-body {
    padding: 0 20px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f5f5f5;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 500;
    color: #666;
    min-width: 140px;
    flex-shrink: 0;
}

.detail-value {
    color: #333;
    text-align: right;
    flex: 1;
    word-wrap: break-word;
    max-width: calc(100% - 150px);
}

/* Status Indicator - PERBAIKAN UNTUK COMPACT BADGE */
.status-indicator {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-align: center;
    white-space: nowrap;
    min-width: auto;
    width: auto;
    max-width: fit-content;
    line-height: 1.2;
}

.status-indicator.pending {
    color: #856404;
    background: #fff3cd;
}

.status-indicator.paid {
    color: #155724;
    background: #d4edda;
}

.status-indicator.failed {
    color: #721c24;
    background: #f8d7da;
}

.status-indicator.diproses {
    color: #856404;
    background: #fff3cd;
}

.status-indicator.dikirim {
    color: #0066cc;
    background: #cce5ff;
}

.status-indicator.diterima {
    color: #155724;
    background: #d4edda;
}

.status-indicator.dibatalkan {
    color: #721c24;
    background: #f8d7da;
}

.modal-actions {
    padding: 20px;
    text-align: center;
}

.btn-modal {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    margin: 0 5px;
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

.btn-danger {
    background: #dc3545;
    color: white;
}

.btn-danger:hover {
    background: #c82333;
}

.btn-danger:disabled {
    background: #6c757d;
    cursor: not-allowed;
    opacity: 0.6;
}

/* NEW REVIEW MODAL STYLES - Sesuai dengan gambar */
.review-modal-container {
    background: white;
    border-radius: 20px;
    max-width: 600px;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    position: relative;
}

.review-modal-header {
    background: #26276B;
    color: white;
    padding: 20px 25px;
    border-radius: 20px 20px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.review-title {
    font-size: 20px;
    font-weight: 600;
    margin: 0;
    color: white;
}

.review-close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 28px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.3s ease;
}

.review-close-btn:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.review-modal-content {
    padding: 30px 25px;
}

/* Photo Upload Section */
.photo-upload-section {
    margin-bottom: 30px;
}

.photo-grid-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 10px;
}

.photo-upload-box {
    aspect-ratio: 1;
    border: 2px dashed #ccc;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.photo-upload-box:hover {
    border-color: #26276B;
    background: #f0f2ff;
}

.photo-upload-box.add-photo-btn {
    border-color: #ddd;
}

.plus-icon {
    font-size: 40px;
    color: #ccc;
    font-weight: 300;
}

.photo-preview-box {
    position: relative;
    border: 2px solid #ddd;
    border-radius: 15px;
    overflow: hidden;
}

.photo-preview-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-remove-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(220, 53, 69, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease;
}

.photo-remove-btn:hover {
    background: rgba(220, 53, 69, 1);
}

/* Rating Group */
.rating-group {
    margin-bottom: 30px;
}

.rating-section-new {
    margin-bottom: 25px;
}

.rating-label-new {
    display: block;
    font-size: 16px;
    font-weight: 500;
    color: #333;
    margin-bottom: 10px;
}

.star-rating-new {
    display: flex;
    gap: 8px;
    margin-bottom: 10px;
}

.star-new {
    font-size: 32px;
    color: #ddd;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}

.star-new:hover,
.star-new.selected {
    color: #FFD700;
    transform: scale(1.1);
}

.star-new.selected {
    color: #FFD700;
}

/* Review Text Section */
.review-text-section {
    margin-bottom: 30px;
}

.text-label {
    display: block;
    font-size: 16px;
    font-weight: 500;
    color: #333;
    margin-bottom: 10px;
}

.review-textarea {
    width: 100%;
    min-height: 120px;
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 15px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
    transition: border-color 0.3s ease;
    background: #f8f9fa;
}

.review-textarea:focus {
    outline: none;
    border-color: #26276B;
    background: white;
}

.char-count-new {
    text-align: right;
    font-size: 12px;
    color: #666;
    margin-top: 8px;
}

/* Submit Button */
.submit-review-btn {
    width: 100%;
    background: #26276B;
    color: white;
    border: none;
    padding: 18px 20px;
    border-radius: 15px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: none;
}

.submit-review-btn:hover {
    background: #1e1f57;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(38, 39, 107, 0.3);
}

.submit-review-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-loading {
    opacity: 0.7;
    pointer-events: none;
}

/* TAMBAHAN STYLE UNTUK CANCEL ORDER MODAL */
.cancel-order-info {
    margin-bottom: 20px;
}

.cancel-order-info h4 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 16px;
}

.cancellation-reasons {
    margin-bottom: 20px;
}

.reason-option {
    display: flex;
    align-items: flex-start;
    margin-bottom: 12px;
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.reason-option:hover {
    background: #f8f9fa;
    border-color: #dc3545;
}

.reason-option input[type="radio"] {
    margin-right: 12px;
    margin-top: 2px;
    accent-color: #dc3545;
}

.reason-option label {
    cursor: pointer;
    font-size: 14px;
    line-height: 1.4;
    color: #333;
    flex: 1;
}

.reason-option.selected {
    background: #fff5f5;
    border-color: #dc3545;
}

.other-reason-container {
    margin-top: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
}

.other-reason-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
    font-size: 14px;
}

.other-reason-textarea {
    width: 100%;
    min-height: 80px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-family: inherit;
    font-size: 14px;
    resize: vertical;
    box-sizing: border-box;
}

.other-reason-textarea:focus {
    outline: none;
    border-color: #dc3545;
    box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.1);
}

.char-count {
    text-align: right;
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .review-modal-container {
        max-width: 95%;
        margin: 10px;
    }
    
    .photo-grid-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .star-new {
        font-size: 28px;
    }
    
    .review-modal-content {
        padding: 20px 15px;
    }
    
    /* Responsive untuk modal detail */
    .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .detail-label {
        min-width: auto;
    }
    
    .detail-value {
        text-align: left;
        max-width: 100%;
    }
    
    .status-indicator {
        align-self: flex-start;
    }
}

@media (max-width: 480px) {
    .photo-grid-container {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .star-new {
        font-size: 24px;
        gap: 4px;
    }
    
    .review-title {
        font-size: 18px;
    }
}
</style>

<script>
// Global variables
let selectedPhotos = [];
let currentOrderId = null;

// PASTIKAN SEMUA FUNGSI ADA DI SINI
function showOrderDetail(orderId) {
    console.log('showOrderDetail called with orderId:', orderId);
    console.log('Available window.orderData:', window.orderData);
    console.log('Keys in orderData:', Object.keys(window.orderData || {}));
    
    if (!window.orderData) {
        console.error('window.orderData is not defined');
        alert('Data pesanan tidak tersedia');
        return;
    }
    
    const order = window.orderData[orderId];
    
    if (!order) {
        console.error('Order not found for ID:', orderId);
        console.log('Available order IDs:', Object.keys(window.orderData));
        alert('Data pesanan tidak ditemukan untuk ID: ' + orderId);
        return;
    }

    console.log('Order data found:', order);

    // Helper functions
    const formatDate = (dateString) => {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    };

    const formatCurrency = (amount) => {
        return `Rp ${parseInt(amount).toLocaleString('id-ID')}`;
    };

    const capitalizeFirst = (str) => {
        return str.charAt(0).toUpperCase() + str.slice(1);
    };

    // Status mapping functions untuk clarity
    const getOrderStatusDisplay = (status_pengiriman) => {
        const statusMap = {
            'diproses': 'Diproses',
            'dikirim': 'Dikirim',
            'diterima': 'Diterima',
            'dibatalkan': 'Dibatalkan'
        };
        return statusMap[status_pengiriman] || capitalizeFirst(status_pengiriman);
    };

    const getPaymentStatusDisplay = (status_pembayaran) => {
        const statusMap = {
            'pending': 'Belum Bayar',
            'paid': 'Sudah Bayar',
            'failed': 'Pembayaran Gagal'
        };
        return statusMap[status_pembayaran] || capitalizeFirst(status_pembayaran);
    };

    // Populate modal fields
    try {
        document.getElementById('modal-order-id').textContent = order.order_id || '-';
        document.getElementById('modal-order-date').textContent = formatDate(order.created_at);
        document.getElementById('modal-kategori').textContent = order.kategori_pesanan || '-';
        document.getElementById('modal-jumlah').textContent = `${order.jumlah_pesanan} porsi`;
        document.getElementById('modal-delivery-date').textContent = formatDate(order.tanggal_pengiriman);
        document.getElementById('modal-delivery-time').textContent = order.waktu_pengiriman || '-';
        document.getElementById('modal-address').textContent = order.lokasi_pengiriman || '-';
        document.getElementById('modal-phone').textContent = order.nomor_telepon || '-';
        document.getElementById('modal-shipping').textContent = capitalizeFirst(order.opsi_pengiriman || '');
        document.getElementById('modal-total').textContent = formatCurrency(order.total_harga);
        document.getElementById('modal-payment-method').textContent = order.payment_method || 'COD';

        // STATUS PESANAN (menggunakan kolom status_pengiriman)
        const statusElement = document.getElementById('modal-order-status');
        if (statusElement) {
            const currentRoute = window.location.pathname;
            const isUnpaidTab = currentRoute.includes('unpaid');
            
            // Jika di tab belum dibayar, status pesanan tetap menunjukkan status pengiriman
            if (isUnpaidTab && order.status_pembayaran === 'pending') {
                // Tapi jika memang belum bayar, bisa ditampilkan status khusus
                statusElement.textContent = 'Menunggu Pembayaran';
                statusElement.className = 'detail-value status-indicator pending';
            } else {
                // Status pesanan SELALU dari kolom status_pengiriman
                statusElement.textContent = getOrderStatusDisplay(order.status_pengiriman);
                statusElement.className = `detail-value status-indicator ${order.status_pengiriman}`;
            }
        }

        // STATUS PEMBAYARAN (menggunakan kolom status_pembayaran)
        const paymentStatusElement = document.getElementById('modal-payment-status');
        if (paymentStatusElement) {
            // Status pembayaran SELALU dari kolom status_pembayaran
            paymentStatusElement.textContent = getPaymentStatusDisplay(order.status_pembayaran);
            paymentStatusElement.className = `detail-value status-indicator ${order.status_pembayaran}`;
        }

        const messageRow = document.getElementById('modal-message-row');
        const messageElement = document.getElementById('modal-message');
        
        if (order.pesan && order.pesan.trim()) {
            messageElement.textContent = order.pesan;
            messageRow.style.display = 'flex';
        } else {
            messageRow.style.display = 'none';
        }

        document.getElementById('orderDetailModal').classList.add('show');
        
    } catch (error) {
        console.error('Error populating modal:', error);
        alert('Terjadi kesalahan saat menampilkan detail pesanan');
    }
}

// TAMBAHKAN FUNGSI showReviewModal DI SINI
function showReviewModal(orderId) {
    console.log('showReviewModal called with orderId:', orderId);
    
    currentOrderId = orderId;
    
    // Reset form
    resetReviewForm();
    
    // Set order ID di form
    const orderIdInput = document.getElementById('reviewOrderId');
    if (orderIdInput) {
        orderIdInput.value = orderId;
    }
    
    // Show modal
    const modal = document.getElementById('reviewModal');
    if (modal) {
        modal.classList.add('show');
        
        // Update photo grid after modal is shown
        setTimeout(() => {
            updatePhotoGrid();
        }, 100);
    } else {
        console.error('Review modal not found');
        alert('Modal review tidak ditemukan');
    }
}

// TAMBAHKAN FUNGSI acceptOrder DI SINI  
function acceptOrder(orderId) {
    console.log('acceptOrder called with orderId:', orderId);
    currentOrderId = orderId;
    document.getElementById('acceptOrderModal').classList.add('show');
}

function confirmAcceptOrder() {
    if (!currentOrderId) return;
    
    const confirmBtn = document.getElementById('confirmAcceptBtn');
    confirmBtn.disabled = true;
    confirmBtn.classList.add('btn-loading');
    confirmBtn.textContent = 'Memproses...';

    fetch(`/pesanan/accept/${currentOrderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.ok ? response.json() : Promise.reject(`HTTP ${response.status}`))
    .then(data => {
        if (data.success) {
            updateOrderCardStatus(currentOrderId, 'diterima');
            closeModal('acceptOrderModal');
            showMessage('Pesanan berhasil diterima!', 'success');
            setTimeout(() => window.location.reload(), 1500);
        } else {
            throw new Error(data.message || 'Gagal memperbarui status pesanan');
        }
    })
    .catch(error => showMessage('Terjadi kesalahan: ' + error.message, 'error'))
    .finally(() => {
        confirmBtn.disabled = false;
        confirmBtn.classList.remove('btn-loading');
        confirmBtn.textContent = 'Ya, Terima Pesanan';
    });
}

// TAMBAHKAN FUNGSI reorderItems DI SINI
function reorderItems(orderId) {
    if (confirm('Apakah Anda ingin memesan kembali item yang sama?')) {
        window.location.href = '/dashboard';
    }
}

function markOrderAsReviewed(orderId) {
    const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
    if (!orderCard) {
        console.log('Order card not found for orderId:', orderId);
        return;
    }
    
    orderCard.setAttribute('data-has-review', 'true');
    
    const actionButtons = orderCard.querySelector('.action-buttons-new');
    const reviewButton = actionButtons?.querySelector('.btn-review-new');
    
    if (reviewButton) {
        reviewButton.outerHTML = '<button class="btn-reviewed-new" disabled><i class="fas fa-star"></i> Sudah Diulas</button>';
    }
}

function updateOrderCardStatus(orderId, newStatus) {
    const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
    if (!orderCard) return;
    
    const statusBadge = orderCard.querySelector('.status-badge-new');
    if (statusBadge) {
        statusBadge.className = `status-badge-new ${newStatus}`;
        statusBadge.textContent = capitalizeFirst(newStatus);
    }
    
    orderCard.setAttribute('data-order-status', newStatus);
}

function showMessage(message, type) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: type,
            title: type === 'success' ? 'Berhasil!' : 'Error!',
            text: message,
            timer: 3000,
            showConfirmButton: false
        });
    } else {
        alert(message);
    }
}

function capitalizeFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Review Modal Functions
function resetReviewForm() {
    // Reset ratings
    document.querySelectorAll('.star-rating-new').forEach(rating => {
        rating.querySelectorAll('.star-new').forEach(star => {
            star.classList.remove('selected');
        });
    });
    
    // Reset hidden inputs
    document.getElementById('qualityRating').value = '';
    document.getElementById('deliveryRating').value = '';
    document.getElementById('serviceRating').value = '';
    
    // Reset text
    document.getElementById('reviewText').value = '';
    document.querySelector('.char-count-new').textContent = '0/500';
    
    // Reset photos
    selectedPhotos = [];
    updatePhotoGrid();
}

function updatePhotoGrid() {
    const photoGridContainer = document.getElementById('photoGridContainer');
    photoGridContainer.innerHTML = '';
    
    // Add existing photos (maksimal 4)
    selectedPhotos.slice(0, 4).forEach((photo, index) => {
        const photoDiv = document.createElement('div');
        photoDiv.className = 'photo-upload-box photo-preview-box';
        photoDiv.innerHTML = `
            <img src="${photo.url}" alt="Preview">
            <button type="button" class="photo-remove-btn" onclick="removePhoto(${index})">×</button>
        `;
        photoGridContainer.appendChild(photoDiv);
    });
    
    // Add remaining empty slots
    const remainingSlots = 4 - selectedPhotos.length;
    for (let i = 0; i < remainingSlots; i++) {
        const addDiv = document.createElement('div');
        if (i === 0) {
            addDiv.className = 'photo-upload-box add-photo-btn';
            addDiv.onclick = () => document.getElementById('reviewPhotos').click();
            addDiv.innerHTML = '<div class="plus-icon">+</div>';
        } else {
            addDiv.className = 'photo-upload-box';
            addDiv.innerHTML = '<div class="plus-icon" style="color: #eee;">+</div>';
        }
        photoGridContainer.appendChild(addDiv);
    }
}

function removePhoto(index) {
    selectedPhotos.splice(index, 1);
    updatePhotoGrid();
}

function submitReview() {
    const qualityRating = document.getElementById('qualityRating').value;
    const deliveryRating = document.getElementById('deliveryRating').value;
    const serviceRating = document.getElementById('serviceRating').value;
    
    if (!qualityRating || !deliveryRating || !serviceRating) {
        alert('Mohon berikan rating untuk semua kategori');
        return;
    }
    
    const submitBtn = document.getElementById('submitReviewBtn');
    submitBtn.classList.add('btn-loading');
    submitBtn.textContent = 'Mengirim...';
    submitBtn.disabled = true;
    
    const formData = new FormData();
    formData.append('order_id', currentOrderId);
    formData.append('quality_rating', qualityRating);
    formData.append('delivery_rating', deliveryRating);
    formData.append('service_rating', serviceRating);
    formData.append('review_text', document.getElementById('reviewText').value);
    
    // Add photos (maksimal 4)
    selectedPhotos.slice(0, 4).forEach((photo) => {
        formData.append('photos[]', photo.file);
    });
    
    fetch('/reviews', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(async response => {
        const responseText = await response.text();
        console.log('Raw response:', responseText);
        
        let data;
        try {
            data = JSON.parse(responseText);
        } catch (e) {
            console.error('Invalid JSON response:', responseText);
            throw new Error('Server mengembalikan response yang tidak valid. Periksa route /reviews dan controller.');
        }
        
        if (!response.ok) {
            throw new Error(data.message || `HTTP ${response.status}: ${response.statusText}`);
        }
        
        return data;
    })
    .then(data => {
        if (data.success) {
            alert('Ulasan berhasil dikirim! Terima kasih atas feedback Anda.');
            closeModal('reviewModal');
            markOrderAsReviewed(currentOrderId);
        } else {
            throw new Error(data.message || 'Gagal mengirim ulasan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan: ' + error.message);
    })
    .finally(() => {
        submitBtn.classList.remove('btn-loading');
        submitBtn.textContent = 'Kirim Penilaian';
        submitBtn.disabled = false;
    });
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('show');
    }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('Order modals script loaded');
    console.log('Available functions:', {
        showOrderDetail: typeof showOrderDetail,
        showReviewModal: typeof showReviewModal,
        acceptOrder: typeof acceptOrder,
        reorderItems: typeof reorderItems
    });
    
    // Star rating functionality untuk modal review baru
    document.querySelectorAll('.star-rating-new').forEach(rating => {
        const stars = rating.querySelectorAll('.star-new');
        const category = rating.dataset.category;
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.dataset.value;
                
                // Update visual
                stars.forEach((s, index) => {
                    if (index < value) {
                        s.classList.add('selected');
                    } else {
                        s.classList.remove('selected');
                    }
                });
                
                // Update hidden input
                document.getElementById(category + 'Rating').value = value;
            });
            
            star.addEventListener('mouseover', function() {
                const value = this.dataset.value;
                stars.forEach((s, index) => {
                    if (index < value) {
                        s.style.color = '#FFD700';
                    } else {
                        s.style.color = '#ddd';
                    }
                });
            });
        });
        
        rating.addEventListener('mouseleave', function() {
            stars.forEach((star, index) => {
                if (star.classList.contains('selected')) {
                    star.style.color = '#FFD700';
                } else {
                    star.style.color = '#ddd';
                }
            });
        });
    });
    
    // Character count for review text
    const reviewText = document.getElementById('reviewText');
    const charCount = document.querySelector('.char-count-new');
    
    if (reviewText && charCount) {
        reviewText.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = `${count}/500`;
            
            if (count > 500) {
                charCount.style.color = '#dc3545';
            } else {
                charCount.style.color = '#666';
            }
        });
    }
    
    // Photo upload functionality
    const photoInput = document.getElementById('reviewPhotos');
    if (photoInput) {
        photoInput.addEventListener('change', function() {
            const files = Array.from(this.files);
            
            files.forEach(file => {
                if (selectedPhotos.length >= 4) {
                    alert('Maksimal 4 foto yang dapat diunggah');
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5MB');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedPhotos.push({
                        file: file,
                        url: e.target.result
                    });
                    
                    // Hanya ambil 4 foto pertama
                    if (selectedPhotos.length > 4) {
                        selectedPhotos = selectedPhotos.slice(0, 4);
                        alert('Maksimal 4 foto. Hanya 4 foto pertama yang akan digunakan.');
                    }
                    
                    updatePhotoGrid();
                };
                reader.readAsDataURL(file);
            });
            
            // Reset input
            this.value = '';
        });
    }
});

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal')) {
        e.target.classList.remove('show');
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const openModal = document.querySelector('.modal.show');
        if (openModal) {
            openModal.classList.remove('show');
        }
    }
});

// TAMBAHKAN SCRIPT UNTUK CANCEL ORDER MODAL
let currentCancelOrderId = null;

function showCancelOrderModal(orderId) {
    console.log('showCancelOrderModal called with orderId:', orderId);
    
    currentCancelOrderId = orderId;
    
    // Reset form
    resetCancelOrderForm();
    
    // Set order ID di modal
    const orderIdElement = document.getElementById('cancel-order-id');
    if (orderIdElement && window.orderData && window.orderData[orderId]) {
        orderIdElement.textContent = window.orderData[orderId].order_id || orderId;
    }
    
    // Show modal
    const modal = document.getElementById('cancelOrderModal');
    if (modal) {
        modal.classList.add('show');
    } else {
        console.error('Cancel order modal not found');
        alert('Modal pembatalan tidak ditemukan');
    }
}

function resetCancelOrderForm() {
    // Reset radio buttons
    const radioButtons = document.querySelectorAll('input[name="cancellation_reason"]');
    radioButtons.forEach(radio => {
        radio.checked = false;
    });
    
    // Hide other reason container
    const otherContainer = document.getElementById('otherReasonContainer');
    if (otherContainer) {
        otherContainer.style.display = 'none';
    }
    
    // Clear textarea
    const otherTextarea = document.getElementById('otherReasonText');
    if (otherTextarea) {
        otherTextarea.value = '';
    }
    
    // Reset char count
    const charCount = document.querySelector('.char-count');
    if (charCount) {
        charCount.textContent = '0/500';
    }
    
    // Remove selected class from all options
    document.querySelectorAll('.reason-option').forEach(option => {
        option.classList.remove('selected');
    });
}

function confirmOrderCancellation() {
    if (!currentCancelOrderId) {
        alert('Order ID tidak valid');
        return;
    }
    
    // Get selected reason
    const selectedReason = document.querySelector('input[name="cancellation_reason"]:checked');
    if (!selectedReason) {
        alert('Silakan pilih alasan pembatalan');
        return;
    }
    
    let cancellationReason = selectedReason.value;
    
    // If "other" is selected, get custom reason
    if (cancellationReason === 'other') {
        const customReason = document.getElementById('otherReasonText').value.trim();
        if (!customReason) {
            alert('Silakan isi alasan pembatalan');
            return;
        }
        cancellationReason = customReason;
    }
    
    // Disable button and show loading
    const confirmBtn = document.getElementById('confirmCancelBtn');
    confirmBtn.disabled = true;
    confirmBtn.textContent = 'Membatalkan...';
    
    // Send cancellation request
    fetch(`/pesanan/cancel/${currentCancelOrderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            reason: cancellationReason
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update order card status
            updateOrderCardStatus(currentCancelOrderId, 'dibatalkan');
            
            // Close modal
            closeModal('cancelOrderModal');
            
            // Show success message
            showMessage('Pesanan berhasil dibatalkan!', 'success');
            
            // Reload page after short delay
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            throw new Error(data.message || 'Gagal membatalkan pesanan');
        }
    })
    .catch(error => {
        console.error('Error cancelling order:', error);
        showMessage('Terjadi kesalahan: ' + error.message, 'error');
    })
    .finally(() => {
        // Reset button
        confirmBtn.disabled = false;
        confirmBtn.textContent = 'Konfirmasi Pembatalan';
    });
}

// Event listeners untuk cancel order modal
document.addEventListener('DOMContentLoaded', function() {
    // Handle reason option selection
    document.querySelectorAll('input[name="cancellation_reason"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove selected class from all options
            document.querySelectorAll('.reason-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selected class to current option
            this.closest('.reason-option').classList.add('selected');
            
            // Show/hide other reason container
            const otherContainer = document.getElementById('otherReasonContainer');
            if (this.value === 'other') {
                otherContainer.style.display = 'block';
                document.getElementById('otherReasonText').focus();
            } else {
                otherContainer.style.display = 'none';
            }
        });
    });
    
    // Handle reason option click (untuk area yang lebih besar)
    document.querySelectorAll('.reason-option').forEach(option => {
        option.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
                radio.dispatchEvent(new Event('change'));
            }
        });
    });
    
    // Handle textarea character count
    const otherTextarea = document.getElementById('otherReasonText');
    if (otherTextarea) {
        otherTextarea.addEventListener('input', function() {
            const charCount = document.querySelector('.char-count');
            if (charCount) {
                charCount.textContent = `${this.value.length}/500`;
            }
        });
    }
});
</script>