<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StokModel;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index() {
        return StokModel::all();
    }

    public function store(Request $request) {
        $stok = StokModel::create($request->all());
        return response()->json($stok, 201);
    }

    public function show(StokModel $stok) {
        return StokModel::find($stok);
    }

    public function update(Request $request, StokModel $stok) {
        $stok->update($request->all());
        return StokModel::find($stok);
    }

    public function destroy(StokModel $stok) {
        $stok->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}
