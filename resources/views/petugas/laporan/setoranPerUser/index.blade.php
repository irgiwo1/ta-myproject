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
                    <h4>Setoran per User</h4>
                    <span class="ml-1">Lihat data setoran berdasarkan user</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Setoran per User</li>
                </ol>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('petugas.laporan.setoranPerUser.index') }}" method="GET">
                            <div class="d-flex flex-wrap mb-4">
                                <!-- Filter User -->
                                <div class="form-group mr-2">
                                    <label for="id_user">User</label>
                                    <select name="id_user" id="id_user" class="form-control">
                                        <option value="">-- Semua User --</option>
                                        @foreach ($users as $user)
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
                                        @foreach ($lokasis as $lokasi)
                                            <option value="{{ $lokasi->id_lokasi }}" {{ request('id_lokasi') == $lokasi->id_lokasi ? 'selected' : '' }}>
                                                {{ $lokasi->nama_lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filter Jenis Setoran -->
                                <div class="form-group mr-2">
                                    <label for="jenis_setoran">Jenis Setoran</label>
                                    <select name="jenis_setoran" id="jenis_setoran" class="form-control">
                                        <option value="">-- Semua Jenis --</option>
                                        <option value="Parkir" {{ request('jenis_setoran') == 'Parkir' ? 'selected' : '' }}>Parkir</option>
                                        <option value="Security" {{ request('jenis_setoran') == 'Security' ? 'selected' : '' }}>Security</option>
                                    </select>
                                </div>

                                <!-- Filter Shift -->
                                <div class="form-group mr-2">
                                    <label for="shift">Shift</label>
                                    <select name="shift" id="shift" class="form-control">
                                        <option value="">-- Semua Shift --</option>
                                        <option value="Shift 1" {{ request('shift') == 'Shift 1' ? 'selected' : '' }}>Shift 1</option>
                                        <option value="Shift 2" {{ request('shift') == 'Shift 2' ? 'selected' : '' }}>Shift 2</option>
                                        <option value="Middle" {{ request('shift') == 'Middle' ? 'selected' : '' }}>Middle</option>
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
                                    <button type="submit" class="btn btn-primary mr-2">Filter</button>
                                    <a href="{{ route('petugas.laporan.setoranPerUser.cetak-pdf', request()->all()) }}" class="btn btn-danger">Cetak PDF</a>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Lokasi</th>
                                        <th>Jenis Setoran</th>
                                        <th>Shift</th>
                                        <th>Pendapatan Awal</th>
                                        <th>Pengeluaran</th>
                                        <th>Keterangan</th>
                                        <th>Pendapatan Akhir</th>
                                        <th>Selisih Setoran</th>
                                        <th>Tanggal Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($setorans as $setoran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $setoran->user->name }}</td>
                                            <td>{{ $setoran->lokasi->nama_lokasi }}</td>
                                            <td>{{ $setoran->jenis_setoran }}</td>
                                            <td>{{ $setoran->shift }}</td>
                                            <td>Rp {{ number_format($setoran->pendapatan_awal, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($setoran->pengeluaran, 0, ',', '.') }}</td>
                                            <td>{{ $setoran->keterangan }}</td>
                                            <td>Rp {{ number_format($setoran->pendapatan_akhir, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($setoran->selisih_setoran, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($setoran->tanggal_transaksi)->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11">Tidak ada data setoran untuk filter ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $setorans->appends(request()->query())->links() }}
                        </div>
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
