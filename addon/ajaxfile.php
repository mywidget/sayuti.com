<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "../class/conn_db.php";
include "../class/alert.php";
include "../class/referer.php";
include "../class/filter.inc.php";

$POST = filterpost('f');
if($POST){
	$data = array();
if(!is_bot())
	$sqldown = $db->query("INSERT INTO download_manager SET filename='".$POST."' ON DUPLICATE KEY UPDATE downloads=downloads+1");
	// echo $POST;
	$data = array(0=>$POST);
	echo json_encode($data);
}