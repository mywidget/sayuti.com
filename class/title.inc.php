<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
function default_desc(){
$data = "Percetakan Serang - sayuti.com | Print Digital | Print Kalender 2022";
return $data;
}
function situs(){
$data = ' | Percetakan Serang - sayuti.com | Print Digital | Print Kalender 2022';
return $data;
}
function judul($module=true,$seo=true,$seo_prod=true){
global $db;
//beranda
if($module=='' || $module=='index.php' || $module=='index.html'){
return "Percetakan Serang - sayuti.com |  Print Digital | Print Kalender 2022 | Print A3";
}
//info
elseif($module=='category' AND !$seo){
return "Semua Informasi". situs();
}elseif($module=='category' AND $seo=='pageno'){
if (filter_var($pagenum, FILTER_VALIDATE_INT)) {
return 2;
} else {
return 3;
}
}elseif($module=='category' AND $seo){
$sql = $db->query("select * from cat where kategori_seo='$seo' AND pub='Y'");
if($sql->num_rows > 0){
$row=$sql->fetch_array();
$judul = $row['nama_kategori']. situs();
return $judul . situs();
}else{
$sql = $db->query("select * from posting where judul_seo='$seo'");
$row=$sql->fetch_array();
$judul = $row['judul']. situs();
return $judul;
}
//produk
}elseif($module=='produk' AND $seo=='pageno'){
return "Semua Produk" .situs();
}elseif($module=='produk'){
if($seo AND $seo_prod){
$sql = $db->query("select * from produk where produk_seo='$seo_prod'");
if($sql->num_rows > 0){
$row = $sql->fetch_array();
$judul = $row['nama_produk'];
return $judul . situs();
}else{
return "Semua Produk ". $seo .  situs();
}
}else{
return "Semua Produk ". $seo .  situs();
}
}elseif($module=='klien'){
if($seo){
return $seo . situs();
}else{
	return "Klien sayuti.com";
}
}elseif($module=='download-file'){
	return "Logo Baru sayuti.com";
}elseif($module=='page'){
if($seo){
$sql = $db->query("select * from page where judul_seo='$seo'");
$row=$sql->fetch_array();
$judul = $row['judul']. situs();
return $judul;
}else{
return situs();
}
}elseif($module=='cari'){
	return "Pencarian ". situs();
}elseif($module=='reseller'){
	return "Reseller". situs();
}elseif($module=='aktivasi'){
	return "Aktivasi Reseller". situs();
}elseif($module=='kontak'){
	return "Hubungi Kami". situs();
}
}


//gambar
function gambar($module=true,$seo=true,$seo_prod=true,$host=true){
global $db;
//beranda
if($module=='' || $module=='index.php' || $module=='index.html'){
return $host."images/thumb.jpg";
}
//info
elseif($module=='category' AND !$seo){
return $host."images/thumb.jpg";
}elseif($module=='category' AND $seo=='pageno'){
return $host."images/thumb.jpg";
}elseif($module=='category' AND $seo){
$sql = $db->query("select * from cat where kategori_seo='$seo' AND pub='Y'");
if($sql->num_rows > 0){
$row=$sql->fetch_array();
return $host."images/thumb.jpg";
}else{
$sql = $db->query("select * from posting where judul_seo='$seo'");
$row=$sql->fetch_array();
$thnt = folderthn($row['folder']);
$blnt = folderbln($row['folder']);
$gbrt = $row['gambar'];
$gambar = $host.'images/post/'.$thnt.'/'.$blnt.'/'.$gbrt;
return $gambar;
}
//produk
}elseif($module=='produk' AND !$seo){
$sql = $db->query("select * from produk where produk_seo='$seo_prod'");
if($sql->num_rows > 0){
$row=$sql->fetch_array();
return $row['photo'];
}
}elseif($module=='produk' AND $seo=='pageno'){
return $host."images/thumb.jpg";
}elseif($module=='produk'){
$sql = $db->query("select * from produk where produk_seo='$seo_prod'");
if($sql->num_rows > 0){
$row = $sql->fetch_array();
$arrays =  explode('#', $row['photo2']);
$filteredarray = array_values( array_filter($arrays) );
$exp = array_merge($filteredarray);
$img = $exp[0];
return $host.$img;
}else{
$sqlcat = $db->query("select photo from jenis_produk where seo_produk='$seo' AND pub='Y'");
if($sqlcat->num_rows > 0){
$row = $sqlcat->fetch_array();
return $row['photo'];
}else{
return $host."images/thumb.jpg";
}
}
}elseif($module=='klien'){
if($seo){
return $seo . situs();
}else{
return $host."images/thumb.jpg";
}
}elseif($module=='page'){
if($seo){
$sql = $db->query("select * from page where judul_seo='$seo'");
$row=$sql->fetch_array();
$arrays =  explode('#', $row['photo']);
$filteredarray = array_values( array_filter($arrays) );
$exp = array_merge($filteredarray);
$img = $exp[0];
return $host.$img;
}else{
return $host."images/thumb.jpg";
}
}elseif($module=='reseller'){
return $host."images/daftar.jpg";
}elseif($module=='kontak'){
return $host."images/map.jpg";
}else{
return $host."images/thumb.jpg";
}
}
function alamat($kode=true){
global $db;
$sql = $db->query("select * from kantor where kode_kantor='$kode' AND pub='0'");
if($sql->num_rows > 0){
$row = $sql->fetch_array();
if($row['map']!=''){
$map = '<a href="'.$row['map'].'" target="_blank" title="Lihat Peta"><i class="fa fa-map-marker"></a>';
}else{
$map = '<i class="fa fa-map-marker">';
}
echo '                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="widget_title">
                        <h4><span>'.$row['nama_kantor'].'</span></h4>
                    </div>
                    <div class="widget_content">
                        <ul class="contact-details-alt">
                            <li>'.$map.'</i> 
							<p>'.$row['alamat'].'</p></li>
                            <li><i class="fa fa-user"></i> <p>'.$row['tlp'].'</p></li>
                            <li><i class="fa fa-envelope"></i> <p><a href="#">'.$row['email'].'</a></p></li>
                        </ul>
                    </div>
                </div>';
}
}
function alamat_2($kode=true){
global $db;
$sql = $db->query("select * from kantor where kode_kantor='$kode'");
$row = $sql->fetch_array();
echo '
                        <ul class="widget_info_contact">
                            <li><i class="fa fa-map-marker"></i> 
							<p>'.$row['alamat'].'</p></li>
                            <li><i class="fa fa-user"></i> <p>'.$row['tlp'].'</p></li>
                            <li><i class="fa fa-envelope"></i> <p><a href="#">'.$row['email'].'</a></p></li>
							<li><i class="fa fa-globe"></i> <p><a href="https://sayuti.com" data-placement="bottom" data-toggle="tooltip" title="www.sayuti.com">www.sayuti.com</a></p></li>
                        </ul>';
}

