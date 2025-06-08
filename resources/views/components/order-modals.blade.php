
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

{{-- Modal Review Pesanan --}}
<div id="reviewModal" class="modal">
    <div class="modal-content review-modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Beri Ulasan Pesanan</h3>
            <button class="modal-close" onclick="closeModal('reviewModal')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="reviewForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="reviewOrderId" name="order_id">
                
                <!-- Rating Sections -->
                <div class="rating-section">
                    <label class="rating-label">Kualitas Makanan</label>
                    <div class="star-rating" data-category="quality">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <input type="hidden" name="quality_rating" id="qualityRating">
                </div>

                <div class="rating-section">
                    <label class="rating-label">Ketepatan Pengiriman</label>
                    <div class="star-rating" data-category="delivery">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <input type="hidden" name="delivery_rating" id="deliveryRating">
                </div>

                <div class="rating-section">
                    <label class="rating-label">Pelayanan</label>
                    <div class="star-rating" data-category="service">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <input type="hidden" name="service_rating" id="serviceRating">
                </div>

                <!-- Review Text -->
                <div class="form-group">
                    <label for="reviewText" class="form-label">Ulasan (Opsional)</label>
                    <textarea id="reviewText" name="review_text" class="form-control" rows="4" 
                              placeholder="Bagikan pengalaman Anda dengan pesanan ini..." maxlength="500"></textarea>
                    <div class="char-count">0/500</div>
                </div>

                <!-- Photo Upload -->
                <div class="form-group">
                    <label class="form-label">Foto Pesanan (Opsional)</label>
                    <div class="photo-upload-container">
                        <input type="file" id="reviewPhotos" name="photos[]" multiple accept="image/*" style="display: none;">
                        <div class="photo-grid" id="photoGrid">
                            <div class="photo-upload-item add-photo" onclick="document.getElementById('reviewPhotos').click()">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Foto</span>
                            </div>
                        </div>
                        <div class="photo-info">Maksimal 4 foto, ukuran maksimal 5MB per foto</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-actions">
            <button class="btn-modal btn-secondary" onclick="closeModal('reviewModal')">Batal</button>
            <button class="btn-modal btn-success" id="submitReviewBtn" onclick="submitReview()">Kirim Ulasan</button>
        </div>
    </div>
</div>

<style>
/* Modal Styles */
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

.review-modal-content {
    max-width: 600px;
    max-height: 90vh;
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
}

.detail-value {
    color: #333;
    text-align: right;
    flex: 1;
}

.status-indicator.pending {
    color: #856404;
    background: #fff3cd;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
}

.status-indicator.diproses {
    color: #856404;
    background: #fff3cd;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
}

.status-indicator.dikirim {
    color: #0066cc;
    background: #cce5ff;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
}

