<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-md rounded-md">
        <a href="/" class="text-blue-500">&larr; Kembali</a>
        
        <h2 class="text-2xl font-bold mt-4">Pembayaran</h2>
        
        <div class="bg-gray-100 p-4 rounded-md mt-4">
            <p><strong>Order ID:</strong> {{ $order_id }}</p>
            <p><strong>Batas Waktu Pembayaran:</strong> <span class="text-red-500">23:59:59</span></p>
        </div>

        <form action="{{ route('pembayaran.konfirmasi') }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order_id }}">

            <h3 class="text-lg font-bold">Pilih Metode Pembayaran</h3>
            
            <div class="mt-4 space-y-2">
                <label class="flex items-center space-x-2">
                    <input type="radio" name="payment_method" value="BCA Virtual Account" required>
                    <span>BCA Virtual Account</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="payment_method" value="Dana">
                    <span>Dana</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="payment_method" value="Gopay">
                    <span>Gopay</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="payment_method" value="COD">
                    <span>COD</span>
                </label>
            </div>

            <button type="submit" class="mt-6 w-full bg-blue-500 text-white py-2 rounded-md">Konfirmasi Pembayaran</button>
        </form>
    </div>
   
    
</body>
</html>
