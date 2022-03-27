<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$id = filter($_POST['id_info']);
	$save = filter($_POST['save']);
	$judul	= filter($_POST['judul']);
	$pub	= filter($_POST['pub']);
	$photo = filter($_POST['photo']);
	$isi = filter($_POST['isi']);

	
	
	if($judul!="" && $isi!="") {
		// proses tambah data
	if($save != 'update') {
		mysql_query("INSERT INTO info (isi,judul,pub,photo) VALUES ('$isi','$judul','$pub','$photo')");
	//echo $judul;	
		save_alert('save',save);
		htmlRedirect('?'.$mode.'='.$module);
		// proses ubah data
	}else{
		
		mysql_query("UPDATE info SET isi ='$isi',
		judul='$judul',
		pub='$pub',
		photo='$photo'
		 WHERE id_info	= '$id'");
				save_alert('save',update);
				htmlRedirect('?'.$mode.'='.$module);
		//		 echo $id;

	}

}else{
//echo "error";
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module);
	}
}
 ?>