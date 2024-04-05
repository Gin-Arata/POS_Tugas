<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelRequest;
use App\Models\LevelModel;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu]);
    }

    public function list() {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($levels)->addIndexColumn()->addColumn('aksi', function($level) {
            $btn = '<a href="'.url('/level/' . $level->level_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/level/'.$level->level_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';

            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah Level']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level';

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(StoreLevelRequest $request) {
        $validated = $request->validated();

        LevelModel::create([
            'level_kode' => $validated['level_kode'],
            'level_nama' => $validated['level_nama']
        ]);

        return redirect('/level')->with('success', 'Data level berhasil ditambahkan!');
    }

    public function edit($id) {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(StoreLevelRequest $request, $id) {
        $validated = $request->validated();

        LevelModel::find($id)->update([
            'level_kode' => $validated['level_kode'],
            'level_nama' => $validated['level_nama']
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah!');
    }

    public function destroy($id) {
        $check = LevelModel::find($id);

        if(!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan!');
        }

        try {
            LevelModel::destroy($id);

            return redirect('/level')->with('success', 'Data level berhasil dihapus!');
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus! karena masih terdapat tabel lain yang terkait dengan data ini.');
        }
    }
}
