<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Include existing styles here -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .content {
            padding: 20px;
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
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            flex-shrink: 0;
        }

        .stat-icon.total {
            background: #6c757d;
        }

        .stat-icon.pending {
            background: #ffc107;
        }

        .stat-icon.diproses {
            background: #17a2b8;
        }

        .stat-icon.dikirim {
            background: #007bff;
        }

        .stat-icon.selesai {
            background: #28a745;
        }

        .stat-content {
            flex: 1;
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

        /* TAMBAHAN: Badge styling untuk status pembayaran */
        .badge-paid {
            background: #28a745;
            color: #fff;
        }

        .badge-failed {
            background: #dc3545;
            color: #fff;
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

        /* TAMBAHAN: Style untuk button menunggu pembayaran */
        .btn-payment-pending {
            background-color: #ffc107 !important;
            color: #000 !important;
            cursor: not-allowed !important;
            opacity: 0.8 !important;
        }

        .btn-payment-pending:hover {
            background-color: #ffc107 !important;
            color: #000 !important;
        }

        /* Modal Styles - Updated to match existing style */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            background: white;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            border-radius: 12px;
            overflow: hidden;
            animation: slideIn 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
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
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #f0f0f0;
            color: #333;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-body p {
            margin: 0 0 15px 0;
            color: #666;
            font-size: 14px;
        }

        .modal-body p strong {
            color: #333;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }

        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            font-family: inherit;
        }

        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4040ff;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .modal-actions {
            padding: 20px 25px;
            border-top: 1px solid #eee;
            background: #f8f9fa;
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
            font-family: inherit;
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

        .btn-success:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Loading state */
        .btn-loading {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Status info styles for modal */
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

        /* Responsive */
        @media (max-width: 768px) {
            .modal-content {
                margin: 10px;
                max-width: none;
            }
            
            .modal-header {
                padding: 15px 20px;
            }
            
            .modal-body {
                padding: 20px;
            }
            
            .modal-actions {
                padding: 15px 20px;
                flex-direction: column;
                gap: 10px;
            }

            .btn-modal {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <x-sidebar />

    <div class="main-content">
        <x-admin-header title="Daftar Pesanan" />

        <div class="content">
            <!-- Real-time Statistics -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-total">{{ $stats['total'] }}</h3>
                        <p>Semua Pesanan</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-pending">{{ $stats['belum_bayar'] }}</h3>
                        <p>Belum Bayar</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon diproses">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-diproses">{{ $stats['diproses'] }}</h3>
                        <p>Diproses</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon dikirim">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-dikirim">{{ $stats['dikirim'] }}</h3>
                        <p>Dikirim</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon selesai">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-selesai">{{ $stats['selesai'] }}</h3>
                        <p>Selesai</p>
                    </div>
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
                                <span class="badge badge-{{ $pesanan->status_pengiriman }}" id="status-badge-{{ $pesanan->id }}">
                                    {{ ucfirst($pesanan->status_pengiriman) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    // Mapping status pembayaran untuk tampilan
                                    $paymentStatusDisplay = match($pesanan->status_pembayaran) {
                                        'paid' => 'Berhasil',
                                        'failed' => 'Ditolak',
                                        'pending' => 'Pending',
                                        default => strtoupper($pesanan->status_pembayaran)
                                    };
                                @endphp
                                <span class="badge badge-{{ $pesanan->status_pembayaran }}" id="payment-status-badge-{{ $pesanan->id }}">
                                    {{ $paymentStatusDisplay }}
                                </span>
                            </td>
                            <td id="action-cell-{{ $pesanan->id }}">
                                @if($pesanan->status_pengiriman === 'diterima' || $pesanan->status_pengiriman === 'dibatalkan')
                                    <button class="btn-action btn-disabled" disabled>
                                        Selesai
                                    </button>
                                @elseif($pesanan->status_pengiriman === 'dikirim')
                                    <button class="btn-action btn-disabled" disabled>
                                        Menunggu Konfirmasi Pelanggan
                                    </button>
                                @elseif($pesanan->status_pengiriman === 'diproses')
                                    @if($pesanan->status_pembayaran === 'paid')
                                        {{-- ✅ STATUS PEMBAYARAN PAID - BUTTON AKTIF ✅ --}}
                                        <button class="btn-action btn-next-status" onclick="showUpdateModal('{{ $pesanan->id }}', '{{ $pesanan->status_pengiriman }}', '{{ $pesanan->order_id }}')">
                                            Kirim Pesanan
                                        </button>
                                    @else
                                        {{-- ✅ STATUS PEMBAYARAN BELUM PAID - BUTTON DISABLED ✅ --}}
                                        <button class="btn-action btn-disabled btn-payment-pending" disabled title="Menunggu konfirmasi pembayaran">
                                            <i class="fas fa-clock"></i> Menunggu Pembayaran
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Status Update Modal (Direct Action Style) -->
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

    <!-- Legacy Modal (tetap ada untuk backward compatibility) -->
    <div id="updateStatusModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Status Pesanan</h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            
            <div class="modal-body">
                <p><strong>Order ID:</strong> <span id="modalOrderId">-</span></p>
                <p><strong>Status Saat Ini:</strong> <span id="modalCurrentStatus">-</span></p>
                
                <div class="form-group">
                    <label for="newStatus">Status Baru:</label>
                    <select id="newStatus" name="status_pengiriman" required>
                        <option value="">Pilih Status</option>
                        <option value="diproses">Diproses</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="diterima">Diterima</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                
                <div class="form-group" id="catatanGroup" style="display: none;">
                    <label for="catatan">Catatan (Wajib untuk pembatalan):</label>
                    <textarea id="catatan" name="catatan" placeholder="Masukkan alasan pembatalan..."></textarea>
                </div>
            </div>
            
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-secondary" id="cancelBtn">Batal</button>
                <button type="button" class="btn-modal btn-success" id="confirmUpdateBtn">Update Status</button>
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
         * Show the status update modal (Direct Action Style)
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
         * ✅ TAMBAHKAN FUNCTION updateStatistics() YANG HILANG ✅
         */
        function updateStatistics() {
            try {
                // Count orders by status from current table rows
                const rows = document.querySelectorAll('tbody tr[data-order-id]');
                
                const stats = {
                    total: rows.length,
                    belum_bayar: 0,
                    diproses: 0,
                    dikirim: 0,
                    selesai: 0 // diterima + dibatalkan
                };

                rows.forEach(row => {
                    const orderStatus = row.getAttribute('data-order-status');
                    const paymentStatusBadge = row.querySelector('[id^="payment-status-badge-"]');
                    const paymentStatus = paymentStatusBadge ? 
                        (paymentStatusBadge.classList.contains('badge-paid') ? 'paid' : 
                         paymentStatusBadge.classList.contains('badge-failed') ? 'failed' : 'pending') : 'pending';
                    
                    // Count payment status
                    if (paymentStatus === 'pending') {
                        stats.belum_bayar++;
                    }
                    
                    // Count order status
                    switch (orderStatus) {
                        case 'diproses':
                            stats.diproses++;
                            break;
                        case 'dikirim':
                            stats.dikirim++;
                            break;
                        case 'diterima':
                        case 'dibatalkan':
                            stats.selesai++;
                            break;
                    }
                });

                // Update UI
                document.getElementById('stat-total').textContent = stats.total;
                document.getElementById('stat-pending').textContent = stats.belum_bayar;
                document.getElementById('stat-diproses').textContent = stats.diproses;
                document.getElementById('stat-dikirim').textContent = stats.dikirim;
                document.getElementById('stat-selesai').textContent = stats.selesai;

                console.log('Statistics updated:', stats);
            } catch (error) {
                console.error('Error updating statistics:', error);
            }
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
                status_pengiriman: newStatus
            };

            // Add catatan if provided
            if (reason && reason.trim()) {
                requestData.catatan = reason.trim();
            }
            
            console.log('Sending request:', requestData);
            
            // Send request
            fetch(`/admin/daftarpesanan/${orderId}/update-status`, {
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
                console.log('Raw response:', responseText);
                
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
                    updateStatistics(); // ✅ Sekarang function ini sudah ada
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
         * Show alert message
         * @param {string} type - Alert type (success, error, warning)
         * @param {string} message - Alert message
         */
        function showAlert(type, message) {
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
            const statusBadge = document.getElementById(`status-badge-${orderId}`);
            if (statusBadge) {
                // Remove all possible badge classes
                statusBadge.classList.remove('badge-diproses', 'badge-dikirim', 'badge-diterima', 'badge-dibatalkan');
                // Add new badge class
                statusBadge.classList.add(`badge-${newStatus}`);
                statusBadge.textContent = ucfirst(newStatus);
            }
            
            // Update action cell
            const actionCell = document.getElementById(`action-cell-${orderId}`);
            if (actionCell) {
                const orderNumber = row.cells[1] ? row.cells[1].textContent : orderId;
                
                // ✅ TAMBAHKAN PENGECEKAN STATUS PEMBAYARAN ✅
                const paymentStatusBadge = document.getElementById(`payment-status-badge-${orderId}`);
                const isPaymentPaid = paymentStatusBadge && paymentStatusBadge.classList.contains('badge-paid');
                
                // Update button based on new status
                if (newStatus === 'diterima' || newStatus === 'dibatalkan') {
                    actionCell.innerHTML = '<button class="btn-action btn-disabled" disabled>Selesai</button>';
                } else if (newStatus === 'dikirim') {
                    actionCell.innerHTML = '<button class="btn-action btn-disabled" disabled>Menunggu Konfirmasi Pelanggan</button>';
                } else if (newStatus === 'diproses') {
                    // ✅ CEK STATUS PEMBAYARAN UNTUK BUTTON KIRIM PESANAN ✅
                    if (isPaymentPaid) {
                        actionCell.innerHTML = `<button class="btn-action btn-next-status" onclick="showUpdateModal('${orderId}', '${newStatus}', '${orderNumber}')">Kirim Pesanan</button>`;
                    } else {
                        actionCell.innerHTML = `<button class="btn-action btn-disabled btn-payment-pending" disabled title="Menunggu konfirmasi pembayaran"><i class="fas fa-clock"></i> Menunggu Pembayaran</button>`;
                    }
                }
            }
            
            // Update row data attribute
            row.setAttribute('data-order-status', newStatus);
        }

        /**
         * ✅ TAMBAHAN: Function untuk update status pembayaran secara real-time ✅
         */
        function updatePaymentStatusUI(orderId, newPaymentStatus) {
            const paymentStatusBadge = document.getElementById(`payment-status-badge-${orderId}`);
            if (paymentStatusBadge) {
                // Remove existing payment status classes
                paymentStatusBadge.classList.remove('badge-paid', 'badge-failed', 'badge-pending');
                
                // Add new payment status class
                paymentStatusBadge.classList.add(`badge-${newPaymentStatus}`);
                
                // Update text based on status
                const statusText = {
                    'paid': 'Berhasil',
                    'failed': 'Ditolak',
                    'pending': 'Pending'
                };
                paymentStatusBadge.textContent = statusText[newPaymentStatus] || newPaymentStatus.toUpperCase();
                
                // ✅ UPDATE BUTTON KIRIM PESANAN BERDASARKAN STATUS PEMBAYARAN ✅
                const actionCell = document.getElementById(`action-cell-${orderId}`);
                const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
                const currentOrderStatus = row ? row.getAttribute('data-order-status') : null;
                
                if (actionCell && currentOrderStatus === 'diproses') {
                    const orderNumber = row.cells[1] ? row.cells[1].textContent : orderId;
                    
                    if (newPaymentStatus === 'paid') {
                        // Payment berhasil - aktifkan button
                        actionCell.innerHTML = `<button class="btn-action btn-next-status" onclick="showUpdateModal('${orderId}', 'diproses', '${orderNumber}')">Kirim Pesanan</button>`;
                    } else {
                        // Payment belum berhasil - disable button
                        actionCell.innerHTML = `<button class="btn-action btn-disabled btn-payment-pending" disabled title="Menunggu konfirmasi pembayaran"><i class="fas fa-clock"></i> Menunggu Pembayaran</button>`;
                    }
                }
            }
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

        // Legacy functions (tetap ada untuk backward compatibility)
        let currentOrderStatus = null;

        function showUpdateModal_legacy(orderId, currentStatus, orderNumber) {
            // Keep legacy function intact
            console.log('showUpdateModal called:', { orderId, currentStatus, orderNumber });
            
            currentOrderId = orderId;
            currentOrderStatus = currentStatus;
            
            // Populate modal
            document.getElementById('modalOrderId').textContent = orderNumber;
            document.getElementById('modalCurrentStatus').textContent = getStatusDisplay(currentStatus);
            
            // Reset form
            document.getElementById('newStatus').value = '';
            document.getElementById('catatan').value = '';
            document.getElementById('catatanGroup').style.display = 'none';
            
            // Show modal using class toggle
            document.getElementById('updateStatusModal').classList.add('show');
        }

        function closeUpdateModal() {
            document.getElementById('updateStatusModal').classList.remove('show');
            currentOrderId = null;
            currentOrderStatus = null;
        }

        function getStatusDisplay(status) {
            const statusMap = {
                'diproses': 'Diproses',
                'dikirim': 'Dikirim', 
                'diterima': 'Diterima',
                'dibatalkan': 'Dibatalkan'
            };
            return statusMap[status] || status;
        }

        function toggleCatatanField(status) {
            const catatanGroup = document.getElementById('catatanGroup');
            const catatanField = document.getElementById('catatan');
            
            if (status === 'dibatalkan') {
                catatanGroup.style.display = 'block';
                catatanField.required = true;
            } else {
                catatanGroup.style.display = 'none';
                catatanField.required = false;
            }
        }

        function updateOrderStatus_legacy() {
            // Keep legacy function intact
            if (!currentOrderId) {
                alert('Order ID tidak valid');
                return;
            }

            const newStatus = document.getElementById('newStatus').value;
            const catatan = document.getElementById('catatan').value;

            // Validasi input
            if (!newStatus) {
                alert('Silakan pilih status baru');
                return;
            }

            if (newStatus === 'dibatalkan' && !catatan.trim()) {
                alert('Catatan wajib diisi untuk pembatalan pesanan');
                return;
            }

            // Use the same updateOrderStatus function
            updateOrderStatus(currentOrderId, newStatus, catatan);
        }

        /**
         * Event Listeners
         */
        document.addEventListener('DOMContentLoaded', function() {
            // ✅ Initialize statistics saat halaman dimuat
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

            // Legacy modal event listeners
            const legacyCloseBtn = document.getElementById('closeModal');
            const legacyCancelBtn = document.getElementById('cancelBtn');
            const legacyConfirmBtn = document.getElementById('confirmUpdateBtn');
            const legacyStatusSelect = document.getElementById('newStatus');

            if (legacyCloseBtn) {
                legacyCloseBtn.addEventListener('click', closeUpdateModal);
            }
            if (legacyCancelBtn) {
                legacyCancelBtn.addEventListener('click', closeUpdateModal);
            }
            if (legacyStatusSelect) {
                legacyStatusSelect.addEventListener('change', function() {
                    toggleCatatanField(this.value);
                });
            }
            if (legacyConfirmBtn) {
                legacyConfirmBtn.addEventListener('click', updateOrderStatus_legacy);
            }

            console.log('Direct action system with legacy support loaded successfully');
        });
    </script>
</body>
</html>