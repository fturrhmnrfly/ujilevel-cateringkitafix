<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konfirmasi Pembayaran COD - Catering Kita</title>
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
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 16px;
            margin-bottom: 24px;
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

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .payment-method-selector {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .payment-methods-dropdown {
            display: none;
            margin-top: 8px;
        }

        .payment-methods-dropdown.show {
            display: block;
        }

        .payment-option {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .payment-option:hover {
            background-color: #f8f9fa;
        }

        .account-number {
            display: none;
            margin-top: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .account-number.show {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .copy-btn {
            background: #2c2c77;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
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

        .account-box {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            color: #333;
            border: 1px solid #ddd;
        }

        .instruction-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 16px;
            margin-bottom: 24px;
        }

      .payment-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.payment-modal.show {
    opacity: 1;
    display: block;
}

.payment-modal-content {
    background: white;
    width: 385px; /* Match exact width from screenshot */
    border-radius: 12px;
    padding: 24px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: opacity 0.3s ease;
}

.payment-modal.show .payment-modal-content {    
    transform: translate(-50%, -50%);
}
        .payment-option {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .payment-option:hover {
            background-color: #f8f9fa;
        }

        .payment-option img {
            width: 32px;
            height: auto;
        }

        .payment-option.selected {
            border-color: #2c2c77;
            background-color: #f0f7ff;
        }

        .modal-body {
            margin-top: 20px;
        }

        .konfirmasi-btn {
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
            <span class="payment-info-value">COD</span>
        </div>

        <div class="instruction-box">
            <div style="display: flex; align-items: start; gap: 10px;">
                <span style="color: #ffc107; font-size: 20px;">⚠️</span>
                <p>Untuk pemesanan COD, Anda harus membayar DP sebesar 35% melalui transfer bank/e-wallet terlebih dahulu.</p>
            </div>
        </div>

        <form id="cod-form">
            <div class="form-group">
                <label class="form-label">Nama Rekening</label>
                <div class="account-box">PT Catering Kita Indonesia</div>
            </div>

            <div class="form-group">
                <label class="form-label">Nomor Pembayaran</label>
                <div class="payment-method-selector" id="payment-selector">
                    <span>Pilih Metode Pembayaran</span>
                    <span>▼</span>
                </div>

                <div class="payment-methods-dropdown" id="payment-methods">
                    <div class="payment-option" data-method="bca" data-number="2233 4455 6666 8855">
                        <img src="{{ asset('assets/kartubca.png') }}" alt="BCA" style="width: 24px; margin-right: 8px;">
                        BCA Virtual Account
                    </div>
                    <div class="payment-option" data-method="dana" data-number="0812-3456-7890">
                        <img src="{{ asset('assets/dana.png') }}" alt="DANA" style="width: 24px; margin-right: 8px;">
                        Dana
                    </div>
                    <div class="payment-option" data-method="gopay" data-number="0812-3456-7890">
                        <img src="{{ asset('assets/gopay.png') }}" alt="Gopay" style="width: 24px; margin-right: 8px;">
                        Gopay
                    </div>
                </div>

                <div class="account-number" id="account-number">
                    <span id="account-number-text"></span>
                    <button type="button" class="copy-btn">Salin</button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Bukti Transferan</label>
                <input type="file" class="file-upload" accept="image/*" required>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah DP</label>
                <div class="account-box" id="dp-amount">Rp 0</div>
            </div>

            <div class="form-group">
                <label class="form-label">Sisa Pembayaran (COD)</label>
                <div class="account-box" id="remaining-amount">Rp 0</div>
            </div>

            <button type="submit" class="confirm-btn">Konfirmasi Pembayaran</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentTotal = document.getElementById('payment-total');
            const dpAmount = document.getElementById('dp-amount');
            const remainingAmount = document.getElementById('remaining-amount');
            const savedTotal = localStorage.getItem('orderTotal');
            
            if (savedTotal) {
                const total = parseInt(savedTotal);
                const dp = Math.ceil(total * 0.35); // Calculate 35% DP and round up
                const remaining = total - dp;
                
                // Format currency
                paymentTotal.textContent = `Rp ${total.toLocaleString('id-ID')}`;
                dpAmount.textContent = `Rp ${dp.toLocaleString('id-ID')}`;
                remainingAmount.textContent = `Rp ${remaining.toLocaleString('id-ID')}`;
                
                // Store DP amount for later use
                localStorage.setItem('dpAmount', dp);
                localStorage.setItem('remainingAmount', remaining);
            }

            // Payment method selection
            const paymentSelector = document.getElementById('payment-selector');
            const accountNumber = document.getElementById('account-number');
            const accountNumberText = document.getElementById('account-number-text');

            paymentSelector.addEventListener('click', function() {
                showPaymentModal();
            });

            function showPaymentModal() {
                const modal = document.createElement('div');
                modal.className = 'payment-modal';
                modal.innerHTML = `
                    <div class="modal-content payment-modal-content">
                        <div class="modal-header">
                            <h3>Metode Pembayaran DP</h3>
                            <span class="close">&times;</span>
                        </div>
                        <div class="modal-body">
                            <div class="payment-options">
                                <div class="payment-option" data-method="bca" data-number="2233 4455 6666 8855">
                                    <img src="{{ asset('assets/kartubca.png') }}" alt="BCA">
                                    <span>BCA Virtual Account</span>
                                </div>
                                <div class="payment-option" data-method="dana" data-number="0812-3456-7890">
                                    <img src="{{ asset('assets/dana.png') }}" alt="DANA">
                                    <span>Dana</span>
                                </div>
                                <div class="payment-option" data-method="gopay" data-number="0812-3456-7890">
                                    <img src="{{ asset('assets/gopay.png') }}" alt="Gopay">
                                    <span>Gopay</span>
                                </div>
                            </div>
                            <button class="konfirmasi-btn">Konfirmasi</button>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);
                setTimeout(() => modal.classList.add('show'), 10);

                // Handle payment option selection
                const options = modal.querySelectorAll('.payment-option');
                let selectedOption = null;

                options.forEach(option => {
                    option.addEventListener('click', function() {
                        options.forEach(opt => opt.classList.remove('selected'));
                        this.classList.add('selected');
                        selectedOption = this;
                    });
                });

                // Handle close button
                const closeBtn = modal.querySelector('.close');
                closeBtn.onclick = () => {
                    modal.classList.remove('show');
                    setTimeout(() => modal.remove(), 300);
                };

                // Handle confirm button
                const confirmBtn = modal.querySelector('.konfirmasi-btn');
                confirmBtn.addEventListener('click', function() {
                    if (!selectedOption) {
                        alert('Silakan pilih metode pembayaran');
                        return;
                    }

                    const method = selectedOption.dataset.method;
                    const number = selectedOption.dataset.number;
                    
                    paymentSelector.querySelector('span').textContent = selectedOption.querySelector('span').textContent;
                    accountNumberText.textContent = number;
                    accountNumber.classList.add('show');
                    
                    closeBtn.onclick();
                });

                // Close on outside click
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeBtn.onclick();
                    }
                });
            }

            // Copy button
            document.querySelector('.copy-btn').addEventListener('click', function() {
                const number = accountNumberText.textContent.replace(/[^0-9]/g, '');
                navigator.clipboard.writeText(number)
                    .then(() => alert('Nomor berhasil disalin!'));
            });

            // Close button
            document.querySelector('.close-btn').addEventListener('click', function() {
                window.history.back();
            });

            // Form submission
            document.getElementById('cod-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const fileInput = document.querySelector('.file-upload'); // Perbaiki selector
                if (!fileInput.files.length) {
                    alert('Silakan upload bukti transfer DP');
                    return;
                }

                const selectedPayment = paymentSelector.querySelector('span').textContent;
                if (selectedPayment === 'Pilih Metode Pembayaran') {
                    alert('Silakan pilih metode pembayaran DP');
                    return;
                }

                try {
                    // Siapkan data order
                    const orderData = {
                        total: parseInt(savedTotal),
                        dp: parseInt(localStorage.getItem('dpAmount')),
                        remainingAmount: parseInt(localStorage.getItem('remainingAmount')),
                        date: new Date().toISOString(),
                        items: JSON.parse(localStorage.getItem('cartItems')) || [],
                        shipping: localStorage.getItem('selectedShipping'),
                        shippingData: {
                            deliveryDate: localStorage.getItem('deliveryDate'),
                            deliveryTime: localStorage.getItem('deliveryTime'),
                            address: localStorage.getItem('address')
                        }
                    };

                    // Simpan data order
                    localStorage.setItem('currentOrder', JSON.stringify(orderData));

                    // Upload bukti pembayaran (jika diperlukan)
                    const formData = new FormData();
                    formData.append('payment_proof', fileInput.files[0]);
                    formData.append('order_data', JSON.stringify(orderData));

                    // Redirect ke halaman success
                    window.location.href = '/payment/cod/success';

                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses pembayaran');
                }
            });
        });
    </script>
</body>
</html>