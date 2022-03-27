<?php
//error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$id = filterpint('id');
	$save = filterpost('save');
	$judul	= filterpost('judul');
	$judul_seo	= seo_title($_POST['judul']);
	$nama	= filterpost('nama');
	$company	= filterpost('company');
	$pub	= filterpost('pub');
	$photo = filterpost('photo');
	$isi = $_POST['isi'];
	$tgl		= filterpost('tanggal');
	$jam		= filterpost('jam');
	$tanggal	= $tgl.' '.$jam;
	
	
	if($judul!="" && $isi!="") {
		// proses tambah data
	if($save != 'update') {
		$sql = $db->query("INSERT INTO `testimoni`(`judul`, `judul_seo`, `client`, `company`, `isi`, `photo`, `tanggal`, `pub`) VALUES ('$judul','$judul_seo','$nama','$company','$isi','$photo','$tanggal','$pub')");
	//echo $judul;	
	if($sql){
		save_alert('save',save);
		htmlRedirect('?'.$mode.'='.$module);
	}else{
		save_alert('error',error);
	}
		// proses ubah data
	}else{
		
		$db->query("UPDATE testimoni SET isi ='$isi',
		judul='$judul',
		judul_seo='$judul_seo',
		client='$nama',
		company='$company',
		pub='$pub',
		tanggal='$tanggal',
		photo='$photo'
		 WHERE id	= '$id'");
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