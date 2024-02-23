<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($userId, $nameUser) {
        return view('user.index', [
            "id" => $userId,
            "name" => $nameUser
        ]);
    }
}
