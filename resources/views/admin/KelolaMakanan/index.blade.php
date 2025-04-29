<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita Admin - Kelola Makanan</title>
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: background-color 0.3s;
        }

        .search-input {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
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

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: block;
        }

        .image-cell {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1 class="page-title">{{ $title ?? 'Kelola Makanan' }}</h1>
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
            <div class="content-header">
                <a href="{{ route('admin.kelolamakanan.create') }}" class="btn-primary">Tambah Makanan</a>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari makanan...">
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Images</th>
                            <th>Nama makanan</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($makanans as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="image-cell">
                                    @if($item->image && Storage::disk('public')->exists($item->image))
                                        <img src="{{ Storage::url($item->image) }}" 
                                             alt="{{ $item->nama_makanan }}" 
                                             class="product-image">
                                    @else
                                        <img src="{{ asset('assets/default-food.png') }}" 
                                             alt="Default food image" 
                                             class="product-image">
                                    @endif
                                </td>
                                <td>{{ $item->nama_makanan }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>Rp.{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="status-{{ $item->status == 'Tersedia' ? 'available' : 'unavailable' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('admin.kelolamakanan.edit', $item->id) }}" class="btn-warning">Edit</a>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.kelolamakanan.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('delete-form-{{ $item->id }}')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(id).submit();
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil dihapus.',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    </script>
</body>
</html>
