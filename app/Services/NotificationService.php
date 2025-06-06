<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\DaftarPesanan;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Create notification for new order
     */
    public static function createOrderNotification($orderId, $userId)
    {
        try {
            $order = DaftarPesanan::find($orderId);
            if (!$order) return false;

            return Notification::create([
                'user_id' => $userId,
                'title' => 'Pesanan baru',
                'message' => "Pesanan #{$order->order_id} sedang dalam Proses",
                'type' => 'order',
                'icon_type' => 'box',
                'order_id' => $orderId,
                'is_read' => false
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create order notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create notification for order status change
     */
    public static function createStatusChangeNotification($orderId, $userId, $oldStatus, $newStatus)
    {
        try {
            $order = DaftarPesanan::find($orderId);
            if (!$order) return false;

            $notifications = [
                'dikirim' => [
                    'title' => 'Pesanan Telah Dikirim',
                    'message' => "Pesanan #{$order->order_id} sedang dalam perjalanan dan akan tiba dalam waktu 30 menit.",
                    'icon_type' => 'truck'
                ],
                'diterima' => [
                    'title' => 'Beri Rating untuk Pesanan Sebelumnya',
                    'message' => "Bagaimana pengalaman Anda dengan pesanan #{$order->order_id}? Beri rating dan ulasan untuk membantu kami meningkatkan layanan.",
                    'icon_type' => 'star'
                ]
            ];

            if (!isset($notifications[$newStatus])) return false;

            $notificationData = $notifications[$newStatus];

            return Notification::create([
                'user_id' => $userId,
                'title' => $notificationData['title'],
                'message' => $notificationData['message'],
                'type' => 'delivery',
                'icon_type' => $notificationData['icon_type'],
                'order_id' => $orderId,
                'is_read' => false
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create status change notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create notification for payment confirmation
     */
    public static function createPaymentNotification($orderId, $userId)
    {
        try {
            $order = DaftarPesanan::find($orderId);
            if (!$order) return false;

            return Notification::create([
                'user_id' => $userId,
                'title' => 'Pembayaran Berhasil',
                'message' => "Pembayaran untuk pesanan #{$order->order_id} telah dikonfirmasi",
                'type' => 'payment',
                'icon_type' => 'credit-card',
                'order_id' => $orderId,
                'is_read' => false
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create payment notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get unread notifications count for user
     */
    public static function getUnreadCount($userId)
    {
        return Notification::where('user_id', $userId)
                          ->where('is_read', false)
                          ->count();
    }

    /**
     * Get all notifications for user
     */
    public static function getUserNotifications($userId, $limit = 20)
    {
        return Notification::where('user_id', $userId)
                          ->orderBy('created_at', 'desc')
                          ->limit($limit)
                          ->get();
    }

    /**
     * Mark notification as read
     */
    public static function markAsRead($notificationId, $userId)
    {
        return Notification::where('id', $notificationId)
                          ->where('user_id', $userId)
                          ->update([
                              'is_read' => true,
                              'read_at' => now()
                          ]);
    }

    /**
     * Mark all notifications as read for user
     */
    public static function markAllAsRead($userId)
    {
        return Notification::where('user_id', $userId)
                          ->where('is_read', false)
                          ->update([
                              'is_read' => true,
                              'read_at' => now()
                          ]);
    }

    /**
     * Delete notification
     */
    public static function deleteNotification($notificationId, $userId)
    {
        return Notification::where('id', $notificationId)
                          ->where('user_id', $userId)
                          ->delete();
    }

    /**
     * Delete multiple notifications
     */
    public static function deleteMultiple($notificationIds, $userId)
    {
        return Notification::where('user_id', $userId)
                          ->whereIn('id', $notificationIds)
                          ->delete();
    }
}
