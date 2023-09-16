<?php

// Panggil file database.php untuk koneksi ke database
require_once "config/database.php";

// Inisialisasi variabel $data sebagai array kosong
$data = array();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['id_user'])) {
  // Jika sudah login, jalankan query untuk mengambil data pengguna
  $query = mysqli_query($mysqli, "SELECT id_user, nama_user, foto, hak_akses FROM is_users WHERE id_user='$_SESSION[id_user]'");

  // Periksa apakah query berhasil dijalankan
  if ($query) {
    // Jika query berhasil dijalankan, isi variabel $data dengan data pengguna
    $data = mysqli_fetch_assoc($query);
  } else {
    // Jika query gagal, Anda dapat mengambil tindakan yang sesuai di sini
    // Misalnya, menampilkan pesan error atau melakukan sesuatu yang sesuai dengan kebutuhan Anda.
    echo "Terjadi kesalahan dalam mengambil data pengguna.";
  }
}


// Fungsi untuk menampilkan data pengguna jika sudah login
function displayUserMenu($data)
{
  // Periksa apakah data pengguna tidak kosong (pengguna sudah login)
  if (!empty($data)) {
    echo '<li class="dropdown user user-menu pull-right">';
    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
    echo '<!-- User image -->';

    if ($data['foto'] == "") {
      echo '<img src="images/user/user-default.png" class="user-image" alt="User Image" />';
    } else {
      echo '<img src="images/user/' . $data['foto'] . '" class="user-image" alt="User Image" />';
    }

    echo '<span class="hidden-xs">' . $data['nama_user'] . ' <i style="margin-left:5px" class="fa fa-angle-down"></i></span>';
    echo '</a>';
    echo '<ul class="dropdown-menu">';
    echo '<!-- User image -->';
    echo '<li class="user-header">';

    if ($data['foto'] == "") {
      echo '<img src="images/user/user-default.png" class="img-circle" alt="User Image" />';
    } else {
      echo '<img src="images/user/' . $data['foto'] . '" class="img-circle" alt="User Image" />';
    }

    echo '<p>' . $data['nama_user'] . '<small>' . $data['hak_akses'] . '</small></p>';
    echo '</li>';
    echo '<!-- Menu Footer-->';
    echo '<li class="user-footer">';
    echo '<div class="pull-left">';
    // Tombol Profil hanya muncul jika pengguna sudah login
    echo '<a style="width:80px" href="?module=profil" class="btn btn-default btn-flat">Profil</a>';
    echo '</div>';
    echo '<div class="pull-right">';
    // Tombol Logout hanya muncul jika pengguna sudah login
    echo '<a style="width:80px" data-toggle="modal" href="#logout" class="btn btn-default btn-flat">Logout</a>';
    echo '</div>';
    echo '</li>';
    echo '</ul>';
    echo '</li>';
  }
}

?>

<!-- Kemudian di dalam HTML Anda bisa memanggil fungsi ini seperti ini -->
<ul class="nav navbar-nav">
  <!-- ... menu lainnya ... -->

  <!-- Menu pengguna -->
  <?php
  // Panggil fungsi untuk menampilkan menu pengguna
  displayUserMenu($data);
  ?>
</ul>