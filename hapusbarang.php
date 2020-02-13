<?php 

include_once("koneksi.php");

$KodeBarang = $_GET['kodebarang'];

$result = pg_query($conn, "DELETE FROM barang WHERE kodebarang = '$KodeBarang'");

header('Location: barang.php');

 ?>