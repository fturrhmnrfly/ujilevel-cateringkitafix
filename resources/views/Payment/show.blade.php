<!-- resources/views/payment/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #1e3799;
            color: white;
            padding: 10px 20px;
        }
        .navbar img {
            height: 40px;
        }
        .payment-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .back-button {
            color: #333;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .back-button i {
            margin-right: 10px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .order-info {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .payment-method {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .payment-method img {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }
        .payment-method-left {
            display: flex;
            align-items: center;
        }
        .confirm-button {
            background-color: #5868db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 15px;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
        }
        .timer {
            color: #ff9800;
            display: flex;
            align-items: center;
        }
        .timer i {
            margin-right: 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Kota">
            <span>kerjating</span>
        </div>
    </div>

    <div class="container payment-container mt-4">
        <a href="{{ route('home') }}" class="back-button">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <h2>Pembayaran</h2>

        <div class="card">
            <div class="order-info">
                <div>
                    <p class="text-muted mb-1">Order ID</p>
                    <h5>{{ $order->order_id }}</h5>
                </div>
                <div>
                    <p class="text-muted mb-1">Batas Waktu Pembayaran</p>
                    <div class="timer">
                        <i class="bi bi-clock"></i>
                        <span id="countdown">--:--:--</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="mb-4">Pilih Metode Pembayaran</h5>
                
                <form action="{{ route('payment.confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                    
                    @foreach($paymentMethods as $method)
                    <div class="payment-method">
                        <div class="payment-method-left">
                            <img src="{{ asset('images/' . $method['icon']) }}" alt="{{ $method['name'] }}">
                            <span>{{ $method['name'] }}</span>
                        </div>
                        <div>
                            <input type="radio" name="payment_method" value="{{ $method['id'] }}" id="{{ $method['id'] }}" class="form-check-input">
                        </div>
                    </div>
                    @endforeach
                    
                    <button type="submit" class="confirm-button">Konfirmasi Pembayaran</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set the countdown timer
        const remainingTime = {{ $remainingTime }};
        let timer = remainingTime;
        
        function updateTimer() {
            if (timer <= 0) {
                document.getElementById('countdown').innerHTML = "00:00:00";
                window.location.reload(); // Reload to show expired message
                return;
            }
            
            const hours = Math.floor(timer / 3600);
            const minutes = Math.floor((timer % 3600) / 60);
            const seconds = timer % 60;
            
            document.getElementById('countdown').innerHTML = 
                (hours < 10 ? "0" + hours : hours) + ":" +
                (minutes < 10 ? "0" + minutes : minutes) + ":" +
                (seconds < 10 ? "0" + seconds : seconds);
            
            timer--;
            setTimeout(updateTimer, 1000);
        }
        
        // Start the countdown timer when page loads
        window.onload = updateTimer;
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
</html>