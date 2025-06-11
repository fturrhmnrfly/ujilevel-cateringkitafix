<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Makanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border: 2px solid #26276B;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #26276B;
            background-color: white;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%23999' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        .btn-primary {
            background-color: #B19370;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin: 0 auto;
            margin-top: 30px;
        }

        .btn-primary:hover {
            background-color: #1e1f5a;
        }

        .form-group small {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        /* File input styling */
        input[type="file"] {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            background-color: #fafafa;
            position: relative;
        }

        input[type="file"]:hover {
            border-color: #26276B;
            background-color: #f8f9ff;
        }

        /* Image preview styling */
        #imagePreview {
            margin-top: 10px;
            text-align: center;
        }

        #imagePreview img {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .form-container {
                padding: 20px;
                margin: 10px;
            }

            .page-title {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <h1 class="page-title">Tambah Kelola Makanan</h1>

        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kelolamakanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="image">Foto Produk</label>
                    <input type="file" id="image" name="image" class="form-control" required accept="image/*"
                        onchange="previewImage(this)">
                    <div id="imagePreview"></div>
                </div>

                <div class="form-group">
                    <label for="nama_makanan">Nama Makanan:</label>
                    <input type="text" id="nama_makanan" name="nama_makanan" class="form-control" required
                        placeholder="Masukkan nama makanan">
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Prasmanan">Prasmanan</option>
                        <option value="Nasi Box">Nasi Box</option>
                        <option value="Paket Pernikahan">Paket Pernikahan</option>
                        <option value="Paket Harian">Paket Harian</option>
                        <option value="Ala Carte">Ala Carte</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" class="form-control" required
                        placeholder="Harga sesuai kategori">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required
                        placeholder="Deskripsi apa saja yang mau ditambahkan dan ditanyakan"></textarea>
                </div>

                <button type="submit" class="btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '200px';
                    img.style.height = 'auto';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
            });
        @endif

        // Form submission handling
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please fill all required fields correctly.',
                });
            }
        });

        // Add price formatting
        document.getElementById('harga').addEventListener('input', function(e) {
            // Remove non-numeric characters
            let value = this.value.replace(/\D/g, '');

            // Ensure we're working with numbers
            value = parseInt(value) || 0;

            // Format the number
            this.value = value;
        });

        // Format price before form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const hargaInput = document.getElementById('harga');
            // Remove any formatting and multiply by 1 to ensure we store the full amount
            hargaInput.value = parseInt(hargaInput.value.replace(/\D/g, '')) || 0;
        });
    </script>
</body>

</html>
