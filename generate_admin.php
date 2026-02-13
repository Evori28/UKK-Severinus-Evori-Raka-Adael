<?php
include "config/database.php";

// Data admin baru
$username = "admin";
$nama_lengkap = "Administrator";
$password_plain = "admin123";

// Hash password
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Insert ke database
$sql = "INSERT INTO admin (username, password, nama_lengkap) VALUES ('$username', '$password_hash', '$nama_lengkap')";

if ($conn->query($sql)) {
    echo "Admin berhasil dibuat!<br>";
    echo "Username: $username<br>";
    echo "Password: $password_plain";
} else {
    echo "Error: " . $conn->error;
}
?>
