<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Admin - Catering Kita</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .notification-list {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .notification-item {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-unread {
            background-color: #f0f7ff;
            border-left: 4px solid #2c2c77;
        }

        .notification-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .notification-message {
            color: #666;
            font-size: 0.9em;
        }

        .notification-time {
            color: #999;
            font-size: 0.8em;
            margin-top: 5px;
        }

        .mark-all-btn {
            background-color: #2c2c77;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .mark-read-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1>Notifikasi</h1>
            <form action="{{ route('admin.notifications.index') }}" method="POST">
                @csrf
                <button type="submit" class="mark-all-btn">Tandai Semua Dibaca</button>
            </form>
        </div>

        <div class="notification-list">
            @forelse ($notifications as $notification)
                <div class="notification-item {{ !$notification->is_read ? 'notification-unread' : '' }}">
                    <div class="notification-content">
                        <div class="notification-title">{{ $notification->title }}</div>
                        <div class="notification-message">{{ $notification->message }}</div>
                        <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                    @if (!$notification->is_read)
                        <form action="{{ route('admin.notifications.read', $notification->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="mark-read-btn">Tandai Dibaca</button>
                        </form>
                    @endif
                </div>
            @empty
                <div class="notification-item">
                    <div class="notification-message">Tidak ada notifikasi</div>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>