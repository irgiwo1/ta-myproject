@extends('layouts.admin')

@section('content')

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add New User</h4>
                    <span class="ml-1">Create a new user with necessary details.</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add User</a></li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="admin">Admin</option>
                                    <option value="pengawas">Pengawas</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="foto">Profile Photo</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="nomor_hp">Phone Number</label>
                                <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="id_lokasi">Location</label>
                                <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                                    @foreach ($lokasi as $loc)
                                        <option value="{{ $loc->id_lokasi }}">{{ $loc->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Save User</button>
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
