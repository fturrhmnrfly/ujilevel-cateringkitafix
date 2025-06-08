<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            width: calc(100% - 250px);
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .stat-icon.orders {
            background-color: #fbbf24;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .stat-icon.rating {
            background-color: #6366f1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .stat-icon i {
            width: 24px;
            height: 24px;
            color: white;
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

        /* Chart Container Improvements */
        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: 500px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .chart-controls {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
        }

        .chart-filter {
            display: flex;
            gap: 10px;
        }

        .date-filters {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .filter-btn.active {
            background: #4F46E5;
            color: white;
            border-color: #4F46E5;
        }

        .filter-btn:hover {
            background: #f3f4f6;
        }

        .filter-btn.active:hover {
            background: #4338CA;
        }

        .date-input {
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            background: white;
        }

        .date-input:focus {
            outline: none;
            border-color: #4F46E5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .analysis-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #4F46E5;
        }

        .analysis-info h4 {
            color: #333;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .analysis-info p {
            color: #666;
            font-size: 14px;
        }

        .summary-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-size: 14px;
            color: #666;
        }

        .summary-value {
            font-weight: bold;
            color: #333;
        }

        .summary-value.positive {
            color: #22c55e;
        }

        .summary-value.negative {
            color: #ef4444;
        }

        .real-time-indicator {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: #22c55e;
            margin-left: 10px;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .transactions {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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

        .admin-profile a:hover {
            opacity: 0.8;
            cursor: pointer;
        }

        .admin-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .value {
            color: #333;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1 class="page-title">{{ $title ?? 'Dashboard' }}</h1>
            <div class="admin-controls">
                <div class="notification-wrapper">
                    <a href="{{ route('notifications.index') }}" class="notification-icon">
                        <i class="fa-solid fa-bell"></i>
                        @php
                            $unreadCount = \App\Models\NotificationAdmin::where('admin_id', auth()->id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        @if ($unreadCount > 0)
                            <span class="notification-badge">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </div>
                <div class="admin-profile">
                    <a href="{{ route('admin.profile.show') }}"
                        style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
                        <span>Admin</span>
                        <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
                    </a>
                </div>
            </div>
        </div>

        <div class="header">
            <h2>Halo Admin Selamat Datang</h2>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon income">
                    <i class="fa-solid fa-circle-dollar-to-slot"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Pendapatan</h3>
                    <div class="value" id="total-income">
                        @php
                            $totalRevenue = \App\Models\DaftarPesanan::sum('total_harga');
                        @endphp
                        Rp. {{ number_format($totalRevenue, 0, ',', '.') }}
                    </div>
                    <span class="real-time-indicator">
                        <div class="pulse-dot"></div>
                        Real-time
                    </span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orders">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="stat-info">
                    <h3>Pesanan Hari Ini</h3>
                    <div class="value" id="today-orders">
                        @php
                            $todayOrdersCount = \App\Models\DaftarPesanan::whereDate('created_at', today())->count();
                        @endphp
                        {{ $todayOrdersCount }} Pesanan
                    </div>
                    <span class="real-time-indicator">
                        <div class="pulse-dot"></div>
                        Real-time
                    </span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rating">
                    <i class="fa-solid fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Pesanan</h3>
                    <div class="value" id="total-orders">
                        @php
                            $totalOrders = \App\Models\DaftarPesanan::sum('jumlah_pesanan');
                        @endphp
                        {{ number_format($totalOrders) }} Box
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Charts Section -->
        <div class="charts-section">
            <div class="chart-container">
                <div class="chart-header">
                    <h3 class="chart-title">Grafik Pemasukan
                        <span class="real-time-indicator">
                            <div class="pulse-dot"></div>
                            Real-time
                        </span>
                    </h3>
                    <div class="chart-controls">
                        <div class="chart-filter">
                            <button class="filter-btn active" data-period="monthly">Bulanan</button>
                            <button class="filter-btn" data-period="yearly">Tahunan</button>
                            <button class="filter-btn" data-period="custom">Kustom</button>
                        </div>
                        <div class="date-filters" id="custom-filters" style="display: none;">
                            <select id="month-select" class="date-input">
                                <option value="">Pilih Bulan</option>
                                <option value="0">Januari</option>
                                <option value="1">Februari</option>
                                <option value="2">Maret</option>
                                <option value="3">April</option>
                                <option value="4">Mei</option>
                                <option value="5">Juni</option>
                                <option value="6">Juli</option>
                                <option value="7">Agustus</option>
                                <option value="8">September</option>
                                <option value="9">Oktober</option>
                                <option value="10">November</option>
                                <option value="11">Desember</option>
                            </select>
                            <select id="year-select" class="date-input">
                                <option value="">Pilih Tahun</option>
                            </select>
                            <button class="filter-btn" id="analyze-btn">Analisis</button>
                        </div>
                    </div>
                </div>

                <div class="analysis-info" id="analysis-info" style="display: none;">
                    <h4 id="analysis-title">Analisis Data</h4>
                    <p id="analysis-description"></p>
                </div>

                <div style="height: 320px;">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>

            <div class="summary-card">
                <h3 style="margin-bottom: 20px;">Ringkasan Pemasukan</h3>
                <div class="summary-item">
                    <span class="summary-label" id="period-label-1">Bulan Ini</span>
                    <span class="summary-value positive" id="monthly-income">Rp 0</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label" id="period-label-2">Bulan Lalu</span>
                    <span class="summary-value" id="last-month-income">Rp 0</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Pertumbuhan</span>
                    <span class="summary-value" id="growth-percentage">0%</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label" id="average-label">Rata-rata Harian</span>
                    <span class="summary-value" id="daily-average">Rp 0</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Total Box Terjual</span>
                    <span class="summary-value" id="total-boxes">
                        @php
                            $totalBoxes = \App\Models\DaftarPesanan::sum('jumlah_pesanan');
                        @endphp
                        {{ number_format($totalBoxes) }} Box
                    </span>
                </div>
                <div class="summary-item" id="custom-stats" style="display: none;">
                    <span class="summary-label">Total Transaksi</span>
                    <span class="summary-value" id="total-transactions">0</span>
                </div>
            </div>
        </div>

        <div class="transactions">
            <h3>Statistik Penjualan</h3>
            <div id="transaction-list">
                <div class="transaction-item">
                    <div class="transaction-info">
                        <strong>Pesanan Hari Ini</strong>
                        <span class="transaction-date">{{ now()->format('d/m/Y') }}</span>
                    </div>
                    <div class="value">
                        @php
                            $todayOrderCount = \App\Models\DaftarPesanan::whereDate('created_at', today())
                                ->sum('jumlah_pesanan');
                        @endphp
                        {{ $todayOrderCount }} box
                    </div>
                </div>
                <div class="transaction-item">
                    <div class="transaction-info">
                        <strong>Pendapatan Hari Ini</strong>
                        <span class="transaction-date">{{ now()->format('d/m/Y') }}</span>
                    </div>
                    <div class="income">
                        @php
                            $todayRevenue = \App\Models\DaftarPesanan::whereDate('created_at', today())
                                ->sum('total_harga');
                        @endphp
                        +Rp. {{ number_format($todayRevenue, 0, ',', '.') }}
                    </div>
                </div>
                <div class="transaction-item">
                    <div class="transaction-info">
                        <strong>Total Pendapatan</strong>
                        <span class="transaction-date">Semua Waktu</span>
                    </div>
                    <div class="income">
                        @php
                            $totalRevenue = \App\Models\DaftarPesanan::sum('total_harga');
                        @endphp
                        +Rp. {{ number_format($totalRevenue, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Global variables - DECLARE FIRST
        let incomeChart;
        let currentPeriod = 'monthly';
        let selectedMonth = null;
        let selectedYear = null;

        // Data dari Laravel - Ambil semua data pesanan
        const allOrdersData = @json(\App\Models\DaftarPesanan::all());

        console.log('Orders Data:', allOrdersData);
        console.log('Total Orders:', allOrdersData.length);

        // Initialize year selector
        function initYearSelector() {
            const yearSelect = document.getElementById('year-select');
            const currentYear = new Date().getFullYear();

            // Clear existing options first
            yearSelect.innerHTML = '<option value="">Pilih Tahun</option>';

            // Add years from 2020 to current year + 1
            for (let year = 2020; year <= currentYear + 1; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) {
                    option.selected = true;
                }
                yearSelect.appendChild(option);
            }
        }

        // TAMBAHKAN FUNGSI YANG HILANG INI
        function updateTotalIncome() {
            // Calculate total income dari semua pesanan
            let totalIncome = 0;
            allOrdersData.forEach(order => {
                totalIncome += parseFloat(order.total_harga || 0);
            });
            
            // Update total income display
            const totalIncomeElement = document.getElementById('total-income');
            if (totalIncomeElement) {
                totalIncomeElement.textContent = 'Rp. ' + totalIncome.toLocaleString('id-ID');
            }
            
            console.log('Total Income Updated:', totalIncome);
        }

        // Process data untuk chart berdasarkan created_at dan total_harga
        function processIncomeData(period = 'monthly', customMonth = null, customYear = null) {
            const currentYear = new Date().getFullYear();

            if (period === 'monthly') {
                // Data bulanan untuk tahun ini
                const monthlyData = Array(12).fill(0);
                const monthNames = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'];

                // Process orders data - berdasarkan created_at
                allOrdersData.forEach(order => {
                    const orderDate = new Date(order.created_at);
                    if (orderDate.getFullYear() === currentYear) {
                        const totalHarga = parseFloat(order.total_harga || 0);
                        monthlyData[orderDate.getMonth()] += totalHarga;
                    }
                });

                console.log('Monthly Data for year', currentYear, ':', monthlyData);

                return {
                    labels: monthNames,
                    data: monthlyData
                };
            } else if (period === 'yearly') {
                // Data tahunan untuk 5 tahun terakhir
                const years = [];
                const yearlyData = [];

                for (let i = 4; i >= 0; i--) {
                    const year = currentYear - i;
                    years.push(year.toString());

                    let yearTotal = 0;

                    // Process orders data berdasarkan tahun
                    allOrdersData.forEach(order => {
                        const orderDate = new Date(order.created_at);
                        if (orderDate.getFullYear() === year) {
                            yearTotal += parseFloat(order.total_harga || 0);
                        }
                    });

                    yearlyData.push(yearTotal);
                }

                console.log('Yearly Data:', { years, data: yearlyData });

                return {
                    labels: years,
                    data: yearlyData
                };
            } else if (period === 'custom' && customMonth !== null && customYear !== null) {
                // Data custom untuk bulan tertentu (harian dalam bulan tersebut)
                const daysInMonth = new Date(customYear, customMonth + 1, 0).getDate();
                const dailyData = Array(daysInMonth).fill(0);
                const dayLabels = [];

                for (let day = 1; day <= daysInMonth; day++) {
                    dayLabels.push(day.toString());
                }

                // Process orders data untuk bulan tertentu
                allOrdersData.forEach(order => {
                    const orderDate = new Date(order.created_at);
                    if (orderDate.getFullYear() === customYear && orderDate.getMonth() === customMonth) {
                        const dayIndex = orderDate.getDate() - 1;
                        dailyData[dayIndex] += parseFloat(order.total_harga || 0);
                    }
                });

                console.log(`Custom Data for ${customMonth + 1}/${customYear}:`, dailyData);

                return {
                    labels: dayLabels,
                    data: dailyData
                };
            }

            return { labels: [], data: [] };
        }

        // Initialize Chart
        function initChart() {
            const ctx = document.getElementById('incomeChart').getContext('2d');
            const chartData = processIncomeData(currentPeriod);

            incomeChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Pemasukan',
                        data: chartData.data,
                        borderColor: '#4F46E5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4F46E5',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: '#4F46E5',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    return 'Pemasukan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#666'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    if (currentPeriod === 'custom') {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                    }
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                },
                                color: '#666'
                            },
                            grid: {
                                borderDash: [2, 2],
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        }

        // Switch Period Function
        function switchPeriod(period) {
            currentPeriod = period;

            // Update button states
            document.querySelectorAll('.filter-btn[data-period]').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-period="${period}"]`).classList.add('active');

            // Show/hide custom filters
            const customFilters = document.getElementById('custom-filters');
            const analysisInfo = document.getElementById('analysis-info');

            if (period === 'custom') {
                customFilters.style.display = 'flex';
                analysisInfo.style.display = 'none';
            } else {
                customFilters.style.display = 'none';
                analysisInfo.style.display = 'none';

                // Update chart data for non-custom periods
                const chartData = processIncomeData(period);
                incomeChart.data.labels = chartData.labels;
                incomeChart.data.datasets[0].data = chartData.data;
                incomeChart.update('active');

                // Update summary
                updateSummary();
            }
        }

        // Apply Custom Filter
        function applyCustomFilter() {
            const monthSelect = document.getElementById('month-select');
            const yearSelect = document.getElementById('year-select');

            selectedMonth = parseInt(monthSelect.value);
            selectedYear = parseInt(yearSelect.value);

            if (isNaN(selectedMonth) || isNaN(selectedYear)) {
                alert('Silakan pilih bulan dan tahun terlebih dahulu!');
                return;
            }

            // Update chart with custom data
            const chartData = processIncomeData('custom', selectedMonth, selectedYear);
            incomeChart.data.labels = chartData.labels;
            incomeChart.data.datasets[0].data = chartData.data;
            incomeChart.update('active');

            // Show analysis info
            showAnalysisInfo();

            // Update summary for custom period
            updateCustomSummary();
        }

        // Show Analysis Info
        function showAnalysisInfo() {
            const analysisInfo = document.getElementById('analysis-info');
            const analysisTitle = document.getElementById('analysis-title');
            const analysisDescription = document.getElementById('analysis-description');

            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const monthName = monthNames[selectedMonth];
            const chartData = processIncomeData('custom', selectedMonth, selectedYear);
            const totalIncome = chartData.data.reduce((sum, val) => sum + val, 0);
            const maxDay = chartData.data.indexOf(Math.max(...chartData.data)) + 1;
            const activeDays = chartData.data.filter(val => val > 0).length;

            analysisTitle.textContent = `Analisis ${monthName} ${selectedYear}`;
            analysisDescription.innerHTML = `
                Total pendapatan: <strong>Rp ${totalIncome.toLocaleString('id-ID')}</strong><br>
                Hari terbaik: <strong>Tanggal ${maxDay}</strong> (Rp ${Math.max(...chartData.data).toLocaleString('id-ID')})<br>
                Hari aktif: <strong>${activeDays} hari</strong> dari ${chartData.data.length} hari
            `;

            analysisInfo.style.display = 'block';
        }

        // Update Summary Cards for Custom Period
        function updateCustomSummary() {
            const chartData = processIncomeData('custom', selectedMonth, selectedYear);
            const currentMonthIncome = chartData.data.reduce((sum, val) => sum + val, 0);

            // Get previous month data for comparison
            let prevMonth = selectedMonth - 1;
            let prevYear = selectedYear;
            if (prevMonth < 0) {
                prevMonth = 11;
                prevYear--;
            }

            const prevChartData = processIncomeData('custom', prevMonth, prevYear);
            const lastMonthIncome = prevChartData.data.reduce((sum, val) => sum + val, 0);

            // Calculate metrics
            const growth = lastMonthIncome > 0 ?
                ((currentMonthIncome - lastMonthIncome) / lastMonthIncome * 100) : 0;

            const daysInMonth = chartData.data.length;
            const dailyAverage = currentMonthIncome / daysInMonth;
            const totalTransactions = chartData.data.filter(val => val > 0).length;

            // Update labels
            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            document.getElementById('period-label-1').textContent = `${monthNames[selectedMonth]} ${selectedYear}`;
            document.getElementById('period-label-2').textContent = `${monthNames[prevMonth]} ${prevYear}`;
            document.getElementById('average-label').textContent = 'Rata-rata Harian';

            // Update values
            document.getElementById('monthly-income').textContent =
                'Rp ' + currentMonthIncome.toLocaleString('id-ID');
            document.getElementById('last-month-income').textContent =
                'Rp ' + lastMonthIncome.toLocaleString('id-ID');
            document.getElementById('daily-average').textContent =
                'Rp ' + Math.round(dailyAverage).toLocaleString('id-ID');
            document.getElementById('total-transactions').textContent = totalTransactions + ' hari';

            const growthElement = document.getElementById('growth-percentage');
            growthElement.textContent = growth.toFixed(1) + '%';
            growthElement.className = 'summary-value ' + (growth >= 0 ? 'positive' : 'negative');

            // Show custom stats
            document.getElementById('custom-stats').style.display = 'flex';
        }

        // Update Summary Cards for Regular Periods
        function updateSummary() {
            const chartData = processIncomeData('monthly');
            const currentMonth = new Date().getMonth();
            const currentMonthIncome = chartData.data[currentMonth];
            const lastMonthIncome = currentMonth > 0 ? chartData.data[currentMonth - 1] : 0;

            // Calculate growth
            const growth = lastMonthIncome > 0 ?
                ((currentMonthIncome - lastMonthIncome) / lastMonthIncome * 100) : 0;

            // Calculate daily average
            const daysInMonth = new Date(new Date().getFullYear(), currentMonth + 1, 0).getDate();
            const dailyAverage = currentMonthIncome / daysInMonth;

            // Reset labels for regular periods
            document.getElementById('period-label-1').textContent = 'Bulan Ini';
            document.getElementById('period-label-2').textContent = 'Bulan Lalu';
            document.getElementById('average-label').textContent = 'Rata-rata Harian';

            // Update DOM
            document.getElementById('monthly-income').textContent =
                'Rp ' + currentMonthIncome.toLocaleString('id-ID');
            document.getElementById('last-month-income').textContent =
                'Rp ' + lastMonthIncome.toLocaleString('id-ID');
            document.getElementById('daily-average').textContent =
                'Rp ' + Math.round(dailyAverage).toLocaleString('id-ID');

            const growthElement = document.getElementById('growth-percentage');
            growthElement.textContent = growth.toFixed(1) + '%';
            growthElement.className = 'summary-value ' + (growth >= 0 ? 'positive' : 'negative');

            // Hide custom stats
            document.getElementById('custom-stats').style.display = 'none';
        }

        // Function to update today's orders count in real-time
        function updateTodayOrders() {
            const today = new Date();
            const todayString = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
            
            // Count orders created today
            let todayOrdersCount = 0;
            allOrdersData.forEach(order => {
                const orderDate = new Date(order.created_at);
                const orderDateString = orderDate.toISOString().split('T')[0];
                
                if (orderDateString === todayString) {
                    todayOrdersCount++;
                }
            });
            
            // Update the display
            const todayOrdersElement = document.getElementById('today-orders');
            if (todayOrdersElement) {
                todayOrdersElement.textContent = `${todayOrdersCount} Pesanan`;
            }
            
            console.log('Today Orders Count:', todayOrdersCount);
        }

        // Real-time update function - UPDATED
        function updateRealTimeData() {
            if (currentPeriod !== 'custom') {
                updateSummary();
            } else if (selectedMonth !== null && selectedYear !== null) {
                updateCustomSummary();
            }
            
            // Update total income real-time
            updateTotalIncome();
            
            // Update today's orders real-time
            updateTodayOrders();
            
            console.log('Data updated at:', new Date().toLocaleTimeString());
        }

        // Initialize everything - UPDATED
        document.addEventListener('DOMContentLoaded', function() {
            initYearSelector();
            initChart();
            updateSummary();
            updateTotalIncome(); // Update total income on page load
            updateTodayOrders(); // Update today's orders on page load
            
            // Add event listeners for filter buttons
            document.querySelectorAll('.filter-btn[data-period]').forEach(btn => {
                btn.addEventListener('click', function() {
                    switchPeriod(this.dataset.period);
                });
            });
            
            // Add event listener for analyze button
            document.getElementById('analyze-btn').addEventListener('click', applyCustomFilter);
            
            // Update setiap 30 detik untuk simulasi real-time
            setInterval(updateRealTimeData, 30000);
        });

        // Initialize admin notification badge on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Check if badge exists and has count
            const badge = document.getElementById('admin-notification-badge');
            if (badge && parseInt(badge.textContent) > 0) {
                badge.classList.add('show');
            }
        });
    </script>
</body>

</html>