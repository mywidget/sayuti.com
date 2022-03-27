<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
error_reporting(0);
// session_start();
//header('Content-Type: application/json');
include "../class/conn_db.php";
include "../class/filter.inc.php";
include "../fungsi/reader.php";
include "../fungsi/fungsi-fungsi.php";
include "../fungsi/function.php";

$lbrcetak = (isset($_GET['lbrcetak']) ? floatval($_GET['lbrcetak']) : '');
// $tgcetak = $_GET['tgcetak'];
$tgcetak = (isset($_GET['tgcetak']) ? floatval($_GET['tgcetak']) : '');
// $jmlcetak = $_GET['jmlcetak'];
$jmlcetak = (isset($_GET['jmlcetak']) ? filter($_GET['jmlcetak']) : '');
// $bahan = $_GET['bahan'];
$bahan = (isset($_GET['bahan']) ? filter($_GET['bahan']) : '');
//echo $bahan;
$jmlwarna 	= filterget('jmlwarna');
$jmlwarna2 	= filterget('jmlwarna2');
$finishing1 = filterget('finishing1');
$finishing2 = filterget('finishing2');
$finishing3 = filterget('finishing3');
$finishing4 = filterget('finishing4');
$finishing5 = filterget('finishing5');
$finishing6 = filterget('finishing6');
$finishing7 = filterget('finishing7');
$finishing8 = filterget('finishing8');
$finishing9 = filterget('finishing9');
$finishing10 = filterget('finishing10');
$lbrf1 = filterget('lbrf1');
$lbrf2 = filterget('lbrf2');
$lbrf3 = filterget('lbrf3');
$lbrf4 = filterget('lbrf4');
$lbrf5 = filterget('lbrf5');
$lbrf6 = filterget('lbrf6');
$lbrf7 = filterget('lbrf7');
$lbrf8 = filterget('lbrf8');
$lbrf9 = filterget('lbrf9');
$lbrf10 = filterget('lbrf10');
$tgf1 = filterget('tgf1');
$tgf2 = filterget('tgf2');
$tgf3 = filterget('tgf3');
$tgf4 = filterget('tgf4');
$tgf5 = filterget('tgf5');
$tgf6 = filterget('tgf6');
$tgf7 = filterget('tgf7');
$tgf8 = filterget('tgf8');
$tgf9 = filterget('tgf9');
$tgf10 = filterget('tgf10');
$lam = filterget('lam');
$bbstat = filterget('bb');
$jml_satuan = filterget('jml_satuan');
$cetak_bagi = filterget('cetak_bagi');
$ket_satuan = filterget('ket_satuan');
$tarik 		= filterget('tarikan');
$jilid 		= filterget('jilid');
$ongkos_lipat 	= filterget('ongkos_lipat');
$pakeplat 	= filterget('pakeplat');

$set 		= filterget('jmlset');
$submit 	= filterget('submit');
$modul 		= filterget('modul');
$ongpot 	= filterget('ongpot');
$j_mesin 	= filterget('j_mesin');
$kethitung 	= filterget('kethitung');
// $persen 	= 0;
if (empty($kethitung) or $kethitung == ""){ 
	$kethitung="";
}else{
	$kethitung = str_replace("_"," ",$kethitung);
}

$insheet = filterget('insheet');
//array

$hasil  = array();
// $s_email = filterget('name');
$s_API = filterget('API');
$getData = new WebService();

if($getData->validateAPI($s_API)){
   $hasil = array("akses" => 'Y');

}else{
    $hasil = array("akses" => 'N');
	return;
	}
// $data=array();
	$data = hitungcetak($lbrcetak,$tgcetak,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,$set,$lam,$finishing2, $finishing1, $finishing3,$finishing4,$finishing5,$finishing6,$finishing7,$finishing8,$finishing9,$finishing10,$submit,$lbrf1,$tgf1,$lbrf2,$tgf2,$lbrf3,$tgf3,$lbrf4,$tgf4,$lbrf5,$tgf5,$lbrf6,$tgf6,$lbrf7,$tgf7,$lbrf8,$tgf8,$lbrf9,$tgf9,$lbrf10,$tgf10,$modul,$jml_satuan,$cetak_bagi,$ket_satuan,$ongpot,$j_mesin,$kethitung,$jilid,$ongkos_lipat,$pakeplat,$persen);
// echo json_encode($data);

$data2=array();
$data6=array();
if (!empty($data)){
//	array_push($data,$hasil);
$filteredarray = array_values( array_filter($data));
$gabung = array_merge($filteredarray);
	foreach($gabung as $key => $value){
			$data2 = array_merge($gabung[$key],$hasil);
			array_push($data6,$data2);
	} //End foreach	
	usort($data6, 'sortByOrder');
	echo json_encode($data6);
}

//---------------------------------------------------------------------------------------------------------------------------------------	

