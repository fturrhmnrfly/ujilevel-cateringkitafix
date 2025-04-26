<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita Admin - Laporan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .header {
        background-color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .admin-controls {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .notification-wrapper {
        position: relative;
    }

    .notification-icon {
        color: #333;
        font-size: 20px;
        text-decoration: none;
        padding: 5px;
        display: flex;
        align-items: center;
    }

    .notification-icon:hover {
        color: #2c2c77;
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    .admin-profile {
        display: flex;
        align-items: center;
        gap: 10px;
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
</style>    
</head>
<body>
    
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1 class="page-title">{{ $title ?? 'Dashboard' }}</h1>
            <div class="admin-controls">
                <div class="notification-wrapper">
                    <a href="{{ route('admin.notifications.index') }}" class="notification-icon">
                        <i class="fa-solid fa-bell"></i>
                        @php
                            $unreadCount = \App\Models\NotificationAdmin::where('admin_id', auth()->id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="notification-badge">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </div>
                <div class="admin-profile">
                    <span>Admin</span>
                    <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
                </div>
            </div>
        </div>

        <div class="content">
            <h2 class="page-title"></h2>
            
            <div class="content-header">
                <a href="{{ route('admin.laporan.create') }}" class="btn-primary">Buat Laporan</a>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari laporan...">
                </div>
                {{-- <form action="{{ route('admin.laporan.export') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary">Export PDF</button>
                </form> --}}
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Laporan</th>
                            <th>Jenis Laporan</th>
                            <th>Tanggal</th>
                            <th>Admin</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $index => $laporan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $laporan->laporan }}</td>
                                <td>{{ $laporan->jenis_laporan }}</td>
                                <td>{{ $laporan->tanggal }}</td>
                                <td>{{ $laporan->admin }}</td>
                                <td>{{ $laporan->deskripsi }}</td>
                                <td>
                                    <span class="badge {{ $laporan->status == 'Selesai' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $laporan->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.laporan.edit', $laporan->id) }}" class="btn-warning">Edit</a>
                                    <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger" onclick="return confirm('Yakin ingin menghapus laporan ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     <!-- SweetAlert2 -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>
         function confirmDelete(id) {
             Swal.fire({
                 title: 'Apakah kamu yakin?',
                 text: "Data ini akan dihapus secara permanen!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Ya, hapus!',
                 cancelButtonText: 'Batal'
             }).then((result) => {
                 if (result.isConfirmed) {
                     // Submit form jika pengguna mengkonfirmasi
                     document.getElementById('delete-form-' + id).submit();
     
                     // Tampilkan SweetAlert untuk notifikasi berhasil
                     Swal.fire({
                         title: 'Berhasil!',
                         text: 'Data berhasil dihapus.',
                         icon: 'success',
                         confirmButtonColor: '#3085d6',
                         confirmButtonText: 'OK'
                     });
                 }
             });
         }
     </script>
</body>
</html>
