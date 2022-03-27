<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" class="no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<title><?=judul($module,$seo,$seo_prod);?></title>
		<meta name="description" content="<?=desc($module,$seo,$seo_prod);?>">
		<meta name="keywords" content="<?=keyword($module,$seo,$seo_prod);?>">
		<link rel="shortcut icon" href="<?=$base;?>/img/favicon.png" type="image/x-icon">
		<meta property="fb:pages" content="139046936162309" />
		<?php echo plugin('komentar',1,$seo,$seo_prod,$module);?>
		<!-- CSS FILES -->
		<link rel="canonical" href="<?=canonical($module,$seo,$seo_prod);?>">
		<link rel="stylesheet" type="text/css" href="<?=$base;?>/css/vendor/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=$base;?>/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?=$base;?>/css/util.css">
		<link rel="stylesheet" type="text/css" href="<?=$base;?>/css/skins/Green.css">
		<link rel="stylesheet" href="<?=$base;?>/css/style-fraction.css" type="text/css" charset="utf-8" />
		<link rel="stylesheet" href="<?=$base;?>/css/fractionslider.css">
		<link rel="stylesheet" href="<?=$base;?>/css/flexslider.css">
		<link rel="stylesheet" href="<?=$base;?>/css/loader.css">
		<link rel="stylesheet" href="<?=$base;?>/css/box-shadows.css">
		
		<link rel="stylesheet" type="text/css" href="<?=$base;?>/css/switcher.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?=$base;?>/css/w3.css" media="screen" />
		<link href="<?=$base;?>/css/search.min.css" rel="stylesheet" type="text/css"/>
		<link rel="image_src" href="<?=gambar($module,$seo,$seo_prod,$host);?>"/>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="<?=$base;?>/js/html5shiv.min.js"></script>
			<script src="<?=$base;?>/js/respond.min.js"></script>
		<![endif]-->
		<script async data-id="238111" src="https://cdn.sayuti.com/script.min.js"></script>
		<script type="text/javascript" src="<?=$base;?>/js/vendor/jquery-1.10.2.min.js"></script>
		
		<script src="<?=$base;?>/js/vendor/bootstrap.js"></script>
		<script type="text/javascript" src="<?=$base;?>/js/jquery.lazy.min.js"></script>
	</head>
	<body>
		<!--Start Header-->
		<header id="header">
			<div id="top-bar">
				<div class="container">
					<div class="row">
						<div class="top-info  col-sm-7 ">
							<span><i class="fa fa-phone"></i> <?=setting('site_phone');?></span>
							<span class="hidden-xs"><i class="fa fa-envelope"></i> <?=setting('site_mail');?></span>
						</div>
						<div class="top-info hidden-xs col-sm-5">
							<ul class="clearfix">
								<li><a href="<?=urlsosmed('TW');?>" target="_blank" class="my-tweet"><i class="fa fa-twitter"></i></a></li>
								<li><a href="<?=urlsosmed('FB');?>" target="_blank" class="my-facebook"><i class="fa fa-facebook"></i></a></li>
								<li><a href="<?=urlsosmed('RSS');?>" target="_blank" class="my-rss"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- Container -->
			
			<div id="nav-bar">
				<div class="container">
					<div class="row">
						<div class="col-sm-2 col-md-2 col-lg-2">
							<div id="logo">
								<h1><a href="https://sayuti.com/"><img src="<?=$base;?>/img/logo.png" alt="sayuti.com" /></a></h1>
							</div>
						</div>
						
						
						<!-- Navigation
						================================================== -->
						<div class="col-lg-10 col-md-10 clearfix">
							<nav id="navigation" class="menu">
								<ul class="navigationx">
									<?php
										if($module==''){
											$class = 'border';
											}else{
											$class = '';
										}
										$main = $db->query("SELECT * FROM menu WHERE parent_id='0'  AND status='0' order by global ASC");
										while($r=$main->fetch_array()){
											echo "<li><a href='".$hostMenu.$r['link']."'>$r[name]</a>";
											$sub = $db->query("SELECT * FROM menu WHERE parent_id='$r[id]' AND status='0' order by global ASC");
											$jml=$sub->num_rows;
											// apabila sub menu ditemukan
											if ($jml > 0){
												echo "<ul>";
												while($w=$sub->fetch_array()){	
													$sub2 = $db->query("SELECT * FROM menu WHERE parent_id='$w[id]' AND status='0' order by global ASC");	
													$jml2=$sub2->num_rows;
													if ($jml2 > 0){
														echo "<li class=''><a href='$w[link]/'>$w[name]</a>";
														echo "<ul>";
														while($x=$sub2->fetch_array()){	
															echo "<li class='has-sub'><a href='$x[link]/' target='$x[parameter]'>$x[name]</a></li>";
														}
														echo"</ul></li>";
													}
													else{
														echo "<li class=''><a href='$w[link]/' target='$w[parameter]'>$w[name]</a>";	
													}
												}           
												echo "</li></ul>
												</li>";
											}
											else{
												echo "</li>";
											}
										} 
										
									?>
									
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- Container / End -->
		</header>
		<!--End Header-->
		
		<!--start wrapper-->
		<section class="wrapper">
			<?php
				if($module=='' || $module=='index.php' || $module=='index.html'){
				?>
				<?php include "slider.php"; ?>
				<!--Start Slider-->
				<div class="slider-wrapper hidden-xs">
					<div class="slider">
						<div class="fs_loader"></div>
						<!--div class="slide">
							<img src="<?=$base;?>/img/fraction-slider/build.png" data-in="fade" data-delay="20" data-out="fade" width="1920" height="450"> 
							<img src="<?=$base;?>/img/fraction-slider/promo.jpg" data-position="-0,0" data-in="bottom" data-delay="500" data-out="fade"  width="1920" height="450">
						</div-->
						<div class="slide">
							<img src="<?=$base;?>/img/fraction-slider/build.png" data-in="fade" data-delay="" data-out="fade" width="1920" height="450">     <!--2- slide background-->
							
							<img src="<?=$base;?>/img/fraction-slider/bingkai_2019.jpeg" width="600" height="600" data-position="8,1240" data-in="bottomLeft" data-delay="500" data-out="fade" style="width:auto; height:auto">
							
							<p class="claim light-pink" data-position="40,230" data-in="top"  data-out="left" data-delay="1800" data-ease-in="easeOutBounce">Bingkai Kaligrafi</p>
							
							<p class="teaser turky small" 	data-position="150,230" data-in="left" data-out="left" data-delay="5500">Hanya Rp. 45rb</p>
							
							<p class="teaser turky small" 	data-position="210,230"  data-in="left" data-out="left" data-delay="6500">Ukuran 30x240cm</p>
							
							<p class="teaser turky small" 	data-position="270,230" data-in="left" data-out="left" data-delay="8000">Desain banyak</p>
							
							<p class="teaser turky small" 	data-position="150,670" data-in="right" data-out="right" data-delay="5500">pay</p>
							
							<p class="teaser turky small" 	data-position="210,670" data-in="right" data-out="right" data-delay="6500">print</p>
							
							<p class="teaser turky small" 	data-position="270,670" data-in="right" data-out="right" data-delay="8000">send order</p>
							
							<a href=""	class="slider-read" data-position="350,230" data-in="bottom" data-out="Right" data-delay="9500">
								Order Now
							</a>
						</div>
						<div class="slide">
							<img src="<?=$base;?>/img/fraction-slider/fraction_2.png" data-in="fade" data-delay="" data-out="fade" width="1920" height="450">     <!--2- slide background-->
							
							<img src="<?=$base;?>/img/fraction-slider/bingkai.jpg" width="600" height="600" data-position="8,1240" data-in="bottomLeft" data-delay="500" data-out="fade" style="width:auto; height:auto">
							
							<p class="claim light-pink" data-position="40,230" data-in="top"  data-out="left" data-delay="1800" data-ease-in="easeOutBounce">just stay, let us design and print for u*</p>
							
							<p class="teaser turky small" 	data-position="150,230" data-in="left" data-out="left" data-delay="5500">call</p>
							
							<p class="teaser turky small" 	data-position="210,230"  data-in="left" data-out="left" data-delay="6500">send concept</p>
							
							<p class="teaser turky small" 	data-position="270,230" data-in="left" data-out="left" data-delay="8000">design</p>
							
							<p class="teaser turky small" 	data-position="150,670" data-in="right" data-out="right" data-delay="5500">bayar</p>
							
							<p class="teaser turky small" 	data-position="210,670" data-in="right" data-out="right" data-delay="6500">cetak</p>
							
							<p class="teaser turky small" 	data-position="270,670" data-in="right" data-out="right" data-delay="8000">kirim</p>
							
							<a href="https://www.sayuti.com/produk/bingkai/"	class="slider-read" data-position="350,230" data-in="bottom" data-out="Right" data-delay="9500">
								Order Now
							</a>
						</div>
						<div class="slide">
							<img src="<?=$base;?>/img/fraction-slider/build.png" data-in="fade" width="100%" height="450"/>	<!--3- slide background-->
							
							<p class="claim light-pink" data-position="30,250" data-in="top" data-out="top" data-ease-in="easeOutBounce" data-delay="1500">Kami Siap Antar</p>
							
							<p class="claim  theme-colored" data-position="110,250" data-in="left" data-out="Right" data-delay="2500">Wilayah Kota Serang</p>
							
							<img  src="<?=$base;?>/img/fraction-slider/gadgets/antar.png" width="456" height="272" data-position="103,1180" data-in="left" data-out="bottom" data-delay="400">
							
							<div class="para-2"	data-position="200,250" data-in="left" data-out="right" data-delay="3000">
								Pengiriman GRATIS untuk wilayah kota serang (order minimal 250rb)
							</div>
							
							<a href=""	class="slider-read" data-position="360,250" data-in="bottom"  data-out="Right" data-delay="3500">
								Pesan Sekarang
							</a>
						</div>
						<div class="slide">
							<img src="<?=$base;?>/img/fraction-slider/bingkai.jpg" data-in="fade" data-delay="20" data-out="fade" width="100%" height="450">         <!--4- slide background-->
							
							<p class="claim light-pink" data-position="50,1020" data-in="top"  data-out="top" data-ease-in="jswing">Bingkai Motivasi</p>
							
							<p class="teaser turky" data-position="120,1180" data-in="left" data-delay="1500">Banyak pilihan</p>
							
							<p class="teaser turky" data-position="170,1180" data-in="left"  data-delay="3000">Hanya Rp. 50.000/pcs</p>
							
							<p class="teaser turky" data-position="220,1180" data-in="left"  data-delay="4500" data-out="none">Harga member Rp. 30.000/pcs</p>
							
							<p class="teaser turky" data-position="270,1180" data-in="left" data-delay="5500" data-out="none">Minimal order 1 pcs</p>
							
							<img src="<?=$base;?>/img/fraction-slider/bingkai.jpg" width="480" height="480" data-position="-20,250" data-in="right" data-delay="500" data-out="fade" style="width:auto; height:auto">
						</div>
					</div>
				</div>
				<!--End Slider-->
				
				<section class="info_service hidden-xs">
					<div class="container">
						<div class="row sub_content">
							<?php
								$sqli = $db->query("select * from info_service");
								$no=1;
								while($row=$sqli->fetch_array()){
									$id = $row['id'];
									$icon = '<i class="fa '.$row['icon'].'"></i>';
									$h3 = $row['judul'];
									$par = $row['sub_judul'];
									$modal = $row['modul'];
									$var4 = $row['class'];
								?>
								<div class="col-sm-4 col-md-4 col-lg-4">
									<div class="serviceBox_3">
										<?=$icon;?>
										<h3><?=$no;?>. <?=$h3;?></h3>
										<p><?=$par;?></p>
										<a class="open-Dialog detail/call" href="#" data-modName="<?=$modal;?>" data-id="<?=$id;?>" data-toggle="modal" data-target="#callModal"  <?=$var4;?> data-keyboard="false">Detail</a>
									</div>
								</div>
							<?php $no++;} ?>
							
						</div>
					</div>
				</section>
				
				<!--Start recent work-->
				<section class="latest_work">
					<div class="container">
						<div class="row sub_content">
							<div class="carousel-intro">
								<div class="col-md-12">
									<div class="dividerHeading">
										<h4><span>Produk Kami</span></h4>
									</div>
									<div class="carousel-navi">
										<div id="work-prev" class="arrow-left jcarousel-prev"><i class="fa fa-angle-left"></i></div>
										<div id="work-next" class="arrow-right jcarousel-next"><i class="fa fa-angle-right"></i></div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							
							<div class="jcarousel recent-work-jc">
								<ul class="jcarousel-list">
									<!-- Recent Work Item -->
									
									<?php
										$sqlp = $db->query("SELECT 
										`jenis_produk`.`seo_produk`,
										`produk`.`nama_produk`,
										`produk`.`produk_seo`,
										`produk`.`photo`
										FROM
										`jenis_produk`
										INNER JOIN `produk` ON (`jenis_produk`.`id_jenis_produk` = `produk`.`kategori_produk`) where produk.pub='Y' AND produk.featured='Y' order by urutan ASC");
										while($data=$sqlp->fetch_array()){
										?>
										<li class="col-sm-3 col-md-3 col-lg-3 ">
											<div class="recent-item ">
												<figure>
													<div class="touching medium ">
														<img src="<?=$data['photo'];?>" alt="" />
														<div class="hovers">
															<a href="<?=$data['photo'];?>" class="hover-zoom mfp-image" ><i class="fa fa-search"></i></a>
															<a href="/produk/<?=$data['seo_produk'];?>/<?=$data['produk_seo'];?>" class="hover-link"><i class="fa fa-link"></i></a>
														</div>
													</div>
												</figure>
											</div>
										</li>
									<?php } ?>
									<!-- Recent Work Item -->
									
								</ul>
							</div>
							<div class="clearfix"></div>
							<div class="carousel-intro">
								<div class="col-md-12">
									<div class="dividerHeading">
										<a href="https://sayuti.com/produk"><h4><span>Semua Produk</span></h4></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!--Start recent work-->
				
				<section class="fetaure_bottom">
					<div class="container">
						<div class="row sub_content">
							<div class="col-lg-8 col-md-8 col-sm-8">
								<div class="dividerHeading">
									<h4><span>Informasi</span></h4>
								</div>
								<div class="row">
									<?php
										$sqlp = $db->query("select * from posting where publish='Y' order by tanggal desc limit 2");
										while($row=$sqlp->fetch_array()){
											$judul = $row['judul'];
											$judul_seo = 'category/'.$row['judul_seo'];
											$tanggal = $row['tanggal'];
											$admin = $row['alias'];
											$isi = remove_tags($row['postingan']);
											$isi = kata($isi,90);
											$thnt = folderthn($row['folder']);
											$blnt = folderbln($row['folder']);
											$gbrt = $row['gambar'];
											$gambar = $host.'/images/post/'.$thnt.'/'.$blnt.'/630x320_'.$gbrt;
										?>
										<div class="col-lg-6 col-md-6 col-sm-6 rec_blog">
											<div class="blogteam_pic ">
												<img alt="" src="<?=$gambar;?>" />
												<div class="blog-hover">
													<a href="<?=$judul_seo;?>">
														<span class="icon">
															<i class="fa fa-link"></i>
														</span>
													</a>
												</div>
											</div>
											<div class="blogDetail">
												<div class="blogTitle">
													<a href="<?=$judul_seo;?>">
														<h2><?=$judul;?></h2>
													</a>
													<span>
														<i class="fa fa-calendar"></i>
														<?=$tanggal;?>
													</span>
												</div>
												<div class="blogContent">
													<p><?=$isi;?></p>
												</div>
												<div class="blogMeta">
													<a href="#">
														<i class="fa fa-user"></i>
														<?=$admin;?>
													</a>
													<!--a href="#">
														<i class="fa fa-comment"></i>
														1980
													</a-->
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
							
							<!-- TESTIMONIALS -->
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="dividerHeading">
									<h4><span>Mengapa Memilih Kami?</span></h4>
								</div>
								<p>Kami memiliki beberapa keunggulan.</p>
								<ul class="list_style circle">
									<li><a href="#"><i class="fa fa-check"></i> Berada di pusat Kota Serang</a></li>
									<li><a href="#"><i class="fa fa-check"></i> Desain bisa ditunggu *</a></li>
									<li><a href="#"><i class="fa fa-check"></i> Desain & Acc bisa via WA</a></li>
									<li><a href="#"><i class="fa fa-check"></i> Kualitas diutamakan</a></li>
									<li><a href="#"><i class="fa fa-check"></i> Buka pukul 08.00-22.00 WIB</a></li>
									<li><a href="#"><i class="fa fa-check"></i> Hari Libur Tetap Buka</a></li>
								</ul>
							</div><!-- TESTIMONIALS END -->
						</div>
					</div>
				</section>
				<!--Start recent work-->
				<section class="latest_work">
					<div class="container">
						<div class="row sub_content" style="background:#1ABC9C!important;">
							<div class="carousel-intro">
								<div class="col-md-12">
									<div class="dividerHeading">
										
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="jcarousel"></div>
							<div id="flexslider3" class="flexslider carousel">
								<ul class="slides">
									<?php
										$sqlb = $db->query("SELECT * FROM `produk` where kategori_produk='231' AND pub='Y' ORDER BY `id_produk` DESC ");
										while($rowb = $sqlb->fetch_array()){
											$arrays =  explode('#', $rowb['photo2']);
											// $gambarb= 'img-300'.$arrays[0];
											$gambarb = $host.'/resize/360x184'.$arrays[0];
											echo "<li class='col-sm-2 col-md-2 col-lg-2 bShadow-15' >
											<a href='produk/bingkai/$rowb[produk_seo]'><img src='".$gambarb."' alt=''/></a>
											<p class='flex-caption' style='text-align:center;color:#fff'>".$rowb['nama_produk']."</p>
											</li>";
										}
									?>  
								</ul>
							</div>
						</div>
					</div>
				</section>
				<!--Start recent work-->
				<!--Start recent work-->
				<section class="latest_work">
					<div class="container">
						<div class="row sub_content">
							<div class="carousel-intro">
								<div class="col-md-12">
									<div class="dividerHeading">
										<h4><span><a href="produk/bingkai">Bingkai Motivasi</a></span></h4>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							
							<div class="jcarousel"></div>
							<div id="flexslider1" class="flexslider carousel">
								<ul class="slides">
									<?php
										$sqlb = $db->query("SELECT * FROM `produk` where kategori_produk='7' AND pub='Y' ORDER BY `id_produk` DESC ");
										while($rowb = $sqlb->fetch_array()){
											$arrays =  explode('#', $rowb['photo2']);
											// $gambarb= 'img-300'.$arrays[0];
											$gambarb = $host.'/resize/360x184'.$arrays[0];
											echo "<li class='col-sm-2 col-md-2 col-lg-2 bShadow-15' ><a href='produk/bingkai/$rowb[produk_seo]'><img src='".$gambarb."' alt=''/></a></li>";
										}
									?>  
								</ul>
							</div>
						</div>
					</div>
				</section>
				<!--Start recent work-->
				<section class="latest_work">
					<div class="container">
						<div class="row sub_content">
							<div class="carousel-intro">
								<div class="col-md-12">
									<div class="dividerHeading">
										<h4><span><a href="klien">Klien kami</a></span></h4>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							
							<div class="jcarousel"></div>
							<div id="flexslider2" class="flexslider carousel">
								<ul class="slides">
									<?php
										$sqlp = $db->query("select * from testimoni where pub='Y' order by id DESC");
										while($rowp = $sqlp->fetch_array()){
											$arrays =  explode('#', $rowp['photo']);
											$gambar= $arrays[0];
											echo "<li class='col-sm-2 col-md-2 col-lg-2 bShadow-15' ><img src='".$gambar."' alt=''/></li>";
										}
									?>  
								</ul>
							</div>
						</div>
					</div>
				</section>
				<!--Start recent work-->
				<?php 
					}elseif($module=='undangan1K' OR $module=='undangan1k'){
					echo '<meta http-equiv="refresh" content="0; URL=https://undangan1k.sayuti.com" />';
					}elseif($module=='profile'){
					include "profile.php";
					}elseif($module=='page'){
					if($seo){
						include "tentang-kami.php";
						}else{
						include "404-page.php";
					}
					}elseif($module=='kontak'){
					include "kontak.php";
					}elseif($module=='klien'){
					if($seo){
						include "klien-detail.php";
						}else{
						include "klien.php";
					}
					}elseif($module=='produk'){
					if($seo AND $seo_prod){
						include "detail-produk.php";
						}else{
						include "jenis.php";
					}
					}elseif($module=='reseller'){
					if(empty($_SESSION['e_token'])){
						include "reseller.php";
						}else{
						redirect('/member');
					}
					}elseif($module=='aktivasi'){
					include "aktivasi.php";
					}elseif($module=='login'){
					if(empty($_SESSION['e_token'])){
						include "login.php";
						}else{
						redirect('/member');
					}
					}elseif($module=='member'){
					if(!empty($_SESSION['e_token'])){
						$member = $db->query("select * from tb_resell where token='$_SESSION[e_token]'");
						$data = $member->fetch_array();
						include "member.php";
						}else{
						echo "anda belum login";
					}
					}elseif($module=='logout'){
					unset($_SESSION['e_resell']);
					unset($_SESSION['e_token']);
					redirect('https://www.sayuti.com');
					}elseif($module=='category' AND !$seo){
					include "category.php";
					}elseif($module=='category' AND $seo=='pageno'){
					if (filter_var($pagenum, FILTER_VALIDATE_INT)) {
						include "category-num.php";
						} else {
						include "category.php";
					}
					}elseif($module=='category' AND $seo){
					$sql = $db->query("select * from cat where kategori_seo='$seo' AND pub='Y'");
					if($sql->num_rows > 0){
						include "category-detail.php";
						}else{
						include "detail-info.php";
					}
					}elseif($module=='tag'){
					if($seo){
						include "tag.php";
						}else{
						echo 3;
					}
					}elseif($module=='page'){
					include "page-detail.php";
					}elseif($module=='cari'){
					$sql = $db->query("SELECT * FROM `plugin` WHERE id='2' AND pub='0'");
					if($sql->num_rows >0){
						include __DIR__ . '/pencarian.php';
						}else{
						include __DIR__ . '/pencarian-berita.php';
					}
					}elseif($module=='download-file'){
				?>
				
				<script type="text/javascript">
					$(window).load(function(){
						countDown();
						$(".lds-ellipsis").css("display", "none");
					});
					
					var counter = 10;
					function countDown() {
						if(counter>=0) {
							document.getElementById("timer").innerHTML = counter;
						}
						else {
							download();
							$('.timerhide').hide();
							return;
						}
						counter -= 1;
						
						var counter2 = setTimeout("countDown()",1000);
						return;
					}
					function download() {
						
						document.getElementById("link").innerHTML = '<button type="button" id="btn-download" class="btn btn-default" onclick=newDoc("<?=$down;?>")><i id="icon-d" class="fa fa-download"></i> Download</button>';
					}
					function newDoc(id) {
						$.ajax({
							url: '/addon/ajaxfile.php',
							data: 'f='+id,
							type: 'POST',
							success: function(res){
								var link = JSON.parse(res);
								window.location.assign("/addon/unduh.php?f="+link);
								$("#icon-d").removeClass("fa-download").addClass("fa-circle");
								$('#btn-download').html('Terima Kasih');
								$('#btn-download').prop('disabled',true);
								$("#btn-download").removeClass("btn-default").addClass("btn-success");
							}
						});
					}
				</script>
				<section class="promo_box">
					<div class="container">
						
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="promo_content pdt-100 pdb-100">
								<div class="pb_text">
									<h3>Download Logo Sayuti.Com</h3>
									<p>Link Download logo akan tampil dalam.</p>
								</div>
								<div class="pb_action">
									<span class="timerhide">
										<h2><span id="timer"></span> detik.</h2>
									</span>
									<span id="link"></span>
								</div>
							</div>
						</div>
					</div>
					
				</section>
				<?php
					}else{
					include "404-page.php";
				} ?>
		</section>
		<!--end wrapper-->
		<?php if($module=='' || $module=='index.php' || $module=='index.html'){ ?>
			<script>
				$(document).ready(function() {
					$(".blogTitle h2").dotdotdot({
						height: 55,
						fallbackToLetter: true,
						watch: true,
					});
				});
			</script>
			<section class="promo_box">
				<div class="container">
					<div class="row">
						<div class="col-sm-4 col-md-4 col-lg-4">
							<?php echo plugin('cse',1);?>
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4">
							<div class="promo_content no-padd">
								<h3>Logo sayuti.com.</h3>
								<p>download gratis logo baru sayuti.com. </p>
							</div>
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4">
							<?php
								$extension='';
								$files_array = array();
								$directory = "upload/files/";
								$dir_handle = @opendir($directory) or die("There is an error with your file directory!");
								while ($file = readdir($dir_handle))
								{
									/* Skipping the system files: */
									if($file{0}=='.') continue;
									
									/* end() returns the last element of the array generated by the explode() function: */
									$extension = strtolower(end(explode('.',$file)));
									
									/* Skipping the php files: */
									if($extension == 'php') continue;
									
									$files_array[]=$file;
								}
								/* Sorting the files alphabetically */
								sort($files_array,SORT_STRING);
								
								$file_downloads=array();
								
								$result = $db->query("SELECT * FROM download_manager");
								
								if($result->num_rows)
								while($row=$result->fetch_assoc())
								{
									$file_downloads[$row['filename']]=$row['downloads'];
								}
								// $filess = glob("upload/files/*.cdr");
								foreach($files_array as $key=>$val){
									echo '<a class="btn btn-lg btn-default" href="download-file/'.urlencode($val).'">
									<i class="fa fa-download"></i>Download Now (<span class="download-count" title="Times Downloaded">'.(int)$file_downloads[$val].'</span>)</a>';
								?>
							<?php } ?>  
							
						</div>
					</div>
				</div>
			</section>
			<?php }else{ ?>  
			<!--div id="skinad" class="hidden-xs">
				<div id="teaser2" style="background:#ccc;width:120px; height:autopx; text-align:left; display:scroll;position:fixed; bottom:0;left:0px;z-index:9999">
				<img src="https://www.sayuti.com/images/banner_side.jpg" alt="" />
				</div>
				<div id="teaser3" style="width:120px; height:autopx; text-align:right; display:scroll;position:fixed; bottom:0;right:0px;z-index:9999">
				<img src="https://www.sayuti.com/images/banner_side.jpg" alt="" />
				</div>
			</div-->
		<?php } ?>  
		
		<!--start footer-->
		<footer class="footer">
			<div class="container">
				<div class="row">
					<?=alamat('SR');?>
					<?=alamat('PDG');?>
					<?=alamat('LBN');?>
					<?=alamat('BDG');?>
					<!--div class="col-sm-6 col-md-3 col-lg-3">
						<div class="widget_title">
                        <h4><span>Flickr Gallery</span></h4>
						
						</div>
						<div class="widget_content">
						<div class="flickr">
						<ul id="flickrFeed" class="flickr-feed"></ul>
						</div>
						</div>
					</div-->
				</div>
			</div>
		</footer>
		<!--end footer-->
		
		<section class="footer_bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<p class="copyright">&copy; Copyright 2019 <a href="http://sayuti.com/">sayuti.com</a></p>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="footer_social">
							<ul class="footbot_social">
								<li><a class="fb" href="<?=urlsosmed('FB');?>" data-placement="top" data-toggle="tooltip" title="Facbook"><i class="fa fa-facebook"></i></a></li>
								<li><a class="twtr" href="<?=urlsosmed('TW');?>" data-placement="top" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
								<li><a class="rss" href="<?=urlsosmed('RSS');?>" data-placement="top" data-toggle="tooltip" title="RSS"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="callModal" role="dialog" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content"><div class="fetched-data"></div></div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		
		<script src="<?=$base;?>/js/jquery.easing.1.3.js"></script>
		<script src="<?=$base;?>/js/retina-1.1.0.min.js"></script>
		<script src="<?=$base;?>/js/jquery.fractionslider.js" type="text/javascript" charset="utf-8"></script>
		
		<script src="<?=$base;?>/js/jquery.superfish.js"></script>
		<script src="<?=$base;?>/js/jquery.meanmenu.js"></script>
		
		<script type="text/javascript" src="<?=$base;?>/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="<?=$base;?>/js/jquery.jcarousel.js"></script>
		<script type="text/javascript" src="<?=$base;?>/js/jflickrfeed.js"></script>
		<script type="text/javascript" src="<?=$base;?>/js/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="<?=$base;?>/js/jquery.isotope.min.js"></script>
		<script type="text/javascript" src="<?=$base;?>/js/swipe.js"></script>
		<script type="text/javascript" src="<?=$base;?>/js/jquery.dotdotdot.js"></script>
		<div id='onotif' data-notif='936264'></div>
		<script type="text/javascript" src="https://cdn.sayuti.com/js/script.notifadm.js"></script>
		<script src="<?=$base;?>/js/main.js"></script>
		<!-- google CSE -->
		<?php echo plugin('csep',$base,$host.'cari/');?>
		<?php echo plugin('ana','','','');?>
		<?php echo plugin('komentar',2,'','');?>
		<!-- google CSE -->
		<div id='xnotif' data-notif='891073'></div>
		<!--script type="text/javascript" src="https://widget.my.id/js/script.notif.js"></script-->
		<script type="text/javascript"> /*-- Fraction Slider Parameters --*/
			$(function() {
				$('.lazy').lazy({
					placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7..."
				});
			});
			$(window).load(function(){
				$('.slider').fractionSlider({
					'fullWidth': true,
					'controls': true,
					'responsive': true,
					'dimensions': "1920,450",
					'increase': true,
					'pauseOnHover': true,
					'slideEndAnimation': 	true,
					'autoChange': true
				});
				$('#flexslider1').flexslider({
					animation: "slide",
					animationLoop: false,
					controlNav: true,
					itemWidth: 265,
					itemMargin:5,
					prevText:"",
					nextText:""
				});
				$('#flexslider2').flexslider({
					animation: "slide",
					animationLoop: false,
					controlNav: false,
					itemWidth: 220,
					itemMargin: 5
					
				});
				$('#flexslider3').flexslider({
					animation: "slide",
					animationLoop: false,
					controlNav: true,
					itemWidth: 260,
					itemMargin: 5,
					prevText:"",
					nextText:""
				});
			});
			$('#testimonial-carousel').carousel({
				interval: 3000,
				cycle: true
			}); 
			function validateNumber(event) {
				var key = window.event ? event.keyCode : event.which;
				if (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 37 || event.keyCode === 39) {
					return true;
					} else if (key < 48 || key > 57) {
					return false;
				} else return true;
			};
			function formatMoney(number, places, symbol, thousand, decimal) {
				number = number || 0;
				places = !isNaN(places = Math.abs(places)) ? places : 0;
				symbol = symbol !== undefined ? symbol : "";
				thousand = thousand || ".";
				decimal = decimal || ",";
				var negative = number < 0 ? "-" : "",
				i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
				j = (j = i.length) > 3 ? j % 3 : 0;
				return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
			}
			
			function retnum(str) {
				var num = str.replace(/[^0-9]|/ / g, '');
				return num;
			}
			
			function angka(number) {
				var str = number;
				var re = str.replace("Rp.", "");
				var res = replaceAll(".", "", re);
				return res;
			}
			
			function replaceAll(find, replace, str) {
				while (str.indexOf(find) > -1) {
					str = str.replace(find, replace);
				}
				return str;
			}
		</script>
		
		<?php
			if($module=='' || $module=='index.php' || $module=='index.html'){
			?>
			<script>
				$(document).on("click", ".open-Dialog", function () {
					var modul = $(this).data('id');
					var modname  = $(this).data('modname');
					$('#callModal').modal('show');
					$.ajax({
						type : 'POST',
						url : '/addon/token.php', //Here you will fetch records 
						data :  'modul='+ modul, //Pass $id
						success : function(data){
							if(modname){
								$('.fetched-data').html(data);//Show fetched data from database
							}
						}
					});
				});
				$('body').on('hidden.bs.modal', '.modal', function () {
					$(this).removeData('bs.modal');
				});
			</script>
			<?php }else{ ?>
			
		<?php } ?>
		
		<script type="text/javascript">
			$(document).ready(function(){
				var str=location.href.toLowerCase();
				$('#navigation a').each(function() {
					if (str.indexOf(this.href.toLowerCase()) > -1) {
						$("#navigation a").removeClass("border");
                        $(this).addClass("border"); 
					}
				}); 
				
			});
		</script>
		<style>
			.arrow{margin:0 0 20px  0}
			nav#menu-container {
			background:#19937D;
			position:relative;
			width:100%;
			height: 54px;
			}
			#btn-nav-previous {
			text-align: center;
			color: white;
			cursor: pointer;
			font-size: 24px;
			position: absolute;
			left: 0px;
			background: #1ABC9C;
			fill:#FFF;
			padding: 10px 12px 0 12px;
			line-height:40px;
			}
			#btn-nav-next {
			text-align: center;
			color: white;
			cursor: pointer;
			font-size: 24px;
			position: absolute;
			right: 0px;
			background: #1ABC9C;
			fill:#FFF;
			padding: 10px 12px 0 12px;
			line-height:40px;
			}
			.menu-inner-box
			{ 
			width: 100%;
			white-space: nowrap;
			margin: 0 auto;
			overflow: hidden;
			padding: 0px 54px;
			box-sizing: border-box;
			}
			.menus
			{  
			padding:0;
			margin: 0;
			list-style-type: none;
			display:block;
			text-align: center;
			}
			.menu-item
			{
			height:100%;
			padding: 0px 20px;
			color:#fff;
			display:inline;
			margin:0 auto;
			line-height:53px;
			text-decoration:none;
			text-align:center;
			white-space:no-wrap;
			}
			.menu-item:hover {
			text-decoration:underline;
			}
			
			@media only screen and (max-width: 480px) {
			#btn-nav-previous {
			display:none;
			}
			#btn-nav-next {
			display:none;
			}
			.menu-inner-box
			{ 
			width:100%;
			overflow-x:auto;
			}
			}
			
		</style>
		<script>
			$('#btn-nav-previous').click(function(){
				$(".menu-inner-box").animate({scrollLeft: "-=100px"});
			});
			
			$('#btn-nav-next').click(function(){
				$(".menu-inner-box").animate({scrollLeft: "+=100px"});
			});
			
		</script>	
	</body>
</html>