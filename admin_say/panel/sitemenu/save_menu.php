<?php 
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
require_once '../../../class/conn_db.php';
function filterp($str){
	$str 	= filter_input(INPUT_POST, $str, FILTER_SANITIZE_STRING);
	return $str;
}
function filterg($str){
	$str 	= filter_input(INPUT_GET, $str, FILTER_SANITIZE_STRING);
	return $str;
}
///
$label = filterg('label');
// $link = filterg('link');
$eclass = filterg('eclass');
$aktif = filterg('aktif');
$id = filterg('id');
$link = filterg('link').filterg('page').filterg('kategori').filterg('kategorip');
// echo $link;
///
if($id != ''){

	$db->query("update menu set name = '".$label."', link  = '".$link."', class  = '".$eclass."', status  = '".$aktif."' where id = '".$id."' ");

	$arr['type']  = 'edit';
	$arr['label'] = $label;
	$arr['link']  = $link;
	$arr['eclass']  = $eclass;
	$arr['aktif']  = $aktif;
	$arr['page']  = filterg('page');
	$arr['kategori']  = filterg('kategori');
	$arr['id']    = $id;
} else {

	$sql = $db->query("SELECT max(global)+1 as urutan FROM menu");
	$row = $sql->fetch_array();
	$db->query("insert into menu (name,link,class,status,global) values ('".$label."', '".$link."', '".$eclass."', '".$aktif."', '".$row['urutan']."')");
	$lastid = $db->insert_id;
	$arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$lastid.'" >
	                    <div class="dd-handle dd3-handle"></div>
	                    <div class="ns-row">
						<div class="ns-title" id="label_show'.$lastid.'">'.$label.'</div>
						<div class="ns-url" id="link_show'.$lastid.'">'.$link.'</div> 
						<div class="ns-class" id="eclass_show'.$lastid.'">'.$eclass.'</div>
						<div class="ns-actions">
						<a class="edit-button" id="'.$lastid.'" label="'.$label.'" link="'.$link.'" eclass="'.$eclass.'"><i class="fa fa-pencil"></i></a>
						<a class="del-button" id="'.$lastid.'"><i class="fa fa-trash"></i></a>
	                        </div> 
	                    </div>';
	$arr['type'] = 'add';

}

echo json_encode($arr);

?>
