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

<div class="container">
    <h1>Status Pembayaran</h1>
    <a href="{{ route('admin.statuspembayaran.create') }}" class="btn btn-primary mb-3">Tambah Status</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Nama Produk</th>
                <th>Tanggal Transaksi</th>
                <th>Status Transaksi</th>
                <th>Bukti Transaksi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $status->namapembeli }}</td>
                    <td>{{ $status->namaproduk }}</td>
                    <td>{{ $status->tanggaltransaksi }}</td>
                    <td>{{ $status->statustransaksi }}</td>
                    <td>
                        @if ($status->buktitransaksi)
                            <a href="{{ asset('storage/' . $status->buktitransaksi) }}" target="_blank"
                                class="btn btn-secondary">View File</a>
                        @else
                            Tidak Ada File
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.statuspembayaran.edit', $status->id) }}"
                            class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.statuspembayaran.destroy', $status->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
