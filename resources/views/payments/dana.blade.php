<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konfirmasi Pembayaran Dana - Catering Kita</title>
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
            border-bottom: 1px solid #eee;
            padding-bottom: 16px;
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

        /* Add countdown timer styles */
        .payment-timer {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
        }

        .payment-countdown {
            color: #ff6b01;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="modal-title">Konfirmasi Pembayaran</h2>
        </div>

        <div class="payment-info">
            <div class="info-row">
                <span>Total :</span>
                <span id="payment-total">Rp 0</span>
            </div>
            <div class="info-row">
                <span>Metode Pembayaran :</span>
                <span>Dana</span>
            </div>
            <div class="info-row">
                <span>Batas waktu pembayaran</span>
                <span class="payment-countdown">05:00</span>
            </div>
        </div>

        <div class="instruction-box">
            <h3>Petunjuk Pembayaran:</h3>
            <ol class="instruction-list">
                <li>Transfer ke nomor Dana di bawah ini sesuai dengan total pembayaran.</li>
                <li>Gunakan aplikasi Dana untuk melakukan transfer.</li>
                <li>Upload bukti transfer pada form di bawah ini.</li>
                <li>Klik tombol "Konfirmasi Pembayaran" untuk menyelesaikan pesanan.</li>
            </ol>
            <p class="deadline-text">Harap selesaikan pembayaran dalam 24 jam.</p>
        </div>

        <div class="form-group">
            <label class="form-label">Nama Akun Dana</label>
            <div class="account-box">PT Catering Kita Indonesia</div>
        </div>

        <div class="form-group">
            <label class="form-label">Nomor Dana</label>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Add SweetAlert2 CDN
            const sweetalertScript = document.createElement('script');
            sweetalertScript.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            document.head.appendChild(sweetalertScript);
            
            // Get saved total from localStorage
            const orderTotal = localStorage.getItem('orderTotal');
            const totalElement = document.querySelector('#payment-total');
            
            if (orderTotal && totalElement) {
                totalElement.textContent = `Rp ${parseInt(orderTotal).toLocaleString('id-ID')}`;
            }

            // Add countdown timer
            const startTime = new Date().getTime();
            const fiveMinutes = 1 * 60 * 1000;
            const endTime = startTime + fiveMinutes;
            
            function updateCountdown() {
                const currentTime = new Date().getTime();
                const timeLeft = endTime - currentTime;

                const countdownElement = document.querySelector('.payment-countdown');

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    countdownElement.textContent = "Waktu Habis";
                    
                    Swal.fire({
                        title: 'Waktu Pembayaran Habis',
                        text: 'Batas waktu pembayaran telah habis. Silakan buat pesanan baru.',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#2c2c77',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/keranjang';
                        }
                    });
                    return;
                }

                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                
                if (countdownElement) {
                    countdownElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                }
            }

            const timerInterval = setInterval(updateCountdown, 1000);
            updateCountdown();

            // Copy button with SweetAlert2
            document.querySelector('.copy-btn').addEventListener('click', function() {
                const accNumber = '081234567890';
                navigator.clipboard.writeText(accNumber).then(() => {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Nomor Dana berhasil disalin',
                        icon: 'success',
                        confirmButtonColor: '#2c2c77',
                        timer: 1500,
                        showConfirmButton: false
                    });
                });
            });

            // Handle payment confirmation
            document.querySelector('.confirm-btn').addEventListener('click', async function() {
                const fileInput = document.querySelector('.file-upload');
                
                if (!fileInput.files || !fileInput.files.length) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Silakan upload bukti pembayaran',
                        icon: 'error',
                        confirmButtonColor: '#2c2c77'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Memproses Pembayaran',
                    text: 'Mohon tunggu sebentar...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                try {
                    const formData = new FormData();
                    formData.append('payment_proof', fileInput.files[0]);
                    formData.append('total', localStorage.getItem('orderTotal') || 0);
                    formData.append('order_data', localStorage.getItem('currentOrder') || '{}');
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                    const response = await fetch('/payment/dana/confirm', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pembayaran berhasil dikonfirmasi',
                            icon: 'success',
                            confirmButtonColor: '#2c2c77',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/payment/dana/success';
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal mengonfirmasi pembayaran: ' + error.message,
                        icon: 'error',
                        confirmButtonColor: '#2c2c77'
                    });
                }
            });
        });
    </script>
</body>
</html>