<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Transaksi',
            'list' => ['Home', 'Transaksi']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'transaksi';

        return view('transaksi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list() {
        $transaksi = TransaksiModel::select('penjualan_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal' ,'user_id')->with('user');

        return DataTables::of($transaksi)->addIndexColumn()->addColumn('aksi', function($transaksi) {
            $btn = '<a href="'.url('/transaksi/' . $transaksi->penjualan_id).'/detail" class="btn btn-info btn-sm">Detail</a> ';

            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function detail($id) {
        $breadcrumb = (object) [
            'title' => 'Detail Transaksi',
            'list' => ['Home', 'Transaksi', 'Detail Transaksi']
        ];

        $page = (object) [
            'title' => 'Detail transaksi'
        ];

        $activeMenu = 'transaksi';

        return view('transaksi.detail', ['breadcrumb' => $breadcrumb, 'page' => $page, 'detail' => $id ,'activeMenu' => $activeMenu]);
    }

    public function detailList($id) {
        $transaksiDetail = TransaksiDetailModel::select('detail_id', 'penjualan_id', 'barang_id', 'harga', 'jumlah')->where('penjualan_id', $id)->with('barang', 'transaksi');

        return DataTables::of($transaksiDetail)->addIndexColumn()->make(true);
    }
}
