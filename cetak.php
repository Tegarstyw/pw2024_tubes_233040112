<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040112");

function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Mengambil data berita
$berita = query("SELECT * FROM berita");

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
</head>
<body>
    <h1>Daftar Berita</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Isi</th>
            <th>Tanggal Publikasi</th>
            <th>Link</th>
        </tr>';

$i = 1;
foreach ($berita as $h) {
    $html .= '<tr>
        <td>' . $i++ . '</td>
        <td><img src="img/' . $h["gambar"] . '" alt="Gambar Berita" width="150"></td>
        <td>' . $h["judul"] . '</td>
        <td>' . $h["isi"] . '</td>
        <td>' . $h["tanggal_publikasi"] . '</td>
        <td>' . $h["link"] . '</td>
    </tr>';
}

$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('Daftar-Berita.pdf', 'I');
?>
