<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Informasi Reseller</h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li><?=ucfirst($act);?></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
</section>
		
		
		<section class="content blog">
			<div class="container">
				<div class="row">
<?php include "widget_member.php";?>
<?php 
if($seo=='detail' AND $pagenum !=''){
?>
					<div class="col-lg-8 col-md-8 col-sm-8">
						<div class="dividerHeading">
							<h4><span>Profile Reseller</span></h4>
						</div>	
<div class="widget widget_info">
								<p>Berikut profile Anda. Jika ingin melakukan perubahan gunakan menu sebelah kiri</p>
								<ul class="widget_info_contact">
									<li><i class="fa fa-map-marker"></i> <p><strong>Address</strong><?=$data['alamat'];?></p></li>
									<li><i class="fa fa-user"></i> <p><strong>Phone</strong><?=$data['nohp'];?></p></li>
									<li><i class="fa fa-envelope"></i> <p><strong>Email</strong><a href="#"><?=$data['email'];?></a></p></li>
								</ul>
								
							</div>
						</div>
<?php
}elseif($seo=='edit' AND $pagenum !=''){
	
?>
					<div class="col-lg-8 col-md-8 col-sm-8">
						<div class="dividerHeading">
							<h4><span>Edit Profil Reseller</span></h4>
						</div>	
						<div class="alert alert-success hidden alert-dismissable" id="loginSuccess">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 </div>

						<div class="alert alert-danger hidden alert-dismissable" id="captchaError"></div>
						<div id="hide-form">
						<form id="loginForm" method="post" action="/member/save/<?=$data['token'];?>" novalidate="novalidate">
								<div class="row">
									<div class="form-group">
										<div class="col-md-12 p-b-5">
											<input type="email" id="email_l" name="email_l" class="form-control" maxlength="100" data-msg-password="Alamat email harus diisi." value="<?=$data['email'];?>" placeholder="Password baru" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12 p-b-5">
											<input type="password" id="pass_1" name="pass_1" class="form-control" maxlength="100" data-msg-password="Alamat email harus diisi." value="" placeholder="Password baru" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12 p-b-5">
											<input type="password" id="pass_2" name="pass_2" class="form-control" maxlength="100" data-msg-required="Password harus diisi." value="" placeholder="Ulangi Password">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12 p-b-5">
											<input type="email" id="nohp_l" name="nohp_l" class="form-control" maxlength="100" data-msg-password="Alamat email harus diisi." value="<?=$data['nohp'];?>" placeholder="Password baru" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group clearfix">
										<div class="col-md-12">
											<textarea id="alamat_l" class="form-control" name="alamat_l" rows="4" cols="30" data-msg-required="alamat harus diisi." maxlength="5000" placeholder="Alamat Reseller"><?=$data['alamat'];?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" data-loading-text="Loading..." class="btn btn-default btn-lg submit" value="Simpan">
									</div>
								</div>
							</form>
						</div>
					</div>
<?php
}elseif($seo=='save' AND $pagenum !=''){
echo '<div class="col-lg-8 col-md-8 col-sm-8">';
$token = $pagenum;
$email = filterpost('email_l');
$nohp = filterpost('nohp_l');
$alamat = filterpost('alamat_l');
if(empty($_POST['pass_1']) AND empty($_POST['pass_2'])){
$sqlup = $db->query("UPDATE tb_resell set email = '$email', nohp='$nohp', alamat='$alamat' where token='$token'");
if($sqlup){
echo '<div class="alert alert-success alert-dismissable">
		Update sukses.
	  </div>';
}else{
echo '<div class="alert alert-danger alert-dismissable">
	Update error.
	</div>';
}
}else{
$pass1 = filterpost('pass_1');
$pass2 = filterpost('pass_2');
if($pass1==$pass2){
$password = md5($pass_2);
$sqlup = $db->query("UPDATE tb_resell set email = '$email', password='$password', nohp='$nohp', alamat='$alamat' where token='$token'");
if($sqlup){
echo '<div class="alert alert-success alert-dismissable">
		Update sukses.
	  </div>';
}else{
echo '<div class="alert alert-danger alert-dismissable">
	Update error.
	</div>';
}
}else{
echo '<div class="alert alert-danger alert-dismissable">
	Update error.
	</div>';
}
}
echo "</div>";
}elseif($seo=='pembelian' AND $pagenum ==''){
include "pembelian.php";
}else{
include "bingkai.php";
}
?>
					<!--Sidebar Widget-->

				</div><!--/.row-->
			</div> <!--/.container-->
		</section>