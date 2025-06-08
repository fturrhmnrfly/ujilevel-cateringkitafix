let currentOrderId = null;

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
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Pesanan.js loaded');
    console.log('window.orderData available:', !!window.orderData);
    
    if (window.orderData) {
        console.log('Order IDs found:', Object.keys(window.orderData));
    }
});