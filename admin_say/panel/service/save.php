<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	$POSTID		= filter($_POST['id']);
	$judulD 	= filter($_POST['judul_depan']);
	$judulM 	= filter($_POST['judul_modal']);
	$subjudul 	= filter($_POST['sub_judul']);
	$str		= $_POST['isi'];
	$isi	 	= str_replace("&nbsp;", ' ', $str);
	$tagmod		= filter($_POST['tag_mod']);
	$class		= filter($_POST['class']);
	$icon		= filter($_POST['icon']);
	$pub		= filter($_POST['publish']);
	// echo $icon;
	// validasi agar tidak ada data yang kosong
	if($judulD!="") {
		// proses tambah data
		if($POSTID == 0) {
		
		$sql = $db->query("INSERT INTO `info_service`(`icon`, `judul`, `judulD`, `sub_judul`, `modul`, `isi`, `class`, `pub`) VALUES ($icon, $judulM, judulD, subjudul, tagmod, isi, class, pub)");
		
		if($sql){
		save_alert('update',update);
		}else{
		save_alert('error','insert error');
		}
		} else {
		
		$sql = $db->query("UPDATE `info_service` SET `icon`='$icon',`judul`='$judulM',`judulD`='$judulD',`sub_judul`='$subjudul',`modul`='$tagmod',isi='$isi',`class`='$class',`pub`='$pub' WHERE id=".$POSTID);
		if($sql){
		save_alert('update',update);
		}else{
		save_alert('error','update error');
		}
		htmlRedirect('?'.$mode.'='.$module);

}
}else{
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
	}
}
 ?>