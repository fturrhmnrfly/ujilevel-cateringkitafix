<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .content {
        padding: 20px;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: white;
        color: #333;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        border: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
    }

    .search-input {
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        width: 300px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .table-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #f7f7f7;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #e0e0e0;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .btn-warning {
        background-color: #FFA500;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        margin-right: 5px;
        border: none;
        cursor: pointer;
    }

    .btn-danger {
        background-color: #DC3545;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .status-available {
        color: #28a745;
        font-weight: 500;
    }

    .admin-profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .admin-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .form-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #2c2c77;
        outline: none;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    select.form-control {
        background-color: white;
    }

    .btn-primary {
        background-color: #2c2c77;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background-color: #1a1a5c;
    }

    /* Perbaikan style untuk image preview */
    .form-group .image-preview {
        width: 100%;
        max-width: 300px;
        height: 200px;
        border: 2px dashed #ddd;
        border-radius: 8px;
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8f9fa;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .image-preview-text {
        color: #999;
        font-size: 14px;
        text-align: center;
    }
</style>

{{-- <x-sidebar></x-sidebar> --}}
<div class="form-container">
    <h2>Tambah Makanan</h2>
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
            <label for="image">Gambar Makanan</label>
            <input type="file" name="image" id="image" class="form-control" required accept="image/*" onchange="previewImage(this)">
            <div id="imagePreview" class="mt-2"></div>
        </div>
        <div class="form-group">
            <label for="nama_makanan">Nama Makanan:</label>
            <input type="text" id="nama_makanan" name="nama_makanan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori:</label>
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
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn-primary">Simpan</button>
    </form>
</div>

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
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
</html>
