<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
	<!--start wrapper-->
	<section class="wrapper">
		<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Hubungi Kami</h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li>Hubungi Kami</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		
		<section class="content contact">
			<div class="container">
				<div class="row sub_content">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="maps">
							<div id="contact_maps"></div>
						</div>
					</div>
				</div>
				
				
				<div class="row sub_content">
					<!--div class="col-lg-8 col-md-8 col-sm-8">
						<div class="dividerHeading">
							<h4><span>Hubungi Kami</span></h4>
						</div>
						<p>Jika ada pertanyaan, kritik dan saran silahkan isi formulir di bawah ini</p>
							
						<div class="alert alert-success hidden alert-dismissable" id="contactSuccess">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <strong>Sukses!</strong> Pesan sudah terkirim.
						</div>

						<div class="alert alert-danger hidden alert-dismissable" id="captchaError">
						</div>
						<form id="contactForm" action="" novalidate="novalidate">
								<div class="row">
									<div class="form-group">
										<div class="col-lg-6 col-md-6 col-sm-6 p-b-5">
											<input type="text" id="name" name="name" class="form-control" maxlength="100" data-msg-required="Nama harus diisi." value="" placeholder="Nama anda" >
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<input type="email" id="email" name="email" class="form-control" maxlength="100" data-msg-email="Masukan email anda." data-msg-required="Email harus diisi." value="" placeholder="E-mail anda" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12 p-b-5">
											<input type="text" id="subject" name="subject" class="form-control" maxlength="100" data-msg-required="Judul harus diisi." value="" placeholder="Judul pesan">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group clearfix">
										<div class="col-md-12">
											<textarea id="message" class="form-control" name="message" rows="10" cols="50" data-msg-required="Pesan harus diisi." maxlength="5000" placeholder="Isi pesan"></textarea>
										</div>
									</div>
								</div>
								<div class="row p-b-5">
									<div class="form-group">
										<div class="col-lg-8 col-md-8 col-sm-8">
											<input type="text" id="captchak" name="captchak" class="form-control" maxlength="100" data-msg-email="captcha harus diisi." value="" placeholder="captcha" >
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4">
											<img src="/addon/captcha_kontak.php" id="captcha_imgk"/>
											<a id="captcha_r" href="#"><i class="fa fa-refresh fa-lg"></i></a>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" data-loading-text="Loading..." class="btn btn-default btn-lg submit" value="Kirim Pesan">
									</div>
								</div>
							</form>
					</div-->
					
					<div class="col-lg-6 col-md-4 col-sm-4">
						<div class="sidebar">
							<div class="widget widget_info">
								<div class="dividerHeading">
									<h4><span>Kontak Serang</span></h4>

								</div>
								<?=alamat_2('SR');?>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-4 col-sm-4">
						<div class="sidebar">
							<div class="widget widget_social">
								<div class="dividerHeading">
									<h4><span>Sosial Media</span></h4>

								</div>
								<ul class="widget widget_social">
									<li><a class="fb" href="<?=urlsosmed('FB');?>" data-placement="bottom" data-toggle="tooltip" title="Facbook"><i class="fa fa-facebook"></i></a></li>
									<li><a class="twtr" href="<?=urlsosmed('TW');?>" data-placement="bottom" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a class="instagram" href="#." data-placement="bottom" data-toggle="tooltip" title="Instagram"><i class="fa fa-instagram"></i></a></li>
									<li><a class="youtube" href="#." data-placement="bottom" data-toggle="tooltip" title="Youtube"><i class="fa fa-youtube"></i></a></li>
									
									<li><a class="rss" href="<?=urlsosmed('RSS');?>" data-placement="bottom" data-toggle="tooltip" title="RSS"><i class="fa fa-rss"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</section>
		
	</section>
	<!--end wrapper-->
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript" src="<?=$base;?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?=$base;?>/js/view.contact.js"></script>
	<script type="text/javascript" src="<?=$base;?>/js/jquery.gmap.js"></script>