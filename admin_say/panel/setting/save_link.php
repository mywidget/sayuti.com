<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
include "../../g-asset/conn_db.php";

$idakun	= $_POST['idakun'];
$id		= $_POST['id'];

	mysql_query("UPDATE cara_bayar	set id_akun	= '$idakun'
                                    WHERE id_byr  = '$id'");	
							
}
?>