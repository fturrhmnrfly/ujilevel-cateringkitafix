<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konfirmasi Pembayaran BCA</title>
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

        .payment-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-row span:first-child {
            color: #666;
        }

        .info-row span:last-child {
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

        .modal-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 16px;
            margin-bottom: 16px;
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
                <span>BCA</span>
            </div>
            <div class="info-row">
                <span>Batas waktu pembayaran</span>
                <span class="payment-countdown">05:00</span>
            </div>
        </div>

        <div class="instruction-box">
            <h3>Petunjuk Pembayaran:</h3>
            <ol class="instruction-list">
                <li>Transfer ke rekening bank di bawah ini sesuai dengan total pembayaran.</li>
                <li>Gunakan ATM, Mobile Banking, atau Internet Banking untuk melakukan transfer.</li>
                <li>Upload bukti transfer pada form di bawah ini.</li>
                <li>Klik tombol "Buat Pesanan" untuk menyelesaikan pesanan.</li>
            </ol>
            <p class="deadline-text">Harap selesaikan pembayaran Sebelum Waktu Habis.</p>
        </div>

        <div class="form-group">
            <label class="form-label">Nama Rekening</label>
            <div class="account-box">LINA YUNINGSIH</div>
        </div>

        <div class="form-group">
            <label class="form-label">Nomor Rekening BCA</label>
            <div class="account-number">
                <span>0954772485</span>
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
            
            // Existing total logic
            const orderTotal = localStorage.getItem('orderTotal');
            const totalElement = document.querySelector('#payment-total');
            
            if (orderTotal && totalElement) {
                totalElement.textContent = `Rp ${parseInt(orderTotal).toLocaleString('id-ID')}`;
            }

            // Add countdown timer logic
            const startTime = new Date().getTime();
            const fiveMinutes = 5 * 60 * 1000; // 5 minutes in milliseconds
            const endTime = startTime + fiveMinutes;
            
            function updateCountdown() {
                const currentTime = new Date().getTime();
                const timeLeft = endTime - currentTime;

                const countdownElement = document.querySelector('.payment-countdown');

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    countdownElement.textContent = "Waktu Habis";
                    
                    // Disable confirm button
                    const confirmBtn = document.querySelector('.confirm-btn');
                    if (confirmBtn) {
                        confirmBtn.disabled = true;
                        confirmBtn.style.backgroundColor = '#ccc';
                    }
                    
                    // Show SweetAlert2 when time expires
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

                const minutes = Math.floor(timeLeft / 60000);
                const seconds = Math.floor((timeLeft % 60000) / 1000);
                
                if (countdownElement) {
                    countdownElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                }
            }

            // Start the countdown timer
            const timerInterval = setInterval(updateCountdown, 1000);
            updateCountdown(); // Initial call

            // Add copy button notification with SweetAlert2
            document.querySelector('.copy-btn').addEventListener('click', function() {
                const accNumber = '2233445566668855';
                navigator.clipboard.writeText(accNumber).then(() => {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Nomor rekening berhasil disalin',
                        icon: 'success',
                        confirmButtonColor: '#2c2c77',
                        timer: 1500,
                        showConfirmButton: false
                    });
                });
            });

            // Handle form submission with SweetAlert2
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

                // Show loading state
                Swal.fire({
                    title: 'Memproses Pembayaran',
                    text: 'Mohon tunggu sebentar...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                try {
                    // Create FormData object
                    const formData = new FormData();
                    formData.append('payment_proof', fileInput.files[0]);
                    formData.append('total', localStorage.getItem('orderTotal') || 0);
                    formData.append('order_data', localStorage.getItem('currentOrder') || '{}');
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                    // Send request to server
                    const response = await fetch('/payment/bca/confirm', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Get shipping and order data from localStorage
                        const existingShippingData = JSON.parse(localStorage.getItem('shippingData') || '{}');
                        const orderData = JSON.parse(localStorage.getItem('currentOrder') || '{}');
                        
                        // Store complete order data including shipping info
                        localStorage.setItem('currentOrder', JSON.stringify({
                            id: data.order_id || orderData.id,
                            date: new Date().toISOString(),
                            deliveryDate: existingShippingData.deliveryDate,
                            deliveryTime: existingShippingData.deliveryTime, 
                            address: existingShippingData.address,
                            totalPayment: localStorage.getItem('orderTotal'),
                            status: 'PAID'
                        }));

                        // Success handling with redirect
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pembayaran berhasil dikonfirmasi',
                            icon: 'success',
                            confirmButtonColor: '#2c2c77',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/payment/bca/success';
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
