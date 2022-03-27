<?php
error_reporting(0);
//fungsi jmlpotongan 1
function jumlahpotongan($vT_P, $vL_P, $vLebar, $vtinggi){
		global $posisi;
        $jumlah = 0;
        $jumlahx = 0;
		$jumlahxx=0;
        $jumlahy = 1;
        $sumbux = 200;
        $sumbuawal = $sumbux;
        $sumbuy = 200;
        $bagian = 1;
        $i = 1;
        $varl_p = $vL_P;
        $vart_p = $vT_P;
		$lb = array();
		$tg = array();
		$hasil = array();
		
		$koordinat = array();

        if ($posisi == "L" and $vT_P < $vtinggi) {
            return;}
        elseif (($posisi == "L") and $vT_P > $vtinggi and $vL_P < $vLebar) {
            return;}
		if (($posisi == "L") and $vL_P < $vLebar) {
            return;}	
        
		if (($posisi == "P") and $vL_P < $vLebar) {
            return;}
			
        for ($o=1; $o<=300; $o++) {
            if ($vT_P - ($jumlahx * $vtinggi) >= $vtinggi) {
                if ($sumbux == 200){
					
				array_push($koordinat, (($sumbux-200)/10 . "|". ($sumbuy-200)/10 . "|". $vtinggi/10 . "|". $vLebar/10));
					
					
                    $sumbux = $sumbux + $vtinggi;
                    $jumlah = $jumlah + 1;
					$jumlahx= $jumlahx + 1;
					

					

					}
                else{
					
					array_push($koordinat, (($sumbux-200)/10 . "|". ($sumbuy-200)/10 . "|". $vtinggi/10 . "|". $vLebar/10));
					
                    $sumbux = $sumbux + $vtinggi;
                    $jumlahx = $jumlahx + 1;
                    $jumlah = $jumlah + 1;
					}
				array_push($lb, ($sumbux - 200));
				array_push($tg,($sumbuy + $vLebar - 200));
			}
            elseif ($vL_P - ($jumlahy * $vLebar) >= $vLebar) {
                $sumbuy = $sumbuy + $vLebar;
                $sumbux = $sumbux - ($jumlahx * $vtinggi);
                $jumlahy = $jumlahy + 1;
                $jumlahxx = $jumlahx;
                $jumlahx = 0;}

            elseif ($vart_p - ($jumlahxx * $vtinggi) >= $vLebar and $i == 1 and (($posisi == "L"))) {
                if ($vT_P < $vtinggi) {
                    return;}
					
                $vT_P = $vT_P - ($jumlahx * $vtinggi);
				
                $sumbuy = 200; 
                $vtinggidumi = $vtinggi;
                $vlebardumi = $vLebar;
                $vtinggi = $vlebardumi;
                $vLebar = $vtinggidumi;
                $jumlahx = 0;
                $jumlahy = 1;
                $i = $i + 1;
				}

            elseif ($varl_p - ($jumlahy * $vLebar) >= $vtinggi and $i == 1 and (($posisi == "P"))) {

                $vL_P = $vL_P - ($jumlahy * $vLebar);
                $sumbuy = $sumbuy + $vLebar;
                $sumbux = 200;
                $vtinggidumi = $vtinggi;
                $vlebardumi = $vLebar;
                $vtinggi = $vlebardumi;
                $vLebar = $vtinggidumi;
                $jumlahx = 0;
                $jumlahy = 1;
                $i = $i + 1;
				}
		}//end for
	rsort($lb);	
	rsort($tg);	
	$hasil = array("jml"=>$jumlah,"lbr"=>$lb[0],"tg"=>$tg[0],"luas"=>($lb[0] * $tg[0]),"koor"=>$koordinat); //$jumlah;
	return $hasil;
}//end function

