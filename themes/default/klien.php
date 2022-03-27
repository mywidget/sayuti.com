<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Klien Kami</h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li>Klien</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		
		<section class="content portfolio">
			<div class="container">
				<div class="row">
					<!--begin isotope -->
					<div class="isotope col-lg-12">
						<!--begin portfolio filter -->

						<!--end portfolio filter -->
						
						<!--begin portfolio_list -->   
						<ul id="list" class="portfolio_list clearfix">
							<!-- Begin Portfolio item -->
<?php
$sql = $db->query("SELECT * FROM `testimoni` WHERE pub='Y'");
while($row=$sql->fetch_array()){
$arrays =  explode('#', $row['photo']);
$filteredarray = array_values( array_filter($arrays) );
$exp = array_merge($filteredarray);
$img = $REQUEST_PROTOCOL."://$_SERVER[HTTP_HOST]".$exp[0];
?>
							<li class="list_item col-lg-3 col-md-3 col-sm-3">
								<div class="recent-item">
									<figure>
										<div class="touching medium">
											<img src="<?=$img;?>" alt="" />
                                            <div class="hovers">
                                                <a href="<?=$img;?>" class="hover-zoom mfp-image" ><i class="fa fa-search"></i></a>
                                                <a href="/klien/<?=$row['judul_seo'];?>" class="hover-link"><i class="fa fa-link"></i></a>
                                            </div>
										</div>
										<figcaption class="item-description">

										</figcaption>
									</figure>
								</div>
							</li>
							<!-- End Portfolio item -->
<?php } ?>


							<!-- End Portfolio item -->
						</ul> <!--end portfolio_list -->
						
					</div>
					<!--end isotope -->
					<div class="col-lg-12 col-md-12 col-sm-12">
						
					</div>
					
				</div> <!--./span12-->
			</div> <!--./div-->
		</section>