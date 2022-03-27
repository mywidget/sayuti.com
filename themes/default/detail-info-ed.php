<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
					<div class="col-xs-12 col-md-4 col-lg-4 col-sm-4">
						<div class="sidebar">
							<div class="widget widget_categories">
								<div class="widget_title">
									<h4><span>Informasi Reseller</span></h4>
								</div>
								<ul class="arrows_list">
	<li><a href="/member/detail/<?=$data['token'];?>"><i class="fa fa-angle-right"></i>Profil Reseller</a></li>
	<li><a href="/member/edit/<?=$data['token'];?>"><i class="fa fa-angle-right"></i>Edit Profile</a></li>
	<li><a href="/logout"><i class="fa fa-angle-right"></i>Keluar</a></li>

								</ul>
							</div>
							<div class="widget widget_categories">
								<div class="widget_title">
									<h4><span>Informasi Produk</span></h4>
								</div>
								<ul class="arrows_list">
	<li><a href="/member/produk"><i class="fa fa-angle-right"></i>Bingkai</a></li>
	<!--li><a href="/member/pembelian"><i class="fa fa-angle-right"></i>List Pembelian</a></li-->

								</ul>
							</div>
						</div>
					</div>