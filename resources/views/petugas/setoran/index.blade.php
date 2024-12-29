@extends('layouts.petugas')

@section('content')

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Manajemen Setoran</h4>
                        <span class="ml-1">Kelola semua data setoran dengan mudah</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setoran</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Setoran</h4>
                            <a href="{{ route('petugas.setoran.create') }}" class="btn btn-success">Tambah Setoran</a>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Lokasi</th>
                                            <th>Jenis Setoran</th>
                                            <th>Shift</th>
                                            <th>Pendapatan Awal</th>
                                            <th>Pengeluaran</th>
                                            <th>Keterangan</th>
                                            <th>Pendapatan Akhir</th>
                                            <th>Pendapatan Sistem</th>
                                            <th>Selisih Setoran</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Nomor HP</th>
                                            {{-- <th>Aksi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($setorans as $setoran)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td> <!-- Nomor urut -->
                                                <td>{{ $setoran->user->name }}</td>
                                                <td>{{ $setoran->lokasi->nama_lokasi }}</td>
                                                <td>{{ $setoran->jenis_setoran }}</td>
                                                <td>{{ $setoran->shift }}</td>
                                                <td>Rp {{ number_format($setoran->pendapatan_awal, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($setoran->pengeluaran, 0, ',', '.') }}</td>
                                                <td>{{ $setoran->keterangan }}</td>
                                                <td>Rp {{ number_format($setoran->pendapatan_akhir, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($setoran->pendapatan_sistem, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($setoran->selisih_setoran, 0, ',', '.') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($setoran->tanggal_transaksi)->format('d M Y') }}</td>
                                                <td>{{ $setoran->nomor_hp }}</td>
                                                {{-- <td>
                                                    <div class="d-flex"> --}}
                                                        {{-- <!-- Edit Button -->
                                                        <a href="{{ route('petugas.setoran.edit', $setoran->id_setoran) }}" class="btn btn-warning btn-sm mr-2">Edit</a> --}}

                                                        <!-- Delete Button -->
                                                        {{-- <form action="{{ route('petugas.setoran.destroy', $setoran->id_setoran) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                                        </form> --}}
                                                    {{-- </div>
                                                </td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="14">Tidak ada data setoran.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Data terakhir diperbarui {{ now()->format('d M Y H:i') }}</small>
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
