<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('payment.payment', compact('order'));
    }
    
    public function process(Request $request, $orderId)
    {
        // Validasi input
        $validated = $request->validate([
            'payment_method' => 'required|string',
        ]);
        
        // Ambil data order
        $order = Order::findOrFail($orderId);
        
        // Proses pembayaran berdasarkan metode yang dipilih
        $paymentMethod = $validated['payment_method'];
        
        // Logika untuk memproses masing-masing metode pembayaran
        switch ($paymentMethod) {
            case 'bca_va':
                // Integrasi dengan BCA VA
                $result = $this->processBcaVirtualAccount($order);
                break;
            case 'dana':
                // Integrasi dengan Dana
                $result = $this->processDana($order);
                break;
            case 'gopay':
                // Integrasi dengan Gopay
                $result = $this->processGopay($order);
                break;
            case 'cod':
                // Proses COD
                $result = $this->processCod($order);
                break;
            default:
                return back()->with('error', 'Metode pembayaran tidak valid');
        }
        
        // Redirect ke halaman hasil pembayaran
        return redirect()->route('payment.result', ['orderId' => $orderId]);
    }
    
    private function processBcaVirtualAccount($order)
    {
        // Implementasi integrasi dengan BCA Virtual Account
        // Misalnya menggunakan middleware seperti Midtrans, Xendit, dll.
        
        // Contoh kode saja, sesuaikan dengan layanan yang digunakan
        $vaNumber = '12345678901234';
        $expiryTime = now()->addHours(2);
        
        // Update status order
        $order->update([
            'payment_method' => 'bca_va',
            'va_number' => $vaNumber,
            'payment_expiry' => $expiryTime,
            'status' => 'pending_payment'
        ]);
        
        return [
            'success' => true,
            'va_number' => $vaNumber,
            'expiry_time' => $expiryTime
        ];
    }
    
    private function processDana($order)
    {
        // Implementasi integrasi dengan Dana
        // ...
    }
    
    private function processGopay($order)
    {
        // Implementasi integrasi dengan Gopay
        // ...
    }
    
    private function processCod($order)
    {
        // Implementasi untuk COD
        $order->update([
            'payment_method' => 'cod',
            'status' => 'waiting_confirmation'
        ]);
        
        return [
            'success' => true
        ];
    }

    public function bca()
    {
        return view('payments.bca');
    }

    public function dana()
    {
        return view('payments.dana');
    }

    public function gopay()
    {
        return view('payments.gopay');
    }

    public function cod()
    {
        return view('payments.cod');
    }
}