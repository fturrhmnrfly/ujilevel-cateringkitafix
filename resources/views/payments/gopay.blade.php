<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konfirmasi Pembayaran Gopay - Catering Kita</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .modal-container {
            background: white;
            border-radius: 12px;
            padding: 24px;
            max-width: 500px;
            margin: 20px auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .payment-info {
            background: #f8f9fa;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .payment-info-label {
            color: #666;
            display: block;
            margin-bottom: 4px;
        }

        .payment-info-value {
            font-weight: bold;
            color: #333;
            font-size: 18px;
            display: block;
        }

        .instruction-box {
            margin-bottom: 24px;
        }

        .instruction-list {
            padding-left: 24px;
            margin-top: 12px;
        }

        .instruction-list li {
            margin-bottom: 8px;
            color: #444;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 500;
        }

        .account-box {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            color: #333;
        }

        .account-number {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
        }

        .copy-btn {
            background: #2c2c77;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .deadline-text {
            color: #dc3545;
            margin-top: 12px;
            font-size: 14px;
        }

        .file-upload {
            margin-top: 8px;
        }

        .confirm-btn {
            background: #2c2c77;
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="modal-title">Konfirmasi Pembayaran</h2>
            <button class="close-btn">&times;</button>
        </div>

        <div class="payment-info">
            <span class="payment-info-label">Total:</span>
            <span class="payment-info-value" id="payment-total">Rp 0</span>
            <span class="payment-info-label">Metode Pembayaran:</span>
            <span class="payment-info-value">Gopay</span>
        </div>

        <div class="instruction-box">
            <h3>Petunjuk Pembayaran:</h3>
            <ol class="instruction-list">
                <li>Transfer ke nomor Gopay di bawah ini sesuai dengan total pembayaran.</li>
                <li>Gunakan aplikasi Gojek untuk melakukan transfer.</li>
                <li>Upload bukti transfer pada form di bawah ini.</li>
                <li>Klik tombol "Konfirmasi Pembayaran" untuk menyelesaikan pesanan.</li>
            </ol>
            <p class="deadline-text">Harap selesaikan pembayaran dalam 24 jam.</p>
        </div>

        <div class="form-group">
            <label class="form-label">Nama Akun Gopay</label>
            <div class="account-box">PT Catering Kita Indonesia</div>
        </div>

        <div class="form-group">
            <label class="form-label">Nomor Gopay</label>
            <div class="account-number">
                <span>0812-3456-7890</span>
                <button class="copy-btn">Salin</button>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Bukti Transferan</label>
            <input type="file" class="file-upload" accept="image/*">
        </div>

        <button class="confirm-btn">Konfirmasi Pembayaran</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentTotal = document.getElementById('payment-total');
            
            const savedTotal = localStorage.getItem('orderTotal');
            
            if (savedTotal) {
                const total = parseInt(savedTotal);
                const formattedTotal = total.toLocaleString('id-ID');
                paymentTotal.textContent = `Rp ${formattedTotal}`;
            }
        });

        document.querySelector('.copy-btn').addEventListener('click', function() {
            const accNumber = '081234567890';
            navigator.clipboard.writeText(accNumber)
                .then(() => alert('Nomor Gopay berhasil disalin!'));
        });

        document.querySelector('.close-btn').addEventListener('click', function() {
            window.history.back();
        });

        document.querySelector('.confirm-btn').addEventListener('click', function() {
            const fileInput = document.querySelector('.file-upload');

            if (!fileInput.files.length) {
                alert('Silakan upload bukti pembayaran');
                return;
            }

            const total = parseInt(document.getElementById('payment-total').textContent.replace(/[^\d]/g, ''));

            const orderData = {
                total: total,
                date: new Date().toISOString(),
                items: JSON.parse(localStorage.getItem('cartItems')) || [],
                shipping: localStorage.getItem('selectedShipping'),
                shippingData: {
                    deliveryDate: localStorage.getItem('deliveryDate'),
                    deliveryTime: localStorage.getItem('deliveryTime'),
                    address: localStorage.getItem('address')
                }
            };
            localStorage.setItem('currentOrder', JSON.stringify(orderData));

            window.location.href = '/payment/gopay/success';
        });
    </script>
</body>
</html>