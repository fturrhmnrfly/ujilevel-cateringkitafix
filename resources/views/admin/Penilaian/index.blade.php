<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Penilaian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            background-color: #f8f9fa;
        }

        .content {
            padding: 20px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 12px 16px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #26276B;
            box-shadow: 0 0 0 3px rgba(38, 39, 107, 0.1);
        }

        .filter-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 16px;
            border: 1px solid #dee2e6;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        .filter-btn:hover {
            background: #f8f9fa;
            border-color: #26276B;
        }

        .filter-btn.active {
            background: #26276B;
            color: white;
            border-color: #26276B;
            box-shadow: 0 2px 4px rgba(38, 39, 107, 0.2);
        }

        .table-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 16px 12px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th:first-child {
            width: 60px;
            text-align: center;
        }

        th:nth-child(2) { width: 120px; }
        th:nth-child(3) { width: 150px; }
        th:nth-child(4) { width: 180px; }
        th:nth-child(5) { width: 200px; }
        th:nth-child(6) { width: 250px; }
        th:nth-child(7) { width: 120px; }
        th:nth-child(8) { width: 130px; }
        th:nth-child(9) { width: 100px; }
        th:nth-child(10) { width: 140px; }

        td {
            padding: 16px 12px;
            border-bottom: 1px solid #f1f3f4;
            vertical-align: top;
            line-height: 1.5;
        }

        tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }

        tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        tr:nth-child(even):hover {
            background-color: #f8f9fa;
        }

        .btn-view {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 6px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-view:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
            color: white;
        }

        .btn-hide {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 6px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-hide:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
            color: white;
        }

        .btn-verify {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 6px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-verify:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
            color: white;
        }

        .rating {
            color: #ffc107;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .rating i {
            margin-right: 1px;
        }

        .rating-breakdown {
            font-size: 11px;
            color: #6c757d;
            line-height: 1.3;
            background: #f8f9fa;
            padding: 4px 8px;
            border-radius: 4px;
            margin-top: 4px;
        }

        .review-text {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #495057;
            font-size: 13px;
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 3px solid #26276B;
        }

        .review-photos {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            align-items: center;
        }

        .review-photo {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .review-photo:hover {
            transform: scale(1.1);
            border-color: #26276B;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .photo-count {
            font-size: 11px;
            color: #6c757d;
            background: #e9ecef;
            padding: 2px 6px;
            border-radius: 4px;
            white-space: nowrap;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-hidden {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-verified {
            background: linear-gradient(135deg, #cce5ff 0%, #b3d9ff 100%);
            color: #0056b3;
            border: 1px solid #b3d9ff;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e9ecef;
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
            color: #495057;
            font-size: 20px;
            text-decoration: none;
            padding: 8px;
            display: flex;
            align-items: center;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .notification-icon:hover {
            color: #26276B;
            background: #f8f9fa;
        }

        .notification-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
            font-weight: 600;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #e9ecef;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            text-align: center;
            border: 1px solid #e9ecef;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #26276B;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 14px;
            font-weight: 500;
        }

        .text-muted {
            color: #6c757d !important;
            font-style: italic;
            font-size: 12px;
        }

        .order-id {
            font-weight: 600;
            color: #26276B;
            font-size: 13px;
        }

        .customer-name {
            font-weight: 500;
            color: #495057;
        }

        .product-name {
            font-weight: 500;
            color: #495057;
            line-height: 1.4;
        }

        .date-cell {
            font-size: 12px;
            color: #6c757d;
            white-space: nowrap;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            justify-content: center;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .table-container {
                overflow-x: auto;
            }
            
            table {
                min-width: 1000px;
            }
        }

        /* Loading animation for buttons */
        .btn-loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .btn-loading::after {
            content: '';
            width: 12px;
            height: 12px;
            margin-left: 4px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Manajemen Review & Penilaian</h1>
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
            <!-- Statistics -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number">{{ $penilaians->count() }}</div>
                    <div class="stat-label">Total Review</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $penilaians->where('rating', '>=', 4)->count() }}</div>
                    <div class="stat-label">Review Positif (≥4★)</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($penilaians->avg('rating'), 1) }}</div>
                    <div class="stat-label">Rating Rata-rata</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $penilaians->where('photos', '!=', null)->count() }}</div>
                    <div class="stat-label">Review dengan Foto</div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="content-header">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Semua</button>
                    <button class="filter-btn" data-filter="5">5 Bintang</button>
                    <button class="filter-btn" data-filter="4">4 Bintang</button>
                    <button class="filter-btn" data-filter="3">3 Bintang</button>
                    <button class="filter-btn" data-filter="low">≤2 Bintang</button>
                    <button class="filter-btn" data-filter="photos">Dengan Foto</button>
                </div>
                <input type="text" class="search-input" placeholder="Cari review, pelanggan, atau produk..." id="searchInput">
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Foto</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="reviewTable">
                        @forelse ($penilaians as $index => $penilaian)
                            <tr data-rating="{{ $penilaian->rating }}" 
                                data-photos="{{ $penilaian->photos ? 'yes' : 'no' }}"
                                data-status="{{ $penilaian->status ?? 'active' }}">
                                <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                <td>
                                    <span class="order-id">#{{ $penilaian->order_number }}</span>
                                </td>
                                <td>
                                    <span class="customer-name">{{ $penilaian->nama_pembeli }}</span>
                                </td>
                                <td>
                                    <span class="product-name">{{ $penilaian->nama_produk }}</span>
                                </td>
                                <td>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if($i <= $penilaian->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span style="color: #495057; margin-left: 4px; font-weight: 600;">{{ $penilaian->rating }}/5</span>
                                    </div>
                                    <div class="rating-breakdown">
                                        <strong>Detail:</strong><br>
                                        Kualitas: {{ $penilaian->quality_rating }}★<br>
                                        Pengiriman: {{ $penilaian->delivery_rating }}★<br>
                                        Pelayanan: {{ $penilaian->service_rating }}★
                                    </div>
                                </td>
                                <td>
                                    @if($penilaian->review_text)
                                        <div class="review-text" title="{{ $penilaian->review_text }}">
                                            {{ Str::limit($penilaian->review_text, 80) }}
                                        </div>
                                    @else
                                        <em class="text-muted">Tidak ada ulasan teks</em>
                                    @endif
                                </td>
                                <td>
                                    @if($penilaian->photos && count($penilaian->photos) > 0)
                                        <div class="review-photos">
                                            @foreach(array_slice($penilaian->photos, 0, 2) as $photo)
                                                <img src="{{ asset('storage/' . $photo) }}" 
                                                     alt="Review Photo" 
                                                     class="review-photo"
                                                     onclick="showPhotoModal('{{ asset('storage/' . $photo) }}')">
                                            @endforeach
                                            @if(count($penilaian->photos) > 2)
                                                <div class="photo-count">+{{ count($penilaian->photos) - 2 }} foto</div>
                                            @endif
                                        </div>
                                    @else
                                        <em class="text-muted">Tidak ada foto</em>
                                    @endif
                                </td>
                                <td class="date-cell">
                                    {{ $penilaian->created_at->format('d/m/Y') }}<br>
                                    <small>{{ $penilaian->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    @php
                                        $status = $penilaian->status ?? 'active';
                                    @endphp
                                    @if($status === 'active')
                                        <span class="status-badge status-active">Aktif</span>
                                    @elseif($status === 'hidden')
                                        <span class="status-badge status-hidden">Disembunyikan</span>
                                    @else
                                        <span class="status-badge status-reported">{{ ucfirst($status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-view" onclick="viewReview({{ $penilaian->id }})" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        @if(($penilaian->status ?? 'active') === 'active')
                                            <button class="btn-hide" onclick="hideReview({{ $penilaian->id }})" title="Sembunyikan">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        @else
                                            <button class="btn-verify" onclick="showReview({{ $penilaian->id }})" title="Tampilkan">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @endif
                                        
                                        <button type="button" class="btn-danger" onclick="confirmDelete({{ $penilaian->id }})" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty-state">
                                    <i class="fas fa-comment-slash"></i>
                                    <div><strong>Belum ada review yang tersedia</strong></div>
                                    <div>Review akan muncul di sini setelah pelanggan memberikan penilaian</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Photo Modal -->
    <div class="modal fade" id="photoModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalPhoto" src="" alt="Review Photo" style="max-width: 100%; height: auto; border-radius: 8px;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active button
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                const rows = document.querySelectorAll('#reviewTable tr');
                
                rows.forEach(row => {
                    const rating = parseFloat(row.dataset.rating);
                    const hasPhotos = row.dataset.photos === 'yes';
                    let show = false;
                    
                    switch(filter) {
                        case 'all':
                            show = true;
                            break;
                        case '5':
                            show = rating >= 4.5;
                            break;
                        case '4':
                            show = rating >= 3.5 && rating < 4.5;
                            break;
                        case '3':
                            show = rating >= 2.5 && rating < 3.5;
                            break;
                        case 'low':
                            show = rating <= 2.5;
                            break;
                        case 'photos':
                            show = hasPhotos;
                            break;
                    }
                    
                    row.style.display = show ? '' : 'none';
                });
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#reviewTable tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Photo modal
        function showPhotoModal(photoUrl) {
            document.getElementById('modalPhoto').src = photoUrl;
            new bootstrap.Modal(document.getElementById('photoModal')).show();
        }

        // View review detail
        function viewReview(reviewId) {
            // Add loading state
            const btn = event.target.closest('button');
            btn.classList.add('btn-loading');
            
            // Implement view review detail functionality
            window.location.href = `/admin/penilaian/${reviewId}`;
        }

        // TAMBAHKAN FUNGSI showReview untuk menampilkan kembali review yang tersembunyi
        function showReview(reviewId) {
            Swal.fire({
                title: 'Tampilkan Review?',
                text: "Review ini akan ditampilkan kembali ke publik",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, tampilkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateReviewStatus(reviewId, 'active', 'Review berhasil ditampilkan');
                }
            });
        }

        // PERBAIKAN FUNGSI hideReview
        function hideReview(reviewId) {
            Swal.fire({
                title: 'Sembunyikan Review?',
                text: "Review ini akan disembunyikan dari tampilan publik",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6c757d',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, sembunyikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateReviewStatus(reviewId, 'hidden', 'Review berhasil disembunyikan');
                }
            });
        }

        // FUNGSI BARU untuk update status (reusable)
        function updateReviewStatus(reviewId, newStatus, successMessage) {
            const btn = event.target.closest('button');
            if (btn) {
                btn.classList.add('btn-loading');
            }
            
            // Get CSRF token
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '{{ csrf_token() }}';
            
            if (!csrfToken) {
                Swal.fire('Error!', 'CSRF token tidak ditemukan', 'error');
                if (btn) btn.classList.remove('btn-loading');
                return;
            }
            
            // AJAX request to update status
            fetch(`/admin/penilaian/${reviewId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', successMessage, 'success');
                    
                    // Update UI tanpa reload
                    updateReviewRowUI(reviewId, newStatus);
                } else {
                    throw new Error(data.message || 'Gagal mengupdate status review');
                }
            })
            .catch(error => {
                console.error('Error updating review status:', error);
                if (btn) btn.classList.remove('btn-loading');
                Swal.fire('Error!', 'Terjadi kesalahan: ' + error.message, 'error');
            })
            .finally(() => {
                if (btn) btn.classList.remove('btn-loading');
            });
        }

        // FUNGSI BARU untuk update UI row tanpa reload
        function updateReviewRowUI(reviewId, newStatus) {
            const row = document.querySelector(`tr[data-rating]`);
            if (!row) return;
            
            // Cari row yang tepat berdasarkan review ID dari action button
            const rows = document.querySelectorAll('#reviewTable tr');
            let targetRow = null;
            
            rows.forEach(row => {
                const buttons = row.querySelectorAll('button[onclick*="' + reviewId + '"]');
                if (buttons.length > 0) {
                    targetRow = row;
                }
            });
            
            if (!targetRow) return;
            
            // Update status badge
            const statusCell = targetRow.cells[8]; // Status column
            if (statusCell) {
                if (newStatus === 'active') {
                    statusCell.innerHTML = '<span class="status-badge status-active">Aktif</span>';
                } else if (newStatus === 'hidden') {
                    statusCell.innerHTML = '<span class="status-badge status-hidden">Disembunyikan</span>';
                }
            }
            
            // Update action buttons
            const actionCell = targetRow.cells[9]; // Action column
            if (actionCell) {
                const actionButtons = actionCell.querySelector('.action-buttons');
                if (actionButtons) {
                    if (newStatus === 'active') {
                        // Show hide button
                        actionButtons.innerHTML = `
                            <button class="btn-view" onclick="viewReview(${reviewId})" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-hide" onclick="hideReview(${reviewId})" title="Sembunyikan">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                            <button type="button" class="btn-danger" onclick="confirmDelete(${reviewId})" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
                    } else if (newStatus === 'hidden') {
                        // Show show button
                        actionButtons.innerHTML = `
                            <button class="btn-view" onclick="viewReview(${reviewId})" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-verify" onclick="showReview(${reviewId})" title="Tampilkan">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn-danger" onclick="confirmDelete(${reviewId})" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
                    }
                }
            }
            
            // Update row data attribute
            targetRow.setAttribute('data-status', newStatus);
        }

        // confirmDelete function remains the same
        function confirmDelete(reviewId) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Review ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add loading state
                    const btn = event.target.closest('button');
                    if (btn) {
                        btn.classList.add('btn-loading');
                    }
                    
                    // Get CSRF token dengan error handling
                    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '{{ csrf_token() }}';
                    
                    if (!csrfToken) {
                        Swal.fire('Error!', 'CSRF token tidak ditemukan', 'error');
                        if (btn) btn.classList.remove('btn-loading');
                        return;
                    }
                    
                    // Create and submit form dengan CSRF token
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/penilaian/${reviewId}`;
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Success messages
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 1500,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    timer: 1500,
                    showConfirmButton: false
                });
            @endif
        });

        // Add smooth scrolling for better UX
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K for search focus
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.getElementById('searchInput');
                if (searchInput) {
                    searchInput.focus();
                }
            }
        });

        // Auto-refresh functionality (optional)
        let autoRefreshInterval;
        
        function startAutoRefresh() {
            autoRefreshInterval = setInterval(() => {
                // Only refresh if no modals are open
                if (!document.querySelector('.modal.show')) {
                    location.reload();
                }
            }, 300000); // Refresh every 5 minutes
        }

        function stopAutoRefresh() {
            if (autoRefreshInterval) {
                clearInterval(autoRefreshInterval);
            }
        }

        // Stop auto-refresh when page is not visible
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                stopAutoRefresh();
            } else {
                // startAutoRefresh();
            }
        });
    </script>
</body>
</html>