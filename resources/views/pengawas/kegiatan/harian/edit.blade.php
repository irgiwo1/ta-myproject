@extends('layouts.pengawas')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <h4>Edit Kegiatan Harian</h4>
        <form action="{{ route('pengawas.kegiatan.harian.update', $kegiatanHarian->id_kegiatan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_user">Nama User</label>
                <select name="id_user" id="id_user" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id_user }}" {{ $kegiatanHarian->id_user == $user->id_user ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_lokasi">Lokasi</label>
                <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                    @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->id_lokasi }}" {{ $kegiatanHarian->id_lokasi == $lokasi->id_lokasi ? 'selected' : '' }}>
                            {{ $lokasi->nama_lokasi }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_kegiatan">Tanggal</label>
                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="form-control" value="{{ $kegiatanHarian->tanggal_kegiatan }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required>{{ $kegiatanHarian->deskripsi }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('pengawas.kegiatan.harian.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
