<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
//error_reporting(0);
include dirname(__FILE__) . '/../class/conn_db.php';
include dirname(__FILE__) . '/../class/filter.inc.php';
include dirname(__FILE__) . '/../class/library.php';
include dirname(__FILE__) . '/../class/mkdir_function.php';
	if(isset($_POST['btn-login']))
	{
		$user_login = filterpost('user_login');
		$user_password = filterpost('password');
		$password = md5($user_password);
// pastikan username dan password adalah berupa huruf atau angka.
$aValid = array('-', '_');
if(!ctype_alnum(str_replace($aValid, '', $user_login)) OR !ctype_alnum(str_replace($aValid, '', $user_login))) {
// if (!ctype_alnum($user_login) OR !ctype_alnum($user_password)){
	echo "Karakter tidak diizinkan"; // log in
}else{
$query = $db->query("SELECT * FROM user WHERE username='$user_login' AND password='$password' AND aktif='Y'");
// Apabila username dan password ditemukan

// Apabila username dan password ditemukan
	session_start();
	// $sid_lama = session_id();
	session_regenerate_id();
	$sid_baru = session_id();
if($query->num_rows > 0){
$r=$query->fetch_array();
  include "timeout.php";
  $_SESSION['KCFINDER']=array();
  $_SESSION['KCFINDER']['disabled'] = false;
  $_SESSION['KCFINDER']['uploadURL'] = "../upload";
  $_SESSION['KCFINDER']['uploadDir'] = "";
  
  $_SESSION['namauser']     = $r['username'];
  $_SESSION['namalengkap']  = $r['nama'];
  $_SESSION['passuser']     = $r['password'];
  $_SESSION['mailuser']   	= $r['email'];
  $_SESSION['leveluser']    = $r['level'];
  $_SESSION['iduser']  		= $r['id_user'];
  $_SESSION['img']			= $r['foto'];
  // session timeout

	login_validate();
	$_SESSION['ids'] = $sid_baru;
	echo "ok"; // log in
	$tanggal = date('Y-m-d');
	$ip = $_SERVER['REMOTE_ADDR'];
	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$update = $db->query("UPDATE user SET id_session='$sid_baru' WHERE username='$user_login' AND password='$password' AND aktif='Y'");
	$path = "upload/images/post/".$thn_sekarang."/".$bln_sekarang;
	createDirectory($path);
			}else{
				
				echo "user atau password salah."; // wrong details 
			}
// }else{
	// echo "token error, Refresh halaman ";
// }
}
	}
?>