//fungsi jml potongan 2
function jumlahpotongan2($vT_P, $vL_P, $vLebar, $vtinggi)// 'lebar ujung dikurang satu
        {
		global $posisi;
        $jumlah = 0;
        $jumlahx = 0;
		$jumlahxx = 0;
        $jumlahy = 1;
        $jumlahxxx = 0;
        $sumbux = 200;
        $sumbuawal = $sumbux;
        $sumbuy = 200;
        $bagian = 1;
        $pindah = "";
        $i = 1;
        $varl_p = $vL_P;
        $vart_p = $vT_P;
		$lb = array();
		$tg = array();
		$koordinat = array();
		$hasil = array();
        if (($posisi == "L") and $vT_P < $vtinggi) {
            return;}
        if (($posisi == "P") and $vL_P < $vLebar) {
            return;}

        if (($posisi == "L")) {
            $vT_P = $vT_P - $vtinggi;}
                if (($posisi == "P")) {
					$vL_P = $vL_P - $vLebar;}
       

        for ($e = 1; $e<=300; $e++){
            if ($vT_P - ($jumlahx * $vtinggi) >= $vtinggi) {
                if ($sumbux == 200) {
					
					array_push($koordinat, (($sumbux-200)/10 . "|". ($sumbuy-200)/10 . "|". $vtinggi/10 . "|". $vLebar/10));
                    $sumbux = $sumbux + $vtinggi;
                    $jumlah = $jumlah + 1;
                    $jumlahx = $jumlahx + 1;}
                else{
					array_push($koordinat, (($sumbux-200)/10 . "|". ($sumbuy-200)/10 . "|". $vtinggi/10 . "|". $vLebar/10));
                
					$sumbux = $sumbux + $vtinggi;
                    $jumlahx = $jumlahx + 1;
                    $jumlah = $jumlah + 1;}
				array_push($lb, ($sumbux - 200));
				array_push($tg,($sumbuy + $vLebar - 200));	
					}
            elseif ($vL_P - ($jumlahy * $vLebar) >= $vLebar) {
                $sumbuy = $sumbuy + $vLebar;
                if (($pindah == "y")) {
                    $sumbux = $jumlahxxx; }
                else{
                    $sumbux = $sumbux - ($jumlahx * $vtinggi);}
                $jumlahxx = $jumlahx;
                $jumlahx = 0;
                $jumlahy = $jumlahy + 1;
				}
            elseif ($vart_p - ($jumlahxx * $vtinggi) >= $vLebar and $i == 1 and (($posisi == "L"))) {
                if ($vL_P < $vtinggi) {
                    return;}
					
                $vT_P = ($vart_p) - ($jumlahx * $vtinggi);
                $sumbuy = 200 ;
                $vtinggidumi = $vtinggi;
                $vlebardumi = $vLebar;
                $vtinggi = $vlebardumi;
                $vLebar = $vtinggidumi;
                $jumlahxxx = $sumbux;
                $pindah = "y";
                $jumlahx2 = $jumlahx;
                $jumlahx = 0;
                $jumlahy = 1;
                $i = $i + 1;
				}

            elseif ($varl_p - ($jumlahy * $vLebar) >= $vtinggi and $i == 1 and (($posisi == "P"))) {
                if ($vL_P < $vtinggi) {
                    return;}
                $vL_P = ($varl_p) - ($jumlahy * $vLebar);
                $sumbuy = $sumbuy + $vLebar;
                $sumbux = 200;
                $vtinggidumi = $vtinggi;
                $vlebardumi = $vLebar;
                $vtinggi = $vlebardumi;
                $vLebar = $vtinggidumi;
                $jumlahxxx = $sumbux;
                $jumlahy2 = $jumlahy;
                $pindah = "y";
                $jumlahx = 0;
                $jumlahy = 1;
                $i = $i + 1;
				}
            elseif ($i == 2 and (($posisi == "L")) and $varl_p - ($jumlahy * $vLebar) >= $vtinggi) {
                $vL_P = $varl_p - ($jumlahy * $vLebar);
                $sumbuy = 200 + ($jumlahy * $vLebar);
                $sumbux = 200 + $jumlahx2 * $vLebar;
                $vtinggidumi = $vtinggi;
                $vlebardumi = $vLebar;
                $vtinggi = $vlebardumi;
                $vLebar = $vtinggidumi;
                $jumlahx = 0;
                $jumlahy = 1;
                $i = $i + 1;
				}

            elseif ($i == 2 and (($posisi == "P")) and $vart_p - ($jumlahx * $vtinggi) >= $vLebar and $varl_p - ($jumlahy2 * $vtinggi) >= $vtinggi) {
                $vT_P = $vart_p - ($jumlahx * $vtinggi);
                $sumbuy = 200 + ($jumlahy2 * $vtinggi);
                $vtinggidumi = $vtinggi;
                $vlebardumi = $vLebar;
                $vtinggi = $vlebardumi;
                $vLebar = $vtinggidumi;
                $jumlahx = 0;
                $jumlahy = 1;
                $i = $i + 1;
            }

        }//end for e
	rsort($lb);	
	rsort($tg);	
	$hasil = array("jml"=>$jumlah,"lbr"=>$lb[0],"tg"=>$tg[0],"luas"=>($lb[0] * $tg[0]),"koor"=>$koordinat); //$jumlah;
	return $hasil;
   }// End Function jumlahpotongan2
   
   
