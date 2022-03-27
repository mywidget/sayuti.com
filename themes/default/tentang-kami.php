<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$sql = $db->query("select * from page where judul_seo='$seo'");
if($sql->num_rows > 0){
$rowp = $sql->fetch_array();
$judul = $rowp['judul'];
$isi = $rowp['isi'];
?>
	<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2><?=$judul;?></h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li><?=ucfirst($judul);?></li>
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
						<div class="blog_single">
							<article class="post">
								<figure class="post_img">
									<!-- Post Image Slider -->
									<div id="slider" class="swipe">
										<ul class="swipe-wrap">
										
<?php
if($rowp['photo']!=''){
$arrays =  explode('#', $rowp['photo']);
$filteredarray = array_values( array_filter($arrays) );
$gabung = array_merge($filteredarray);
foreach ($gabung as $value) {
			echo '<li><img class="lazy" data-src="'.$value.'" /></li>';
}
}else{
			echo '<li><img class="lazy" data-src="'.$base.'/img/blog/blog_1.png" alt="Tidak ada produk"></li>';
			echo '<li><img class="lazy" data-src="'.$base.'/img/blog/blog_2.png" alt="Tidak ada produk"></li>';
			echo '<li><img class="lazy" data-src="'.$base.'/img/blog/blog_3.png" alt="Tidak ada produk"></li>';
}
?>
										</ul>
										<div class="swipe-navi">
										  <div class="swipe-left" onclick="mySwipe.prev()"><i class="fa fa-chevron-left"></i></div> 
										  <div class="swipe-right" onclick="mySwipe.next()"><i class="fa fa-chevron-right"></i></div>
										</div>
									</div>
								</figure>
								<div class="post_date">
									<span class="day">28</span>
									<span class="month">Nov</span>
								</div>
								<div class="post_content">
									<div class="post_meta">
										<h2>
											<a href="#"><?=$judul;?></a>
										</h2>
										<div class="metaInfo">
											<span><i class="fa fa-user"></i> By <a href="#">Administrator</a> </span>
											<span><i class="fa fa-tag"></i><a href="#"><?=ucfirst($judul);?></a> </span>
										</div>
									</div>
									<?=$isi;?>
								</div>
							</article>
						</div>
				</div>
					
					
					<!--Sidebar Widget-->
<?php include "widget.php";?>
				</div><!--/.row-->
			</div> <!--/.container-->
		</section>
<?php }else{
include "404-page.php";
	
}
?>