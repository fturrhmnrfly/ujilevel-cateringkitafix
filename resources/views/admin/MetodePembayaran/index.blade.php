<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
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
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Tambahkan gap antara icon dan text */
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
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Tambahkan gap antara icon dan text */
        }

        .btn-danger {
            background-color: #DC3545;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Tambahkan gap antara icon dan text */
        }

        .status-available {
            color: #28a745;
            font-weight: 500;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <x-admin-header title="Metode Pembayaran" />

        <div class="content">
            <div class="content-header">
                <a href="{{ route('admin.metodepembayaran.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i> Tambah Metode Pembayaran
                </a>
                <input type="text" class="search-input" placeholder="Cari metode pembayaran...">
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Metode Pembayaran</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Tanggal Ditambahkan</th>
                            <th>Admin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($metodePembayaran as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->metode_pembayaran }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>{{ $item->admin }}</td>
                            <td>
                                <a href="{{ route('admin.metodepembayaran.edit', $item->id) }}" class="btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.metodepembayaran.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-danger" onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
                                Tidak ada data metode pembayaran
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
                text: "Data metode pembayaran yang dihapus tidak dapat dikembalikan!",
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