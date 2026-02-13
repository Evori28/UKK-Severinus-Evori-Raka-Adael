<?php
session_start();
include "../config/database.php";

$username = $_POST['username'];
$nama_lengkap = $_POST['nama_lengkap'];
$password = $_POST['password'];
$kelas = $_POST['kelas'];

// Hash password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Cek username sudah ada atau belum
$sql_check = "SELECT * FROM users WHERE username='$username'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "Username sudah digunakan!";
} else {
    // Insert ke tabel users, role = 'siswa'
    $sql = "INSERT INTO users (username, password, nama_lengkap, role, kelas) 
            VALUES ('$username', '$password_hash', '$nama_lengkap', 'siswa', '$kelas')";
    if ($conn->query($sql)) {
        echo "Registrasi berhasil! <a href='../login.php'>Login sekarang</a>";
    } else {
        echo "Registrasi gagal: " . $conn->error;
    }
}
?>
