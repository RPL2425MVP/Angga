<?php
include "../config/config.php";

$id_kamar = $_POST['id_kamar'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];

$kamar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar=$id_kamar"));

$hari = (strtotime($check_out) - strtotime($check_in)) / 86400;
$total = $hari * $kamar['harga'];
?>

<h3>Konfirmasi Pesanan</h3>
<p>Kamar: <?= $kamar['nama_kamar'] ?></p>
<p>Total Hari: <?= $hari ?></p>
<p>Total Harga: Rp <?= number_format($total) ?></p>

<form action="booking_step3.php" method="POST">
    <input type="hidden" name="id_kamar" value="<?= $id_kamar ?>">
    <input type="hidden" name="check_in" value="<?= $check_in ?>">
    <input type="hidden" name="check_out" value="<?= $check_out ?>">
    <input type="hidden" name="total" value="<?= $total ?>">

    <button>Konfirmasi Booking</button>
</form>
