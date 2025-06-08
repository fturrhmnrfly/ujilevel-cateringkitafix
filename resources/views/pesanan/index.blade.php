<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita User - Pesanan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('pesanan.css') }}">
</head>
<body>
<x-navbar></x-navbar>

<div class="container">
    <div class="tab-navigation">
        @php
            $tabs = [
                'pesanan.index' => 'Semua Pesanan',
                'pesanan.unpaid' => 'Belum Bayar', 
                'pesanan.process' => 'Diproses',
                'pesanan.shipped' => 'Dikirim',
                'pesanan.completed' => 'Selesai',
                'pesanan.penilaian' => 'Penilaian'
            ];
        @endphp
        
        @foreach($tabs as $route => $label)
            <a href="{{ route($route) }}" class="tab-btn {{ request()->routeIs($route) ? 'active' : '' }}">{{ $label }}</a>
        @endforeach
    </div>

    @if(isset($orders) && count($orders) > 0)
        <div class="orders-grid-container">
            @foreach($orders as $order)
                <x-order-card :order="$order" />
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <img src="{{ asset('assets/empty-order.png') }}" alt="Tidak ada pesanan">
            <h3>Belum Ada Pesanan</h3>
            <p>Anda belum memiliki pesanan. Silahkan pesan makanan terlebih dahulu.</p>
            <a href="{{ route('dashboard') }}" class="btn-single">Pesan Sekarang</a>
        </div>
    @endif
</div>

{{-- Include the modals component --}}
<x-order-modals />

<script>
    // Initialize global order data
    window.orderData = window.orderData || {};
    console.log('Global order data initialized:', window.orderData);
    
    // Debug function
    function debugOrderData() {
        console.log('Current orderData:', window.orderData);
        console.log('Available order IDs:', Object.keys(window.orderData));
    }
    
    // Call debug after page load
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(debugOrderData, 1000);
    });
</script>

<script src="{{ asset('pesanan.js') }}"></script>
</body>
</html>