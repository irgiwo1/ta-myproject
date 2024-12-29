@extends('layouts.petugas')

@section('content')

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <!-- Breadcrumb and Header -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tambah Laporan Kegiatan</h4>
                    <span class="ml-1">Isi form untuk menambahkan laporan kegiatan baru</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('laporan_kegiatan.index') }}">Laporan Kegiatan</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Laporan</a></li>
                </ol>
            </div>
        </div>

        <!-- Form Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('laporan_kegiatan.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="id_user" class="form-label">Nama User</label>
                                <select name="id_user" id="id_user" class="form-control" required>
                                    <option value="" disabled selected>Pilih User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_lokasi" class="form-label">Lokasi</label>
                                <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                                    <option value="" disabled selected>Pilih Lokasi</option>
                                    @foreach ($lokasis as $lokasi)
                                        <option value="{{ $lokasi->id_lokasi }}">{{ $lokasi->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                                <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jenis</option>
                                    <option value="Harian">Harian</option>
                                    <option value="Mingguan">Mingguan</option>
                                    <option value="Bulanan">Bulanan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('laporan_kegiatan.index') }}" class="btn btn-secondary mr-2">Batal</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

@endsection
