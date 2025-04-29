{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .notifications-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .notification-item {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-item.unread {
            border-left: 4px solid #2c2c77;
        }

        .notification-content {
            flex-grow: 1;
        }

        .notification-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .notification-message {
            color: #666;
        }

        .notification-time {
            color: #999;
            font-size: 0.8em;
            margin-top: 5px;
        }

        .mark-read-btn {
            background: #2c2c77;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <x-navbar />
    
    <div class="notifications-container">
        <h1>Notifications</h1>
        @forelse ($notifications as $notification)
            <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }}">
                <div class="notification-content">
                    <div class="notification-title">{{ $notification->title }}</div>
                    <div class="notification-message">{{ $notification->message }}</div>
                    <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
                @if (!$notification->is_read)
                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="mark-read-btn">Mark as Read</button>
                    </form>
                @endif
            </div>
        @empty
            <p>No notifications found.</p>
        @endforelse
    </div>
</body>
</html> --}}