<?php
//error_reporting(0);
session_start();
	include "../g-asset/conn_db.php";
	include "../g-asset/web_function.php";
	include "../g-asset/library_function.php";
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	$idkon= mysql_real_escape_string($_POST['idkon']);
	$idinv= mysql_real_escape_string($_POST['idinv']);
	$idsesi= mysql_real_escape_string($_POST['idsesi']);
	
	$dept= mysql_real_escape_string($_POST['dept']);
	$tanggal= mysql_real_escape_string($_POST['tanggal']);
	$ho= mysql_real_escape_string($_POST['ho']);
	
	$total= mysql_real_escape_string($_POST['total']);
	$bayar= mysql_real_escape_string($_POST['bayar']);
	// validasi agar tidak ada data yang kosong
	//cek pilihan
	// deklarasikan variabel
	$cek=$_POST['produk'];
	$jumlah=count($cek);
	for($a=0; $a<$jumlah; $a++){
	$prod 	= $_POST['produk'][$a];
	$ket 	= $_POST['ket'][$a];
	$jml 	= $_POST['jml'][$a];
	$harga 	= $_POST['harga'][$a];
	$diskon = $_POST['diskon'][$a];
	$nta 	= $_POST['nta'][$a];
	$tax 	= $_POST['tax'][$a];
	$profit	= $_POST['profit'][$a];
	
	mysql_query("UPDATE invoice_detail SET id_produk	= '$prod',
									keterangan			= '$ket',
									jumlah				= '$jml',
									harga_jual			= '$harga',
									diskon				= '$diskon',
									nta					= '$nta',
									tax					= '$tax',
									profit				= '$profit'
                                    WHERE id_invoice  = '19'");	

		save_alert('save',save);
		htmlRedirect('?'.$mode.'='.$module);
}
}
 ?>