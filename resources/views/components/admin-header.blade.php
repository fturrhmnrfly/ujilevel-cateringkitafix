@props(['title' => 'Dashboard'])

<div class="header">
    <h1 class="page-title">{{ $title }}</h1>
    <div class="admin-controls">
        <div class="notification-wrapper">
            <a href="#" class="notification-icon" id="admin-notification-bell">
                <i class="fa-solid fa-bell"></i>
                @php
                    // ✅ GUNAKAN SCOPE YANG BENAR UNTUK HITUNG ADMIN NOTIFICATIONS ✅
                    $unreadCount = \App\Models\NotificationAdmin::forAdmin(auth()->id())
                        ->where('is_read', false)
                        ->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="notification-badge show" id="admin-notification-badge">{{ $unreadCount }}</span>
                @else
                    <span class="notification-badge" id="admin-notification-badge">0</span>
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

<!-- Admin Notification Modal -->
<div class="admin-notification-modal" id="admin-notification-modal">
    <div class="admin-notification-modal-content">
        <div class="admin-notification-modal-header">
            <h2 class="admin-notification-modal-title">Notifikasi Admin</h2>
            <button class="admin-notification-modal-close" id="admin-notification-modal-close">×</button>
        </div>
        <div class="admin-notification-modal-body" id="admin-notification-modal-body">
            <!-- Notifications will be loaded here -->
        </div>
        <div class="admin-notification-delete-controls" id="admin-notification-delete-controls">
            <span class="admin-selected-count" id="admin-selected-count">0 dipilih</span>
            <button class="admin-delete-selected-btn" id="admin-delete-selected-btn" disabled>Hapus Terpilih</button>
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
    cursor: pointer;
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
    display: none;
}

.notification-badge.show {
    display: block;
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

/* Admin Notification Modal Styles */
.admin-notification-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: none;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.admin-notification-modal.show {
    display: flex;
}

.admin-notification-modal-content {
    background: white;
    border-radius: 15px;
    width: 100%;
    max-width: 600px;
    max-height: 80vh;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    animation: slideInFromTop 0.3s ease;
}

@keyframes slideInFromTop {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.admin-notification-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    border-bottom: 1px solid #eee;
    background: #f8f9fa;
}

.admin-notification-modal-title {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
    color: #333;
}

.admin-notification-modal-close {
    background: none;
    border: none;
    font-size: 28px;
    color: #999;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.admin-notification-modal-close:hover {
    background: #f0f0f0;
    color: #666;
}

.admin-notification-modal-body {
    max-height: 400px;
    overflow-y: auto;
    padding: 0;
}

.admin-notification-item {
    display: flex;
    align-items: flex-start;
    padding: 15px 25px;
    border-bottom: 1px solid #f5f5f5;
    gap: 15px;
    transition: background 0.3s ease;
}

.admin-notification-item:hover {
    background: #f8f9fa;
}

.admin-notification-item:last-child {
    border-bottom: none;
}

.admin-notification-checkbox {
    margin-top: 5px;
    width: 16px;
    height: 16px;
    cursor: pointer;
}

.admin-notification-icon-wrapper {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    background: #e3f2fd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-notification-icon-img {
    width: 20px;
    height: 20px;
    object-fit: contain;
}

.admin-notification-content {
    flex: 1;
    min-width: 0;
}

.admin-notification-title {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
    line-height: 1.4;
}

.admin-notification-message {
    font-size: 13px;
    color: #666;
    margin-bottom: 8px;
    line-height: 1.4;
}

.admin-notification-time {
    font-size: 12px;
    color: #999;
}

.admin-notification-delete-controls {
    padding: 15px 25px;
    border-top: 1px solid #eee;
    background: #f8f9fa;
    display: none;
    justify-content: space-between;
    align-items: center;
}

.admin-notification-delete-controls.show {
    display: flex;
}

.admin-selected-count {
    font-size: 14px;
    color: #666;
    font-weight: 500;
}

.admin-delete-selected-btn {
    background: #dc3545;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.admin-delete-selected-btn:hover:not(:disabled) {
    background: #c82333;
}

.admin-delete-selected-btn:disabled {
    background: #6c757d;
    cursor: not-allowed;
}

.admin-no-notifications {
    text-align: center;
    padding: 60px 20px;
    color: #999;
}

.admin-no-notifications i {
    font-size: 48px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.admin-no-notifications p {
    font-size: 16px;
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-notification-modal-content {
        margin: 10px;
        max-width: none;
    }
    
    .admin-notification-modal-header {
        padding: 15px 20px;
    }
    
    .admin-notification-item {
        padding: 12px 20px;
    }
    
    .admin-notification-delete-controls {
        padding: 12px 20px;
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<!-- Include Admin Notification Script -->
<script src="{{ asset('admin-notifications.js') }}"></script>

<script>
// ✅ DEBUG DAN AUTO UPDATE BADGE ✅
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin header loaded');
    const badge = document.getElementById('admin-notification-badge');
    if (badge) {
        console.log('Admin notification badge count:', badge.textContent);
        const count = parseInt(badge.textContent);
        if (count > 0) {
            badge.classList.add('show');
        }
    }
    
    // ✅ AUTO UPDATE BADGE SETIAP 10 DETIK ✅
    setInterval(async function() {
        try {
            const response = await fetch('/admin/notifications/count');
            if (response.ok) {
                const data = await response.json();
                if (badge) {
                    badge.textContent = data.count || 0;
                    if (data.count > 0) {
                        badge.classList.add('show');
                    } else {
                        badge.classList.remove('show');
                    }
                }
            }
        } catch (error) {
            console.error('Error updating admin notification badge:', error);
        }
    }, 10000); // Update setiap 10 detik
});
</script>