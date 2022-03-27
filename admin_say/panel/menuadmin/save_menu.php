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
$link = filterg('link');
$eclass = filterg('eclass');
$treeview = filterg('parentc');
$aktif = filterg('aktif');
$submenu = filterg('submenu');
$id = filterg('id');
///
if($id != ''){
	$db->query("update menuadmin set nama_menu = '".$label."', link  = '".$link."', class  = '".$eclass."', treeview  = '".$treeview."', aktif  = '".$aktif."', link_on  = '".$submenu."' where idmenu = '".$id."' ");

	$arr['type']  = 'edit';
	$arr['label'] = $label;
	$arr['link']  = $link;
	$arr['eclass']  = $eclass;
	$arr['parentc']  = $treeview;
	$arr['aktif']  = $aktif;
	$arr['submenu']  = $submenu;
	$arr['id']    = $id;
} else {
	$sql = $db->query("SELECT max(urutan)+1 as urutan FROM menuadmin");
	$row = $sql->fetch_array();
	// $arr['ok'] = $row['urutan'];

	$qry = $db->query("INSERT INTO menuadmin (nama_menu,link,class,treeview,aktif,link_on,urutan) values ('$label','$link','$eclass','$treeview','$aktif','$submenu','$row[urutan]')");
	if($qry){
	$arr['ok'] = 'ok';
	$lastid = $db->insert_id;
	$arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$lastid.'" >
	                    <div class="dd-handle dd3-handle"></div>
	                    <div class="ns-row">
						<div class="ns-title" id="label_show'.$lastid.'">'.$label.'</div>
						<div class="ns-url" id="link_show'.$lastid.'">'.$link.'</div> 
						<div class="ns-class" id="eclass_show'.$lastid.'">'.$eclass.'</div>
						<div class="ns-actions">
						<a class="edit-button" id="'.$lastid.'" label="'.$label.'" link="'.$link.'" eclass="'.$eclass.'" parentc="'.$treeview.'"><i class="fa fa-pencil"></i></a>
						<a href="#" class="confirm-deletem" data-id="'.$value['id'].'" id="'.$value['id'].'"><i class="fa fa-trash"></i></a>
	                        </div> 
	                    </div>';
	}else{
	$arr['type'] = 'error';
	}
	// $arr['type'] = 'add';

}

echo json_encode($arr);

?>
