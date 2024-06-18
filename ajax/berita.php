<?php 
require '../koneksi.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM berita 
        WHERE
        judul LIKE '%$keyword%' OR
        isi LIKE '%$keyword%' OR
        tanggal_publikasi LIKE '%$keyword%' OR
        link LIKE '%$keyword%'
        ";
$berita = query($query);
?>

<table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th class="col-2">Isi</th>
                    <th>Tanggal Publikasi</th>
                    <th>Link</th>
                    <th class="col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach($berita as $h) : ?>
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