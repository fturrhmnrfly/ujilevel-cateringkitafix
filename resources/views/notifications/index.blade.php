{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Catering Kita</title>
    <style>
        .notification-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .notification-header h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
            text-align: center;
            width: 100%; /* Add this to ensure full width */
            position: relative; /* Add this for better positioning */
            left: 20px; /* Offset to compensate for the close button space */
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            position: relative; /* Add this for better child positioning */
        }

        .notification-header .close-btn {
            font-size: 24px;
            color: #666;
            cursor: pointer;
            border: none;
            background: none;
        }

        .notification-item {
            display: flex;
            align-items: flex-start;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .notification-icon {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            object-fit: contain;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin: 0 0 5px 0;
        }

        .notification-message {
            font-size: 14px;
            color: #666;
            margin: 0 0 5px 0;
        }

        .notification-time {
            font-size: 12px;
            color: #999;
            margin: 0;
        }

        @media (max-width: 768px) {
            .notification-container {
                margin: 10px;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="notification-container">
        <div class="notification-header">
            <h1>Notifikasi</h1>
            <button class="close-btn">&times;</button>
        </div>

        <!-- Delivery Notification 1 -->
        <div class="notification-item">
            <img src="{{ asset('assets/box-icon.png') }}" alt="Delivery" class="notification-icon">
            <div class="notification-content">
                <h3 class="notification-title">Pesanan Telah Dikirim</h3>
                <p class="notification-message">Pesanan #CK2304150 sedang dalam perjalanan dan akan tiba dalam waktu 30 menit</p>
                <p class="notification-time">5 hari yang lalu, 09:45</p>
            </div>
        </div>

        <!-- Delivery Notification 2 -->
        <div class="notification-item">
            <img src="{{ asset('assets/delivery-icon.png') }}" alt="Delivery" class="notification-icon">
            <div class="notification-content">
                <h3 class="notification-title">Pesanan Telah Dikirim</h3>
                <p class="notification-message">Pesanan #CK2304150 sedang dalam perjalanan dan akan tiba dalam waktu 30 menit</p>
                <p class="notification-time">5 hari yang lalu, 09:45</p>
            </div>
        </div>

        <!-- Rating Notification -->
        <div class="notification-item">
            <img src="{{ asset('assets/star-icon.png') }}" alt="Rating" class="notification-icon">
            <div class="notification-content">
                <h3 class="notification-title">Beri Rating untuk Pesanan Sebelumnya</h3>
                <p class="notification-message">Bagaimana pengalaman Anda dengan pesanan #CK2304149? Beri rating dan ulasan untuk membantu kami meningkatkan layanan.</p>
                <p class="notification-time">1 minggu yang lalu, 10:10</p>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.close-btn').addEventListener('click', function() {
            window.history.back();
        });
    </script>
</body>
</html> --}}