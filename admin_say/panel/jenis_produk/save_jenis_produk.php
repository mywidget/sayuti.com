<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$id = filter($_POST['id_jenis_produk']);
	$save = filter($_POST['save']);
	$keterangan = filter($_POST['keterangan']);
	$produk	= filter($_POST['produk']);
	$seo_produk	= seo_title($produk);
	$pub	= filter($_POST['pub']);
	$photo = filter($_POST['photo']);

	if($produk!="" && $keterangan!="") {
		// proses tambah data
	if($save != 'update') {
		$insert = $db->query("INSERT INTO jenis_produk (keterangan,produk,seo_produk,pub,photo) VALUES ('$keterangan','$produk','$seo_produk','$pub','$photo')");
		if($insert){
		save_alert('save',save);
		}else{
		save_alert('save','error');
		}
		htmlRedirect('?'.$mode.'='.$module);
		// proses ubah data
	}else{
		
		$db->query("UPDATE jenis_produk SET keterangan ='$keterangan',
		produk='$produk',
		pub='$pub',
		photo='$photo'
		 WHERE id_jenis_produk	= '$id'");
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