<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran BCA - Catering Kita</title>
    <!-- ... style ... -->
</head>
<body>
    <div class="container">
        <h1>Konfirmasi Pembayaran BCA</h1>
        
        <div class="order-details">
            <h2>Detail Pesanan</h2>
            @foreach($order->items as $item)
            <div class="order-item">
                <div class="item-name">{{ $item->product->name }}</div>
                <div class="item-qty">{{ $item->quantity }}x</div>
                <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
            </div>
            @endforeach
        </div>

        <div class="shipping-info">
            <h2>Informasi Pengiriman</h2>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y H:i') }}</p>
            <p><strong>Alamat:</strong> {{ $order->delivery_address }}</p>
            <p><strong>Telepon:</strong> {{ $order->phone_number }}</p>
            @if($order->notes)
            <p><strong>Catatan:</strong> {{ $order->notes }}</p>
            @endif
        </div>

        <div class="payment-info">
            <h2>Informasi Pembayaran</h2>
            <div class="bank-info">
                <p>Silakan transfer ke:</p>
                <p class="account-number">1234567890</p>
                <p class="account-name">PT CATERING KITA</p>
                <p class="bank-name">Bank BCA</p>
            </div>
            <div class="total-payment">
                <p>Total Pembayaran:</p>
                <h3>Rp {{ number_format($order->total, 0, ',', '.') }}</h3>
            </div>
        </div>

        <form id="payment-confirmation" method="POST" action="{{ route('payment.confirm') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="form-group">
                <label>Upload Bukti Transfer</label>
                <input type="file" name="proof_of_payment" required>
            </div>
            <button type="submit" class="btn-confirm">Konfirmasi Pembayaran</button>
        </form>
    </div>
</body>
</html>