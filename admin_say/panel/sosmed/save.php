<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	$POSTID		= filter($_POST['id']);
	$judul	 	= filter($_POST['judul']);
	$link 		= filter($_POST['link']);
	$idkey 		= filter($_POST['idkey']);
	$publish	= filter($_POST['publish']);
	$tag		= filter($_POST['tag']);
	// echo $icon;
	// validasi agar tidak ada data yang kosong
	if($judul!="") {
		// proses tambah data
		if($POSTID == 0) {
		$sql = $db->query("INSERT INTO `sosmed`(`judul`, `link`, `idkey`, `publish`, `tag`) VALUES ($judul, $link, $idkey, $publish, $tag)");
		
		if($sql){
		save_alert('update',update);
		}else{
		save_alert('error','insert error');
		}
		} else {
		
		$sql = $db->query("UPDATE `sosmed` SET `judul`='$judul',`link`='$link',`idkey`='$idkey',`publish`='$publish',`tag`='$tag' WHERE id=".$POSTID);
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