@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tambah Lokasi</h4>
                    <span class="ml-1">Isi data lokasi baru</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.master.lokasi.index') }}">Lokasi</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Lokasi</a></li>
                </ol>
            </div>
        </div>

        <!-- Form Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Form Tambah Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.master.lokasi.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Nama Lokasi -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_lokasi" class="form-label">Nama Lokasi</label>
                                        <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control" placeholder="Masukkan Nama Lokasi" required>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.master.lokasi.index') }}" class="btn btn-secondary" style="margin-right: 10px">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection