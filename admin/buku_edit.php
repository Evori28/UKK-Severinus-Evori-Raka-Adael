<?php
session_start();
include "../config/database.php";

// Proteksi admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil ID buku dari URL
if (!isset($_GET['id'])) {
    header("Location: buku.php");
    exit;
}

$id = (int)$_GET['id'];

// Ambil data buku
$result = $conn->query("SELECT * FROM buku WHERE id_buku='$id'");
if ($result->num_rows == 0) {
    die("Buku tidak ditemukan!");
}
$buku = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../assets/css/admin_edit_buku.css">
</head>
<body>
<h2>Edit Buku</h2>

<form method="POST" action="buku_proses.php">
    <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
    Judul: <input type="text" name="judul" value="<?= $buku['judul'] ?>" required><br>
    Pengarang: <input type="text" name="pengarang" value="<?= $buku['pengarang'] ?>" required><br>
    Penerbit: <input type="text" name="penerbit" value="<?= $buku['penerbit'] ?>" required><br>
    Tahun: <input type="number" name="tahun" value="<?= $buku['tahun'] ?>" required><br>
    Stok: <input type="number" name="stok" value="<?= $buku['stok'] ?>" required><br>
    <button type="submit" name="update">Update Buku</button>
</form>

<p><a href="buku.php">Kembali ke Daftar Buku</a></p>
</body>
</html>
