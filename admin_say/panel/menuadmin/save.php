<?php
//error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// deklarasikan variabel
	$idb		= filter($_POST['id']);
	$id_parent	= filter($_POST['idparent']);
	$judul		= filter($_POST['judul']);
	$link		= filter($_POST['link']);
	$treeview	= filter($_POST['treeview']);
	$icon		= filter($_POST['icon']);
	$sub		= filter($_POST['sub']);
	$aktif		= filter($_POST['aktif']);
	//$level		= filter($_POST['level']);
	$urutan		= filter($_POST['urutan']);
	// validasi agar tidak ada data yang kosong
	if(empty($_POST['data'])){
	save_alert('error','Level akses belum dipilih');
	// echo '';
	}else{
    $data_cat = $_POST['data'];
    $data=implode(',',$data_cat);
	if($judul!="" && $link!="" && $urutan!="") {
		// proses tambah data
		if($idb == 0) {
		$db->query("INSERT INTO menuadmin (idparent,id_level,nama_menu,link,treeview,class,classicon,aktif,urutan) VALUES ('$id_parent','$data','$judul','$link','$treeview','$icon','$sub','$aktif','$urutan')");
		
		save_alert('save',save);
		htmlRedirect('?'.$mode.'='.$module);
		// proses ubah data
		} else {
		$db->query("UPDATE menuadmin SET idparent = '$id_parent', 
										 id_level = '$data', 
										 nama_menu = '$judul', 
										 link = '$link',
										 treeview = '$treeview', 
										 class = '$icon', 
										 classicon = '$sub', 
										 aktif = '$aktif', 
										 urutan = '$urutan' 
										 WHERE idmenu = $idb");
		
		save_alert('update',update);
		htmlRedirect('?'.$mode.'='.$module);

}
}else{
		save_alert('error',fill);
		// htmlRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
	}
	}
}
 ?>