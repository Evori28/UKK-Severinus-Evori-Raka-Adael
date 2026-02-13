<?php
include "../middleware/auth.php";
checkAdmin();
?>

<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/admin_dashboard.css">
</head>

<h2>Dashboard Admin</h2>
<p>Selamat datang, <?php echo $_SESSION['admin']['nama_lengkap']; ?></p>
<a href="buku.php">Buku</a> | 
<a href="anggota.php">Anggota</a> | 
<a href="transaksi.php">Transaksi</a> | 
<a href="laporan.php">Laporan</a> | 
<a href="../logout.php">Logout</a>

<div class="profile-card">
    <h3>Data Pembuat Website</h3>
    <div class="profile-content">
        <p><strong>Nama:</strong> Severinus Evori Raka Adael</p>
        <p><strong>Kelas:</strong> XII RPL</p>
        <p><strong>Sekolah:</strong> SMK Tamansiswa Jetis Yogyakarta</p>
        <p><strong>Jurusan:</strong> Rekayasa Perangkat Lunak</p>
        <p><strong>Tahun:</strong> 2026</p>
        <p><strong>Deskripsi:</strong> Website Sistem Informasi Perpustakaan berbasis PHP & MySQL.</p>
    </div>
</div>

