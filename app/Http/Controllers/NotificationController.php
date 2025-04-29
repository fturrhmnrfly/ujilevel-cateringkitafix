<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();
            
        return response()->json(['count' => $count]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }
        
        $notification->update(['is_read' => true]);
        
        return redirect()->back();
    }
}
