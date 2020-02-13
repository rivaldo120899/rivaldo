<?php 

include_once(koneksi.php);

if(isset($_POST['update'])){

	$id = $_POST['id'];
	$namabarang = $_POST['namabarang'] ;
	$hargabarang = $_POST['hargabarang'];

	$result = pg_query($conn , "UPDATE penjualan SET id='$id', namabarang='$namabarang', hargabarang='$hargabarang' WHERE id=$id");

	echo '<META HTTP-EQUIV="Refresh"
	Content="0;URL=index.php">';
	exit;
}

 ?>

<?php 

$id = $_GET['id'];
$namabarang = $_POST['namabarang'] ;
$hargabarang = $_POST['hargabarang'];
$result = pg_query($conn, "SELECT * FROM penjualan WHERE id=$id");

while($user_data = pg_fetch_assoc($result))
{
	$id=$user_data['id'];
	$namabarang=$user_data['namabarang'];
	$hargabarang=$user_data['hargabarang'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH DATA</title>
</head>
<body>

	<a href="index.php"></a>
	<br>

	<form action="" method="post">
		<li>
			<ul>
				<label>ID          : </label>
				<input type="text" name="id" value=<?php echo $_GET['id'];?>>
			</ul>
			<ul>
				<label>Nama Barang : </label>
				<input type="text" name="namabarang" value=<?php echo $namabarang;?>>
			</ul>
			<ul>
				<label>Harga Barang : </label>
				<input type="text" name="hargabarang" value=<?php echo $hargabarang;?>>
			</ul>
			<ul>
				<input type="submit" name="update" value="update">
			</ul>
		</li>
	</form>
</body>
</html>