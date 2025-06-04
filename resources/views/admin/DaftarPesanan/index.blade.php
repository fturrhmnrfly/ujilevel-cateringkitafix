<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .content {
            padding: 20px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: white;
            color: #333;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .search-input {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f7f7f7;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #e0e0e0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
        }

        .btn-next-status {
            background-color: #28a745;
            color: white;
        }

        .btn-next-status:hover {
            background-color: #218838;
        }

        .btn-cancel-order {
            background-color: #dc3545;
            color: white;
        }

        .btn-cancel-order:hover {
            background-color: #c82333;
        }

        .btn-disabled {
            background-color: #6c757d;
            color: white;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .header {
            background-color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .admin-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-wrapper {
            position: relative;
        }

        .notification-icon {
            color: #333;
            font-size: 20px;
            text-decoration: none;
            padding: 5px;
            display: flex;
            align-items: center;
        }

        .notification-icon:hover {
            color: #2c2c77;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .stat-card p {
            margin: 5px 0 0;
            color: #666;
        }

        /* Status Badge Styles */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-diproses {
            background: #ffc107;
            color: #000;
        }

        .badge-dikirim {
            background: #17a2b8;
            color: #fff;
        }

        .badge-diterima {
            background: #28a745;
            color: #fff;
        }

        .badge-dibatalkan {
            background: #dc3545;
            color: #fff;
        }

        .badge-pending {
            background: #6c757d;
            color: #fff;
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
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            width: 500px;
            max-width: 90%;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .modal-title {
            font-size: 20px;
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
        }

        .modal-close:hover {
            color: #333;
        }

        .modal-body {
            margin-bottom: 25px;
        }

        .status-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .status-info h4 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 16px;
        }

        .status-flow {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }

        .status-current {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
        }

        .status-arrow {
            font-size: 18px;
            color: #28a745;
        }

        .status-next {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            background: #e8f5e8;
            color: #28a745;
        }

        .cancellation-section {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .cancellation-section.hidden {
            display: none;
        }

        .cancellation-reason {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-top: 10px;
            min-height: 80px;
            resize: vertical;
            font-family: inherit;
        }

        .modal-actions {
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

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .modal-content {
                width: 95%;
                margin: 20px;
            }
        }
    </style>
</head>

<body>
    <x-sidebar />

    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Daftar Pesanan</h1>
            <div class="admin-controls">
                <div class="notification-wrapper">
                    <a href="{{ route('admin.notifications.index') }}" class="notification-icon">
                        <i class="fa-solid fa-bell"></i>
                        @php
                            $unreadCount = \App\Models\NotificationAdmin::where('admin_id', auth()->id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="notification-badge">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </div>
                <div class="admin-profile">
                    <span>Admin</span>
                    <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
                </div>
            </div>
        </div>

        <div class="content">
            <!-- Real-time Statistics -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3 id="stat-total">{{ $stats['total'] }}</h3>
                    <p>Semua Pesanan</p>
                </div>
                <div class="stat-card">
                    <h3 id="stat-pending">{{ $stats['belum_bayar'] }}</h3>
                    <p>Belum Bayar</p>
                </div>
                <div class="stat-card">
                    <h3 id="stat-diproses">{{ $stats['diproses'] }}</h3>
                    <p>Diproses</p>
                </div>
                <div class="stat-card">
                    <h3 id="stat-dikirim">{{ $stats['dikirim'] }}</h3>
                    <p>Dikirim</p>
                </div>
                <div class="stat-card">
                    <h3 id="stat-selesai">{{ $stats['selesai'] }}</h3>
                    <p>Selesai</p>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pesanan</th>
                            <th>Nama pelanggan</th>
                            <th>Kategori Pesanan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Jumlah Pesanan</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Waktu Pengiriman</th>
                            <th>Alamat Pengiriman</th>
                            <th>Nomor Telepon</th>
                            <th>Pesan</th>
                            <th>Opsi Pengiriman</th>
                            <th>Total Harga</th>
                            <th>Status pengiriman</th>
                            <th>Status pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanans as $pesanan)
                        <tr data-order-id="{{ $pesanan->id }}" data-order-status="{{ $pesanan->status_pengiriman }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pesanan->order_id }}</td>
                            <td>{{ $pesanan->nama_pelanggan }}</td>
                            <td>{{ $pesanan->kategori_pesanan }}</td>
                            <td>{{ $pesanan->tanggal_pesanan->format('d/m/Y') }}</td>
                            <td>{{ $pesanan->jumlah_pesanan }}</td>
                            <td>{{ $pesanan->tanggal_pengiriman }}</td>
                            <td>{{ $pesanan->waktu_pengiriman }}</td>
                            <td>{{ $pesanan->lokasi_pengiriman }}</td>
                            <td>{{ $pesanan->nomor_telepon }}</td>
                            <td>{{ $pesanan->pesan }}</td>
                            <td>{{ $pesanan->opsi_pengiriman }}</td>
                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status_pengiriman }}">
                                    {{ ucfirst($pesanan->status_pengiriman) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status_pembayaran }}">
                                    {{ strtoupper($pesanan->status_pembayaran) }}
                                </span>
                            </td>
                            <td>
                                @if($pesanan->status_pengiriman === 'diterima' || $pesanan->status_pengiriman === 'dibatalkan')
                                    <button class="btn-action btn-disabled" disabled>
                                        Selesai
                                    </button>
                                @else
                                    <button class="btn-action btn-next-status" onclick="showUpdateModal('{{ $pesanan->id }}', '{{ $pesanan->status_pengiriman }}', '{{ $pesanan->order_id }}')">
                                        @if($pesanan->status_pengiriman === 'diproses')
                                            Kirim Pesanan
                                        @elseif($pesanan->status_pengiriman === 'dikirim')
                                            Pesanan Diterima
                                        @endif
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Status Pesanan</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            
            <div class="modal-body">
                <div class="status-info">
                    <h4>Pesanan: <span id="modal-order-id"></span></h4>
                    <div class="status-flow">
                        <span class="status-current" id="current-status"></span>
                        <span class="status-arrow">→</span>
                        <span class="status-next" id="next-status"></span>
                    </div>
                </div>

                <!-- Cancellation Section (Hidden by default) -->
                <div id="cancellation-section" class="cancellation-section hidden">
                    <h4 style="color: #dc3545; margin: 0 0 10px 0;">Batalkan Pesanan</h4>
                    <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">
                        Berikan alasan pembatalan pesanan untuk dokumentasi:
                    </p>
                    <textarea 
                        id="cancellation-reason" 
                        class="cancellation-reason" 
                        placeholder="Contoh: Stok habis, pelanggan membatalkan, dll..."
                    ></textarea>
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn-modal btn-secondary" onclick="closeModal()">
                    Batal
                </button>
                
                <!-- Show Cancel Button only for 'diproses' status -->
                <button id="btn-cancel-order" class="btn-modal btn-danger" onclick="toggleCancellation()" style="display: none;">
                    Batalkan Pesanan
                </button>
                
                <!-- Confirm buttons -->
                <button id="btn-confirm-update" class="btn-modal btn-success" onclick="confirmStatusUpdate()">
                    Konfirmasi Update
                </button>
                
                <button id="btn-confirm-cancel" class="btn-modal btn-danger" onclick="confirmCancellation()" style="display: none;">
                    Konfirmasi Pembatalan
                </button>
            </div>
        </div>
    </div>

    <script>
        // Global variables for modal state management
        let currentOrderId = null;
        let currentStatus = null;
        let nextStatus = null;
        let isShowingCancellation = false;

        /**
         * Status mapping configuration
         */
        const statusConfig = {
            'diproses': {
                next: 'dikirim',
                label: 'Diproses',
                nextLabel: 'Dikirim',
                canCancel: true
            },
            'dikirim': {
                next: 'diterima',
                label: 'Dikirim', 
                nextLabel: 'Diterima',
                canCancel: false
            }
        };

        /**
         * API Endpoints Configuration
         */
        const API_ENDPOINTS = {
            updateStatus: @js(route('admin.daftarpesanan.updateStatus', ['id' => ':id']))
        };

        /**
         * Show the status update modal
         * @param {string} orderId - The order ID
         * @param {string} status - Current status
         * @param {string} orderNumber - Order number for display
         */
        function showUpdateModal(orderId, status, orderNumber) {
            currentOrderId = orderId;
            currentStatus = status;
            
            const config = statusConfig[status];
            if (!config) {
                console.error('Invalid status configuration for:', status);
                return;
            }
            
            nextStatus = config.next;
            
            // Update modal content
            document.getElementById('modal-order-id').textContent = orderNumber;
            document.getElementById('current-status').textContent = config.label;
            document.getElementById('current-status').className = `status-current badge-${status}`;
            document.getElementById('next-status').textContent = config.nextLabel;
            
            // Show/hide cancel button based on status
            const cancelBtn = document.getElementById('btn-cancel-order');
            if (cancelBtn) {
                cancelBtn.style.display = config.canCancel ? 'inline-block' : 'none';
            }
            
            // Reset modal state
            resetModalState();
            
            // Show modal
            const modal = document.getElementById('updateModal');
            if (modal) {
                modal.classList.add('show');
            }
        }

        /**
         * Close the modal and reset state
         */
        function closeModal() {
            const modal = document.getElementById('updateModal');
            if (modal) {
                modal.classList.remove('show');
            }
            
            resetModalState();
            
            // Reset global variables
            currentOrderId = null;
            currentStatus = null;
            nextStatus = null;
            isShowingCancellation = false;
        }

        /**
         * Reset modal to default state
         */
        function resetModalState() {
            const elements = {
                cancellationSection: document.getElementById('cancellation-section'),
                confirmUpdateBtn: document.getElementById('btn-confirm-update'),
                confirmCancelBtn: document.getElementById('btn-confirm-cancel'),
                cancelOrderBtn: document.getElementById('btn-cancel-order'),
                reasonTextarea: document.getElementById('cancellation-reason')
            };
            
            // Check if all elements exist
            Object.entries(elements).forEach(([key, element]) => {
                if (!element) {
                    console.warn(`Element ${key} not found`);
                }
            });
            
            // Hide cancellation section
            if (elements.cancellationSection) {
                elements.cancellationSection.classList.add('hidden');
            }
            
            // Show update button, hide cancel confirmation
            if (elements.confirmUpdateBtn) {
                elements.confirmUpdateBtn.style.display = 'inline-block';
            }
            if (elements.confirmCancelBtn) {
                elements.confirmCancelBtn.style.display = 'none';
            }
            
            // Reset button text
            if (elements.cancelOrderBtn) {
                elements.cancelOrderBtn.textContent = 'Batalkan Pesanan';
            }
            
            // Clear textarea
            if (elements.reasonTextarea) {
                elements.reasonTextarea.value = '';
            }
            
            isShowingCancellation = false;
        }

        /**
         * Toggle cancellation section
         */
        function toggleCancellation() {
            const elements = {
                cancellationSection: document.getElementById('cancellation-section'),
                confirmUpdateBtn: document.getElementById('btn-confirm-update'),
                confirmCancelBtn: document.getElementById('btn-confirm-cancel'),
                cancelOrderBtn: document.getElementById('btn-cancel-order')
            };
            
            if (!isShowingCancellation) {
                // Show cancellation form
                if (elements.cancellationSection) {
                    elements.cancellationSection.classList.remove('hidden');
                }
                if (elements.confirmUpdateBtn) {
                    elements.confirmUpdateBtn.style.display = 'none';
                }
                if (elements.confirmCancelBtn) {
                    elements.confirmCancelBtn.style.display = 'inline-block';
                }
                if (elements.cancelOrderBtn) {
                    elements.cancelOrderBtn.textContent = 'Tutup Pembatalan';
                }
                isShowingCancellation = true;
            } else {
                // Hide cancellation form
                resetModalState();
            }
        }

        /**
         * Confirm status update (next status progression)
         */
        function confirmStatusUpdate() {
            if (!currentOrderId || !nextStatus) {
                showAlert('error', 'Data pesanan tidak valid');
                return;
            }
            
            const confirmBtn = document.getElementById('btn-confirm-update');
            if (confirmBtn) {
                confirmBtn.disabled = true;
                confirmBtn.textContent = 'Memproses...';
            }
            
            updateOrderStatus(currentOrderId, nextStatus, null);
        }

        /**
         * Confirm order cancellation
         */
        function confirmCancellation() {
            const reasonTextarea = document.getElementById('cancellation-reason');
            const reason = reasonTextarea ? reasonTextarea.value.trim() : '';
            
            if (!reason) {
                showAlert('warning', 'Silakan berikan alasan pembatalan pesanan');
                return;
            }
            
            const confirmBtn = document.getElementById('btn-confirm-cancel');
            if (confirmBtn) {
                confirmBtn.disabled = true;
                confirmBtn.textContent = 'Membatalkan...';
            }
            
            updateOrderStatus(currentOrderId, 'dibatalkan', reason);
        }

        /**
         * Send status update request to server
         * @param {string} orderId - Order ID
         * @param {string} newStatus - New status
         * @param {string|null} reason - Cancellation reason (if applicable)
         */
        function updateOrderStatus(orderId, newStatus, reason = null) {
            // Validate inputs
            if (!orderId || !newStatus) {
                showAlert('error', 'Parameter tidak lengkap');
                resetButtonStates();
                return;
            }

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                showAlert('error', 'CSRF token tidak ditemukan');
                resetButtonStates();
                return;
            }
            
            // Prepare request data
            const requestData = {
                status_pengiriman: newStatus,
                catatan: reason
            };
            
            // Build URL with proper ID substitution
            const updateUrl = API_ENDPOINTS.updateStatus.replace(':id', orderId);
            
            console.log('Sending request to:', updateUrl); // Debug log
            console.log('Request data:', requestData); // Debug log
            
            // Send request
            fetch(updateUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                },
                body: JSON.stringify(requestData)
            })
            .then(async response => {
                const responseText = await response.text();
                console.log('Raw response:', responseText); // Debug log
                
                let data;
                try {
                    data = JSON.parse(responseText);
                } catch (e) {
                    throw new Error(`Invalid JSON response: ${responseText}`);
                }
                
                if (!response.ok) {
                    throw new Error(data.message || `HTTP ${response.status}: ${response.statusText}`);
                }
                
                return data;
            })
            .then(data => {
                if (data.success) {
                    // Update UI
                    updateOrderRowUI(orderId, newStatus);
                    updateStatistics();
                    closeModal();
                    
                    // Show success message
                    const statusMessages = {
                        'dibatalkan': 'dibatalkan',
                        'dikirim': 'dikirim',
                        'diterima': 'diterima'
                    };
                    const statusLabel = statusMessages[newStatus] || 'diperbarui';
                    showAlert('success', `Pesanan berhasil ${statusLabel}!`);
                } else {
                    throw new Error(data.message || 'Gagal mengupdate status');
                }
            })
            .catch(error => {
                console.error('Update status error:', error);
                showAlert('error', `Terjadi kesalahan: ${error.message}`);
            })
            .finally(() => {
                resetButtonStates();
            });
        }

        /**
         * Reset button states after operation
         */
        function resetButtonStates() {
            const updateBtn = document.getElementById('btn-confirm-update');
            const cancelBtn = document.getElementById('btn-confirm-cancel');
            
            if (updateBtn) {
                updateBtn.disabled = false;
                updateBtn.textContent = 'Konfirmasi Update';
            }
            
            if (cancelBtn) {
                cancelBtn.disabled = false;
                cancelBtn.textContent = 'Konfirmasi Pembatalan';
            }
        }

        /**
         * Show alert message (can be replaced with better notification system)
         * @param {string} type - Alert type (success, error, warning)
         * @param {string} message - Alert message
         */
        function showAlert(type, message) {
            // For now, use browser alert. In production, consider using a toast library
            const icons = {
                success: '✅',
                error: '❌',
                warning: '⚠️'
            };
            
            alert(`${icons[type] || ''} ${message}`);
        }

        /**
         * Update order row UI after status change
         * @param {string} orderId - Order ID
         * @param {string} newStatus - New status
         */
        function updateOrderRowUI(orderId, newStatus) {
            const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
            if (!row) {
                console.warn(`Row with order ID ${orderId} not found`);
                return;
            }
            
            // Update status badge
            const statusBadge = row.querySelector('.badge-diproses, .badge-dikirim, .badge-diterima, .badge-dibatalkan');
            if (statusBadge) {
                statusBadge.className = `badge badge-${newStatus}`;
                statusBadge.textContent = ucfirst(newStatus);
            }
            
            // Update action button
            const actionCell = row.querySelector('td:last-child');
            if (actionCell) {
                if (newStatus === 'diterima' || newStatus === 'dibatalkan') {
                    actionCell.innerHTML = '<button class="btn-action btn-disabled" disabled>Selesai</button>';
                } else if (newStatus === 'dikirim') {
                    const orderNumber = row.cells[1] ? row.cells[1].textContent : '';
                    actionCell.innerHTML = `<button class="btn-action btn-next-status" onclick="showUpdateModal('${orderId}', '${newStatus}', '${orderNumber}')">Pesanan Diterima</button>`;
                }
            }
            
            // Update row data attribute
            row.setAttribute('data-order-status', newStatus);
        }

        /**
         * Update statistics in real-time
         */
        function updateStatistics() {
            const rows = document.querySelectorAll('tbody tr[data-order-status]');
            const stats = {
                total: rows.length,
                pending: 0,
                diproses: 0,
                dikirim: 0,
                selesai: 0
            };
            
            rows.forEach(row => {
                const status = row.getAttribute('data-order-status');
                switch(status) {
                    case 'pending':
                        stats.pending++;
                        break;
                    case 'diproses':
                        stats.diproses++;
                        break;
                    case 'dikirim':
                        stats.dikirim++;
                        break;
                    case 'diterima':
                        stats.selesai++;
                        break;
                }
            });
            
            // Update stat cards with error handling
            const statElements = {
                'stat-total': stats.total,
                'stat-pending': stats.pending,
                'stat-diproses': stats.diproses,
                'stat-dikirim': stats.dikirim,
                'stat-selesai': stats.selesai
            };
            
            Object.entries(statElements).forEach(([elementId, value]) => {
                const element = document.getElementById(elementId);
                if (element) {
                    element.textContent = value;
                }
            });
        }

        /**
         * Utility function to capitalize first letter
         * @param {string} string - String to capitalize
         * @returns {string} - Capitalized string
         */
        function ucfirst(string) {
            if (!string) return '';
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        /**
         * Event Listeners
         */
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize statistics
            updateStatistics();
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('updateModal');
                if (event.target === modal) {
                    closeModal();
                }
            });
            
            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>
</body>

</html>