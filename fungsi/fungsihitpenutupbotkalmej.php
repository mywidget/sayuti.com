<?php
// error_reporting(0);
session_start();
include "../conn/konfigurasi.php";
include "../function/reader.php";
include "../function/filter.php";
//hitungBahan(
$lebarpotkertas1 = floatval($_GET['lebarpotkertas1']);
$tinggipotkertas1 = floatval($_GET['tinggipotkertas1']);
$lebarpotkertas2 = floatval($_GET['lebarpotkertas2']);
$tinggipotkertas2 = floatval($_GET['tinggipotkertas2']);

$jmlcetak = $_GET['jmlcetak'];
$bahan = $_GET['bahan'];

$data1 = hitungbahan($lebarpotkertas1,$tinggipotkertas1,$jmlcetak,$bahan);
$data2 = hitungbahan($lebarpotkertas2,$tinggipotkertas2,$jmlcetak,$bahan);

//echo json_encode($data1);
//echo json_encode($data2);

		//Gabungkan nilai di data2 dan data1
		$data = [];
		foreach($data1[0] as $key => $value){
			for($i = 0 ; $i<count($key); $i++){
					if($key=='totjual' or $key=='totbhn' or $key=='ongkos_potong' or $key=='total' or $key=='beratkertas'){
					$data[0][$key] = intval($value) + intval($data2[0][$key]);	
					}else{
					$data[0][$key] = $value .'|'.$data2[0][$key];
			}
					//$data[$key]= intval($data1[0]['totjual']) + intval($data2[0]['totjual']);
			}		
				
		} //End foreach	



if (empty($data)){	
$data = array("totbhn" => '0');						
		echo json_encode($data);
}else{
		echo json_encode($data);
}


function hitungbahan($lebarpotkertas,$tinggipotkertas,$jmlcetak,$bahan){
koneksi2_buka();
$data=array();


// Cari Biaya Potong
	$sql3 = mysql_query("select * from tbl_biaya where KdBiaya='29'");
	$row3 = mysql_fetch_array($sql3); // pilih biaya potong
	$hargapot  =$row3['HargaLebih'];	
	$hargapotmin  =$row3['HargaMin'];	
	
//cari persentase penjualan
		$sql22 = mysql_query("select * from tbl_biaya where KdBiaya='66'");
		$row6=mysql_fetch_array($sql22);    
		$persen  	=$row6['JumlahMin'];

	
	
$data= array(); //menampung data hasil ke array

				// Cari Ukuran Kertas
				$sql2 = mysql_query("select * from tbl_bahan where id_kategori='$bahan' and publish='Y'");			
				while($row2=mysql_fetch_array($sql2)){ //vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
				
					$Nm_Bhn=$row2['Nm_Bhn'];
					$hrgbhn=$row2['Harga_Bahan'];
					$tblbhan=$row2['Tebal'];
					$tgbhan=$row2['Tinggi'];
					$lbrbhan=$row2['Lebar'];
		
					$jmlpot = hitung($lebarpotkertas,$tinggipotkertas,$lbrbhan,$tgbhan);
					$jmlpot = $jmlpot[0]['jml'];
					if (is_null($jmlpot)){ 
						goto akhirbhn;} 
					
					$jmlplano = round(($jmlcetak) / $jmlpot);
					$totbhn = $hrgbhn * $jmlplano;
//Ongkos Potong
					$beratkertas = ($lbrbhan * $tgbhan * $tblbhan * $jmlplano) / 10000000;
					$ongkos_potong = $beratkertas * $hargapot;
					$jmlplano = round($jmlplano) . " lbr Plano";
					$total = $totbhn + $ongkos_potong;
					$totjual = ($total * $persen / 100) + $total;
					
					//Masukan data ke array
					array_push($data, array(
						"jmlcetak" => $jmlcetak,			
						"lebarpotkertas" => $lebarpotkertas,
						"tinggipotkertas" => $tinggipotkertas,
						"ukuranpot" => $lebarpotkertas ."x" . $tinggipotkertas,			
						"lbrbhan" => $lbrbhan,			
						"tgbhan" => $tgbhan,			
						"Nm_Bhn" => $Nm_Bhn,
						"hrgbhn" => $hrgbhn,
						"jmlplano" => $jmlplano,
						"beratkertas" => $beratkertas,
						"totbhn" => $totbhn,
						"ongkos_potong" => $ongkos_potong,
						"muat1plano" => $jmlpot,			
						"total" => $total,		
						"totjual" => $totjual,						
					));

					
	akhirbhn:					
				} // while bahan vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
koneksi2_tutup();
usort($data, 'sortByOrder');
return $data;

} //end fungsi hitungcetak

//Urutkan array berdasarkan total

function sortByOrder($a, $b) {
    return $a['totjual'] - $b['totjual'];}
?>

