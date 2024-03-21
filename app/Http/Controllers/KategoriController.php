<?php

namespace App\Http\Controllers;

use App\DataTables\kategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(kategoriDataTable $dataTable) {
        return $dataTable->render('kategori.index');
    }

    public function create() {
        return view('kategori.create');
    }

    public function store(Request $request) {
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori
        ]);
        return redirect('/kategori');
    }

    public function edit($id) {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ["data" => $kategori]);
    }

    public function edit_simpan($id, Request $request) {
        KategoriModel::where('kategori_id', $id)->update([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori
        ]);

        return redirect('/kategori');
    }

    public function delete($id) {
        KategoriModel::where('kategori_id', $id)->delete();
        return redirect('/kategori');
    }
}
