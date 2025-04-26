<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konfirmasi Pembayaran - {{ $paymentMethod }}</title>
    <style>
        /* Copy your existing styles here */
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-card">
            <div class="payment-header">
                <h2>Konfirmasi Pembayaran {{ $paymentMethod }}</h2>
                <button class="close-btn" onclick="window.location.href='{{ route('home') }}'">&times;</button>
            </div>

            <div class="payment-details">
                <div class="payment-row">
                    <span class="payment-label">Total :</span>
                    <span class="payment-value">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Metode Pembayaran :</span>
                    <span class="payment-value">{{ $paymentMethod }}</span>
                </div>
            </div>

            <div class="payment-instructions">
                <h3>Petunjuk Pembayaran:</h3>
                <ol>
                    <li>Transfer ke rekening bank di bawah ini sesuai dengan total pembayaran.</li>
                    <li>Gunakan ATM, Mobile Banking, atau Internet Banking untuk melakukan transfer.</li>
                    <li>Upload bukti transfer pada form di bawah ini.</li>
                    <li>Klik tombol "Konfirmasi Pembayaran" untuk menyelesaikan pesanan.</li>
                </ol>
                <p>Harap selesaikan pembayaran dalam 24 jam.</p>
            </div>

            <form action="{{ route('payment.confirm', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="account-details">
                    <div class="account-field">
                        <label>Nama Rekening</label>
                        <div class="copy-field">
                            <input type="text" value="PT Catering Kita Indonesia" readonly>
                        </div>
                    </div>

                    <div class="account-field">
                        <label>Nomor Rekening {{ $paymentMethod }}</label>
                        <div class="copy-field">
                            <input type="text" value="{{ $order->payment_number }}" readonly>
                            <button type="button" class="copy-btn">Salin</button>
                        </div>
                    </div>
                </div>

                <div class="upload-section">
                    <label>Bukti Transferan</label>
                    <input type="file" name="proof" id="transfer-proof" accept="image/*" required hidden>
                    <div class="upload-btn" onclick="document.getElementById('transfer-proof').click()">
                        Pilih File
                    </div>
                </div>

                <button type="submit" class="confirm-btn">Konfirmasi Pembayaran</button>
            </form>
        </div>
    </div>

    <script>
        // Copy your existing scripts here
    </script>
</body>
</html>