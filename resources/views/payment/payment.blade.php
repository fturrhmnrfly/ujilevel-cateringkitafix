<!-- resources/views/payment.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .header {
            background-color: #1e2761;
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: bold;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .payment-method {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .payment-option {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .payment-option:last-child {
            border-bottom: none;
        }
        .payment-icon {
            width: 30px;
            height: 30px;
            margin-right: 15px;
        }
        .confirm-button {
            background-color: #6366f1;
            color: white;
            padding: 12px;
            border-radius: 6px;
            width: 100%;
            text-align: center;
            font-weight: 500;
        }
        .timer {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <span>MyApp</span>
            </div>
            <div class="text-sm">Order ID: {{ $payment->order_id }}</div>
        </div>
        
        <!-- Navigation -->
        <div class="px-4 py-3 border-b">
            <a href="#" class="flex items-center text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"></path>
                </svg>
                <span class="ml-2">Kembali</span>
            </a>
        </div>
        
        <!-- Payment Details -->
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">Pembayaran</h1>
            
            <div class="border-b pb-4 mb-4">
                <div class="flex justify-between mb-3">
                    <div class="text-gray-700">Order ID</div>
                    <div class="font-medium">{{ $order->id }}</div>
                </div>
                <div class="flex justify-between mb-3">
                    <div class="text-gray-700">Total Harga</div>
                    <div class="font-medium">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                </div>
                <div class="flex justify-between">
                    <div class="text-gray-700">Batas Waktu Pembayaran</div>
                    <div class="timer" id="countdown-timer"></div>
                </div>
            </div>
            
            <!-- Payment Methods -->
            <div class="payment-method">
                <h2 class="text-lg font-medium mb-3">Pilih Metode Pembayaran</h2>
                
                <div class="payment-option">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png" alt="BCA" class="payment-icon">
                    <div class="flex-grow">BCA Virtual Account</div>
                    <input type="radio" name="payment_method" value="bca_va" checked class="h-4 w-4 text-indigo-600">
                </div>
                
                <div class="payment-option">
                    <img src="https://cdn-icons-png.flaticon.com/512/6963/6963703.png" alt="Dana" class="payment-icon">
                    <div class="flex-grow">Dana</div>
                    <input type="radio" name="payment_method" value="dana" class="h-4 w-4 text-indigo-600">
                </div>
                
                <div class="payment-option">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/2560px-Gopay_logo.svg.png" alt="Gopay" class="payment-icon">
                    <div class="flex-grow">Gopay</div>
                    <input type="radio" name="payment_method" value="gopay" class="h-4 w-4 text-indigo-600">
                </div>
                
                <div class="payment-option">
                    <img src="https://cdn-icons-png.flaticon.com/512/2489/2489756.png" alt="COD" class="payment-icon">
                    <div class="flex-grow">COD</div>
                    <input type="radio" name="payment_method" value="cod" class="h-4 w-4 text-indigo-600">
                </div>
            </div>
            
            <!-- Confirmation Button -->
            <button class="confirm-button">Konfirmasi Pembayaran</button>
        </div>
    </div>

    <script>
        // Countdown timer
        function startCountdown(expiryTime) {
            const timerElement = document.getElementById('countdown-timer');
            const expiryDate = new Date(expiryTime).getTime();

            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = expiryDate - now;

                if (distance <= 0) {
                    clearInterval(timer);
                    timerElement.textContent = "Waktu pembayaran habis!";
                    return;
                }

                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                timerElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const paymentExpiry = "{{ $order->payment_expiry }}";
            startCountdown(paymentExpiry);
        });
    </script>
</body>
</html>