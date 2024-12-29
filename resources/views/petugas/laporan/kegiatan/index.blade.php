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
                    <h4>Laporan Kegiatan</h4>
                    <span class="ml-1">Kelola laporan kegiatan dengan mudah</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Laporan Kegiatan</a></li>
                </ol>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('petugas.laporan.kegiatan.index') }}" method="GET">
                            <div class="d-flex flex-wrap mb-4">
                                <!-- Filter User -->
                                <div class="form-group mr-2">
                                    <label for="id_user">User</label>
                                    <select name="id_user" id="id_user" class="form-control">
                                        <option value="">-- Semua User --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id_user }}" {{ request('id_user') == $user->id_user ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filter Lokasi -->
                                <div class="form-group mr-2">
                                    <label for="id_lokasi">Lokasi</label>
                                    <select name="id_lokasi" id="id_lokasi" class="form-control">
                                        <option value="">-- Semua Lokasi --</option>
                                        @foreach($lokasis as $lokasi)
                                            <option value="{{ $lokasi->id_lokasi }}" {{ request('id_lokasi') == $lokasi->id_lokasi ? 'selected' : '' }}>
                                                {{ $lokasi->nama_lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Filter Jenis Kegiatan -->
                                <div class="form-group mr-2">
                                    <label for="jenis_kegiatan">Jenis Kegiatan</label>
                                    <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-control">
                                        <option value="">-- Semua Jenis --</option>
                                        <option value="Harian" {{ request('jenis_kegiatan') == 'Harian' ? 'selected' : '' }}>Harian</option>
                                        <option value="Mingguan" {{ request('jenis_kegiatan') == 'Mingguan' ? 'selected' : '' }}>Mingguan</option>
                                        <option value="Bulanan" {{ request('jenis_kegiatan') == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                                    </select>
                                </div>

                                <!-- Filter Tanggal Awal -->
                                <div class="form-group mr-2">
                                    <label for="tanggal_awal">Tanggal Awal</label>
                                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                                </div>

                                <!-- Filter Tanggal Akhir -->
                                <div class="form-group mr-2">
                                    <label for="tanggal_akhir">Tanggal Akhir</label>
                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                                </div>


                                <!-- Filter Button -->
                                <div class="form-group d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Header and Buttons -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title">Daftar Laporan Kegiatan</h4>
                            <div class="btn-group" role="group">
                                <a href="{{ route('petugas.laporan.kegiatan.cetak', request()->all()) }}" class="btn btn-secondary btn-sm mr-2">Cetak PDF</a>
                                {{-- <a href="{{ route('laporan_kegiatan.create') }}" class="btn btn-primary">Tambah Laporan</a> --}}
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Deskripsi</th>
                                        {{-- <th>Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanKegiatans as $laporan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $laporan->user->name }}</td>
                                            <td>{{ $laporan->lokasi->nama_lokasi }}</td>
                                            <td>{{ \Carbon\Carbon::parse($laporan->tanggal_kegiatan)->format('d-m-Y') }}</td>
                                            <td>{{ $laporan->jenis_kegiatan }}</td>
                                            <td>{{ $laporan->deskripsi }}</td>
                                            {{-- <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('laporan_kegiatan.edit', $laporan->id_kegiatan) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                                                    <form action="{{ route('laporan_kegiatan.destroy', $laporan->id_kegiatan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if(method_exists($laporanKegiatans, 'links'))
                            <div class="mt-4">
                                {{ $laporanKegiatans->links() }}
                            </div>
                        @endif
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
