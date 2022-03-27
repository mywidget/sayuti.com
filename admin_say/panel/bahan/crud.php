<?php
// error_reporting(0);
session_start();
if (empty($_SESSION['mailuser'])){
echo json_encode(array(404 => "error"));
}else{
	include __DIR__ . '/../../../conn/konfigurasi.php';
	include __DIR__ . '/../../../conn/filter.php';
	// include __DIR__ . '/../../../lib/function.php';
	$type = $_POST['type'];
	switch ($type) {
		//Tampilkan Data 
		case "get":
			koneksi2_buka();
			$data = array();
			$SQL = mysql_query("SELECT * FROM tbl_bahan WHERE Kd_Bhn=".sanitize($_POST['id']));
			$return = mysql_fetch_array($SQL,MYSQL_ASSOC);
			$data = array(
				'id' => $return['Kd_Bhn'],
				'cat' => $return['id_kategori'],
				'nama' => $return['Nm_Bhn'],
				'harga' => $return['Harga_Bahan'],
				'tinggi' => $return['Tinggi'],
				'lebar' => $return['Lebar'],
				'tebal' => $return['Tebal'],
				'pub' => $return['publish']
				);	
			echo json_encode($data);
			koneksi2_tutup();
			break;
		
		//Tambah Data	
		case "new":
		koneksi2_buka();
			$cat = sanitize($_POST['cat']);
			$nama = sanitize($_POST['nama']);
			$harga = sanitize($_POST['harga']);
			$tinggi = sanitize($_POST['tinggi']);
			$lebar = sanitize($_POST['lebar']);
			$tebal = sanitize($_POST['tebal']);
			$pub = $_POST['pub'];
			$SQL = mysql_query("INSERT INTO tbl_bahan 
			SET  id_kategori='".$cat."', 
			Nm_Bhn='".$nama."', 
			Harga_Bahan='".$harga."', 
			Tinggi='".$tinggi."', 
			Lebar='".$lebar."', 
			Tebal='".$tebal."', 
			publish='".$pub."'");
			if($SQL){
				echo json_encode("OK");
			}
			koneksi2_tutup();
			break;
			
		//Edit Data	
		case "edit":
		koneksi2_buka();
			$id = sanitize($_POST['id']);$cat = sanitize($_POST['cat']);$nama = sanitize($_POST['nama']);$harga = sanitize($_POST['harga']);
			$tinggi = sanitize($_POST['tinggi']);$lebar = sanitize($_POST['lebar']);$tebal = sanitize($_POST['tebal']);$pub = sanitize($_POST['pub']);
			$SQL = mysql_query("UPDATE tbl_bahan SET 
			id_kategori='".$cat."', 
			Nm_Bhn='".$nama."', 
			Harga_Bahan='".$harga."', 
			Tinggi='".$tinggi."', 
			Lebar='".$lebar."', 
			Tebal='".$tebal."', 
			publish='".$pub."'
			WHERE Kd_Bhn='".$id."'");
			if($SQL){
				echo json_encode("OK");
			}			
			koneksi2_tutup();
			break;
			
		//Hapus Data	
		case "delete":
		koneksi2_buka();
	$SQL = mysql_query("DELETE FROM tbl_bahan WHERE Kd_Bhn=".sanitize($_POST['id']));
			if($SQL){
				echo json_encode("OK");
			}
			koneksi2_tutup();
			break;
	} 
	}
?>