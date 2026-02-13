<?php
session_start();
include "../config/database.php";

// Proteksi halaman admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}


$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';


$sql = "SELECT t.*, u.username, u.nama_lengkap, b.judul 
        FROM transaksi t
        JOIN users u ON t.id_user = u.id_user
        JOIN buku b ON t.id_buku = b.id_buku";

if ($from && $to) {
    $sql .= " WHERE t.tgl_pinjam BETWEEN '$from' AND '$to'";
}

$sql .= " ORDER BY t.id_transaksi DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="../assets/css/admin_laporan.css">
</head>
<body>
<h2>Laporan Transaksi Perpustakaan</h2>

<form method="GET" action="">
    Dari: <input type="date" name="from" value="<?= $from ?>">
    Sampai: <input type="date" name="to" value="<?= $to ?>">
    <button type="submit">Filter</button>
</form>

<table border="1" cellpadding="5">
    <tr>
        <th>ID Transaksi</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Buku</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
    </tr>
    <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_transaksi'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['nama_lengkap'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['tgl_pinjam'] ?></td>
            <td><?= $row['tgl_kembali'] ?? '-' ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Tidak ada transaksi</td>
        </tr>
    <?php endif; ?>
</table>

<p><a href="index.php">Kembali ke Dashboard</a></p>
</body>
</html>
