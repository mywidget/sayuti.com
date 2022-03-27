<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
session_start();
if (isset($_SESSION['ids'])){
require_once '../../../class/conn_db.php';
function filterg($str){
	$str 	= filter_input(INPUT_GET, $str, FILTER_SANITIZE_STRING);
	return $str;
}
	$type = filterg('type');
	$id = filterg('id');
	$code = filterg('code');
	switch ($type) {
		case "hapus":
    $qry = $db->query("delete from widget_wa where id ='".$id."' and xcode='".$code."'");
if($qry){
	$data = array(0=>'ok');
}else{
	$data = array(0=>'error');
}
echo json_encode($data);
		break;
	}
}else{
$data = array(0=>'error');
echo json_encode($data);
}
?>