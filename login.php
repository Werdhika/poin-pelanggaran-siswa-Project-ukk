<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <h2>login</h2>
        <form action="/poin_pelanggaran_siswa/process/login.process.php" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" placeholder="Masukkan Username Anda" autocomplete="off" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required><br><br>
            <input type="submit" value="Login">

        </form>
    </center>
</body>

</html>