<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
	<!--start wrapper-->
	<section class="wrapper">
		<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Reseller</h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li>Reseller</li>
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
							<h4><span>Form Reseller</span></h4>
						</div>
						<p>Untuk menjadi Reseller silahkan isi formulir di bawah ini</p>
							
						<div class="alert alert-success hidden alert-dismissable" id="contactSuccess">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 </div>

						<div class="alert alert-danger hidden alert-dismissable" id="captchaError"></div>
						<div id="hide-form">
						<form id="contactForm" action="" novalidate="novalidate">
								<div class="row">
									<div class="form-group">
										<div class="col-lg-6 col-md-6 col-sm-6 p-b-5">
											<input type="text" id="name" name="name" class="form-control" maxlength="100" data-msg-required="Nama harus diisi." value="" placeholder="Nama Lengkap" >
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<input type="email" id="email" name="email" class="form-control" maxlength="100" data-msg-email="Alamat email harus diisi." value="" placeholder="E-mail anda" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12 p-b-5">
											<input type="text" id="nohp" name="nohp" class="form-control" maxlength="100" data-msg-required="No. Handphone harus diisi." value="" placeholder="No. Handphone">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group clearfix">
										<div class="col-md-12">
											<textarea id="alamat" class="form-control" name="alamat" rows="6" cols="30" data-msg-required="alamat harus diisi." maxlength="5000" placeholder="Alamat Reseller"></textarea>
										</div>
									</div>
								</div>
								<div class="row p-b-5">
									<div class="form-group">
										<div class="col-lg-8 col-md-8 col-sm-8">
											<input type="text" id="captcha" name="captcha" class="form-control" maxlength="100" data-msg-email="captcha harus diisi." value="" placeholder="captcha" >
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4">
											<img src="/addon/captcha_reg.php" id="captcha_imagek"/>
											<a id="captcha_k" href="#"><i class="fa fa-refresh fa-lg"></i></a>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<a href="#" data-toggle="modal" data-target="#syarat">Baca Syarat & ketentuan Reseller</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input type="submit" data-loading-text="Loading..." class="btn btn-default btn-md submit" value="Daftar">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
									<a class="btn btn-info btn-md submit" href="/login">Masuk</a>
									</div>
								</div>
							</form>
						</div>
							<button type="button" id="show-form" class="btn btn-success btn-block">Tampilkan Form</button>
					</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="syarat" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Syarat & Ketentuan Reseller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Syarat jadi reseller bingkai motivasi by sayuti.com :</p>
<ol>
<li>Melakukan pembelian awal minimal 5pcs</li>
<li>GRATIS untuk kata-kata atau motivasi yang termasuk umum</li>
<li>Boleh request desain sendiri dan akan dikenakan biaya 50rb/desain</li>
<li>Jika point 1 terpenuhi Otomatis sudah dapat harga reseller yaitu 30rb/pcs bingkai ukuran 40x60cm, harga 40rb/pcs bingkai ukuran 60x60cm.</li>
<li>Pembelian selanjutnya tidak ada minimum order, beli satu pun sudah dapat harga point 4.</li>
<li>Bagi reseller yang ingin mendropshipkan barangnya akan dikenakan biaya 5rb untuk packing (Bubble wrap)</li>
<li>Pengiriman barang dari Serang, Banten.</li>
<li>Ongkos kirim ditanggung reseller</li>
<li>Info lebih lanjut bisa menghubungi Admin saya di 08777 34567 33 (Hanya Whatsapp)</li>
</ol>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
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
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript" src="<?=$base;?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?=$base;?>/js/view.reseller.js"></script>