<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
$query = $db->query("SELECT * FROM `themes` where publish='Y'");
$data = $query->fetch_array();
$folder = $data['folder'];
$base = $host . DS . $folder;
$pathFile = $folder.'/thm.php';
// }
if (file_exists($pathFile)){
// ob_start("kompresi_output"); 
include $pathFile;
}else{
include 'themes' . DS . '404' . DS . 'index.html'; 
}
?>