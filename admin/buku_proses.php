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
    $judul = $conn->real_escape_string($_POST['judul']);
    $pengarang = $conn->real_escape_string($_POST['pengarang']);
    $penerbit = $conn->real_escape_string($_POST['penerbit']);
    $tahun = (int)$_POST['tahun'];
    $stok = (int)$_POST['stok'];

    $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun, stok) 
            VALUES ('$judul', '$pengarang', '$penerbit', $tahun, $stok)";

    if ($conn->query($sql)) {
        header("Location: buku.php");
        exit;
    } else {
        die("Gagal menambah buku: " . $conn->error);
    }
}
// Update buku
if (isset($_POST['update'])) {
    $id_buku = (int)$_POST['id_buku'];
    $judul = $conn->real_escape_string($_POST['judul']);
    $pengarang = $conn->real_escape_string($_POST['pengarang']);
    $penerbit = $conn->real_escape_string($_POST['penerbit']);
    $tahun = (int)$_POST['tahun'];
    $stok = (int)$_POST['stok'];

    $sql = "UPDATE buku SET 
                judul='$judul',
                pengarang='$pengarang',
                penerbit='$penerbit',
                tahun=$tahun,
                stok=$stok
            WHERE id_buku='$id_buku'";

    if ($conn->query($sql)) {
        header("Location: buku.php");
        exit;
    } else {
        die("Gagal update buku: " . $conn->error);
    }
}

// Hapus buku
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $sql = "DELETE FROM buku WHERE id_buku='$id'";
    if ($conn->query($sql)) {
        header("Location: buku.php");
        exit;
    } else {
        die("Gagal menghapus buku: " . $conn->error);
    }
}
?>
