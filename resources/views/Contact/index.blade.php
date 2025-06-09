<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Catering Kita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #C4A484;  /* Change base background color */
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* Navbar Styles */
        nav.navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c2c77;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .navbar .logo img {
            width: 50px;
            /* Ukuran logo */
            height: 50px;
            margin-right: 10px;
        }

        .navbar .logo .text-navbar p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #ffcc00;
            text-transform: uppercase;
        }

        .navbar .logo .text-navbar p:nth-child(2) {
            color: #fff;
        }

        .navbar .search-bar {
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            width: 40%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar .search-bar input[type="text"] {
            border: none;
            outline: none;
            flex: 1;
            padding: 5px;
            font-size: 14px;
        }

        .navbar .search-bar button {
            border: none;
            background: none;
            cursor: pointer;
            color: #2c2c77;
            font-size: 16px;
        }

        .navbar .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        @media (max-width: 768px) {
            nav.navbar {
                padding: 10px 15px;
            }

            body {
                padding-top: 60px;
            }

            .breadcrumb-container {
                margin-top: 60px;
            }
        }

        .navbar .nav-links li {
            display: inline-block;
        }

        .navbar .nav-links li a {
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .navbar .nav-links li a:hover {
            color: #ffcc00;
            /* Warna hover */
        }

        .navbar .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .navbar .profile img {
            width: 40px;
            height: 40px;
        }

        .navbar .profile span {
            font-size: 14px;
            font-weight: bold;
        }

        /* Breadcrumb Styles */
        .breadcrumb-container {
            background-color: #f3f4f6;
            border-bottom: 1px solid #e5e7eb;
            margin-top: 80px;
            /* Add margin to prevent overlap with fixed navbar */
        }

        .breadcrumb {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .breadcrumb-title {
            font-size: 1.25rem;
            color: #374151;
        }

        .breadcrumb-nav {
            color: #6b7280;
        }

        .breadcrumb-nav a {
            color: #6b7280;
            text-decoration: none;
        }

        .contact-container {
            max-width: 100%;
            margin: 80px auto 0;
            padding: 40px;
            position: relative;
            min-height: calc(100vh - 80px);
            background-color: #C4A484;
        }

        .contact-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px; /* Increased gap for title placement */
            position: relative;
            padding: 40px;
            background: url('{{ asset('assets/backgroundcontact.jpeg') }}') center/cover no-repeat;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Move heading outside of contact-info */
        .contact-heading {
            position: absolute;
            top: -5px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 42px;
            color: #4B3E2F;
            width: 100%;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            z-index: 1;
        }

        .contact-heading span {
            color: #ffffff; /* Make 'Kami' white */
        }

        .contact-info {
            background: url('{{ asset('assets/note-bg.png') }}') center/contain no-repeat;
            padding: 40px;
            border-radius: 15px;
            height: 450px; /* Reduced height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-top: 40px; /* Add space for heading */
        }

        .contact-form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
        }

        .whatsapp-btn {
            display: inline-block;
            background-color: #C17F3B;
            color: white;
            padding: 12px 24px;
            width: 100%;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            margin: 20px 0;
            transition: background-color 0.3s;
        }

        .contact-text {
            text-align: center;
            color: #4B3E2F;
            margin: 10px 0;
        }

        .phone-number {
            text-align: center;
            color: #4B3E2F;
            font-size: 16px;
        }

        .map-container {
            width: 90%; /* Reduced from 100% */
            height: 400px; /* Reduced from 450px */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 60px; /* Increased from 40px to move down */
            margin-left: auto; /* Center the reduced width map */
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
                padding-left: 20px;
                background-position: top center;
            }
            
            .contact-info {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <x-navbar/>

    <div class="contact-container">
        <div class="contact-grid">
            <h1 class="contact-heading">Hubungi <span>Kami</span></h1>
            
            <div class="contact-info">
                <form class="contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Anda" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Pesan" rows="4" required></textarea>
                    </div>
                    <a href="https://wa.me/6283115826505" class="whatsapp-btn">
                        Kirim Via WhatsApp
                    </a>
                    <p class="contact-text">Atau hubungi langsung:</p>
                    <p class="phone-number">+62 831-1582-6505</p>
                </form>
            </div>

            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.4527772556727!2d106.93194731455444!3d-6.5847899952312915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c21c85d86e8b%3A0x8d0f0a2c6cf3b5f2!2sJl.%20E.%20Sumawijaya%2C%20Pasir%20Eurih%2C%20Kec.%20Tamansari%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat%2016610!5e0!3m2!1sid!2sid!4v1620898564509!5m2!1sid!2sid"
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    <!-- Ganti footer manual dengan komponen footer -->
    <x-footer />

</body>
</html>
