<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/lucide.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .menu-item:hover, .menu-item.active {
            background-color: #2d2a77;
        }

        .menu-item i {
            width: 20px;
            height: 20px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 20px 0;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .stat-icon {
            padding: 10px;
            border-radius: 10px;
            color: white;
        }

        .stat-icon.income {
            background-color: #22c55e;
        }

        .stat-icon.expense {
            background-color: #f97316;
        }

        .stat-icon.orders {
            background-color: #3b82f6;
        }

        .stat-info h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .stat-info .value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            height: 300px;
        }

        .transactions {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .transactions h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .transaction-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .transaction-date {
            font-size: 12px;
            color: #666;
        }

        .income {
            color: #22c55e;
        }

        .expense {
            color: #f97316;
        }

        .header {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
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
</head>
<body>
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

    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Dashboard</h1>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
            </div>
        </div>

        <div class="header">
            <h2>Halo Admin Selamat Datang</h2>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon income">
                    <i data-lucide="trending-up"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Pendapatan</h3>
                    <div class="value" id="total-income">Rp. 12,500,000</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon expense">
                    <i data-lucide="trending-down"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Pengeluaran</h3>
                    <div class="value" id="total-expense">Rp. 10,000,000</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orders">
                    <i data-lucide="shopping-bag"></i>
                </div>
                <div class="stat-info">
                    <h3>Pesanan Hari Ini</h3>
                    <div class="value" id="total-orders">10</div>
                </div>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="incomeChart">
                <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Chart Configuration
        const ctx = document.getElementById('incomeChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                datasets: [
                    {
                        label: 'Background',
                        data: Array(12).fill(6),
                        backgroundColor: 'rgba(229, 231, 235, 0.3)',
                        borderWidth: 0,
                        barPercentage: 0.6,
                    },
                    {
                        label: 'Pendapatan',
                        data: [1, 2, 2.5, 0.5, 1.5, 2, 1, 0.5, 1.5, 0.5, 1.5, 2],
                        backgroundColor: '#4F46E5',
                        borderWidth: 0,
                        barPercentage: 0.6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Pendapatan',
                        align: 'start',
                        font: {
                            size: 16,
                            weight: 'normal'
                        },
                        padding: {
                            bottom: 30
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: 6,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return value + 'k';
                            }
                        },
                        grid: {
                            borderDash: [2, 2]
                        }
                    }
                }
            }
        });
                </script>
            </canvas>
        </div>

        <div class="transactions">
            <h3>Transaksi Terbaru</h3>
            <div id="transaction-list"></div>
        </div>
    </div>

    <script>
        // Initialize transactions
        const transactions = [
            { type: 'expense', description: 'Bahan Baku', amount: 2500000, date: '2025-02-21' },
            { type: 'income', description: 'Pendapatan Catering', amount: 2500000, date: '2025-02-21' },
            { type: 'expense', description: 'Biaya opsional', amount: 2500000, date: '2025-02-21' },
            { type: 'income', description: 'Pendapatan Hari ini', amount: 2500000, date: '2025-02-21' }
        ];

        // Render transactions
        function renderTransactions() {
            const list = document.getElementById('transaction-list');
            list.innerHTML = transactions.map(transaction => `
                <div class="transaction-item">
                    <div class="transaction-info">
                        <strong>${transaction.description}</strong>
                        <span class="transaction-date">${transaction.date}</span>
                    </div>
                    <div class="${transaction.type === 'income' ? 'income' : 'expense'}">
                        ${transaction.type === 'income' ? '+' : '-'}Rp. ${transaction.amount.toLocaleString()}
                    </div>
                </div>
            `).join('');
        }

        // Initial render
        renderTransactions();
    </script>
</body>
</html>