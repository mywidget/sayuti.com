<?php
//error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$idb		= filter($_POST['id']);
	$id_parent	= filter($_POST['idparent']);
	$judul		= filter($_POST['judul']);
	$link		= filter($_POST['link']);
	$class		= filter($_POST['class']);
	$sub		= filter($_POST['sub']);
	$aktif		= filter($_POST['aktif']);
	$urutan		= filter($_POST['urutan']);
// echo $class;
	if($judul!="" && $link!="" && $urutan!="") {
		// proses tambah data
		if($idb == 0) {
		$db->query("INSERT INTO menu (parent_id,name,link,class,sub_menu,status,global) VALUES ('$id_parent','$judul','$link','$class','$sub','$aktif','$urutan')");
		
		save_alert('save',save);
		htmlRedirect('?'.$mode.'='.$module);
		// proses ubah data
		} else {
		$db->query("UPDATE menu SET parent_id = '$id_parent', 
										 name = '$judul', 
										 link = '$link',
										 class = '$class', 
										 sub_menu = '$sub', 
										 status = '$aktif', 
										 global = '$urutan' 
										 WHERE id = $idb");
		
		save_alert('update',update);
		htmlRedirect('?'.$mode.'='.$module);

}
}else{
		save_alert('error',fill);
		// htmlRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
	}
}
 ?>