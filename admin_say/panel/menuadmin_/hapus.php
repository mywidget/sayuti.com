<?php
error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// cek id_kategori pada tabel berita
	$cek = mysql_query("SELECT * FROM menuadmin WHERE idparent='".$GETID."'");
	$ketemu=mysql_num_rows($cek);
	if ($ketemu > 0){
	save_alert('error',del_menu_err);
	htmlRedirect('?'.$mode.'='.$module);
	}else{
	mysql_query("DELETE FROM menuadmin WHERE idmenu='".$GETID."'");
	save_alert('delete',delete);
	htmlRedirect('?'.$mode.'='.$module);
	}

}
 ?>