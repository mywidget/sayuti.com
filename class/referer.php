<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $isSecure = true;
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
    $isSecure = true;
}
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';
$host = $REQUEST_PROTOCOL."://$_SERVER[HTTP_HOST]";
$hostMenu = $REQUEST_PROTOCOL."://$_SERVER[HTTP_HOST]";
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
function refer($refer,$hosts){
if (($refer==$hosts)){
return 0;//BUKA 
}

}
function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }
function biaya($id){
global $db;
	$sqlb = $db->query("SELECT * FROM `tbl_biaya` where KdBiaya='$id'");
	$row = $sqlb->fetch_array();
	echo $row['HargaMin'];
}
?>