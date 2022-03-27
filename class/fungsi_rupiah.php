<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

function rp($angka){
	// $konversi = ''.number_format($angka, 0, ',', '.');
$konversi = number_format((int)$angka, 0, ',', '.');
	return $konversi;
}
function rp2($angka){
	$hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}
function cNav($x){
$data = "<button  id='o-nav$x' type='submit' class='btn btn-success hint--top-left' onclick='openNav(\"$x\")' aria-label='Lihat gambar'><i class='fa fa-file-image-o'></i></button>
<button  id='c-nav$x' type='submit' class='btn btn-warning hint--top-left' onclick='closeNav(\"$x\")' aria-label='Tutup gambar'><i class='fa fa-close'></i></button>";
return $data;
}
function modalHit($mods=true){
$data = '<li class="calcs"><a class="calc" href="#"  data-modName="modsatu" data-className="modal-md"  data-toggle="modal" data-id="'.paramEncrypt('rowid='.$mods).'" data-target="#myModal" data-backdrop="static" data-keyboard="false" data-placement="bottom" data-toggle="tooltip" title="Hitung"></a></li>';
// echo $data;
return $data;
}
function linkDL($str){
$data = '<li class="calcs"><a class="download" href="'.$str.'" data-placement="bottom" data-toggle="tooltip" title="Download"></a></li>';
// echo $data;
return $data;
}
function harga($str){
if($str!=0){
$data = '<li class="harga">'.rp2($str).'</li>';
}else{
$data ='';
}
return $data;
}
?>
