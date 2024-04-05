<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';

        $level = LevelModel::all();

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level ,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request) {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');

        if($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)->addIndexColumn()->addColumn('aksi', function($user) {
            $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/user/'.$user->user_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';

            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah User']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(StoreUserRequest $request) {
        $validated = $request->validated();

        UserModel::create([
            'username' => $validated['username'],
            'nama' => $validated['nama'],
            'password' => bcrypt($validated['password']),
            'level_id' => $validated['level_id']
        ]);


        return redirect('/user')->with('success', 'Data user berhasil ditambahkan!');
    }

    public function show($id) {
        $userDetail = UserModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail User']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'user';

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $userDetail, 'activeMenu' => $activeMenu]);
    }

    public function edit($id) {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User'
        ];

        $activeMenu = 'user';

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(StoreUserRequest $request, $id) {
        $validated = $request->validated();

        UserModel::find($id)->update([
            'username' => $validated['username'],
            'nama' => $validated['nama'],
            'password' => bcrypt($validated['password']),
            'level_id' => $validated['level_id']
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah!');
    }

    public function destroy($id) {
        $check = UserModel::find($id);

        if(!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan!');
        }

        try {
            UserModel::destroy($id);

            return redirect('/user')->with('success', 'Data user berhasil dihapus!');
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Data user gagal dihapus! karena masih terdapat tabel lain yang terkait dengan data ini.');
        }
    }

    public function tambah() {
        return view('user.tambah');
    }

    public function tambahSimpan(Request $request) {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->levelID
        ]);

        return redirect('/user');
    }

    public function ubah($id) {
        $user = UserModel::find($id);
        return view('user.ubah', ['data' => $user]);
    }

    public function ubahSimpan($id) {
        $user = UserModel::find($id);

        $user->username = request('username');
        $user->nama = request('nama');
        $user->password = Hash::make(request('password'));
        $user->level_id = request('levelID');

        $user->save();

        return redirect('/user');
    }

    public function hapus($id) {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }

    public function form() {
        return view('form.user');
    }
}
