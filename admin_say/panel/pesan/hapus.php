<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	//hapus data
	$del = $db->prepare("DELETE FROM kotak_masuk WHERE id=?");
	$del->bind_param("i",$GETID);
	if($del->execute())
	{
	save_alert('delete',delete);
	htmlRedirect('?'.$mode.'='.$module.'&alert=delete');	}else{
	save_alert('error',$insert->error);
	}

}
 ?>