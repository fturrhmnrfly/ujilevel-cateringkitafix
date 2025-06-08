<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminProfileController extends Controller
{
    /**
     * Display admin profile
     */
    public function show()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login first');
            }
            
            return view('admin.profileadmin.show', compact('user'));
        } catch (\Exception $e) {
            Log::error('Profile show error: ' . $e->getMessage());
            return back()->with('error', 'Error loading profile');
        }
    }

    /**
     * Show edit form
     */
    public function edit()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login first');
            }
            
            $profile = null;
            // Cek apakah relasi profile ada dan berfungsi
            try {
                $profile = $user->profile;
            } catch (\Exception $profileError) {
                Log::warning('Profile relation error: ' . $profileError->getMessage());
                $profile = null;
            }
            
            return view('admin.profileadmin.edit', compact('user', 'profile'));
        } catch (\Exception $e) {
            Log::error('Profile edit error: ' . $e->getMessage());
            return back()->with('error', 'Error loading edit form');
        }
    }

    /**
     * Update admin profile
     */
    public function update(Request $request)
    {
        // Log semua data request untuk debugging
        Log::info('Profile update started', [
            'user_id' => Auth::id(),
            'request_method' => $request->method(),
            'request_data' => $request->except(['profile_picture', '_token', 'password']),
            'has_file' => $request->hasFile('profile_picture'),
            'content_type' => $request->header('Content-Type')
        ]);

        try {
            // Cek apakah user terautentikasi
            if (!Auth::check()) {
                Log::error('User not authenticated');
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            // Ambil user dengan cara yang aman
            $userId = Auth::id();
            Log::info('Getting user with ID: ' . $userId);
            
            $user = User::find($userId);
            
            if (!$user) {
                Log::error('User not found with ID: ' . $userId);
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }

            Log::info('User found', [
                'user_id' => $user->id,
                'user_class' => get_class($user),
                'user_name' => $user->name
            ]);

            // Validasi input dengan error handling yang lebih baik
            try {
                $validated = $request->validate([
                    'name' => 'required|string|min:2|max:50',
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'phone' => 'nullable|string|max:20',
                    'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
                ], [
                    'name.required' => 'Nama lengkap wajib diisi',
                    'name.min' => 'Nama lengkap minimal 2 karakter',
                    'name.max' => 'Nama lengkap maksimal 50 karakter',
                    'email.required' => 'Email wajib diisi',
                    'email.email' => 'Format email tidak valid',
                    'email.unique' => 'Email sudah digunakan oleh akun lain',
                    'phone.max' => 'Nomor telepon terlalu panjang',
                    'profile_picture.image' => 'File harus berupa gambar',
                    'profile_picture.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau GIF',
                    'profile_picture.max' => 'Ukuran gambar maksimal 2MB'
                ]);
                
                Log::info('Validation passed', ['validated_fields' => array_keys($validated)]);
                
            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::warning('Validation failed', ['errors' => $e->errors()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }

            // Persiapkan data untuk update
            $updateData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
            ];

            // Handle file upload
            if ($request->hasFile('profile_picture')) {
                Log::info('Processing profile picture upload');
                
                try {
                    // Hapus foto lama jika ada
                    if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                        Storage::disk('public')->delete($user->profile_picture);
                        Log::info('Old profile picture deleted');
                    }

                    // Simpan foto baru
                    $file = $request->file('profile_picture');
                    $path = $file->store('profile_pictures', 'public');
                    $updateData['profile_picture'] = $path;
                    
                    Log::info('New profile picture uploaded', ['path' => $path]);
                } catch (\Exception $fileError) {
                    Log::error('File upload error: ' . $fileError->getMessage());
                    return response()->json([
                        'success' => false,
                        'message' => 'Error uploading profile picture: ' . $fileError->getMessage()
                    ], 500);
                }
            }

            Log::info('Update data prepared', ['update_data' => $updateData]);

            // Update user data dengan beberapa metode fallback
            try {
                // Metode 1: Direct property assignment
                $user->name = $updateData['name'];
                $user->email = $updateData['email'];
                $user->phone = $updateData['phone'];
                if (isset($updateData['profile_picture'])) {
                    $user->profile_picture = $updateData['profile_picture'];
                }
                
                $saved = $user->save();
                
                if (!$saved) {
                    throw new \Exception('Save method returned false');
                }
                
                Log::info('Profile updated successfully using direct assignment');
                
            } catch (\Exception $saveError) {
                Log::error('Direct save failed: ' . $saveError->getMessage());
                
                try {
                    // Metode 2: Using Query Builder sebagai fallback
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(array_merge($updateData, ['updated_at' => now()]));
                    
                    Log::info('Profile updated successfully using Query Builder');
                    
                } catch (\Exception $dbError) {
                    Log::error('Query Builder update failed: ' . $dbError->getMessage());
                    throw new \Exception('All update methods failed');
                }
            }

            // Refresh user data
            $user = $user->fresh();

            Log::info('Profile update completed successfully', [
                'user_id' => $user->id,
                'updated_fields' => array_keys($updateData)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diperbarui!',
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'profile_picture' => $user->profile_picture
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Profile update error', [
                'user_id' => Auth::id(),
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
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
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found');
            }

            Log::info('Admin account deletion attempt', ['user_id' => $user->id]);

            // Hapus foto profil jika ada
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
                Log::info('Profile picture deleted during account deletion');
            }

            // Logout user
            Auth::logout();

            // Hapus akun user
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Log::info('Admin account deleted successfully');

            return redirect()->route('login')->with('success', 'Akun berhasil dihapus');

        } catch (\Exception $e) {
            Log::error('Admin account deletion error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus akun');
        }
    }
}