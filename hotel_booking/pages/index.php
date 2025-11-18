<?php
include '../config/config.php';

// Sample properties (still using array)
$properties = [
    [
        'id_hotel'=>1,
        'title'=>'lestari',
        'location'=>'Bali',
        'price'=>120,
        'nights'=>3,
        'image'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcE4UYuCQbE4zVxX57wNDXexkoge34D06KDg&s',
        'tag'=>'Most Picked'
    ],
    [
        'id_hotel'=>2,
        'title'=>'manda Villa',
        'location'=>'Lombok',
        'price'=>95,
        'nights'=>2,
        'image'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSt01VW2gNIYBjSVhWZ7UwZ2o8K4CWYPl45Lw&s',
        'tag'=>'Popular'
    ],
    [
        'id_hotel'=>3,
        'title'=>'gubug tua',
        'location'=>'Bandung',
        'price'=>80,
        'nights'=>1,
        'image'=>'https://images.unsplash.com/photo-1528909514045-2fa4ac7a08ba?auto=format&fit=crop&w=800&q=60',
        'tag'=>'Most Picked'
    ],
];

// Filter
$filter_location = $_GET['location'] ?? '';
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : null;
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : null;
$search_text = $_GET['q'] ?? '';

$filtered = array_filter($properties, function($p) use ($filter_location, $min_price, $max_price, $search_text) {
    if ($filter_location !== '' && strcasecmp($p['location'], $filter_location) !== 0) return false;
    if ($min_price !== null && $p['price'] < $min_price) return false;
    if ($max_price !== null && $p['price'] > $max_price) return false;
    if ($search_text !== '' && stripos($p['title'], $search_text) === false && stripos($p['location'], $search_text) === false) return false;
    return true;
});
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>LarnacaStay</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .card-img { height: 180px; object-fit: cover; width: 100%; }
</style>
</head>

<body class="bg-indigo-50">

<!-- NAVBAR -->
<nav class="bg-white shadow">
  <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
    <a class="text-2xl font-bold text-indigo-600">LankaStay.</a>

    <ul class="hidden md:flex space-x-6 text-gray-600">
      <li><a href="#" class="hover:text-indigo-600">Home</a></li>
      <li><a href="#" class="hover:text-indigo-600">Rooms</a></li>
      <li><a href="#" class="hover:text-indigo-600">About</a></li>
      <li><a href="#" class="hover:text-indigo-600">Contact</a></li>
    </ul>

    <div>
      <a href="../auth/login.php" class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md mr-2">Login</a>
      <a href="../auth/register.php" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Register</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="max-w-6xl mx-auto px-6 py-12 grid md:grid-cols-2 gap-8">
  <div>
    <h1 class="text-4xl md:text-5xl font-bold text-indigo-800 leading-tight">
      Forget Busy Work,<br>Start Next Vacation
    </h1>
    <p class="mt-4 text-gray-600">
      Nikmati pengalaman menginap terbaik dengan layanan nyaman dan pilihan properti terkurasi.
    </p>

    <a href="#search" class="inline-block mt-6 bg-indigo-600 text-white px-5 py-3 rounded-lg shadow hover:bg-indigo-700">
      Show More
    </a>

    <div class="mt-8 flex gap-6 text-gray-600">
      <div class="flex items-center gap-2">
        <span class="font-bold text-indigo-600 text-lg">1000+</span> properties
      </div>
      <div class="flex items-center gap-2">
        <span class="font-bold text-indigo-600 text-lg">700</span> customers
      </div>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-lg p-4">
    <img class="rounded-lg w-full h-64 object-cover"
      src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcE4UYuCQbE4zVxX57wNDXexkoge34D06KDg&s">
  </div>
</section>

<!-- SEARCH BAR -->
<section id="search" class="bg-white py-6 shadow-inner">
  <div class="max-w-6xl mx-auto px-6">
    <form method="get" class="bg-indigo-50 p-4 rounded-lg grid md:grid-cols-5 gap-4">
      
      <input name="q" value="<?= htmlspecialchars($search_text) ?>"
        placeholder="Search destination..." 
        class="px-4 py-3 rounded-md border border-indigo-200" />

      <select name="location" class="px-4 py-3 rounded-md border border-indigo-200">
        <option value="">Location</option>
        <?php
          $locations = array_unique(array_column($properties, 'location'));
          foreach($locations as $loc){
            $sel = ($loc == $filter_location) ? 'selected' : '';
            echo "<option $sel>$loc</option>";
          }
        ?>
      </select>

      <input name="min_price" value="<?= $min_price ?? '' ?>" 
        placeholder="Min price" class="px-4 py-3 rounded-md border border-indigo-200">

      <input name="max_price" value="<?= $max_price ?? '' ?>" 
        placeholder="Max price" class="px-4 py-3 rounded-md border border-indigo-200">

      <button class="bg-indigo-600 text-white rounded-md px-4 py-3">
        Search
      </button>
    </form>
  </div>
</section>

<!-- MOST PICKED -->
<section class="max-w-6xl mx-auto px-6 py-10">
  <h2 class="text-2xl font-bold text-indigo-700 mb-6">Most Picked</h2>

  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <?php foreach($filtered as $p): ?>
      <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">

        <div class="relative">
          <img src="<?= $p['image'] ?>" class="card-img">

          <span class="absolute top-3 left-3 bg-indigo-600 text-white px-3 py-1 rounded">
            <?= $p['tag'] ?>
          </span>

          <span class="absolute top-3 right-3 bg-white/80 text-sm px-2 py-1 rounded">
            €<?= $p['price'] ?>/night
          </span>
        </div>

        <div class="p-4">
          <h3 class="font-semibold text-lg"><?= $p['title'] ?></h3>
          <p class="text-sm text-gray-500"><?= $p['location'] ?> • <?= $p['nights'] ?> nights</p>

          <div class="mt-4 flex justify-between items-center">
            <a href="detail_hotel.php?id=<?= $p['id_hotel'] ?>" class="text-indigo-600">View Details</a>
            <form method="post" action="booking.php">
              <input type="hidden" name="id" value="<?= $p['id_hotel'] ?>">
              <button class="bg-indigo-600 text-white px-3 py-1 rounded">Book</button>
            </form>
          </div>
        </div>

      </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- FOOTER -->
<footer class="bg-white py-6 mt-16 shadow-inner">
  <div class="max-w-6xl mx-auto px-6 flex justify-between text-gray-600">
    <p>© <?= date('Y') ?> LarnacaStay. All rights reserved.</p>
    <p>Designed with ❤️</p>
  </div>
</footer>

</body>
</html>
