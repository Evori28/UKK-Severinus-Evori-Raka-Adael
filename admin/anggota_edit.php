<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id_user='$id' AND role='siswa'");
$user = $result->fetch_assoc();

if (!$user) {
    die("Anggota tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $kelas = $_POST['kelas'];

    // Update password jika diisi
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET username='$username', nama_lengkap='$nama_lengkap', kelas='$kelas', password='$password' WHERE id_user='$id'");
    } else {
        $conn->query("UPDATE users SET username='$username', nama_lengkap='$nama_lengkap', kelas='$kelas' WHERE id_user='$id'");
    }
    header("Location: anggota.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
</head>
<body>
<h2>Edit Anggota</h2>
<form method="POST" action="">
    Username: <input type="text" name="username" value="<?= $user['username'] ?>" required><br>
    Nama Lengkap: <input type="text" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?>" required><br>
    Kelas: <input type="text" name="kelas" value="<?= $user['kelas'] ?>" required><br>
    Password (kosongkan jika tidak ingin diubah): <input type="password" name="password"><br>
    <button type="submit" name="update">Update</button>
</form>
<p><a href="anggota.php">Kembali ke daftar anggota</a></p>
</body>
</html>
