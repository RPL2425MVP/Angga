<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_hotel";

// 1. Koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// 2. Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 3. Charset (penting untuk huruf UTF8)
mysqli_set_charset($koneksi, "utf8");

// 4. Fungsi untuk mengeksekusi query + cek error
function db_query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }
    return $result;
}

// 5. Fungsi mengambil 1 baris data
function db_fetch($query) {
    $result = db_query($query);
    return mysqli_fetch_assoc($result);
}

// 6. Fungsi mengambil banyak baris data
function db_fetch_all($query) {
    $result = db_query($query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
?>
