<?php 
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
require_once '../../../class/conn_db.php';
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
	$qry = $db->query("update menu set parent_id= '".$row['parentID']."', global='$i' where id = '".$row['id']."' ");
  $i++;
}

if($qry){
	echo 1;
}else{
	echo 2;
}
?>
