<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
	<!--start wrapper-->
	<section class="wrapper">
		<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Aktivasi</h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li>Aktivasi</li>
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
					
					</div>
				</div>
				<div class="row sub_content">
					<div class="col-lg-8 col-md-8 col-sm-8">
						<div class="dividerHeading">
							<h4><span>Aktivasi Reseller</span></h4>
						</div>
<?php
$x = "?".$seo;
$var=decode($x);
if ($var['level']=='member'){
$sql = "SELECT * FROM tmp_resell WHERE email='".$var['email']."' AND token='".$var['token']."'";
$hasil = $db->query($sql);
$jumlah = $hasil->num_rows;
if ($jumlah > 0){
	$insert = $db->query("INSERT INTO tb_resell (nama,
											email,
											password,
											nohp,
											alamat,
											tgl_reg,
											token,
											aktif) 
									SELECT	nama,
											email,
											password,
											nohp,
											alamat,
											tgl_reg,
											token,
											aktif 
											FROM tmp_resell WHERE email='".$var['email']."' AND token='".$var['token']."'");
	if($insert){
	//hapus tmp user
	$db->query("DELETE FROM tmp_resell WHERE email='".$var['email']."' AND token='".$var['token']."'");

	$from = "From:no-replay@sayuti.com \n" . //
	"MIME-Version: 1.0\n" . 
	"Content-type: text/html; charset=iso-8859-1";
	$to = $var['email']; //
	$judul	= "Konfirmasi Aktifasi Reseller";
	include "mail_member.php";
	mail($to,$judul,$isiMail,$from);
  
echo '<div class="promo_content">
							<div class="pb_text">
								<h3>Aktivasi Sukses.</h3>
								<p>Email Anda ['.$var['email'].'] sudah aktif.</p>
							</div>
							<div class="pb_action">
								<a class="btn btn-lg btn-danger" href="/login">
									<i class="fa fa-lock"></i>
									Login
								</a>
							</div>
						</div>';
	}else{
echo '<div class="promo_content">
							<div class="pb_text">
								<h3>Aktivasi error.</h3>
								<p>Data gagal di input</p>
							</div>
							<div class="pb_action">
								<a class="btn btn-lg btn-danger" href="/">
									<i class="fa fa-home"></i>
									Beranda
								</a>
							</div>
						</div>';
	}
}else{
echo '<div class="promo_content">
							<div class="pb_text">
								<h3>Aktivasi error.</h3>
								<p>Maaf Kode aktivasi tidak ditemukan</p>
							</div>
							<div class="pb_action">
								<a class="btn btn-lg btn-danger" href="/">
									<i class="fa fa-home"></i>
									Beranda
								</a>
							</div>
						</div>';
}
}else{
	echo "error";
}
?>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="sidebar">
							<div class="widget widget_info">
								<div class="dividerHeading">
									<h4><span>Kontak Serang</span></h4>

								</div>
								<?=alamat_2('SR');?>
							</div>
							<div class="widget widget_info">
								<div class="dividerHeading">
									<h4><span>Kontak Pandeglang</span></h4>

								</div>
								<?=alamat_2('PDG');?>
							</div>
							<div class="widget widget_info">
								<div class="dividerHeading">
									<h4><span>Kontak Labuan</span></h4>

								</div>
								<?=alamat_2('LBN');?>
							</div>
							<div class="widget widget_info">
								<div class="dividerHeading">
									<h4><span>Kontak Bandung</span></h4>

								</div>
								<?=alamat_2('BDG');?>
							</div>
							
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