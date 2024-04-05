<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStokRequest;
use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\UserModel;
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
            $btn = '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/stok/'.$stok->stok_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';

            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah Stok']
        ];

        $page = (object) [
            'title' => 'Tambah Stok baru'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();
        $activeMenu = 'stok';

        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'users' => $user ,'activeMenu' => $activeMenu]);
    }

    public function store(StoreStokRequest $request) {
        $validated = $request->validated();

        StokModel::create([
            'barang_id' => $validated['barang_id'],
            'user_id' => $validated['user_id'],
            'stok_tanggal' => $validated['stok_tanggal'],
            'stok_jumlah' => $validated['stok_jumlah']
        ]);


        return redirect('/stok')->with('success', 'Data stok berhasil ditambahkan!');
    }

    public function edit($id) {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Stok'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'users' => $user, 'barang' => $barang, 'stok' => $stok ,'activeMenu' => $activeMenu]);
    }

    public function update(StoreStokRequest $request, $id) {
        $validated = $request->validated();

        StokModel::find($id)->update([
            'barang_id' => $validated['barang_id'],
            'user_id' => $validated['user_id'],
            'stok_tanggal' => $validated['stok_tanggal'],
            'stok_jumlah' => $validated['stok_jumlah']
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah!');
    }

    public function destroy($id) {
        $check = StokModel::find($id);

        if(!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan!');
        }

        try {
            StokModel::destroy($id);

            return redirect('/stok')->with('success', 'Data stok berhasil dihapus!');
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus! karena masih terdapat tabel lain yang terkait dengan data ini.');
        }
    }
}
