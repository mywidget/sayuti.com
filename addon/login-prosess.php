<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
session_start();
include "../class/conn_db.php";
include "../class/filter.inc.php";

if(isset($_POST["email_l"]))
{
	$email=$_POST["email_l"];
	$password = $_POST['password_l'];
	$password = md5($password);
	
	if(isset($_POST["captcha_l"]))
	{
		//cek apakah jawaban dari captcha benar
if($_POST["captcha_l"]==$_SESSION["captcha_login"]){
$hasil = $db->query("SELECT * FROM tb_resell WHERE email='".$email."' AND password='".$password."'");
$jumlah = $hasil->num_rows;
if ($jumlah > 0){
$data=$hasil->fetch_array();
$_SESSION['e_resell'] = $data['email'];
$_SESSION['e_token'] = $data['token'];
echo json_encode(array("status"=>"berhasil","pesan"=>"Login Berhasil"));
unset($_SESSION['captcha_login']);
}else{
		echo json_encode(array("status"=>"gagal",
			"pesan"=>"Login Gagal"));
}
		} else {
		echo json_encode(array("status"=>"error","pesan"=>"Anda memasukan captcha yang salah"));
		}
	}
	else 
	{
		echo json_encode(array("status"=>"error","pesan"=>"captcha belum terisi"));
	}
}else{
	echo "error";
}