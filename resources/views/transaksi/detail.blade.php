@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>

        <div class="card-body">
            @empty($detail)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    <p>Data yang Anda cari tidak ditemukan.</p>
                </div>
            @else
            <table class="table table-bordered table-striped table-hover table-sm" id="table_detail">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Total Harga</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
            </table>
            @endempty
            <a href="{{ url('transaksi') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            var dataUser = $('#table_detail').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('/transaksi/'. $detail .'/list') }}",
                    "dataType": "json",
                    "type": "GET"
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "transaksi.penjualan_id",
                    className: "",
                    orderable: false,
                    searchable: true
                }, {
                    data: "barang.barang_nama",
                    className: "",
                    orderable: false,
                    searchable: true
                }, {
                    data: "harga",
                    className: "",
                    orderable: false,
                    searchable: true
                }, {
                    data: "jumlah",
                    className: "",
                    orderable: false,
                    searchable: true
                }]
            });
        });
    </script>
@endpush
