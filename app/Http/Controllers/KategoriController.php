<?php

namespace App\Http\Controllers;

use App\DataTables\kategoriDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(kategoriDataTable $dataTable) {
        return $dataTable->render('kategori.index');
    }
}