//fungsi hitung 
function hitung($tinggicetak, $lebarcetak, $panjangtext, $lebartext){
$data = array();	
global $posisi;
$keluar = 0;
$keluar1 = "";

$tinggicetak = str_replace(',', '.', $tinggicetak);
$lebarcetak = str_replace(',', '.', $lebarcetak);
$panjangtext = str_replace(',', '.', $panjangtext);
$lebartext = str_replace(',', '.', $lebartext);


$tinggicetak1 = $tinggicetak;
$lebarcetak1 = $lebarcetak;
$panjangtext1 = $panjangtext;
$lebartext1 = $lebartext;

if ($panjangtext < $lebartext){ 
    $panjangtext = $lebartext1;
    $lebartext = $panjangtext1;}
	
if ($tinggicetak < $lebarcetak){
    $tinggicetak = $lebarcetak1;
    $lebarcetak = $tinggicetak1;}

L1:

    $Tinggi = $tinggicetak * 100;
    $Lebar = $lebarcetak * 100;
    $L_P = $lebartext * 100;
    $T_P = $panjangtext * 100;
    $posisi = "L";
    $muatcetakan1 = jumlahpotongan($T_P, $L_P, $Lebar, $Tinggi);
//	array_push($data, $muatcetakan1);
    if ($keluar1 == "Y"){
        return;
	}
P1:
    $Tinggi = $tinggicetak * 100;
    $Lebar = $lebarcetak * 100;
    $L_P = $lebartext * 100;
    $T_P = $panjangtext * 100;
    $posisi = "P";
    $muatcetakan2 = jumlahpotongan($T_P, $L_P, $Tinggi, $Lebar);
//	array_push($data, $muatcetakan2);
    if ($keluar1 == "Y") {
        return;}
   
L2:
    $Tinggi = $tinggicetak * 100;
    $Lebar = $lebarcetak * 100;
    $L_P = $lebartext * 100;
    $T_P = $panjangtext * 100;
    $posisi = "L";
    $muatcetakan3 = jumlahpotongan2($T_P, $L_P, $Lebar, $Tinggi);
//	array_push($data,$muatcetakan3);
    if ($keluar1 == "Y") {
        return;}

P2:
    $Tinggi = $tinggicetak * 100;
    $Lebar = $lebarcetak * 100;
    $L_P = $lebartext * 100;
    $T_P = $panjangtext * 100;
    $posisi = "P";
    $muatcetakan4 = jumlahpotongan2($T_P, $L_P, $Tinggi, $Lebar);
//	array_push($data, $muatcetakan4);
	if ($keluar1 == "Y"){
        return;}
		
	$data[]= $muatcetakan1;	
	$data[]= $muatcetakan2;	
	$data[]= $muatcetakan3;	
	$data[]= $muatcetakan4;	
	
	// Obtain a list of columns
	foreach ($data as $key => $row) {
		$jml[$key]  = $row['jml'];
		$luas[$key] = $row['luas'];
	}

	// Sort the data with jml descending, luas ascending
	// Add $data as the last parameter, to sort by the common key
	array_multisort($jml, SORT_DESC, $luas, SORT_ASC, $data);
	//echo json_encode($data) . "<br><br>";
	return $data;	


} //end fungsi


?>