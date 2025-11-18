<?php
session_start();
include "../config/config.php";

$id_user = $_SESSION['id_user'];
$id_kamar = $_POST['id_kamar'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$total = $_POST['total'];

$query = "INSERT INTO reservasi (id_user,id_kamar,check_in,check_out,total_harga)
          VALUES ($id_user,$id_kamar,'$check_in','$check_out',$total)";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Booking Berhasil!');window.location='dashboard.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
