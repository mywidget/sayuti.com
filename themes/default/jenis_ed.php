<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
if($seo){
$judulA = 'Jenis '. $seo;
$judulB = '<li><a href="/produk">Produk</a></li>';
$judulB .= '<li>'.ucfirst($seo).'</li>';
}else{
$judulA = 'Semua '. $act;
$judulB = '<li>'.ucfirst($act).'</li>';
}
?>
<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2><?=ucfirst($judulA);?></h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<?=$judulB;?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
</section>
		
<?php
$sqlcat = $db->query("select * from jenis_produk where seo_produk='$seo' AND pub='Y'");
if($sqlcat->num_rows > 0){
$rowcat = $sqlcat->fetch_array();
if (filter_var($pageprod, FILTER_VALIDATE_INT)) {
	$pageno = clean($pageprod);
} else {
	$pageno = 1;
}

// echo $pageno;
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page; 

$total_pages_sql = "SELECT COUNT(*) FROM produk where pub='Y' AND kategori_produk ='$rowcat[id_jenis_produk]'";
$result = $db->query($total_pages_sql);
$total_rows = $result->fetch_array()[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sqlp = $db->query("SELECT 
  produk.nama_produk,
  produk.produk_seo,
  produk.id_produk,
  produk.keterangan,
  produk.photo2
FROM
  produk
WHERE pub='Y' and 
  produk.kategori_produk ='$rowcat[id_jenis_produk]' order by id_produk desc limit $offset, $no_of_records_per_page");
?>
		<section class="content blog">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="blog_medium">
<?php
$no =1 ;
$no = $offset + 1;

while($row=$sqlp->fetch_array()){
$judul = $row['nama_produk'];
$kategori = $rowcat['produk'];
$kategori_seo = '/'.$module.'/'.$rowcat['seo_produk'];
$judul_seo = '/produk/'.$seo.'/'.$row['produk_seo'];
$isi = kata($row['keterangan'],150);
if($row['photo2']!=''){
$arrays =  explode('#', $row['photo2']);
$filteredarray = array_values( array_filter($arrays) );
$exp = array_merge($filteredarray);
$gambar = $exp[0];
}else{
$gambar = $host.'images/no_photo.jpg';
}
?>
							<article class="post">
								<div class="post_date">
									<span class="day">0<?=$no;?></span>
									<span class="month">-</span>
								</div>
								<figure class="post_img">
									<a href="<?=$judul_seo;?>">
										<img src="<?=$gambar;?>" alt="blog post">
									</a>
								</figure>
								<div class="post_content">
									<div class="post_meta">
										<h2>
											<a href="<?=$judul_seo;?>"><?=$judul;?></a>
										</h2>
										<div class="metaInfo">
											<span><i class="fa fa-user"></i> By <a href="#">Administrator</a> </span>
										</div>
									</div>
									<?=$isi;?>
									<br/>
									<br/>
									<a class="btn btn-small btn-default btn-xs" href="<?=$judul_seo;?>">Detail produk</a>
								</div>
							</article>
<?php $no++; } ?>
						</div>
<?php if($total_rows >=5){ ?>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<ul class="pagination pull-left mrgt-0">
<li><a href="/produk/<?=$seo;?>/pageno/1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "/produk/$seo/pageno/".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "/produk/$seo/pageno/".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="/produk/<?=$seo;?>/pageno/<?php echo $total_pages; ?>">Last</a></li>

							</ul>
						</div>
<?php } ?>
					</div>
					<!--Sidebar Widget-->
<?php include "widget.php";?>
				</div><!--/.row-->
			</div> <!--/.container-->
		</section>
<?php 
}else{
include "produk.php";
} 
?>