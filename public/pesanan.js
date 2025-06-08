let currentOrderId = null;
let currentCancelOrderId = null;

function acceptOrder(orderId) {
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

function redirectToPayment(orderId) {
    window.location.href = `/payment/metodepembayaran/${orderId}`;
}

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
    
    const actionButtons = orderCard.querySelector('.action-buttons');
    const reviewButton = actionButtons?.querySelector('.btn-review');
    
    if (reviewButton) {
        reviewButton.outerHTML = '<button class="btn-reviewed" disabled><i class="fas fa-star"></i> Sudah Diulas</button>';
    }
}

function showReviewModal(orderId) {
    currentOrderId = orderId;
    
    console.log('Opening review modal for order:', orderId);
    
    if (typeof resetReviewForm === 'function') {
        resetReviewForm();
    }
    
    const modal = document.getElementById('reviewModal');
    if (modal) {
        modal.classList.add('show');
        
        setTimeout(() => {
            if (typeof updatePhotoGrid === 'function') {
                updatePhotoGrid();
            }
        }, 100);
    } else {
        console.error('Review modal not found');
    }
}

// Tambahkan function untuk update status card setelah pembatalan
function updateOrderCardStatus(orderId, newStatus) {
    const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
    if (!orderCard) return;
    
    // Update status badge
    const statusBadge = orderCard.querySelector('.status-badge-new');
    if (statusBadge) {
        statusBadge.className = `status-badge-new ${newStatus}`;
        statusBadge.textContent = capitalizeFirst(newStatus);
    }
    
    // Update action buttons
    const actionButtons = orderCard.querySelector('.action-buttons-new');
    if (actionButtons && newStatus === 'dibatalkan') {
        actionButtons.innerHTML = `
            <button class="btn-reorder-new" onclick="reorderItems(${orderId})">
                <i class="fas fa-redo"></i> Pesan Lagi
            </button>
        `;
    }
    
    // Update data attribute
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

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
}

function formatCurrency(amount) {
    return `Rp ${parseInt(amount).toLocaleString('id-ID')}`;
}

function capitalizeFirst(str) {
    if (!str) return '';
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// ✅ TAMBAHKAN FUNGSI UNTUK CANCEL ORDER ✅
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
    
    // ✅ SEND CANCELLATION REQUEST KE BACKEND ✅
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

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Pesanan.js loaded');
    console.log('window.orderData available:', !!window.orderData);
    
    if (window.orderData) {
        console.log('Order IDs found:', Object.keys(window.orderData));
    }
});