function urlsosmed($name=true){
global $db;
$qry = $db->query("select * from sosmed where publish='Y' AND tag='$name'");
while($row=$qry->fetch_array()){
$data = $row['link'];
return $data;
}
}
function canonical($module=true,$seo=true,$seo_prod=true){
global $db;
if($module=='detail'){
	$html = BASE_URL.'detail/'.$seo;
	return $html;
}elseif($module=='category' AND $seo){
$sql = $db->query("select * from cat where kategori_seo='$seo' AND pub='Y'");
if($sql->num_rows > 0){
	$html = BASE_URL.'category/'.$seo;
}else{
	$html = BASE_URL.'category/'.$seo;
}
	return $html;
}elseif($module=='category' AND !$seo){
	$html = BASE_URL.'category/';
	return $html;
}elseif($module=='produk'){
if($seo){
if($seo AND $seo_prod){
$html = BASE_URL.'produk/'.$seo.'/'.$seo_prod;
}else{
$html = BASE_URL.'produk/'.$seo;
}
}else{
$html = BASE_URL.'produk';
}
	return $html;
}elseif($module=='page'){
	return BASE_URL.'page/'.$seo;
}elseif($module=='video'){
	return BASE_URL.'foto/'.$seo;
}elseif($module=='agenda'){
	return BASE_URL.'agenda/'.$seo;
}elseif($module=='foto'){
	return BASE_URL.'foto/'.$seo;
}elseif($module=='download'){
	return BASE_URL.'download/'.$seo;
}elseif($module=='download-berkas'){
	return BASE_URL.'download-berkas/'.$seo;
}elseif($module=='kontak'){
	return BASE_URL.$module;
}else{
return setting('site_url');
    }
}
//fungsi deskripsi website
function desc($module=true,$seo=true,$seo_prod=true){
	global $db;
if($module=='' || $module=='index.php' || $module=='index.html'){
$data = "Percetakan Serang - sayuti.com |  Print Digital | Print Kalender 2022 | Print A3";
return $data;
}
elseif($module=='detail'){
	$sql = $db->query("SELECT postingan FROM posting where judul_seo='$seo'");
    $row=$sql->fetch_array();
    $num_rows=$sql->num_rows;
	if($num_rows>0){
	$cleanpost = $row['postingan'];
	$text = potdesc($cleanpost,200);
	$text = strip_word_html($text);
	return $text;
	}else{
default_desc();
	}
}elseif($module=='produk'){
$sql = $db->query("select * from produk where produk_seo='$seo_prod'");
if($sql->num_rows > 0){
$row = $sql->fetch_array();
	$cleanpost = $row['keterangan'];
	$text = kata($cleanpost,50);
	$text = cleanString($text);
	$data = $text;
}else{
$data = "Reseller Kalender 2022 |  Percetakan Serang - sayuti.com ";
}
return $data;
}
elseif($module=='page'){
default_desc();
}elseif($module=='reseller'){
$data = "Reseller Kalender 2022 |  Percetakan Serang - sayuti.com ";
return $data;
}else{
default_desc();
    }
}
//meta keyword
function keyword($module=true,$seo=true,$seo_prod=true){
global $db;
if($module=='' || $module=='index.php' || $module=='index.html'){
$data = "cetak kalender 2022, percetakan serang, percetakan pandeglang, percetakan labuan, percetakan rangkasbitung, undangan blangko murah,percetakan terbaik di serang, digital printing di banten, percetakan di banten, spanduk banner serang";
return $data;
}elseif($module=='produk'){
$sql = $db->query("select * from produk where produk_seo='$seo_prod'");
if($sql->num_rows > 0){
$row = $sql->fetch_array();
$data = cleanString($row['keyword']);
}else{
$data = "cetak kalender 2022, percetakan serang, percetakan pandeglang, percetakan labuan, percetakan rangkasbitung, undangan blangko murah,percetakan terbaik di serang, digital printing di banten, percetakan di banten, spanduk banner serang";
}
return $data;
}
}
?>