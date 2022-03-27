<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
					<div class="col-xs-12 col-md-4 col-lg-4 col-sm-4">
						<div class="sidebar">
							<?php echo plugin('cse',1);?>
							<div class="widget widget_categories">
								<div class="widget_title">
									<h4><span>Informasi</span></h4>
								</div>
								<ul class="arrows_list">
<?php
$sqlcat = $db->query("select * from cat where pub='Y' order by urutan ASC");
while($row=$sqlcat->fetch_array()){
?>
	<li><a href="/category/<?=$row['kategori_seo'];?>"><i class="fa fa-angle-right"></i><?=$row['nama_kategori'];?></a></li>
<?php } ?>
								</ul>
							</div>

                            <div class="widget widget_tab">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#Popular2" data-toggle="tab">Info Terpopuler</a></li>
                                    <li class=""><a href="#Recent2" data-toggle="tab">Recent</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content clearfix">
                                    <div class="tab-pane fade active in" id="Popular2">
                                        <ul class="recent_tab_list">
<?php
$sqlpop = $db->query("SELECT 
  posting.judul,
  posting.judul_seo,
  posting.tanggal,
  posting.gambar,
  posting.folder
FROM
  posting
  INNER JOIN populer ON (posting.id_post = populer.id_berita)
  AND (posting.id_cat = populer.id_kategori) where jenis='0' order by klik DESC limit 5");
while($row=$sqlpop->fetch_array()){
$judul_seo = '/category/'.$row['judul_seo'];
$thnt = folderthn($row['folder']);
$blnt = folderbln($row['folder']);
$gbrt = $row['gambar'];
$gambar = $host.'/images/post/'.$thnt.'/'.$blnt.'/200x200_'.$gbrt;
?>
                                            <li>
                                                <span><a href="#"><img src="<?=$gambar;?>" height="50" alt="" /></a></span>
                                                <a href="<?=$judul_seo;?>"><?=$row['judul'];?></a>
                                                <i><?=datetimes($row['tanggal']);?></i>
                                            </li>
<?php } ?>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="Recent2">
                                        <ul class="recent_tab_list">
<?php
$sqlre = $db->query("SELECT * FROM posting where publish='Y' order by tanggal DESC limit 5");
while($rowr=$sqlre->fetch_array()){
$judul_seor = '/category/'.$rowr['judul_seo'];
$thnt = folderthn($rowr['folder']);
$blnt = folderbln($rowr['folder']);
$gbrt = $rowr['gambar'];
$gambar = $host.'/images/post/'.$thnt.'/'.$blnt.'/200x200_'.$gbrt;
?>
                                            <li>
                                                <span><a href="#"><img src="<?=$gambar;?>" height="50" alt="" /></a></span>
                                                <a href="<?=$judul_seor;?>"><?=$rowr['judul'];?></a>
                                                <i><?=datetimes($rowr['tanggal']);?></i>
                                            </li>
<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
							
							<div class="widget widget_categories">
								<div class="widget_title">
									<h4><span>Kategori Produk</span></h4>
								</div>
								<ul class="arrows_list">
<?php
$sqlcat = $db->query("SELECT * FROM `jenis_produk`  where pub='Y'");
while($row=$sqlcat->fetch_array()){
?>
	<li><a href="/produk/<?=$row['seo_produk'];?>"><i class="fa fa-angle-right"></i><?=$row['produk'];?></a></li>
<?php } ?>
								</ul>
							</div>
                            <div class="widget widget_tab">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#Popular" data-toggle="tab">Produk Terpopuler</a></li>
                                    <li class=""><a href="#Recent" data-toggle="tab">Recent</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content clearfix">
                                    <div class="tab-pane fade active in" id="Popular">
                                        <ul class="recent_tab_list">
<?php
$sqlpop = $db->query("SELECT 
  produk.nama_produk,
  produk.produk_seo,
  produk.id_produk,
  produk.photo2,
  jenis_produk.seo_produk
FROM
  produk
  INNER JOIN populer ON (produk.id_produk = populer.id_berita)
  AND (produk.kategori_produk = populer.id_kategori)
  INNER JOIN jenis_produk ON (populer.id_kategori = jenis_produk.id_jenis_produk) where jenis='1' order by klik DESC limit 5");
while($row=$sqlpop->fetch_array()){
$katprod = $row['seo_produk'];
$judul_seo = '/produk/'.$katprod.'/'.$row['produk_seo'];
$exp =  explode('#', $row['photo2']);
$gbrt = $exp[0];
$full_path = $_SERVER["DOCUMENT_ROOT"] . $gbrt;
$size = @getimagesize($full_path);
if($size !== false){
// $gambar = $gbrt;
$gambar = $host.'/img-small/'.$gbrt;
}else{
$gambar = $host.'/images/no_photo.jpg';
}
?>
                                            <li>
                                                <span><a href="<?=$judul_seo;?>"><img src="<?=$gambar;?>" height="50" alt="" /></a></span>
                                                <a href="<?=$judul_seo;?>"><?=$row['nama_produk'];?></a>
												<i><?=$katprod;?></i>
                                            </li>
<?php } ?>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="Recent">
                                        <ul class="recent_tab_list">
<?php
$sqlre = $db->query("SELECT 
  produk.nama_produk,
  produk.produk_seo,
  produk.id_produk,
  produk.keterangan,
  produk.photo2,
  jenis_produk.produk,
  jenis_produk.seo_produk
FROM
  jenis_produk
  INNER JOIN produk ON (jenis_produk.id_jenis_produk = produk.kategori_produk) where produk.pub='Y' order by id_produk DESC limit 5");
while($rowr=$sqlre->fetch_array()){
$katprod = $rowr['seo_produk'];
$judul_seo = '/produk/'.$katprod.'/'.$rowr['produk_seo'];
$exp =  explode('#', $rowr['photo2']);
$gbrt = $exp[0];
$full_path = $_SERVER["DOCUMENT_ROOT"] . $gbrt;
$size = @getimagesize($full_path);
if($size !== false){
$gambar = $gbrt;
}else{
$gambar = BASE_URL.'images/no_photo.jpg';
}
?>
                                            <li>
                                                <span><a href="<?=$judul_seo;?>"><img src="<?=$gambar;?>" height="50" alt="" /></a></span>
                                                <a href="<?=$judul_seo;?>"><?=$rowr['nama_produk'];?></a>
                                                <i><?=$katprod;?></i>
                                            </li>
<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

							<div class="widget widget_tags">
								<div class="widget_title">
									<h4><span>Tags</span></h4>
								</div>
								<ul class="tags">
<?php
function tags2(){
global $db;
$res = $db->query("SELECT tag FROM `posting`");
$TampungData = array();
while($data_tags=$res->fetch_array()){
$tags = explode(',',strtolower(trim($data_tags['tag'])));
if(empty($data_tags['tag'])){echo'';}else{
foreach($tags as $val) {
$TampungData[] = $val;
}}}
$totalTags = count($TampungData);
$jumlah_tag = array_count_values($TampungData);
ksort($jumlah_tag);
if ($totalTags > 0) {
$output = array();
foreach($jumlah_tag as $key=>$val) {
$output[] = '<li><a href="/tag/'.seo_title($key).'">'.$key.'</a></li>';
}
$tags= implode(' ',$output);
return $tags;
}
}
echo tags2();
?>
								</ul>
							</div>
						</div>
					</div>