.status-indicator.diterima {
    color: #155724;
    background: #d4edda;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
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

/* Review Modal Specific Styles */
.rating-section {
    margin-bottom: 20px;
}

.rating-label {
    display: block;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

.star-rating {
    display: flex;
    gap: 5px;
    margin-bottom: 10px;
}

.star {
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
}

.star:hover,
.star.selected {
    color: #ffd700;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    resize: vertical;
}

.char-count {
    text-align: right;
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

.photo-upload-container {
    margin-top: 10px;
}

.photo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 10px;
    margin-bottom: 10px;
}

.photo-upload-item {
    aspect-ratio: 1;
    border: 2px dashed #ddd;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    background: #f9f9f9;
}

.photo-upload-item:hover {
    border-color: #2c2c77;
    background: #f0f7ff;
}

.photo-upload-item.add-photo i {
    font-size: 24px;
    color: #666;
    margin-bottom: 5px;
}

.photo-upload-item.add-photo span {
    font-size: 12px;
    color: #666;
    text-align: center;
}

.photo-preview {
    position: relative;
    border: 2px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
}

.photo-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-remove {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(220, 53, 69, 0.8);
    color: white;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.photo-info {
    font-size: 12px;
    color: #666;
    text-align: center;
}

.btn-loading {
    opacity: 0.7;
    pointer-events: none;
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

        const statusElement = document.getElementById('modal-order-status');
        const paymentStatusElement = document.getElementById('modal-payment-status');
        
        if (statusElement) {
            const currentRoute = window.location.pathname;
            const isUnpaidTab = currentRoute.includes('unpaid');
            
            if (isUnpaidTab || order.status_pembayaran === 'pending') {
                statusElement.textContent = 'Belum Bayar';
                statusElement.className = 'detail-value status-indicator pending';
            } else {
                statusElement.textContent = capitalizeFirst(order.status_pengiriman);
                statusElement.className = `detail-value status-indicator ${order.status_pengiriman}`;
            }
        }

        if (paymentStatusElement) {
            const paymentStatus = order.status_pembayaran === 'pending' ? 'Belum Bayar' : 'Sudah Bayar';
            paymentStatusElement.textContent = paymentStatus;
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
    if (typeof resetReviewForm === 'function') {
        resetReviewForm();
    }
    
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
            if (typeof updatePhotoGrid === 'function') {
                updatePhotoGrid();
            }
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
    document.querySelectorAll('.star-rating').forEach(rating => {
        rating.querySelectorAll('.star').forEach(star => {
            star.classList.remove('selected');
        });
    });
    
    // Reset hidden inputs
    document.getElementById('qualityRating').value = '';
    document.getElementById('deliveryRating').value = '';
    document.getElementById('serviceRating').value = '';
    
    // Reset text
    document.getElementById('reviewText').value = '';
    document.querySelector('.char-count').textContent = '0/500';
    
    // Reset photos
    selectedPhotos = [];
    updatePhotoGrid();
}

function updatePhotoGrid() {
    const photoGrid = document.getElementById('photoGrid');
    photoGrid.innerHTML = '';
    
    // Add existing photos
    selectedPhotos.forEach((photo, index) => {
        const photoDiv = document.createElement('div');
        photoDiv.className = 'photo-upload-item photo-preview';
        photoDiv.innerHTML = `
            <img src="${photo.url}" alt="Preview">
            <button type="button" class="photo-remove" onclick="removePhoto(${index})">×</button>
        `;
        photoGrid.appendChild(photoDiv);
    });
    
    // Add "add photo" button if less than 4 photos
    if (selectedPhotos.length < 4) {
        const addDiv = document.createElement('div');
        addDiv.className = 'photo-upload-item add-photo';
        addDiv.onclick = () => document.getElementById('reviewPhotos').click();
        addDiv.innerHTML = `
            <i class="fas fa-plus"></i>
            <span>Tambah Foto</span>
        `;
        photoGrid.appendChild(addDiv);
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
    
    const formData = new FormData();
    formData.append('order_id', currentOrderId);
    formData.append('quality_rating', qualityRating);
    formData.append('delivery_rating', deliveryRating);
    formData.append('service_rating', serviceRating);
    formData.append('review_text', document.getElementById('reviewText').value);
    
    // Add photos
    const photoInput = document.getElementById('reviewPhotos');
    for (let i = 0; i < photoInput.files.length; i++) {
        formData.append('photos[]', photoInput.files[i]);
    }
    
    fetch('/review', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
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
        submitBtn.textContent = 'Kirim Ulasan';
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
    
    // Star rating functionality
    document.querySelectorAll('.star-rating').forEach(rating => {
        const stars = rating.querySelectorAll('.star');
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
                        s.style.color = '#ffd700';
                    } else {
                        s.style.color = '#ddd';
                    }
                });
            });
        });
        
        rating.addEventListener('mouseleave', function() {
            stars.forEach((star, index) => {
                if (star.classList.contains('selected')) {
                    star.style.color = '#ffd700';
                } else {
                    star.style.color = '#ddd';
                }
            });
        });
    });
    
    // Character count for review text
    const reviewText = document.getElementById('reviewText');
    const charCount = document.querySelector('.char-count');
    
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
</script>