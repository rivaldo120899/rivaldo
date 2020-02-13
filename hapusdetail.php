<?php 

include_once("koneksi.php");

$id_detail = $_GET['id_detail'];

$result = pg_query($conn, "DELETE FROM detail WHERE id_detail = $id_detail");

header('Location: tambahfaktur.php');

?>