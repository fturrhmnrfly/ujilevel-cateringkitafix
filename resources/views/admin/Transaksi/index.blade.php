<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .buat-transaksi {
            float: right;
            background: #2c2c77;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .search-input {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 250px;
            margin-bottom: 20px;
        }

        .table-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .status-selesai, .status-berhasil {
            color: #28a745;
            font-weight: 500;
        }

        .status-dibatalkan, .status-ditolak {
            color: #dc3545;
            font-weight: 500;
        }

        .status-menunggu-konfirmasi {
            color: #ffc107;
            font-weight: 500;
        }

        /* ✅ TAMBAHAN: STYLE UNTUK STATUS MENUNGGU PELUNASAN ✅ */
        .status-menunggu-pelunasan {
            color: #fd7e14;
            font-weight: 500;
        }

        .view-file-btn {
            background-color: #6c757d;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .view-file-btn:hover {
            background-color: #5a6268;
        }

        .update-status-btn {
            background-color: #0d6efd;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 5px;
        }

        .update-status-btn:hover {
            background-color: #0b5ed7;
        }

        .update-status-btn:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        }

        .modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 90%;
            max-height: 90vh;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .modal-image {
            max-width: 500px;
            max-height: 500px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .modal-transaction-info {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .modal-transaction-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .modal-transaction-info .transaction-amount {
            font-weight: bold;
            color: #0d6efd;
        }

        /* Update Status Modal */
        .update-modal {
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

        .update-modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .update-modal-content {
            background: white;
            width: 100%;
            max-width: 500px;
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

        .update-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
        }

        .update-modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .update-modal-close {
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

        .update-modal-close:hover {
            background: #f0f0f0;
            color: #333;
        }

        .update-modal-body {
            padding: 25px;
        }

        .update-modal-body p {
            margin: 0 0 15px 0;
            color: #666;
            font-size: 14px;
        }

        .update-modal-body p strong {
            color: #333;
            font-weight: 600;
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

        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            font-family: inherit;
            resize: vertical;
            min-height: 80px;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #4040ff;
        }

        .update-modal-actions {
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
            display: inline-flex;
            align-items: center;
            gap: 6px;
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

        .btn-modal:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .rejection-section {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .rejection-section.hidden {
            display: none;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <x-admin-header title="Transaksi" />

        <div class="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('admin.transaksi.create') }}" class="buat-transaksi">
                    <i class="fas fa-plus"></i> Buat Transaksi
                </a>
                <input type="text" class="search-input" placeholder="Cari transaksi...">
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Transaksi</th>
                            <th>ID Transaksi</th>
                            <th>Total Pembayaran</th>
                            <th>Bukti Transaksi</th>
                            <th>Status Transaksi</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                        <tr id="transaction-row-{{ $transaksi->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaksi->nama_pelanggan }}</td>
                            <td>
                                @if($transaksi->tanggal_transaksi instanceof \DateTime)
                                    {{ $transaksi->tanggal_transaksi->format('d/m/Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d/m/Y') }}
                                @endif
                            </td>
                            <td>{{ $transaksi->id_transaksi }}</td>
                            <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if($transaksi->bukti_pembayaran)
                                <button class="view-file-btn" onclick="viewImage('{{ asset('storage/' . $transaksi->bukti_pembayaran) }}', '{{ $transaksi->id_transaksi }}', '{{ $transaksi->nama_pelanggan }}', '{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d/m/Y') }}', '{{ number_format($transaksi->total_harga, 0, ',', '.') }}')">
                                    <i class="fas fa-eye"></i> Lihat Bukti 
                                </button>
                                @else
                                    -
                                @endif
                            </td>
                            <td id="status-cell-{{ $transaksi->id }}" class="{{ 
                                strtolower(str_replace(' ', '-', $transaksi->status_transaksi)) === 'berhasil' ? 'status-berhasil' : 
                                (strtolower(str_replace(' ', '-', $transaksi->status_transaksi)) === 'ditolak' ? 'status-ditolak' : 
                                (strtolower(str_replace(' ', '-', $transaksi->status_transaksi)) === 'menunggu-pelunasan' ? 'status-menunggu-pelunasan' : 'status-menunggu-konfirmasi')) 
                            }}">
                                {{ $transaksi->status_transaksi }}
                            </td>
                            <td id="description-cell-{{ $transaksi->id }}">{{ $transaksi->deskripsi_tindakan }}</td>
                            <td id="action-cell-{{ $transaksi->id }}">
                                @php
                                    $isCompleted = in_array(strtolower(str_replace(' ', '', $transaksi->status_transaksi)), ['berhasil', 'ditolak']);
                                    $isPending = strtolower(str_replace(' ', '', $transaksi->status_transaksi)) === 'menunggukonfirmasi';
                                    
                                    // ✅ LOGIC KHUSUS UNTUK COD ✅
                                    $isCodDp = str_contains($transaksi->id_transaksi, 'COD-DP-');
                                    $isCodSisa = str_contains($transaksi->id_transaksi, 'COD-') && !str_contains($transaksi->id_transaksi, 'COD-DP-');
                                    
                                    // ✅ PERBAIKAN: CEK STATUS YANG TEPAT UNTUK COD SISA ✅
                                    $isCodSisaMenungguPelunasan = $isCodSisa && strtolower(str_replace(' ', '', $transaksi->status_transaksi)) === 'menungguipelunasan';
                                    $isCodSisaPending = $isCodSisa && $isPending;
                                @endphp
                                
                                @if($isCompleted)
                                    <button class="update-status-btn" disabled>
                                        <i class="fas fa-check-circle"></i> Selesai
                                    </button>
                                @elseif($isPending)
                                    @if($isCodDp)
                                        {{-- COD DP Transaction - Normal buttons --}}
                                        <button class="update-status-btn btn-approve" onclick="showUpdateModal('{{ $transaksi->id }}', '{{ $transaksi->id_transaksi }}', '{{ $transaksi->nama_pelanggan }}', 'approve')">
                                            <i class="fas fa-check"></i> Setujui DP
                                        </button>
                                        <button class="update-status-btn btn-reject" onclick="showUpdateModal('{{ $transaksi->id }}', '{{ $transaksi->id_transaksi }}', '{{ $transaksi->nama_pelanggan }}', 'reject')">
                                            <i class="fas fa-times"></i> Tolak DP
                                        </button>
                                    @elseif($isCodSisaPending)
                                        {{-- COD Sisa Transaction - Status "Menunggu Konfirmasi" --}}
                                        <button class="update-status-btn btn-approve" onclick="showUpdateModal('{{ $transaksi->id }}', '{{ $transaksi->id_transaksi }}', '{{ $transaksi->nama_pelanggan }}', 'approve')">
                                            <i class="fas fa-check"></i> Konfirmasi Pelunasan
                                        </button>
                                        <button class="update-status-btn btn-reject" onclick="showUpdateModal('{{ $transaksi->id }}', '{{ $transaksi->id_transaksi }}', '{{ $transaksi->nama_pelanggan }}', 'reject')">
                                            <i class="fas fa-times"></i> Tolak Pelunasan
                                        </button>
                                    @else
                                        {{-- Regular Transaction --}}
                                        <button class="update-status-btn btn-approve" onclick="showUpdateModal('{{ $transaksi->id }}', '{{ $transaksi->id_transaksi }}', '{{ $transaksi->nama_pelanggan }}', 'approve')">
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                        <button class="update-status-btn btn-reject" onclick="showUpdateModal('{{ $transaksi->id }}', '{{ $transaksi->id_transaksi }}', '{{ $transaksi->nama_pelanggan }}', 'reject')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    @endif
                                @elseif($isCodSisaMenungguPelunasan)
                                    {{-- ✅ COD SISA MENUNGGU PELUNASAN - STATUS KHUSUS ✅ --}}
                                    <button class="update-status-btn" disabled title="Menunggu pelunasan dari pelanggan">
                                        <i class="fas fa-hourglass-half"></i> Menunggu Pelunasan
                                    </button>
                                @else
                                    {{-- Default case --}}
                                    <button class="update-status-btn" disabled>
                                        <i class="fas fa-check-circle"></i> Selesai
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

    <!-- Modal untuk menampilkan bukti pembayaran -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h3 id="modalTitle" style="margin-bottom: 10px;"></h3>
            
            <div class="modal-transaction-info">
                <p>Nama Pelanggan: <span id="modalCustomerName"></span></p>
                <p>Tanggal Transaksi: <span id="modalTransactionDate"></span></p>
                <p>Total Pembayaran: <span id="modalTransactionAmount" class="transaction-amount"></span></p>
            </div>
            
            <img id="modalImage" class="modal-image" src="" alt="Bukti Pembayaran">
        </div>
    </div>

    <!-- Modal Update Status -->
    <div id="updateStatusModal" class="update-modal">
        <div class="update-modal-content">
            <div class="update-modal-header">
                <h3 class="update-modal-title" id="modal-title">Update Status Transaksi</h3>
                <button class="update-modal-close" onclick="closeUpdateModal()">&times;</button>
            </div>
            
            <div class="update-modal-body">
                <div class="status-info">
                    <h4>Transaksi: <span id="modal-transaction-id"></span></h4>
                    <p><strong>Pelanggan:</strong> <span id="modal-customer-name"></span></p>
                    <p><strong>Status Saat Ini:</strong> <span class="status-menunggu-konfirmasi">Menunggu Konfirmasi</span></p>
                    <p><strong>Status Baru:</strong> <span id="modal-new-status"></span></p>
                </div>
                
                <p id="modal-confirmation-text">Apakah Anda yakin ingin mengkonfirmasi pembayaran ini?</p>
                
                <!-- Rejection Section (Hidden by default) -->
                <div id="rejection-section" class="rejection-section hidden">
                    <div class="form-group">
                        <label for="rejection-reason">Alasan Penolakan:</label>
                        <textarea 
                            id="rejection-reason" 
                            placeholder="Masukkan alasan penolakan transaksi..."
                        ></textarea>
                    </div>
                </div>
            </div>

            <div class="update-modal-actions">
                <button class="btn-modal btn-secondary" onclick="closeUpdateModal()">
                    Batal
                </button>
                <button id="btn-confirm-update" class="btn-modal btn-success" onclick="confirmStatusUpdate()">
                    <i class="fas fa-check"></i> Konfirmasi
                </button>
            </div>
        </div>
    </div>

    <!-- Bagian script tetap sama, hanya menambahkan logging untuk konfirmasi -->
    <script>
        let currentTransactionId = null;
        let currentAction = null; // 'approve' or 'reject'

        function showUpdateModal(transactionId, transactionNumber, customerName, action) {
            currentTransactionId = transactionId;
            currentAction = action;
            
            // Update modal content
            document.getElementById('modal-transaction-id').textContent = transactionNumber;
            document.getElementById('modal-customer-name').textContent = customerName;
            
            const modalTitle = document.getElementById('modal-title');
            const modalNewStatus = document.getElementById('modal-new-status');
            const modalConfirmationText = document.getElementById('modal-confirmation-text');
            const rejectionSection = document.getElementById('rejection-section');
            const confirmBtn = document.getElementById('btn-confirm-update');
            
            // ✅ DETECT COD TRANSACTION TYPE ✅
            const isCodDp = transactionNumber.includes('COD-DP-');
            const isCodSisa = transactionNumber.includes('COD-') && !transactionNumber.includes('COD-DP-');
            
            if (action === 'approve') {
                modalNewStatus.innerHTML = '<span class="status-berhasil">Berhasil</span>';
                rejectionSection.classList.add('hidden');
                confirmBtn.className = 'btn-modal btn-success';
                
                if (isCodDp) {
                    modalTitle.textContent = 'Setujui DP COD';
                    modalConfirmationText.textContent = 'Apakah Anda yakin ingin menyetujui Down Payment COD ini? Status pembayaran pesanan akan diperbarui ke "Paid".';
                    confirmBtn.innerHTML = '<i class="fas fa-check"></i> Setujui DP COD';
                } else if (isCodSisa) {
                    modalTitle.textContent = 'Konfirmasi Pelunasan COD';
                    modalConfirmationText.textContent = 'Apakah Anda yakin pelanggan telah melunasi sisa pembayaran COD? Status pesanan akan diperbarui.';
                    confirmBtn.innerHTML = '<i class="fas fa-check"></i> Konfirmasi Pelunasan';
                } else {
                    modalTitle.textContent = 'Setujui Transaksi';
                    modalConfirmationText.textContent = 'Apakah Anda yakin ingin menyetujui transaksi ini sebagai Berhasil? Status pembayaran pesanan terkait juga akan diperbarui.';
                    confirmBtn.innerHTML = '<i class="fas fa-check"></i> Setujui Transaksi';
                }
            } else {
                modalNewStatus.innerHTML = '<span class="status-ditolak">Ditolak</span>';
                rejectionSection.classList.remove('hidden');
                confirmBtn.className = 'btn-modal btn-danger';
                
                if (isCodDp) {
                    modalTitle.textContent = 'Tolak DP COD';
                    modalConfirmationText.textContent = 'Apakah Anda yakin ingin menolak Down Payment COD ini? Pesanan akan dibatalkan.';
                    confirmBtn.innerHTML = '<i class="fas fa-times"></i> Tolak DP COD';
                } else if (isCodSisa) {
                    modalTitle.textContent = 'Tolak Pelunasan COD';
                    modalConfirmationText.textContent = 'Apakah Anda yakin ingin menolak pelunasan COD ini? Status pembayaran akan gagal.';
                    confirmBtn.innerHTML = '<i class="fas fa-times"></i> Tolak Pelunasan';
                } else {
                    modalTitle.textContent = 'Tolak Transaksi';
                    modalConfirmationText.textContent = 'Apakah Anda yakin ingin menolak transaksi ini? Status pembayaran pesanan terkait juga akan diperbarui.';
                    confirmBtn.innerHTML = '<i class="fas fa-times"></i> Tolak Transaksi';
                }
            }
            
            // Show modal
            const modal = document.getElementById('updateStatusModal');
            if (modal) {
                modal.classList.add('show');
            }
        }

        function closeUpdateModal() {
            const modal = document.getElementById('updateStatusModal');
            if (modal) {
                modal.classList.remove('show');
            }
            
            // Reset values
            currentTransactionId = null;
            currentAction = null;
            document.getElementById('rejection-reason').value = '';
        }

        function confirmStatusUpdate() {
            if (!currentTransactionId || !currentAction) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Data transaksi tidak valid',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
                return;
            }
            
            let newStatus = '';
            let rejectionReason = '';
            
            if (currentAction === 'approve') {
                newStatus = 'Berhasil';
            } else {
                newStatus = 'Ditolak';
                rejectionReason = document.getElementById('rejection-reason').value.trim();
                
                if (!rejectionReason) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Silakan berikan alasan penolakan',
                        icon: 'warning',
                        confirmButtonColor: '#ffc107'
                    });
                    return;
                }
            }
            
            const confirmBtn = document.getElementById('btn-confirm-update');
            if (confirmBtn) {
                confirmBtn.disabled = true;
                confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            }
            
            updateTransactionStatus(currentTransactionId, newStatus, rejectionReason);
        }

        function updateTransactionStatus(transactionId, newStatus, rejectionReason = '') {
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                Swal.fire({
                    title: 'Error!',
                    text: 'CSRF token tidak ditemukan',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
                resetButtonState();
                return;
            }
            
            // Prepare request data
            const requestData = {
                status_transaksi: newStatus
            };
            
            if (rejectionReason) {
                requestData.alasan_penolakan = rejectionReason;
                requestData.deskripsi_tindakan = rejectionReason;
            }
            
            console.log('Sending update request:', requestData);
            
            // Send request
            fetch(`/admin/transaksi/${transactionId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                },
                body: JSON.stringify(requestData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update UI
                    updateTransactionRowUI(transactionId, newStatus, rejectionReason);
                    closeUpdateModal();
                    
                    // ✅ TAMBAHAN: UPDATE COD SISA TRANSACTION JIKA INI DP APPROVAL ✅
                    const transactionNumber = document.getElementById('modal-transaction-id').textContent;
                    if (transactionNumber.includes('COD-DP-') && newStatus === 'Berhasil') {
                        // Extract base order ID dan update COD Sisa transaction
                        const baseOrderId = transactionNumber.replace('COD-DP-', '');
                        updateCodSisaTransactionUI(baseOrderId);
                    }
                    
                    // Show enhanced success message
                    const actionText = newStatus === 'Berhasil' ? 'disetujui' : 'ditolak';
                    Swal.fire({
                        title: 'Berhasil!',
                        html: `
                            <p>Transaksi berhasil ${actionText}!</p>
                            <small style="color: #666;">Status pembayaran pesanan terkait juga telah diperbarui.</small>
                        `,
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.message || 'Gagal mengupdate status');
                }
            })
            .catch(error => {
                console.error('Update status error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: `Terjadi kesalahan: ${error.message}`,
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            })
            .finally(() => {
                resetButtonState();
            });
        }

        function updateTransactionRowUI(transactionId, newStatus, description = '') {
            const statusCell = document.getElementById(`status-cell-${transactionId}`);
            const actionCell = document.getElementById(`action-cell-${transactionId}`);
            const descriptionCell = document.getElementById(`description-cell-${transactionId}`);
            
            if (statusCell) {
                if (newStatus === 'Berhasil') {
                    statusCell.className = 'status-berhasil';
                } else if (newStatus === 'Ditolak') {
                    statusCell.className = 'status-ditolak';
                }
                statusCell.textContent = newStatus;
            }
            
            if (actionCell) {
                actionCell.innerHTML = `
                    <button class="update-status-btn" disabled>
                        <i class="fas fa-check-circle"></i> Selesai
                    </button>
                `;
            }
            
            if (descriptionCell && description) {
                descriptionCell.textContent = description;
            }
        }

        function resetButtonState() {
            const confirmBtn = document.getElementById('btn-confirm-update');
            if (confirmBtn) {
                confirmBtn.disabled = false;
                if (currentAction === 'approve') {
                    confirmBtn.innerHTML = '<i class="fas fa-check"></i> Setujui Transaksi';
                } else {
                    confirmBtn.innerHTML = '<i class="fas fa-times"></i> Tolak Transaksi';
                }
            }
        }

        /**
         * ✅ UPDATE COD SISA TRANSACTION UI SETELAH DP DISETUJUI ✅
         */
        function updateCodSisaTransactionUI(baseOrderId) {
            // Cari transaksi COD Sisa di tabel
            const rows = document.querySelectorAll('tr[id^="transaction-row-"]');
            rows.forEach(row => {
                const transactionIdCell = row.cells[3]; // Column ID Transaksi
                if (transactionIdCell && transactionIdCell.textContent.includes(`COD-${baseOrderId}`) && 
                    !transactionIdCell.textContent.includes('COD-DP-')) {
                    
                    // Update status dan button
                    const statusCell = row.querySelector('[id^="status-cell-"]');
                    const actionCell = row.querySelector('[id^="action-cell-"]');
                    
                    if (statusCell) {
                        statusCell.className = 'status-menunggu-konfirmasi';
                        statusCell.textContent = 'Menunggu Konfirmasi';
                    }
                    
                    if (actionCell) {
                        const transactionId = row.id.replace('transaction-row-', '');
                        const customerName = row.cells[1].textContent;
                        const transactionNumber = transactionIdCell.textContent;
                        
                        actionCell.innerHTML = `
                            <button class="update-status-btn btn-approve" onclick="showUpdateModal('${transactionId}', '${transactionNumber}', '${customerName}', 'approve')">
                                <i class="fas fa-check"></i> Konfirmasi Pelunasan
                            </button>
                            <button class="update-status-btn btn-reject" onclick="showUpdateModal('${transactionId}', '${transactionNumber}', '${customerName}', 'reject')">
                                <i class="fas fa-times"></i> Tolak Pelunasan
                            </button>
                        `;
                    }
                }
            });
        }

        function viewImage(imageUrl, transactionId, customerName, transactionDate, transactionAmount) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalCustomerName = document.getElementById('modalCustomerName');
            const modalTransactionDate = document.getElementById('modalTransactionDate');
            const modalTransactionAmount = document.getElementById('modalTransactionAmount');
            
            modalImage.src = imageUrl;
            modalTitle.textContent = `Bukti Pembayaran - ${transactionId}`;
            modalCustomerName.textContent = customerName;
            modalTransactionDate.textContent = transactionDate;
            modalTransactionAmount.textContent = `Rp ${transactionAmount}`;
            
            modal.classList.add('show');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Close image modal
            document.querySelector('.modal-close').addEventListener('click', function() {
                document.getElementById('imageModal').classList.remove('show');
            });

            document.getElementById('imageModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });

            // Close update modal when clicking outside
            document.getElementById('updateStatusModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeUpdateModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    document.getElementById('imageModal').classList.remove('show');
                    closeUpdateModal();
                }
            });
        });
    </script>
</body>
</html>