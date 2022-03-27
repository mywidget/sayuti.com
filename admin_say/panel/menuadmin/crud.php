<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
require_once '../../../class/conn_db.php';
function filterg($str){
	$str 	= filter_input(INPUT_GET, $str, FILTER_SANITIZE_STRING);
	return $str;
}
	$type = filterg('type');
	$gdata = filterg('data');
	$id = filterg('id');
	$label = filterg('label');
	$link = filterg('link');
	$eclass = filterg('eclass');
	$treeview = filterg('parentc');
	$aktif = filterg('aktif');
	$submenu = filterg('submenu');
	switch ($type) {
		//Tampilkan Data 
		case "get":
			$data = array();
			$SQL = $db->query("SELECT * FROM menuadmin WHERE idmenu='".$id."'");
			$return = $SQL->fetch_array();
			$data = array(
				'id' => $return['idmenu'],
				'label' => $return['nama_menu'],
				'link' => $return['link'],
				'eclass' => $return['class'],
				'parentc' => $return['treeview'],
				'aktif' => $return['aktif'],
				'submenu' => $return['link_on']
				);	
			echo json_encode($data);
			break;
			
		//simpan	
		case "simpan":
$data = json_decode($_GET['data']);
function parseJsonArray($jsonArray, $parentID = 0) {
  $return = array();
  foreach ($jsonArray as $subArray) {
    $returnSubSubArray = array();
    if (isset($subArray->children)) {
 		$returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
    }
    $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
    $return = array_merge($return, $returnSubSubArray);
  }
  return $return;
}

$readbleArray = parseJsonArray($data);

$i=0;
foreach($readbleArray as $row){
	$qry = $db->query("update menuadmin set idparent = '".$row['parentID']."', urutan='$i' where idmenu = '".$row['id']."' ");
  $i++;
}

if($qry){
	echo 1;
}else{
	echo 2;
}
		break;
		//update
		case "update":
		break;
		case "hapus":
function recursiveDelete($id) {
	global $db;
	$data = array();
    $query = $db->query("select * from menuadmin where idparent = '".$id."' ");
    if ($query->num_rows >0) {
       while($current=$query->fetch_array()) {
            recursiveDelete($current['idmenu']);
       }
    }
    $qry = $db->query("delete from menuadmin where idmenu = '".$id."' ");
if($qry){
	$data = array(0=>'ok');;
}else{
	$data = array(0=>'error');;
}
echo json_encode($data);
}
recursiveDelete($id);
		break;
	}

?>