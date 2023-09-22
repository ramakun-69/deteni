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

            // menampilkan outputnya
            echo $text;
            // ambil data hasil submit dari form
            $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_POST['kode_transaksi']));

            $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_masuk']));
            $exp             = explode('-', $tanggal);
            $tanggal_masuk   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];
            $jam = mysqli_real_escape_string($mysqli, trim($_POST['jam_masuk']));

            $kode_regu     = mysqli_real_escape_string($mysqli, trim($_POST['kode_regu']));

            $kegiatan        = mysqli_real_escape_string($mysqli, trim($_POST['kegiatan']));


            $created_user    = $_SESSION['id_user'];

            $nama_file          = $kode_regu . "-" . $_FILES['data']['name'];
            // Mengganti spasi dengan karakter garis bawah (_)
            $nama_file = str_replace(' ', '_', $nama_file);
            $ukuran_file        = $_FILES['data']['size'];
            $tipe_file          = $_FILES['data']['type'];
            $tmp_file           = $_FILES['data']['tmp_name'];

            // tentuka extension yang diperbolehkan
            $allowed_extensions = array('jpg', 'jpeg', 'png');

            // Set path folder tempat menyimpan file
            $path_file          = "../../foto/" . $nama_file;

            // check extension
            $file               = explode(".", $nama_file);
            $extension          = array_pop($file);

            if (in_array($extension, $allowed_extensions)) {
                // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
                if ($ukuran_file <= 3000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
                    // Jika ukuran file kurang dari sama dengan 5MB, lakukan :

                    // Proses upload

                    if (move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                        // Jika gambar berhasil diupload, Lakukan : 
                        // perintah query untuk menyimpan data ke tabel obat masuk
                        $query = mysqli_query($mysqli, "INSERT INTO is_regu_masuk(kode_transaksi,tanggal_masuk,jam_masuk,kode_regu,kegiatan,created_user,data) 
                                            VALUES('$kode_transaksi','$tanggal_masuk','$jam','$kode_regu','$kegiatan','$created_user','$nama_file')")
                            or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));



                        // cek query
                        if ($query) {
                            // jika berhasil tampilkan pesan berhasil simpan data
                            header("location: ../../main.php?module=kegiatan_regu&alert=1");
                        }
                    } else {
                        // Jika tipe file yang diupload bukan doc, docx, pdf, tampilkan pesan gagal upload
                        header("location: ../../main.php?module=kegiatan_regu&alert=2");
                    }
                } else {
                    // Jika tipe file yang diupload melebihi 3MB tampilkan pesan gagal upload
                    header("location: ../../main.php?module=kegiatan_regu&alert=3");
                }
            }
        }
    }
}
?>