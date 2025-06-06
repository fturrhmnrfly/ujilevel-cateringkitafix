// Enhanced JavaScript for navbar search functionality
document.addEventListener('DOMContentLoaded', function() {
    // Element references
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const searchContainer = document.querySelector('.search-container');
    const searchInput = document.getElementById('search-input');
    const searchSuggestions = document.getElementById('search-suggestions');
    
    // Notification elements
    const notificationBell = document.getElementById('notification-bell');
    const notificationModal = document.getElementById('notification-modal');
    const notificationModalClose = document.getElementById('notification-modal-close');
    const notificationModalBody = document.getElementById('notification-modal-body');
    const notificationBadge = document.getElementById('notification-badge');
    const notificationDeleteControls = document.getElementById('notification-delete-controls');
    const selectedCount = document.getElementById('selected-count');
    const deleteSelectedBtn = document.getElementById('delete-selected-btn');
    
    let searchTimeout;
    let currentRequest;
    let selectedNotifications = new Set();
    
    // Initialize navbar
    initializeNavbar();
    
    /**
     * Initialize navbar functionality
     */
    function initializeNavbar() {
        setupHamburgerMenu();
        setupSearchFunctionality();
        setupCartCounter();
        setupNotificationBadge();
        setupNotificationModal();
    }
    
    /**
     * Setup hamburger menu
     */
    function setupHamburgerMenu() {
        // Add index to nav items for staggered animation
        document.querySelectorAll('.nav-links li').forEach((item, index) => {
            item.style.setProperty('--item-index', index);
        });
        
        hamburger?.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMobileMenu();
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = navLinks?.contains(event.target) || 
                                hamburger?.contains(event.target) ||
                                searchContainer?.contains(event.target) ||
                                notificationModal?.contains(event.target);
            
            if (!isClickInside) {
                closeMobileMenu();
                hideSuggestions();
            }
        });

        // Prevent clicks inside search container from closing menu
        searchContainer?.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    /**
     * Toggle mobile menu
     */
    function toggleMobileMenu() {
        hamburger?.classList.toggle('active');
        navLinks?.classList.toggle('active');
        searchContainer?.classList.toggle('active');
    }
    
    /**
     * Close mobile menu
     */
    function closeMobileMenu() {
        hamburger?.classList.remove('active');
        navLinks?.classList.remove('active');
        searchContainer?.classList.remove('active');
    }
    
    /**
     * Setup search functionality
     */
    function setupSearchFunctionality() {
        if (!searchInput || !searchSuggestions) {
            console.warn('Search elements not found');
            return;
        }

        // Search input events
        searchInput.addEventListener('input', handleSearchInput);
        searchInput.addEventListener('blur', handleSearchBlur);
        searchInput.addEventListener('focus', handleSearchFocus);
        searchInput.addEventListener('keydown', handleSearchKeydown);
    }
    
    /**
     * Handle search input
     */
    function handleSearchInput() {
        const query = this.value.trim();
        
        // Cancel previous request
        if (currentRequest) {
            currentRequest.abort();
        }
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            hideSuggestions();
            return;
        }

        searchTimeout = setTimeout(() => {
            fetchSuggestions(query);
        }, 300); // Debounce 300ms
    }
    
    /**
     * Handle search blur
     */
    function handleSearchBlur() {
        setTimeout(() => {
            hideSuggestions();
        }, 150);
    }
    
    /**
     * Handle search focus
     */
    function handleSearchFocus() {
        const query = this.value.trim();
        if (query.length >= 2) {
            fetchSuggestions(query);
        }
    }
    
    /**
     * Handle search keyboard navigation
     */
    function handleSearchKeydown(e) {
        // Add keyboard navigation for suggestions here if needed
        if (e.key === 'Escape') {
            hideSuggestions();
            this.blur();
        }
    }

    /**
     * Fetch search suggestions
     */
    async function fetchSuggestions(query) {
        try {
            showLoading();
            
            // Create AbortController for request cancellation
            const controller = new AbortController();
            currentRequest = controller;
            
            const response = await fetch(`/api/search/suggestions?query=${encodeURIComponent(query)}`, {
                signal: controller.signal,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            
            const suggestions = await response.json();
            displaySuggestions(suggestions);
            
        } catch (error) {
            if (error.name === 'AbortError') {
                console.log('Search request cancelled');
                return;
            }
            
            console.error('Error fetching suggestions:', error);
            showError('Terjadi kesalahan saat mencari');
        } finally {
            currentRequest = null;
        }
    }

    /**
     * Show loading state
     */
    function showLoading() {
        searchSuggestions.innerHTML = '<div class="search-loading">Mencari...</div>';
        searchSuggestions.classList.add('show');
    }
    
    /**
     * Show error message
     */
    function showError(message) {
        searchSuggestions.innerHTML = `<div class="no-suggestions">${message}</div>`;
        searchSuggestions.classList.add('show');
    }

    /**
     * Display search suggestions
     */
    function displaySuggestions(suggestions) {
        if (!Array.isArray(suggestions)) {
            console.error('Invalid suggestions format:', suggestions);
            showError('Format data tidak valid');
            return;
        }
        
        if (suggestions.length === 0) {
            searchSuggestions.innerHTML = '<div class="no-suggestions">Tidak ada hasil ditemukan</div>';
        } else {
            searchSuggestions.innerHTML = suggestions.map(item => createSuggestionHTML(item)).join('');
            attachSuggestionListeners();
        }
        
        searchSuggestions.classList.add('show');
    }
    
    /**
     * Create suggestion HTML
     */
    function createSuggestionHTML(item) {
        const defaultImage = window.location.origin + '/assets/default-food.png';
        return `
            <div class="suggestion-item" data-url="${escapeHtml(item.url)}">
                <img src="${escapeHtml(item.image)}" 
                     alt="${escapeHtml(item.nama_makanan)}" 
                     class="suggestion-image"
                     onerror="this.src='${defaultImage}'">
                <div class="suggestion-info">
                    <p class="suggestion-name">${escapeHtml(item.nama_makanan)}</p>
                    <div class="suggestion-details">
                        <span class="suggestion-category">${escapeHtml(item.kategori)}</span>
                        <span class="suggestion-price">Rp ${escapeHtml(item.harga)}</span>
                    </div>
                </div>
            </div>
        `;
    }
    
    /**
     * Escape HTML to prevent XSS
     */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    /**
     * Attach click listeners to suggestion items
     */
    function attachSuggestionListeners() {
        document.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                if (url && url !== 'null' && url !== '') {
                    window.location.href = url;
                } else {
                    console.warn('Invalid URL for suggestion item');
                }
            });
        });
    }

    /**
     * Hide search suggestions
     */
    function hideSuggestions() {
        searchSuggestions?.classList.remove('show');
    }

    /**
     * Setup cart counter functionality
     */
    function setupCartCounter() {
        updateCartCounter();
        syncCartCounter();
        
        // Listen for storage changes
        window.addEventListener('storage', function(e) {
            if (e.key === 'cartItems') {
                updateCartCounter();
            }
        });

        // Override localStorage.setItem to trigger events
        const originalSetItem = localStorage.setItem;
        localStorage.setItem = function(key, value) {
            const event = new Event('storage');
            event.key = key;
            originalSetItem.apply(this, arguments);
            window.dispatchEvent(event);
        };
    }
    
    /**
     * Update cart counter display
     */
    function updateCartCounter() {
        const cartIcon = document.querySelector('.cart-icon');
        if (!cartIcon) return;
        
        const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const totalItems = cartItems.reduce((sum, item) => sum + (item.quantity || 0), 0);
        
        if (totalItems > 0) {
            cartIcon.setAttribute('data-count', totalItems);
            cartIcon.classList.add('has-items');
        } else {
            cartIcon.removeAttribute('data-count');
            cartIcon.classList.remove('has-items');
        }
    }

    /**
     * Sync cart counter with server
     */
    async function syncCartCounter() {
        try {
            const response = await fetch('/keranjang/count', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.success) {
                const cartIcon = document.querySelector('.cart-icon');
                if (cartIcon) {
                    if (data.count > 0) {
                        cartIcon.setAttribute('data-count', data.count.toString());
                        cartIcon.classList.add('has-items');
                    } else {
                        cartIcon.removeAttribute('data-count');
                        cartIcon.classList.remove('has-items');
                    }
                }
                
                // Sync localStorage
                localStorage.removeItem('cartItems');
                if (data.items && data.items.length > 0) {
                    localStorage.setItem('cartItems', JSON.stringify(data.items));
                }
            }
        } catch (error) {
            console.error('Error syncing cart:', error);
        }
    }

    /**
     * Setup notification badge
     */
    function setupNotificationBadge() {
        updateNotificationBadge();
        
        // Update every 30 seconds
        setInterval(updateNotificationBadge, 30000);
    }

    /**
     * Update notification badge
     */
    async function updateNotificationBadge() {
        try {
            const response = await fetch('/notifications/count');
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            
            const data = await response.json();
            
            if (notificationBadge) {
                const count = data.count || 0;
                notificationBadge.textContent = count;
                
                if (count > 0) {
                    notificationBadge.style.display = 'block';
                } else {
                    notificationBadge.style.display = 'none';
                }
            }
        } catch (error) {
            console.error('Error updating notification badge:', error);
        }
    }

    /**
     * Setup notification modal
     */
    function setupNotificationModal() {
        // Open modal when bell is clicked
        notificationBell?.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openNotificationModal();
        });

        // Close modal when close button is clicked
        notificationModalClose?.addEventListener('click', function() {
            closeNotificationModal();
        });

        // Close modal when clicking outside
        notificationModal?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeNotificationModal();
            }
        });

        // Prevent modal content clicks from closing modal
        document.querySelector('.notification-modal-content')?.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Delete selected notifications
        deleteSelectedBtn?.addEventListener('click', function() {
            deleteSelectedNotifications();
        });

        // Handle ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && notificationModal?.classList.contains('show')) {
                closeNotificationModal();
            }
        });
    }

    /**
     * Open notification modal
     */
    function openNotificationModal() {
        if (notificationModal) {
            notificationModal.classList.add('show');
            document.body.style.overflow = 'hidden';
            loadNotifications();
        }
    }

    /**
     * Close notification modal
     */
    function closeNotificationModal() {
        if (notificationModal) {
            notificationModal.classList.remove('show');
            document.body.style.overflow = '';
            
            // Clear selection dan reset controls
            selectedNotifications.clear();
            updateDeleteControls();
            
            // Reset modal body untuk memastikan fresh load saat dibuka lagi
            if (notificationModalBody) {
                notificationModalBody.innerHTML = '';
            }
        }
    }

    /**
     * Load notifications
     */
    async function loadNotifications() {
        try {
            // Show loading
            if (notificationModalBody) {
                notificationModalBody.innerHTML = '<div style="padding: 40px; text-align: center; color: #666;">Memuat notifikasi...</div>';
            }

            const response = await fetch('/notifications/api');
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            
            const data = await response.json();
            displayNotifications(data.notifications || []);
            
            // Mark all as read when modal is opened
            await markAllAsRead();
            
        } catch (error) {
            console.error('Error loading notifications:', error);
            if (notificationModalBody) {
                notificationModalBody.innerHTML = '<div style="padding: 40px; text-align: center; color: #666;">Gagal memuat notifikasi</div>';
            }
        }
    }

    /**
     * Mark all notifications as read
     */
    async function markAllAsRead() {
        try {
            const response = await fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            });

            if (response.ok) {
                // Update badge to 0
                updateNotificationBadge();
            }
        } catch (error) {
            console.error('Error marking all as read:', error);
        }
    }

    /**
     * Display notifications in modal
     */
    function displayNotifications(notifications) {
        if (!notificationModalBody) return;

        if (notifications.length === 0) {
            notificationModalBody.innerHTML = `
                <div class="no-notifications">
                    <i class="fas fa-bell-slash"></i>
                    <p>Tidak ada notifikasi</p>
                </div>
            `;
            
            // Pastikan delete controls disembunyikan
            if (notificationDeleteControls) {
                notificationDeleteControls.classList.remove('show');
            }
            return;
        }

        notificationModalBody.innerHTML = notifications.map(notification => {
            const timeAgo = formatNotificationTime(notification.created_at);
            return `
                <div class="notification-item" data-id="${notification.id}">
                    <input type="checkbox" class="notification-checkbox" data-id="${notification.id}">
                    <div class="notification-icon-wrapper">
                        <img src="${getNotificationIcon(notification.icon_type)}" 
                             alt="Notification" 
                             class="notification-icon-img">
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">${escapeHtml(notification.title)}</div>
                        <div class="notification-message">${escapeHtml(notification.message)}</div>
                        <div class="notification-time">${timeAgo}</div>
                    </div>
                </div>
            `;
        }).join('');

        // Attach checkbox listeners
        attachCheckboxListeners();
    }

    /**
     * Format notification time dalam bahasa Indonesia
     */
    function formatNotificationTime(dateString) {
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
     * Get notification icon based on type
     */
    function getNotificationIcon(type) {
        const baseUrl = window.location.origin;
        const iconMap = {
            'box': `${baseUrl}/assets/icon/box.svg`,
            'truck': `${baseUrl}/assets/icon/truck.svg`,
            'star': `${baseUrl}/assets/icon/bintang.svg`,
            'credit-card': `${baseUrl}/assets/payment-icon.png`,
            'bell': `${baseUrl}/assets/bell-icon.png`
        };

        return iconMap[type] || iconMap['bell'];
    }

    /**
     * Attach checkbox listeners for notifications
     */
    function attachCheckboxListeners() {
        document.querySelectorAll('.notification-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const notificationId = this.getAttribute('data-id');
                
                if (this.checked) {
                    selectedNotifications.add(notificationId);
                } else {
                    selectedNotifications.delete(notificationId);
                }
                
                updateDeleteControls();
            });
        });
    }

    /**
     * Update delete controls
     */
    function updateDeleteControls() {
        const count = selectedNotifications.size;
        
        if (selectedCount) {
            selectedCount.textContent = `${count} dipilih`;
        }
        
        if (deleteSelectedBtn) {
            deleteSelectedBtn.disabled = count === 0;
        }
        
        if (notificationDeleteControls) {
            if (count > 0) {
                notificationDeleteControls.classList.add('show');
            } else {
                notificationDeleteControls.classList.remove('show');
            }
        }
    }

    /**
     * Delete selected notifications
     */
    async function deleteSelectedNotifications() {
        if (selectedNotifications.size === 0) return;

        try {
            const response = await fetch('/notifications/delete-multiple', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    notification_ids: Array.from(selectedNotifications)
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                // Remove deleted notifications from DOM
                selectedNotifications.forEach(id => {
                    const item = document.querySelector(`[data-id="${id}"]`);
                    if (item) {
                        item.remove();
                    }
                });

                // Clear selection
                selectedNotifications.clear();
                updateDeleteControls();

                // Update badge
                updateNotificationBadge();

                // Cek apakah masih ada notifikasi tersisa
                checkAndShowEmptyState();

                // Show success message (optional)
                console.log(`${data.deleted_count} notifikasi berhasil dihapus`);
            }
        } catch (error) {
            console.error('Error deleting notifications:', error);
            alert('Gagal menghapus notifikasi');
        }
    }

    /**
     * Cek dan tampilkan state kosong jika tidak ada notifikasi
     */
    function checkAndShowEmptyState() {
        if (!notificationModalBody) return;

        // Cek apakah masih ada notification-item di dalam modal body
        const remainingNotifications = notificationModalBody.querySelectorAll('.notification-item');
        
        if (remainingNotifications.length === 0) {
            // Tampilkan pesan "Tidak ada notifikasi"
            notificationModalBody.innerHTML = `
                <div class="no-notifications">
                    <i class="fas fa-bell-slash"></i>
                    <p>Tidak ada notifikasi</p>
                </div>
            `;
            
            // Sembunyikan delete controls karena tidak ada notifikasi
            if (notificationDeleteControls) {
                notificationDeleteControls.classList.remove('show');
            }
        }
    }

    /**
     * Delete single notification (untuk future use)
     */
    async function deleteSingleNotification(notificationId) {
        try {
            const response = await fetch(`/notifications/${notificationId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                // Remove notification from DOM
                const item = document.querySelector(`[data-id="${notificationId}"]`);
                if (item) {
                    item.remove();
                }

                // Remove from selected set if it was selected
                selectedNotifications.delete(notificationId.toString());
                updateDeleteControls();

                // Update badge
                updateNotificationBadge();

                // Cek dan tampilkan empty state jika perlu
                checkAndShowEmptyState();

                console.log('Notifikasi berhasil dihapus');
            }
        } catch (error) {
            console.error('Error deleting notification:', error);
            alert('Gagal menghapus notifikasi');
        }
    }

    // Update interval untuk real-time notifications
    setInterval(updateNotificationBadge, 30000); // Update setiap 30 detik

    /**
     * Handle logout - clear cart items
     */
    const logoutForm = document.querySelector('form[action*="logout"]');
    if (logoutForm) {
        logoutForm.addEventListener('submit', function() {
            localStorage.removeItem('cartItems');
        });
    }
});