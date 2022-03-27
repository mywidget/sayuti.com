<?php
//error_reporting(0);
// session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$idb	= filter($_POST['id']);
	$id_parent = filter($_POST['id_parent']);
	$judul	= filter($_POST['judul']);
	$kategori_seo = seo_title($_POST['judul']);
	$aktif	= filter($_POST['aktif']);
	// validasi agar tidak ada data yang kosong
	if($judul!="") {
		// proses tambah data
		if($idb == 0) {
		
		$sql = $db->query("INSERT INTO cat (id_parent,nama_kategori,kategori_seo,aktif) VALUES ('$id_parent','$judul','$kategori_seo','$aktif')");
		if($sql){
		save_alert('save',save);
		}else{
			save_alert('error',error);
		}
		htmlRedirect('?'.$mode.'='.$module);
		// proses ubah data
		} else {
		
		$sql = $db->query("UPDATE cat SET id_parent = '$id_parent', nama_kategori = '$judul', kategori_seo = '$kategori_seo', aktif = '$aktif' WHERE id_cat = $idb");
		if($sql){
		save_alert('save',save);
		}else{
			save_alert('error',error);
		}
		save_alert('update',update);
		htmlRedirect('?'.$mode.'='.$module);

}
}else{
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
	}
}
 ?>