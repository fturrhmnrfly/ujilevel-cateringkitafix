
<link rel="stylesheet" href="{{ asset('navbar.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<nav class="navbar">
    <!-- Logo -->
    <div class="logo">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="width: 70px; height: 70px;">
        <div class="text-navbar">
            <p>CATERING</p>
            <p>KITA</p>
        </div>
    </div>
    
    @auth
        <!-- Hamburger Menu for Authenticated Users -->
        <div class="hamburger" id="hamburger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Desktop Search Container -->
        <div class="search-container" id="search-container">
            <input type="text" 
                   class="search-bar" 
                   id="search-input" 
                   placeholder="Cari makanan..." 
                   autocomplete="off">
            <button type="button" id="search-btn">
                <i class="fas fa-search"></i>
            </button>
            
            <div class="search-suggestions" id="search-suggestions">
                <!-- Suggestions will be populated here -->
            </div>
        </div>

        <!-- Desktop Navigation Links -->
        <ul class="nav-links">
            <li><a href="{{ route('welcome') }}">Home</a></li>
            <li><a href="{{ route('about.index') }}">Tentang Kami</a></li>
            <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
            <li><a href="{{ route('contact.index') }}">Contact</a></li>
        </ul>

        <!-- Desktop Right Section -->
        <div class="navbar-right">
            <div class="notification-wrapper">
                <div class="notification-icon" id="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge" id="notification-badge">0</span>
                </div>
            </div>
            <a href="{{ route('keranjang.index') }}" class="cart-icon">
                <img src="{{ asset('assets/keranjang.png') }}" alt="cart-icon">
            </a>
            <div class="profile">
                <a href="{{ route('profile.show') }}">
                    <img src="{{ asset('assets/profil.png') }}" alt="Profile">
                </a>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay" id="mobile-overlay"></div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <div class="mobile-menu-content">
                <!-- ✅ MOBILE SEARCH WITH SUGGESTIONS ✅ -->
                <div class="mobile-search">
                    <div class="search-container mobile-search-container" id="mobile-search-container">
                        <input type="text" 
                               class="search-bar mobile-search-bar" 
                               id="mobile-search-input" 
                               placeholder="Cari makanan..." 
                               autocomplete="off">
                        <button type="button" id="mobile-search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        <!-- ✅ MOBILE SEARCH SUGGESTIONS ✅ -->
                        <div class="search-suggestions mobile-search-suggestions" id="mobile-search-suggestions">
                            <!-- Mobile suggestions will be populated here -->
                        </div>
                    </div>
                </div>

                <ul class="mobile-nav-links">
                    <li style="--item-index: 0"><a href="{{ route('welcome') }}">Home</a></li>
                    <li style="--item-index: 1"><a href="{{ route('about.index') }}">Tentang Kami</a></li>
                    <li style="--item-index: 2"><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
                    <li style="--item-index: 3"><a href="{{ route('contact.index') }}">Contact</a></li>
                </ul>

                <div class="mobile-actions">
                    <a href="#" class="action-item" id="mobile-notification">
                        <i class="fas fa-bell"></i>
                        <span>Notifikasi</span>
                    </a>
                    <a href="{{ route('keranjang.index') }}" class="action-item">
                        <img src="{{ asset('assets/keranjang.png') }}" alt="cart-icon">
                        <span>Keranjang</span>
                    </a>
                    <a href="{{ route('profile.show') }}" class="action-item">
                        <img src="{{ asset('assets/profil.png') }}" alt="Profile">
                        <span>Profile</span>
                    </a>
                </div>
            </div>
        </div>

    @else
        <!-- Hamburger Menu for Guest -->
        <div class="hamburger" id="hamburger-menu-guest">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Desktop Auth Buttons -->
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Register</a>
        </div>

        <!-- Mobile Menu Overlay for Guest -->
        <div class="mobile-menu-overlay" id="mobile-overlay-guest"></div>

        <!-- Mobile Auth Menu -->
        <div class="mobile-auth-menu" id="mobile-auth-menu">
            <div class="mobile-auth-buttons">
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            </div>
        </div>
    @endauth
</nav>

