<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Metode Pembayaran</h1>
    <form action="{{ route('admin.metodepembayaran.update', $metodePembayaran->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="metode_pembayaran" class="block text-sm font-medium">Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="border px-4 py-2 w-full rounded" value="{{ $metodePembayaran->metode_pembayaran }}" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="border px-4 py-2 w-full rounded">{{ $metodePembayaran->deskripsi }}</textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium">Status</label>
            <select name="status" id="status" class="border px-4 py-2 w-full rounded" required>
                <option value="Aktif" {{ $metodePembayaran->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ $metodePembayaran->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="admin" class="block text-sm font-medium">Admin</label>
            <input type="text" name="admin" id="admin" class="border px-4 py-2 w-full rounded" value="{{ $metodePembayaran->admin }}" required>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
        </div>
    </form>
</div>

