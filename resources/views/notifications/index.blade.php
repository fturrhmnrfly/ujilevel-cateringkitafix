<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .notifications-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .notification-item {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            align-items: flex-start;
            transition: transform 0.2s;
        }

        .notification-item:hover {
            transform: translateY(-2px);
        }

        .notification-item.unread {
            border-left: 4px solid #2c2c77;
        }

        .notification-icon {
            margin-right: 15px;
            font-size: 24px;
            color: #2c2c77;
            padding: 10px;
            background: #f0f0ff;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-content {
            flex-grow: 1;
        }

        .notification-title {
            font-weight: bold;
            font-size: 1.1em;
            color: #2c2c77;
            margin-bottom: 8px;
        }

        .notification-message {
            color: #666;
            line-height: 1.4;
        }

        .notification-time {
            color: #999;
            font-size: 0.85em;
            margin-top: 8px;
        }

        .mark-read-btn {
            background: #2c2c77;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background 0.3s;
            margin-left: 15px;
        }

        .mark-read-btn:hover {
            background: #1a1a4f;
        }

        .no-notifications {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        h1 {
            color: #2c2c77;
            margin-bottom: 30px;
            font-size: 2em;
        }
    </style>
</head>
<body>
    <div class="notifications-container">
        <h1>Notifikasi</h1>
        
        @forelse($notifications as $notification)
            <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }}">
                <div class="notification-icon">
                    <i class="fas fa-{{ $notification->icon_type }}"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">{{ $notification->title }}</div>
                    <div class="notification-message">{{ $notification->message }}</div>
                    <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
                @if(!$notification->is_read)
                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="mark-read-btn">Mark as Read</button>
                    </form>
                @endif
            </div>
        @empty
            <div class="no-notifications">
                <p>Tidak ada notifikasi</p>
            </div>
        @endforelse
    </div>
</body>
</html>