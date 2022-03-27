<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "../class/conn_db.php";
$ukuran= $_GET['ukuran'];
$data = array();
		$sql = $db->query("select * from ukuran_plano where id='$ukuran'");
		$row=$sql->fetch_array() ;   
$data = array(number_format($row['panjang'],1),number_format($row['lebar'],1),);	

echo json_encode($data);
// }
?>