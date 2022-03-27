<?php
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$de				= filterpint('id');
	$ids			= filterpost('ids');
	$username 		= filterpost('username');
	$pass			= md5($_POST['password']);
	$nama_lengkap 	= filterpost('nama_lengkap');
	$email 			= filterpost('email');
	$no_hp			= filterpost('no_hp');
	$alamat 		= filterpost('alamat');
	$level			= filterpost('level');
	$blokir 		= filterpost('blokir');
	$foto 			= filterpost('avatar');
	// validasi agar tidak ada data yang kosong
    $data_cat = $_POST['data'];
    $data=implode(',',$data_cat);
	// echo $username;
	if($username!="") {
		// proses tambah data
		if($de == 0) {
			$sql = $db->query("INSERT INTO user (username,
											idmenu,
											password,
											nama,
											email,
											no_hp,
											level,
											aktif,
											foto,
											id_session) 
									VALUES ('$username',
											'$data',
											'$pass',
											'$nama_lengkap',
											'$email',
											'$no_hp',
											'$level',
											'$blokir',
											'$foto',
											'$pass')");
		if($sql){
		save_alert('save',save);
		}else{
		save_alert('error',error);
		}
		htmlRedirect('?'.$mode.'='.$module);
		// proses ubah data
		} else {
		if($_POST['password']!="") {
		//echo"pass isi";
			$db->query("UPDATE user SET password 		= '$pass',
										idmenu		 	= '$data',
										nama 			= '$nama_lengkap',
										email 			= '$email',
										no_hp			= '$no_hp',
										level 			= '$level',
										foto 			= '$foto',
										aktif 			= '$blokir'
										WHERE id_session = '$ids'");
		  session_destroy();								
		save_alert('update',update);
		htmlRedirect('?'.$mode.'='.$module);
		}else{
		// echo $foto;
			$db->query("UPDATE user SET nama		 	= '$nama_lengkap',
										idmenu 			= '$data',
										email 			= '$email',
										no_hp			= '$no_hp',
										level 			= '$level',
										foto 			= '$foto',
										aktif 			= '$blokir'
										WHERE id_session = '$ids'");
		save_alert('update',update);
		htmlRedirect('?'.$mode.'='.$module);
	}

}
}else{
		save_alert('error',kosong);
		htmlRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
	}
}
 ?>