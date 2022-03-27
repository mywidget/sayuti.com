<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
// if (empty($_SESSION['namauser'])){
// echo json_encode(array(404 => "error"));
// }else{
include "../class/conn_db.php";
//hitungcetak(
$ukuran= $_GET['ukuran'];
$data = array();
		$sql = $db->query("select * from tbl_bahan where id_kategori='$ukuran'");
		$row=$sql->fetch_array() ;   
$data = array(number_format($row['Tinggi'],1),number_format($row['Lebar'],1),);	
echo json_encode($data);
// }
?>