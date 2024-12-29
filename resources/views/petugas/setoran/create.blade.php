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
                        <h4>Tambah Setoran</h4>
                        <span class="ml-1">Lengkapi informasi setoran di bawah ini</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('petugas.setoran.index') }}">Setoran</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Tambah Setoran</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('petugas.setoran.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="id_user"><strong>User</strong></label>
                                    <select name="id_user" id="id_user" class="form-control custom-select" required>
                                        <option value="" disabled selected>Pilih User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="id_lokasi"><strong>Lokasi</strong></label>
                                    <select name="id_lokasi" id="id_lokasi" class="form-control custom-select" required>
                                        <option value="" disabled selected>Pilih Lokasi</option>
                                        @foreach ($lokasis as $lokasi)
                                            <option value="{{ $lokasi->id_lokasi }}">{{ $lokasi->nama_lokasi }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_setoran"><strong>Jenis Setoran</strong></label>
                                    <select name="jenis_setoran" id="jenis_setoran" class="form-control custom-select" required>
                                        <option value="" disabled selected>Pilih Jenis Setoran</option>
                                        <option value="Parkir">Setoran Parkir</option>
                                        <option value="Security">Setoran Security</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="shift"><strong>Shift</strong></label>
                                    <select name="shift" id="shift" class="form-control custom-select" required>
                                        <option value="" disabled selected>Pilih Shift</option>
                                        <option value="Shift 1">Shift 1</option>
                                        <option value="Shift 2">Shift 2</option>
                                        <option value="Middle">Middle</option>
                                    </select>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pendapatan_awal"><strong>Pendapatan Awal</strong></label>
                                        <input type="number" name="pendapatan_awal" id="pendapatan_awal" class="form-control" step="0.01" placeholder="Masukkan pendapatan awal" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pengeluaran"><strong>Pengeluaran</strong></label>
                                        <input type="number" name="pengeluaran" id="pengeluaran" class="form-control" step="0.01" placeholder="Masukkan pengeluaran" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pendapatan_akhir"><strong>Pendapatan Akhir</strong></label>
                                        <input type="number" name="pendapatan_akhir" id="pendapatan_akhir" class="form-control" step="0.01" placeholder="Pendapatan Akhir" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pendapatan_sistem"><strong>Pendapatan Sistem</strong></label>
                                        <input type="number" name="pendapatan_sistem" id="pendapatan_sistem" class="form-control" step="0.01" placeholder="Masukkan pendapatan sistem" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="selisih_setoran"><strong>Selisih Setoran</strong></label>
                                    <input type="number" name="selisih_setoran" id="selisih_setoran" class="form-control" step="0.01" placeholder="Selisih Setoran" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan"><strong>Keterangan</strong></label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_transaksi"><strong>Tanggal Transaksi</strong></label>
                                    <input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="nomor_hp"><strong>Nomor HP</strong></label>
                                    <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" placeholder="Masukkan nomor HP" required>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('petugas.setoran.index') }}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Pastikan semua data diisi dengan benar sebelum menyimpan.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <!-- JavaScript for automatic calculations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pendapatanAwal = document.getElementById('pendapatan_awal');
            const pengeluaran = document.getElementById('pengeluaran');
            const pendapatanAkhir = document.getElementById('pendapatan_akhir');
            const pendapatanSistem = document.getElementById('pendapatan_sistem');
            const selisihSetoran = document.getElementById('selisih_setoran');

            // Function to calculate Pendapatan Akhir and Selisih Setoran
            function calculate() {
                const pendapatanAwalValue = parseFloat(pendapatanAwal.value) || 0;
                const pengeluaranValue = parseFloat(pengeluaran.value) || 0;
                const pendapatanSistemValue = parseFloat(pendapatanSistem.value) || 0;

                // Calculate Pendapatan Akhir
                const pendapatanAkhirValue = pendapatanAwalValue - pengeluaranValue;
                pendapatanAkhir.value = pendapatanAkhirValue.toFixed(2);

                // Calculate Selisih Setoran
                const selisihSetoranValue = pendapatanAwalValue - pendapatanSistemValue;
                selisihSetoran.value = selisihSetoranValue.toFixed(2);
            }

            // Event listeners to trigger calculation when input changes
            pendapatanAwal.addEventListener('input', calculate);
            pengeluaran.addEventListener('input', calculate);
            pendapatanSistem.addEventListener('input', calculate);
        });
    </script>

@endsection
