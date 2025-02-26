{{-- <x-sidebar></x-sidebar> --}}
<style>
</style>
<div class="container">
    <h2>Daftar Penilaian</h2>
    <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">Tambah Penilaian</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Nama Produk</th>
                <th>Penilaian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penilaians as $index => $penilaian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $penilaian->nama_pembeli }}</td>
                    <td>{{ $penilaian->nama_produk }}</td>
                    <td>
                        @for ($i = 0; $i < $penilaian->rating; $i++)
                            ⭐
                        @endfor
                    </td>
                    <td>
                        <a href="{{ route('admin.penilaian.edit', $penilaian->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.penilaian.destroy', $penilaian->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>