<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile ?? $user->profile()->create([
            'phone' => '',
            'bio' => 'hello guys'
        ]);
        
        return view('admin.profileadmin.show', compact('user', 'profile'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? $user->profile()->create([
            'phone' => '',
            'bio' => 'hello guys'
        ]);
        
        return view('admin.profileadmin.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|string|max:15',
            'bio' => 'nullable|string'
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'],
                'bio' => $validated['bio']
            ]
        );

        return redirect()->route('admin.profile.show')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
