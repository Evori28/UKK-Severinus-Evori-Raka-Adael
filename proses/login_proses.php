<?php
session_start();
include "../config/database.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Ambil user dari tabel users
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($user) {
    if (password_verify($password, $user['password'])) {
        // Set session sesuai role
        if ($user['role'] == 'admin') {
            $_SESSION['admin'] = $user;
            header("Location: ../admin/index.php");
            exit;
        } else {
            $_SESSION['siswa'] = $user;
            header("Location: ../user/index.php");
            exit;
        }
    } else {
        echo "Password salah!";
    }
} else {
    echo "Username tidak ditemukan!";
}
?>
