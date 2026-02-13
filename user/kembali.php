<?php
session_start();
include "../config/database.php";

// Proteksi login siswa
if (!isset($_SESSION['siswa'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['siswa']['id_user'];

// Ambil transaksi buku yang statusnya 'dipinjam' untuk user ini
$sql = "SELECT t.id_transaksi, b.judul FROM transaksi t 
        JOIN buku b ON t.id_buku = b.id_buku
        WHERE t.id_user = $id_user AND t.status = 'dipinjam'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/siswa_kembali.css">
    <title>Pengembalian Buku</title>
</head>
<body>
<h2>Pengembalian Buku</h2>

<?php if ($result->num_rows > 0): ?>
<table border="1" cellpadding="5">
    <tr>
        <th>ID Transaksi</th>
        <th>Buku</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id_transaksi'] ?></td>
        <td><?= htmlspecialchars($row['judul']) ?></td>
        <td>
            <form method="POST" action="kembali_proses.php" style="margin:0;">
                <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi'] ?>">
                <button type="submit" name="kembali" onclick="return confirm('Konfirmasi pengembalian?')">Kembalikan</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
<p>Tidak ada buku yang sedang dipinjam.</p>
<?php endif; ?>

<p><a href="index.php">Kembali ke Dashboard</a></p>
</body>
</html>
