<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Breadcrumb Styles */
        .breadcrumb-container {
            background-color: #f3f4f6;
            border-bottom: 1px solid #e5e7eb;
            margin-top: 80px;
            /* Add margin to prevent overlap with fixed navbar */
        }

        .breadcrumb {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .breadcrumb-title {
            font-size: 1.25rem;
            color: #374151;
        }

        .breadcrumb-nav {
            color: #6b7280;
        }

        .breadcrumb-nav a {
            color: #6b7280;
            text-decoration: none;
        }

        .pesanan-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .pesanan-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 2rem;
            text-align: left;
            padding: left;
        }

        .status-cards {
            display: flex;
            gap: 2rem;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin: 0 auto;
            max-width: 900px;
            padding: 10rem;
        }

        .status-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .status-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .status-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
        }

        .status-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .status-label {
            font-size: 1rem;
            color: #333;
            margin: 0;
        }

        .status-sublabel {
            font-size: 1rem;
            color: #333;
            margin: 0.5rem 0 0;
        }
    </style>
</head>

<body>
    <header>
    <x-navbar></x-navbar>

    <div class="pesanan-container">
        <h1 class="pesanan-title">Pesanan saya</h1>
        <div class="status-cards">
            <div class="status-card pembayaran" onclick="navigateTo('pembayaran')">
                <div class="status-icon">
                    <img src="{{ asset('assets/homeassets14.png') }}" alt="Status Pembayaran">
                </div>
                <h3 class="status-label">Status</h3>
                <p class="status-sublabel">Pembayaran</p>
            </div>

            <div class="status-card pengiriman" onclick="navigateTo('pengiriman')">
                <div class="status-icon">
                    <img src="{{ asset('assets/dikirim.png') }}" alt="Status Pengiriman">
                </div>
                <h3 class="status-label">Status</h3>
                <p class="status-sublabel">Pengiriman</p>
            </div>

            <div class="status-card penilaian" onclick="navigateTo('penilaian')">
                <div class="status-icon">
                    <img src="{{ asset('assets/penilaian.png') }}" alt="Penilaian Produk">
                </div>
                <h3 class="status-label">Penilaian</h3>
                <p class="status-sublabel">Produk</p>
            </div>
        </div>
    </div>

    <script>
        function navigateTo(status) {
            const routes = {
                'pembayaran': '/metodepembayaranuser',
                'pengiriman': '/status-pengiriman',
                'penilaian': '/penilaian-produk'
            };
            window.location.href = routes[status];
        }
    </script>
    </header>
</body>

</html>
