<?php
session_start();
if (empty($_SESSION['mailuser'])){
echo json_encode("ERROR LOGIN");
}else{
	include __DIR__ . '/../../../conn/konfigurasi.php';
	include __DIR__ . '/../../../conn/filter.php';
	$id		= filterpint('id');
	$harga	= filterpost('harga');
	$tinggi	= filterpost('tinggi');
	$lebar	= filterpost('lebar');
	$tebal	= filterpost('tebal');
	// $nama	= $_POST['nama'];
	$pub	= $_POST['pub'];

	 	koneksi2_buka();
			$SQL = mysql_query("UPDATE tbl_bahan SET 
			Harga_Bahan='".$harga."', 
			Tinggi='".$tinggi."', 
			Lebar='".$lebar."', 
			Tebal='".$tebal."', 
			publish='".$pub."'
			WHERE Kd_Bhn='".$id."'");
			if($SQL){
				echo json_encode("OK");
			}else{
				echo json_encode("ERROR");
				}			
			koneksi2_tutup();
}
 ?>