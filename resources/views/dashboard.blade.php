<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Catering Kita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
</head>

<body>
    <header>
        <x-navbar></x-navbar>
            
        <div class="hero">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="hero-title">Selamat datang di catering <span>kita</span></h1>
                <p class="hero-subtitle">Kami senang memenuhi acara spesial anda</p>
                <a href="#categories" class="cta-button" onclick="scrollToCategories(event)">Pesan Sekarang</a>
            </div>
        </div>

        <div class="features-container">
            <!-- Fast Delivery Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/homeassets11.png') }}" alt="Fast Delivery" class="feature-icon">
                <h3 class="feature-title">fast delivery</h3>
            </div>

            <!-- Halal Certificate Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/homeassets12.png') }}" alt="Halal Certificate" class="feature-icon">
                <h3 class="feature-title">bersertifikat halal</h3>
            </div>

            <!-- Free Box Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/freebox.png') }}" alt="Free Box" class="feature-icon">
                <h3 class="feature-title">Gratis Box</h3>
            </div>

            <!-- Payment Feature -->
            <div class="feature-card">
                <img src="{{ asset('assets/homeassets14.png') }}" alt="Payment" class="feature-icon">
                <h3 class="feature-title">Pembayaran</h3>
            </div>
        </div>
        
        <div class="about">
            <div class="about-image">
                <img src="{{ asset('assets/homeassets1.jpg') }}" alt="Nasi Box" class="about-image">
                <img src="{{ asset('assets/lengkungan.png') }}" alt="lengkung" class="background-curve">
            </div>
            <div class="about-content">
                <h1>Tentang Kami</h1>
                <p>Catering Nikmat Rasa menyediakan nasi box dan snack box untuk berbagai acara seperti ulang tahun,
                    arisan,
                    syukuran, hingga acara kantor. Menu utama kami mencakup nasi bakar, nasi liwet, nasi ayam geprek,
                    nasi
                    kebuli, nasi tumpeng, dan banyak lagi, lengkap dengan sayur dan sambal khas. Dengan pengalaman lebih
                    dari 10
                    tahun melayani area Jabodetabek, kami siap menerima pesanan besar maupun kecil dengan rasa lezat,
                    porsi pas,
                    dan harga terjangkau. Hubungi kami sekarang untuk hidangan terbaik di acara Anda!</p>
                <a href="about" class="btn-shop">Selengkapnya</a>
            </div>
        </div>

        <section class="category-section">
            <h2 class="category-title">Kategori</h2>
            
            <div class="category-container">
                <!-- Prasmanan Category -->
                <a href="{{ route('menuprasmanan.index') }}" class="category-card">
                    <img src="{{ asset('assets/kategoriassets1.png') }}" alt="Prasmanan" class="category-icon">
                    <h3 class="category-name">Prasmanan</h3>
                    <p class="category-desc">Hidangan lengkap dengan konsep prasmanan untuk berbagai acara</p>
                    <span class="category-menu-count">{{ $prasmanan_count }} Menu</span>
                </a>

                <!-- Nasi Box Category -->
                <a href="{{ route('menunasibox.index') }}" class="category-card">
                    <img src="{{ asset('assets/kategoriassets2.png') }}" alt="Nasi Box" class="category-icon">
                    <h3 class="category-name">Nasi Box</h3>
                    <p class="category-desc">Paket nasi lengkap dengan lauk dalam kemasan praktis</p>
                    <span class="category-menu-count">{{ $nasibox_count }} Menu</span>
                </a>
            </div>
        </section>

        <div class="menu-section">
            <!-- Popular Menu Section -->
            <h2 class="section-title">Paket Nasi Box</h2>
            <div class="menu-grid" id="nasi-box">
                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets1.png') }}" alt="Paket Nasi Box A">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium A</h3>
                        <h4>Nasi Liwet, Ayam Bakar, Tumis Jagung Manis, Telur Ceplok, Sambal</h4>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/paketassets2.png') }}" alt="Paket Nasi Box B">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium B</h3>
                        <h4>Nasi putih, Ayam Bakar, Tumis Sayur, Tempe Goreng</h4>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakpremium2.png') }}" alt="Paket Nasi Box C">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium C</h3>
                        <h4>Nasi putih, Ayam Goreng, daging cincang,tempe orak arik,
                            samba, lalapan</h4>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakpremium3.png') }}" alt="Paket Nasi Box D">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium D</h4>
                            <h4>Nasi putih, daging sapi,sate,naget,sayur,telur kuning,kacang , sambal saus </h4>
                    </div>
                </div>
                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakpremium4.png') }}" alt="Paket Nasi Box E">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Box Premium E</h3>
                        <h4>Nasi putih, telur, mie, capcay, ayam suir, sambal, kentang</h4>
                    </div>
                </div>

                <div class="menu-item-p">
                    <img src="{{ asset('assets/nasikotakthailand.png') }}" alt="Paket Nasi Thailand">
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Paket Nasi Campur Thailand</h3>
                        <h4>Nasi kecap, udang, chicken, sayur</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prasmanan Section -->
        <h2 class="section-title">Prasmanan</h2>
        <div class="menu-grid" id="prasmanan">
            <div class="menu-item">
                <img src="{{ asset('assets/homeassets6.jpg') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Ayam Kecap</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 9.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/homeassets5.jpg') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Ikan Goreng</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/capcay.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Capcay</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/bihungoreng.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Bihun Goreng</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 8.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/miegoreng.png') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Mie Goreng</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 10.000</p>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="{{ asset('assets/homeassets4.jpg') }}" alt="Paket Prasmanan Gold">
                <div class="menu-item-content">
                    <h3 class="menu-item-title">Telur Balado</h3>
                    <div class="menu-item-details">
                        <p class="menu-item-price">Rp 5.000</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Reviews Section dengan Avatar Generator -->
        <div class="comments-section">
            <h2 class="section-title">Penilaian Pelanggan</h2>
            <div class="comments-container">
                @if($topReviews->count() > 0)
                    @foreach($topReviews as $review)
                        <div class="comment-card">
                            <!-- Dynamic Star Rating -->
                            <div class="rating" style="margin-bottom: 15px;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->average_rating)
                                        ⭐
                                    @endif
                                @endfor
                            </div>
                            
                            <!-- Dynamic Review Text dengan margin bottom -->
                            <p class="comment-text" style="margin-bottom: 20px;">
                                "{{ Str::limit($review->review_text, 211, '...') }}"
                            </p>
                            
                            <!-- Dynamic User Info dengan margin top -->
                            <div class="commenter-info" style="margin-top: 30px; margin-left: -20px;">
                                @if($review->user)
                                    @if($review->user->profile_picture)
                                        <!-- Jika ada foto profil asli -->
                                        <img src="{{ asset('storage/' . $review->user->profile_picture) }}" 
                                             alt="{{ $review->user->name }}" 
                                             class="commenter-avatar"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ substr($review->user->name, 0, 1) }}&background=2c2c77&color=fff&size=120'">
                                    @else
                                        <!-- Generate avatar dengan huruf pertama nama -->
                                        <img src="https://ui-avatars.com/api/?name={{ substr($review->user->name, 0, 1) }}&background=2c2c77&color=fff&size=120" 
                                             alt="{{ $review->user->name }}" 
                                             class="commenter-avatar">
                                    @endif
                                    <span class="commenter-name">
                                        {{ $review->user->name }}
                                    </span>
                                @else
                                    <!-- Fallback jika user tidak ditemukan -->
                                    <img src="https://ui-avatars.com/api/?name=U&background=2c2c77&color=fff&size=120" 
                                         alt="Default Profile" 
                                         class="commenter-avatar">
                                    <span class="commenter-name">Pelanggan</span>
                                @endif
                            </div>
                            <div class="comment-curve"></div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback ke review statis dengan spacing yang diperbaiki -->
                    <div class="comment-card">
                        <div class="rating" style="margin-bottom: 15px;">⭐⭐⭐⭐⭐</div>
                        
                        <p class="comment-text" style="margin-bottom: 20px;">
                            "Saya sangat puas dengan pelayanan yang diberikan. Tim profesional dan produk berkualitas tinggi. Saya pasti akan merekomendasikan layanan ini kepada teman dan keluarga!"
                        </p>
                        
                        <div class="commenter-info" style="margin-top: 20px;">
                            <img src="https://ui-avatars.com/api/?name=W&background=2c2c77&color=fff&size=120" 
                                 alt="Wildan" 
                                 class="commenter-avatar">
                            <span class="commenter-name">Wildan Syah Nugraha</span>
                        </div>
                        <div class="comment-curve"></div>
                    </div>

                    <div class="comment-card">
                        <div class="rating" style="margin-bottom: 15px;">⭐⭐⭐⭐⭐</div>
                        
                        <p class="comment-text" style="margin-bottom: 20px;">
                            "Makanan sangat lezat dan pelayanan sangat memuaskan. Highly recommended untuk semua acara!"
                        </p>
                        
                        <div class="commenter-info" style="margin-top: 20px;">
                            <img src="https://ui-avatars.com/api/?name=R&background=2c2c77&color=fff&size=120" 
                                 alt="Raffy" 
                                 class="commenter-avatar">
                            <span class="commenter-name">Raffy Faturacman</span>
                        </div>
                        <div class="comment-curve"></div>
                    </div>

                    <div class="comment-card">
                        <div class="rating" style="margin-bottom: 15px;">⭐⭐⭐⭐⭐</div>
                        
                        <p class="comment-text" style="margin-bottom: 20px;">
                            "Kualitas makanan terjaga dengan baik, pengiriman tepat waktu, dan harga terjangkau. Terima kasih!"
                        </p>
                        
                        <div class="commenter-info" style="margin-top: 20px;">
                            <img src="https://ui-avatars.com/api/?name=S&background=2c2c77&color=fff&size=120" 
                                 alt="Siti" 
                                 class="commenter-avatar">
                            <span class="commenter-name">Siti Fadya Sari</span>
                        </div>
                        <div class="comment-curve"></div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Update promo banner HTML -->
        <div class="promo-banner">
            <img src="{{ asset('assets/ayambakar.png') }}" alt="Ayam Bakar" class="promo-image left">
            
            <div class="promo-content">
                <h2 class="promo-title">Siap Memesan untuk Acara Anda?</h2>
                <p class="promo-description">
                    Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan konsultasi menu yang sesuai dengan acara Anda.
                </p>
                <a href="/contact" class="promo-button">Hubungi Kami</a>
            </div>

            <img src="{{ asset('assets/nasiayam.png') }}" alt="Nasi Ayam" class="promo-image right">
        </div>

        <!-- Ganti footer manual dengan komponen -->
        <x-footer />

        <script src="{{ asset('dashboard.js') }}"></script>
        <main>
            @yield('content')
        </main>
</body>

</html>
