<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran Berhasil - Catering Kita</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }
    
    body {
      background-color: #f5f5f5;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    .header {
      background-color: #3f51b5;
      color: white;
      padding: 12px 20px;
      text-align: center;
      font-size: 16px;
      font-weight: bold;
    }
    
    .container {
      max-width: 480px;
      margin: 0 auto;
      background-color: white;
      min-height: calc(100vh - 48px);
      padding: 20px;
      display: flex;
      flex-direction: column;
    }
    
    .success-icon {
      width: 80px;
      height: 80px;
      background-color: #4CAF50;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 30px auto;
    }
    
    .success-title {
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    
    .success-subtitle {
      text-align: center;
      font-size: 14px;
      color: #666;
      margin-bottom: 30px;
    }
    
    .order-details {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
      font-size: 14px;
    }
    
    .payment-info {
      margin-top: 16px;
      margin-bottom: 16px;
      padding-bottom: 16px;
      border-bottom: 1px solid #eee;
    }
    
    .detail-title {
      font-weight: bold;
      margin: 16px 0 8px 0;
    }
    
    .item-details {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
      font-size: 14px;
    }
    
    .shipping-info-box {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 16px;
      margin: 16px 0;
    }
    
    .shipping-title {
      font-weight: bold;
      margin-bottom: 12px;
    }
    
    .shipping-detail {
      margin-bottom: 8px;
      font-size: 14px;
    }
    
    .home-button {
      background-color: #5c6bc0;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      margin-top: auto;
      cursor: pointer;
      width: 100%;
    }
    
    .price {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="header">
    Catering Kita
  </div>
  
  <div class="container">
    <div class="success-icon">
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
    </div>
    
    <h1 class="success-title">Pembayaran Berhasil!!!</h1>
    <p class="success-subtitle">Terima kasih telah memesan. Pesanan Anda sedang diproses.</p>
    
    <div class="payment-info">
      <div class="order-details">
        <span>Order ID</span>
        <span>ORD21356-89</span>
      </div>
      <div class="order-details">
        <span>Tanggal Pemesanan</span>
        <span>16 Januari 2025</span>
      </div>
      <div class="order-details">
        <span>Total Pembayaran</span>
        <span class="price">Rp 1.535.000</span>
      </div>
      <div class="order-details">
        <span>Metode Pembayaran</span>
        <span>Bank Central Asia (BCA)</span>
      </div>
    </div>
    
    <div class="detail-section">
      <h3 class="detail-title">Detail Pesanan</h3>
      
      <div class="item-details">
        <div>
          <div>Paket Nasi Kotak Premium</div>
          <div style="color: #666; font-size: 12px;">125 x Rp 45.000</div>
        </div>
        <span class="price">Rp 875.000</span>
      </div>
      
      <div class="item-details">
        <div>
          <div>Snack Box Meetings</div>
          <div style="color: #666; font-size: 12px;">50 x Rp 15.000</div>
        </div>
        <span class="price">Rp 750.000</span>
      </div>
    </div>
    
    <div class="shipping-info-box">
      <h3 class="shipping-title">Informasi Pengiriman</h3>
      
      <div class="shipping-detail">
        <strong>Tanggal Pengiriman</strong>
        <div>20 Januari 2025</div>
      </div>
      
      <div class="shipping-detail">
        <strong>Waktu Pengiriman</strong>
        <div>10:00 - 11:00</div>
      </div>
      
      <div class="shipping-detail">
        <strong>Alamat Pengiriman</strong>
        <div>Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220</div>
      </div>
    </div>
    
    <button class="home-button">Kembali Home</button>
  </div>
</body>
</html>