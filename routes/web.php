<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CateringController;
use App\Http\Controllers\KelolaMakananController;
use App\Http\Controllers\StokBahanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DaftarPesananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuPrasmananController;
use App\Http\Controllers\MenuNasiBoxController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\FormulirPesananController;
use App\Http\Controllers\DetailAcaraController;
use App\Http\Controllers\KonfirmasiPesananController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\MetodePembayaranUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminStokBahanController;
use App\Http\Controllers\Admin\AdminKelolaMakananController;
use App\Http\Controllers\Admin\AdminDaftarPesananController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminMetodePembayaran;
use App\Http\Controllers\Admin\AdminStatusPembayaranController;
use App\Http\Controllers\Admin\AdminStatusPengirimanController;
use App\Http\Controllers\Admin\AdminPenilaianController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/admin/dashboard', [AdminTransaksiController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/catering', [CateringController::class, 'index'])->name('catering.index');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/menuprasmanan', [MenuPrasmananController::class, 'index'])->name('menuprasmanan.index');
    Route::get('/menunasibox', [MenuNasiBoxController::class, 'index'])->name('menunasibox.index');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::get('/formulirpesanan', [FormulirPesananController::class, 'index'])->name('formulirpesanan.index');
    Route::get('/detailacara', [DetailAcaraController::class, 'index'])->name('detailacara.index');
    Route::get('/konfirmasipesanan', [KonfirmasiPesananController::class, 'index'])->name('konfirmasipesanan.index');
    Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout.index');
    Route::get('/metodepembayaranuser', [MetodePembayaranUserController::class, 'index'])->name('metodepembayaranuser.index');
    Route::get('/payment/{order_id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
    Route::get('/search', [MenuController::class, 'search'])->name('search');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/metodepembayaran/bca', [PaymentController::class, 'bca'])->name('payment.bca');
    Route::get('/metodepembayaran/dana', [PaymentController::class, 'dana'])->name('payment.dana');
    Route::get('/metodepembayaran/gopay', [PaymentController::class, 'gopay'])->name('payment.gopay');
    Route::get('/metodepembayaran/cod', [PaymentController::class, 'cod'])->name('payment.cod');
});

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::prefix('admin')->name('admin.')->group(function () {
        // Kelola Makanan
        Route::resource('kelolamakanan', AdminKelolaMakananController::class);

        // Stok Bahan
        Route::resource('stokbahan', AdminStokBahanController::class);
        Route::get('stokbahan/search', [AdminStokBahanController::class, 'index'])->name('stokbahan.search');

        // Daftar Pesanan
        Route::resource('daftarpesanan', AdminDaftarPesananController::class);

        // Laporan
        Route::resource('laporan', AdminLaporanController::class);

        // Transaksi
        Route::resource('transaksi', AdminTransaksiController::class);

        // Metode Pembayaran
        Route::resource('metodepembayaran', AdminMetodePembayaran::class);
        
        // Metode Pembayaran
        Route::resource('statuspembayaran', AdminStatusPembayaranController::class);

        // Status Pengiriman
        Route::resource('statuspengiriman', AdminStatusPengirimanController::class);

        // Penilaian
        Route::resource('penilaian', AdminPenilaianController::class);

    });
});

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// Order routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

Route::middleware(['auth'])->group(function () {
    // Halaman pembayaran
    Route::get('/payment/{orderId}', [PaymentController::class, 'show'])->name('payment.show');
    
    // Proses pembayaran
    Route::post('/payment/{orderId}/process', [PaymentController::class, 'process'])->name('payment.process');
    
    // Halaman hasil pembayaran
    Route::get('/payment/{orderId}/result', [PaymentController::class, 'result'])->name('payment.result');
});

require __DIR__.'/auth.php';
