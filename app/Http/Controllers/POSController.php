<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\m_user;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fungsi eloquent untuk menampilkan data menggunakan pagination
        $useri = DB::table('m_user')->join('m_level', 'm_user.level_id', '=', 'm_level.level_id')->get();
        return view('m_user.index', compact('useri'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('m_user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        // Melakukan validasi data
        $validated = $request->validated();

        // Fungsi eloquent untuk menambah data
        m_user::create($validated);

        return Redirect::to('/user')->with('success', 'User Baru Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, m_user $useri)
    {
        $useri = $useri->findOrFail($id);

        return view('m_user.tampil', compact('useri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $useri = m_user::find($id);

        return view('m_user.edit', compact('useri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();

        // Fungsi eloquent untuk mengupdate data inputan kita
        m_user::findOrFail($id)->update($validated);

        return Redirect::to('/user')->with('success', 'User Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus user berdasarkan id
        m_user::findOrFail($id)->delete();

        return Redirect::to('/user')->with('success', 'User Berhasil Dihapus!');
    }
}
