<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
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

        $user = UserModel::findOr(5, ['username', 'nama'], function() {
            abort(404);
        });

        return view('user.index', ['data' => $user]);
    }
}
