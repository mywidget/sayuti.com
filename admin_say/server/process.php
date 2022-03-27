<?php
session_start();
	include "../g-asset/conn_db.php";
	include "../g-asset/web_function.php";
	include "../g-asset/alert.php";
	include "../g-asset/library_function.php";
	include "../g-asset/lang.php";
if(isset($_POST['produk1'])){
	$de= mysql_real_escape_string($_POST['id']);
	$ids= mysql_real_escape_string($_POST['ids']);
	$inv= mysql_real_escape_string($_POST['inv']);
	$idprod= mysql_real_escape_string($_POST['idprod']);
	// deklarasikan variabel
	$kode_booking = !isset($_POST['kode_booking']) ? : filter($_POST['kode_booking']);
	$kode_pesawat = !isset($_POST['kode_pesawat']) ? : filter($_POST['kode_pesawat']);
	$no_pesawat = !isset($_POST['no_pesawat']) ? : filter($_POST['no_pesawat']);
	$rute = !isset($_POST['rute']) ? : filter($_POST['rute']);
	$tanggal = !isset($_POST['waktu_berangkat']) ? : filter($_POST['waktu_berangkat']);
	$kelas = !isset($_POST['kelas']) ? : filter($_POST['kelas']);
	$no_tiket = !isset($_POST['no_tiket']) ? : filter($_POST['no_tiket']);
	$catatan = !isset($_POST['catatan']) ? : filter($_POST['catatan']);
	
	$pecah = explode("-", $tanggal);
	$cekin = datecekin($pecah[0]);
	$cekout = datecekin($pecah[1]);
	
	$ket = $kode_booking."/".$no_tiket."/".$kode_pesawat ."/".$no_pesawat."/".$kelas."/".$rute."/".$cekin."/".$cekout."/".$catatan;
	// validasi agar tidak ada data yang kosong
	if($kode_booking!="") {
	 // echo "x1";
	mysql_query("INSERT INTO invoice_detail (id_produk, id_invoice,id_session,no_tik_voch)
									VALUES ('$idprod', '$inv','$ids', '$ket')");
									
	mysql_query("INSERT INTO i_pesawat (kd_booking,
											id_rincianinvoice,
											kd_airlines,
											no_pesawat,
											kelas,
											no_tiket,
											rute,
											tgl_berangkat,
											tgl_kembali) 
									VALUES ('$kode_booking',
											(select MAX(id_rincianinvoice) FROM invoice_detail),
											'$kode_pesawat',
											'$no_pesawat',
											'$kelas',
											'$no_tiket',
											'$rute',
											'$cekin',
											'$cekout')");


		//save_alert('save',save);
		//htmlRedirect('?'.$mode.'='.$module.'&act=invoice&id='.$de.'&inv='.$inv.'&sesi='.$ids);
}else{
// echo "1";
		//save_alert('error',fill);
		//htmlRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
	}//end cek
}
?>
