<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	$id 	= filter($_POST['id']);
	$kode 	= filter($_POST['kode']);
	$nama 	= filter($_POST['nama']);
	$tlp 	= filter($_POST['tlp']);
	$email 	= filter($_POST['email']);
	$map 	= filter($_POST['map']);
	$alamat	= $_POST['alamat'];
	$pub 	= filter($_POST['publish']);
	// echo $icon;
	// validasi agar tidak ada data yang kosong
	if($tlp!="" AND $nama!="") {
		// proses tambah data
		if($id == 0) {
		
		$sql = $db->query("INSERT INTO `kantor`(`kode_kantor`, `nama_kantor`, `alamat`, `map`,`tlp`, `email`, `pub`) VALUES ($kode, $nama, $alamat, $map,$tlp, $email, $pub)");
		
		if($sql){
		save_alert('update',update);
		}else{
		save_alert('error','insert error');
		}
		} else {
		
		$sql = $db->query("UPDATE `kantor` SET  `nama_kantor`='$nama',`alamat`='$alamat',`map`='$map',`tlp`='$tlp',`email`='$email',`pub`='$pub' WHERE id=".$id);
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