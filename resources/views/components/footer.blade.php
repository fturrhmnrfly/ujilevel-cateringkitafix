<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
</div>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <div class="footer-brand">
                <img src="{{ asset('assets/logo.png') }}" alt="Catering Kita Logo">
                <div class="footer-brand-text">
                    <span class="brand-catering">CATERING</span>
                    <span class="brand-kita">KITA</span>
                </div>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="footer-section">
            <h3 class="footer-title">Deskripsi</h3>
            <p class="footer-text">
                "Catering Kita adalah solusi lengkap untuk kebutuhan belanja makanan Anda. Temukan berbagai
                produk segar dan berkualitas hanya di sini!" "Belanja mudah dan cepat untuk semua kebutuhan
                katering Anda. Bergabunglah dengan ribuan pelanggan kami!"
            </p>
        </div>

        <div class="footer-section">
            <h3 class="footer-title">Kategori Produk</h3>
            <p class="footer-text">
                "Temukan berbagai kategori produk terbaik kami."
            </p>
        </div>

        <div class="footer-section">
            <h3 class="footer-title">Contact</h3>
            <div class="footer-contact">
                <div class="contact-item">
                    <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Jln E.sumawijaya GG.amin RT 02/02 Desa pasireurih Kec tamansari</span>
                </div>
                <div class="contact-item">
                    <svg class="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                    <span>+62 831-1582-6505</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Footer */
.footer {
    background-color: #B19370;
    padding: 40px 0;
    margin-top: 60px;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.5fr 2px 2fr 2fr 2fr;
    gap: 30px;
    padding: 0 20px;
}

.footer-divider {
    width: 2px;
    background-color: #999;
    height: 100%;
}

.footer-logo {
    display: flex;
    flex-direction: column;
    margin-left: 20px;
}

.footer-logo img {
    width: 80px;
    height: auto;
    margin-bottom: 10px;
}

.footer-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.footer-brand-text {
    font-size: 24px;
    font-weight: bold;
}

.brand-catering {
    color: #FFA500;
}

.brand-kita {
    color: #333;
}

.footer-section {
    padding: 0 20px;
}

.footer-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
}

.footer-text {
    color: #fff;
    line-height: 1.6;
    font-size: 14px;
}

.footer-contact {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    font-size: 14px;
}

.contact-icon {
    width: 20px;
    height: 20px;
    color: #F61515;
}

/* Responsive */
@media (max-width: 992px) {
    .footer-container {
        grid-template-columns: 1fr;
    }

    .footer-divider {
        display: none;
    }
}
</style>