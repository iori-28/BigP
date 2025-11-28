<!DOCTYPE html>
<html>

<head>
    <title>TES Register</title>
</head>

<body>

    <h2>TES Register</h2>

    <form action="api/auth.php?action=register" method="POST">
        <input type="text" name="nama" placeholder="Nama" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Daftar</button>
    </form>

</body>

</html>