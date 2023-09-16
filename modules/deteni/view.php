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
    <i class="fa fa-user icon-title"></i> Data Deteni

    <a class="btn btn-primary btn-social pull-right" href="?module=form_deteni1&form=add" title="Tambah Data" data-toggle="tooltip">
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
      // tampilkan pesan Sukses "Data Deteni baru berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data user baru berhasil disimpan.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Data Deteni berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data user berhasil diubah.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "User berhasil diaktifkan"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              User berhasil diaktifkan.
            </div>";
      }
      // jika alert = 4
      // tampilkan pesan Sukses "User berhasil diblokir"
      elseif ($_GET['alert'] == 4) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              User berhasil diblokir.
            </div>";
      }
      // jika alert = 5
      // tampilkan pesan Upload Gagal "Pastikan file yang diupload sudah benar"
      elseif ($_GET['alert'] == 5) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan file yang diupload sudah benar.
            </div>";
      }
      // jika alert = 6
      // tampilkan pesan Upload Gagal "Pastikan ukuran foto tidak lebih dari 1MB"
      elseif ($_GET['alert'] == 6) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan ukuran foto tidak lebih dari 1MB.
            </div>";
      }
      // jika alert = 7
      // tampilkan pesan Upload Gagal "Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
      elseif ($_GET['alert'] == 7) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG.
            </div>";
      }
      // jika alert = 8
      // tampilkan pesan Sukses "Data Deteni berhasil dihapus"
      elseif ($_GET['alert'] == 8) {
        echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                Data Deteni berhasil dihapus.
              </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel user -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Foto</th>
                <th class="center">Nama Deteni</th>
                <th class="center">Blok Deteni</th>
                <th class="center">Catatan</th>
                <th class="center">Status</th>
                <th class="center">Aksi</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;
              /// fungsi query untuk menampilkan data dari tabel user
              $query = mysqli_query($mysqli, "SELECT * FROM deteni ORDER BY id_deteni DESC")
                or die('Ada kesalahan pada query tampil data user: ' . mysqli_error($mysqli));

              // tampilkan data
              while ($data = mysqli_fetch_assoc($query)) {
                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                      <td width='50' class='center'>$no</td>";

                if ($data['foto'] == "") { ?>
                  <td class='center'><img class='img-deteni' src='images/deteni/deteni-default.png' width='45'></td>
                <?php
                } else { ?>
                  <td class='center'><img class='img-deteni' src='images/deteni/<?php echo $data['foto']; ?>' width='45'></td>
                <?php
                }

                echo "  <td>$data[nama_deteni]</td>
                      <td>$data[blok]</td>
                      <td>$data[catatan]</td>
                      <td>$data[status]</td>

                      <td class='center' width='100'>
                          <div>";

                echo "       <div>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_deteni1&form=edit&id=$data[id_deteni]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>";


                if ($_SESSION['hak_akses'] == 'Super Admin') { ?>
                  <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/deteni/proses.php?act=delete&id=<?php echo $data['id_deteni']; ?>" onclick="return confirm('Anda yakin ingin menghapus Deteni <?php echo $data['nama_deteni']; ?> ?');">
                    <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                  </a>

                <?php
                  echo "    </div>
                      </td>
                    </tr>";
                  $no++;
                } else if ($_SESSION['hak_akses'] == "Kepala") { ?>
                  <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/deteni/proses.php?act=delete&id=<?php echo $data['id_deteni']; ?>" onclick="return confirm('Anda yakin ingin menghapus Deteni <?php echo $data['nama_deteni']; ?> ?');">
                    <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                  </a>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content