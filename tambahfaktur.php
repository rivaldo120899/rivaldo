<?php 
session_start();

include 'koneksi.php';

$No_Faktur = $_SESSION['No_Faktur'];
$ID_Pembeli = $_SESSION['ID_Pembeli'];

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

  <title>VansHouse - HOME</title>

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

        <form action="" method="post">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-sm-10">
                  <select name="KodeBarang" class="form-control" id="exampleFormControlSelect1">
                    <?php 

                    $koderesult = pg_query($conn,"SELECT * FROM barang ORDER BY kodebarang");
                    while($kode = pg_fetch_assoc($koderesult))  : ;  ?>

                         <option value="<?php echo $kode['kodebarang'];?>"><?php echo $kode['kodebarang']; ?></option>

                   <?php endwhile; ?>

                 </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Banyak Barang</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="BanyakBarang" placeholder="Banyak Barang" autocomplete="off">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="tambahfaktur">Submit</button>

            <br>
        
              </form>
            </div>
          </div>
      </div>

    <?php 

      if(isset($_POST['tambahfaktur'])){

      $KodeBarang = $_POST['KodeBarang'];
      $BanyakBarang = $_POST['BanyakBarang'];
      $Username = $_SESSION['username'];

      $ambilkasir = pg_query($conn,"SELECT * FROM kasir WHERE username='$Username'");

      while( $kodekasir = pg_fetch_assoc($ambilkasir)){
        $ID_Kasir = $kodekasir['id_kasir'];
      }

      $result = pg_query($conn, "INSERT INTO detail (no_faktur,kodebarang,banyakbarang) values ('$No_Faktur','$KodeBarang',$BanyakBarang)");

      }

    ?>

      <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <blockquote class="blockquote text-center">
              <p class="mb-0"><h3>VansHouse</h3></p>
            </blockquote>
          </div>
          <div class="card-body">
            <h5 >No. Faktur : <?php echo $No_Faktur; ?></h5>
            <h5 >ID_Pembeli : <?php echo $ID_Pembeli; ?></h5>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Banyak Barang</th>
                    <th>Total Harga</th>
                    <th>EDIT</th>
                  </tr>
                </thead>

                <tbody>

                <?php 

                    $ambil = pg_query($conn,"SELECT * FROM faktur,barang,detail WHERE faktur.no_faktur='$No_Faktur' and faktur.no_faktur = detail.no_faktur and detail.kodebarang = barang.kodebarang");

                    $Total = 0;

                    while($data = pg_fetch_assoc($ambil)){

                     $TotalHarga = $data['hargabarang'] * $data['banyakbarang']

                     ?>
                    
                     <tr>
                      <td><?php echo $data['kodebarang']; ?></td>
                      <td><?php echo $data['namabarang']; ?></td>
                      <td><?php echo $data['hargabarang']; ?></td>
                      <td><?php echo $data['banyakbarang']; ?></td>
                      <td><?php echo $TotalHarga ?></td>
                      <td><a href="hapusdetail.php?id_detail=<?php echo $data['id_detail']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                     </tr>

                    <?php 

                    $Total = $Total + $TotalHarga;


                    } ?>

                 </tbody>

                 <tr>
                    <th colspan="4">Total Faktur</th>
                    <th colspan="2"><?php echo $Total ;?></th>
                 </tr>

              </table>
            </div>
            <br>
            <a href="newfaktur.php"><button class="btn btn-primary" type="submit" name="savefaktur">SAVE</button></a>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>
      </div>
      <!-- /.container-fluid -->

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
