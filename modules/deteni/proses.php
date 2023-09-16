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
// jika user sudah login, maka jalankan perintah untuk insert dan update
else {
	// insert data
	if ($_GET['act'] == 'insert') {
		if (isset($_POST['simpan'])) {
			// ambil data hasil submit dari form
			$nama_deteni  = mysqli_real_escape_string($mysqli, trim($_POST['nama_deteni']));
			$blok  		  = mysqli_real_escape_string($mysqli, trim($_POST['blok']));
			$catatan      = mysqli_real_escape_string($mysqli, trim($_POST['catatan']));
			$status       = mysqli_real_escape_string($mysqli, trim($_POST['status']));

			// perintah query untuk menyimpan data ke tabel users
			$query = mysqli_query($mysqli, "INSERT INTO deteni(nama_deteni,blok,catatan,status)
                                            VALUES('$nama_deteni','$blok','$catatan','$status')")
				or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

			// cek query
			if ($query) {
				// jika berhasil tampilkan pesan berhasil simpan data
				header("location: ../../main.php?module=deteni&alert=1");
			}
		}
	}

	// update data
	elseif ($_GET['act'] == 'update') {
		if (isset($_POST['simpan'])) {
			if (isset($_POST['id_deteni'])) {
				// ambil data hasil submit dari form
				$id_deteni          = mysqli_real_escape_string($mysqli, trim($_POST['id_deteni']));
				$blok	            = mysqli_real_escape_string($mysqli, trim($_POST['blok']));
				$nama_deteni        = mysqli_real_escape_string($mysqli, trim($_POST['nama_deteni']));
				$catatan			= mysqli_real_escape_string($mysqli, trim($_POST['catatan']));
				$status             = mysqli_real_escape_string($mysqli, trim($_POST['status']));

				$nama_file          = $_FILES['foto']['name'];
				$ukuran_file        = $_FILES['foto']['size'];
				$tipe_file          = $_FILES['foto']['type'];
				$tmp_file           = $_FILES['foto']['tmp_name'];

				// tentuka extension yang diperbolehkan
				$allowed_extensions = array('jpg', 'jpeg', 'png');

				// Set path folder tempat menyimpan gambarnya
				$path_file          = "../../images/deteni/" . $nama_file;

				// check extension
				$file               = explode(".", $nama_file);
				$extension          = array_pop($file);

				// jika password tidak diubah dan foto tidak diubah
				if (empty($_POST['password']) && empty($_FILES['foto']['name'])) {
					// perintah query untuk mengubah data pada tabel users
					$query = mysqli_query($mysqli, "UPDATE deteni SET  	
                    												    nama_deteni = '$nama_deteni',
                    													status      = '$status',
																		catatan		= '$catatan'
                                                                  WHERE id_deteni 	= '$id_deteni'")
						or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

					// cek query
					if ($query) {
						// jika berhasil tampilkan pesan berhasil update data
						header("location: ../../main.php?module=deteni&alert=2");
					}
				}
				// jika password diubah dan foto tidak diubah
				elseif (!empty($_POST['password']) && empty($_FILES['foto']['name'])) {
					// perintah query untuk mengubah data pada tabel users
					$query = mysqli_query($mysqli, "UPDATE  deteni SET  nama_deteni 	= '$nama_deteni',
																			status      = '$status',
																			catatan		= '$catatan'
																	WHERE id_deteni 	= '$id_deteni'")
						or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

					// cek query
					if ($query) {
						// jika berhasil tampilkan pesan berhasil update data
						header("location: ../../main.php?module=deteni&alert=2");
					}
				}
				// jika password tidak diubah dan foto diubah
				elseif (empty($_POST['password']) && !empty($_FILES['foto']['name'])) {
					// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
					if (in_array($extension, $allowed_extensions)) {
						// Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
						if ($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
							// Jika ukuran file kurang dari sama dengan 1MB, lakukan :
							// Proses upload
							if (move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
								// Jika gambar berhasil diupload, Lakukan : 
								// perintah query untuk mengubah data pada tabel users
								$query = mysqli_query($mysqli, "UPDATE  deteni SET  nama_deteni 	= '$nama_deteni',
																						status      = '$status',
																						foto 		= '$nama_file',
																						catatan		= '$catatan'
																				WHERE id_deteni 	= '$id_deteni'")
									or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

								// cek query
								if ($query) {
									// jika berhasil tampilkan pesan berhasil update data
									header("location: ../../main.php?module=deteni&alert=2");
								}
							} else {
								// Jika gambar gagal diupload, tampilkan pesan gagal upload
								header("location: ../../main.php?module=deteni&alert=5");
							}
						} else {
							// Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
							header("location: ../../main.php?module=deteni&alert=6");
						}
					} else {
						// Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
						header("location: ../../main.php?module=deteni&alert=7");
					}
				}
				// jika password diubah dan foto diubah
				else {
					// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
					if (in_array($extension, $allowed_extensions)) {
						// Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
						if ($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
							// Jika ukuran file kurang dari sama dengan 1MB, lakukan :
							// Proses upload
							if (move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
								// Jika gambar berhasil diupload, Lakukan : 
								// perintah query untuk mengubah data pada tabel users
								$query = mysqli_query($mysqli, "UPDATE is_users SET username 	= '$username',
			                    													nama_user 	= '$nama_user',
			                    													password    = '$password',
			                    													email       = '$email',
			                    													telepon     = '$telepon',
			                    													foto 		= '$nama_file',
			                    													hak_akses   = '$hak_akses'
			                                                                  WHERE id_user 	= '$id_user'")
									or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

								// cek query
								if ($query) {
									// jika berhasil tampilkan pesan berhasil update data
									header("location: ../../main.php?module=user&alert=2");
								}
							} else {
								// Jika gambar gagal diupload, tampilkan pesan gagal upload
								header("location: ../../main.php?module=user&alert=5");
							}
						} else {
							// Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
							header("location: ../../main.php?module=user&alert=6");
						}
					} else {
						// Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
						header("location: ../../main.php?module=user&alert=7");
					}
				}
			}
		}
	} elseif ($_GET['act'] == 'delete') {
		if (isset($_GET['id'])) {
			$id_deteni = $_GET['id'];

			// perintah query untuk menghapus data pada tabel deteni
			$query = mysqli_query($mysqli, "DELETE FROM deteni WHERE id_deteni='$id_deteni'")
				or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

			// cek hasil query
			if ($query) {
				// jika berhasil tampilkan pesan berhasil delete data
				header("location: ../../main.php?module=deteni&alert=8");
			}
		}
	}
}
?>