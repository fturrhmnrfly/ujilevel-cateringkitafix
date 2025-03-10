@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profil</h1>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="first_name">Nama Depan</label>
            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Nama Belakang</label>
            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
        </div>
        <div class="form-group">
            <label for="gender">Jenis Kelamin</label>
            <select class="form-control" name="gender" required>
                <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
        </div>
        <div class="form-group">
            <label for="address">Alamat Rumah</label>
            <input type="text" class="form-control" name="address" value="{{ $user->address }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection