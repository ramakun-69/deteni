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
if ($_SERVER['HTTP_HOST'] === 'localhost:8080') {
  $base_url = "http://localhost:8080/aplikasi-penjagaan/";
} else {
  // Aplikasi berjalan di lingkungan online
  $base_url = "tentukan domain anda";
}
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
  $module = "beranda";
  $redirect_url = $base_url . "main.php?module=$module";
  header("Location: $redirect_url");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Persediaan Obat dan Apotek">
    <meta name="author" content="PT.ERASITES CITRA DIGITAL INDONESIA">

    <title>Login | Aplikasi Progress Deteni</title>
    <link rel="shortcut icon" href="assets/img/pengayoman.png" />
    <!-- Custom fonts for this template-->
    <link href="assets/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="" style="background-image: url('assets/bg.png'); background-size: auto;">

    <div class="container" style="z-index: 9999;">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                           <div class="col-lg-6 ">
                            <div class="p-5">
                              <h3 class="text-center">Welcome to Website</h3>
                              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et voluptas libero ex commodi iure. Error ullam porro maiores laboriosam. Totam consectetur quos tenetur et illum tempora modi amet aliquam ipsam.</p>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                    <img   src="assets/img/pengayoman.png" alt="Logo" height="50"> <b>PROGRESS DETENI</b> <br><br>
                                    </div>
                                    <form class="user" action="login-check.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="username"
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="home.php" class="btn btn-danger btn-user btn-block">Home</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/sbadmin/js/sb-admin-2.min.js"></script>

</body>

</html>