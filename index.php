
<?php
session_start();
require_once "config/database.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Admin Panel | Aplikasi Progess Deteni</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Aplikasi Persediaan Obat pada Apotek">
  <meta name="author" content="Indra Styawantoro" />

  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/pengayoman.png" />

  <!-- Bootstrap 3.3.2 -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <!-- Datepicker -->
  <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
  <!-- Chosen Select -->
  <link rel="stylesheet" type="text/css" href="assets/plugins/chosen/css/chosen.min.css" />
  <!-- Theme style -->
  <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link href="assets/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
  <!-- Date Picker -->
  <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

  

</head>

<body class="skin-blue fixed">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="?module=beranda" class="logo">
        <img style="margin-top:px;margin-right:5px" src="assets/img/pengayoman.png" alt="Logo" width="40px">
        <b><span style="font-size:15px">PROGRESS DETENI</span></b>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <?php if (empty($_SESSION['username']) && empty($_SESSION['password'])) { ?>
                <a href="login.php">
                    <span class="btn btn-sm btn-success">Login <i style="margin-left:5px" class=""></i></span>
                </a>
           <?php } else { ?>
                <a href="main.php?module=beranda">
                    <span class="btn btn-sm btn-success">Dashboard<i style="margin-left:5px" class=""></i></span>
                </a>    
           <?php } ?>
          </li>
     

          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
      <ul class="sidebar-menu">
         <li class="header">MAIN MENU</li>
         <li class="active">
            <a href=""><i class="fa fa-folder"></i> Data Deteni </a>
        </li>

      </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    <section class="content-header">
  <h1>
    <i class="fa fa-sign-in icon-title"></i> Progress Deteni
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
                <th class="center">Foto</th>
              
               
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel obat
              try {
                $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_masuk,a.kode_deteni,a.progress,a.data,b.kode_deteni,b.nama_deteni,b.foto
                    FROM is_obat_masuk as a INNER JOIN is_deteni as b ON a.kode_deteni=b.kode_deteni ORDER BY kode_transaksi DESC");
                } catch (Exception $e) {
                    die('Ada kesalahan pada query tampil Data Obat Masuk: ' . $e->getMessage());
                }
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
                      <td width='100'>
                      <img src='images/deteni/$data[foto]' width='70%' alt=''>
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
     

      <!-- Modal Logout -->
      <div class="modal fade" id="logout">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><i class="fa fa-sign-out"> Logout</i></h4>
            </div>
            <div class="modal-body">
              <p>Apakah Anda yakin ingin logout? </p>
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-danger" href="logout.php">Ya, Logout</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
      <strong>Copyright &copy; 2023 - <a href=" ">Rudenim Surabaya</a>.</strong>
    </footer>
  </div><!-- ./wrapper -->

  <!-- jQuery 2.1.3 -->
  <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- datepicker -->
  <script src="assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
  <!-- chosen select -->
  <script src="assets/plugins/chosen/js/chosen.jquery.min.js"></script>
  <!-- DATA TABES SCRIPT -->
  <script src="assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  <!-- Datepicker -->
  <script src="assets/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
  <!-- Slimscroll -->
  <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='assets/plugins/fastclick/fastclick.min.js'></script>
  <!-- maskMoney -->
  <script src="assets/js/jquery.maskMoney.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/js/app.min.js" type="text/javascript"></script>
  <script>
      // DataTables
      $("#dataTables1").dataTable();
      $('#dataTables2').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
      });
  </script>

</body>

</html>