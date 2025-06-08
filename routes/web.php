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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Public search
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/api/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');

// File serving
Route::get('/uploads/makanan/{filename}', function ($filename) {
    $path = public_path('uploads/makanan/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');

/*
|--------------------------------------------------------------------------
| Authentication Required Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | User Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Main Navigation Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/catering', [CateringController::class, 'index'])->name('catering.index');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

    /*
    |--------------------------------------------------------------------------
    | Menu Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('menu')->group(function () {
        // Prasmanan Menu
        Route::get('/prasmanan', [MenuPrasmananController::class, 'index'])->name('menuprasmanan.index');
        Route::get('/prasmanan/{id}', [MenuPrasmananController::class, 'show'])->name('menuprasmanan.show');
        
        // Nasi Box Menu
        Route::get('/nasibox', [MenuNasiBoxController::class, 'index'])->name('menunasibox.index');
        Route::get('/nasibox/{id}', [MenuNasiBoxController::class, 'show'])->name('menunasibox.show');
    });

    /*
    |--------------------------------------------------------------------------
    | Shopping Cart Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('keranjang')->name('keranjang.')->group(function () {
        Route::get('/', [KeranjangController::class, 'index'])->name('index');
        Route::post('/add', [KeranjangController::class, 'addToCart'])->name('add');
        Route::patch('/{id}', [KeranjangController::class, 'updateQuantity'])->name('update');
        Route::delete('/delete/{id}', [KeranjangController::class, 'removeItem'])->name('delete');
        // Route::delete('/keranjang/delete/{id}', [KeranjangController::class, 'removeItem'])->name('keranjang.delete');
        Route::get('/count', [KeranjangController::class, 'getCartCount'])->name('count');
    });

    /*
    |--------------------------------------------------------------------------
    | Checkout & Order Routes - FIXED
    |--------------------------------------------------------------------------
    */
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckOutController::class, 'index'])->name('index');
        Route::post('/store', [CheckOutController::class, 'store'])->name('store'); // Pastikan ada
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::post('/cancel', [OrderController::class, 'cancel'])->name('cancel');
        Route::post('/buat-pesanan', [OrderController::class, 'createOrder'])->name('create');
    });

    /*
    |--------------------------------------------------------------------------
    | User Orders (Pesanan) Routes - FIXED & CLEAN
    |--------------------------------------------------------------------------
    */
    Route::prefix('pesanan')->name('pesanan.')->group(function () {
        Route::get('/', [PesananController::class, 'index'])->name('index');           // Semua Pesanan
        Route::get('/unpaid', [PesananController::class, 'index'])->name('unpaid');    // Belum Bayar
        Route::get('/process', [PesananController::class, 'index'])->name('process');  // Diproses
        Route::get('/shipped', [PesananController::class, 'index'])->name('shipped'); // Dikirim
        Route::get('/completed', [PesananController::class, 'index'])->name('completed'); // Selesai
        Route::get('/penilaian', [PesananController::class, 'index'])->name('penilaian'); // Penilaian
        
        // Debug route
        Route::get('/debug', [PesananController::class, 'debug'])->name('debug');
        
        // Order management - PERBAIKI NAMA ROUTE INI
        Route::post('/', [PesananController::class, 'store'])->name('store');
        Route::post('/accept/{id}', [PesananController::class, 'acceptOrder'])->name('accept'); // UBAH dari pesanan.accept ke accept
    });

    /*
    |--------------------------------------------------------------------------
    | Payment Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('payment')->name('payment.')->group(function () {
        // Payment methods - FIXED
        Route::get('/metodepembayaran/{method}', [PaymentController::class, 'show'])
            ->name('show')
            ->where('method', 'bca|dana|gopay|cod');
        
        Route::get('/metodepembayaran/bca', [PaymentController::class, 'bca'])->name('bca');
        Route::get('/metodepembayaran/dana', [PaymentController::class, 'dana'])->name('dana');
        Route::get('/metodepembayaran/gopay', [PaymentController::class, 'gopay'])->name('gopay');
        Route::get('/metodepembayaran/cod', [PaymentController::class, 'cod'])->name('cod');
        
        // Payment processing
        Route::post('/process', [PaymentController::class, 'process'])->name('process');
        Route::post('/confirm', [PaymentController::class, 'confirmPayment'])->name('confirm');
        Route::post('/create', [PaymentController::class, 'store'])->name('store');
        
        // Payment confirmations
        Route::post('/bca/confirm', [PaymentController::class, 'confirmBcaPayment'])->name('bca.confirm');
        Route::post('/dana/confirm', [PaymentController::class, 'confirmDanaPayment'])->name('dana.confirm');
        Route::post('/gopay/confirm', [PaymentController::class, 'confirmGopayPayment'])->name('gopay.confirm');
        Route::post('/cod/confirm', [PaymentController::class, 'confirmCodPayment'])->name('cod.confirm');
        
        // Success pages
        Route::get('/bca/success', function () {
            return view('payments.bca_success');
        })->name('bca.success');
        Route::get('/dana/success', function () {
            return view('payments.dana_success');
        })->name('dana.success');
        Route::get('/gopay/success', function () {
            return view('payments.gopay_success');
        })->name('gopay.success');
        Route::get('/cod/success', function() {
            return view('payments.cod_success');
        })->name('cod.success');
        Route::get('/success', function () {
            return view('payments.success');
        })->name('success');
        
        // Payment details by order
        Route::get('/{orderId}', [PaymentController::class, 'show'])->name('show.order');
        Route::get('/{orderId}/bca', [PaymentController::class, 'showBca'])->name('bca.show');
        Route::get('/{orderId}/dana', [PaymentController::class, 'showDana'])->name('dana.show');
        Route::get('/{orderId}/gopay', [PaymentController::class, 'showGopay'])->name('gopay.show');
        Route::get('/{orderId}/cod', [PaymentController::class, 'showCod'])->name('cod.show');
        Route::get('/{orderId}/process', [PaymentController::class, 'process'])->name('process.order');
        Route::get('/{orderId}/result', [PaymentController::class, 'result'])->name('result');
        
        // Confirmation pages
        Route::get('/confirmation/{orderId}', [PaymentController::class, 'showConfirmation'])->name('confirmation');
        Route::get('/konfirmasi-pembayaran/{orderId}', [PaymentController::class, 'showConfirmation'])->name('confirmation.alt');
        Route::get('/konfirmasi-pembayaran/{method}/{orderId}', [PaymentController::class, 'showConfirmation'])->name('confirmation.method');
        
        // Order confirmation
        Route::post('/{orderId}/confirm', [PaymentController::class, 'confirm'])->name('confirm.order');
    });

    /*
    |--------------------------------------------------------------------------
    | Notification Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/count', [NotificationController::class, 'getUnreadCount'])->name('count');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('markAsRead');
    });

    /*
    |--------------------------------------------------------------------------
    | Form Routes (Legacy - can be cleaned up later)
    |--------------------------------------------------------------------------
    */
    Route::get('/formulirpesanan', [FormulirPesananController::class, 'index'])->name('formulirpesanan.index');
    Route::get('/detailacara', [DetailAcaraController::class, 'index'])->name('detailacara.index');
    Route::get('/konfirmasipesanan', [KonfirmasiPesananController::class, 'index'])->name('konfirmasipesanan.index');
    Route::get('/metodepembayaranuser', [MetodePembayaranUserController::class, 'index'])->name('metodepembayaranuser.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes - FIXED ROUTING CONFLICT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::put('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    /*
    |--------------------------------------------------------------------------
    | Product Management
    |--------------------------------------------------------------------------
    */
    Route::resource('kelolamakanan', AdminKelolaMakananController::class);
    Route::resource('stokbahan', AdminStokBahanController::class);
    Route::get('stokbahan/search', [AdminStokBahanController::class, 'index'])->name('stokbahan.search');

    /*
    |--------------------------------------------------------------------------
    | Order Management - FIXED ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('daftarpesanan')->name('daftarpesanan.')->group(function () {
        Route::get('/', [AdminDaftarPesananController::class, 'index'])->name('index');
        Route::get('/create', [AdminDaftarPesananController::class, 'create'])->name('create');
        Route::post('/', [AdminDaftarPesananController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminDaftarPesananController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminDaftarPesananController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminDaftarPesananController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminDaftarPesananController::class, 'destroy'])->name('destroy');
        
        // Status update route - separate from resource routes to avoid conflicts
        Route::post('/{id}/update-status', [AdminDaftarPesananController::class, 'updateStatus'])->name('updateStatus');
    });

    /*
    |--------------------------------------------------------------------------
    | Financial Management
    |--------------------------------------------------------------------------
    */
    Route::resource('transaksi', AdminTransaksiController::class);
    Route::resource('laporan', AdminLaporanController::class);
    Route::get('laporan/export', [AdminLaporanController::class, 'export'])->name('laporan.export');

    /*
    |--------------------------------------------------------------------------
    | System Configuration
    |--------------------------------------------------------------------------
    */
    Route::resource('metodepembayaran', AdminMetodePembayaran::class);
    Route::resource('statuspembayaran', AdminStatusPembayaranController::class);
    Route::resource('statuspengiriman', AdminStatusPengirimanController::class);
    Route::resource('kategori', KategoriController::class);

    /*
    |--------------------------------------------------------------------------
    | Content Management
    |--------------------------------------------------------------------------
    */
    Route::resource('penilaian', AdminPenilaianController::class);
    Route::resource('tentangkami', TentangKamiController::class);
    Route::resource('karyawan', KaryawanController::class);

    /*
    |--------------------------------------------------------------------------
    | Admin Notifications
    |--------------------------------------------------------------------------
    */
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationAdminController::class, 'index'])->name('index');
        Route::post('/{notification}/mark-read', [NotificationAdminController::class, 'markAsRead'])->name('markAsRead');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Profile
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AdminProfileController::class, 'show'])->name('show');
        Route::get('/edit', [AdminProfileController::class, 'edit'])->name('edit');
        Route::put('/', [AdminProfileController::class, 'update'])->name('update');
    });

    // Penilaian routes
    Route::prefix('penilaian')->name('penilaian.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminPenilaianController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Admin\AdminPenilaianController::class, 'show'])->name('show');
        Route::delete('/{id}', [App\Http\Controllers\Admin\AdminPenilaianController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/update-status', [App\Http\Controllers\Admin\AdminPenilaianController::class, 'updateStatus'])->name('update-status');
        Route::post('/{id}/toggle-status', [App\Http\Controllers\Admin\AdminPenilaianController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{id}/verify', [App\Http\Controllers\Admin\AdminPenilaianController::class, 'verify'])->name('verify');
    });
});

// Admin Profile Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Review routes
Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{orderId}', [App\Http\Controllers\ReviewController::class, 'show'])->name('reviews.show');
});

