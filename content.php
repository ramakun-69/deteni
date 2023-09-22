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
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";
/* panggil file fungsi tambahan */
require_once "config/fungsi_tanggal.php";
require_once "config/fungsi_rupiah.php";

if ($_GET['module'] == 'kegiatan-regu') {
	include "modules/kegiatan-regu/view1.php";
}

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan message = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
	// jika halaman konten yang dipilih beranda, panggil file view beranda
	if ($_GET['module'] == 'beranda') {
		include "modules/beranda/view.php";
	}

	// jika halaman konten yang dipilih obat, panggil file view obat
	elseif ($_GET['module'] == 'data_deteni') {
		include "modules/data-deteni/view.php";
	}

	// jika halaman konten yang dipilih form obat, panggil file form obat
	elseif ($_GET['module'] == 'form_deteni') {
		include "modules/data-deteni/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih obat masuk, panggil file view obat masuk
	elseif ($_GET['module'] == 'progress_deteni') {
		include "modules/progress-deteni/view.php";
	}

	// jika halaman konten yang dipilih form obat masuk, panggil file form obat masuk
	elseif ($_GET['module'] == 'form_progress_deteni') {
		include "modules/progress-deteni/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan stok, panggil file view laporan stok
	elseif ($_GET['module'] == 'lap_stok') {
		include "modules/lap-stok/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan stok, panggil file view laporan stok
	elseif ($_GET['module'] == 'lap_regu') {
		include "modules/lap-regu/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan stok, panggil file view laporan stok
	elseif ($_GET['module'] == 'lap_jurnal') {
		include "modules/lap-jurnal/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan obat masuk, panggil file view laporan obat masuk
	elseif ($_GET['module'] == 'lap_obat_masuk') {
		include "modules/lap-obat-masuk/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih user, panggil file view user
	elseif ($_GET['module'] == 'user') {
		include "modules/user/view.php";
	}

	// jika halaman konten yang dipilih form user, panggil file form user
	elseif ($_GET['module'] == 'form_user') {
		include "modules/user/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih profil, panggil file view profil
	elseif ($_GET['module'] == 'profil') {
		include "modules/profil/view.php";
	}

	// jika halaman konten yang dipilih form profil, panggil file form profil
	elseif ($_GET['module'] == 'form_profil') {
		include "modules/profil/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih password, panggil file view password
	elseif ($_GET['module'] == 'password') {
		include "modules/password/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih data deteni, panggil file view deteni
	elseif ($_GET['module'] == 'deteni') {
		include "modules/deteni/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih form user, panggil file form user
	elseif ($_GET['module'] == 'form_deteni1') {
		include "modules/deteni/form.php";
	}
	// -----------------------------------------------------------------------------
	// jika halaman konten yang dipilih form user, panggil file form user
	elseif ($_GET['module'] == 'download') {
		include "modules/obat-masuk/DownloadFile.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih obat masuk, panggil file view obat masuk
	elseif ($_GET['module'] == 'kegiatan_regu') {
		include "modules/kegiatan-regu/view.php";
	}

	// jika halaman konten yang dipilih form obat masuk, panggil file form obat masuk
	elseif ($_GET['module'] == 'form_kegiatan_regu') {
		include "modules/kegiatan-regu/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih obat masuk, panggil file view obat masuk
	elseif ($_GET['module'] == 'data_regu') {
		include "modules/data-regu/view.php";
	}

	// jika halaman konten yang dipilih form obat masuk, panggil file form obat masuk
	elseif ($_GET['module'] == 'form_regu') {
		include "modules/data-regu/form.php";
	}
	// -----------------------------------------------------------------------------
}
?>