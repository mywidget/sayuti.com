<?php
// error_reporting(0);
session_start();
if (empty($_SESSION['mailuser'])){
echo json_encode(array(404 => "error"));
}else{
	include __DIR__ . '/../../../conn/konfigurasi.php';
	include __DIR__ . '/../../../conn/filter.php';
	$type = $_POST['typep'];
	switch ($type) {
		//Tampilkan Data 
		case "get":
			koneksi2_buka();
			$data = array();
			$SQL = mysql_query("SELECT * FROM ukuran_plano WHERE id=".sanitize($_POST['idp']));
			$return = mysql_fetch_array($SQL,MYSQL_ASSOC);
			$data = array(
				'id' => $return['id'],
				'nama' => $return['ket_ukuran'],
				'panjang' => $return['panjang'],
				'lebar' => $return['lebar']
				);	
			echo json_encode($data);
			koneksi2_tutup();
			break;
		
		//Tambah Data	
		case "new":
		koneksi2_buka();
			$nama = sanitize($_POST['namap']);
			$panjang = sanitize($_POST['panjangp']);
			$lebar = sanitize($_POST['lebarp']);
			$SQL = mysql_query("INSERT INTO ukuran_plano 
			SET ket_ukuran='".$nama."',
			panjang='".$panjang."', 
			lebar='".$lebar."'");
			if($SQL){
				echo json_encode("OK");
			}
			koneksi2_tutup();
			break;
			
		//Edit Data	
		case "edit":
		koneksi2_buka();
			$id = sanitize($_POST['idp']);$nama = sanitize($_POST['namap']);
			$panjang = sanitize($_POST['panjangp']);$lebar = sanitize($_POST['lebarp']);
			$SQL = mysql_query("UPDATE ukuran_plano SET 
			ket_ukuran='".$nama."', 
			panjang='".$panjang."', 
			lebar='".$lebar."'
			WHERE Kd_Bhn='".$id."'");
			if($SQL){
				echo json_encode("OK");
			}			
			koneksi2_tutup();
			break;
			
		//Hapus Data	
		case "delete":
		koneksi2_buka();
		$SQL = mysql_query("DELETE FROM ukuran_plano WHERE id=".sanitize($_POST['idp']));
			if($SQL){
				echo json_encode("OK");
			}
			koneksi2_tutup();
			break;
	} 
	}
?>