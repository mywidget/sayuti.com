<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
//hitung hari
function hitungHari($awal,$akhir){
$tglAwal = strtotime($awal);
$tglAkhir = strtotime($akhir);
$jeda = abs($tglAkhir - $tglAwal);
return floor($jeda/(60*60*24));
}
//random password
function random($panjang_karakter)  
{
$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';  
$string = '';  
for($i = 0; $i < $panjang_karakter; $i++) {  
$pos = rand(0, strlen($karakter)-1);  
$string .= $karakter{$pos};
}  
return $string;  
}  
function potong($string, $limit, $break="") {
// return with no change if string is shorter than $limit 
if(strlen($string) <= $limit) 
return $string; 
$string = substr($string, 0, $limit); 
if(false !== ($breakpoint = strrpos($string, $break))) { 
$string = substr($string, 0, $breakpoint); 
}
$string = str_replace(" ","",strtolower($string));
return $string; 
}
?>