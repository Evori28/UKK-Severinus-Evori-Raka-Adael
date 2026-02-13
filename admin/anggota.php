<?php
session_start();
include "../config/database.php";

// Proteksi halaman admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

// Tambah anggota baru
if (isset($_POST['add'])) {
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $kelas = $_POST['kelas'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek username
    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($check->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $conn->query("INSERT INTO users (username, password, nama_lengkap, role, kelas) 
                      VALUES ('$username', '$password', '$nama_lengkap', 'siswa', '$kelas')");
        $success = "Anggota berhasil ditambahkan!";
    }
}

// Hapus anggota
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id_user='$id' AND role='siswa'");
    header("Location: anggota.php");
    exit;
}

// Ambil semua anggota
$result = $conn->query("SELECT * FROM users WHERE role='siswa' ORDER BY id_user DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Anggota</title>
    <link rel="stylesheet" href="../assets/css/admin_anggota.css">
</head>
<body>
<h2>Data Anggota</h2>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

<!-- Form tambah anggota -->
<h3>Tambah Anggota</h3>
<form method="POST" action="">
    Username: <input type="text" name="username" required><br>
    Nama Lengkap: <input type="text" name="nama_lengkap" required><br>
    Kelas: <input type="text" name="kelas" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="add">Tambah Anggota</button>
</form>

<!-- Tabel anggota -->
<h3>Daftar Anggota</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Nama Lengkap</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id_user'] ?></td>
        <td><?= $row['username'] ?></td>
        <td><?= $row['nama_lengkap'] ?></td>
        <td><?= $row['kelas'] ?></td>
        <td>
            <a href="anggota_edit.php?id=<?= $row['id_user'] ?>">Edit</a> | 
            <a href="anggota.php?delete=<?= $row['id_user'] ?>" onclick="return confirm('Hapus anggota?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<p><a href="index.php">Kembali ke Dashboard</a></p>
</body>
</html>
