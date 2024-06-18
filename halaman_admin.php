<?php
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin') {
    header("Location: index.php");
    exit;
}

require 'koneksi.php';
$berita = query("SELECT * FROM  berita");

//pagination
//konfigurasi
$jumlahdataperhalaman = 2;
$jumlahdata = count(query("SELECT * FROM berita"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = ( isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

$health = query("SELECT * FROM berita LIMIT $awaldata,$jumlahdataperhalaman");

//tombol cari ditekan 
if( isset($_POST["cari"])) {
    $health = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input</title>
    <link rel="stylesheet" href="css/halaman_admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
   <?php include ("inc_header.php"); ?>
    <div style="margin:20px;">
        <h1 style="text-align:center; margin:20px;">Halaman Admin</h1>
        <p>
            <a href="halaman_input.php">
                <input type="button" class="btn-primary" value="Buat Halaman Baru">
            </a>
            <a href="cetak.php" target="_blank">
               <input type="button" class="btn-warning" value="cetak" style="margin-left:10px;">
            </a>
        </p>
            
        <form class="row g-4" method="post">
            <div class="col-auto">
                <input type="text" class="form-control" placeholder="Masukan kata kunci" name="keyword" value="" autofocus autocomplete="off" id="keyword">
            </div>
            <div class="col-auto">
                <input type="submit" name="cari" value="Cari berita" class="btn-secondary" id="tombol-cari" style="top:3px; position:relative;">
            </div>
        </form>
        <br><br>

        <!-- navigasi -->
        <div class="navigasi">
        <?php if( $halamanaktif > 1 ) : ?>
        <a href="?halaman=<?= $halamanaktif - 1; ?>">&laquo;</a>
        <?php endif;?>
        <?php for($i = 1; $i <= $jumlahhalaman; $i++) : ?>
            <?php if($i == $halamanaktif) : ?>
                <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: black;"><?= $i; ?></a>
            <?php else : ?>
                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if( $halamanaktif < $jumlahhalaman ) : ?>
        <a href="?halaman=<?= $halamanaktif + 1; ?>">&raquo;</a>
        <?php endif;?>
        </div>
        <div id="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th class="col-3">Isi</th>
                    <th>Tanggal Publikasi</th>
                    <th class="col-2">Link</th>
                    <th class="col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach($health as $h) : ?>
                <tr>
                    <th><?= $i++; ?></th>
                    <td><img src="img/<?= $h['gambar']; ?>" alt="" width="150px"></td>
                    <td><?= $h['judul']; ?></td>
                    <td><?= $h['isi']; ?></td>
                    <td><?= $h['tanggal_publikasi']; ?></td>
                    <td><?= $h['link']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $h['id']; ?>">
                            <button type="button" class="btn btn-danger">Edit</button>
                        </a>
                        <a href="hapus.php?id=<?= $h['id']; ?>">
                            <button type="button" class="btn btn-warning">Hapus</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
