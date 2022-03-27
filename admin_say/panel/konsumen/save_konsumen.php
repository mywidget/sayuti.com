<?php
//error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$id = !isset($_POST['id']) ? : filter($_POST['id']);
	
	$nama	= filter($_POST['nama']);
	$password = filter($_POST['password']);
	$pass = md5($password);
	$telp	= filter($_POST['telp']);
	$alamat = filter($_POST['alamat']);
	$email	= filter($_POST['email']);
	$token = uniqid();
	if($nama!="" && $telp!="") {
		// proses tambah data
		if($id 	== 0) {
		$sqlcek = $db->query("SELECT nohp from tb_resell where nohp='$telp'");
		$sqlcek2 = $db->query("SELECT email from tb_resell where email='$email'");
		$ketemu	= $sqlcek->num_rows;
		$ketemuemail	=$sqlcek2->num_rows;
		if ($ketemu > 0){
		save_alert('error',error_tlp);
		// htmlRedirect('?'.$mode.'='.$module);
}elseif ($ketemuemail > 0){
		save_alert('error',error_email);
		htmlRedirect('?'.$mode.'='.$module);
}else{
		$db->query("INSERT INTO tb_resell (nama,password,nohp,alamat,email,token) VALUES ('$nama','$pass','$telp','$alamat','$email','$token')");
		
		save_alert('save',save);
		htmlRedirect('?'.$mode.'=invoice&act=invoice&id='.$idk.'&inv='.$inv.'&status=baru');
		// proses ubah data
			}
		}else {
		if(empty($password)){
		$db->query("UPDATE tb_resell SET nama 		= '$nama', 
										 nohp 		= '$telp', 
										 alamat 	= '$alamat', 
										 email 		= '$email' 
										 WHERE id = $id");
		save_alert('update',update);
		htmlRedirect('?'.$mode.'='.$module);
			}else{
		$db->query("UPDATE tb_resell SET nama 		= '$nama', 
										 password	= '$pass', 
										 nohp 		= '$telp', 
										 alamat 	= '$alamat', 
										 email 		= '$email' 
										 WHERE id = $id");
		save_alert('update',update);
		htmlRedirect('?'.$mode.'='.$module);
			}
}
}else{
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
	}
}
 ?>