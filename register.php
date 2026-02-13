<?php
session_start();
if (isset($_SESSION['siswa'])) {
    header("Location: user/index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Siswa</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
<h2>Register</h2>
<form action="proses/register_proses.php" method="POST">
    Nama Lengkap: <input type="text" name="nama_lengkap" required><br>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Kelas: <input type="text" name="kelas"><br>
    <button type="submit">Register</button>
</form>
</body>
</html>
