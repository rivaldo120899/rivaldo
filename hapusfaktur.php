<?php 

include_once("koneksi.php");

$no_faktur = $_GET['no_faktur'];

$result = pg_query($conn, "DELETE FROM faktur WHERE no_faktur = $no_faktur");

header('Location: tambahfaktur.php');

 ?>