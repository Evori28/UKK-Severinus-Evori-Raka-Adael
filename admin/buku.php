<?php
session_start();
include "../config/database.php";

// Proteksi admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil semua buku
$result = $conn->query("SELECT * FROM buku ORDER BY id_buku DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Buku</title>
    <link rel="stylesheet" href="../assets/css/admin_buku.css">
</head>
<body>
<h2>Daftar Buku</h2>

<!-- Form tambah buku -->
<h3>Tambah Buku Baru</h3>
<form method="POST" action="buku_proses.php">
    Judul: <input type="text" name="judul" required><br>
    Pengarang: <input type="text" name="pengarang" required><br>
    Penerbit: <input type="text" name="penerbit" required><br>
    Tahun: <input type="number" name="tahun" required><br>
    Stok: <input type="number" name="stok" required><br>
    <button type="submit" name="add">Tambah Buku</button>
</form>

<!-- Tabel buku -->
<h3>Daftar Buku</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php while($buku = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $buku['id_buku'] ?></td>
        <td><?= $buku['judul'] ?></td>
        <td><?= $buku['pengarang'] ?></td>
        <td><?= $buku['penerbit'] ?></td>
        <td><?= $buku['tahun'] ?></td>
        <td><?= $buku['stok'] ?></td>
        <td>
            <a href="buku_edit.php?id=<?= $buku['id_buku'] ?>">Edit</a> | 
            <a href="buku_proses.php?delete=<?= $buku['id_buku'] ?>" onclick="return confirm('Hapus buku?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<p><a href="index.php">Kembali ke Dashboard</a></p>
</body>
</html>
