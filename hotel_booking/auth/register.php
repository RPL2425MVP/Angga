<?php
include "../config/config.php";

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user(nama,email,password) VALUES ('$nama','$email','$password')");

    echo "<script>alert('Akun dibuat!');window.location='login.php'</script>";
}
?>
