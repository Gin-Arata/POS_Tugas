<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori ,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request) {
        $barang = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual' ,'kategori_id', 'gambar_barang')->with('kategori');

        if($request->kategori_id) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barang)->addIndexColumn()->addColumn('aksi', function($barang) {
            $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/barang/'.$barang->barang_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';

            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah Barang']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $kategori = KategoriModel::all();
        $activeMenu = 'barang';

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function store(StoreBarangRequest $request) {
        $validated = $request->validated();

        $namaFile = "web-" . time() . "." . $request->file('gambar_barang')->getClientOriginalExtension();
        $request->file('gambar_barang')->storeAs('public', $namaFile);

        BarangModel::create([
            'barang_kode' => $validated['barang_kode'],
            'barang_nama' => $validated['barang_nama'],
            'harga_beli' => $validated['harga_beli'],
            'harga_jual' => $validated['harga_jual'],
            'gambar_barang' => $namaFile,
            'kategori_id' => $validated['kategori_id']
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil ditambahkan!');
    }

    public function show($id) {
        $barangDetail = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail Barang']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barangDetail, 'activeMenu' => $activeMenu]);
    }

    public function edit($id) {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(StoreBarangRequest $request, $id) {
        $validated = $request->validated();

        BarangModel::find($id)->update([
            'barang_kode' => $validated['barang_kode'],
            'barang_nama' => $validated['barang_nama'],
            'harga_beli' => $validated['harga_beli'],
            'harga_jual' => $validated['harga_jual'],
            'kategori_id' => $validated['kategori_id']
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah!');
    }

    public function destroy($id) {
        $check = BarangModel::find($id);

        if(!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan!');
        }

        try {
            BarangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus!');
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus! karena masih terdapat tabel lain yang terkait dengan data ini.');
        }
    }
}
