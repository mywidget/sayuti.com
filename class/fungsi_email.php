<?php
// error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
function kirimEmail($email,$judul,$file){
	$from_adm = "From:register@kalkulatorcetak.com \n" . //hasilcopas@gmail.com
	"MIME-Version: 1.0\n" . 
	"Content-type: text/html; charset=iso-8859-1";
	$to_adm = $email;
	$judul_adm	= $judul;
	include "mail/".$file.".php"; 
	mail($to_adm,$judul_adm,$isiMail,$from_adm);
}
?>
