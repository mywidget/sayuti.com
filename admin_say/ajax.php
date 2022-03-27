<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/
require_once 'config.php';
if($_POST['type'] == 'produk_table'){
	$row_num = $_POST['row_num'];
	$name = $_POST['name_startsWith'];
	$query = "SELECT kode_produk, stokout, hargajual, diskon FROM produk where UPPER(kode_produk) LIKE '%".strtoupper($name)."%'";
	$result = mysqli_query($con, $query);
	$rowcount=mysqli_num_rows($result);
	$data = array();
	if($rowcount >0){
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['kode_produk'].'|'.$row['hargajual'].'|'.$row['diskon'].'|'.$row_num;
		array_push($data, $name);
	}
	echo json_encode($data);
	}else{
	array_push($data, 'Data tidak ditemukan');
	echo json_encode($data);
	}
}