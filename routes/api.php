<?php
// routes/api.php
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
});

// If you're not using authentication yet, use this instead:
// Route::post('/orders', [OrderController::class, 'store']);