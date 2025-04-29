<?php

use App\Http\Controllers\MenuPrasmananController;
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
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AdminStokBahanController;
use App\Http\Controllers\Admin\AdminKelolaMakananController;
use App\Http\Controllers\Admin\AdminDaftarPesananController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminMetodePembayaran;
use App\Http\Controllers\Admin\AdminStatusPembayaranController;
use App\Http\Controllers\Admin\AdminStatusPengirimanController;
use App\Http\Controllers\Admin\AdminPenilaianController;
use App\Http\Controllers\Admin\TentangKamiController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\NotificationAdminController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\SearchController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


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
    Route::get('/menuprasmanan/{id}', [MenuPrasmananController::class, 'show'])->name('menuprasmanan.show');
    Route::get('/menunasibox', [MenuNasiBoxController::class, 'index'])->name('menunasibox.index');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::get('/formulirpesanan', [FormulirPesananController::class, 'index'])->name('formulirpesanan.index');
    Route::get('/detailacara', [DetailAcaraController::class, 'index'])->name('detailacara.index');
    Route::get('/konfirmasipesanan', [KonfirmasiPesananController::class, 'index'])->name('konfirmasipesanan.index');
    Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout.index');
    Route::get('/metodepembayaranuser', [MetodePembayaranUserController::class, 'index'])->name('metodepembayaranuser.index');
    Route::get('/payment/{order_id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/metodepembayaran/bca', [PaymentController::class, 'bca'])->name('payment.bca');
    Route::get('/metodepembayaran/dana', [PaymentController::class, 'dana'])->name('payment.dana');
    Route::get('/metodepembayaran/gopay', [PaymentController::class, 'gopay'])->name('payment.gopay');
    Route::get('/metodepembayaran/cod', [PaymentController::class, 'cod'])->name('payment.cod');
    Route::post('/buat-pesanan', [OrderController::class, 'createOrder'])->name('order.create');
    Route::get('/payment/dana/success', function () {
        return view('payments.dana_success');
    })->name('payment.dana.success');
    Route::get('/payment/bca/success', function () {
        return view('payments.bca_success');
    })->name('payment.bca.success');
    Route::get('/payment/gopay/success', function () {
        return view('payments.gopay_success');
    })->name('payment.gopay.success');
    Route::get('/payment/cod/success', function() {
        return view('payments.cod_success');
    })->name('payment.cod.success');
Route::post('/payment/bca/confirm', [PaymentController::class, 'confirmBcaPayment'])
    ->name('payment.bca.confirm')
    ->middleware('auth');
    Route::post('/payment/dana/confirm', [PaymentController::class, 'confirmDanaPayment'])->name('payment.dana.confirm');
    Route::post('/payment/gopay/confirm', [PaymentController::class, 'confirmGopayPayment'])->name('payment.gopay.confirm');
