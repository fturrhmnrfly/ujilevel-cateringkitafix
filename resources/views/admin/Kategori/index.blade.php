<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - Admin</title>
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

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 300px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .tambah-btn {
            background-color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #333;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .edit-btn, .delete-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
        }

        .edit-btn i, .delete-btn i {
            font-size: 14px;
        }

        .delete-btn {
            background-color: #dc3545;
            border: none;
            color: white;
        }

        .edit-btn {
            background-color: #ffc107;
            color: #000;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .edit-btn:hover {
            background-color: #e0a800;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <x-sidebar/>
    
    <div class="main-content">
        <div class="header">
            <h1 class="page-title">{{ $title ?? 'Kategori' }}</h1>
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

        <div class="search-box">
            <input type="text" placeholder="Search Karyawan...">
        </div>

        <div class="content-header">
            <h3>Kategori</h3>
            <a href="{{ route('admin.kategori.create') }}" class="tambah-btn">
                <span>+</span> Tambah Kategori
            </a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $menu)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $menu['nama_kategori'] }}</td>
                            <td>{{ $menu['deskripsi'] }}</td>
                            <td>{{ $menu['jumlah_item'] }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.kategori.edit', ['kategori' => $menu['id'], 'type' => $menu['type']]) }}" class="edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form id="delete-form-{{ $menu['id'] }}" action="{{ route('admin.kategori.destroy', $menu['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn" onclick="confirmDelete('delete-form-{{ $menu['id'] }}')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada menu tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
function confirmDelete(formId) {
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Data ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

// Success message after delete
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
});
</script>
</body>
</html>