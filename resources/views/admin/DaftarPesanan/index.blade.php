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

        .btn-warning {
            background-color: #FFA500;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #DC3545;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .status-available {
            color: #28a745;
            font-weight: 500;
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

        .message-column {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .message-content {
            color: #666;
            font-size: 14px;
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

        /* Add these CSS classes if not already present */
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
            background: #1e90ff;
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
        }

        .modal-content {
            background: white;
            width: 400px;
            margin: 100px auto;
            border-radius: 8px;
            padding: 20px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .status-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .status-notes {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 15px;
            min-height: 100px;
            resize: vertical;
            font-size: 14px;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            background: #e2e2e2;
            color: #333;
            cursor: pointer;
        }

        .btn-update {
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            background: #4040ff;
            color: white;
            cursor: pointer;
        }

        /* Status Badge Colors */
        .status-option-dikirim {
            background: #1e90ff;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            display: inline-block;
            font-size: 12px;
        }

        .status-option-dibatalkan {
            background: #dc3545;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            display: inline-block;
            font-size: 12px;
        }

        .status-option-diterima {
            background: #28a745;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            display: inline-block;
            font-size: 12px;
        }

        .status-option-diproses {
            background: #ffc107;
            color: black;
            padding: 4px 12px;
            border-radius: 4px;
            display: inline-block;
            font-size: 12px;
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
            <div class="stats-container">
                <div class="stat-card">
                    <h3>{{ $stats['total'] }}</h3>
                    <p>Semuah Pesanan</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $stats['belum_bayar'] }}</h3>
                    <p>Belum Bayar</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $stats['diproses'] }}</h3>
                    <p>Diproses</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $stats['dikirim'] }}</h3>
                    <p>Dikirim</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $stats['selesai'] }}</h3>
                    <p>Selesai</p>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Jumlah</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Total Harga</th>
                            <th>Status Pengiriman</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanans as $pesanan)
                        <tr data-order-id="{{ $pesanan->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pesanan->order_id }}</td>
                            <td>{{ $pesanan->nama_pelanggan }}</td>
                            <td>{{ $pesanan->tanggal_pesanan->format('d/m/Y') }}</td>
                            <td>{{ $pesanan->jumlah_pesanan }}</td>
                            <td>{{ $pesanan->lokasi_pengiriman }}</td>
                            <td>{{ $pesanan->nomor_telepon }}</td>
                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status_pengiriman }}">
                                    {{ ucfirst($pesanan->status_pengiriman) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge">{{ strtoupper($pesanan->status_pembayaran) }}</span>
                            </td>
                            <td>
                                <button class="btn-warning" onclick="updateStatus('{{ $pesanan->id }}')">
                                    Update Status
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambahkan modal di akhir body sebelum closing tag -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <h3 class="modal-title">Update Status Pesanan</h3>
            
            <select class="status-select" id="statusSelect">
                <option value="">Pilih Status Baru</option>
                <option value="diproses">Di Proses</option>
                <option value="dikirim">Dikirim</option>
                <option value="diterima">Diterima</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>

            <textarea class="status-notes" id="statusNotes" placeholder="Catatan Update Status Pesanan"></textarea>

            <div class="modal-buttons">
                <button class="btn-cancel" onclick="closeModal()">Batal</button>
                <button class="btn-update" onclick="confirmUpdate()">Update Status</button>
            </div>
        </div>
    </div>

    <script>
        let currentOrderId = null;

        function updateStatus(id) {
            currentOrderId = id;
            document.getElementById('updateModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('updateModal').style.display = 'none';
            document.getElementById('statusSelect').value = '';
            document.getElementById('statusNotes').value = '';
        }

        function confirmUpdate() {
            const newStatus = document.getElementById('statusSelect').value;
            const notes = document.getElementById('statusNotes').value;

            if (!newStatus) {
                alert('Silakan pilih status baru');
                return;
            }

            const updateBtn = document.querySelector('.btn-update');
            updateBtn.disabled = true;
            updateBtn.textContent = 'Memproses...';

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Update the URL to match the route
            fetch(`/admin/daftarpesanan/${currentOrderId}/status`, {
                method: 'POST', // Keep this as POST to match the route
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    status_pengiriman: newStatus,
                    catatan: notes
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const row = document.querySelector(`tr[data-order-id="${currentOrderId}"]`);
                    const statusBadge = row.querySelector('.badge');
                    statusBadge.className = `badge badge-${newStatus}`;
                    statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    
                    closeModal();
                    alert('Status berhasil diperbarui');
                    location.reload();
                } else {
                    throw new Error(data.message || 'Gagal mengupdate status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Terjadi kesalahan saat mengupdate status');
            })
            .finally(() => {
                updateBtn.disabled = false;
                updateBtn.textContent = 'Update Status';
            });
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('updateModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>
