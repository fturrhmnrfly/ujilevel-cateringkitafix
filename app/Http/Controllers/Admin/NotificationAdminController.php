<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationAdminController extends Controller
{
    public function index()
    {
        // ✅ GUNAKAN SCOPE forAdmin ✅
        $notifications = NotificationAdmin::forAdmin(Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Get notifications for API (for modal)
     */
    public function api()
    {
        try {
            Log::info('Admin notifications API called', ['admin_id' => Auth::id()]);
            
            // ✅ GUNAKAN SCOPE forAdmin DAN FILTER YANG BENAR ✅
            $notifications = NotificationAdmin::forAdmin(Auth::id())
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();
                
            Log::info('Admin notifications found', [
                'admin_id' => Auth::id(),
                'count' => $notifications->count(),
                'sample_notifications' => $notifications->take(3)->toArray()
            ]);
            
            return response()->json([
                'success' => true,
                'notifications' => $notifications
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching admin notifications', [
                'admin_id' => Auth::id(),
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'notifications' => []
            ], 500);
        }
    }

    /**
     * Get unread count
     */
    public function getUnreadCount() 
    {
        try {
            // ✅ GUNAKAN SCOPE forAdmin ✅
            $count = NotificationAdmin::forAdmin(Auth::id())
                ->where('is_read', false)
                ->count();
                
            Log::info('Admin notification count', [
                'admin_id' => Auth::id(),
                'unread_count' => $count
            ]);
                
            return response()->json([
                'success' => true,
                'count' => $count
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting admin notification count', [
                'admin_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'count' => 0
            ], 500);
        }
    }

    public function markAsRead($id)
    {
        try {
            // ✅ GUNAKAN SCOPE forAdmin ✅
            $notification = NotificationAdmin::forAdmin(Auth::id())
                ->where('id', $id)
                ->first();
                
            if (!$notification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Notifikasi tidak ditemukan'
                ], 404);
            }
            
            $notification->update([
                'is_read' => true,
                'read_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi ditandai sebagai dibaca'
            ]);
        } catch (\Exception $e) {
            Log::error('Error marking admin notification as read: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai notifikasi sebagai dibaca'
            ], 500);
        }
    }

    public function markAllAsRead()
    {
        try {
            // ✅ GUNAKAN SCOPE forAdmin ✅
            $updated = NotificationAdmin::forAdmin(Auth::id())
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Semua notifikasi ditandai sebagai dibaca',
                'updated_count' => $updated
            ]);
        } catch (\Exception $e) {
            Log::error('Error marking all admin notifications as read: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai semua notifikasi sebagai dibaca'
            ], 500);
        }
    }

    /**
     * Delete multiple notifications
     */
    public function deleteMultiple(Request $request)
    {
        try {
            $validated = $request->validate([
                'notification_ids' => 'required|array',
                'notification_ids.*' => 'integer'
            ]);

            // ✅ GUNAKAN SCOPE forAdmin ✅
            $deleted = NotificationAdmin::forAdmin(Auth::id())
                ->whereIn('id', $validated['notification_ids'])
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil dihapus',
                'deleted_count' => $deleted
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting admin notifications: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus notifikasi'
            ], 500);
        }
    }

    /**
     * Delete single notification
     */
    public function delete($id)
    {
        try {
            // ✅ GUNAKAN SCOPE forAdmin ✅
            $notification = NotificationAdmin::forAdmin(Auth::id())
                ->where('id', $id)
                ->first();
                
            if (!$notification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Notifikasi tidak ditemukan'
                ], 404);
            }
            
            $notification->delete();

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting admin notification: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus notifikasi'
            ], 500);
        }
    }
}
