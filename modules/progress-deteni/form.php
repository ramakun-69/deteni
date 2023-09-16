<!-- Aplikasi Persediaan Obat pada Apotek
*******************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 1 April 2017
* Website      : www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<script type="text/javascript">
  function tampil_obat(input) {
    var num = input.value;

    $.post("modules/progress-deteni/obat.php", {
      dataidobat: num,
    }, function(response) {
      $('#stok').html(response)

      document.getElementById('jumlah_masuk').focus();
    });
  }

  function cek_jumlah_masuk(input) {
    jml = document.formObatMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
      alert('Jumlah Masuk Tidak Boleh Nol !!');
      input.value = input.value.substring(0, input.value.length - 1);
    }
  }

  function hitung_total_stok() {
    bil1 = document.formObatMasuk.stok.value;
    bil2 = document.formObatMasuk.jumlah_masuk.value;

    if (bil2 == "") {
      var hasil = "";
    } else {
      var hasil = eval(bil1) + eval(bil2);
    }

    document.formObatMasuk.total_stok.value = (hasil);
  }
</script>

<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Progress Deteni
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=progress_deteni"> Progress Deteni </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/progress-deteni/proses.php?act=insert" method="POST" name="formObatMasuk" enctype="multipart/form-data">
            <div class="box-body">
              <?php
              // fungsi untuk membuat kode transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_transaksi,7) as kode FROM is_obat_masuk
                                                ORDER BY kode_transaksi DESC LIMIT 1")
                or die('Ada kesalahan pada query tampil kode_transaksi : ' . mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                // mengambil data kode transaksi
                $data_id = mysqli_fetch_assoc($query_id);
                $kode    = $data_id['kode'] + 1;
              } else {
                $kode = 1;
              }

              // buat kode_transaksi
              $tahun          = date("Y");
              $buat_id        = str_pad($kode, 7, "0", STR_PAD_LEFT);
              $kode_transaksi = "TM-$tahun-$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Proges</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $kode_transaksi; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_masuk" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                </div>
              </div>

              <hr>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Deteni</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="kode_deteni" data-placeholder="-- Pilih Deteni --" onchange="tampil_deteni(this)" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_deteni = mysqli_query($mysqli, "SELECT kode_deteni, nama_deteni FROM is_deteni ORDER BY nama_deteni ASC")
                      or die('Ada kesalahan pada query tampil obat: ' . mysqli_error($mysqli));
                    while ($data_deteni = mysqli_fetch_assoc($query_deteni)) {
                      echo "<option value=\"$data_deteni[kode_deteni]\"> $data_deteni[kode_deteni] | $data_deteni[nama_deteni] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <!-- <span id='stok'>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Stok</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="stok" name="stok" readonly required>
                  </div>
                </div>
              </span>-->

              <!--<div class="form-group">
                <label class="col-sm-2 control-label">Progress</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="progress" name="jumlah_masuk" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)" required>
                </div>
              </div>-->

              <div class="form-group">
                <label class="col-sm-2 control-label">Progress</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="progress" name="progress" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Upload File</label>
                <label>File Harus Berformat *.doc, *.docx, atau *.pdf</label>
                <div class="col-sm-5">
                  <input type="file" class="form-control" id="data" name="data" autocomplete="off" required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=progress_deteni" class="btn btn-default btn-reset">Batal</a>
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