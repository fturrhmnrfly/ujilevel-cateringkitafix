<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: white;
            border-bottom: 1px solid #eee;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .close-btn {
            font-size: 24px;
            color: #666;
            cursor: pointer;
            background: none;
            border: none;
            padding: 5px;
        }

        .notifications-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .notification-item {
            display: flex;
            padding: 20px;
            margin-bottom: 15px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #2c2c77;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .notification-item.unread {
            background: #f8f9ff;
        }

        .notification-icon {
            width: 48px;
            height: 48px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .notification-message {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .notification-time {
            color: #999;
            font-size: 12px;
        }

        .notification-status {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Notifikasi</h1>
        <button class="close-btn">&times;</button>
    </div>

    <div class="notifications-container">
        @foreach($notifications as $notification)
            <div class="notification-item {{ $notification->is_read ? 'read' : 'unread' }}">
                <div class="notification-icon">
                    @if($notification->icon_type === 'box')
                        <img src="{{ asset('assets/box-icon.png') }}" alt="Box">
                    @elseif($notification->icon_type === 'truck') 
                        <img src="{{ asset('assets/truck-icon.png') }}" alt="Delivery">
                    @elseif($notification->icon_type === 'check')
                        <img src="{{ asset('assets/check-icon.png') }}" alt="Success">
                    @endif
                </div>

                <div class="notification-content">
                    <div class="notification-title">{{ $notification->title }}</div>
                    <div class="notification-message">{{ $notification->message }}</div>
                    <div class="notification-time">
                        {{ $notification->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        document.querySelector('.close-btn').addEventListener('click', function() {
            window.history.back();
        });
    </script>
</body>
</html>