// Tambahkan routes untuk notifications
Route::middleware(['auth'])->group(function () {
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/api', [NotificationController::class, 'getNotifications'])->name('notifications.api');
    Route::get('/notifications/count', [NotificationController::class, 'getUnreadCount'])->name('notifications.count');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');
    Route::post('/notifications/delete-multiple', [NotificationController::class, 'deleteMultiple'])->name('notifications.deleteMultiple');
    
    // Route untuk user cancel order
    Route::post('/pesanan/cancel/{id}', [PesananController::class, 'cancelOrder'])
         ->name('pesanan.cancel');
});

// Admin Notification Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ...existing admin routes...
    
    // Admin Notifications
    Route::get('/notifications', [\App\Http\Controllers\Admin\NotificationAdminController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/api', [\App\Http\Controllers\Admin\NotificationAdminController::class, 'api'])->name('notifications.api');
    Route::get('/notifications/count', [\App\Http\Controllers\Admin\NotificationAdminController::class, 'getUnreadCount'])->name('notifications.count');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\Admin\NotificationAdminController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::post('/notifications/delete-multiple', [\App\Http\Controllers\Admin\NotificationAdminController::class, 'deleteMultiple'])->name('notifications.deleteMultiple');
    Route::post('/notifications/{id}/mark-as-read', [\App\Http\Controllers\Admin\NotificationAdminController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::delete('/notifications/{id}', [\App\Http\Controllers\Admin\NotificationAdminController::class, 'delete'])->name('notifications.delete');
});

// Admin DaftarPesanan routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ...existing admin routes...
    
    Route::get('/daftarpesanan', [AdminDaftarPesananController::class, 'index'])->name('daftarpesanan.index');
    Route::get('/daftarpesanan/create', [AdminDaftarPesananController::class, 'create'])->name('daftarpesanan.create');
    Route::post('/daftarpesanan', [AdminDaftarPesananController::class, 'store'])->name('daftarpesanan.store');
    Route::get('/daftarpesanan/{id}/edit', [AdminDaftarPesananController::class, 'edit'])->name('daftarpesanan.edit');
    Route::put('/daftarpesanan/{id}', [AdminDaftarPesananController::class, 'update'])->name('daftarpesanan.update');
    Route::delete('/daftarpesanan/{id}', [AdminDaftarPesananController::class, 'destroy'])->name('daftarpesanan.destroy');
    
    // ✅ ROUTE UNTUK UPDATE STATUS ✅
    Route::post('/daftarpesanan/{id}/update-status', [AdminDaftarPesananController::class, 'updateStatus'])->name('daftarpesanan.updateStatus');
});