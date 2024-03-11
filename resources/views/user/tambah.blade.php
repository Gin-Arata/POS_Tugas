<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>Form Tambah Data User</h1>
    <form action="/user/tambah_simpan" method="post">
        {{ csrf_field() }}  

        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Masukkan Username">
        <br>

        <label for="nama">Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama">
        <br>

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Masukkan Password">
        <br>

        <label for="levelID">Level ID</label>
        <input type="number" name="levelID" placeholder="Masukkan Level ID">
        <br><br>

        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>

</html>
