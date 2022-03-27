<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "../class/conn_db.php";
include "../class/filter.inc.php";
include "../class/library.php";
if(isset($_POST["name"]))
{
	//grab semua data
	$name=$_POST["name"];
	$email=$_POST["email"];
	$subject = $_POST['subject'];
	$message=$_POST["message"];

	//cek apakah captcha telah terisi
	if(isset($_POST["captchak"]))
	{
if($_POST["captcha"]==$_SESSION["captcha_reg"]){
			//memasukan data ke database
			$query= $db->query("INSERT INTO kotak_masuk (nama,judul,email,pesan,tanggal) VALUES('$name','$subject','$email','$message','$date_time')");
		if($query){
		echo json_encode(array("status"=>"berhasil",
				   "pesan"=>"Terima Kasih telah mengirimkan pesan"
					));
		}else{
		echo json_encode(array("status"=>"gagal",
				   "pesan"=>"Gagal mengirimkan pesan"
					));
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