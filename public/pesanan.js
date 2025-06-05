let currentOrderId = null;
let ordersData = [];

function showOrderDetail(orderId) {
    const order = ordersData.find(o => o.id === orderId);
    if (!order) return alert('Data pesanan tidak ditemukan');

    document.getElementById('modal-order-id').textContent = order.order_id;
    document.getElementById('modal-order-date').textContent = formatDate(order.created_at);
    
    const statusElement = document.getElementById('modal-order-status');
    const isUnpaidContext = order.status_pembayaran === 'pending';
    
    if (isUnpaidContext) {
        statusElement.textContent = 'Belum Bayar';
        statusElement.className = 'status-indicator pending';
    } else {
        statusElement.textContent = capitalizeFirst(order.status_pengiriman);
        statusElement.className = `status-indicator ${order.status_pengiriman}`;
    }

    ['modal-kategori', 'modal-jumlah', 'modal-delivery-date', 'modal-delivery-time', 'modal-address', 'modal-phone', 'modal-shipping', 'modal-total'].forEach(id => {
        const element = document.getElementById(id);
        const value = id === 'modal-jumlah' ? order.jumlah_pesanan + ' porsi'
                    : id === 'modal-delivery-date' ? formatDate(order.tanggal_pengiriman)
                    : id === 'modal-shipping' ? capitalizeFirst(order.opsi_pengiriman)
                    : id === 'modal-total' ? formatCurrency(order.total_harga)
                    : order[id.replace('modal-', '').replace('-', '_')];
        element.textContent = value;
    });

    const messageRow = document.getElementById('modal-message-row');
    if (order.pesan) {
        document.getElementById('modal-message').textContent = order.pesan;
        messageRow.style.display = 'flex';
    } else {
        messageRow.style.display = 'none';
    }

    const paymentStatusElement = document.getElementById('modal-payment-status');
    paymentStatusElement.textContent = order.status_pembayaran === 'pending' ? 'Belum Bayar' : 'Sudah Bayar';
    paymentStatusElement.className = `status-indicator ${order.status_pembayaran === 'pending' ? 'pending' : 'diterima'}`;

    document.getElementById('orderDetailModal').classList.add('show');
}

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

// Fungsi untuk menandai order sudah direview setelah submit review
function markOrderAsReviewed(orderId) {
    const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
    if (!orderCard) {
        console.log('Order card not found for orderId:', orderId);
        return;
    }
    
    // Update attribute
    orderCard.setAttribute('data-has-review', 'true');
    
    // Update button jika order sudah diterima
    const actionButtons = orderCard.querySelector('.action-buttons');
    const reviewButton = actionButtons?.querySelector('.btn-review');
    
    if (reviewButton) {
        reviewButton.outerHTML = '<button class="btn-reviewed" disabled><i class="fas fa-star"></i> Sudah Diulas</button>';
    }
}

// Update function showReviewModal dengan error handling
function showReviewModal(orderId) {
    currentOrderId = orderId;
    
    console.log('Opening review modal for order:', orderId);
    
    // Reset form
    if (typeof resetReviewForm === 'function') {
        resetReviewForm();
    }
    
    // Show modal
    const modal = document.getElementById('reviewModal');
    if (modal) {
        modal.classList.add('show');
        
        // Initialize photo grid
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

    const statusBadge = orderCard.querySelector('.status-badge');
    if (statusBadge) {
        statusBadge.className = `status-badge ${newStatus}`;
        statusBadge.textContent = capitalizeFirst(newStatus);
    }

    const actionButtons = orderCard.querySelector('.action-buttons');
    if (actionButtons && newStatus === 'diterima') {
        // Check apakah sudah ada review
        const hasReview = orderCard.getAttribute('data-has-review') === 'true';
        
        const reviewButton = hasReview 
            ? '<button class="btn-reviewed" disabled><i class="fas fa-star"></i> Sudah Diulas</button>'
            : `<button class="btn-review" onclick="showReviewModal(${orderId})"><i class="fas fa-star"></i> Beri Ulasan</button>`;
        
        actionButtons.innerHTML = `
            <button class="btn-reorder" onclick="reorderItems(${orderId})">
                <i class="fas fa-redo"></i> Beli Lagi
            </button>
            ${reviewButton}`;
    }

    orderCard.setAttribute('data-order-status', newStatus);
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('show');
    }
}

function showMessage(message, type) {
    const div = document.createElement('div');
    div.style.cssText = `position: fixed; top: 20px; right: 20px; padding: 15px 20px; border-radius: 8px; z-index: 3000; box-shadow: 0 4px 12px rgba(0,0,0,0.2); background: ${type === 'success' ? '#28a745' : '#dc3545'}; color: white;`;
    div.textContent = message;
    document.body.appendChild(div);
    setTimeout(() => div.remove(), type === 'success' ? 3000 : 4000);
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);
}

function capitalizeFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Pesanan.js loaded');
    
    // Add debug info
    console.log('Current page URL:', window.location.href);
    console.log('CSRF token:', document.querySelector('meta[name="csrf-token"]')?.content);
});