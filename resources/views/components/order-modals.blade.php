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

<!-- Modal Penilaian Produk -->
<div id="reviewModal" class="modal">
    <div class="modal-content review-modal-content">
        <div class="review-modal-header">
            <h3 class="review-modal-title">
                <i class="fas fa-star-half-alt"></i>
                Penilaian Produk
            </h3>
            <button class="modal-close" onclick="closeModal('reviewModal')">&times;</button>
        </div>
        <div class="review-modal-body">
            <form id="reviewForm">
                <!-- Upload Foto Section -->
                <div class="review-section">
                    <div class="section-header">
                        <i class="fas fa-camera section-icon"></i>
                        <label class="review-label">Upload Foto</label>
                        <span class="optional-text">(Opsional, maksimal 4 foto)</span>
                    </div>
                    <div class="photo-upload-container">
                        <div class="photo-upload-grid" id="photoUploadGrid">
                            <div class="photo-upload-item add-photo-btn" onclick="triggerFileInput()">
                                <div class="upload-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span>Tambah Foto</span>
                                <input type="file" id="photoInput" multiple accept="image/*" style="display: none;" onchange="handlePhotoUpload(event)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Sections -->
                <div class="review-section">
                    <div class="section-header">
                        <i class="fas fa-box section-icon"></i>
                        <label class="review-label">Kualitas Produk</label>
                        <span class="required">*</span>
                    </div>
                    <div class="rating-container">
                        <div class="star-rating" data-rating="quality">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                        <span class="rating-text" id="quality-text">Pilih rating</span>
                    </div>
                </div>

                <div class="review-section">
                    <div class="section-header">
                        <i class="fas fa-shipping-fast section-icon"></i>
                        <label class="review-label">Kecepatan Pengiriman</label>
                        <span class="required">*</span>
                    </div>
                    <div class="rating-container">
                        <div class="star-rating" data-rating="delivery">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                        <span class="rating-text" id="delivery-text">Pilih rating</span>
                    </div>
                </div>

                <div class="review-section">
                    <div class="section-header">
                        <i class="fas fa-headset section-icon"></i>
                        <label class="review-label">Pelayanan</label>
                        <span class="required">*</span>
                    </div>
                    <div class="rating-container">
                        <div class="star-rating" data-rating="service">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                        <span class="rating-text" id="service-text">Pilih rating</span>
                    </div>
                </div>

                <!-- Review Text Section -->
                <div class="review-section">
                    <div class="section-header">
                        <i class="fas fa-comment-alt section-icon"></i>
                        <label class="review-label">Tulis Ulasan Anda</label>
                        <span class="optional-text">(Opsional, maksimal 500 karakter)</span>
                    </div>
                    <div class="textarea-container">
                        <textarea 
                            id="reviewText" 
                            class="review-textarea" 
                            placeholder="Bagikan pengalaman Anda dengan produk ini..."
                            maxlength="500"
                        ></textarea>
                        <div class="character-count">
                            <span id="charCount">0</span>/500 karakter
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="review-submit-section">
                    <button type="button" class="btn-submit-review" onclick="submitReview()">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Review Modal Styles */
.review-modal-content {
    max-width: 650px;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
    background: white;
}

