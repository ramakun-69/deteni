<!-- Aplikasi Persediaan Obat pada Apotek
*******************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 1 April 2017
* Website      : www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $kode_deteni  = mysqli_real_escape_string($mysqli, trim($_POST['kode_deteni']));
            $nama_deteni  = mysqli_real_escape_string($mysqli, trim($_POST['nama_deteni']));
            $blok_deteni  = mysqli_real_escape_string($mysqli, trim($_POST['blok_deteni']));
            $asal         = mysqli_real_escape_string($mysqli, trim($_POST['asal']));
            $wn             = mysqli_real_escape_string($mysqli, trim($_POST['wn']));

            $created_user = $_SESSION['id_user'];
             // Pengunggahan gambar
            $upload_dir = '../../images/deteni/';
            $foto_filename = $_FILES['foto']['name'];
            $foto_tmpname = $_FILES['foto']['tmp_name'];
            if (!empty($foto_filename)) {
                // Cek tipe gambar yang diizinkan (misalnya, hanya gambar JPEG yang diperbolehkan)
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                $extension = pathinfo($foto_filename, PATHINFO_EXTENSION);
    
                if (in_array(strtolower($extension), $allowed_extensions)) {
                    // Buat nama unik untuk gambar
                    $foto_name = uniqid('foto_') . '.' . $extension;
                    // Pindahkan gambar ke direktori tujuan
                    if (move_uploaded_file($foto_tmpname, $upload_dir . $foto_name)) {
                        // Simpan nama gambar ke dalam database
                        $query = mysqli_query($mysqli, "INSERT INTO is_deteni (kode_deteni, nama_deteni, blok_deteni, asal, wn, created_user, updated_user, foto)
                            VALUES ('$kode_deteni', '$nama_deteni', '$blok_deteni', '$asal', '$wn', '$created_user', '$created_user', '$foto_name')")
                            or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
    
                        // cek query
                        if ($query) {
                            // jika berhasil tampilkan pesan berhasil simpan data
                            header("location: ../../main.php?module=data_deteni&alert=1");
                        }
                    } else {
                        // Kesalahan saat mengunggah gambar
                        echo "Error: Gambar gagal diunggah.";
                    }
                } else {
                    // Tipe gambar tidak diizinkan
                    echo "Error: Tipe gambar tidak diizinkan.";
                }
            } else{

            // perintah query untuk menyimpan data ke tabel obat
            $query = mysqli_query($mysqli, "INSERT INTO is_deteni(kode_deteni,nama_deteni,blok_deteni,asal,wn,created_user,updated_user) 
                                            VALUES('$kode_deteni','$nama_deteni','$blok_deteni','$asal','$wn','$created_user','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
            }
            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=data_deteni&alert=1");
            }
        }
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['kode_deteni'])) {
                // ambil data hasil submit dari form
                $kode_deteni  = mysqli_real_escape_string($mysqli, trim($_POST['kode_deteni']));
                $nama_deteni  = mysqli_real_escape_string($mysqli, trim($_POST['nama_deteni']));
                $blok_deteni  = mysqli_real_escape_string($mysqli, trim($_POST['blok_deteni']));
                $asal  = mysqli_real_escape_string($mysqli, trim($_POST['asal']));
                $wn         = mysqli_real_escape_string($mysqli, trim($_POST['wn']));

                $updated_user = $_SESSION['id_user'];
                $upload_dir = '../../images/deteni/';
            $foto_filename = $_FILES['foto']['name'];
            $foto_tmpname = $_FILES['foto']['tmp_name'];
            if (!empty($foto_filename)) {
                // Cek tipe gambar yang diizinkan (misalnya, hanya gambar JPEG yang diperbolehkan)
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                $extension = pathinfo($foto_filename, PATHINFO_EXTENSION);
    
                if (in_array(strtolower($extension), $allowed_extensions)) {
                    // Buat nama unik untuk gambar
                    $foto_name = uniqid('foto_') . '.' . $extension;
                    // Pindahkan gambar ke direktori tujuan
                    if (move_uploaded_file($foto_tmpname, $upload_dir . $foto_name)) {
                       // perintah query untuk mengubah data pada tabel obat
                $query = mysqli_query($mysqli, "UPDATE is_deteni SET  nama_deteni     = '$nama_deteni',
                blok_deteni     = '$blok_deteni',
                asal            = '$asal',
                wn              = '$wn',
                foto            = '$foto_name',
                updated_user    = '$updated_user'
                        WHERE kode_deteni       = '$kode_deteni'")
                or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                // jika berhasil tampilkan pesan berhasil update data
                header("location: ../../main.php?module=data_deteni&alert=2");
                }
                    } else {
                        // Kesalahan saat mengunggah gambar
                        echo "Error: Gambar gagal diunggah.";
                    }
                } else {
                    // Tipe gambar tidak diizinkan
                    echo "Error: Tipe gambar tidak diizinkan.";
                }

            } else{
                $query = mysqli_query($mysqli, "UPDATE is_deteni SET  nama_deteni     = '$nama_deteni',
                blok_deteni     = '$blok_deteni',
                asal            = '$asal',
                wn              = '$wn',
                updated_user    = '$updated_user'
                        WHERE kode_deteni       = '$kode_deteni'")
                or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                // jika berhasil tampilkan pesan berhasil update data
                header("location: ../../main.php?module=data_deteni&alert=2");
                }
            }
               
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id'])) {
            $kode_deteni = $_GET['id'];

            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM is_deteni WHERE kode_deteni='$kode_deteni'")
                or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=data_deteni&alert=3");
            }
        }
    }
}
?>