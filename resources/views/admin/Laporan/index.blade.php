<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            display: flex;
            background-color: #f3f4f6;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .admin-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-wrapper {
            display: flex;
            align-items: center;
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

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .top-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
        }

        .btn-buat-laporan {
            background-color: white;
            color: black;
            padding: 8px 20px;
            border-radius: 25px;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-right: 10px;
        }

        .btn-export {
            background-color: #e2e2e2;
            color: black;
            padding: 8px 20px;
            border-radius: 4px;
            text-decoration: none;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 12px;
            font-weight: 500;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .badge-pemasukan {
            background-color: #4CAF50;
            color: white;
        }

        .badge-pengeluaran {
            background-color: #ff6b6b;
            color: white;
        }

        .btn-view {
            background-color: #e2e2e2;
            color: black;
            padding: 4px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
        }

        .btn-edit {
            background-color: #ffc107;
            color: black;
            padding: 4px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
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
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Laporan Keuangan</h1>
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

        <div class="top-controls">
            <a href="{{ route('admin.laporan.create') }}" class="btn-buat-laporan">Buat Laporan</a>
            <input type="text" class="search-input" placeholder="Search Laporan...">
            <a href="{{ route('admin.laporan.export') }}" class="btn-export">Export Excel</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Laporan</th>
                        <th>Jenis Laporan</th>
                        <th>Tanggal</th>
                        <th>Admin</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>File Excel</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporans as $index => $laporan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $laporan->laporan }}</td>
                            <td>{{ $laporan->jenis_laporan }}</td>
                            <td>{{ $laporan->tanggal }}</td>
                            <td>{{ $laporan->admin }}</td>
                            <td>
                                <span class="badge {{ $laporan->kategori == 'Pemasukan' ? 'badge-pemasukan' : 'badge-pengeluaran' }}">
                                    {{ $laporan->kategori }}
                                </span>
                            </td>
                            <td>{{ $laporan->deskripsi }}</td>
                            <td><a href="#" class="btn-view">View File</a></td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.laporan.edit', $laporan->id) }}" class="btn-edit">edit</a>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
