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
                        <h4>Edit Setoran</h4>
                        <span class="ml-1">Perbarui data setoran dengan mudah</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Setoran</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('petugas.setoran.update', $setoran->id_setoran) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- User Selection -->
                                <div class="form-group row">
                                    <label for="id_user" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-10">
                                        <select name="id_user" id="id_user" class="form-control" required>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id_user }}" {{ $setoran->id_user == $user->id_user ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Lokasi Selection -->
                                <div class="form-group row">
                                    <label for="id_lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                                    <div class="col-sm-10">
                                        <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                                            @foreach ($lokasis as $lokasi)
                                                <option value="{{ $lokasi->id_lokasi }}" {{ $setoran->id_lokasi == $lokasi->id_lokasi ? 'selected' : '' }}>
                                                    {{ $lokasi->nama_lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Dropdown untuk Jenis Setoran -->
                                <div class="form-group row">
                                    <label for="jenis_setoran" class="col-sm-2 col-form-label">Jenis Setoran</label>
                                    <div class="col-sm-10">
                                        <select name="jenis_setoran" id="jenis_setoran" class="form-control" required>
                                            <option value="" disabled selected>Pilih Jenis Setoran</option>
                                            <option value="Parkir" {{ $setoran->jenis_setoran == 'Parkir' ? 'selected' : '' }}>Setoran Parkir</option>
                                            <option value="Security" {{ $setoran->jenis_setoran == 'Security' ? 'selected' : '' }}>Setoran Security</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Dropdown untuk Shift -->
                                <div class="form-group row">
                                    <label for="shift" class="col-sm-2 col-form-label">Shift</label>
                                    <div class="col-sm-10">
                                        <select name="shift" id="shift" class="form-control" required>
                                            <option value="" disabled selected>Pilih Shift</option>
                                            <option value="Shift 1" {{ $setoran->shift == 'Shift 1' ? 'selected' : '' }}>Shift 1</option>
                                            <option value="Shift 2" {{ $setoran->shift == 'Shift 2' ? 'selected' : '' }}>Shift 2</option>
                                            <option value="Middle" {{ $setoran->shift == 'Middle' ? 'selected' : '' }}>Middle</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Pendapatan Awal -->
                                <div class="form-group row">
                                    <label for="pendapatan_awal" class="col-sm-2 col-form-label">Pendapatan Awal</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="pendapatan_awal" id="pendapatan_awal" class="form-control" value="{{ $setoran->pendapatan_awal }}" step="0.01" required>
                                    </div>
                                </div>

                                <!-- Pengeluaran -->
                                <div class="form-group row">
                                    <label for="pengeluaran" class="col-sm-2 col-form-label">Pengeluaran</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="pengeluaran" id="pengeluaran" class="form-control" value="{{ $setoran->pengeluaran }}" step="0.01" required>
                                    </div>
                                </div>

                                <!-- Pendapatan Akhir -->
                                <div class="form-group row">
                                    <label for="pendapatan_akhir" class="col-sm-2 col-form-label">Pendapatan Akhir</label>
                                    <div class="col-sm-10">
                                        <input readonly type="number" name="pendapatan_akhir" id="pendapatan_akhir" class="form-control" value="{{ $setoran->pendapatan_akhir }}" step="0.01" required>
                                    </div>
                                </div>

                                <!-- Pendapatan Sistem -->
                                <div class="form-group row">
                                    <label for="pendapatan_sistem" class="col-sm-2 col-form-label">Pendapatan Sistem</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="pendapatan_sistem" id="pendapatan_sistem" class="form-control" value="{{ $setoran->pendapatan_sistem }}" step="0.01" required>
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $setoran->keterangan }}" step="0.01" required>
                                    </div>
                                </div>

                                <!-- Selisih Setoran -->
                                <div class="form-group row">
                                    <label for="selisih_setoran" class="col-sm-2 col-form-label">Selisih Setoran</label>
                                    <div class="col-sm-10">
                                        <input readonly type="number" name="selisih_setoran" id="selisih_setoran" class="form-control" value="{{ $setoran->selisih_setoran }}" step="0.01" required>
                                    </div>
                                </div>

                                <!-- Tanggal Transaksi -->
                                <div class="form-group row">
                                    <label for="tanggal_transaksi" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="{{ \Carbon\Carbon::parse($setoran->tanggal_transaksi)->format('Y-m-d\TH:i') }}" required>
                                    </div>
                                </div>

                                <!-- Nomor HP -->
                                <div class="form-group row">
                                    <label for="nomor_hp" class="col-sm-2 col-form-label">Nomor HP</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" value="{{ $setoran->nomor_hp }}" required>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a href="{{ route('petugas.setoran.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
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
