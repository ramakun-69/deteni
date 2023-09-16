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
    echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $kode_regu  = mysqli_real_escape_string($mysqli, trim($_POST['kode_regu']));
            $komandan  = mysqli_real_escape_string($mysqli, trim($_POST['komandan']));
            $anggota  = mysqli_real_escape_string($mysqli, trim($_POST['anggota']));
            $nama_regu  = mysqli_real_escape_string($mysqli, trim($_POST['nama_regu']));


            $created_user = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel regu
            $query = mysqli_query($mysqli, "INSERT INTO is_regu(kode_regu,komandan,anggota,nama_regu,created_user,updated_user) 
                                            VALUES('$kode_regu','$komandan','$anggota','$nama_regu','$created_user','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=data_regu&alert=1");
            }
        }
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['kode_regu'])) {
                // ambil data hasil submit dari form
                $kode_regu  = mysqli_real_escape_string($mysqli, trim($_POST['kode_regu']));
                $komandan  = mysqli_real_escape_string($mysqli, trim($_POST['komandan']));
                $anggota  = mysqli_real_escape_string($mysqli, trim($_POST['anggota']));
                $nama_regu  = mysqli_real_escape_string($mysqli, trim($_POST['nama_regu']));

                $updated_user = $_SESSION['id_user'];

                // perintah query untuk mengubah data pada tabel obat
                $query = mysqli_query($mysqli, "UPDATE is_regu SET  komandan        = '$komandan',
                                                                    anggota         = '$anggota',
                                                                    nama_regu     = '$nama_regu',
                                                                    updated_user    = '$updated_user'
                                                              WHERE kode_regu       = '$kode_regu'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=data_regu&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id'])) {
            $kode_regu = $_GET['id'];

            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM is_regu WHERE kode_regu='$kode_regu'")
                or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=data_regu&alert=3");
            }
        }
    }
}
?>