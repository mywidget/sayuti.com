<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	//cari gambar	
	$res = $db->query("SELECT folder,gambar FROM posting WHERE id_post=".$GETID);
	$r = $res->fetch_array();
	$tahun = folderthn($r['folder']);
	$bulan = folderbln($r['folder']);
	$gambar1 = "../images/post/".$tahun."/".$bulan."/$r[gambar]";
	$gambar2 = "../images/post/".$tahun."/".$bulan."/thumb_$r[gambar]";
	$gambar3 = "../images/post/".$tahun."/".$bulan."/200x200_$r[gambar]";
	if (file_exists($gambar2) AND $r['gambar'] != 'default.jpg'){
	  unlink($gambar1);
	  unlink($gambar2);
	  unlink($gambar3);
   }
	//hapus data
	$del = $db->prepare("DELETE FROM posting WHERE id_post=?");
	$del->bind_param("i",$GETID);
	if($del->execute())
	{
	save_alert('delete',delete);
	htmlRedirect('?'.$mode.'='.$module.'&alert=delete');	}else{
	save_alert('error',$insert->error);
	}

}
 ?>