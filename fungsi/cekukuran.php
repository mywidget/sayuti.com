<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
// error_reporting(0);
// include "../conn/referer.php";
// if (($referer==$host OR $referer==$host.'index.php')){
include "../class/conn_db.php";
include "../fungsi/reader.php";

$lbrcetak= isset($_GET['lbrcetak']) ? $_GET['lbrcetak'] : '';
$tgcetak= isset($_GET['tgcetak']) ? $_GET['tgcetak'] : '';
$muat = 'N';
$data = array();
//Mulai Hitung Ongkos Cetak dan mesin	
	$sql = $db->query("select * from mesin where aktif='Y'");
	while($row=$sql->fetch_array()){;  // mesin yg di ceklis
		$lebartext = $row['lebarcetak'];
		$tinggitext = $row['panjangcetak'];
		$hitpot = hitung($lbrcetak,$tgcetak, $lebartext, $tinggitext);
		$jmlpot = $hitpot[0]['jml'];
		if ($jmlpot > 0){ 
			$muat = 'Y';
		}	
		//	echo $lebartext . "x" . $tinggitext . "=" .$jmlpot . "<br>";
	}	
if ($muat == 'N'){
$data = array('N');	
}else{
$data = array('Y');		
}
	
echo json_encode($data);
// }else{
// echo json_encode(array(401 => "Akses ditolak"));	
// }

?>