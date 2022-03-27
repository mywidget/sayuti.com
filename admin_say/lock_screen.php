<?php
error_reporting(0);
include "g-asset/conn_db.php";


function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$id 		= anti_injection($_POST['id']);
$inv 		= anti_injection($_POST['inv']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  //include "error-login.php";
}
else{
$login=mysql_query("SELECT * FROM user WHERE username='$username' AND password='$pass' AND aktif='Y' AND level='admin'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
echo "$id";
// read.php?panel=invoice&act=view&id=4&inv=4&status=edit
mysql_query("UPDATE invoice SET oto = 'edit' WHERE id_invoice='$inv'");
header('location:read.php?panel=invoice&act=view&id='.$id.'&inv='.$inv.'&status=edit');
}
else{
echo"1";
  include "error-login.php";
}
}
?>