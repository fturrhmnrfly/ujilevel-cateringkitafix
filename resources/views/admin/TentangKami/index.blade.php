<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Admin</title>
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
            gap: 6px; /* Tambahkan gap antara icon dan text */
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
            vertical-align: middle; /* Menyelaraskan konten secara vertikal */
            height: 60px; /* Memberikan tinggi minimum yang sama untuk semua sel */
        }

        th {
            background-color: #f8f9fa;
            font-weight: 500;
            height: 50px; /* Tinggi khusus untuk header */
        }

        /* Khusus untuk sel yang berisi gambar */
        td img {
            vertical-align: middle;
            display: block;
            margin: 0 auto;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: flex-start;
            height: 100%; /* Menggunakan full height dari parent */
        }

        .edit-btn {
            background: #ffc107;
            color: black;
            padding: 4px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Tambahkan gap antara icon dan text */
            height: 28px; /* Tinggi tetap untuk button */
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Tambahkan gap antara icon dan text */
            height: 28px; /* Tinggi tetap untuk button */
        }

        /* Styling untuk sel kosong */
        .empty-cell {
            text-align: center;
            color: #666;
            font-style: italic;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <x-admin-header title="Tentang Kami" />

        <div class="content">
            <div class="content-header">
                <a href="{{ route('admin.tentangkami.create') }}" class="tambah-btn">
                    <i class="fas fa-plus"></i> Tambah Tentang Kami
                </a>
                <div class="search-box">
                    <input type="text" placeholder="Cari...">
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tentangkami as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ Storage::url($item->foto) }}" alt="Foto" width="100">
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.tentangkami.edit', $item->id) }}" class="edit-btn">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.tentangkami.destroy', $item->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="delete-btn" onclick="confirmDelete({{ $item->id }})">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-cell" style="height: 80px;">
                                    Tidak ada data tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</body>
</html>