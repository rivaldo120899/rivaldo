<?php 

session_start();

include 'koneksi.php';

if(isset($_SESSION['login'])){
  header('Location: home.php');
}

if(isset($_POST['login'])){

  $Username = $_POST['username'];
  $Password = $_POST['password'];

  $result = pg_query($conn,"SELECT * FROM kasir where username='$Username'");

  $num = pg_num_rows($result);

  if($num > 0){
      $row = pg_fetch_assoc($result);

      if($row['password'] == $Password){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $Username;
        header('Location: home.php');
      }

  }

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

  <title>VansHouse</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <br><br><br><br><br><br><br>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
              <label for="inputUsername">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <input type="submit" name="login" class="btn btn-primary btn-block">
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>