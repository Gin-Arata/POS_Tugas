@extends('adminlte::page')

@section('title', 'Form User')

@section('content_header')
    <h1>Form User</h1>
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Form User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>Pilih Level User</label>
                            <select class="form-control">
                                <option>Admin</option>
                                <option>Manager</option>
                                <option>Staff</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
