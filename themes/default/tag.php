<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Tags <?=ucfirst($seo);?></h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li><?=ucfirst($act);?></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		
		<section class="content blog">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="blog_medium">
<?php
$tag = pisah_kata($seo);
$sqlp = $db->query("SELECT 
  posting.judul,
  posting.judul_seo,
  posting.postingan,
  posting.alias,
  cat.nama_kategori,
  cat.kategori_seo,
  posting.tanggal,
  posting.folder,
  posting.gambar,
  posting.id_cat
FROM
  cat
  INNER JOIN posting ON (cat.id_cat = posting.id_cat) 
  where FIND_IN_SET('$tag', CONCAT(tag, ','))
  order by tanggal desc limit 5");
if($sqlp->num_rows > 0){
while($row=$sqlp->fetch_array()){
$judul = $row['judul'];
$kategori = $row['nama_kategori'];
$kategori_seo = $module.'/'.$row['kategori_seo'];
$judul_seo = '/category/'.$row['judul_seo'];
$tanggal = datetimes($row['tanggal']);
$tgl = foldertgl($row['tanggal']);
$bln = bulan($row['tanggal']);
$admin = $row['alias'];
$isi = kata($row['postingan'],150);
$thnt = folderthn($row['folder']);
$blnt = folderbln($row['folder']);
$gbrt = $row['gambar'];
$gambar = $host.'/images/post/'.$thnt.'/'.$blnt.'/200x200_'.$gbrt;
?>
							<article class="post">
								<div class="post_date">
									<span class="day"><?=$tgl;?></span>
									<span class="month"><?=$bln;?></span>
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
											<span><i class="fa fa-user"></i> By <a href="#"><?=$admin;?></a> </span>
											<span><i class="fa fa-tag"></i> <a href="<?=$kategori_seo;?>"><?=$kategori;?></a></span>
										</div>
									</div>
									<p><?=$isi;?></p>
									<a class="btn btn-small btn-default" href="<?=$judul_seo;?>">Read More</a>
								</div>
							</article>
<?php } 
}else{ 
echo '<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Belum ada data</h2>
					</div>
				</div>
			</div>
		</section>'; 

} ?>
						</div>
						<!--div class="col-lg-12 col-md-12 col-sm-12">
							<ul class="pagination pull-left mrgt-0">
								<li><a href="#">&laquo;</a></li>
								<li class="active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#">&raquo;</a></li>
							</ul>
						</div-->
					</div>
					<!--Sidebar Widget-->
<?php include "widget.php";?>
				</div><!--/.row-->
			</div> <!--/.container-->
		</section>