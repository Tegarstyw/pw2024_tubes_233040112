<?php 
require 'koneksi.php';

if (isset($_GET['id'])) {
$id = $_GET["id"]; 

if ( hapus($id) >0 )
echo "
<script>
alert('data berhasil dihapus');
document.location.href = 'halaman_admin.php';
</script>
";
} else {
    echo "
    <script>
    alert('data gagal dihapus');
    document.location.href = 'halaman_admin.php';
</script>
";
} 
?>

