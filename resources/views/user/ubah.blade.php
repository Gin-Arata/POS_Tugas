<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Data User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>Form Ubah Data User</h1>
    <form action="/user/ubah_simpan/{{ $data->user_id }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label for="username">Username</label>
        <input type="text" name="username" value="{{ $data->username }}">
        <br>

        <label for="nama">Nama</label>
        <input type="text" name="nama" value="{{ $data->nama }}">
        <br>

        <label for="password">Password</label>
        <input type="password" name="password" value="{{ $data->password }}">
        <br>

        <label for="levelID">Level ID</label>
        <input type="number" name="levelID" value="{{ $data->level_id }}">
        <br><br>

        <input type="submit" class="btn btn-success" value="Ubah">
    </form>
</body>

</html>
