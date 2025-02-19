<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .steps {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }

        .step {
            display: flex;
            align-items: center;
            margin: 0 15px;
        }

        .step-number {
            width: 30px;
            height: 30px;
            background-color: #4e73f8;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 14px;
        }

        .step-text {
            color: #333;
            font-size: 14px;
        }

        .package {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .package-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .package-price {
            color: #4e73f8;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .package-details {
            list-style: none;
        }

        .package-details li {
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }

        .button-container {
            text-align: right;
            margin-top: 30px;
        }

        .next-button {
            background-color: #4e73f8;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .next-button:hover {
            background-color: #3558d6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulir Pemesanan</h1>
        <p class="subtitle">Lengkapi informasi pemesanan anda</p>
        
        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-text">Pilih Paket</div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-text">Detail Acara</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-text">Konfirmasi</div>
            </div>
        </div>

        <div class="package">
            <h2 class="package-title">Paket Prasmanan</h2>
            <p class="package-price">Rp 30.000/porsi</p>
            <ul class="package-details">
                <li>Min. order: 100 porsi</li>
                <li>10 menu utama</li>
                <li>3 menu pembuka</li>
                <li>2 menu penutup</li>
                <li>Setup lengkap</li>
            </ul>
        </div>

        <div class="package">
            <h2 class="package-title">Paket Nasi Box</h2>
            <p class="package-price">Rp 25.000/box</p>
            <ul class="package-details">
                <li>Min. order: 50 box</li>
                <li>3 snack asin</li>
                <li>3 snack manis</li>
                <li>Nasi tradisional</li>
                <li>Air mineral</li>
            </ul>
        </div>

        <div class="button-container">
            <button class="next-button">Lanjutkan</button>
        </div>
    </div>
</body>
</html>