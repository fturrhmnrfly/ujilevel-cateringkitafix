<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profile - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px 40px;
            min-height: 100vh;
        }

        .profile-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Section */
        .profile-header {
            display: flex;
            align-items: center;
            padding: 40px 50px;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
        }

        .header-icon {
            width: 60px;
            height: 60px;
            background: #6c757d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }

        .header-icon i {
            color: white;
            font-size: 28px;
        }

        .header-text h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .header-text p {
            color: #666;
            font-size: 16px;
            margin: 0;
        }

        /* Profile Content */
        .profile-content {
            padding: 50px;
        }

        .profile-section-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 35px;
            font-weight: 600;
        }

        .profile-layout {
            display: flex;
            gap: 80px;
            align-items: flex-start;
        }

        /* Profile Image Section */
        .profile-image-section {
            flex-shrink: 0;
            text-align: center;
            min-width: 240px;
            padding-right: 20px;
        }

        .profile-image-container {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 25px;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #e9ecef;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .camera-icon {
            position: absolute;
            bottom: 15px;
            right: 15px;
            width: 45px;
            height: 45px;
            background: #6c757d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 4px solid white;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        .camera-icon i {
            color: white;
            font-size: 20px;
        }

        /* Profile Form Section */
        .profile-form-section {
            flex: 1;
            min-width: 0;
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 16px;
            color: #333;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #007bff;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.1);
        }

        .form-input::placeholder {
            color: #adb5bd;
        }

        /* Validation styles */
        .form-input.error {
            border-color: #dc3545;
            background: #fdf2f2;
        }

        .form-input.valid {
            border-color: #28a745;
            background: #f8fff8;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .success-message {
            color: #28a745;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        /* Button Section */
        .button-section {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            justify-content: flex-start;
        }

        .btn {
            padding: 15px 35px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 150px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #d4a574, #c19a68);
            color: white;
            box-shadow: 0 3px 8px rgba(196, 154, 104, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #c19a68, #b08a5c);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(196, 154, 104, 0.4);
        }

        .btn-primary:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            box-shadow: 0 3px 8px rgba(255, 107, 107, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #ee5a52, #dc4c64);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 107, 107, 0.4);
        }

        /* Delete Account Section */
        .delete-section {
            margin-top: 50px;
            padding-top: 40px;
            border-top: 1px solid #eee;
        }

        .delete-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .delete-description {
            color: #666;
            font-size: 16px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        /* Success/Error Alert */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            display: none;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                padding: 25px;
            }

            .profile-container {
                max-width: 900px;
            }

            .profile-layout {
                gap: 50px;
            }

            .profile-image-section {
                min-width: 200px;
                padding-right: 15px;
            }

            .profile-form-section {
                padding-left: 15px;
            }

            .profile-image-container {
                width: 170px;
                height: 170px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }

            .profile-container {
                max-width: 100%;
                margin: 0 10px;
            }

            .profile-content {
                padding: 30px;
            }

            .profile-layout {
                flex-direction: column;
                gap: 30px;
                text-align: center;
            }

            .profile-image-section {
                min-width: auto;
                padding-right: 0;
            }

            .profile-form-section {
                padding-left: 0;
            }

            .profile-image-container {
                width: 150px;
                height: 150px;
            }

            .button-section {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .profile-header {
                padding: 25px;
            }
        }

        @media (max-width: 480px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-icon {
                margin-right: 0;
            }

            .profile-content {
                padding: 20px;
            }

            .form-input {
                padding: 12px 15px;
                font-size: 14px;
            }

            .btn {
                padding: 12px 25px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="profile-container">
            <!-- Header Section -->
            <div class="profile-header">
                <div class="header-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="header-text">
                    <h1>Pengaturan Profile</h1>
                    <p>Kelola pengaturan dan preferensi akun Anda</p>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="profile-content">
                <!-- Alert Messages -->
                <div id="alert-success" class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <span id="success-text">Profile berhasil diperbarui!</span>
                </div>
                <div id="alert-error" class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <span id="error-text">Terjadi kesalahan saat memperbarui profile</span>
                </div>

                <h2 class="profile-section-title">Informasi Profile</h2>
                
                <div class="profile-layout">
                    <!-- Profile Image Section -->
                    <div class="profile-image-section">
                        <div class="profile-image-container">
                            @if(auth()->user()->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                                     alt="Profile Picture" 
                                     class="profile-image"
                                     onerror="this.src='{{ asset('assets/profil.png') }}'">
                            @else
                                <img src="{{ asset('assets/profil.png') }}" 
                                     alt="Default Profile" 
                                     class="profile-image">
                            @endif
                            <div class="camera-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Form Section -->
                    <div class="profile-form-section">
                        <form id="profile-form" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" 
                                       id="name-input"
                                       name="name" 
                                       class="form-input" 
                                       value="{{ old('name', auth()->user()->name) }}" 
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                <div class="error-message" id="name-error">
                                    Nama lengkap harus minimal 2 karakter dan hanya boleh mengandung huruf dan spasi
                                </div>
                                <div class="success-message" id="name-success">
                                    ✓ Nama lengkap valid
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" 
                                       id="email-input"
                                       name="email" 
                                       class="form-input" 
                                       value="{{ old('email', auth()->user()->email) }}" 
                                       placeholder="nama@example.com"
                                       required>
                                <div class="error-message" id="email-error">
                                    Format email tidak valid
                                </div>
                                <div class="success-message" id="email-success">
                                    ✓ Email valid
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="tel" 
                                       id="phone-input"
                                       name="phone" 
                                       class="form-input" 
                                       value="{{ old('phone', auth()->user()->phone) }}" 
                                       placeholder="08123456789">
                                <div class="error-message" id="phone-error">
                                    Format nomor telepon tidak valid (contoh: 08123456789)
                                </div>
                                <div class="success-message" id="phone-success">
                                    ✓ Nomor telepon valid
                                </div>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label class="form-label">Foto Profile</label>
                                <input type="file" 
                                       name="profile_picture" 
                                       class="form-input" 
                                       accept="image/*">
                            </div>

                            <div class="button-section">
                                <button type="submit" id="save-btn" class="btn btn-primary">
                                    <i class="fas fa-save" style="margin-right: 10px;"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Account Section -->
                <div class="delete-section">
                    <h3 class="delete-title">Hapus Akun</h3>
                    <p class="delete-description">
                        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.
                    </p>
                    <form action="{{ route('admin.profile.destroy') }}" method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt" style="margin-right: 10px;"></i>
                            Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validation functions
        function validateName(name) {
            const nameRegex = /^[a-zA-Z\s]{2,50}$/;
            return nameRegex.test(name.trim());
        }

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePhone(phone) {
            // Indonesian phone number format
            const phoneRegex = /^(?:(?:\+62|62)|0)[8][1-9][0-9]{8,10}$/;
            return phoneRegex.test(phone) || phone === '';
        }

        // Validation state
        let validationState = {
            name: false,
            email: false,
            phone: true // Phone is optional
        };

        // Input validation handlers
        function setupValidation() {
            const nameInput = document.getElementById('name-input');
            const emailInput = document.getElementById('email-input');
            const phoneInput = document.getElementById('phone-input');
            const saveBtn = document.getElementById('save-btn');

            // Name validation
            nameInput.addEventListener('input', function() {
                const isValid = validateName(this.value);
                validationState.name = isValid;
                
                if (this.value.length === 0) {
                    this.className = 'form-input';
                    document.getElementById('name-error').style.display = 'none';
                    document.getElementById('name-success').style.display = 'none';
                } else if (isValid) {
                    this.className = 'form-input valid';
                    document.getElementById('name-error').style.display = 'none';
                    document.getElementById('name-success').style.display = 'block';
                } else {
                    this.className = 'form-input error';
                    document.getElementById('name-error').style.display = 'block';
                    document.getElementById('name-success').style.display = 'none';
                }
                
                updateSaveButton();
            });

            // Email validation
            emailInput.addEventListener('input', function() {
                const isValid = validateEmail(this.value);
                validationState.email = isValid;
                
                if (this.value.length === 0) {
                    this.className = 'form-input';
                    document.getElementById('email-error').style.display = 'none';
                    document.getElementById('email-success').style.display = 'none';
                } else if (isValid) {
                    this.className = 'form-input valid';
                    document.getElementById('email-error').style.display = 'none';
                    document.getElementById('email-success').style.display = 'block';
                } else {
                    this.className = 'form-input error';
                    document.getElementById('email-error').style.display = 'block';
                    document.getElementById('email-success').style.display = 'none';
                }
                
                updateSaveButton();
            });

            // Phone validation
            phoneInput.addEventListener('input', function() {
                // Remove non-numeric characters except + at the beginning
                let value = this.value.replace(/(?!^\+)\D/g, '');
                
                // Limit length
                if (value.length > 13) {
                    value = value.slice(0, 13);
                }
                
                this.value = value;
                
                const isValid = validatePhone(value);
                validationState.phone = isValid;
                
                if (value.length === 0) {
                    this.className = 'form-input';
                    document.getElementById('phone-error').style.display = 'none';
                    document.getElementById('phone-success').style.display = 'none';
                } else if (isValid) {
                    this.className = 'form-input valid';
                    document.getElementById('phone-error').style.display = 'none';
                    document.getElementById('phone-success').style.display = 'block';
                } else {
                    this.className = 'form-input error';
                    document.getElementById('phone-error').style.display = 'block';
                    document.getElementById('phone-success').style.display = 'none';
                }
                
                updateSaveButton();
            });

            // Initial validation
            nameInput.dispatchEvent(new Event('input'));
            emailInput.dispatchEvent(new Event('input'));
            phoneInput.dispatchEvent(new Event('input'));
        }

        function updateSaveButton() {
            const saveBtn = document.getElementById('save-btn');
            const isFormValid = validationState.name && validationState.email && validationState.phone;
            
            saveBtn.disabled = !isFormValid;
        }

        // Handle camera icon click for file upload
        document.querySelector('.camera-icon').addEventListener('click', function() {
            document.querySelector('input[name="profile_picture"]').click();
        });

        // Preview image when selected
        document.querySelector('input[name="profile_picture"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showAlert('error', 'Ukuran file terlalu besar. Maksimal 2MB.');
                    this.value = '';
                    return;
                }

                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    showAlert('error', 'Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.profile-image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle form submission
        document.getElementById('profile-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const saveBtn = document.getElementById('save-btn');
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 10px;"></i>Menyimpan...';
            
            // Submit form via fetch
            const formData = new FormData(this);
            
            fetch('{{ route("admin.profile.update") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message || 'Profile berhasil diperbarui!');
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan saat memperbarui profile');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan saat memperbarui profile: ' + error.message);
            })
            .finally(() => {
                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="fas fa-save" style="margin-right: 10px;"></i>Simpan Perubahan';
            });
        });

        // Show alert function
        function showAlert(type, message) {
            // Hide all alerts first
            document.getElementById('alert-success').style.display = 'none';
            document.getElementById('alert-error').style.display = 'none';
            
            if (type === 'success') {
                document.getElementById('success-text').textContent = message;
                document.getElementById('alert-success').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('alert-success').style.display = 'none';
                }, 5000);
            } else {
                document.getElementById('error-text').textContent = message;
                document.getElementById('alert-error').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('alert-error').style.display = 'none';
                }, 5000);
            }
        }

        // Show Laravel session messages
        @if(session('success'))
            showAlert('success', '{{ session('success') }}');
        @endif

        @if($errors->any())
            showAlert('error', '{{ $errors->first() }}');
        @endif

        // Initialize validation on page load
        document.addEventListener('DOMContentLoaded', function() {
            setupValidation();
        });
    </script>
</body>
</html>