<?php
//error_reporting(0);
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$idb		= filter($_POST['id']);
	$username	= filter($_POST['username']);
	$email		= filter($_POST['email']);

	// validasi agar tidak ada data yang kosong
	if($email!="") {
		// proses tambah data
		if($idb == 0) {
		/*
		mysql_query("INSERT INTO users (email) VALUES ('$email')");
		*/
		save_alert('save',save);
		htmlRedirect('media.php?module='.$module);
		// proses ubah data
		} else {
		/*
		mysql_query("UPDATE users SET email = '$email' WHERE id_session = $idb");
		*/
		save_alert('update',update);
		htmlRedirect('media.php?module='.$module);

}
}else{
		save_alert('error',fill);
		htmlRedirect('media.php?module='.$module);
	}
}
 ?>