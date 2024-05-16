<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload() {
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request) {
        // return "Pemrosesan file upload di sini";
        // dump($request->berkas);

        $request->validate([
            'berkas' => 'required|file|image|max:5000',
        ]);

        if($request->has('namaFile')) {
            $namaFile = $request->namaFile . "." . $request->berkas->getClientOriginalExtension();
            $path = $request->berkas->storeAs('public', $namaFile);
        } else {
            $namaFile = "web-" . time() . "." . $request->berkas->getClientOriginalExtension();
            $path = $request->berkas->storeAs('public', $namaFile);
        }

        // $namaFile = $request->berkas->getClientOriginalName();

        // $path = $request->berkas->move('gambar', $namaFile);
        // $path = str_replace("\\", "//", $path);
        // echo "Variabel path berisi: $path <br>";

        // $pathBaru = asset('public/' . $namaFile);
        echo "Proses file upload berhasil. File tersimpan di: $path";
        echo "<br>";
        echo "Gambar :<br> <img src='storage/$namaFile' alt='Foto User' width='100'>";
    }
}
