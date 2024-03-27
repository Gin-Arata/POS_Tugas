@extends('adminlte::page')

@section('title', 'Form Level')

@section('content_header')
    <h1>Form Level</h1>
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Form Level</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Kode Level</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama Level</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
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
