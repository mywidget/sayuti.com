<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
session_start();
include "../class/conn_db.php";
include "../class/fungsi_expire.php"; 
include "../class/lib/function.php";
include "../class/filter.inc.php";

if(isset($_POST["name"]))
{
	//grab semua data
	$name=$_POST["name"];
	$email=$_POST["email"];
	$nohp = $_POST['nohp'];
	$alamat=$_POST["alamat"];
	if(isset($_POST["captcha"]))
	{
		//cek apakah jawaban dari captcha benar
if($_POST["captcha"]==$_SESSION["captcha_reg"]){
$hasil = $db->query("SELECT * FROM tb_resell WHERE email='".$email."' OR nohp='".$nohp."'");
$jumlah = $hasil->num_rows;
if ($jumlah > 0){
		echo json_encode(array("status"=>"gagal",
			"pesan"=>"email atau no hp sudah ada"));
}else{
			$password = random(5);
			$passwords = md5($password);
			$jdaftar =date('Y-m-d H:i:s');
			$token = uniqid();
			//memasukan data ke database
			$query= $db->query("INSERT INTO tmp_resell (nama,email,password,nohp,alamat,tgl_reg,token) VALUES('$name','$email','$passwords','$nohp','$alamat','$jdaftar','$token')");
			if($query){
 
			echo json_encode(array("status"=>"berhasil",
			"pesan"=>"Terima Kasih telah mendaftar, cek email untuk aktivasi"));

	$from = "From:no-replay@sayuti.com \n" .
	"MIME-Version: 1.0\n" . 
	"Content-type: text/html; charset=iso-8859-1";
	$to = $email;
	$judul	= "Aktivasi Reseller sayuti.com";
	include "mail.php"; 
	mail($to,$judul,$isiMail,$from);
	unset($_SESSION['captcha_reg']);
			}else{
		echo json_encode(array("status"=>"gagal",
			"pesan"=>"Gagal mendaftar"));
			}
}
		} else {
			//jika jawaban salah, jalankan blok ini lalu kirimkan pesan error
		echo json_encode(array("status"=>"error",
							   "pesan"=>"Anda memasukan captcha yang salah"
								));

		}


	} 

	else 
	{
		//jika captcha belum terisi, alankan blok ini lalu kirimkan pesan error
		echo json_encode(array("status"=>"error",
							   "pesan"=>"captcha belum terisi"
								));
	}

}