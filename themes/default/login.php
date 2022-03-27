<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
	<!--start wrapper-->
	<section class="wrapper">
		<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Login Reseller</h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li>Login Reseller</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		
		<section class="content contact">
			<div class="container">
				<div class="row sub_content">
					<div class="col-lg-8 col-md-8 col-sm-8">
						<div class="dividerHeading">
							<h4><span>Form Login Reseller</span></h4>
						</div>
						<p>Untuk login Reseller silahkan isi formulir di bawah ini</p>
							
						<div class="alert alert-success hidden alert-dismissable" id="loginSuccess">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 </div>

						<div class="alert alert-danger hidden alert-dismissable" id="captchaError"></div>
						<div id="hide-form">
						<form id="loginForm" action="" novalidate="novalidate">
								<div class="row p-b-5">
									<div class="form-group">
										<div class="col-md-12">
											<input type="email" id="email_l" name="email_l" class="form-control" maxlength="100" data-msg-required="Alamat email harus diisi." value="" placeholder="E-mail anda" >
										</div>
									</div>
								</div>
								<div class="row p-b-5">
									<div class="form-group">
										<div class="col-md-12">
											<input type="password" id="password_l" name="password_l" class="form-control" maxlength="100" data-msg-required="Password harus diisi." value="" placeholder="Password">
										</div>
									</div>
								</div>
								<div class="row p-b-5">
									<div class="form-group">
										<div class="col-lg-8 col-md-8 col-sm-8 p-b-5">
											<input type="text" id="captcha_l" name="captcha_l" class="form-control" maxlength="100" data-msg-required="captcha harus diisi." value="" placeholder="captcha" >
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 ">
											<img src="/addon/captcha_login.php" id="captcha_image_l"/>
											<a id="captcha_l_r" href="#"><i class="fa fa-refresh fa-lg"></i></a>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<input type="submit" data-loading-text="Loading..." class="btn btn-info btn-md submit" value="Masuk">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
									<a class="btn btn-default btn-md" href="/reseller">Daftar</a>
									</div>
								</div>
							</form>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="sidebar">
							<div class="widget widget_social">
								<div class="dividerHeading">
									<h4><span>Sosial Media</span></h4>

								</div>
								<ul class="widget widget_social">
									<li><a class="fb" href="<?=urlsosmed('FB');?>" data-placement="bottom" data-toggle="tooltip" title="Facbook"><i class="fa fa-facebook"></i></a></li>
									<li><a class="twtr" href="<?=urlsosmed('TW');?>" data-placement="bottom" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a class="gmail" href="<?=urlsosmed('GP');?>" data-placement="bottom" data-toggle="tooltip" title="Google"><i class="fa fa-google-plus"></i></a></li>
									<li><a class="instagram" href="#." data-placement="bottom" data-toggle="tooltip" title="Instagram"><i class="fa fa-instagram"></i></a></li>
									<li><a class="youtube" href="#." data-placement="bottom" data-toggle="tooltip" title="Youtube"><i class="fa fa-youtube"></i></a></li>
									<li><a class="flickrs" href="https://www.flickr.com/photos/93616079@N05/" data-placement="bottom" data-toggle="tooltip" title="Flickr"><i class="fa fa-flickr"></i></a></li>
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
	<script type="text/javascript" src="<?=$base;?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?=$base;?>/js/view.login.js"></script>