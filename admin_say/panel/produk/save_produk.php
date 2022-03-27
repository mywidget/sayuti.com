<?php
//error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$idp = filter($_POST['idp']);
	$id = filter($_POST['id_jenis_produk']);
	$nama_produk	= filter($_POST['nama_produk']);
	$produk_seo	= seo_title($nama_produk);
	$harga_produk	= filter($_POST['harga_produk']);
	$pub	= filter($_POST['pub']);
	$hitung	= filter($_POST['hitung']);
	$photo = filter($_POST['photo']);
	$photo2 = filter($_POST['photo2']);
	$pages = filter($_POST['page']);
	$status = filter($_POST['status']);
	if($pages==0){
	$page = 1;
	}else{
	$page = filter($_POST['page']);
	}
	$keterangan = $_POST['keterangan'];
	$keyword = strtolower($_POST['keyword']);
	if($nama_produk!="") {
		// proses tambah data
	if($idp == 0) {
		$input = $db->query("INSERT INTO produk (produk_seo,keterangan,keyword,nama_produk,harga,pub,photo,photo2,kategori_produk,hitung,status) VALUES ('$produk_seo','$keterangan','$keyword','$nama_produk','$harga_produk','$pub','$photo','$photo2','$id','$hitung','$status')");
		if($input){
		$id = $db->insert_id;
		save_alert('save',save);
		htmlRedirect('?'.$mode.'='.$module.'&act=edit&id_produk='.$id);
		}else{
		save_alert('error','error');
		htmlRedirect('?'.$mode.'='.$module);
		}
		// proses ubah data
	}else{
// echo base64_decode($keterangan);
$db->query("UPDATE produk SET keterangan ='$keterangan',
keyword='$keyword',
produk_seo='$produk_seo',
nama_produk='$nama_produk',
harga='$harga_produk',
pub='$pub',
hitung='$hitung',
photo='$photo',
photo2='$photo2',
status='$status',
kategori_produk='$id'
 WHERE id_produk = '$idp'");
 //echo $id;
 		save_alert('save',update);
		htmlRedirect('?'.$mode.'='.$module.'&page='.$page);
//		 echo $id.$tab;

	}

}else{
//echo "error";
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module);
	}
}
 ?>