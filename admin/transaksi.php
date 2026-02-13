<?php
session_start();
include "../config/database.php";

// Proteksi admin
$keyword = isset($_GET['keyword']) ? $conn->real_escape_string($_GET['keyword']) : '';
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil semua transaksi
$sql = "SELECT t.*, u.username, u.nama_lengkap, b.judul
        FROM transaksi t
        JOIN users u ON t.id_user = u.id_user
        JOIN buku b ON t.id_buku = b.id_buku
        WHERE 1=1";

if (!empty($keyword)) {
    $sql .= " AND (
        u.username LIKE '%$keyword%' OR
        u.nama_lengkap LIKE '%$keyword%' OR
        b.judul LIKE '%$keyword%' OR
        t.status LIKE '%$keyword%' OR
        t.tgl_pinjam LIKE '%$keyword%'
    )";
}

$sql .= " ORDER BY t.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="../assets/css/admin_transaksi.css">
</head>
<body>
<h2>Daftar Transaksi Perpustakaan</h2>
<form method="GET" action="" style="margin-bottom:20px;">
    <input type="text" name="keyword"
           placeholder="Cari username, nama, buku, status..."
           value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
    <button type="submit">Cari</button>
    <a href="transaksi.php">Reset</a>
</form>


<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
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
    <td colspan="7">Data transaksi tidak ditemukan</td>
</tr>
<?php endif; ?>
</table>

<p><a href="index.php">Kembali ke Dashboard</a></p>
</body>
</html>
