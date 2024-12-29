@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <h4>Edit Setoran</h4>
        <form action="{{ route('setoranPerUser.update', $setoran->id_setoran) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- User -->
            <div class="form-group">
                <label for="id_user">User</label>
                <select name="id_user" class="form-control" required>
                    <option value="">Pilih User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id_user }}" {{ $setoran->id_user == $user->id_user ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Lokasi -->
            <div class="form-group">
                <label for="id_lokasi">Lokasi</label>
                <select name="id_lokasi" class="form-control" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->id_lokasi }}" {{ $setoran->id_lokasi == $lokasi->id_lokasi ? 'selected' : '' }}>
                            {{ $lokasi->nama_lokasi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jenis Setoran -->
            <div class="form-group">
                <label for="jenis_setoran">Jenis Setoran</label>
                <input type="text" name="jenis_setoran" class="form-control" value="{{ $setoran->jenis_setoran }}" required>
            </div>

            <!-- Shift -->
            <div class="form-group">
                <label for="shift">Shift</label>
                <input type="text" name="shift" class="form-control" value="{{ $setoran->shift }}" required>
            </div>

            <!-- Pendapatan Awal -->
            <div class="form-group">
                <label for="pendapatan_awal">Pendapatan Awal</label>
                <input type="number" name="pendapatan_awal" class="form-control" value="{{ $setoran->pendapatan_awal }}" required>
            </div>

            <!-- Pengeluaran -->
            <div class="form-group">
                <label for="pengeluaran">Pengeluaran</label>
                <input type="number" name="pengeluaran" class="form-control" value="{{ $setoran->pengeluaran }}" required>
            </div>

            <!-- Keterangan -->
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" required>{{ $setoran->keterangan }}</textarea>
            </div>

            <!-- Pendapatan Akhir -->
            <div class="form-group">
                <label for="pendapatan_akhir">Pendapatan Akhir</label>
                <input type="number" name="pendapatan_akhir" class="form-control" value="{{ $setoran->pendapatan_akhir }}" required>
            </div>

            <!-- Pendapatan Sistem -->
            <div class="form-group">
                <label for="pendapatan_sistem">Pendapatan Sistem</label>
                <input type="number" name="pendapatan_sistem" class="form-control" value="{{ $setoran->pendapatan_sistem }}" required>
            </div>

            <!-- Selisih Setoran -->
            <div class="form-group">
                <label for="selisih_setoran">Selisih Setoran</label>
                <input type="number" name="selisih_setoran" class="form-control" value="{{ $setoran->selisih_setoran }}" required>
            </div>

            <!-- Tanggal Transaksi -->
            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                <input type="date" name="tanggal_transaksi" class="form-control" value="{{ $setoran->tanggal_transaksi }}" required>
            </div>

            <!-- Nomor HP -->
            <div class="form-group">
                <label for="nomor_hp">Nomor HP</label>
                <input type="text" name="nomor_hp" class="form-control" value="{{ $setoran->nomor_hp }}" required>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('setoranPerUser.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
