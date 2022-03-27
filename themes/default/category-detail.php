<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');

$rows=$sql->fetch_array();
$idcat = $rows['id_cat'];
$judul_cat = $rows['nama_kategori'];
?>
<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2><?=$judul_cat;?></h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li><a href="/<?=$module;?>"><?=ucfirst($act);?></a></li>
								<li><?=$judul_cat;?></li>
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
$sqlp = $db->query("select * from posting where id_cat='$idcat' AND publish='Y' order by tanggal desc limit 5");
if($sqlp->num_rows > 0){
while($row=$sqlp->fetch_array()){
$idberita = $row['id_post'];
$judul = $row['judul'];
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
											<span><?php echo tags3($idberita) ;?></span>
										</div>
									</div>
									<p><?=$isi;?></p>
									<a class="btn btn-small btn-default" href="<?=$judul_seo;?>">Read More</a>
								</div>
							</article>
<?php } }else{ 
echo '		<section class="page_head">
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