Route::post('/payment/cod/confirm', [PaymentController::class, 'confirmCodPayment'])->name('payment.cod.confirm');
    Route::get('/metodepembayaran/{method}', [PaymentController::class, 'show'])->name('payment.show');
    Route::prefix('pesanan')->group(function () {
        Route::get('/', [PesananController::class, 'index'])->name('pesanan.index'); // Semua Pesanan
        Route::get('/process', [PesananController::class, 'process'])->name('pesanan.process'); // Diproses
        Route::get('/shipped', [PesananController::class, 'shipped'])->name('pesanan.shipped'); // Dikirim
        Route::get('/completed', [PesananController::class, 'completed'])->name('pesanan.completed'); // Selesai
        Route::get('/penilaian', [PesananController::class, 'penilaian'])->name('pesanan.penilaian'); // Penilaian
         Route::get('/unpaid', [PesananController::class, 'unpaid'])->name('pesanan.unpaid'); // Belum Bayar

        });

        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::post('/orders/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

        // Keranjang routes
        Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
        Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('keranjang.add');
        Route::patch('/keranjang/update/{id}', [KeranjangController::class, 'updateQuantity'])->name('keranjang.update');
        Route::delete('/keranjang/delete/{id}', [KeranjangController::class, 'removeItem'])->name('keranjang.remove');
        Route::get('/keranjang/count', [KeranjangController::class, 'getCartCount'])->name('keranjang.count');
        Route::get('/menunasibox/{id}', [MenuNasiBoxController::class, 'show'])->name('menunasibox.show');
        Route::get('/pembayaran/{method}/{orderId}', [PaymentController::class, 'show'])->name('payment.show');
    });

Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('keranjang.add');
    Route::patch('/keranjang/{id}', [KeranjangController::class, 'updateQuantity'])->name('keranjang.update');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'removeItem'])->name('keranjang.remove');
    Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('keranjang.add');
    Route::get('/keranjang/count', [KeranjangController::class, 'getCartCount'])->name('keranjang.count');
    Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/store', [CheckOutController::class, 'store'])->name('checkout.store');
    Route::delete('/keranjang/remove/{id}', [KeranjangController::class, 'removeItem'])->name('keranjang.remove');
    Route::patch('/keranjang/{id}', [KeranjangController::class, 'updateQuantity'])->name('keranjang.update');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/{orderId}/bca', [PaymentController::class, 'showBca'])->name('payment.bca');
    Route::get('/payment/bca/{orderId}', [PaymentController::class, 'showBca'])->name('payment.bca.show');
    Route::get('/payment/{orderId}/dana', [PaymentController::class, 'showDana'])->name('payment.dana');
    Route::get('/payment/{orderId}/gopay', [PaymentController::class, 'showGopay'])->name('payment.gopay');
    Route::get('/payment/{orderId}/cod', [PaymentController::class, 'showCod'])->name('payment.cod');
    Route::get('/payment/confirmation/{orderId}', [PaymentController::class, 'showConfirmation'])->name('payment.confirmation');
    Route::get('/konfirmasi-pembayaran/{orderId}', [PaymentController::class, 'showConfirmation'])->name('payment.confirmation');
    Route::get('/konfirmasi-pembayaran/{method}/{orderId}', [PaymentController::class, 'showConfirmation'])->name('payment.confirmation');
    Route::post('/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{orderId}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
    Route::post('/payment/create', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/success', function () {
        return view('payments.success');
    })->name('payment.success');
    Route::middleware(['auth'])->group(function () {
        Route::prefix('pesanan')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('pesanan.index');
            Route::get('/pending', [OrderController::class, 'pending'])->name('pesanan.pending');
            Route::get('/processing', [OrderController::class, 'processing'])->name('pesanan.processing');
            Route::get('/shipped', [OrderController::class, 'shipped'])->name('pesanan.shipped');
            Route::get('/completed', [OrderController::class, 'completed'])->name('pesanan.completed');
            Route::get('/reviews', [OrderController::class, 'reviews'])->name('pesanan.reviews');
            Route::get('/{id}', [OrderController::class, 'show'])->name('pesanan.show');
            Route::post('/{id}/review', [OrderController::class, 'submitReview'])->name('pesanan.submit-review');
            Route::get('/pesanan/shipped', function () {
                return view('pesanan.dikirim');
            })->name('pesanan.shipped');
        });
    });
});

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Kelola Makanan
    Route::resource('kelolamakanan', AdminKelolaMakananController::class);

    // Stok Bahan
    Route::resource('stokbahan', AdminStokBahanController::class);
    Route::get('stokbahan/search', [AdminStokBahanController::class, 'index'])->name('stokbahan.search');

    // Daftar Pesanan
    Route::resource('/daftarpesanan', AdminDaftarPesananController::class);
    Route::post('/daftarpesanan/{id}/status', [AdminDaftarPesananController::class, 'updateStatus'])->name('daftarpesanan.updateStatus');

    // Laporan routes
    Route::get('laporan/export', [AdminLaporanController::class, 'export'])->name('laporan.export');
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

    // Tentang Kami routes
    Route::resource('tentangkami', TentangKamiController::class);

    // Daftar Karyawan
    Route::resource('karyawan', KaryawanController::class);

    // Laporan
     Route::resource('laporan', AdminLaporanController::class);
    // Notification
    

    // Profile Admin
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
});

// Notifications
Route::get('/notifications', [NotificationAdminController::class, 'index'])->name('admin.notifications.index');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('kategori', KategoriController::class);
});


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckOutController::class, 'process'])->name('checkout.process');

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

Route::get('/search', [SearchController::class, 'search'])->name('search');

require __DIR__.'/auth.php';