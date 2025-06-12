<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Keuangan - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
            width: calc(100% - 250px);
        }

        .content {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Summary Cards */
        .summary-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
        }

        .summary-card {
            flex: 1;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .summary-card.pengeluaran {
            border-left: 4px solid #ff4444;
        }

        /* ✅ TAMBAHAN: STYLE UNTUK PEMASUKAN DAN LABA BERSIH ✅ */
        .summary-card.pemasukan {
            border-left: 4px solid #28a745;
        }

        .summary-card.laba-bersih {
            border-left: 4px solid #ffc107;
        }

        .summary-title {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            font-weight: normal;
        }

        .summary-amount {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        /* Controls Section */
        .controls-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
        }

        .search-filter {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-box {
            position: relative;
        }

        .search-input {
            padding: 12px 15px 12px 40px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            width: 250px;
            outline: none;
        }

        .search-input:focus {
            border-color: #007bff;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .filter-select {
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            outline: none;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: #007bff;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-add {
            background: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-add:hover {
            background: #218838;
        }

        .btn-export {
            background: #B8860B;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-export:hover {
            background: #9A7209;
        }

        /* Table Styles */
        .table-container {
            background: #D2B48C;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background: #D2B48C;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .table-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .table-content {
            background: white;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #D2B48C;
            color: #333;
            font-weight: bold;
            font-size: 16px;
            padding: 20px 25px;
            text-align: left;
            border: none;
        }

        td {
            padding: 20px 25px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .badge-pemasukan {
            background: #d4edda;
            color: #155724;
        }

        .badge-pengeluaran {
            background: #f8d7da;
            color: #721c24;
        }

        .btn-edit {
            background: #ffc107;
            color: #333;
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            margin-right: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit:hover {
            background: #e0a800;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #ddd;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <x-admin-header title="Laporan Keuangan" />

        <div class="content">
            <!-- Summary Cards -->
            @php
                $totalPemasukan = $laporans->where('jenis_laporan', 'pemasukan')->sum('total');
                $totalPengeluaran = $laporans->where('jenis_laporan', 'pengeluaran')->sum('total');
                $netProfit = $totalPemasukan - $totalPengeluaran;
            @endphp

            <div class="summary-cards">
                <div class="summary-card pemasukan">
                    <div class="summary-title">Total Pemasukan</div>
                    <div class="summary-amount">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                </div>
                <div class="summary-card pengeluaran">
                    <div class="summary-title">Total Pengeluaran</div>
                    <div class="summary-amount">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                </div>
                <div class="summary-card laba-bersih">
                    <div class="summary-title">Laba Bersih</div>
                    <div class="summary-amount">Rp {{ number_format($netProfit, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Controls Section -->
            <div class="controls-section">
                <div class="search-filter">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="pencarian" id="search-input">
                    </div>
                    <select class="filter-select" id="category-filter">
                        <option value="">Semua Kategori</option>
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('admin.laporan.create') }}" class="btn-add">
                        <i class="fas fa-plus"></i> Tambah Laporan Baru
                    </a>
                    <a href="{{ route('admin.laporan.export') }}" class="btn-export">
                        <i class="fas fa-chart-bar"></i> Export Excel
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <div class="table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Laporan</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Jumlah (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="laporan-table-body">
                            @forelse($laporans as $index => $laporan)
                            <tr class="laporan-row" 
                                data-id="{{ $laporan->id }}"
                                data-jenis="{{ strtolower($laporan->jenis_laporan) }}"
                                data-search="{{ strtolower($laporan->laporan . ' ' . $laporan->deskripsi . ' ' . $laporan->admin) }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $laporan->laporan }}</td>
                                <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d/m/Y') }}</td>
                                <td>
                                    @if($laporan->jenis_laporan == 'pemasukan')
                                        <span class="badge badge-pemasukan">Pemasukan</span>
                                    @else
                                        <span class="badge badge-pengeluaran">Pengeluaran</span>
                                    @endif
                                </td>
                                <td>
                                    @if($laporan->total > 0)
                                        {{ number_format($laporan->total, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.laporan.edit', $laporan->id) }}" class="btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn-delete" onclick="deleteLaporan({{ $laporan->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="fas fa-file-alt"></i>
                                    <div><strong>Belum ada laporan keuangan</strong></div>
                                    <div>Laporan akan muncul di sini setelah dibuat</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for search and filter functionality
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const categoryFilter = document.getElementById('category-filter');
            const laporanRows = document.querySelectorAll('.laporan-row');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value;

                laporanRows.forEach(row => {
                    const jenis = row.getAttribute('data-jenis');
                    const searchContent = row.getAttribute('data-search');

                    const isSearchMatch = searchContent.includes(searchTerm);
                    const isCategoryMatch = selectedCategory === '' || jenis === selectedCategory;

                    if (isSearchMatch && isCategoryMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
            categoryFilter.addEventListener('change', filterTable);
        });

        // ✅ UPDATED: JavaScript for delete functionality yang sebenarnya menghapus dari database ✅
        function deleteLaporan(id) {
            if (confirm('Apakah Anda yakin ingin menghapus laporan ini?')) {
                // Disable delete button temporarily
                const deleteBtn = document.querySelector(`button[onclick="deleteLaporan(${id})"]`);
                if (deleteBtn) {
                    deleteBtn.disabled = true;
                    deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                }

                // Send DELETE request to server
                fetch(`/admin/laporan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Remove row from table
                        const row = document.querySelector(`tr.laporan-row[data-id="${id}"]`);
                        if (row) {
                            row.remove();
                        }
                        
                        // Show success message
                        alert('Laporan berhasil dihapus!');
                        
                        // Reload page to update statistics
                        window.location.reload();
                    } else {
                        throw new Error(data.message || 'Gagal menghapus laporan');
                    }
                })
                .catch(error => {
                    console.error('Delete error:', error);
                    alert('Terjadi kesalahan: ' + error.message);
                    
                    // Re-enable button if error
                    if (deleteBtn) {
                        deleteBtn.disabled = false;
                        deleteBtn.innerHTML = '<i class="fas fa-trash"></i> Delete';
                    }
                });
            }
        }
    </script>
</body>
</html>
