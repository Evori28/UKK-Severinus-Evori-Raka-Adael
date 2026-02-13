<?php
session_start();
include "../config/database.php";

// Proteksi login siswa
if (!isset($_SESSION['siswa'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['pinjam'])) {
    $id_user = $_SESSION['siswa']['id_user'];
    $id_buku = (int)$_POST['id_buku'];
    $tgl_pinjam = date('Y-m-d');

    // Cek stok buku
    $cekStok = $conn->query("SELECT stok FROM buku WHERE id_buku = $id_buku")->fetch_assoc();
    if (!$cekStok || $cekStok['stok'] < 1) {
        die("Buku tidak tersedia.");
    }

    // Cek apakah user sudah meminjam buku ini dan belum dikembalikan
    $cekTransaksi = $conn->query("SELECT * FROM transaksi WHERE id_user = $id_user AND id_buku = $id_buku AND status = 'dipinjam'");
    if ($cekTransaksi->num_rows > 0) {
        die("Anda sudah meminjam buku ini dan belum mengembalikannya.");
    }

    // Masukkan transaksi peminjaman
    $sql = "INSERT INTO transaksi (id_buku, id_user, tgl_pinjam, status) VALUES ($id_buku, $id_user, '$tgl_pinjam', 'dipinjam')";
    if ($conn->query($sql)) {
        // Kurangi stok buku
        $conn->query("UPDATE buku SET stok = stok - 1 WHERE id_buku = $id_buku");
        header("Location: riwayat.php");
        exit;
    } else {
        die("Gagal meminjam buku: " . $conn->error);
    }
} else {
    header("Location: buku.php");
    exit;
}
?>
