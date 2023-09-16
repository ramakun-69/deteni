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
    <i class="fa fa-sign-in icon-title"></i> Progress Deteni

    <a class="btn btn-primary btn-social pull-right" href="?module=form_progress_deteni&form=add" title="Tambah Data" data-toggle="tooltip">
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
              Data Progress Deteni berhasil disimpan.
            </div>";
      } elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan file yang diupload bertipe *.doc, *.docx, *.pdf.
            </div>";
      } elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan ukuran file tidak lebih dari 2MB.
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
                <th class="center">Kode Progress</th>
                <th class="center">Tanggal</th>
                <th class="center">Kode Deteni</th>
                <th class="center">Nama Deteni</th>
                <th class="center">Progress</th>
                <th class="center">File</th>
                <th class="center">Aksi</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel obat
              $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_masuk,a.kode_deteni,a.progress,a.data,b.kode_deteni,b.nama_deteni
                                            FROM is_obat_masuk as a INNER JOIN is_deteni as b ON a.kode_deteni=b.kode_deteni ORDER BY kode_transaksi DESC")
                or die('Ada kesalahan pada query tampil Data Obat Masuk: ' . mysqli_error($mysqli));

              // tampilkan data
              while ($data = mysqli_fetch_assoc($query)) {
                $tanggal         = $data['tanggal_masuk'];
                $exp             = explode('-', $tanggal);
                $tanggal_masuk   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='100' class='center'>$data[kode_transaksi]</td>
                      <td width='80' class='center'>$tanggal_masuk</td>
                      <td width='50' class='center'>$data[kode_deteni]</td>
                      <td width='50'>$data[nama_deteni]</td>
                      <td width='100'>$data[progress]</td>
                      <td width='100'>$data[data]</td>
                      <td class='center' width='50'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Download' style='margin-right:5px' class='btn btn-primary btn-sm' href='modules/progress-deteni/DownloadFile.php?file=$data[data]'>
                              <i style='color:#fff' class='glyphicon glyphicon-download'></i>
                          </a>";
                echo "    </div>
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