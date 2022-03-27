<?php
include 'dbConfig.php';
//include "../g-asset/conn_db.php";
$companyTxt = $_GET['term'];
if (isset($companyTxt)){
    $dbArray = array();
	$companyTxt=mysql_real_escape_string($companyTxt);
    $query=mysql_query("SELECT nama_produk FROM produk WHERE nama_produk like '%$companyTxt%'");	
	while($rows = mysql_fetch_array($query))
		{
		$dbArray[] =$rows['nama_produk'];
		}
    echo json_encode($dbArray);
}
?>