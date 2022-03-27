<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');
$detect = new Mobile_Detect();
$module =  match_uri($_SERVER['REQUEST_URI']);
$link = gets('link') && gets('link') ? gets('link') : '';
$act = parseUrl($_SERVER['REQUEST_URI'],1);
$down = parseUrl($_SERVER['REQUEST_URI'],2);
$pagenum = parseUrl($_SERVER['REQUEST_URI'],3);
$pageprod = parseUrl($_SERVER['REQUEST_URI'],4);
$seo = seo_title(parseUrl($_SERVER['REQUEST_URI'],2));
$seo_prod = seo_title(parseUrl($_SERVER['REQUEST_URI'],3));
$breadone = pisah_kata($seo_prod);
$breadone = ucwords($breadone);

// $act = gets('action') && gets('action') ? gets('action') : 'index';
// $seo = gets('seo') && gets('seo') ? gets('seo') : '';
function insert_populer($id,$idcat,$tanggalbaca,$jenis=true){
	global $db;
	if($jenis==0){
	$cekdata = $db->query("SELECT klik,id_kategori FROM populer WHERE id_berita='$id' AND tanggalklik='$tanggalbaca' AND jenis=0");
	$ada = $cekdata->num_rows;
	if($ada == 1 ){
	$rowk = $cekdata->fetch_array();
	$klik = $rowk['klik']+1;
	$id_kategori = $rowk['id_kategori'];
	if($id_kategori == $idcat){
	$db->query("UPDATE populer SET klik='$klik' WHERE id_berita='$id' AND tanggalklik='$tanggalbaca' AND jenis='0'");
	}else{
	$db->query("UPDATE populer SET klik='$klik',id_kategori='$idcat' WHERE id_berita='$id' AND tanggalklik='$tanggalbaca' AND jenis='0'");
	}
	}else{
	$db->query("INSERT INTO populer(id_berita,id_kategori,tanggalklik,klik,jenis) VALUES('$id','$idcat','$tanggalbaca',1,0)");
	$db->query("delete from populer where tanggalklik !='$tanggalbaca'");
	}
	}else{
	//populer produk
	$cekdata = $db->query("SELECT klik,id_kategori FROM populer WHERE id_berita='$id' AND tanggalklik='$tanggalbaca' AND jenis='1'");
	$ada = $cekdata->num_rows;
	if($ada == 1 ){
	$rowk = $cekdata->fetch_array();
	$klik = $rowk['klik']+1;
	if($rowk['id_kategori'] == $idcat){
	$sql = $db->query("UPDATE populer SET klik='$klik' WHERE id_berita='$id' AND tanggalklik='$tanggalbaca' AND jenis='1'");
	// if(!$sql){echo 'error';}
	}else{
	$db->query("UPDATE populer SET klik='$klik',id_kategori='$idcat' WHERE id_berita='$id' AND tanggalklik='$tanggalbaca' AND jenis='1'");
	}
	}else{
	$db->query("INSERT INTO populer(id_berita,id_kategori,tanggalklik,klik,jenis) VALUES('$id','$idcat','$tanggalbaca',1,1)");
	$db->query("delete from populer where tanggalklik !='$tanggalbaca'");
	}
	}
}
function tags3($id){
global $db;
$res = $db->query("SELECT tag FROM `posting` WHERE id_post=".$id);
$TampungData = array();
while($data_tags=$res->fetch_array()){
$tags = explode(',',strtolower(trim($data_tags['tag'])));
if(empty($data_tags['tag'])){echo'';}else{
foreach($tags as $val) {
$TampungData[] = $val;
}}
}
$jumlah_tag = array_count_values($TampungData);
ksort($jumlah_tag);
if ($jumlah_tag){
$output = array();
echo '<i class="fa fa-tag"></i> ';
foreach($jumlah_tag as $key=>$val) {
$output[] = '<a href="/tag/'.seo_title($key).'">'.ucfirst($key).'</a>';
}
$tags= implode(', ',$output);
return $tags;
}

}
?>