function hitungcetak($lbrcetak,$tgcetak,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,$set,$lam,$finishing2, $finishing1, $finishing3,$finishing4,$finishing5,$finishing6,$finishing7,$finishing8,$finishing9,$finishing10,$submit,$lbrf1,$tgf1,$lbrf2,$tgf2,$lbrf3,$tgf3,$lbrf4,$tgf4,$lbrf5,$tgf5,$lbrf6,$tgf6,$lbrf7,$tgf7,$lbrf8,$tgf8,$lbrf9,$tgf9,$lbrf10,$tgf10,$modul,$jml_satuan,$cetak_bagi,$ket_satuan,$ongpot,$j_mesin,$kethitung,$jilid,$ongkos_lipat,$pakeplat,$persen){
global $db;

//Biaya finishing1
	if (empty($finishing1) or $finishing1==0) {
		$totfinishing1=0;
		$hrgfinishing1min=0;
		$hrgfinishing1lebih=0;
		$jmlfinishing1min=0;			
		$nmfinishing1='';			
		}
	else {
		$sqlfinishing1 = $db->query("select * from tbl_biaya where KdBiaya='$finishing1'");
		$row5=$sqlfinishing1->fetch_array();    
		$hrgfinishing1min  		=$row5['HargaMin'];
		$hrgfinishing1lebih  	=$row5['HargaLebih'];
		$jmlfinishing1min  		=$row5['JumlahMin'];	
		$nmfinishing1			=$row5['Nama_Biaya'];
		
		if($finishing1 == 12){
			$pond = 'Y';
		}
		
		$finishing1 = $hrgfinishing1lebih * $jmlcetak * $jml_satuan * $lbrf1 * $tgf1;
		if ($finishing1 <= $hrgfinishing1min) {
			$totfinishing1 = $hrgfinishing1min;}
		else{
			$totfinishing1 = $finishing1;}
	}	

//Biaya finishing2
	if (empty($finishing2) or $finishing2==0) {
		$totfinishing2=0;
		$hrgfinishing2min=0;
		$hrgfinishing2lebih=0;
		$jmlfinishing2min=0;
		$nmfinishing2='';		
		}
	else {
		$sqlfinishing2 = $db->query("select * from tbl_biaya where KdBiaya='$finishing2'");
		$row5=$sqlfinishing2->fetch_array();    
		$hrgfinishing2min  		=$row5['HargaMin'];
		$hrgfinishing2lebih  	=$row5['HargaLebih'];
		$jmlfinishing2min  		=$row5['JumlahMin'];
		$nmfinishing2			=$row5['Nama_Biaya'];	
		
		if($finishing2 == 12){
			$pond = 'Y';
		}		
		
		$finishing2 = $hrgfinishing2lebih * $jmlcetak * $jml_satuan * $lbrf2 * $tgf2;
		if ($finishing2 <= $hrgfinishing2min) {
			$totfinishing2 = $hrgfinishing2min;}
		else{
			$totfinishing2 = $finishing2;}
	}	

	//Biaya finishing3
	if (empty($finishing3) or $finishing3==0) {
		$totfinishing3=0;
		$hrgfinishing3min=0;
		$hrgfinishing3lebih=0;
		$jmlfinishing3min=0;
		$nmfinishing3 = '';		
		}
	else {
		$sqlfinishing3 = $db->query("select * from tbl_biaya where KdBiaya='$finishing3'");
		$row5=$sqlfinishing3->fetch_array();    
		$hrgfinishing3min  		=$row5['HargaMin'];
		$hrgfinishing3lebih  	=$row5['HargaLebih'];
		$jmlfinishing3min  		=$row5['JumlahMin'];
		$nmfinishing3			=$row5['Nama_Biaya'];	
		
		if($finishing3 == 12){
			$pond = 'Y';
		}		
		
		$finishing3 = $hrgfinishing3lebih * $jmlcetak * $jml_satuan * $lbrf3 * $tgf3;
		if ($finishing3 <= $hrgfinishing3min) {
			$totfinishing3 = $hrgfinishing3min;}
		else{
			$totfinishing3 = $finishing3;}
			//$totfinishing3 = $hrgfinishing3lebih * $jmlcetak * $jml_satuan * $lbrf3 * $tgf3;
	}	

	//Biaya finishing4
	if (empty($finishing4) or $finishing4==0) {
		$totfinishing4=0;
		$hrgfinishing4min=0;
		$hrgfinishing4lebih=0;
		$jmlfinishing4min=0;	
		$nmfinishing4='';	
		}
	else {
		$sqlfinishing4 = $db->query("select * from tbl_biaya where KdBiaya='$finishing4'");
		$row5=$sqlfinishing4->fetch_array();    
		$hrgfinishing4min  		=$row5['HargaMin'];
		$hrgfinishing4lebih  	=$row5['HargaLebih'];
		$jmlfinishing4min  		=$row5['JumlahMin'];
		$nmfinishing4			=$row5['Nama_Biaya'];	
		
		if($finishing4 == 12){
			$pond = 'Y';
		}		
		
		
		$finishing4 = $hrgfinishing4lebih * $jmlcetak * $jml_satuan * $lbrf4 * $tgf4;
		if ($finishing4 <= $hrgfinishing4min) {
			$totfinishing4 = $hrgfinishing4min;}
		else{
			$totfinishing4 = $finishing4;}
	}	

		//Biaya finishing5
	if (empty($finishing5) or $finishing5==0) {
		$totfinishing5=0;
		$hrgfinishing5min=0;
		$hrgfinishing5lebih=0;
		$jmlfinishing5min=0;
		$nmfinishing5='';	
		}
	else {
		$sqlfinishing5 = $db->query("select * from tbl_biaya where KdBiaya='$finishing5'");
		$row5=$sqlfinishing5->fetch_array();    
		$hrgfinishing5min  		=$row5['HargaMin'];
		$hrgfinishing5lebih  	=$row5['HargaLebih'];
		$jmlfinishing5min  		=$row5['JumlahMin'];
		$nmfinishing5			=$row5['Nama_Biaya'];	
		
		if($finishing5 == 12){
			$pond = 'Y';
		}		
		
		
		$finishing5 = $hrgfinishing5lebih * $jmlcetak * $jml_satuan * $lbrf5 * $tgf5;
		if ($finishing5 <= $hrgfinishing5min) {
			$totfinishing5 = $hrgfinishing5min;}
		else{
			$totfinishing5 = $finishing5;}
	}		
	
	//Biaya finishing6
	if (empty($finishing6) or $finishing10==6) {
		$totfinishing6=0;
		$hrgfinishing6min=0;
		$hrgfinishing6lebih=0;
		$jmlfinishing6min=0;	
		$nmfinishing6='';	
		}
	else {
		$sqlfinishing6 = $db->query("select * from tbl_biaya where KdBiaya='$finishing6'");
		$row6=$sqlfinishing6->fetch_array();    
		$hrgfinishing6min  		=$row6['HargaMin'];
		$hrgfinishing6lebih  	=$row6['HargaLebih'];
		$jmlfinishing6min  		=$row6['JumlahMin'];	
		$nmfinishing6			=$row6['Nama_Biaya'];
		
		if($finishing6 == 12){
			$pond = 'Y';
		}		
		
		
		$finishing6 = $hrgfinishing6lebih * $jmlcetak * $jml_satuan *  $lbrf6 * $tgf6;
		if ($finishing6 <= $hrgfinishing6min) {
			$totfinishing6 = $hrgfinishing6min;}
		else{
			$totfinishing6 = $finishing6;}
	}

	//Biaya finishing7
	if (empty($finishing7) or $finishing7==0) {
		$totfinishing7=0;
		$hrgfinishing7min=0;
		$hrgfinishing7lebih=0;
		$jmlfinishing7min=0;	
		$nmfinishing7='';	
		}
	else {
		$sqlfinishing7 = $db->query("select * from tbl_biaya where KdBiaya='$finishing7'");
		$row7=$sqlfinishing7->fetch_array();    
		$hrgfinishing7min  		=$row7['HargaMin'];
		$hrgfinishing7lebih  	=$row7['HargaLebih'];
		$jmlfinishing7min  		=$row7['JumlahMin'];	
		$nmfinishing7			=$row7['Nama_Biaya'];
		
		if($finishing7 == 12){
			$pond = 'Y';
		}		
		$finishing7 = $hrgfinishing7lebih * $jmlcetak * $jml_satuan *  $lbrf7 * $tgf7;
		if ($finishing7 <= $hrgfinishing7min) {
			$totfinishing7 = $hrgfinishing7min;}
		else{
			$totfinishing7 = $finishing7;}
	}		
	
	//Biaya finishing8
	if (empty($finishing8) or $finishing8==0) {
		$totfinishing8=0;
		$hrgfinishing8min=0;
		$hrgfinishing8lebih=0;
		$jmlfinishing8min=0;	
		$nmfinishing8='';	
		}
	else {
		$sqlfinishing8 = $db->query("select * from tbl_biaya where KdBiaya='$finishing8'");
		$row8=$sqlfinishing8->fetch_array();    
		$hrgfinishing8min  		=$row8['HargaMin'];
		$hrgfinishing8lebih  	=$row8['HargaLebih'];
		$jmlfinishing8min  		=$row8['JumlahMin'];	
		$nmfinishing8			=$row8['Nama_Biaya'];
		
		if($finishing8 == 12){
			$pond = 'Y';
		}		
		$finishing8 = $hrgfinishing8lebih * $jmlcetak * $jml_satuan *  $lbrf8 * $tgf8;
		if ($finishing8 <= $hrgfinishing8min) {
			$totfinishing8 = $hrgfinishing8min;}
		else{
			$totfinishing8 = $finishing8;}
	}		
	
	//Biaya finishing9
	if (empty($finishing9) or $finishing9==0) {
		$totfinishing9=0;
		$hrgfinishing9min=0;
		$hrgfinishing9lebih=0;
		$jmlfinishing9min=0;	
		$nmfinishing9='';	
		}
	else {
		$sqlfinishing9 = $db->query("select * from tbl_biaya where KdBiaya='$finishing9'");
		$row9=$sqlfinishing9->fetch_array();    
		$hrgfinishing9min  		=$row9['HargaMin'];
		$hrgfinishing9lebih  	=$row9['HargaLebih'];
		$jmlfinishing9min  		=$row9['JumlahMin'];	
		$nmfinishing9			=$row9['Nama_Biaya'];
		
		if($finishing9 == 12){
			$pond = 'Y';
		}		
		$finishing9 = $hrgfinishing9lebih * $jmlcetak * $jml_satuan *  $lbrf9 * $tgf9;
		if ($finishing9 <= $hrgfinishing9min) {
			$totfinishing9 = $hrgfinishing9min;}
		else{
			$totfinishing9 = $finishing9;}
	}	
	//Biaya finishing10
	if (empty($finishing10) or $finishing10==0) {
		$totfinishing10=0;
		$hrgfinishing10min=0;
		$hrgfinishing10lebih=0;
		$jmlfinishing10min=0;	
		$nmfinishing10='';	
		}
	else {
		$sqlfinishing10 = $db->query("select * from tbl_biaya where KdBiaya='$finishing10'");
		$row10=$sqlfinishing10->fetch_array();    
		$hrgfinishing10min  	=$row10['HargaMin'];
		$hrgfinishing10lebih  	=$row10['HargaLebih'];
		$jmlfinishing10min  	=$row10['JumlahMin'];	
		$nmfinishing10			=$row10['Nama_Biaya'];
		
		if($finishing10 == 12){
			$pond = 'Y';
		}		
		$finishing10 = $hrgfinishing10lebih * $jmlcetak * $jml_satuan *  $lbrf10 * $tgf10;
		if ($finishing10 <= $hrgfinishing10min) {
			$totfinishing10 = $hrgfinishing10min;}
		else{
			$totfinishing10 = $finishing10;}
	}	

	
	$totfinishing = $totfinishing1 + $totfinishing2 + $totfinishing3 + $totfinishing4 + $totfinishing5 + $totfinishing6 + $totfinishing7 + $totfinishing8 + $totfinishing9 + $totfinishing10;	
		
	
	
$datafinishing = array(
						"lbrcetak" => $lbrcetak,
						"tgcetak" => $tgcetak,
						"totfinishing" => $totfinishing,
						"finishing1" => $totfinishing1,
						"hrgfinishing1min" => $hrgfinishing1min,
						"hrgfinishing1lebih" => $hrgfinishing1lebih,
						"jmlfinishing1min" => $jmlfinishing1min,	
						"finishing2" => $totfinishing2,
						"hrgfinishing2min" => $hrgfinishing2min,
						"hrgfinishing2lebih" => $hrgfinishing2lebih,
						"jmlfinishing2min" => $jmlfinishing2min,						
						"finishing3" => $totfinishing3,
						"hrgfinishing3min" => $hrgfinishing3min,
						"hrgfinishing3lebih" => $hrgfinishing3lebih,
						"jmlfinishing3min" => $jmlfinishing3min,						
						"finishing4" => $totfinishing4,
						"hrgfinishing4min" => $hrgfinishing4min,
						"hrgfinishing4lebih" => $hrgfinishing4lebih,
						"jmlfinishing4min" => $jmlfinishing4min,						
						"finishing5" => $totfinishing5,
						"hrgfinishing5min" => $hrgfinishing5min,
						"hrgfinishing5lebih" => $hrgfinishing5lebih,
						"jmlfinishing5min" => $jmlfinishing5min,							
						"finishing6" => $totfinishing6,
						"hrgfinishing6min" => $hrgfinishing6min,
						"hrgfinishing6lebih" => $hrgfinishing6lebih,
						"jmlfinishing6min" => $jmlfinishing6min,
						"finishing7" => $totfinishing7,
						"hrgfinishing7min" => $hrgfinishing7min,
						"hrgfinishing7lebih" => $hrgfinishing7lebih,
						"jmlfinishing7min" => $jmlfinishing7min,
						"finishing8" => $totfinishing8,
						"hrgfinishing8min" => $hrgfinishing8min,
						"hrgfinishing8lebih" => $hrgfinishing8lebih,
						"jmlfinishing8min" => $jmlfinishing8min,
						"finishing9" => $totfinishing9,
						"hrgfinishing9min" => $hrgfinishing9min,
						"hrgfinishing9lebih" => $hrgfinishing9lebih,
						"jmlfinishing9min" => $jmlfinishing9min,						
						"finishing10" => $totfinishing10,
						"hrgfinishing10min" => $hrgfinishing10min,
						"hrgfinishing10lebih" => $hrgfinishing10lebih,
						"jmlfinishing10min" => $jmlfinishing10min,						
						"nmfinishing1" => $nmfinishing1,			
						"nmfinishing2" => $nmfinishing2,			
						"nmfinishing3" => $nmfinishing3,			
						"nmfinishing4" => $nmfinishing4,			
						"nmfinishing5" => $nmfinishing5,			
						"nmfinishing6" => $nmfinishing6,			
						"nmfinishing7" => $nmfinishing7,			
						"nmfinishing8" => $nmfinishing8,			
						"nmfinishing9" => $nmfinishing9,			
						"nmfinishing10" => $nmfinishing10,			
						"persen" => $persen,			
						"namamodul" => '',			
						"modul" => $modul,			
						// "pond" => $pond,			
						"ongpot" => $ongpot,			
						"kethitung" => $kethitung,			
				);						
				//	echo json_encode($datafinishing);	

//Cari Biaya Cetak dan Biaya Kertas
$data = array();
$data1 = array();
$data2 = array();
$data3 = array();
$data4 = array();
$data5 = array();
$data6 = array();
$data10 = array();

	// $where = "where modul like '%" . $modul . "%'";

if (empty($j_mesin) or $j_mesin == ""){
	$where = "where modul like '%" . $modul . "%'";
}else{
	 $where = "where `mesin`.`jenis_mesin` = '" . $j_mesin . "'";
}
	
$quer = "select * from mesin " . $where . " AND aktif='Y'";
//----------------------------------------------------------------------------------------------------------	 
	$sql = $db->query($quer);
	while($row=$sql->fetch_array()){ 
	
		$mesin = $row['kdmesin'];
		$lebarcetak = $row['lebarcetak'];
		$panjangcetak = $row['panjangcetak'];
		$mes = $row['namamesin'];

	//hitung jumlah set mengikuti konsep mesin lipat
//	echo "Lebar : " . ($lbrcetak ) . "x Tinggi : " .$tgcetak . "</br>";

	if(empty($jilid)){
		$jilid = 0;
	} 
	
	$ukuran_lipat = hitung_lipatan($lbrcetak,$tgcetak,$lebarcetak,$panjangcetak,$jilid,$set); //fungsi ada di reader
	$uk_lbr = ($ukuran_lipat[0][0]);
	$uk_tg = ($ukuran_lipat[0][1]);
	$uk_lbr2 = ($ukuran_lipat[1][0]);
	$uk_tg2 = ($ukuran_lipat[1][1]);
	$jml_pot = ($ukuran_lipat[2]);	
	
//	echo "<br>" . json_encode($ukuran_lipat) . "<br> <br>";
	
	if (is_null($jml_pot) or $jml_pot < 1){ 
		goto end;} 
	if (is_null($set) or $set < 1){ 
		goto end;}	
		
	 $jsett = round($set / $jml_pot);
	 $jset = ($set / $jml_pot);
	 $sisa = $set - ($jsett*$jml_pot);
//	 echo $set . " halaman muat " . $jml_pot . " (" . $uk_lbr2 . "x" . $uk_tg2 . "cm) di" . $mes . " - " .$jset ."(" . $jsett . ") set, sisa " . $sisa . "<br>";
	 
	
//	echo "<br>" . $sisa . "<br> <br>";

	
//echo $sisa . "<br>";
	

	
	 if($jset < 1){
		$data=[];

		
		$hit2 = hitbiayacetak($mesin, $uk_lbr,$uk_tg,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,$set,$lam,$lbrcetak,$tgcetak,$jml_satuan,$cetak_bagi,$ket_satuan,$ongkos_lipat,$pakeplat);
		usort($hit2, 'sortByOrder');
		array_push($data10,$hit2[0]); //Push ke array hanya paling kecil
	//	echo "<br>" . json_encode($data) . "<br> <br>";
	}
	
	elseif($jset >=1 AND $sisa <= 0){
		
		$data=[];
		if (!empty($uk_lbr)){ 
			$hita = hitbiayacetak($mesin, $uk_lbr,$uk_tg,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,$jsett,$lam,$lbrcetak,$tgcetak,$jml_satuan,$cetak_bagi,$ket_satuan,$ongkos_lipat,$pakeplat );
		} else { $hita = [];}
		if (!empty($uk_lbr2)){ 
			$hitb = hitbiayacetak($mesin, $uk_lbr2,$uk_tg2,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,$jsett,$lam,$lbrcetak,$tgcetak,$jml_satuan,$cetak_bagi,$ket_satuan,$ongkos_lipat,$pakeplat );
		} else { $hitb = []; }
				
		$gabung = array_merge($hita,$hitb);
	//	$data = $hit2;
		usort($gabung, 'sortByOrder');
//		echo "<br>" . json_encode($data) . "<br> <br>";
		array_push($data10,$gabung[0]);
	//	echo "<br>" . json_encode($data10) . "<br> <br>";
	}
	elseif($jset>=1 AND $sisa > 0){
		
		if (!empty($uk_lbr)){ 
			$hita = hitbiayacetak($mesin, $uk_lbr,$uk_tg,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,$jsett,$lam,$lbrcetak,$tgcetak,$jml_satuan,$cetak_bagi,$ket_satuan,$ongkos_lipat,$pakeplat );
		}else { $hita = [];}
		if (!empty($uk_lbr2)){ 
			$hitb = hitbiayacetak($mesin, $uk_lbr2,$uk_tg2,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,$jsett,$lam,$lbrcetak,$tgcetak,$jml_satuan,$cetak_bagi,$ket_satuan,$ongkos_lipat,$pakeplat );
		} else { $hitb = []; }
		$gabung = array_merge($hita,$hitb);
	
		// echo "<br>" . json_encode($hit_a) . "<br> <br>";
		// echo "<br>" . json_encode($hit_b) . "<br> <br>";
		
		usort($gabung, 'sortByOrder');
		$data1 = $gabung[0];
		
			//sisa
		$ukuran_sisa = hitung_lipatan($lbrcetak,$tgcetak,$lebarcetak,$panjangcetak,$jilid, $sisa); //fungsi ada di reader
		$uk_lbr_sisa = ($ukuran_sisa[0][0]);
		$uk_tg_sisa = ($ukuran_sisa[0][1]);
		$uk_lbr_sisa2 = ($ukuran_sisa[1][0]);
		$uk_tg_sisa2 = ($ukuran_sisa[1][1]);
		$jml_pot_sisa = ($ukuran_sisa[2]);	
		
		$jsett_sisa = round($sisa / $jml_pot_sisa);
		 $jset_sisa = ($sisa / $jml_pot_sisa);
		 $sisa_akhir = $sisa - ($jsett_sisa*$jml_pot_sisa);
		
	//	echo "<br>" . json_encode($ukuran_sisa) . "<br> <br>";

		$sql2 = $db->query($quer);
		$data2=[];
		while($row2=$sql2->fetch_array()){
			$mesin2 = $row2['kdmesin'];
			$mes2 = $row2['namamesin'];	
			if (!empty($uk_lbr_sisa)){
				$hit2_a = hitbiayacetak($mesin2, $uk_lbr_sisa,$uk_tg_sisa,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,($jsett_sisa),$lam,$lbrcetak,$tgcetak,$jml_satuan,$cetak_bagi,$ket_satuan,$ongkos_lipat,$pakeplat );
			} else { $hit2_a = []; }
			if (!empty($uk_lbr_sisa2)){
				$hit2_b = hitbiayacetak($mesin2, $uk_lbr_sisa2,$uk_tg_sisa2,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,($jsett_sisa),$lam,$lbrcetak,$tgcetak,$jml_satuan,$cetak_bagi,$ket_satuan,$ongkos_lipat,$pakeplat );
			} else { $hit2_b = []; }
			
			$gabung2 = array_merge($hit2_a,$hit2_b);
			usort($gabung2, 'sortByOrder');

			if (!empty($gabung2)){
				$data2 = array_merge($data2,$gabung2);
			}
		}
		usort($data2, 'sortByOrder');

		//Gabungkan nilai di data2 dan data1
		$data = [];

		//$data = $data2[0];
		//array_push($data1,$data2[0]);
		foreach($data1 as $key => $value){
				for($i = 0 ; $i<count($key); $i++){
					if($key=='jml_total'){
					$data[$key] = $value + $data2[0][$key];	
					//$data[$key] = $value + $data2[0][$key];	
					}else{
					$data[$key] = $value.'|'.$data2[0][$key];
					//$data[$key] = $value.'|'.$data2[0][$key];
					}
				}
		} //End foreach	
	//	echo json_encode($data) . "<br><br><br>";
		array_push($data10,$data);
	} //End elseIf
	 end:

	 }  //End While
//----------------------------------------------------------------------------------------------------------	 

	usort($data10, 'sortByOrder');

	foreach($data10 as $key => $value){
				$tot = intval($data10[$key]['jml_total']) + intval($datafinishing['totfinishing']);	
				$totjual = ($tot * $persen/100) + $tot;
				$data10[$key]['jml_total'] = $tot;
				$data10[$key]['total_jual'] = $totjual;	
	} //End foreach	
	
	
	//Gabungin Aray Finishing ama ongkos cetak
	
		foreach($data10 as $key => $value){
			//for($i = 0 ; $i<count($key); $i++){
					$data2 = array_merge($data10[$key],$datafinishing);
					array_push($data6,$data2);
			//}
		} //End foreach	
	
	$data10 = $data6;
	return $data10;
			
}

