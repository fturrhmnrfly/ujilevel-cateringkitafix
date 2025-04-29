<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;
        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'bio' => 'nullable|string',
            'email' => 'required|email'
        ]);

        // Update user's email
        $user->update([
            'email' => $validated['email']
        ]);

        // Update profile
        $user->profile()->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'bio' => $validated['bio']
        ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        // Pastikan profile dibuat jika belum ada
        $profile = $user->profile ?? $user->profile()->create([
            'first_name' => explode(' ', $user->name)[0] ?? '',
            'last_name' => explode(' ', $user->name)[1] ?? '',
            'phone' => '',
            'address' => '',
            'bio' => null
        ]);
        
        return view('profile.show', compact('user', 'profile'));
    }
}