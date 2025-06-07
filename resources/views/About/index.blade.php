<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Catering Kita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FEFAF3;
            padding-top: 80px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* About Section */
        .about {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px 100px 80px 100px;
            background-color: #FEFAF3;
            overflow: hidden;
            margin-top: 20px;
        }

        .about-image {
            flex: 0 0 45%;
            position: relative;
            z-index: 2;
        }

        .about-image img:first-child {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 15px;
            position: relative;
            transform: translateX(70px) translateY(1px);
            z-index: 2;
        }

        .about-content {
            flex: 0 0 50%;
            padding-left: 60px;
        }

        .about-content h1 {
            font-size: 48px;
            color: #4B3E2F;
            margin-bottom: 30px;
            font-weight: bold;
            margin-top: 0;
        }

        .about-content p {
            font-size: 16px;
            line-height: 1.7;
            color: #4B3E2F;
            margin-bottom: 0;
            text-align: justify;
        }

        .background-curve {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 500px;
            height: auto;
            opacity: 0.3;
        }

        /* Features Section */
        .features-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 40px 100px;
            margin: 0 auto;
            max-width: 1200px;
            background-color: #8B7355;
            border-radius: 20px;
            margin-top: -20px;
            margin-left: auto;
            margin-right: auto;
            width: calc(100% - 200px);
        }

        .feature-card {
            background: #FFFFFF;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            object-fit: contain;
        }

        .feature-title {
            font-size: 16px;
            color: #4B3E2F;
            margin: 0;
            font-weight: bold;
            text-transform: capitalize;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .about {
                flex-direction: column;
                padding: 30px 40px 60px 40px;
            }

            .about-content {
                padding-left: 0;
                text-align: left;
                margin-top: 40px;
            }

            .features-container {
                grid-template-columns: repeat(2, 1fr);
                padding: 40px 20px;
                width: calc(100% - 40px);
            }
        }

        @media (max-width: 576px) {
            .features-container {
                grid-template-columns: 1fr;
            }

            .about-content h1 {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Component -->
    <x-navbar />

    <!-- About Section -->
    <div class="about">
        <div class="about-image">
            @if($tentangKami && $tentangKami->foto)
                <!-- Gunakan foto dari database jika ada -->
                <img src="{{ asset('storage/' . $tentangKami->foto) }}" alt="Tentang Kami" 
                     onerror="this.src='{{ asset('assets/homeassets1.jpg') }}'">
            @else
                <!-- Fallback ke gambar default -->
                <img src="{{ asset('assets/homeassets1.jpg') }}" alt="Catering Food">
            @endif
            <img src="{{ asset('assets/lengkungan.png') }}" alt="Background Curve" class="background-curve">
        </div>
        <div class="about-content">
            <h1>Tentang Kami</h1>
            @if($tentangKami && $tentangKami->deskripsi)
                <!-- Gunakan deskripsi dari database -->
                <p>{{ $tentangKami->deskripsi }}</p>
            @else
                <!-- Fallback deskripsi default -->
                <p>Catering Nikmat Rasa menyediakan nasi box dan snack box untuk berbagai acara seperti ulang tahun, arisan, syukuran, hingga acara kantor. Menu utama kami mencakup nasi bakar, nasi liwet, nasi ayam geprek, nasi kebuli, nasi tumpeng, dan banyak lagi, lengkap dengan sayur dan sambal khas. Dengan pengalaman lebih dari 10 tahun melayani area Jabodetabek, kami siap menerima pesanan besar maupun kecil dengan rasa lezat, porsi pas, dan harga terjangkau. Hubungi kami sekarang untuk hidangan terbaik di acara Anda!</p>
            @endif
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-container">
        <div class="feature-card">
            <img src="{{ asset('assets/homeassets11.png') }}" alt="Pengiriman Cepat" class="feature-icon">
            <h3 class="feature-title">Pengiriman Cepat</h3>
        </div>
        <div class="feature-card">
            <img src="{{ asset('assets/homeassets12.png') }}" alt="Bersertifikat Halal" class="feature-icon">
            <h3 class="feature-title">bersertifikat halal</h3>
        </div>
        <div class="feature-card">
            <img src="{{ asset('assets/freebox.png') }}" alt="Gratis Box" class="feature-icon">
            <h3 class="feature-title">Gratis Box</h3>
        </div>
        <div class="feature-card">
            <img src="{{ asset('assets/homeassets14.png') }}" alt="Pembayaran" class="feature-icon">
            <h3 class="feature-title">Pembayaran</h3>
        </div>
    </div>

    <!-- Footer Component -->
    <x-footer />
</body>
</html>