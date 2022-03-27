<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
// error_reporting(0);
include "../class/conn_db.php";
include "../fungsi/reader.php";

$id= isset($_GET['id']) ? $_GET['id'] : '';
$ada = 'N';

$data = array();
//Mulai Hitung Ongkos Cetak dan mesin	
	$sql = $db->query("SELECT id_kategori FROM tbl_bahan WHERE id_kategori='".$id."' AND Harga_Bahan > 0");
	$ketemu=$sql->num_rows;
//echo $ketemu;
	if ($ketemu > 0){
			$ada = 'Y';
		}	
		//	echo $lebartext . "x" . $tinggitext . "=" .$jmlpot . "<br>";

if ($ada == 'N'){
$data = array('N');	
}else{
$data = array('Y');		
}
	
echo json_encode($data);
?>