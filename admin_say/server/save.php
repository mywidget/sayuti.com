<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
//error_reporting(0);
$harga = intval($_GET['harga']);
//echo intval($_GET['jumlah']) ."<br>";
//echo intval($_GET['diskon']) ."<br>";
//e/cho intval($_GET['nta']) ."<br>";
//echo intval($_GET['tax']) ."<br>";
//$id= intval($_GET['keterangan']) ."<br>";
$id= $_SESSION['id_rincian'];

//error_reporting(0);

	include "../g-asset/conn_db.php";
	include "../g-asset/web_function.php";
	include "../g-asset/library_function.php";

	// validasi agar tidak ada data yang kosong
	//cek pilihan
	// deklarasikan variabel

	
	mysql_query("UPDATE invoice_detail 	set harga_jual			= '$harga'
									
                                    WHERE id_rincianinvoice  = '$id'");	

?>
</body>
</html>