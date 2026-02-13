<?php
session_start();
include "../config/database.php";

// Proteksi admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

// Tambah buku baru
if (isset($_POST['add'])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun, stok) 
            VALUES ('$judul', '$pengarang', '$penerbit', '$tahun', '$stok')";

    if ($conn->query($sql)) {
        header("Location: buku.php");
        exit;
    } else {
        echo "Gagal menambah buku: " . $conn->error;
    }
}

// Hapus buku
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM buku WHERE id_buku='$id'");
    header("Location: buku.php");
    exit;
}
?>
