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
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Deteni
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=data_deteni"> Data Deteni </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" enctype="multipart/form-data" action="modules/data-deteni/proses.php?act=insert" method="POST">
            <div class="box-body">
              <?php
              // fungsi untuk membuat id transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_deteni,6) as kode FROM is_deteni
                                                ORDER BY kode_deteni DESC LIMIT 1")
                or die('Ada kesalahan pada query tampil kode_obat : ' . mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                // mengambil data kode_deteni
                $data_id = mysqli_fetch_assoc($query_id);
                $kode    = $data_id['kode'] + 1;
              } else {
                $kode = 1;
              }

              // buat kode_deteni
              $buat_id   = str_pad($kode, 6, "0", STR_PAD_LEFT);
              $kode_deteni = "B$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Deteni</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="kode_deteni" value="<?php echo $kode_deteni; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Deteni</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_deteni" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Blok Deteni</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="blok_deteni" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Warga Negara</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="wn" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Asal Pengiriman</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="asal" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-5">
                  <input type="file" class="form-control" name="foto" autocomplete="off" required>
                </div>
              </div>

              <!--<div class="form-group">
                <label class="col-sm-2 control-label">Harga Beli</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="satuan" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value=""></option>
                    <option value="Botol">Botol</option>
                    <option value="Box">Box</option>
                    <option value="Kotak">Kotak</option>
                    <option value="Strip">Strip</option>
                    <option value="Tube">Tube</option>
                  </select>
                </div>
              </div>-->

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=data_deteni" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
<?php
}
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form'] == 'edit') {
  if (isset($_GET['id'])) {
    // fungsi query untuk menampilkan data dari tabel deteni
    $query = mysqli_query($mysqli, "SELECT kode_deteni,nama_deteni,blok_deteni,asal,wn FROM is_deteni WHERE kode_deteni='$_GET[id]'")
      or die('Ada kesalahan pada query tampil Data Deteni : ' . mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);
  }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Deteni
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=data_deteni"> Data Deteni </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/data-deteni/proses.php?act=update" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Deteni</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="kode_deteni" value="<?php echo $data['kode_deteni']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Deteni</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_deteni" autocomplete="off" value="<?php echo $data['nama_deteni']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Blok Deteni</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="blok_deteni" autocomplete="off" value="<?php echo $data['blok_deteni']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Warga Negara</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="wn" autocomplete="off" value="<?php echo $data['wn']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Asal Pengiriman</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="asal" autocomplete="off" value="<?php echo $data['asal']; ?>" required>
                </div>
              </div>

              <!--<div class="form-group">
                <label class="col-sm-2 control-label">Harga Beli</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($data['harga_beli']); ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($data['harga_jual']); ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="satuan" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value="<?php echo $data['satuan']; ?>"><?php echo $data['satuan']; ?></option>
                    <option value="Botol">Botol</option>
                    <option value="Box">Box</option>
                    <option value="Kotak">Kotak</option>
                    <option value="Strip">Strip</option>
                    <option value="Tube">Tube</option>
                  </select>
                </div>
              </div>-->

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=data_deteni" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>