<?php
// session_start();

function login_validate() {
 $timeout = 360000;
 $_SESSION["expires_by"] = time() + $timeout;
}

function login_check() {
	global $db;
 $exp_time = $_SESSION["expires_by"];
 if (time() < $exp_time) {
 login_validate();
 return true;
 } else {
	 // $db->query("UPDATE user set online='N', sesi_login='' WHERE username='".$_SESSION['user']."'");	
    session_destroy();
    session_unset();
 unset($_SESSION["expires_by"]);
 return false;
 }
}

function sesi_login() {
 $timeout = 360000;
 $_SESSION["kadaluarsa"] =  $timeout;
 return $timeout;
}
?>
