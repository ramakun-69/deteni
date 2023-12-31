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
    <i class="fa fa-folder-o icon-title"></i> Data Regu

    <a class="btn btn-primary btn-social pull-right" href="?module=form_regu&form=add" title="Tambah Data" data-toggle="tooltip">
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
      // tampilkan pesan Sukses "Data obat baru berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data regu baru berhasil disimpan.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Data obat berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data regu berhasil diubah.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "Data obat berhasil dihapus"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data regu berhasil dihapus.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel obat -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Kode Regu</th>
                <th class="center">Nama Komandan</th>
                <th class="center">Anggota</th>
                <th class="center">Nama Regu</th>
                <th class="center">Aksi</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel regu
              $query = mysqli_query($mysqli, "SELECT kode_regu,komandan,anggota,nama_regu FROM is_regu ORDER BY kode_regu DESC")
                or die('Ada kesalahan pada query tampil Data Regu: ' . mysqli_error($mysqli));

              // tampilkan data
              while ($data = mysqli_fetch_assoc($query)) {

                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[kode_regu]</td>
                      <td width='180'>$data[komandan]</td>
                      <td width='180'>$data[anggota]</td>
                      <td width='100'>$data[nama_regu]</td>
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_regu&form=edit&id=$data[kode_regu]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>";
              ?>
                <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/data-regu/proses.php?act=delete&id=<?php echo $data['kode_regu']; ?>" onclick="return confirm('Anda yakin ingin menghapus regu <?php echo $data['komandan']; ?> ?');">
                  <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                </a>
              <?php
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