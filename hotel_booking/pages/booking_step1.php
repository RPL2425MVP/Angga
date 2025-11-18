<?php
session_start();
include "../config/config.php";

$id_kamar = $_GET['id_kamar'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar=$id_kamar"));
?>

<h2>Booking: <?= $data['nama_kamar'] ?></h2>

<form action="booking_step2.php" method="POST">
    <input type="hidden" name="id_kamar" value="<?= $id_kamar ?>">

    Check In : <input type="date" name="check_in" required><br>
    Check Out : <input type="date" name="check_out" required><br>

    <button type="submit">Lanjut</button>
</form>
