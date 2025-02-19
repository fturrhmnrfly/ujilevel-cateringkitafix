<div class="container">
    <h1>Status Pembayaran</h1>
    <a href="{{ route('admin.statuspembayaran.create') }}" class="btn btn-primary mb-3">Tambah Status</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Nama Produk</th>
                <th>Tanggal Transaksi</th>
                <th>Status Transaksi</th>
                <th>Bukti Transaksi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $status->namapembeli }}</td>
                <td>{{ $status->namaproduk }}</td>
                <td>{{ $status->tanggaltransaksi }}</td>
                <td>{{ $status->statustransaksi }}</td>
                <td>
                    @if($status->buktitransaksi)
                        <a href="{{ asset('storage/' . $status->buktitransaksi) }}" target="_blank" class="btn btn-secondary">View File</a>
                    @else
                        Tidak Ada File
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.statuspembayaran.edit', $status->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.statuspembayaran.destroy', $status->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>