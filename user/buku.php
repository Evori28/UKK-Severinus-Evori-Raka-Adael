<?php
session_start();
include "../config/database.php";

// Proteksi login siswa
if (!isset($_SESSION['siswa'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['siswa']['id_user'];

// Ambil data buku yang stoknya masih ada (>0)
$keyword = isset($_GET['keyword']) ? $conn->real_escape_string($_GET['keyword']) : '';

$sql = "SELECT * FROM buku WHERE stok > 0";

if (!empty($keyword)) {
    $sql .= " AND (
        judul LIKE '%$keyword%' OR
        pengarang LIKE '%$keyword%' OR
        penerbit LIKE '%$keyword%' OR
        tahun LIKE '%$keyword%'
    )";
}

$sql .= " ORDER BY id_buku DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="../assets/css/siswa_buku.css">
</head>
<body>
<h2>Daftar Buku</h2>
<form method="GET" action="" style="margin-bottom:20px;">
    <input type="text" name="keyword" 
           placeholder="Cari judul, pengarang, penerbit, tahun..." 
           value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
    <button type="submit">Cari</button>
    <a href="buku.php">Reset</a>
</form>

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
        <td><?= htmlspecialchars($buku['judul']) ?></td>
        <td><?= htmlspecialchars($buku['pengarang']) ?></td>
        <td><?= htmlspecialchars($buku['penerbit']) ?></td>
        <td><?= $buku['tahun'] ?></td>
        <td><?= $buku['stok'] ?></td>
        <td>
            <form method="POST" action="pinjam.php" style="margin:0;">
                <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
                <button type="submit" name="pinjam" onclick="return confirm('Pinjam buku ini?')">Pinjam</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<p><a href="index.php">Kembali ke Dashboard</a></p>
</body>
</html>