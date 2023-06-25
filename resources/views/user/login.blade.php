<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/login" method="post">
        @csrf
        <input type="text" name="id_pengguna">
        <input type="password" name="pin">
        <button type="submit">Login</button>
    </form>
</body>
</html>