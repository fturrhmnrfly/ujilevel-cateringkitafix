document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin Notifications script loaded');
    
    // Elements
    const adminNotificationBell = document.getElementById('admin-notification-bell');
    const adminNotificationModal = document.getElementById('admin-notification-modal');
    const adminNotificationModalClose = document.getElementById('admin-notification-modal-close');
    const adminNotificationModalBody = document.getElementById('admin-notification-modal-body');
    const adminNotificationBadge = document.getElementById('admin-notification-badge');
    const adminNotificationDeleteControls = document.getElementById('admin-notification-delete-controls');
    const adminSelectedCount = document.getElementById('admin-selected-count');
    const adminDeleteSelectedBtn = document.getElementById('admin-delete-selected-btn');
    
    // State
    let adminSelectedNotifications = new Set();
    
    // Initialize
    setupAdminNotificationModal();
    setupAdminNotificationBadge();
    
    /**
     * Setup admin notification badge
     */
    function setupAdminNotificationBadge() {
        updateAdminNotificationBadge();
        
        // Update every 30 seconds
        setInterval(updateAdminNotificationBadge, 30000);
    }
    
    /**
     * Update admin notification badge
     */
    async function updateAdminNotificationBadge() {
        try {
            const response = await fetch('/admin/notifications/count');
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            
            const data = await response.json();
            
            if (adminNotificationBadge) {
                const count = data.count || 0;
                adminNotificationBadge.textContent = count;
                
                if (count > 0) {
                    adminNotificationBadge.classList.add('show');
                } else {
                    adminNotificationBadge.classList.remove('show');
                }
            }
        } catch (error) {
            console.error('Error updating admin notification badge:', error);
        }
    }
    
    /**
     * Setup admin notification modal
     */
    function setupAdminNotificationModal() {
        // Open modal when bell is clicked
        adminNotificationBell?.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openAdminNotificationModal();
        });

        // Close modal when close button is clicked
        adminNotificationModalClose?.addEventListener('click', function() {
            closeAdminNotificationModal();
        });

        // Close modal when clicking outside
        adminNotificationModal?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeAdminNotificationModal();
            }
        });

        // Prevent modal content clicks from closing modal
        document.querySelector('.admin-notification-modal-content')?.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Delete selected notifications
        adminDeleteSelectedBtn?.addEventListener('click', function() {
            deleteSelectedAdminNotifications();
        });

        // Handle ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && adminNotificationModal?.classList.contains('show')) {
                closeAdminNotificationModal();
            }
        });
    }
    
    /**
     * Open admin notification modal
     */
    function openAdminNotificationModal() {
        if (adminNotificationModal) {
            adminNotificationModal.classList.add('show');
            document.body.style.overflow = 'hidden';
            loadAdminNotifications();
        }
    }

    /**
     * Close admin notification modal
     */
    function closeAdminNotificationModal() {
        if (adminNotificationModal) {
            adminNotificationModal.classList.remove('show');
            document.body.style.overflow = '';
            
            // Clear selection and reset controls
            adminSelectedNotifications.clear();
            updateAdminDeleteControls();
            
            // Reset modal body
            if (adminNotificationModalBody) {
                adminNotificationModalBody.innerHTML = '';
            }
        }
    }
    
    /**
     * Load admin notifications
     */
    async function loadAdminNotifications() {
        try {
            // Show loading
            if (adminNotificationModalBody) {
                adminNotificationModalBody.innerHTML = '<div style="padding: 40px; text-align: center; color: #666;">Memuat notifikasi...</div>';
            }

            const response = await fetch('/admin/notifications/api');
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            
            const data = await response.json();
            displayAdminNotifications(data.notifications || []);
            
            // Mark all as read when modal is opened
            await markAllAdminAsRead();
            
        } catch (error) {
            console.error('Error loading admin notifications:', error);
            if (adminNotificationModalBody) {
                adminNotificationModalBody.innerHTML = '<div style="padding: 40px; text-align: center; color: #666;">Gagal memuat notifikasi</div>';
            }
        }
    }
    
    /**
     * Mark all admin notifications as read
     */
    async function markAllAdminAsRead() {
        try {
            const response = await fetch('/admin/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            });

            if (response.ok) {
                // Update badge to 0
                updateAdminNotificationBadge();
            }
        } catch (error) {
            console.error('Error marking all admin notifications as read:', error);
        }
    }
    
    /**
     * Display admin notifications in modal
     */
    function displayAdminNotifications(notifications) {
        if (!adminNotificationModalBody) return;

        if (notifications.length === 0) {
            adminNotificationModalBody.innerHTML = `
                <div class="admin-no-notifications">
                    <i class="fas fa-bell-slash"></i>
                    <p>Tidak ada notifikasi</p>
                </div>
            `;
            
            // Hide delete controls
            if (adminNotificationDeleteControls) {
                adminNotificationDeleteControls.classList.remove('show');
            }
            return;
        }

        adminNotificationModalBody.innerHTML = notifications.map(notification => {
            const timeAgo = formatAdminNotificationTime(notification.created_at);
            return `
                <div class="admin-notification-item" data-id="${notification.id}">
                    <input type="checkbox" class="admin-notification-checkbox" data-id="${notification.id}">
                    <div class="admin-notification-icon-wrapper">
                        <img src="${getAdminNotificationIcon(notification.icon_type)}" 
                             alt="Notification" 
                             class="admin-notification-icon-img">
                    </div>
                    <div class="admin-notification-content">
                        <div class="admin-notification-title">${escapeHtml(notification.title)}</div>
                        <div class="admin-notification-message">${escapeHtml(notification.message)}</div>
                        <div class="admin-notification-time">${timeAgo}</div>
                    </div>
                </div>
            `;
        }).join('');

        // Attach checkbox listeners
        attachAdminCheckboxListeners();
    }
    
    /**
     * Format admin notification time
     */
    function formatAdminNotificationTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMins / 60);
        const diffDays = Math.floor(diffHours / 24);

        if (diffMins < 1) {
            return 'sekarang';
        } else if (diffMins < 60) {
            return `${diffMins} menit yang lalu`;
        } else if (diffHours < 24) {
            return `${diffHours} jam yang lalu`;
        } else if (diffDays < 7) {
            return `${diffDays} hari yang lalu`;
        } else {
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            }) + ', ' + date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    }
    
    /**
     * Get admin notification icon based on type
     */
    function getAdminNotificationIcon(type) {
        const baseUrl = window.location.origin;
        const iconMap = {
            'box': `${baseUrl}/assets/icon/box.svg`,
            'truck': `${baseUrl}/assets/icon/truck.svg`,
            'star': `${baseUrl}/assets/icon/bintang.svg`,
            'credit-card': `${baseUrl}/assets/payment-icon.png`,
            'bell': `${baseUrl}/assets/bell-icon.png`,
            'user': `${baseUrl}/assets/profil.png`
        };

        return iconMap[type] || iconMap['bell'];
    }
    
    /**
     * Attach checkbox listeners for admin notifications
     */
    function attachAdminCheckboxListeners() {
        document.querySelectorAll('.admin-notification-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const notificationId = this.getAttribute('data-id');
                
                if (this.checked) {
                    adminSelectedNotifications.add(notificationId);
                } else {
                    adminSelectedNotifications.delete(notificationId);
                }
                
                updateAdminDeleteControls();
            });
        });
    }
    
    /**
     * Update admin delete controls
     */
    function updateAdminDeleteControls() {
        const count = adminSelectedNotifications.size;
        
        if (adminSelectedCount) {
            adminSelectedCount.textContent = `${count} dipilih`;
        }
        
        if (adminDeleteSelectedBtn) {
            adminDeleteSelectedBtn.disabled = count === 0;
        }
        
        if (adminNotificationDeleteControls) {
            if (count > 0) {
                adminNotificationDeleteControls.classList.add('show');
            } else {
                adminNotificationDeleteControls.classList.remove('show');
            }
        }
    }
    
    /**
     * Delete selected admin notifications
     */
    async function deleteSelectedAdminNotifications() {
        if (adminSelectedNotifications.size === 0) return;

        try {
            const response = await fetch('/admin/notifications/delete-multiple', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    notification_ids: Array.from(adminSelectedNotifications)
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                // Remove deleted notifications from DOM
                adminSelectedNotifications.forEach(id => {
                    const item = document.querySelector(`[data-id="${id}"]`);
                    if (item) {
                        item.remove();
                    }
                });

                // Clear selection
                adminSelectedNotifications.clear();
                updateAdminDeleteControls();

                // Update badge
                updateAdminNotificationBadge();

                // Check if there are remaining notifications
                checkAndShowAdminEmptyState();

                console.log(`${data.deleted_count} notifikasi admin berhasil dihapus`);
            }
        } catch (error) {
            console.error('Error deleting admin notifications:', error);
            alert('Gagal menghapus notifikasi');
        }
    }
    
    /**
     * Check and show empty state if no notifications
     */
    function checkAndShowAdminEmptyState() {
        if (!adminNotificationModalBody) return;

        const remainingNotifications = adminNotificationModalBody.querySelectorAll('.admin-notification-item');
        
        if (remainingNotifications.length === 0) {
            adminNotificationModalBody.innerHTML = `
                <div class="admin-no-notifications">
                    <i class="fas fa-bell-slash"></i>
                    <p>Tidak ada notifikasi</p>
                </div>
            `;
            
            if (adminNotificationDeleteControls) {
                adminNotificationDeleteControls.classList.remove('show');
            }
        }
    }
    
    /**
     * Escape HTML to prevent XSS
     */
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
});