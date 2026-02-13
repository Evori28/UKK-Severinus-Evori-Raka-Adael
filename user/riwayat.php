<?php
session_start();
include "../config/database.php";

// Proteksi halaman siswa
if (!isset($_SESSION['siswa'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['siswa']['id_user'];

$sql = "SELECT t.*, b.judul 
        FROM transaksi t 
        JOIN buku b ON t.id_buku = b.id_buku 
        WHERE t.id_user = '$id_user'";

if (!empty($keyword)) {
    $sql .= " AND (
        b.judul LIKE '%$keyword%' OR
        t.status LIKE '%$keyword%' OR
        t.tgl_pinjam LIKE '%$keyword%'
    )";
}

$sql .= " ORDER BY t.tgl_pinjam DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Peminjaman</title>
    <link rel="stylesheet" href="../assets/css/siswa_riwayat.css">
</head>
<body>
<h2>Riwayat Peminjaman Buku</h2>
<form method="GET" action="" style="margin-bottom:20px;">
    <input type="text" name="keyword"
           placeholder="Cari judul, status, tanggal..."
           value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
    <button type="submit">Cari</button>
    <a href="riwayat.php">Reset</a>
</form>

<table>
    <tr>
        <th>ID Transaksi</th>
        <th>Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>

    <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_transaksi'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['tgl_pinjam'] ?></td>
            <td><?= $row['tgl_kembali'] ?? '-' ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Belum ada riwayat peminjaman</td>
        </tr>
    <?php endif; ?>
</table>

<p><a href="index.php">Kembali ke Dashboard</a></p>
</body>
</html>
