<!DOCTYPE html>
<html>
<head>
    <title>Login Perpustakaan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<body>

<div class="main-container">

    <div class="creator-info">
        <h3>Tentang Website</h3>
        <p><strong>Nama Pembuat:</strong> Raka Pratama</p>
        <p><strong>Kelas:</strong> XII RPL 2</p>
        <p><strong>Sekolah:</strong> SMK Negeri 1</p>
        <p><strong>Jurusan:</strong> Rekayasa Perangkat Lunak</p>
        <p><strong>Tahun:</strong> 2025</p>
        <p>Website ini dibuat sebagai proyek Sistem Informasi Perpustakaan berbasis PHP & MySQL.</p>
    </div>

    <div class="login-box">
        <div class="login-container">
        <h2>Login</h2>
        <form action="proses/login_proses.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="siswa">Siswa</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Register</a></p>
</div>

</body>
</html>
