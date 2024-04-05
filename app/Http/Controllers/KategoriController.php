<?php

namespace App\Http\Controllers;

use App\DataTables\kategoriDataTable;
use App\Http\Requests\StoreKategoriRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori';

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list() {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategori)->addIndexColumn()->addColumn('aksi', function($kategori) {
            $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/kategori/'.$kategori->kategori_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';

            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah Kategori']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(StoreKategoriRequest $request) {
        $validated = $request->validated();

        KategoriModel::create([
            'kategori_kode' => $validated['kategori_kode'],
            'kategori_nama' => $validated['kategori_nama'],
        ]);


        return redirect('/kategori')->with('success', 'Data kategori berhasil ditambahkan!');
    }

    public function edit($id) {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(StoreKategoriRequest $request, $id) {
        $validated = $request->validated();

        KategoriModel::find($id)->update([
            'kategori_kode' => $validated['kategori_kode'],
            'kategori_nama' => $validated['kategori_nama'],
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah!');
    }

    public function destroy($id) {
        $check = KategoriModel::find($id);

        if(!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan!');
        }

        try {
            KategoriModel::destroy($id);

            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus!');
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus! karena masih terdapat tabel lain yang terkait dengan data ini.');
        }
    }
}
