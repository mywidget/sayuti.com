<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	$POSTID		= filter($_POST['id']);
	$nama	 	= filter($_POST['nama']);
	$pages 		= filter($_POST['pages']);
	$site_name	= filter($_POST['site_name']);
	$app_id		= filter($_POST['app_id']);
	$publish	= filter($_POST['publish']);
	$json = array(
			'pages' => $pages, 
			'site_name' => $site_name, 
			'app_id' => $app_id
		);
	$status = json_encode($json);
	// validasi agar tidak ada data yang kosong
	if($nama!="") {
		// proses tambah data
		if($POSTID > 0) {
		$sql = $db->query("UPDATE `plugin` SET `nama`='$nama',`plugin_arr`='$status',`pub`='$publish' WHERE id=".$POSTID);
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