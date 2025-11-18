<?php
session_start();
include "../config/config.php";

$id_user = $_SESSION['id_user'];

$reservasi = mysqli_query($conn, "
    SELECT r.*, k.nama_kamar
    FROM reservasi r 
    JOIN kamar k ON r.id_kamar = k.id_kamar
    WHERE r.id_user=$id_user ORDER BY r.id_reservasi DESC
");
?>

<h2>Dashboard <?= $_SESSION['nama'] ?></h2>

<h3>Reservasi Saya</h3>

<?php while ($r = mysqli_fetch_assoc($reservasi)) { ?>
<div class="card">
    <p>Kamar: <?= $r['nama_kamar'] ?></p>
    <p>Total: Rp <?= number_format($r['total_harga']) ?></p>
    <p>Status: <?= $r['status'] ?></p>
</div>
<?php } ?>
