<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	$POSTID	= filter($_POST['id']);
	$nama	= filter($_POST['nama']);
	$namap	= filter($_POST['namap']);
	$telp	= filter($_POST['telp']);
	$gambar	= filter($_POST['gambar']);
	$slug	= filter($_POST['slug']);
	$active	= filter($_POST['active']);
	$publish	= filter($_POST['publish']);
	$json = array(
			'namal' => $nama,
			'namap' => $namap,
			'telp' => $telp,
			'gambar' => $gambar
		);
	$status = json_encode($json);
	// validasi agar tidak ada data yang kosong
	if($nama!="") {
		// proses tambah data
		if($POSTID > 0) {
		$sql = $db->query("UPDATE `fo` SET `data`='$status',`slug`='$slug',`active`='$active',`pub`='$publish' WHERE id=".$POSTID);
		if($sql){
		save_alert('update',update);
		}else{
		save_alert('error','update error');
		}
		htmlRedirect('?'.$mode.'='.$module);

}else{
	echo "error";
}
}else{
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
	}
}
 ?>