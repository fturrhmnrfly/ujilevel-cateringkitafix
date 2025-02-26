<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
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

        .sidebar {
            width: 250px;
            background-color: #1e1b4b;
            min-height: 100vh;
            padding: 20px;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            padding: 10px;
        }

        .logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            padding: 5px;
        }

        .brand-name {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
            padding: 12px 15px;
            margin: 8px 0;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .menu-item:hover{
            background-color: #2d2a77;
        }

        .menu-item i {
            width: 20px;
            height: 20px;
        }
        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            padding: 12px;
            background: none;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #2d2a77;
        }
</style>
<div class="sidebar">
    <div class="logo-container">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
        <span class="brand-name">CATERING KITA</span>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="menu-item active">
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>
    <a href="{{ route('admin.kelolamakanan.index') }}" class="menu-item">
        <i class="fa-solid fa-mug-hot"></i>
        Kelola Makanan
    </a>
    <a href="{{ route('admin.stokbahan.index') }}" class="menu-item">
        <i class="fa-solid fa-box-open"></i>
        Stok Bahan
    </a>
    <a href="{{ route('admin.daftarpesanan.index') }}" class="menu-item">
        <i class="fa-solid fa-clipboard-list"></i>
        Daftar Pesanan
    </a>
    <a href="{{ route('admin.laporan.index') }}" class="menu-item">
        <i class="fa-solid fa-file"></i>
        Laporan
    </a>
    <a href="{{ route('admin.transaksi.index') }}" class="menu-item">
        <i class="fa-solid fa-credit-card"></i>
        Transaksi
    </a>
    <a href="{{ route('admin.metodepembayaran.index') }}" class="menu-item">
        <i class="fa-solid fa-circle-dollar-to-slot"></i>
        Metode Pembayaran
    </a>
    <a href="{{ route('admin.statuspembayaran.index') }}" class="menu-item">
        <i class="fa-solid fa-box-open"></i>
        Status Pembayaran
    </a>
    <a href="{{ route('admin.statuspengiriman.index') }}" class="menu-item">
        <i class="fa-solid fa-truck-fast"></i>
        Status Pengiriman
    </a>
    {{-- <a href="{{ route('admin.penilaian.index') }}" class="menu-item">
        <i class="fa-solid fa-medal"></i>
        Penilaian
    </a> --}}

    <button class="logout-btn">
        <i data-lucide="log-out"></i>
        Logout
    </button>
</div>
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Metode Pembayaran</h1>
    <a href="{{ route('admin.metodepembayaran.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Buat Metode Pembayaran</a>

    <div class="mt-4">
        <input type="text" placeholder="Search metode pembayaran..." class="border px-4 py-2 w-full rounded mb-4">
        
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Metode Pembayaran</th>
                    <th class="border px-4 py-2">Deskripsi</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Tanggal Ditambahkan</th>
                    <th class="border px-4 py-2">Admin</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($metodePembayaran as $key => $item)
                <tr>
                    <td class="border px-4 py-2">{{ $key + 1 }}</td>
                    <td class="border px-4 py-2">{{ $item->metode_pembayaran }}</td>
                    <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
                    <td class="border px-4 py-2">{{ $item->status }}</td>
                    <td class="border px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">{{ $item->admin }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.metodepembayaran.edit', $item->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('admin.metodepembayaran.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

