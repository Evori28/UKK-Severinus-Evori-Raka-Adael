<?php
session_start();

function checkAdmin() {
    if (!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit();
    }
}

function checkUser() {
    if (!isset($_SESSION['siswa'])) {
        header("Location: ../login.php");
        exit();
    }
}
?>
