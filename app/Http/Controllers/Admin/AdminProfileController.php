<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->adminProfile ?? $user->adminProfile()->create([
            'phone' => '',
            'bio' => 'Hello guys'
        ]);
        
        return view('admin.profileadmin.show', compact('user', 'profile'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->adminProfile;
        return view('admin.profileadmin.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'bio' => 'nullable|string'
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        $user->adminProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'],
                'bio' => $validated['bio']
            ]
        );

        return redirect()->route('admin.profile.show')
                        ->with('success', 'Profile updated successfully.');
    }
}