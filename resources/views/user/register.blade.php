<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/register" method="post">
        @csrf
        <input type="text" name="name" placeholder="Nama">
        <input type="text" name="id_pengguna" placeholder="ID Pengguna">
        <input type="password" name="pin" placeholder="PIN">
        <button type="submit">Register</button>
    </form>
</body>
</html>