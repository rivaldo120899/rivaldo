<?php 

session_start();

include 'koneksi.php';

if(!isset($_SESSION['login'])){
  header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>VansHouse - EDITBARANG</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="home.php">VansHouse</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
       <li class="nav-item active">
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>Database Faktur</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="newfaktur.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tambah Faktur</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="barang.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Barang</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <!--FORM-->

      <div class="container-fluid"> 
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Tambah Faktur</div>
          <div class="card-body">

        <form method="get" action="">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Faktur</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="No_Faktur" required="required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Pembeli</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="ID_Pembeli" required="required autocomplete="off">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="submitfaktur">TAMBAH</button>

            <?php 

            if(isset($_GET['submitfaktur'])){
            $No_Faktur = $_GET['No_Faktur'] ;
            $ID_Pembeli = $_GET['ID_Pembeli'] ;
            $Username = $_SESSION['username'];  

            $_SESSION['No_Faktur'] = $No_Faktur;
            $_SESSION['ID_Pembeli'] = $ID_Pembeli;

            $ambilkasir = pg_query($conn,"SELECT * FROM kasir WHERE username='$Username'");

                while( $kodekasir = pg_fetch_assoc($ambilkasir)){
                  $ID_Kasir = $kodekasir['id_kasir'];
                }

            $result = pg_query($conn, "INSERT INTO faktur (no_faktur,id_pembeli,id_kasir) values ('$No_Faktur','$ID_Pembeli','$ID_Kasir')");

            header('Location: tambahfaktur.php');
 
            }


            ?>

            <br>
        
              </form>
            </div>
          </div>
      </div>

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © VansHouse 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
