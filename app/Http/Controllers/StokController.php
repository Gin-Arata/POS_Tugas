<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StokController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok';

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list() {
        $stok = StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')->with('barang', 'user');

        return DataTables::of($stok)->addIndexColumn()->addColumn('aksi', function($stok) {
            $btn = '<a href="'.url('/barang/' . $stok->stok_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/barang/'.$stok->stok_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';

            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }
}
