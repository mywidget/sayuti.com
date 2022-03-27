<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	$id 	= filter($_POST['id']);
	$judul 	= filter($_POST['judul']);
	$judul_seo 	= seo_title($_POST['judul']);
	$isi 	= $_POST['isi'];
	$photo 	= filter($_POST['photo']);
	$pub 	= filter($_POST['publish']);
	// echo $icon;
	// validasi agar tidak ada data yang kosong
	if($judul!="") {
		// proses tambah data
		if($id == 0) {
		
		$sql = $db->query("INSERT INTO `page`(`judul`, `judul_seo`, `isi`, `photo`, `pub`) VALUES ($judul, $judul_seo, $isi, $photo, $pub)");
		
		if($sql){
		save_alert('update',update);
		}else{
		save_alert('error','insert error');
		}
		} else {
		
		$sql = $db->query("UPDATE `page` SET `judul`='$judul',judul_seo='$judul_seo',`isi`='$isi',`photo`='$photo',`pub`='$pub' WHERE id_page=".$id);
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