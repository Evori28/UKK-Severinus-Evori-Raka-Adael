<?php
session_start();
include "config/database.php";

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Validasi password
    if ($password !== $password_confirm) {
        $error = "Password dan konfirmasi tidak cocok!";
    } else {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah username sudah ada
        $sql_check = "SELECT * FROM users WHERE username='$username'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Insert admin baru
            $sql_insert = "INSERT INTO users (username, password, nama_lengkap, role) 
                           VALUES ('$username', '$password_hash', '$nama_lengkap', 'admin')";
            if ($conn->query($sql_insert)) {
                $success = "Admin berhasil dibuat! <a href='login.php'>Login sekarang</a>";
            } else {
                $error = "Gagal membuat admin: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
</head>
<body>
<h2>Register Admin</h2>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

<form method="POST" action="">
    Username: <input type="text" name="username" required><br>
    Nama Lengkap: <input type="text" name="nama_lengkap" required><br>
    Password: <input type="password" name="password" required><br>
    Konfirmasi Password: <input type="password" name="password_confirm" required><br>
    <button type="submit">Register Admin</button>
</form>
<p><a href="login.php">Kembali ke Login</a></p>
</body>
</html>
