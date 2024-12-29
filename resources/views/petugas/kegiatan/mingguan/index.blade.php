@extends('layouts.petugas')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6">
                <h4>Kegiatan Mingguan</h4>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('petugas.kegiatan.mingguan.create') }}" class="btn btn-primary">Tambah Kegiatan</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kegiatanMingguan as $kegiatan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kegiatan->user->name }}</td>
                                        <td>{{ $kegiatan->lokasi->nama_lokasi }}</td>
                                        <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d-m-Y') }}</td>
                                        <td>{{ $kegiatan->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('petugas.kegiatan.mingguan.edit', $kegiatan->id_kegiatan) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('petugas.kegiatan.mingguan.destroy', $kegiatan->id_kegiatan) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada kegiatan mingguan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $kegiatanMingguan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
