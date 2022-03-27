<?php 
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
require_once '../../../class/conn_db.php';
function filterg($str){
	$str 	= filter_input(INPUT_GET, $str, FILTER_SANITIZE_STRING);
	return $str;
}
$getid = filterg('id');
function recursiveDelete($id) {
	global $db;
    // $db_conn = $db;
    $query = $db->query("select * from menuadmin where idparent = '".$id."' ");
    if ($query->num_rows >0) {
       while($current=$query->fetch_array()) {
            recursiveDelete($current['idmenu']);
       }
    }
    $db->query("delete from menuadmin where idmenu = '".$id."' ");
}

recursiveDelete($getid);

?>