.review-modal-header {
    background: #26276B;
    color: white;
    padding: 20px 24px;
    border-radius: 16px 16px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.review-modal-title {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.review-modal-header .modal-close {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    font-size: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.review-modal-header .modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.review-modal-body {
    padding: 24px;
    background: #fafbfc;
}

.review-section {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.review-section:hover {
    border-color: #26276B;
    box-shadow: 0 2px 8px rgba(38, 39, 107, 0.1);
}

.section-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

.section-icon {
    color: #26276B;
    font-size: 16px;
    width: 20px;
}

.review-label {
    font-weight: 600;
    color: #2d3748;
    font-size: 15px;
}

.required {
    color: #e53e3e;
    font-weight: bold;
    margin-left: 4px;
}

.optional-text {
    color: #718096;
    font-size: 13px;
    font-style: italic;
    margin-left: auto;
}

/* Photo Upload Styles */
.photo-upload-container {
    margin-top: 12px;
}

.photo-upload-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 12px;
    max-width: 100%;
}

.photo-upload-item {
    aspect-ratio: 1;
    border: 2px dashed #cbd5e0;
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f7fafc;
    position: relative;
    overflow: hidden;
}

.add-photo-btn:hover {
    border-color: #26276B;
    background: #edf2f7;
}

.upload-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #26276B;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    font-size: 18px;
}

.photo-upload-item span {
    font-size: 12px;
    color: #4a5568;
    font-weight: 500;
    text-align: center;
}

.photo-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.remove-photo {
    position: absolute;
    top: 6px;
    right: 6px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: rgba(229, 62, 62, 0.9);
    color: white;
    border: none;
    cursor: pointer;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.remove-photo:hover {
    background: #e53e3e;
    transform: scale(1.1);
}

/* Rating Styles */
.rating-container {
    display: flex;
    align-items: center;
    gap: 16px;
}

.star-rating {
    display: flex;
    gap: 4px;
}

.star {
    font-size: 28px;
    color: #e2e8f0;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}

.star:hover,
.star.active {
    color: #ffd700;
    transform: scale(1.1);
}

.rating-text {
    font-size: 14px;
    color: #718096;
    font-weight: 500;
    min-width: 100px;
}

.rating-text.selected {
    color: #26276B;
    font-weight: 600;
}

/* Textarea Styles */
.textarea-container {
    position: relative;
}

.review-textarea {
    width: 100%;
    max-width: 31.7rem;
    min-height: 120px;
    padding: 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    line-height: 1.5;
    resize: vertical;
    transition: all 0.3s ease;
    background: #fff;
}

.review-textarea:focus {
    outline: none;
    border-color: #26276B;
    box-shadow: 0 0 0 3px rgba(38, 39, 107, 0.1);
}

.character-count {
    position: absolute;
    bottom: 12px;
    right: 16px;
    font-size: 12px;
    color: #718096;
    background: rgba(255, 255, 255, 0.9);
    padding: 4px 8px;
    border-radius: 6px;
}

.character-count.warning {
    color: #e53e3e;
    font-weight: 600;
}

/* Submit Button */
.review-submit-section {
    margin-top: 24px;
    text-align: center;
}

.btn-submit-review {
    background: #26276B;
    color: white;
    border: none;
    padding: 16px 32px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    min-width: 200px;
    justify-content: center;
}

.btn-submit-review:hover {
    background: #1a1d4a;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(38, 39, 107, 0.3);
}

.btn-submit-review:active {
    transform: translateY(0);
}

/* Additional Styles */
.upload-count {
    font-size: 10px;
    color: #718096;
    margin-top: 4px;
}

.upload-limit-reached {
    opacity: 0.7;
    cursor: not-allowed;
}

.upload-limit-reached:hover {
    border-color: #e53e3e !important;
    background: #fef2f2 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .review-modal-content {
        width: 98%;
        margin: 10px;
        max-height: 95vh;
    }
    
    .review-modal-header {
        padding: 16px 20px;
    }
    
    .review-modal-title {
        font-size: 18px;
    }
    
    .review-modal-body {
        padding: 20px;
    }
    
    .review-section {
        padding: 16px;
    }
    
    .photo-upload-grid {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
    }
    
    .star {
        font-size: 24px;
    }
    
    .rating-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .btn-submit-review {
        width: 100%;
        padding: 14px 24px;
    }
}

/* Animation */
@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.modal.show .review-modal-content {
    animation: fadeInScale 0.3s ease-out;
}
</style>

<script>
// Photo upload functionality
let uploadedPhotos = [];
const maxPhotos = 4;

function triggerFileInput() {
    if (uploadedPhotos.length >= maxPhotos) {
        alert(`Maksimal ${maxPhotos} foto yang dapat diupload`);
        return;
    }
    
    // Tambahkan event listener untuk validasi real-time
    const fileInput = document.getElementById('photoInput');
    fileInput.addEventListener('change', function(e) {
        const selectedFiles = e.target.files.length;
        if (!validateFileCount(selectedFiles)) {
            this.value = ''; // Clear input jika melebihi limit
            return;
        }
    }, { once: true });
    
    fileInput.click();
}

function handlePhotoUpload(event) {
    const files = Array.from(event.target.files);
    
    // VALIDASI: Potong array files jika melebihi limit
    const remainingSlots = maxPhotos - uploadedPhotos.length;
    const filesToProcess = files.slice(0, remainingSlots);
    const rejectedFiles = files.slice(remainingSlots);
    
    if (rejectedFiles.length > 0) {
        alert(`Hanya ${remainingSlots} foto yang dapat ditambahkan. ${rejectedFiles.length} foto diabaikan.`);
    }
    
    let processedCount = 0;
    const totalToProcess = filesToProcess.length;
    
    filesToProcess.forEach(file => {
        if (file.type.startsWith('image/')) {
            if (file.size > 5 * 1024 * 1024) {
                alert(`File ${file.name} terlalu besar. Maksimal 5MB per foto.`);
                processedCount++;
                if (processedCount === totalToProcess) updatePhotoGrid();
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                uploadedPhotos.push({
                    file: file,
                    url: e.target.result
                });
                
                processedCount++;
                if (processedCount === totalToProcess) {
                    updatePhotoGrid();
                }
            };
            reader.readAsDataURL(file);
        } else {
            alert(`File ${file.name} bukan format gambar yang valid.`);
            processedCount++;
            if (processedCount === totalToProcess) updatePhotoGrid();
        }
    });
    
    // Reset input
    event.target.value = '';
}

// PERBAIKAN: Tambahkan fungsi validasi sebelum upload
function validateFileCount(newFilesCount) {
    const totalAfterUpload = uploadedPhotos.length + newFilesCount;
    if (totalAfterUpload > maxPhotos) {
        const allowedCount = maxPhotos - uploadedPhotos.length;
        alert(`Anda hanya dapat menambahkan ${allowedCount} foto lagi. Maksimal total ${maxPhotos} foto.`);
        return false;
    }
    return true;
}

// Star rating functionality
let ratings = { quality: 0, delivery: 0, service: 0 };

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('star')) {
        const ratingContainer = e.target.closest('.star-rating');
        const ratingType = ratingContainer.dataset.rating;
        const value = parseInt(e.target.dataset.value);
        
        ratings[ratingType] = value;
        
        // Update visual state
        const stars = ratingContainer.querySelectorAll('.star');
        stars.forEach((star, index) => {
            if (index < value) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
        
        // Update rating text
        const ratingText = document.getElementById(`${ratingType}-text`);
        const ratingLabels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];
        ratingText.textContent = ratingLabels[value];
        ratingText.classList.add('selected');
    }
});

// Character counter
document.getElementById('reviewText').addEventListener('input', function() {
    const text = this.value;
    const count = text.length;
    const counter = document.getElementById('charCount');
    
    counter.textContent = count;
    
    if (count > 450) {
        counter.parentElement.classList.add('warning');
    } else {
        counter.parentElement.classList.remove('warning');
    }
});

// Submit review function (placeholder)
function submitReview() {
    // Validate required ratings
    if (ratings.quality === 0 || ratings.delivery === 0 || ratings.service === 0) {
        alert('Mohon berikan penilaian untuk semua kategori (Kualitas Produk, Kecepatan Pengiriman, dan Pelayanan)');
        return;
    }
    
    // Get review text
    const reviewText = document.getElementById('reviewText').value;
    
    // Here you would normally send the data to your backend
    console.log('Review Data:', {
        ratings: ratings,
        reviewText: reviewText,
        photos: uploadedPhotos.map(photo => photo.file)
    });
    
    // For now, just show success message
    alert('Terima kasih atas penilaian Anda!');
    closeModal('reviewModal');
    
    // Reset form
    resetReviewForm();
}

function updatePhotoGrid() {
    const grid = document.getElementById('photoUploadGrid');
    if (!grid) return;
    
    grid.innerHTML = '';
    
    // Add uploaded photos
    uploadedPhotos.forEach((photo, index) => {
        const photoItem = document.createElement('div');
        photoItem.className = 'photo-upload-item';
        photoItem.innerHTML = `
            <img src="${photo.url}" alt="Preview" class="photo-preview">
            <button class="remove-photo" onclick="removePhoto(${index})" title="Hapus foto">
                <i class="fas fa-times"></i>
            </button>
        `;
        grid.appendChild(photoItem);
    });
    
    // Add upload button if under limit
    if (uploadedPhotos.length < maxPhotos) {
        const uploadItem = document.createElement('div');
        uploadItem.className = 'photo-upload-item add-photo-btn';
        uploadItem.onclick = triggerFileInput;
        uploadItem.innerHTML = `
            <div class="upload-icon">
                <i class="fas fa-plus"></i>
            </div>
            <span>Tambah Foto</span>
            <span class="upload-count">${uploadedPhotos.length}/${maxPhotos}</span>
            <input type="file" id="photoInput" multiple accept="image/*" style="display: none;" onchange="handlePhotoUpload(event)">
        `;
        grid.appendChild(uploadItem);
    } else {
        // Show "limit reached" message
        const limitItem = document.createElement('div');
        limitItem.className = 'photo-upload-item upload-limit-reached';
        limitItem.innerHTML = `
            <div class="upload-icon" style="background: #e53e3e;">
                <i class="fas fa-exclamation"></i>
            </div>
            <span style="color: #e53e3e;">Maksimal ${maxPhotos} foto</span>
        `;
        grid.appendChild(limitItem);
    }
}

function showUploadSummary(accepted, rejected) {
    if (rejected > 0) {
        alert(`${accepted} foto berhasil diupload. ${rejected} foto ditolak karena melebihi batas maksimal ${maxPhotos} foto.`);
    }
    // Optional: Show success message for accepted files
    // if (accepted > 0 && rejected === 0) {
    //     console.log(`${accepted} foto berhasil diupload.`);
    // }
}

function removePhoto(index) {
    if (index >= 0 && index < uploadedPhotos.length) {
        uploadedPhotos.splice(index, 1);
        updatePhotoGrid();
    }
}

function resetReviewForm() {
    uploadedPhotos = [];
    ratings = { quality: 0, delivery: 0, service: 0 };
    document.getElementById('reviewText').value = '';
    document.getElementById('charCount').textContent = '0';
    
    // Reset star ratings
    document.querySelectorAll('.star').forEach(star => {
        star.classList.remove('active');
    });
    
    // Reset rating texts
    ['quality-text', 'delivery-text', 'service-text'].forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = 'Pilih rating';
            element.classList.remove('selected');
        }
    });
    
    // Reset character count warning
    const charCountElement = document.querySelector('.character-count');
    if (charCountElement) {
        charCountElement.classList.remove('warning');
    }
    
    updatePhotoGrid();
}

// PERBAIKAN: Inisialisasi grid saat modal dibuka
function showReviewModal(orderId) {
    currentOrderId = orderId;
    resetReviewForm();
    // Initialize photo grid saat modal dibuka
    setTimeout(() => {
        updatePhotoGrid();
    }, 100);
    document.getElementById('reviewModal').classList.add('show');
}

// Initialize saat DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan grid terinisialisasi saat halaman dimuat
    const photoGrid = document.getElementById('photoUploadGrid');
    if (photoGrid && uploadedPhotos.length === 0) {
        updatePhotoGrid();
    }
});
</script>