<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    /**
     * Display admin profile
     */
    public function show()
    {
        return view('admin.profileadmin.show');
    }

    /**
     * Update admin profile
     */
    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            // Validasi input
            $validated = $request->validate([
                'name' => 'required|string|min:2|max:50|regex:/^[a-zA-Z\s]+$/',
                'email' => [
                    'required', 
                    'email', 
                    Rule::unique('users')->ignore($user->id)
                ],
                'phone' => 'nullable|regex:/^(?:(?:\+62|62)|0)[8][1-9][0-9]{8,10}$/',
                'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
            ], [
                'name.required' => 'Nama lengkap wajib diisi',
                'name.min' => 'Nama lengkap minimal 2 karakter',
                'name.regex' => 'Nama lengkap hanya boleh mengandung huruf dan spasi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan oleh akun lain',
                'phone.regex' => 'Format nomor telepon tidak valid',
                'profile_picture.image' => 'File harus berupa gambar',
                'profile_picture.mimes' => 'Format gambar harus JPG, PNG, atau GIF',
                'profile_picture.max' => 'Ukuran gambar maksimal 2MB'
            ]);

            // Handle file upload
            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture if exists
                if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                // Store new profile picture
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $validated['profile_picture'] = $path;
            }

            // Update user data
            $user->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diperbarui!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . collect($e->errors())->flatten()->first(),
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Admin profile update error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui profile: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete admin account
     */
    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();

            // Delete profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Logout user
            Auth::logout();

            // Delete user account
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Akun berhasil dihapus');

        } catch (\Exception $e) {
            \Log::error('Admin account deletion error: ' . $e->getMessage());
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus akun');
        }
    }
}