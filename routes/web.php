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
use App\Http\Controllers\Admin\AdminStokBahanController;
use App\Http\Controllers\Admin\AdminKelolaMakananController;
use App\Http\Controllers\Admin\AdminDaftarPesananController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminMetodePembayaran;
use App\Http\Controllers\Admin\AdminStatusPembayaranController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
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

    });
});

require __DIR__.'/auth.php';
