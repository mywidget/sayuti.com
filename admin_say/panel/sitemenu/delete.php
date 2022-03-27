<?php 

require_once '../../../class/conn_db.php';
function filterg($str){
	$str 	= filter_input(INPUT_GET, $str, FILTER_SANITIZE_STRING);
	return $str;
}
$getid = filterg('id');
function recursiveDelete($id) {
	global $db;
    // $db_conn = $db;
    $query = $db->query("select * from menu where parent_id = '".$id."' ");
    if ($query->num_rows >0) {
       while($current=$query->fetch_array()) {
            recursiveDelete($current['id']);
       }
    }
    $db->query("delete from menu where id = '".$id."' ");
}

recursiveDelete($getid);

?>
