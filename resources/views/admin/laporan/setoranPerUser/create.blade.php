@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <h4>Tambah Setoran</h4>
        <form action="{{ route('setoranPerUser.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_user">User</label>
                <select name="id_user" class="form-control" required>
                    <option value="">Pilih User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_lokasi">Lokasi</label>
                <select name="id_lokasi" class="form-control" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->id_lokasi }}">{{ $lokasi->nama_lokasi }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Tambahkan input lainnya -->
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
