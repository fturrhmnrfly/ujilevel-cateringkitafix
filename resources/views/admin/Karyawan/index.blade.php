<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan - Admin</title>
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
        .btn-tambah {
            background-color: #4040ff;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
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
            border-bottom: 1px solid #ddd;
        }
        .status-aktif {
            background-color: #4CAF50;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-cuti {
            background-color: #FFA500;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-nonaktif {
            background-color: #f44336;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #FFA500;
            color: white;
        }
        .btn-delete {
            background-color: #DC3545;
            color: white;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1>Daftar Karyawan</h1>
        </div>

        <div class="content">
            <div class="content-header">
                <a href="{{ route('admin.karyawan.create') }}" class="btn-tambah">Tambah Karyawan</a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Username</th>
                            <th>Posisi</th>
                            <th>Kontak</th>
                            <th>Tanggal Bergabung</th>
                            <th>Status</th>
                            <th>Keahlian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawans as $index => $karyawan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $karyawan->nama_karyawan }}</td>
                            <td>{{ $karyawan->username_karyawan }}</td>
                            <td>{{ $karyawan->posisi }}</td>
                            <td>{{ $karyawan->kontak }}</td>
                            <td>{{ $karyawan->tanggal_bergabung->format('d M Y') }}</td>
                            <td>
                                <span class="status-{{ strtolower($karyawan->status) }}">
                                    {{ $karyawan->status }}
                                </span>
                            </td>
                            <td>{{ $karyawan->keahlian }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" 
                                   class="btn-edit">Edit</a>
                                <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>