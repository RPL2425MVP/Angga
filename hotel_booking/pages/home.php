<?php
include '../config/config.php';  // pastikan koneksi benar

// Query untuk mengambil data hotel
$query = "SELECT * FROM hotel";
$hotel = mysqli_query($koneksi, $query);

// Jika query gagal, tampilkan error
if (!$hotel) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<h1>Daftar Hotel</h1>

<div class="container">
<?php while ($h = mysqli_fetch_assoc($hotel)) { ?>
    <div class="card">
        <img src="../assets/img/<?= $h['gambar'] ?>" width="250">
        <h3><?= $h['nama_hotel'] ?></h3>
        <p><?= $h['lokasi'] ?></p>
        <a href="detail_hotel.php?id=<?= $h['id_hotel'] ?>">Detail</a>
    </div>
<?php } ?>
</div>

</body>
</html>
