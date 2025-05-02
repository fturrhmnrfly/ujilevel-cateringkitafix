<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .content {
            padding: 20px;
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

        .status-selesai {
            color: #28a745;
        }

        .status-dibatalkan {
            color: #dc3545;
        }

        .view-file-btn {
            background-color: #6c757d;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .view-file-btn:hover {
            background-color: #5a6268;
        }

        .update-status-btn {
            background-color: #0d6efd;
            color: white;
            padding: 5px 15px;
            border-radius: 4px;
            border: none;
            font-size: 14px;
        }

        .search-input {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 250px;
            margin-bottom: 20px;
        }

        /* Tambahkan di dalam tag <style> yang sudah ada */

        .main-content {
            margin-left: 250px;
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
        }

        .search-box {
            margin: 20px 0;
        }

        .search-box input {
            width: 300px;
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        td button {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            border: none;
        }

        .view-file {
            background: #6c757d;
            color: white;
        }

        .update-status {
            background: #0d6efd;
            color: white;
        }

        .status-column {
            font-weight: 500;
        }

        .description-column {
            color: #666;
            max-width: 250px;
        }

        .transaction-date {
            color: #666;
            font-size: 14px;
        }

        .transaction-id {
            font-family: monospace;
            color: #444;
        }

        .price-column {
            font-weight: 500;
            color: #333;
        }

        /* Add these styles to the existing <style> section */
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
            max-width: 500px; /* Batasi lebar maksimum */
            max-height: 500px; /* Batasi tinggi maksimum */
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
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Transaksi</h2>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                        <tr>
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
                                    Lihat Bukti 
                                </button>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="{{ $transaksi->status_transaksi === 'Selesai' ? 'status-selesai' : 'status-dibatalkan' }}">
                                {{ $transaksi->status_transaksi }}
                            </td>
                            <td>{{ $transaksi->deskripsi_tindakan }}</td>
                            <td>
                                <button class="update-status-btn" onclick="updateStatus('{{ $transaksi->id }}')">
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

    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h3 id="modalTitle" style="margin-bottom: 10px;"></h3>
            
            <!-- Informasi tambahan transaksi dalam modal -->
            <div class="modal-transaction-info">
                <p>Nama Pelanggan: <span id="modalCustomerName"></span></p>
                <p>Tanggal Transaksi: <span id="modalTransactionDate"></span></p>
                <p>Total Pembayaran: <span id="modalTransactionAmount" class="transaction-amount"></span></p>
            </div>
            
            <img id="modalImage" class="modal-image" src="" alt="Bukti Pembayaran">
        </div>
    </div>

    <script>
        function updateStatus(id) {
            // Implementasi update status
            console.log('Update status untuk transaksi:', id);
            // Tambahkan logika untuk membuka modal atau form update status
        }

        // Fungsi pencarian
        document.querySelector('.search-input').addEventListener('input', function(e) {
            const searchText = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });

        // Fungsi untuk melihat gambar bukti pembayaran dengan informasi transaksi
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

        // Tutup modal ketika mengklik tombol X
        document.querySelector('.modal-close').addEventListener('click', function() {
            document.getElementById('imageModal').classList.remove('show');
        });

        // Tutup modal ketika mengklik di luar modal
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });

        // Tutup modal dengan tombol Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('imageModal').classList.contains('show')) {
                document.getElementById('imageModal').classList.remove('show');
            }
        });
    </script>
</body>
</html>