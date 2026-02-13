<?php
include "config/database.php";

// Data siswa baru
$username = "john";
$nama_lengkap = "John Doe";
$kelas = "10A";
$password_plain = "siswa123";

// Hash password
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Insert ke database
$sql = "INSERT INTO siswa (username, password, nama_lengkap, kelas) VALUES ('$username', '$password_hash', '$nama_lengkap', '$kelas')";

if ($conn->query($sql)) {
    echo "Siswa berhasil dibuat!<br>";
    echo "Username: $username<br>";
    echo "Password: $password_plain";
} else {
    echo "Error: " . $conn->error;
}
?>
