<?php
include "../middleware/auth.php";
checkUser();
?>

<head>
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="../assets/css/user_dashboard.css">
</head>

<body>
<div class="dashboard-container">
    <h2>Dashboard Siswa</h2>
    <p>Selamat datang, <?php echo $_SESSION['siswa']['nama_lengkap']; ?></p>

    <div class="nav-menu">
        <a href="buku.php">Buku</a>
        <a href="kembali.php">Kembali</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="../logout.php">Logout</a>
    </div>

    <!-- Profile Card -->
    <div class="profile-card">
        <h3>Data Diri Siswa</h3>
        <p><strong>Nama:</strong> <?php echo $_SESSION['siswa']['nama_lengkap']; ?></p>
        <p><strong>Username:</strong> <?php echo $_SESSION['siswa']['username']; ?></p>
        <p><strong>Kelas:</strong> <?php echo $_SESSION['siswa']['kelas']; ?></p>
        <p><strong>Status:</strong> Aktif</p>
    </div>

    <!-- Info Card -->
    <div class="info-card">
        <h3>Informasi</h3>
        <p>Selamat datang di Sistem Informasi Perpustakaan.</p>
        <p>Silakan gunakan menu di atas untuk meminjam, mengembalikan, atau melihat riwayat buku.</p>
    </div>

</div>
</body>


