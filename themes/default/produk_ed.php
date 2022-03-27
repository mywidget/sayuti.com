<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
if (isset($pagenum)) {
    $pageno = clean($pagenum);
} else {
    $pageno = 1;
}

$pageno = !empty($pagenums)? $pagenums:1;
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page; 

$total_pages_sql = "SELECT COUNT(*) FROM produk";
$result = $db->query($total_pages_sql);
$total_rows = $result->fetch_array()[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sqlprod = $db->query("SELECT 
  produk.nama_produk,
  produk.produk_seo,
  produk.id_produk,
  produk.keterangan,
  produk.photo2,
  jenis_produk.produk,
  jenis_produk.seo_produk
FROM
  jenis_produk
  INNER JOIN produk ON (jenis_produk.id_jenis_produk = produk.kategori_produk) where  produk.pub='Y' order by id_produk ASC LIMIT $offset, $no_of_records_per_page");
if($sqlprod->num_rows > 0){
?>
		<section class="content blog">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="blog_medium">
<?php
$no = 1;
while($row=$sqlprod->fetch_array()){
$kategori = $row['produk'];
$kategori_seo = '/'.$module.'/'.$row['seo_produk'];
$judul = $row['nama_produk'];
$seo = '/produk/'.$row['produk_seo'];
$isi = kata($row['keterangan'],100);
if($row['photo2']!=''){
$arrays =  explode('#', $row['photo2']);
$filteredarray = array_values( array_filter($arrays) );
$exp = array_merge($filteredarray);
$img = $exp[0];
}else{
$img = $host.'images/no_photo.jpg';
}
?>
							<article class="post">
								<div class="post_date">
									<span class="day">0<?=$no;?></span>
									<span class="month">&nbsp;-&nbsp;</span>
								</div>
								<figure class="post_img">
									<a href="<?=$seo;?>">
										<img src="<?=$img;?>" alt="<?=$judul;?>">
									</a>
								</figure>
								<div class="post_content">
									<div class="post_meta">
										<h2>
											<a href="<?=$seo;?>"><?=$judul;?></a>
										</h2>
										<div class="metaInfo">
											<span><i class="fa fa-user"></i> By <a href="#">Administrator</a> </span>
											<span><i class="fa fa-tag"></i> <a href="<?=$kategori_seo;?>"><?=$kategori;?></a></span>
										</div>
									</div>
									<?=$isi;?>
									<div class="break"></div>
									<a class="btn btn-small btn-default btn-xs" href="<?=$seo;?>">Detail produk</a>
								</div>
							</article>
<?php $no ++; } ?>
							
						</div>
<?php if($total_rows >=5){ ?>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<ul class="pagination pull-left mrgt-0">
<li><a href="/produk/pageno/1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "/produk/pageno/".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "/produk/pageno/".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="/produk/pageno/<?php echo $total_pages; ?>">Last</a></li>

							</ul>
						</div>
<?php } ?>
					</div>
					<!--Sidebar Widget-->
<?php include "widget.php";?>
				</div><!--/.row-->
			</div> <!--/.container-->
		</section>
<?php }else{ ?>
		<section class="content not_found">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="page_404">
							<p>Produk tidak ditemukan</p>
							<button class="btn btn-default btn-lg back_home" onclick="goBack()"><i class="fa fa-arrow-circle-o-left"></i> Go Back</button>
						</div>
					</div>
				</div>
				
			</div>
		</section>
<script>
function goBack() {
    window.history.go(-1);
}
</script>
<?php } ?>