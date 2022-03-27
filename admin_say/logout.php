<?php

  session_start();

  session_destroy();
/*
session_start();
session_destroy();

//hapus cookie yang ada
if($_SESSION['login']!=0){
setcookie('namauser','');
setcookie('namalengkap','');
setcookie('passuser','');
setcookie('leveluser','');
}
*/
header('location:index.php');
?>