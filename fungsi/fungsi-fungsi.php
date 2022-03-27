<?php


function rp($angka){
	// $konversi = ''.number_format($angka, 0, ',', '.');
$konversi = number_format((int)$angka, 0, ',', '.');
	return $konversi;
}
function cNav($x){
$data = "<button  id='o-nav$x' type='submit' class='btn btn-success hint--top-left' onclick='openNav(\"$x\")' aria-label='Lihat gambar'><i class='fa fa-file-image-o'></i></button>
<button  id='c-nav$x' type='submit' class='btn btn-warning hint--top-left' onclick='closeNav(\"$x\")' aria-label='Tutup gambar'><i class='fa fa-close'></i></button>";
return $data;
}
?>