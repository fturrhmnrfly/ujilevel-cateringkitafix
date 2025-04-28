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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            font-size: 24px;
            color: #666;
            cursor: pointer;
            border: none;
            background: none;
        }

        .payment-info {
            display: grid;
            grid-template-columns: auto auto;
            gap: 12px;
            margin-bottom: 20px;
        }

        .payment-info-label {
            color: #666;
        }

        .payment-info-value {
            text-align: right;
            font-weight: bold;
        }

        .instruction-box {
            background-color: #f8f9ff;
            border-left: 4px solid #4040ff;
            padding: 16px;
            margin: 20px 0;
        }

        .instruction-list {
            margin-left: 20px;
            line-height: 1.6;
        }

        .deadline-text {
            color: #ff4040;
            margin-top: 12px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .account-box {
            background: #f8f9ff;
            padding: 12px;
            border-radius: 8px;
        }

        .account-number {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin-top: 8px;
        }

        .copy-btn {
            background: #2c2c77;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .file-upload {
            width: 100%;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }

        .confirm-btn {
            width: 100%;
            background: #2c2c77;
            color: white;
            border: none;
            padding: 16px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
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
            <input type="file" class="file-upload" name="payment_proof" accept="storage/*">
        </div>

        <button class="confirm-btn">Konfirmasi Pembayaran</button>
    </div>

    <script>
        function generateOrderId() {
            const timestamp = new Date().getTime();
            const random = Math.floor(Math.random() * 1000);
            return `ORD${timestamp}${random}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const paymentTotal = document.getElementById('payment-total');
            const savedTotal = localStorage.getItem('orderTotal');

            if (savedTotal) {
                const total = parseInt(savedTotal);
                const formattedTotal = total.toLocaleString('id-ID');
                paymentTotal.textContent = `Rp ${formattedTotal}`;
            } else {
                const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                const selectedShipping = localStorage.getItem('selectedShipping');

                const subtotal = cartItems.reduce((sum, item) =>
                    sum + (parseFloat(item.price) * parseInt(item.quantity)), 0);

                const shippingCosts = {
                    'self': 0,
                    'instant': 10000,
                    'regular': 5000,
                    'economy': 2000
                };

                const shippingCost = shippingCosts[selectedShipping] || 0;
                const total = subtotal + shippingCost;
                const formattedTotal = total.toLocaleString('id-ID');
                paymentTotal.textContent = `Rp ${formattedTotal}`;
                localStorage.setItem('orderTotal', total.toString());
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

        document.querySelector('.confirm-btn').addEventListener('click', async function() {
            const fileInput = document.querySelector('.file-upload');
            const confirmBtn = this;

            if (!fileInput.files.length) {
                alert('Silakan upload bukti pembayaran');
                return;
            }

            confirmBtn.disabled = true;
            confirmBtn.textContent = 'Memproses...';

            try {
                const orderData = {
                    total: parseInt(document.getElementById('payment-total').textContent.replace(/[^\d]/g, '')),
                    date: new Date().toISOString(),
                    items: JSON.parse(localStorage.getItem('cartItems')) || [],
                    shipping: localStorage.getItem('selectedShipping'),
                    shippingData: {
                        deliveryDate: localStorage.getItem('deliveryDate'),
                        deliveryTime: localStorage.getItem('deliveryTime'),
                        address: localStorage.getItem('address')
                    }
                };

                const token = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData();
                formData.append('payment_proof', fileInput.files[0]);
                formData.append('total', orderData.total);
                formData.append('order_data', JSON.stringify(orderData));
                formData.append('_token', token);

                const response = await fetch('/payment/gopay/confirm', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                });

                const data = await response.json();

                if (data.success) {
                    const successOrderData = {
                        id: generateOrderId(),
                        total: orderData.total,
                        shipping: JSON.parse(localStorage.getItem('shippingData'))
                    };
                    
                    localStorage.setItem('currentOrder', JSON.stringify(successOrderData));
                    window.location.href = '/payment/gopay/success';
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan saat memproses pembayaran');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal mengonfirmasi pembayaran: ' + error.message);
            } finally {
                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Konfirmasi Pembayaran';
            }
        });
    </script>
</body>
</html>