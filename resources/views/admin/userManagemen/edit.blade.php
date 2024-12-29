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
                    <h4>Edit User</h4>
                    <span class="ml-1">Update the user's details below.</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit User</a></li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Menggunakan metode PUT untuk update -->

                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" value="{{ old('fullname', $user->fullname) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password (Leave blank to keep current)</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="pengawas" {{ $user->role == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="foto">Profile Photo</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="nomor_hp">Phone Number</label>
                                <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" value="{{ old('nomor_hp', $user->nomor_hp) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="id_lokasi">Location</label>
                                <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                                    @foreach ($lokasi as $loc)
                                        <option value="{{ $loc->id_lokasi }}" {{ $loc->id_lokasi == $user->id_lokasi ? 'selected' : '' }}>
                                            {{ $loc->nama_lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Update User</button>
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