function hitbiayacetak($mesin, $lbrcetak,$tgcetak,$jmlcetak,$bahan,$jmlwarna,$jmlwarna2,$bbstat,$tarik,$insheet,$set,$lam,$lbc,$tgc,$jml_satuan,$cetak_bagi,$ket_satuan,$ongkos_lipat,$pakeplat ){
global $db;
$data= array(); //menampung data hasil ke array

// Cari Biaya Potong
	$sql3 = $db->query("select * from tbl_biaya where KdBiaya='29'");
	$row3 = $sql3->fetch_array(); // pilih biaya potong
	$hargapot  =$row3['HargaLebih'];	
	$hargapotmin  =$row3['HargaMin'];
	
	// Cari Jenis Bahan
	$sqljenis = $db->query("select * from kategori_bahan where id_kategori='$bahan'");
	$rowjenis = $sqljenis->fetch_array(); // 
	$jenis_bahan  =$rowjenis['nama_kategori'];	
	
		
// Biaya Laminating
if ($lam == '1' or $lam== '2'){$laminat='18';}
elseif ($lam == '3' or $lam== '4'){$laminat='17';}
elseif ($lam == '5' or $lam== '6'){$laminat='16';}
else {$laminat='';}

$sqlam = $db->query("select * from tbl_biaya where KdBiaya='$laminat'");
$row7 = $sqlam->fetch_array();
$ketlam  	=$row7['Nama_Biaya'];
$hrgminlam  	= $row7['HargaMin'];
$hrglebihlam  	= $row7['HargaLebih'];	

//Cari laminating satumuka / bb jika bb kalikan 2				
if ($lam == '1' or $lam== '3' or $lam=='5'){$jmlam=1;}
else if ($lam == '2' or $lam== '4' or $lam=='6'){$jmlam=2;}
else{$jmlam=0;}

if ($lam == '1' or $lam == '3' or $lam == '5'){
	$kerlambb = "SatuMuka";
}else if ($lam == '2' or $lam == '4' or $lam == '6'){
	$kerlambb = "Bolakbalik";
}	

	

//Mulai Hitung Ongkos Cetak dan mesin	
	$sql = $db->query("select * from mesin where kdmesin='$mesin' AND aktif='Y'");
	while($row=$sql->fetch_array()){ //mesinmesinmesinmesinmesinmesinmesinmesinmesinmesinmesinmesinmesinmesinmesinmesinmesinmesin 
		$hargaminim = $row['hargamin'];
		$jmlminim = $row['jumlahmin'];
		$hargadrek = $row['hargalebih'];
		$lbrkertasmesin = $row['lebarkertas'];
		$tgkertasmesin = $row['panjangkertas'];
		$lebartext = $row['lebarcetak'];
		$tinggitext = $row['panjangcetak'];
		$lebarmin = $row['min_lebar'];
		$tinggimin = $row['min_panjang'];
		$ctp = $row['hargactp'];
		$NamaMesin = $row['namamesin'];
		$jenis_mesin = $row['jenis_mesin'];
		$replatsetiap = $row['replat'];

		//$replat = $row['replat'];
		if (is_null($tarik)){
			$tarik = $row['tarikan'];
		}elseif ($tarik == 0){
			$tarik = 0;
		}else{
			$tarik = $row['tarikan'];
		}

	$x = 1;
	$y = 1;

	//Menentukan Ukuran Maksimal dimana Lebar agar lebih Kecil dari Tinggi
	if ($lebartext > $tinggitext){         
		$z = $lebartext;  			
		$w = $tinggitext;}			
	else{							
		$z = $tinggitext;          
		$w = $lebartext;}			
		
	//Menentukan Ukuran Minimal mesin dimana Lebar agar lebih Kecil dari Tinggi
	//	echo $row['min_panjang'] . " x " . $row['min_lebar'] ;
	if ($lebarmin > $tinggimin){
		$tinggimin = $row['min_lebar'];
		$lebarmin = $row['min_panjang'];}
	//	echo $tinggimin . " x " . $lebarmin ;
		

	$ulangbb=1; 	
	$kali = "L";		
	$ulangbb = 1;
	
	while ($ulangbb <= 3) {  //selama cetak bolak balik  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	

	$lebarpot 	= $lbrcetak;    
	$tinggipot 	= $tgcetak;
	$lebarcetak	= $lbrcetak;   
	$tinggicetak= $tgcetak;
		
	
	//Menentukan Ukuran Cetakan  dimana Lebar agar lebih Kecil dari Tinggi
	if ($lebarpot > $tinggipot){
		$tinggipot		= $lbrcetak;
		$lebarpot 		= $tgcetak;
		$tinggicetak	= $lbrcetak;    
		$lebarcetak		= $tgcetak;
	}		

	//Jika Cetak BB
	$bb=2;	
	$jmlwarna1 = $jmlwarna;
	
	//Jika Cetak 1 Muka saja maka loncat
	if($jmlwarna2 < 1 or empty($jmlwarna2) ){
		$cetakbb=1;
		$ketbb="Cetak Satu Muka";
		$ulangbb=4;
		$jmlwarna = $jmlwarna1;
		$biayabbplatsama = 0;
		$bb=1;
		goto loncatbbsatumuka;
	}
	
	if ($ulangbb <= 3){   //Jika di Cetak Bolak balik Beda Plat
		$cetakbb= 1;
		$jmlwarna = $jmlwarna + $jmlwarna2;
		$ketbb="Bolak-balik Beda Plat";
		$ins_bb = 2;
		$biayabbplatsama = 0;
	} //jika cetak bolak balik plat sama berarti ukuran cetaknya dibagi 2
		
	if ($ulangbb <= 2){   //Jika di Cetak Bolak balik plat yang sama
		$cetakbb= 2;
		$ins_bb = 2;	
		$biayabbplatsama = $row['biayabbplatsama'];		
		$jmlwarna = $jmlwarna1;
		if ($kali == "L") { 		//Bolak balik Lebar Cetakan x 2
			$lebarpot = $lebarpot * 2;
			$lebarcetak = $lebarcetak * 2;
			$ketbb="Bolak-balik Plat yang Sama x Lebar";
			}
		elseif ($kali == "P"){	//Bolak balik Tinggi Cetakan x 2
			$tinggipot = $tinggipot * 2;
			$tinggicetak = $tinggicetak * 2;	
			$ketbb="Bolak-balik Plat yang Sama x Tinggi";
		}
		
	} //jika cetak bolak balik plat sama berarti ukuran cetaknya dibagi 2
	
loncatbbsatumuka:

						// echo $lebarpot . "x" .$tinggipot ."<br>";
					// echo $z / $tinggipot . "x" .$w ."<br>";
								

		while ($z / $lebarpot >= 1){ // Selama Tinggi Mesin masih muat u/ Lebar Cetakan	// x aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa	
		
						
			while ($z / $tinggipot >= 1) { //  Selama Tinggi Mesin masih muat u/ Tinggi Cetakan  // y
				
					
			//	 echo "lebarcetak:" . $lebarcetak . "tinggicetak:" . $tinggicetak . "y:" . $y . "x" .$x . "w" .$w . "z" .$z ."<br>";
				
				if ($x * $lebarcetak >= $w) {  
					if ($x * $lebarcetak <= $z and $y * $tinggicetak <= $w){											
						goto lanjut;
						}
					elseif ($x * $lebarcetak <= $w and $y * $tinggicetak <= $z){
						goto lanjut;
						}	
					else{
						goto loncat;
						}
					}

lanjut:

				if($cetak_bagi=='Y'){
						$muat = $x * $y * $cetakbb;

				}else{
						$muat = 1;						
				}
		
		//	echo "muat: " . $muat . " untuk " . $lebarpot . " x ". $tinggipot. "<br>";	
		
			//Jika ukuran cetak lebih kecil dari ukuran minimal mesin loncati
			if ($lebarpot < $lebarmin) {
				goto loncat; }
			elseif	($tinggipot < $tinggimin) { 
				goto loncat; }
	
				// Cari Ukuran Kertas
				
				$sql2 = $db->query("select * from tbl_bahan where id_kategori='$bahan' and publish='Y' and Harga_Bahan> '0'");			
				while($row2=$sql2->fetch_array()){ //vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
				
					$Nm_Bhn=$row2['Nm_Bhn'];
					$hrgbhn=$row2['Harga_Bahan'];
					$tblbhan=$row2['Tebal'];
					$tgbhan=$row2['Tinggi'];
					$lbrbhan=$row2['Lebar'];
		
					//Jenis Bahan;
		
					$lebarpotkertas = $lebarpot + $tarik;
					$tinggipotkertas = $tinggipot + $tarik;
				//	echo $lebarpotkertas . "x" . $tinggipotkertas . " = " . $lebarpot . " x ". $tinggipot. "<br>";	
					
					$hitpot = hitung($lebarpotkertas,$tinggipotkertas,$lbrbhan,$tgbhan);
					if($cetak_bagi=='N'){
										
										$jmlpot = 1;
									}else{
										$jmlpot = $hitpot[0]['jml'];
									}
									
					if($jmlwarna <= 0){
						$lebarpotkertas = $lbrcetak;
						$tinggipotkertas = $tgcetak;
						$muat = 1;
						$hitpot = hitung($lebarpotkertas,$tinggipotkertas,$lbrbhan,$tgbhan);
						$jmlpot = $hitpot[0]['jml'];
					}				
									


					if (is_null($jmlpot) or $jmlpot < 1){ 
						goto akhirbhn;} 


				//	$jmlset = ceil($set / $muat);// * $cetakbb;
					$jmlset = $set;// * $cetakbb;
					//echo ($jmlcetak * $jml_satuan ) / $muat  . "<br>";
					
					$jmlcetakreal = ceil(($jmlcetak * $jml_satuan / $muat ) * $cetakbb);
					
					$jmlbhn= ceil(($jmlcetak * $jml_satuan ) / $muat );
					

					
				//	echo $NamaMesin . " - " . $jmlbhn . "<br>";
					
					$jmldrek = $jmlcetakreal - $jmlminim;
					if ($jmldrek < 0) {  //jika jumlah drek lebih kecil dari 0
						$jmldrek = 0;}			
					$totdrek = $jmldrek * $hargadrek * $jmlwarna;
					
					if (is_null($totdrek)){
						$totdrek = 0;}
						
					if ($laminat==''){
						$totlaminating=0;	$hrgminlam = 0; 	$hrglebihlam = 0;	}
					else{
						//$biayalam = $lbrcetak * $tgcetak * $jmlcetakreal * $hrglebihlam * $jmlam;
						$biayalam = $lbrcetak * $tgcetak * $jmlcetak * $hrglebihlam * $jmlam * $set;						
						if ( $biayalam > $hrgminlam) {
							$totlaminating = $biayalam;
							//$ketlam="(percm Rp." . $hrglebihlam . " -" . $kerlambb;}
						}else {
							$totlaminating = $hrgminlam * $jmlset;
							//$ketlam="(Harga Laminating Minim)";}
						}
					}	
					
//cari insheet di database
	$sqlinsheet = $db->query("select * from tbl_insheet where '$jmlbhn' between dari and sampai");			
	$rowinsheet=$sqlinsheet->fetch_array();
	if($ins_bb == 2){
		$in=$rowinsheet['insheet_bb'];
		$insheet_ = $jmlbhn * $in / 100 ;
	}else{
		$in=$rowinsheet['insheet'];
		$insheet_ = $jmlbhn * $in / 100;
	}
	
	if($insheet==0){
		$insheet_ = 0;
	}
	if($jenis_mesin == 'PrintDigital' ){
		$insheet_ = 0;
	}

	$jmlrealcetak =  $jmlbhn + $insheet_;				
	//replat
	if($jmlrealcetak / $replatsetiap < 1){
		$replat = 1;
	}else{
		$replat = ceil($jmlrealcetak / $replatsetiap);
	}
			//Ongkos Cetak
					
			//Ongkos Cetak Print Digital		
					if($jenis_mesin == 'PrintDigital' ){


							
							$hitpotm = hitung($lbrcetak,$tgcetak, $lebartext, $tinggitext);
							if($cetak_bagi=='N'){
										$jmlpot = 1;
										$jmlpot2 = 1;
									}else{
										$jmlpot = $hitpotm[0]['jml'];
										$hitpotm2 = hitung($lebartext,$tinggitext, $lbrbhan, $tgbhan);
										$jmlpot2 = $hitpotm2[0]['jml'];
									}
							
							
							
					
							$jmlprint = ceil(($jmlcetak * $set * $jml_satuan)/$jmlpot);
							
							$sql = $db->query("select * from harga_print where kdmesin='$mesin' AND '$jmlprint' between jml_min and jml_max");
							$row=$sql->fetch_array();  // mesin yg di ceklis
							$harga_print = $row['harga'];
							$harga_laminating = $row['harga_laminating'];
							$jmlminim = $row['jml_min'] . " s/d " . $row['jml_max'] ;
							if (is_null($harga_print)){
									if ($jmlprint > $jmlminim){
										$harga_print = $hargadrek;
									}else{
										$harga_print = $hargaminim;
									}
							}
							
							
							
							$totcetak = $jmlprint * $harga_print * $bb;	
							//echo $bb;
							$hargaminim = $harga_print;
					
							$tot_ctp = 0;
							$ctp = 0;
							
							//Jika laminating perlembar A3 lebih mahal dari pada pakai mesin laminating besar
							$totlaminating = $lbrcetak * $tgcetak * $jmlcetak * $jml_satuan * $hrglebihlam * $jmlam * $set;
							$totlaminating2 = $jmlprint * $harga_laminating * $jmlam;
						
							if ($laminat==''){
								$totlaminating=0;	$hrgminlam = 0; 	$hrglebihlam = 0;	}
							else{
								if ($totlaminating < $hrgminlam) {
									$totlaminating = $hrgminlam;
								}
									//$ketlam="(Harga Laminating Minim)";}
								else {
								$totlaminating = $hrgminlam;
								}
									//$ketlam="(percm Rp." . $hrglebihlam . " -" . $kerlambb;}
									
								if ($lam == '3' or $lam == '4' or $lam == '5' or $lam == '6'){
									if ($totlaminating > $totlaminating2){
									$totlaminating = $totlaminating2;}
									//$ketlam="Harga Lam Rp." . $harga_laminating . "/lbr -" . $kerlambb;}	
									//echo $totlaminating2;
								}			
							}	

							$jmlcetakreal = $jmlprint;			
							$tgbhan = $tinggitext;			
							$lbrbhan = $lebartext ;			
							$muat = $jmlpot;
							$lebarpot = $lebartext;
							$tinggipot = $tinggitext;;
							$tarik = 0;
							//$lebarpotkertas = '';
							//$tinggipotkertas = '';
							
							
							if($jmlprint > 50){
								$ongkos_potong = $hargapotmin;
							}else{
								$ongkos_potong = 0;
							}
							
							$jmlplano = ceil((($jmlbhn + $insheet_) * $set )/ $jmlpot2);
							
					}else{
							$totcetak = ceil((($hargaminim * $jmlwarna) + $totdrek + ($biayabbplatsama * $jmlwarna)) * $jmlset );
							$jmlplano = ceil((($jmlbhn + $insheet_) * $set ) / $jmlpot);
							$beratkertas = ceil(($lbrbhan * $tgbhan * $tblbhan * $jmlplano) / 10000000);
							$ongkos_potong = ceil($beratkertas * $hargapot);
							if ($hargapotmin>$ongkos_potong){
								$ongkos_potong = $hargapotmin;
							}
					}	
					
					
					//$jmlplano = round((($jmlbhn * $set) + $insheet) / $jmlpot);
					$totbhn = $hrgbhn * $jmlplano ;
					// echo $NamaMesin . " - " . $jmlbhn . " - plano : " . $jmlplano . "<br>";
					//echo $jmlplano;
					


					//$tot_cetak = round($totcetak);
					if($pakeplat == 'N'){
						$tot_ctp = 0;
					}else{
						$tot_ctp = $ctp * $jmlwarna * $jmlset  * $replat;
					}
					$tot_plat = $jmlwarna * $jmlset  * $replat;
					$jml_total = $totcetak + $totbhn + $tot_ctp + $ongkos_potong + $totlaminating;
					//$jmlplano = round($jmlplano);

					$hitpot2 = hitung($lbc,$tgc,$lebarpotkertas,$tinggipotkertas);
					$jmlmuat = $hitpot2[0]['jml'];
					
					//ongkos_lipat
					if(!empty($ongkos_lipat)){
					$sqllipat = $db->query("select * from tbl_biaya where KdBiaya='52'");
					$row10=$sqllipat->fetch_array();    
					$hrgfinishing10min  	=$row10['HargaMin'];
					$hrgfinishing10lebih  	=$row10['HargaLebih'];
					$jmlfinishing10min  	=$row10['JumlahMin'];	
					$nmfinishing10			=$row10['Nama_Biaya'];
					
					$lipat = ($hrgfinishing10lebih + (($hrgfinishing10lebih/2) * (($jmlmuat/2) - 1))) *    $jmlbhn * $set;
					if ($lipat <= $hrgfinishing10min) {
						$tot_lipat = $hrgfinishing10min;}
					else{
						$tot_lipat = $lipat;}
					
					}else{
						$tot_lipat = 0;}
						
					
					//Masukan data ke array
					array_push($data, array(
						"jmlcetak" => $jmlcetak,			
						"jmlcetakreal" => $jmlcetakreal,	
						"lebarpot" => $lebarpot,
						"tinggipot" => $tinggipot,
						"ukuranpot" => $lebarpot . "x" . $tinggipot,
						"lebarpotkertas" => $lebarpotkertas,
						"tinggipotkertas" => $tinggipotkertas,
						"beratkertas" => $beratkertas,						
						"lbrbhan" => $lbrbhan,			
						"tgbhan" => $tgbhan,			
						"jenis_bahan" => $jenis_bahan,
						"Nm_Bhn" => $Nm_Bhn,
						"hrgbhn" => $hrgbhn,
						"jmlbhn" => $jmlbhn,
						"insheet" => $insheet_,
						"jmlplano" => $jmlplano,
						"totbhn" => $totbhn,
						"mesin" => $NamaMesin,
						"jenismesin" => $jenis_mesin,
						"hargaminim" => $hargaminim, 
						"hargadrek" => $hargadrek, 
						"jmlminim" => $jmlminim, 
						"lebarcetak" => $lebartext,
						"tinggicetak" => $tinggitext,
						"totcetak" => $totcetak,
						"ongkos_potong" => $ongkos_potong,						
						"hargapot" => $hargapot,						
						"hargapotmin" => $hargapotmin,						
						"tot_ctp" => $tot_ctp,
						"ctp" => $ctp,
						"jmlwarna" => $jmlwarna1,
						"jmlwarna2" => $jmlwarna2,
						"tot_plat" => $tot_plat,
						"replat" => $replat,
						"replatsetiap" => $replatsetiap,
						"jml_total" => $jml_total,	
						"total_jual" => 0,							
						"muat1plano" => $jmlpot,			
						"muat" => $jmlmuat,
						"jmlset" =>$jmlset,
						"lamminim" => $hrgminlam,
						"lamlebih" => $hrglebihlam,
						"totlaminating" => $totlaminating,
						"ketlam" => $ketlam,
						"ketbb" => $ketbb,
						"bbstat" => $bbstat,
						"tarik" => $tarik,
						"ket_satuan" => $ket_satuan,
						"jml_satuan" => $jml_satuan,
						"tot_lipat" => $tot_lipat,
					));

					
akhirbhn:					
				} // while bahan yyyyyyyyyyyyyy
loncat:

			$y = $y + 1;
			$tinggipot = $tinggicetak * $y;

			}//end while2
			
		$y = 1;
		$tinggipot = $tinggicetak;

		$x = $x + 1;
		$lebarpot = $lebarcetak * $x;
		
		}//endwhile1 xxxxxxxxxxxxxxxxxxxxxxxxx

		
		$kali="P";
		$x = 1;
		$y = 1;
		$ulangbb = $ulangbb + 1;
		} // endwhile cetak bb

bawah:		
		
	}// foreach  mesin
		
	

usort($data, 'sortByOrder');
//echo json_encode($data);
return $data;

} //end fungsi hitbiayacetak

