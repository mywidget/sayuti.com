<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$sql = $db->query("select * from testimoni where judul_seo='$seo'");
if($sql->num_rows > 0){
$rowp = $sql->fetch_array();
$ids = $rowp['id'];
$judul = $rowp['judul'];
$isi = $rowp['isi'];
$client  = $rowp['client'];
$company = $rowp['company'];
$tanggal = thn($rowp['tanggal']);
?>
		<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2><?=$judul;?></h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="index.html">Home</a></li>
								<li><a href="/klien">Klien</a></li>
								<li><?=$judul;?></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		
		<section class="content portfolio_single">
			<div class="container">
				<div class="row sub_content">
					<div class="col-lg-8 col-md-8 col-sm-8">
						<!--Project Details Page-->
						<div class="porDetCarousel">
							<div class="carousel-content">
<?php
if($rowp['photo']!=''){
$arrays =  explode('#', $rowp['photo']);
$filteredarray = array_values( array_filter($arrays) );
$gabung = array_merge($filteredarray);
array_shift($gabung);
foreach ($gabung as $value) {
			echo '<img class="carousel-item lazy" data-src="'.$value.'" alt="">';
}
}else{
			echo '<img class="carousel-item lazy" src="'.$base.'/img/portfolio/portfolio_slider1.png" alt="">';
			echo '<img class="carousel-item lazy" src="'.$base.'/img/portfolio/portfolio_slider2.png" alt="">';
			echo '<img class="carousel-item lazy" src="'.$base.'/img/portfolio/portfolio_slider3.png" alt="">';
}
?>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="project_description">
							<div class="widget_title">
								<h4><span>Deskripsi</span></h4>

							</div>
							<?=$isi;?>
						</div>
						<div class="project_details">
							<div class="widget_title">
								<h4><span>Detail Klien</span></h4>
							</div>
							<ul class="details">
								<li><span>Konsumen</span>: <?=$client;?></li>
								<li><span>Perusahaan</span>: <?=$company;?></li>
								<li><span>Sejak</span>: <?=$tanggal;?></li>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="row sub_content">
					<div class="carousel-intro">
						<div class="col-md-12">
							<div class="dividerHeading">
								<h4><span>Lainnya</span></h4>

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
<?php
$sql = $db->query("SELECT * FROM `testimoni` WHERE id!='$ids' AND pub='Y' limit 15");
while($row=$sql->fetch_array()){
$arrays =  explode('#', $row['photo']);
$filteredarray = array_values( array_filter($arrays) );
$exp = array_merge($filteredarray);
$img = $REQUEST_PROTOCOL."://$_SERVER[HTTP_HOST]".$exp[0];
$img2 = $REQUEST_PROTOCOL."://$_SERVER[HTTP_HOST]".$exp[1];
$seo = $row['judul_seo'];
$judul = $row['judul'];
?>
							<!-- Recent Work Item -->
							<li class="col-sm-3 col-md-3 col-lg-3">
								<div class="recent-item">
									<figure>
										<div class="touching medium">
											<img src="<?=$img;?>" alt="" />
                                            <div class="hovers">
                                                <a href="<?=$img2;?>" class="hover-zoom mfp-image" ><i class="fa fa-search"></i></a>
                                                <a href="/klien/<?=$seo;?>" class="hover-link"><i class="fa fa-link"></i></a>
                                            </div>
										</div>
									</figure>
								</div>
							</li>
<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</section>
	<script type="text/javascript">
		$(document).ready(function() {
			$.fn.carousel = function(op) {
				var op, ui = {};
				op = $.extend({
					speed: 500,
					autoChange: false,
					interval: 5000
				}, op);
				ui.carousel = this;
				ui.items    = ui.carousel.find('.carousel-item');
				ui.itemsLen = ui.items.length;

				// CREATE CONTROLS
				ui.ctrl 	= $('<div />', {'class': 'carousel-control'});
				ui.prev 	= $('<div />', {'class': 'carousel-prev'});
				ui.next 	= $('<div />', {'class': 'carousel-next'});
				ui.pagList  = $('<ul />', {'class': 'carousel-pagination'});
				ui.pagItem  = $('<li></li>');
				for (var i = 0; i < ui.itemsLen; i++) {
					ui.pagItem.clone().appendTo(ui.pagList);
				}
				ui.prev.appendTo(ui.ctrl);
				ui.next.appendTo(ui.ctrl);
				ui.pagList.appendTo(ui.ctrl);
				ui.ctrl.appendTo(ui.carousel);
				ui.carousel.find('.carousel-pagination li').eq(0).addClass('active');
				ui.carousel.find('.carousel-item').each(function() {
					$(this).hide();
				});
				ui.carousel.find('.carousel-item').eq(0).show().addClass('active');
				
				
				// CHANGE ITEM
				var changeImage = function(direction, context) {
					var current = ui.carousel.find('.carousel-item.active');

					if (direction == 'index') {
						if(current.index() === context.index())
							return false;

						context.addClass('active').siblings().removeClass('active');

						ui.items.eq(context.index()).addClass('current').fadeIn(op.speed, function() {
							current.removeClass('active').hide();
							$(this).addClass('active').removeClass('current');
						});
					} 

					if (direction == 'prev') {
						if (current.index() == 0) {
							ui.carousel.find('.carousel-item:last').addClass('current').fadeIn(op.speed, function() {
								current.removeClass('active').hide();
								$(this).addClass('active').removeClass('current');
							});
						}
						else {
							current.prev().addClass('current').fadeIn(op.speed, function() {
								current.removeClass('active').hide();
								$(this).addClass('active').removeClass('current');
							});
						}
					}

					if (direction == undefined) {
						if (current.index() == ui.itemsLen - 1) {
							ui.carousel.find('.carousel-item:first').addClass('current').fadeIn(300, function() {
								current.removeClass('active').hide();
								$(this).addClass('active').removeClass('current');
							});
						}
						else {
							current.next().addClass('current').fadeIn(300, function() {
								current.removeClass('active').hide();
								$(this).addClass('active').removeClass('current');
							});
						}
					}
					ui.carousel.find('.carousel-pagination li').eq( ui.carousel.find('.carousel-item.current').index() ).addClass('active').siblings().removeClass('active');
				};

				ui.carousel
					.on('click', 'li', function() {
						changeImage('index', $(this));
					})
					.on('click', '.carousel-prev', function() {
						changeImage('prev');
					})
					.on('click', '.carousel-next', function() {
						changeImage();
					});
				
				// AUTO CHANGE
				if (op.autoChange) {
					var changeInterval = setInterval(changeImage, op.interval);
					ui.carousel
						.on('mouseenter', function() {
							clearInterval(changeInterval);
						})
						.on('mouseleave', function() {
							changeInterval = setInterval(changeImage, op.interval);
						});
				}
				return this;
			};
			
			$('.porDetCarousel').each(function() {
				$(this).carousel({
					autoChange: true
				});
			});
		});
	</script>
<?php }else{
include "404-page.php";
	
}
?>