<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "../class/conn_db.php";
include "../class/filter.inc.php";
if(filterpost('type') == 'simpan_biaya'){
	$biaya = filterpint('biaya');
	$SQL = $db->query("UPDATE tbl_biaya SET HargaMin='$biaya' where KdBiaya='66'");
	if($SQL){
		echo json_encode("OK");
	}else{
		echo json_encode("ERROR");
	}

}
?>
