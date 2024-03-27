@extends('m_user.template')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>CRUD user</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="/m_user/tambah">Input User</a>
            </div>
        </div>
    </div>
    {{-- Untuk Mengambil variabel compact jika success akan menampilkan pesan sukses --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-dark">
        <tr class="table-light">
            <th width="20px" class="text-center">User ID</th>
            <th width="150px" class="text-center">Level ID</th>
            <th width="200px" class="text-center">Username</th>
            <th width="200px" class="text-center">Nama</th>
            <th width="150px" class="text-center">Password</th>
            <th width="150px" class="text-center">Aksi</th>
        </tr>

        @foreach ($useri as $user)
            <tr>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->level_nama }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->password }}</td>
                <td class="text-center">
                    <form method="POST" action="/m_user/hapus/{{ $user->user_id }}">
                        <a href="/m_user/tampil/{{ $user->user_id }}" class="btn btn-warning btn-sm">Show</a>
                        <a href="/m_user/ubah/{{ $user->user_id }}" class="btn btn-primary btn-sm">Edit</a>
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah anda yakin ingin menghapus user {{ $user->username }}?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
