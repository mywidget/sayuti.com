<?php
session_start();
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
// Warning Error To Login Admin Page
$error_login = "Maaf, Username & Password Salah! Atau ID Anda Sedang Di Blokir Oleh Admin.";

// View Error Message To Browser
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kalkulator Cetak Offset">
    <meta name="author" content="sayuti.com">
    <link rel="icon" href="img/favicon.png">
<title>Login Error</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css" type="text/css">
</head>
<body>
    <div class="container">
	<p></p>
	<div class="col-md-4"></div>
	  <div class="col-md-4">
<div class="alert alert-danger alert-error">
        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Maaf, Username atau Password Salah! Atau ID Anda Sedang Di Blokir Oleh Admin <a href="index.php" class="btn btn-info left-block">Login</a>
    </div>
</div>

</div>
</body>
</html>