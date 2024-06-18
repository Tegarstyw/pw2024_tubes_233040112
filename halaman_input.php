<?php include("inc_header.php")?>
<?php 
require 'koneksi.php';

$gambar            ="";
$judul             ="";
$isi               ="";
$tanggal_publikasi ="";
$link              ="";

if( isset($_POST["submit"])) {
    //cek apakah data berhasil ditambahkan atau tidak
    if ( tambah($_POST) > 0 ) {
      echo "
      <script>
          alert('data berhasil ditambahkan');
          document.location.href = 'halaman_admin.php';
      </script>";
    } else {
      echo "<script>
      alert('data gagal ditambahkan');
      document.location.href = 'halaman_admin.php';
  </script>";
    }
}

?>

<div class="container">
<h1>Hamalan admin input data</h1>
<div class="mb-3 row">
    <a href="halaman_admin.php">kembali ke halaman admin</a>
</div>
<form action="" method="post" enctype="multipart/form-data">
<div class="mb-3 row">
  <label for="Judul" class="col-sm-2 col-form-label">gambar</label>
  <div class="col-sm-10">
  <input type="file" class="form-control" id="Judul" value="<?php echo $gambar?>" name="gambar"> 
</div>
</div>

<div class="mb-3 row">
  <label for="Judul" class="col-sm-2 col-form-label">judul</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="kutipan" value="<?php echo $judul?>" name="judul" required> 
</div>
</div>

<div class="mb-3 row">
  <label for="isi" class="col-sm-2 col-form-label">isi</label>
  <div class="col-sm-10">
    <textarea name="isi" class="form-control" <?php echo $isi ?> required></textarea>
</div>
</div>

<div class="mb-3 row">
  <label for="tanggal_publikasi" class="col-sm-2 col-form-label">tanggal_publikasi</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="tanggal_publikasi" value="<?php echo $tanggal_publikasi?>" name="tanggal_publikasi" required> 
</div>
</div>

<div class="mb-3 row">
  <label for="link" class="col-sm-2 col-form-label">link</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="link" value="<?php echo $link?>" name="link" required> 
</div>
</div>

<div class="mb-3 row">
 <div class="col-sm-2"></div>
  <div class="col-sm-10">
    <input type="submit" name="submit" class="btn btn-primary">
</div>
</div>
</form>
</div>
<?php include("inc_footer.php")?>