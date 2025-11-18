<?php
session_start();
include "../config/config.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $u = mysqli_fetch_assoc($q);

    if ($u && password_verify($pass, $u['password'])) {
        $_SESSION['id_user'] = $u['id_user'];
        $_SESSION['nama'] = $u['nama'];

        header("Location: ../pages/dashboard.php");
    } else {
        echo "Login gagal";
    }
}
?>