@auth
<!-- Notification Modal -->
<div class="notification-modal" id="notification-modal">
    <div class="notification-modal-content">
        <div class="notification-modal-header">
            <h2 class="notification-modal-title">Notifikasi</h2>
            <button class="notification-modal-close" id="notification-modal-close">×</button>
        </div>
        <div class="notification-modal-body" id="notification-modal-body">
            <!-- Notifications will be loaded here -->
        </div>
        <div class="notification-delete-controls" id="notification-delete-controls">
            <span class="selected-count" id="selected-count">0 dipilih</span>
            <button class="delete-selected-btn" id="delete-selected-btn" disabled>Hapus Terpilih</button>
        </div>
    </div>
</div>
@endauth

<script src="{{ asset('navbar.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hamburgerAuth = document.getElementById('hamburger-menu');
    const hamburgerGuest = document.getElementById('hamburger-menu-guest');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileAuthMenu = document.getElementById('mobile-auth-menu');
    const mobileOverlay = document.getElementById('mobile-overlay');
    const mobileOverlayGuest = document.getElementById('mobile-overlay-guest');
    const mobileNotification = document.getElementById('mobile-notification');

    // Mobile menu for authenticated users
    if (hamburgerAuth && mobileMenu && mobileOverlay) {
        hamburgerAuth.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMobileMenu();
        });

        function toggleMobileMenu() {
            hamburgerAuth.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        }

        mobileOverlay.addEventListener('click', closeMobileMenu);

        function closeMobileMenu() {
            hamburgerAuth.classList.remove('active');
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
            
            // ✅ CLOSE MOBILE SEARCH SUGGESTIONS ✅
            const mobileSuggestions = document.getElementById('mobile-search-suggestions');
            if (mobileSuggestions) {
                mobileSuggestions.classList.remove('show');
            }
        }

        if (mobileNotification) {
            mobileNotification.addEventListener('click', function(e) {
                e.preventDefault();
                closeMobileMenu();
                setTimeout(() => {
                    const notificationBell = document.getElementById('notification-bell');
                    if (notificationBell) notificationBell.click();
                }, 300);
            });
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) closeMobileMenu();
        });
    }

    // Mobile menu for guest users
    if (hamburgerGuest && mobileAuthMenu && mobileOverlayGuest) {
        hamburgerGuest.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleGuestMobileMenu();
        });

        function toggleGuestMobileMenu() {
            hamburgerGuest.classList.toggle('active');
            mobileAuthMenu.classList.toggle('active');
            mobileOverlayGuest.classList.toggle('active');
            document.body.style.overflow = mobileAuthMenu.classList.contains('active') ? 'hidden' : '';
        }

        mobileOverlayGuest.addEventListener('click', closeGuestMobileMenu);

        function closeGuestMobileMenu() {
            hamburgerGuest.classList.remove('active');
            mobileAuthMenu.classList.remove('active');
            mobileOverlayGuest.classList.remove('active');
            document.body.style.overflow = '';
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) closeGuestMobileMenu();
        });
    }

    // ✅ SETUP MOBILE SEARCH FUNCTIONALITY ✅
    setupMobileSearchFunctionality();
});

