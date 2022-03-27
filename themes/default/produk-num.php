<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section class="page_head">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h2>Semua Produk</h2>
				<nav id="breadcrumbs">
					<ul>
						<li></li>
						<li><a href="index.html">Home</a></li>
						<li><?=ucfirst($act);?></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</section>

<?php
	if (filter_var($pagenum, FILTER_VALIDATE_INT)) {
		$pageno = clean($pagenum);
		} else {
		$pageno = 1;
	}
	
	// $pageno = !empty($pagenums)? $pagenums:1;
	$no_of_records_per_page = 12;
	$offset = ($pageno-1) * $no_of_records_per_page; 
	
	$total_pages_sql = "SELECT COUNT(*) FROM produk";
	$result = $db->query($total_pages_sql);
	$total_rows = $result->fetch_array()[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);
	
	$sqlprod = $db->query("SELECT 
	`jenis_produk`.`seo_produk`,
	`produk`.`nama_produk`,
	`produk`.`produk_seo`,
	`produk`.`status`,
	`produk`.`photo2`
	FROM
	`jenis_produk`
	INNER JOIN `produk` ON (`jenis_produk`.`id_jenis_produk` = `produk`.`kategori_produk`) where produk.pub='Y' order by id_produk desc LIMIT $offset, $no_of_records_per_page");
	if($sqlprod->num_rows > 0){
	?>
	<section class="content portfolio">
		<div class="container">
			<div class="row">
				<div class="isotope col-lg-12">
					<div class="col-md-12 col-lg-12 col-sm-12 m-b-10">
						<?php echo plugin('cse',1);?>
					</div>
					<div class="blog_medium clearfix" style="margin-top:7%!important;margin-bottom:20px">
						<nav id="menu-container" class="arrow">
							<div id="btn-nav-previous" style="fill: #FFF">
								<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
									<path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
								<path d="M0 0h24v24H0z" fill="none"></path></svg>
							</div>
							<div id="btn-nav-next">
								<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
									<path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
								<path d="M0 0h24v24H0z" fill="none"></path></svg>
							</div>
							<div class="menu-inner-box">
								<div class="menus">
									<a class="menu-item" href="/produk">Semua Produk</a>
									<?php
										
										$sqlj = $db->query("SELECT `jenis_produk`.`seo_produk`, `jenis_produk`.`produk` FROM`jenis_produk`");
										while($rowj=$sqlj->fetch_array()){
											if($rowj['seo_produk']==$seo){
												$selected = 'selected';
												}else{
												$selected = '';
											}
											echo '<a class="menu-item" href="/produk/'.$rowj['seo_produk'].'">'.$rowj['produk'].'</a>';
										}
									?>
									
								</div>
							</div>
						</nav>
						<?php
							$no = 1;
							$no = $offset + 1;
							while($row=$sqlprod->fetch_array()){
								$judul = $row['nama_produk'];
								$seo = '/produk/'.$row['seo_produk'].'/'.$row['produk_seo'];
								$isi = kata($row['keterangan'],100);
								if($row['photo2']!=''){
									$arrays =  explode('#', $row['photo2']);
									$filteredarray = array_values( array_filter($arrays) );
									$exp = array_merge($filteredarray);
									$img = $exp[0];
									}else{
									$img = $host.'/images/no_photo.jpg';
								}
								if($row['status']!=''){
									$status = '<div class="status">'.$row['status'].'</div>' ;
									}else{
									$status = '';
								}
							?>
							<li class="list_item col-lg-3 col-md-3 col-sm-3">
								<div class="recent-item">
									<figure><?=$status;?>
										<div class="touching medium">
											<img class="lazy" data-src="<?=$img;?>" alt="" />
											<div class="hovers">
												<a href="<?=$img;?>" class="hover-zoom mfp-image" ><i class="fa fa-search"></i></a>
												<a href="<?=$seo;?>" class="hover-link"><i class="fa fa-link"></i></a>
											</div>
										</div>
										<figcaption class="item-description bgp">
											<h5><?=$row['nama_produk'];?></h5>
										</figcaption>
									</figure>
								</div>
							</li>
						<?php $no ++; } ?>
						
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12">
						<ul class="pagination pull-right mrgt-0">
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
				</div>
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
<style>
	.status{position:absolute;z-index:100;top:0;left:0;color:#fff;padding:5px;background:#ff0000}
	.bgp{background:#333;}
	.bgp h5{color:#fff !important}
	.scroll {
	white-space: nowrap;
	overflow-x: auto;
	-webkit-overflow-scrolling: touch;
	-ms-overflow-style: -ms-autohiding-scrollbar;
	}
	</style>		