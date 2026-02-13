<?php
session_start();
include "../config/database.php";

// Proteksi login siswa
if (!isset($_SESSION['siswa'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['kembali'])) {
    $id_transaksi = (int)$_POST['id_transaksi'];

    // Ambil transaksi
    $transaksi = $conn->query("SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi")->fetch_assoc();
    if (!$transaksi) {
        die("Transaksi tidak ditemukan.");
    }

    // Pastikan transaksi milik user yang login dan status masih 'dipinjam'
    if ($transaksi['id_user'] != $_SESSION['siswa']['id_user']) {
        die("Akses ditolak.");
    }
    if ($transaksi['status'] != 'dipinjam') {
        die("Buku sudah dikembalikan.");
    }

    $tgl_kembali = date('Y-m-d');

    // Update transaksi jadi 'dikembalikan' dan isi tanggal kembali
    $sqlUpdate = "UPDATE transaksi SET status = 'dikembalikan', tgl_kembali = '$tgl_kembali' WHERE id_transaksi = $id_transaksi";
    if ($conn->query($sqlUpdate)) {
        // Tambah stok buku
        $conn->query("UPDATE buku SET stok = stok + 1 WHERE id_buku = " . $transaksi['id_buku']);
        header("Location: kembali.php");
        exit;
    } else {
        die("Gagal proses pengembalian: " . $conn->error);
    }
} else {
    header("Location: kembali.php");
    exit;
}
?>
