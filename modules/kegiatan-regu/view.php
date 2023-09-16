<!-- Aplikasi Persediaan Obat pada Apotek
*******************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 1 April 2017
* Website      : www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-sign-in icon-title"></i> Jurnal Regu

    <a class="btn btn-primary btn-social pull-right" href="?module=form_kegiatan_regu&form=add" title="Tambah Data" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <?php
      // fungsi untuk menampilkan pesan
      // jika alert = "" (kosong)
      // tampilkan pesan "" (kosong)
      if (empty($_GET['alert'])) {
        echo "";
      }
      // jika alert = 1
      // tampilkan pesan Sukses "Data Obat Masuk berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Jurnal Regu berhasil disimpan.
            </div>";
      } elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan file yang diupload bertipe *.jpg, *.jpeg, *.png.
            </div>";
      } elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan ukuran file tidak lebih dari 3MB.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel Obat -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Kode Jurnal</th>
                <th class="center">Tanggal</th>
                <th class="center">Nama Regu</th>
                <th class="center">Komandan</th>
                <th class="center">Kegiatan</th>
                <th class="center">Foto</th>
                <th class="center">Unduh</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel obat
              $query = mysqli_query($mysqli, "SELECT a.kode_transaksi, a.tanggal_masuk,a.jam_masuk, a.kode_regu, a.kegiatan, a.data, b.kode_regu, b.nama_regu, b.komandan
                                FROM is_regu_masuk as a INNER JOIN is_regu as b ON a.kode_regu = b.kode_regu
                                ORDER BY kode_transaksi DESC")
                or die('Ada kesalahan pada query tampil Data Obat Masuk: ' . mysqli_error($mysqli));
              // Tampilkan data
              while ($data = mysqli_fetch_assoc($query)) {
                $tanggal = $data['tanggal_masuk'];
                $exp = explode('-', $tanggal);
                $tanggal_masuk = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                // Menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
              <td width='30' class='center'>$no</td>
              <td width='80' class='center'>$data[kode_transaksi]</td>
              <td width='50' class='center'>$tanggal_masuk $data[jam_masuk]</td>
              <td width='50' class='center'>$data[nama_regu]</td>
              <td width='50'>$data[komandan]</td>
              <td width='150'>" . nl2br($data['kegiatan']) . "</td>
              <td width='100'>";

                // Menampilkan gambar
                if ($data['data'] != "") {
                  echo "<img src='foto/" . $data['data'] . "' width='100' height='100' alt='Gambar'>";
                } else {
                  echo "Tidak ada gambar";
                }

                echo "</td>
              <td class='center' width='50'>
                <div>
                  <a data-toggle='tooltip' data-placement='top' title='Download' style='margin-right:5px' class='btn btn-primary btn-sm' href='modules/kegiatan-regu/DownloadFile.php?file=$data[data]'>
                      <i style='color:#fff' class='glyphicon glyphicon-download'></i>
                  </a>
                </div>
              </td>
          </tr>";
                $no++;
              }

              ?>

            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content