//---------------------

function hitungbahan($lbrcetak,$tgcetak,$jmlcetak,$bahan){
global $db;
$data= array(); //menampung data hasil ke array

	
	// Cari Jenis Bahan
	$sqljenis = $db->query("select * from kategori_bahan where id_kategori='$bahan'");
	$rowjenis = $sqljenis->fetch_array(); // 
	$jenis_bahan  =$rowjenis['nama_kategori'];	
	
				// Cari Ukuran Kertas
				
				
				$sql2 = $db->query("select * from tbl_bahan where id_kategori='$bahan' and publish='Y' and Harga_Bahan> '0'");			
				while($row2=$sql2->fetch_array()){ //vvvv
				
					$Nm_Bhn=$row2['Nm_Bhn'];
					$hrgbhn=$row2['Harga_Bahan'];
					$tblbhan=$row2['Tebal'];
					$tgbhan=$row2['Tinggi'];
					$lbrbhan=$row2['Lebar'];
	//	echo "sini";
					//Jenis Bahan;
		
					
													
					
						$lebarpotkertas = $lbrcetak;
						$tinggipotkertas = $tgcetak;
						
						
						$muat = 1;
						$hitpot = hitung($lebarpotkertas,$tinggipotkertas,$lbrbhan,$tgbhan);
						$jmlpot = $hitpot[0]['jml'];
									
					//echo $lebarpotkertas . "x" . $tinggipotkertas . " = " . $lebarpot . " x ". $tinggipot. "<br>";	


					if (is_null($jmlpot) or $jmlpot < 1){ 
						goto akhirb;} 

//										

					
					$jmlplano = ceil($jmlcetak / $jmlpot);
					$beratkertas = ceil(($lbrbhan * $tgbhan * $tblbhan * $jmlplano) / 10000000);
					$totbhn = $hrgbhn * $jmlplano ;

					$jml_total = $totbhn;
					//$jmlplano = round($jmlplano);
				
					
					//Masukan data ke array
					array_push($data, array(
						"jmlcetak" => $jmlcetak,			
						"lebarpot" => $lbrcetak,
						"tinggipot" => $tgcetak,
						"ukuranpot" => $lbrcetak . "x" . $tgcetak,
						"lebarpotkertas" => $lebarpotkertas,
						"tinggipotkertas" => $tinggipotkertas,
						"beratkertas" => $beratkertas,						
						"lbrbhan" => $lbrbhan,			
						"tgbhan" => $tgbhan,			
						"jenis_bahan" => $jenis_bahan,
						"Nm_Bhn" => $Nm_Bhn,
						"hrgbhn" => $hrgbhn,
						"jmlbhn" => $jmlbhn,
						"jmlplano" => $jmlplano,
						"totbhn" => $totbhn,
						"mesin" => "",
						"jenismesin" => "",
						"hargaminim" => "", 
						"hargadrek" => "", 
						"jmlminim" => "", 
						"lebarcetak" => "",
						"tinggicetak" => "",
						"totcetak" => 0,
						"ongkos_potong" => 0,						
						"hargapot" => 0,						
						"hargapotmin" => 0,						
						"tot_ctp" => 0,
						"ctp" => 0,
						"jmlwarna" => "",
						"jmlwarna2" => "",
						"tot_plat" => 0,
						"replat" => 0,
						"replatsetiap" => 0,
						"jml_total" => $jml_total,	
						"total_jual" => 0,							
						"muat1plano" => $jmlpot,			
						"muat" => $jmlmuat,
						"jmlset" => 0,
						"lamminim" => 0,
						"lamlebih" => 0,
						"totlaminating" => 0,
						"ketlam" => "",
						"ketbb" => "",
						"bbstat" => "",
						"tarik" => "",
						"ket_satuan" => "",
						"jml_satuan" => "",
						"tot_lipat" => 0,
					));
					
					//echo json_encode($data);

					
akhirb:					
				} // while bahan yyyyyyyyyyyyyy
			usort($data, 'sortByOrder');
					return $data;
		
}// foreach  bahan	


//Urutkan array berdasarkan total

function sortByOrder($a, $b) {
    return $a['jml_total'] - $b['jml_total'];}
?>