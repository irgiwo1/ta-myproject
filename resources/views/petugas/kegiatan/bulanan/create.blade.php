@extends('layouts.petugas')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <h4>Tambah Kegiatan Bulanan</h4>
        <form action="{{ route('petugas.kegiatan.bulanan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_user">Nama User</label>
                <select name="id_user" id="id_user" class="form-control" required>
                    <option value="" disabled selected>Pilih User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_lokasi">Lokasi</label>
                <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                    <option value="" disabled selected>Pilih Lokasi</option>
                    @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->id_lokasi }}">{{ $lokasi->nama_lokasi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_kegiatan">Tanggal</label>
                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('petugas.kegiatan.bulanan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
