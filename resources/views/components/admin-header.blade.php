@props(['title' => 'Dashboard'])

<div class="header">
    <h1 class="page-title">{{ $title }}</h1>
    <div class="admin-controls">
        <div class="notification-wrapper">
            <a href="{{ route('admin.notifications.index') }}" class="notification-icon">
                <i class="fa-solid fa-bell"></i>
                @php
                    $unreadCount = \App\Models\NotificationAdmin::where('admin_id', auth()->id())
                        ->where('is_read', false)
                        ->count();
                @endphp
                @if($unreadCount > 0)
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

<style>
.header {
    background-color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.page-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
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
</style>