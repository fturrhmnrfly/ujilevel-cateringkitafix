<?php

namespace App\Services;

use App\Models\NotificationAdmin;
use App\Models\DaftarPesanan;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Log;

class AdminNotificationService
{
    /**
     * Create notification for new order (when user creates order)
     */
    public static function createNewOrderNotification($orderId)
    {
        try {
            $order = DaftarPesanan::find($orderId);
            if (!$order) return false;

            // Get all admin users
            $adminUsers = User::where('usertype', 'admin')->get();

            foreach ($adminUsers as $admin) {
                NotificationAdmin::create([
                    'admin_id' => $admin->id,
                    'title' => 'Pesanan Baru Masuk',
                    'message' => "Pesanan baru #{$order->order_id} dari {$order->nama_pelanggan} senilai Rp " . number_format($order->total_harga, 0, ',', '.'),
                    'type' => 'new_order',
                    'icon_type' => 'box',
                    'order_id' => $orderId,
                    'is_read' => false
                ]);
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to create new order admin notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create notification when order is completed (diterima)
     */
    public static function createOrderCompletedNotification($orderId)
    {
        try {
            $order = DaftarPesanan::find($orderId);
            if (!$order) return false;

            // Get all admin users
            $adminUsers = User::where('usertype', 'admin')->get();

            foreach ($adminUsers as $admin) {
                NotificationAdmin::create([
                    'admin_id' => $admin->id,
                    'title' => 'Pesanan Telah Diterima',
                    'message' => "Pesanan #{$order->order_id} telah diterima oleh {$order->nama_pelanggan}. Transaksi selesai.",
                    'type' => 'order_completed',
                    'icon_type' => 'truck',
                    'order_id' => $orderId,
                    'is_read' => false
                ]);
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to create order completed admin notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create notification when user submits review
     */
    public static function createNewReviewNotification($reviewId)
    {
        try {
            $review = Review::with(['user', 'order'])->find($reviewId);
            if (!$review) return false;

            // Get all admin users
            $adminUsers = User::where('usertype', 'admin')->get();

            foreach ($adminUsers as $admin) {
                NotificationAdmin::create([
                    'admin_id' => $admin->id,
                    'title' => 'Ulasan Baru',
                    'message' => "Ulasan baru dari {$review->user->name} untuk pesanan #{$review->order->order_id} dengan rating {$review->average_rating}/5",
                    'type' => 'new_review',
                    'icon_type' => 'star',
                    'order_id' => $review->order_id,
                    'is_read' => false
                ]);
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to create new review admin notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get unread count for admin
     */
    public static function getUnreadCount($adminId)
    {
        try {
            return NotificationAdmin::where('admin_id', $adminId)
                ->where('is_read', false)
                ->count();
        } catch (\Exception $e) {
            Log::error('Failed to get admin notification count: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Mark notification as read
     */
    public static function markAsRead($notificationId, $adminId)
    {
        try {
            $notification = NotificationAdmin::where('id', $notificationId)
                ->where('admin_id', $adminId)
                ->first();

            if (!$notification) return false;

            return $notification->update(['is_read' => true]);
        } catch (\Exception $e) {
            Log::error('Failed to mark admin notification as read: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Mark all notifications as read for admin
     */
    public static function markAllAsRead($adminId)
    {
        try {
            return NotificationAdmin::where('admin_id', $adminId)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        } catch (\Exception $e) {
            Log::error('Failed to mark all admin notifications as read: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Delete notification
     */
    public static function deleteNotification($notificationId, $adminId)
    {
        try {
            $notification = NotificationAdmin::where('id', $notificationId)
                ->where('admin_id', $adminId)
                ->first();

            if (!$notification) return false;

            return $notification->delete();
        } catch (\Exception $e) {
            Log::error('Failed to delete admin notification: ' . $e->getMessage());
            return false;
        }
    }
}