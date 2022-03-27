<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
$sql = $db->query("select * from posting where judul_seo='$seo' AND publish='Y'");
if($sql->num_rows > 0){
$row=$sql->fetch_array();
$idberita = $row['id_post'];
$idcat = $row['id_cat'];
$judul = $row['judul'];
$judul_seo = $host.'/category/'.$row['judul_seo'];
$tgl = foldertgl($row['tanggal']);
$bln = bulan($row['tanggal']);
$tanggal = datetimes($row['tanggal']);
$admin = $row['alias'];
$link_dl = $row['link_dl'];
$isi = $row['postingan'];
$thnt = folderthn($row['folder']);
$blnt = folderbln($row['folder']);
$gbrt = $row['gambar'];
$gambar = $host.'/images/post/'.$thnt.'/'.$blnt.'/'.$gbrt;
insert_populer($idberita,$idcat,$tgl_sekarang,0);
?>
	<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>INFORMASI</h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li><a href="/category">Category</a></li>
								<li><?=$breadone;?></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>

		<section class="content blog">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="blog_single">
							<article class="post">
								<figure class="post_img">
									<a href="<?=$judul_seo;?>">
										<img src="<?=$gambar;?>" alt="blog post">
									</a>
								</figure>
								<div class="post_date">
									<span class="day"><?=$tgl;?></span>
									<span class="month"><?=$bln;?></span>
								</div>
								<div class="post_content">
									<div class="post_meta">
										<h2>
											<a href="<?=$judul_seo;?>"><?=$judul;?></a>
										</h2>
										<div class="metaInfo">
											<span><i class="fa fa-calendar"></i> <a href="#"><?=$tanggal;?></a> </span>
											<span><i class="fa fa-user"></i> By <a href="/profile/<?=$admin;?>"><?=$admin;?></a> </span>
											<span><?php echo tags3($idberita) ;?></span>
											<!--span><i class="fa fa-comments"></i> <a href="#">12 Comments</a></span-->
										</div>
									</div>
									<?=$isi;?>
								</div>
								<ul class="shares">
									<li class="shareslabel"><h3>Share & Chat</h3></li>
									<li><a class="twitter" href="https://twitter.com/home?status=<?=$judul_seo;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-placement="bottom" data-toggle="tooltip" title="Twitter"></a></li>
									<li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=$judul_seo;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-placement="bottom" data-toggle="tooltip" title="Facebook"></a></li>
									<?php echo kontakwa(7,$judul_seo,'');?>
									<?php if($link_dl!=''){
									echo linkDL($link_dl);
									} ?>
								</ul>
							</article>
							<!--div class="about_author">
								<div class="author_desc">
									<div class="author-team_pic">
                                        <img src="<?=$base;?>/img/ghoblin32.jpg" alt="about author">
                                        <span></span>
									</div>
									<ul class="author_social">
										<li><a class="fb" href="https://facebook.com/ghoblin" data-placement="top" data-toggle="tooltip" title="Facbook" target="_blank"><i class="fa fa-facebook"></i></a></li>
										<li><a class="twtr" href="https://twitter.com/ghoblin" data-placement="top" data-toggle="tooltip" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
									</ul>
								</div>
								<div class="author_bio">
									<h3 class="author_name"><a href="/profile/<?=$admin;?>"><?=$admin;?></a></h3>
									<h5>Admin at <a href="https://rangkasku.web.id">Rangkasku</a></h5>
									<p class="author_det">Design & Developer at sayuti.com </p>
								</div>
							</div-->
						</div>
<div class="news_comments">
								<div class="dividerHeading">
									<h4><span>Komentar</span></h4>
								</div>
<?php echo plugin('komentar',3,$seo,'');?>
</div>
				</div>
					
					
					<!--Sidebar Widget-->
<?php include "widget.php";?>
				</div><!--/.row-->
			</div> <!--/.container-->
		</section>
<?php 
	// $url_input = "https://api.sayuti.com/v1/get/";

// $_token = '7d536729ccba46b9aa0b5c08505ef365';
// $jenis = array('token'=>$_token);
// $push = array_merge($jenis,$seo);
// $sync = curl($url_input,json_encode($push));
// print_r($sync);
// $vr = json_decode($sync,true);

	}else{
include "404-page.php";
	
}
?>