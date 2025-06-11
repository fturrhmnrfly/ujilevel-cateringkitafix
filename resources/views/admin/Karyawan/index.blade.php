<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna - Admin</title>
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

        .btn-tambah {
            background-color: white;
            color: #333;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Tambahkan gap antara icon dan text */
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

        .btn-edit {
            background: #ffc107;
            color: black;
            padding: 4px 12px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Tambahkan gap antara icon dan text */
        }

        .btn-delete {
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
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <x-admin-header title="Daftar Pengguna" />

        <div class="content">
            <div class="content-header">
                <a href="{{ route('admin.karyawan.create') }}" class="btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Pengguna
                </a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Tanggal Masuk</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyawans as $karyawan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $karyawan->nama }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>{{ $karyawan->jabatan }}</td>
                            <td>{{ $karyawan->tanggal_masuk }}</td>
                            <td>{{ $karyawan->status }}</td>
                            <td>
                                <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
                                Tidak ada data pengguna
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>