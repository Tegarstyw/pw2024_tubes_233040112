<?php
// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040112");

// halaman admin
function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//tambah data 
function tambah($data) {
    global $koneksi;
    //ambil data dari tiap elemen dalam form
   
    $judul = htmlspecialchars($data["judul"]);
    $isi = htmlspecialchars($data["isi"]);
    $tanggal_publikasi = htmlspecialchars($data["tanggal_publikasi"]);
    $link = htmlspecialchars($data["link"]);

     //upload gambar
     $gambar = upload();
        if(!$gambar ) {
            return false;
        }
     //querry insert data
     $query = "INSERT INTO berita VALUES ('0', '$gambar', '$judul', '$isi', '$tanggal_publikasi', '$link')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
    //upload gambar
function upload () {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if( $error === 4) {
        echo  "<script>
                    alert('pilih gambar terlebih dahulu!');                
                </script>";
            return false;
    }

    //cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo  "<script>
                    alert('yang anda upload bukan gambar!');                
                </script>";
            return false;
    }

    //cek jika ukuranya terlalu besar
    if($ukuranFile > 5000000) {
        echo  "<script>
                    alert('ukuran gambar terlalu besar!');                
                </script>";
            return false;
    }

    // Generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Pindahkan file ke folder tujuan
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

//hapus
function hapus ($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM berita WHERE id = $id");

    //mengembalikan jumlah baris kode yang terpengaruh
    return mysqli_affected_rows($koneksi);
}

//ubah
function ubah($data) {
    global $koneksi;

    $id = $data["id"];
    $gambar = htmlspecialchars($data["gambar"]);
    $judul = htmlspecialchars($data["judul"]);
    $isi = htmlspecialchars($data["isi"]);
    $tanggal_publikasi = htmlspecialchars($data["tanggal_publikasi"]);
    $link = htmlspecialchars($data["link"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE berita SET 
                gambar = '$gambar', 
                judul = '$judul', 
                isi = '$isi', 
                tanggal_publikasi = '$tanggal_publikasi', 
                link = '$link'
              WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

//registrasi
function register($data) {
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert ('username sudah terdaftar!')  
              </script>";
        return false; // Hentikan eksekusi script
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
              </script>";
        return false; // Hentikan eksekusi script
    }

    //enkripsi password
    $password = password_hash ($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    $query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

//cari
function cari($keyword) {
    $query = "SELECT * FROM berita 
                WHERE
              judul LIKE '%$keyword%' OR
              isi LIKE '%$keyword%' OR
              tanggal_publikasi LIKE '%$keyword%' OR
              link LIKE '%$keyword%'";
    return query($query);
}

?>