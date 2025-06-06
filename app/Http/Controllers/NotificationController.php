<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = NotificationService::getUserNotifications(Auth::id(), 50);
        return view('notifications.index', compact('notifications'));
    }

    public function getNotifications()
    {
        $notifications = NotificationService::getUserNotifications(Auth::id(), 20);
        
        return response()->json([
            'success' => true,
            'notifications' => $notifications->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'type' => $notification->type,
                    'icon_type' => $notification->icon_type,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->toISOString(),
                    'time_ago' => $notification->time_ago
                ];
            })
        ]);
    }

    public function getUnreadCount()
    {
        $count = NotificationService::getUnreadCount(Auth::id());
        
        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    public function markAsRead($id)
    {
        $result = NotificationService::markAsRead($id, Auth::id());
        
        return response()->json([
            'success' => $result,
            'message' => $result ? 'Notifikasi ditandai sebagai dibaca' : 'Gagal menandai notifikasi'
        ]);
    }

    public function markAllAsRead()
    {
        $result = NotificationService::markAllAsRead(Auth::id());
        
        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi ditandai sebagai dibaca',
            'updated_count' => $result
        ]);
    }

    public function delete($id)
    {
        $result = NotificationService::deleteNotification($id, Auth::id());
        
        return response()->json([
            'success' => $result,
            'message' => $result ? 'Notifikasi berhasil dihapus' : 'Gagal menghapus notifikasi'
        ]);
    }

    public function deleteMultiple(Request $request)
    {
        $request->validate([
            'notification_ids' => 'required|array',
            'notification_ids.*' => 'integer|exists:notifications,id'
        ]);

        $deletedCount = NotificationService::deleteMultiple(
            $request->notification_ids, 
            Auth::id()
        );
        
        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil dihapus',
            'deleted_count' => $deletedCount
        ]);
    }
}
