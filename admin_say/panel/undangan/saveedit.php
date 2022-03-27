<?php
session_start();
		include __DIR__ . '/../../../conn/konfigurasi.php';
	include __DIR__ . '/../../../conn/filter.php';
	//include __DIR__ . '/../../../conn/konfigurasi.php';
//	include __DIR__ . '/../../../conn/filter.php';

	$id = mysql_real_escape_string($_GET['id']);
	$column		= $_GET["column"];
	$editval 	= $_GET["editval"];

	 	koneksi2_buka();
			$SQL = mysql_query("UPDATE tbl_bahan SET 
			" . $column . "='".$editval."'
			WHERE Kd_Bhn='".$id."'");
			if($SQL){
				echo json_encode("OK");
			}else{
				echo$id;
				}			
			koneksi2_tutup();
 ?>