<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita Admin - Kelola Makanan</title>
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Tambahkan gap antara icon dan text */
        }

        .search-container {
            display: flex;
            gap: 10px;
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

        .food-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .status-available {
            color: #28a745;
            font-weight: 500;
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
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <x-admin-header title="Kelola Makanan" />

        <div class="content">
            <div class="content-header">
                <a href="{{ route('admin.kelolamakanan.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i> Tambah Makanan
                </a>
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
                                <td>
                                    <img src="{{ Storage::url($item->image) }}" alt="Food Image" class="food-image">
                                </td>
                                <td>{{ $item->nama_makanan }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="status-available">{{ $item->status }}</span>
                                </td>
                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                <td>
                                    <a href="{{ route('admin.kelolamakanan.edit', $item->id) }}" class="btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.kelolamakanan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
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
