<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$id = filter($_POST['id_page']);
	$isi = $_POST['isi'];
	$photo = filter($_POST['photo']);
	//echo $isi;
	if($isi!="") {
		// proses tambah data
		$db->query("UPDATE page SET isi='$isi',photo='$photo' WHERE id_page	= '$id'");
				save_alert('save',update);
				htmlRedirect('?'.$mode.'='.$module);
		//		 echo $id;
}else{
//echo "error";
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module);
	}
}
 ?>