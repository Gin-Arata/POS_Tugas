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

class KategoriController extends Controller
{
    public function index(kategoriDataTable $dataTable) {
        return $dataTable->render('kategori.index');
    }

    public function create(): View {
        return view('kategori.create');
    }

    public function store(StoreKategoriRequest $request): RedirectResponse {
        // Old Validate Method
        // $validated = $request->validate([
        //     'kodeKategori' => 'bail|required|max:10',
        //     'namaKategori' => 'bail|required'
        // ]);

        // Retrieve the validated input data
        $validated = $request->validated(); // Digunakan untuk mengambil data yang divalidasi

        // Retrieve a portion of the validated input data
        $validated = $request->safe()->only(['kodeKategori', 'namaKategori']); // Digunakan untuk mengambil data yang dipilih
        // $validated = $request->safe()->except(['kodeKategori', 'namaKategori']); // Digunakan untuk mengambil data yang tidak dipilih pada method except

        KategoriModel::create([
            'kategori_kode' => $validated['kodeKategori'],
            'kategori_nama' => $validated['namaKategori']
        ]);

        return Redirect::to('/kategori');
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
