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
                        <h4>Manajemen Pengguna</h4>
                        <span class="ml-1">Di sini Anda dapat mengelola data pengguna</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active">User Managemen</li>
                    </ol>
                </div>
            </div>

            <!-- Button to add user -->
            {{-- <div class="row mb-4">
                <div class="col-sm-12 text-right">
                    <a href="{{ route('users.create') }}" class="btn btn-success">Tambah User</a>
                </div>
            </div> --}}

            <!-- Table displaying users -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Nomer Hp</th>
                                    <th>Role</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->fullname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nomor_hp }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->lokasi ? $user->lokasi->nama_lokasi : 'N/A' }}</td> <!-- Display location name -->
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection
