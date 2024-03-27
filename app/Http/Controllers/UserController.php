<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $user = UserModel::with('level')->get();
        // return view('user.index', [
        //     "id" => $userId,
        //     "name" => $nameUser
        // ]);

        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];

        // $user = UserModel::create($data);

        // $user = UserModel::find(1);

        // $user = UserModel::findOr(5, ['username', 'nama'], function() {
        //     abort(404);
        // });

        // $user = UserModel::findOrFail(5);

        // $user = UserModel::where('username', 'manager9')->firstOrFail();

        // $user = UserModel::where('level_id', 2)->count();

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        // );

        // $user = UserModel::firstOrNew ([
        //     'username' => 'manager33',
        //     'nama' => 'Manager Tiga TIga',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ]);
        // $user->save();

        // $user = UserModel::create([
        //     'username' => 'manager55',
        //     'nama' => 'Manager55',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ]);

        // $user -> username = 'manager56';

        // $user->isDirty();
        // $user->isDirty('username');
        // $user->isDirty('nama');
        // $user->isDirty(['nama', 'username']);

        // $user->isClean();
        // $user->isClean('username');
        // $user->isClean('nama');
        // $user->isClean(['username', 'nama']);

        // $user->save();

        // $user->isDirty();
        // $user->isClean();

        // dd($user->isDirty());

        // $user = UserModel::create([
        //     'username' => 'manager11',
        //     'nama' => 'Manager11',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ]);

        // $user -> username = 'manager12';

        // $user->save();

        // $user->wasChanged();
        // $user->wasChanged('username');
        // $user->wasChanged(['username', 'level_id']);
        // $user->wasChanged('nama');
        // dd($user->wasChanged(['nama', 'username']));

        // $user = UserModel::all();
        return view('user.index', ['datas' => $user]);
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
