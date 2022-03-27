<?php
error_reporting(0);
session_start();
if (empty($_SESSION['namauser'])){
echo json_encode(array(404 => "error"));
}else{
include "../conn/konfigurasi.php";
include "../function/reader.php";

//hitungBahan(
$lebarpotkertas = floatval($_GET['lebarpotkertas']);
$tinggipotkertas = floatval($_GET['tinggipotkertas']);
$jmlcetak = $_GET['jmlcetak'];
$bahan = $_GET['bahan'];

$data = hitungbahan($lebarpotkertas,$tinggipotkertas,$jmlcetak,$bahan);

if (empty($data)){		
$data = array("totbhn" => '0');						
		echo json_encode($data);
}else{
		echo json_encode($data);
}


function hitungbahan($lebarpotkertas,$tinggipotkertas,$jmlcetak,$bahan){
koneksi2_buka();
$data=array();
//Biaya lem
	$sql = mysql_query("select * from tbl_biaya where KdBiaya between '79' AND '82'");
	$luasbot = $lebarpotkertas * $tinggipotkertas;
	while($row = mysql_fetch_array($sql)){
		$luaslem = $row['Panjang'] * $row['Lebar'];
		$lem = $row['KdBiaya'];
		if($luasbot <= $luaslem){
		array_push($data,array($luaslem,$luasbot,$lem));		
		}
	}
	sort($data);
//	echo json_encode($data);
	$lem = $data[0][2];
	//echo $lem;

//Biaya Lem Bot
	
	$sqlfinishing2 = mysql_query("select * from tbl_biaya where KdBiaya='$lem'");
	$row5=mysql_fetch_array($sqlfinishing2);    
	$hrgfinishing2min  		=$row5['HargaMin'];
	$hrgfinishing2lebih  	=$row5['HargaLebih'];
	$jmlfinishing2min  		=$row5['JumlahMin'];	
	$finishing2 = $hrgfinishing2lebih * $jmlcetak/2;
	if ($finishing2 <= $hrgfinishing2min) {
		$totlem = $hrgfinishing2min;}
	else{
		$totlem = $finishing2;}	
	
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
					$total = $totbhn + $ongkos_potong + $totlem;
					$totjual = ($total * $persen / 100) + $total;
					
					//Masukan data ke array
					array_push($data, array(
						"jmlcetak" => $jmlcetak,			
						"lebarpotkertas" => $lebarpotkertas,
						"tinggipotkertas" => $tinggipotkertas,
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
						"totlem" => $totlem,						
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
    return $a['totbhn'] - $b['totbhn'];}
	

}
?>

