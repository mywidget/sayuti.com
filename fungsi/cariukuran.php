<?php 
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
// error_reporting(0);
// include "../conn/referer.php";
// if (($referer==$host OR $referer==$host.'index.php')){
include "../class/conn_db.php";
// include "../function/fungsi-fungsi.php";

$ukuran= $_GET['ukuran'];
$data = array();
		$sql = $db->query("select * from ukuran_kertas where id='$ukuran'");
		$row=$sql->fetch_array() ;   
$data = array(number_format($row['panjang'],1),number_format($row['lebar'],1),);	
echo json_encode($data);
// }else{
// echo json_encode(array(401 => "Akses ditolak"));	
// }

?>