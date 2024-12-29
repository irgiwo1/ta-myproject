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

            <!-- Flash message for success -->
            @if (session('success'))
                <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Button to add user -->
            <div class="row mb-4">
                <div class="col-sm-12 text-right">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success">Tambah User</a>
                </div>
            </div>

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
                                    <th>Actions</th>
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
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->id_user) }}" class="btn btn-warning">Edit</a>
                                        </td>
                                        {{-- <td>
                                            <!-- Button Delete -->
                                            <form action="{{ route('admin.users.destroy', $user->id_user) }}" method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td> --}}
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

@section('scripts')
<script>
    // Hapus flash message setelah 5 detik
    setTimeout(function() {
        let flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.classList.remove('show'); // Hilangkan efek "show" bootstrap
            setTimeout(() => flashMessage.remove(), 500); // Hapus elemen dari DOM
        }
    }, 5000); // Timer 5 detik
</script>
@endsection
