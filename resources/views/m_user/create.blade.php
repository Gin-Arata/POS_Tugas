@extends('m_user.template')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Membuat Daftar User</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="/m_user">Kembali</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops</strong> Input gagal<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/m_user" method="POST">
        @csrf
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Username:</strong>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama:</strong>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama"></input>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!-- select -->
                <div class="form-group">
                    <label>Pilih Level User</label>
                    <select name="level_id" class="form-control">
                        <option value="1">Admin</option>
                        <option value="2">Manager</option>
                        <option value="3">Staff</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
