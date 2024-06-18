<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'koneksi.php';

// Ambil data dari database
$berita = query("SELECT * FROM berita");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/halaman_utama.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand">
                    <strong><span style="color:red;">GAR</span>News</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                    <!-- jika yang login role sebagai admin maka akan muncuk button nya -->
                    <?php if ($_SESSION["role"] === 'admin') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="halaman_admin.php">halaman admin</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">home</a>
                        </li>
                    </ul>
                    <form class="d-flex form-inline my-2 my-lg-0 m-auto">
                        <input class="form-control me-2" type="search" placeholder="Cari berita anda!" autofocus autocomplete="off" id="keyword">
                        <button class="btn btn-light" type="submit" id="tombol-cari">Cari</button>
                    </form>
                    <div class="dropdown text-end ms-auto">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="color:white; font-size:25px; position:relative;">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu text-small">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="Login.php">Login</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<div>
<h1 style="text-align:center; margin-top:25px;"><span>BERITA </span>TRENDING <i class="bi bi-graph-up-arrow" style="color:red;"></i> </h1>
    <div class="container mt-5" style="background: #f4f4f4;">
        <div class="row align-items-center"> 
            <div class="col-lg-8">
                <div class="card mb-4 position-relative main-article">
                    <img src="img/bpjs.jpg" class="card-img-top" alt="Gambar Artikel Utama">
                    <div class="main-article-content">
                        <span class="badge badge-primary">TREN</span>
                        <span class="badge badge-light">30 Januari 2024</span>
                        <h3 class="card-title">Era Digitalisasi Buat Pelayanan Ramah Khas Indonesia Hilang?</h3>
                        <p>Era Digitalisasi Buat Pelayanan Ramah Khas Indonesia Hilang?</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <div class="side-article card flex-row">
                        <img src="img/dokter.png" alt="Gambar Artikel Samping">
                        <div class="card-body">
                            <span class="badge badge-primary">Tren</span>
                            <h6 class="card-title">Industri Periklanan Minta Dilibatkan dalam RPP Kesehatan, Ini Alasannya</h6>
                        </div>
                    </div>
                    <div class="side-article card flex-row">
                        <img src="img/grid 2.png" alt="Gambar Artikel Samping">
                        <div class="card-body">
                            <span class="badge badge-primary">Tren</span>
                            <h6 class="card-title">RPP Kesehatan Berpotensi Timbulkan PHK Masal hingga...</h6>
                        </div>
                    </div>
                    <div class="side-article card flex-row">
                        <img src="img/grid 3.png" alt="Gambar Artikel Samping">
                        <div class="card-body">
                            <span class="badge badge-primary">Tren</span>
                            <h6 class="card-title">Cara Generasi Muda Lakukan Pengelolaan Lingkungan Hidup</h6>
                        </div>
                    </div>
                    <div class="side-article card flex-row">
                        <img src="img/grid 3.png" alt="Gambar Artikel Samping">
                        <div class="card-body">
                            <span class="badge badge-primary">Tren</span>
                            <h6 class="card-title">Cara Generasi Muda Lakukan Pengelolaan Lingkungan Hidup</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <h4 style="margin:20px; padding-left:45px">Rekomendasi untuk anda</h4>
    <div class="container" style="display: flex; flex-wrap: wrap; flex-direction: row; gap:70px; justify-content:center;">
    <?php foreach($berita as $health): ?>
      <div class="card" style="max-width: 300px;">
        <img src="img/<?php echo htmlspecialchars($health['gambar']); ?>" class="card-img-top" alt="Gambar Berita" style="height: 200px;">
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($health['judul']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars(substr($health['isi'], 0, 100)); ?></p>
          <a href="<?php echo htmlspecialchars($health['link']); ?>" class="btn btn-primary">Baca Selengkapnya</a>
        </div>
      </div>
      <?php endforeach; ?>
        </div>
 </div>
</body>
</html>
<?php include("inc_footer.php"); ?> <!--untuk membuat footer otomatis terbuat -->
