<?php
require 'koneksi.php';

$gambar = "";
$judul = "";
$isi = "";
$tanggal_publikasi = "";
$link = "";

// Ambil data di URL 
$id = $_GET["id"];

// Query data berdasarkan id
$row = query("SELECT * FROM berita WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    // Cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil diubah');
            document.location.href = 'halaman_admin.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal diubah');
        document.location.href = 'halaman_admin.php';
    </script>";
    }
}


?>
<?php include("inc_header.php") ?>
<div class="container" style="margin:30px">
<h1>Halaman Admin Ubah Data</h1>
<div class="mb-3 row">
    <a href="halaman_admin.php">Kembali ke halaman admin</a>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row["id"]; ?>">
    <input type="hidden" name="gambarlama" value="<?= $row["gambar"]; ?>">
    <div class="mb-3 row">
      <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
      <div class="col-sm-10">
        <img src="img/<?= $row['gambar'];?>" style="width:250px;">
      <input type="file" class="form-control" id="gambar" name="gambar"> 
    </div>
    </div>

    <div class="mb-3 row">
      <label for="judul" class="col-sm-2 col-form-label">Judul</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" id="judul" value="<?= $row['judul']; ?>" name="judul" required> 
    </div>
    </div>

    <div class="mb-3 row">
      <label for="isi" class="col-sm-2 col-form-label">Isi</label>
      <div class="col-sm-10">
        <textarea name="isi" class="form-control" id="isi" required><?= $row['isi']; ?></textarea>
    </div>
    </div>

    <div class="mb-3 row">
      <label for="tanggal_publikasi" class="col-sm-2 col-form-label">Tanggal Publikasi</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" id="tanggal_publikasi" value="<?= $row['tanggal_publikasi']; ?>" name="tanggal_publikasi" required> 
    </div>
    </div>

    <div class="mb-3 row">
      <label for="link" class="col-sm-2 col-form-label">Link</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" id="link" value="<?= $row['link']; ?>" name="link" required> 
    </div>
    </div>

    <div class="mb-3 row">
     <div class="col-sm-2"></div>
      <div class="col-sm-10">
        <input type="submit" name="submit" class="btn btn-primary" value="Ubah Data">
    </div>
    </div>
</form>
</div>
<?php include("inc_footer.php") ?>