// ✅ MOBILE SEARCH FUNCTIONALITY ✅
function setupMobileSearchFunctionality() {
    const mobileSearchInput = document.getElementById('mobile-search-input');
    const mobileSearchBtn = document.getElementById('mobile-search-btn');
    const mobileSearchSuggestions = document.getElementById('mobile-search-suggestions');
    const mobileSearchContainer = document.getElementById('mobile-search-container');
    
    if (!mobileSearchInput || !mobileSearchSuggestions) {
        console.warn('Mobile search elements not found');
        return;
    }

    let mobileSearchTimeout;
    let mobileCurrentRequest;

    // ✅ MOBILE SEARCH INPUT EVENTS ✅
    mobileSearchInput.addEventListener('input', handleMobileSearchInput);
    mobileSearchInput.addEventListener('blur', handleMobileSearchBlur);
    mobileSearchInput.addEventListener('focus', handleMobileSearchFocus);
    mobileSearchInput.addEventListener('keydown', handleMobileSearchKeydown);

    // ✅ MOBILE SEARCH BUTTON ✅
    if (mobileSearchBtn) {
        mobileSearchBtn.addEventListener('click', function() {
            const query = mobileSearchInput.value.trim();
            if (query) {
                window.location.href = `/search?query=${encodeURIComponent(query)}`;
            }
        });
    }

    // ✅ MOBILE SEARCH INPUT HANDLER ✅
    function handleMobileSearchInput() {
        const query = mobileSearchInput.value.trim();
        
        if (mobileCurrentRequest) {
            mobileCurrentRequest.abort();
        }
        
        clearTimeout(mobileSearchTimeout);
        
        if (query.length < 2) {
            hideMobileSuggestions();
            return;
        }
        
        mobileSearchTimeout = setTimeout(() => {
            fetchMobileSuggestions(query);
        }, 300);
    }

    // ✅ MOBILE SEARCH BLUR HANDLER ✅
    function handleMobileSearchBlur() {
        setTimeout(() => {
            hideMobileSuggestions();
        }, 200);
    }

    // ✅ MOBILE SEARCH FOCUS HANDLER ✅
    function handleMobileSearchFocus() {
        const query = mobileSearchInput.value.trim();
        if (query.length >= 2) {
            fetchMobileSuggestions(query);
        }
    }

    // ✅ MOBILE SEARCH KEYDOWN HANDLER ✅
    function handleMobileSearchKeydown(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const query = mobileSearchInput.value.trim();
            if (query) {
                hideMobileSuggestions();
                window.location.href = `/search?query=${encodeURIComponent(query)}`;
            }
        } else if (e.key === 'Escape') {
            hideMobileSuggestions();
            mobileSearchInput.blur();
        }
    }

    // ✅ FETCH MOBILE SUGGESTIONS ✅
    async function fetchMobileSuggestions(query) {
        try {
            showMobileLoading();
            
            const controller = new AbortController();
            mobileCurrentRequest = controller;
            
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
            displayMobileSuggestions(suggestions);
            
        } catch (error) {
            if (error.name === 'AbortError') {
                console.log('Mobile search request cancelled');
                return;
            }
            
            console.error('Error fetching mobile suggestions:', error);
            showMobileError('Terjadi kesalahan saat mencari');
        } finally {
            mobileCurrentRequest = null;
        }
    }

    // ✅ SHOW MOBILE LOADING ✅
    function showMobileLoading() {
        mobileSearchSuggestions.innerHTML = '<div class="search-loading">Mencari...</div>';
        mobileSearchSuggestions.classList.add('show');
    }

    // ✅ SHOW MOBILE ERROR ✅
    function showMobileError(message) {
        mobileSearchSuggestions.innerHTML = `<div class="no-suggestions">${message}</div>`;
        mobileSearchSuggestions.classList.add('show');
    }

    // ✅ DISPLAY MOBILE SUGGESTIONS ✅
    function displayMobileSuggestions(suggestions) {
        if (!Array.isArray(suggestions)) {
            console.error('Invalid mobile suggestions format:', suggestions);
            showMobileError('Format data tidak valid');
            return;
        }
        
        if (suggestions.length === 0) {
            mobileSearchSuggestions.innerHTML = '<div class="no-suggestions">Tidak ada hasil ditemukan</div>';
        } else {
            mobileSearchSuggestions.innerHTML = suggestions.map(item => createMobileSuggestionHTML(item)).join('');
            attachMobileSuggestionListeners();
        }
        
        mobileSearchSuggestions.classList.add('show');
    }

    // ✅ CREATE MOBILE SUGGESTION HTML ✅
    function createMobileSuggestionHTML(item) {
        const defaultImage = window.location.origin + '/assets/default-food.png';
        return `
            <div class="suggestion-item mobile-suggestion-item" data-url="${escapeHtml(item.url)}">
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

    // ✅ ATTACH MOBILE SUGGESTION LISTENERS ✅
    function attachMobileSuggestionListeners() {
        document.querySelectorAll('.mobile-suggestion-item').forEach(item => {
            item.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                if (url && url !== 'null' && url !== '') {
                    window.location.href = url;
                } else {
                    console.warn('Invalid URL for mobile suggestion item');
                }
            });
        });
    }

    // ✅ HIDE MOBILE SUGGESTIONS ✅
    function hideMobileSuggestions() {
        mobileSearchSuggestions?.classList.remove('show');
    }

    // ✅ ESCAPE HTML FOR MOBILE ✅
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // ✅ PREVENT MOBILE MENU FROM CLOSING WHEN CLICKING SEARCH ✅
    if (mobileSearchContainer) {
        mobileSearchContainer.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
}
</script>