<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
</div>
<footer class="footer">
    <div class="footer-container">
        <!-- Logo Section -->
        <div class="footer-logo-section">
            <div class="footer-brand">
                <img src="{{ asset('assets/logo.png') }}" alt="Catering Kita Logo" class="footer-logo">
                <div class="footer-brand-text">
                    <span class="brand-catering">CATERING</span>
                    <span class="brand-kita">KITA</span>
                </div>
            </div>
        </div>

        <!-- Vertical Divider -->
        <div class="footer-divider"></div>

        <!-- Content Sections -->
        <div class="footer-content">
            <!-- Deskripsi Section -->
            <div class="footer-section">
                <h3 class="footer-title">Deskripsi</h3>
                <p class="footer-text">
                    "Catering Kita adalah solusi lengkap untuk kebutuhan belanja makanan Anda. Temukan berbagai produk segar dan berkualitas hanya di sini!" "Belanja mudah dan cepat untuk semua kebutuhan katering Anda. Bergabunglah dengan ribuan pelanggan kami!"
                </p>
            </div>

            <!-- Kategori Produk Section -->
            <div class="footer-section">
                <h3 class="footer-title">Kategori Produk</h3>
                <p class="footer-text">
                    "Temukan berbagai kategori produk terbaik kami."
                </p>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="footer-contact-section">
            <div class="contact-item">
                <div class="contact-icon-wrapper location">
                    <svg class="contact-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <span class="contact-text">Jln E.sumawijaya Rt 04 / Rw 04</span>
            </div>
            <div class="contact-item">
                <div class="contact-icon-wrapper phone">
                    <svg class="contact-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                </div>
                <span class="contact-text">+62 831-1582-6505</span>
            </div>
        </div>
    </div>
</footer>

<style>
/* Footer */
.footer {
    background: linear-gradient(135deg, #B8956A 0%, #A08660 100%);
    padding: 40px 0;
    margin-top: 60px;
    position: relative;
}

.footer-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 300px 2px 1fr 200px;
    gap: 40px;
    padding: 0 40px;
    align-items: start;
}

/* Logo Section - UPDATED UNTUK CENTER VERTIKAL */
.footer-logo-section {
    display: flex;
    align-items: center;
    justify-content: center; /* Center horizontal */
    padding: 20px 0;
    height: 100%; /* Ambil seluruh tinggi container */
}

.footer-brand {
    display: flex;
    align-items: center; /* Center vertikal untuk logo dan teks */
    justify-content: center; /* Center horizontal untuk brand */
    gap: 15px;
    height: 100%; /* Ambil seluruh tinggi parent */
    transform: translateY(-30px);
}

.footer-logo {
    width: 150px;
    height: 150px;
    object-fit: contain;
}

.footer-brand-text {
    display: flex;
    flex-direction: column;
    line-height: 1.1;
    text-align: center; /* Center teks horizontal */
}

.brand-catering {
    font-size: 30px; /* Diperbesar dari 26px ke 30px */
    font-weight: bold;
    color: #FFA500;
    letter-spacing: 1px;
}

.brand-kita {
    font-size: 30px; /* Diperbesar dari 26px ke 30px */
    font-weight: bold;
    color: #333;
    letter-spacing: 1px;
}

/* Vertical Divider */
.footer-divider {
    width: 2px;
    background: linear-gradient(to bottom, transparent 0%, #8B7355 20%, #8B7355 80%, transparent 100%);
    height: 120px;
    margin: 20px 0;
    align-self: center; /* Center divider vertikal */
}

/* Content Sections */
.footer-content {
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding: 20px 0;
}

.footer-section {
    margin-bottom: 20px;
}

.footer-title {
    font-size: 26px; /* Diperbesar dari 22px ke 26px */
    font-weight: 600;
    color: #2C5F41;
    margin-bottom: 15px;
    font-style: italic;
}

.footer-text {
    color: #FFFFFF;
    line-height: 1.6;
    font-size: 16px; /* Diperbesar dari 14px ke 16px */
    text-align: justify;
    width: 100%; /* Pastikan mengambil full width */
    max-width: 630px; /* Batasi lebar untuk teks */
    margin: 0;
}

/* Contact Section */
.footer-contact-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 20px 0;
    justify-content: center; /* Center vertikal */
    align-items: flex-start; /* Align items ke kiri untuk mempertahankan icon di kiri */
    height: 100%; /* Ambil tinggi penuh container */
    min-height: 120px; /* Minimum height untuk konsistensi */
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%; /* Pastikan mengambil full width */
}

.contact-icon-wrapper {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0; /* Mencegah icon mengecil */
}

.contact-icon-wrapper.location {
    background-color: #FF4444;
}

.contact-icon-wrapper.phone {
    background-color: #00D084;
}

.contact-icon {
    width: 20px;
    height: 20px;
    color: white;
}

.contact-text {
    color: #FFFFFF;
    font-size: 16px;
    font-weight: 500;
    flex: 1; /* Mengambil sisa ruang */
    text-align: left; /* Pastikan teks align kiri */
}

/* Responsive Design */
@media (max-width: 1200px) {
    .footer-container {
        grid-template-columns: 250px 2px 1fr 180px;
        gap: 30px;
        padding: 0 30px;
    }
    
    .footer-logo {
        width: 60px;
        height: 60px;
    }
    
    .brand-catering,
    .brand-kita {
        font-size: 26px; /* Diperbesar dari 22px ke 26px */
    }
    
    .footer-title {
        font-size: 24px; /* Diperbesar dari default */
    }
    
    .footer-text {
        font-size: 15px; /* Diperbesar dari default */
    }
    
    .contact-text {
        font-size: 15px; /* Diperbesar dari default */
    }
}

@media (max-width: 992px) {
    .footer-container {
        grid-template-columns: 1fr;
        gap: 30px;
        text-align: center;
    }
    
    .footer-divider {
        display: none;
    }
    
    .footer-logo-section {
        justify-content: center;
        height: auto; /* Reset height untuk responsive */
    }
    
    .footer-brand {
        height: auto; /* Reset height untuk responsive */
    }
    
    .footer-content {
        align-items: center;
    }
    
    .footer-contact-section {
        align-items: center;
    }
    
    .footer-text {
        text-align: center;
    }
}

@media (max-width: 768px) {
    .footer {
        padding: 30px 0;
    }
    
    .footer-container {
        padding: 0 20px;
        gap: 25px;
    }
    
    .footer-logo {
        width: 50px;
        height: 50px;
    }
    
    .brand-catering,
    .brand-kita {
        font-size: 22px; /* Diperbesar dari 18px ke 22px */
    }
    
    .footer-title {
        font-size: 22px; /* Diperbesar dari 18px ke 22px */
    }
    
    .footer-text {
        font-size: 15px; /* Diperbesar dari 13px ke 15px */
    }
    
    .contact-text {
        font-size: 15px; /* Diperbesar dari 13px ke 15px */
    }
}

@media (max-width: 480px) {
    .footer-brand {
        flex-direction: column;
        gap: 10px;
        text-align: center;
        height: auto; /* Reset height untuk mobile */
    }
    
    .contact-item {
        flex-direction: column;
        gap: 8px;
        text-align: center;
    }
    
    .brand-catering,
    .brand-kita {
        font-size: 20px; /* Diperbesar untuk mobile */
    }
    
    .footer-title {
        font-size: 20px; /* Diperbesar untuk mobile */
    }
    
    .footer-text {
        font-size: 14px; /* Diperbesar untuk mobile */
    }
    
    .contact-text {
        font-size: 14px; /* Diperbesar untuk mobile */
    }
}
</style>