<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationAdmin;
use Illuminate\Http\Request;

class NotificationAdminController extends Controller
{
    public function index()
    {
        $notifications = NotificationAdmin::where('admin_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = NotificationAdmin::findOrFail($id);
        $notification->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi telah dibaca');
    }

    public function markAllAsRead()
    {
        NotificationAdmin::where('admin_id', auth()->id())
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Semua notifikasi telah dibaca');
    }
}