<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$sql = $db->query("select * from user where slug='$seo'");
if($sql->num_rows > 0){
$data=$sql->fetch_array();
?>
	<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>PROFILE</h2>
						<nav id="breadcrumbs">
							<ul>
								<li>You are here:</li>
								<li><a href="index.html">Home</a></li>
								<li><a href="/<?=$act;?>"><?=ucfirst($act);?></a></li>
								<li><?=$seo;?></li>
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
									<a href="#">
										<img src="<?=$base;?>/img/portfolio/portfolio_slider1.png" alt="profile">
									</a>
								</figure>
								<div class="post_date">
									<span class="day">28</span>
									<span class="month">Nov</span>
								</div>
								<div class="post_content">
									<div class="post_meta">
										<h2>
											<a href="#">perferendis doloribus asperiores ut labore</a>
										</h2>
										<div class="metaInfo">
											<span><i class="fa fa-calendar"></i> <a href="#">Nov 28, 2014</a> </span>
											<span><i class="fa fa-user"></i> By <a href="#">Louis</a> </span>
											<span><i class="fa fa-tag"></i> <a href="#">Emin</a>, <a href="#">News</a> </span>
											<span><i class="fa fa-comments"></i> <a href="#">12 Comments</a></span>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adip, sed do eiusmod tempor incididunt  ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus asperiores ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									
									<blockquote class="default">
										Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque eget tempor tellus. Fusce lacinia tempor malesuada. Ut lacus sapien, placerat a ornare nec, elementum sit amet felis. Maecenas pretium lorem hendrerit eros sagittis fermentum.
									</blockquote>
									
									<p>Morbi augue velit, tempus mattis dignissim nec, porta sed risus. Donec eget magna eu lorem tristique pellentesque eget eu dui. Fusce lacinia tempor malesuada. Ut lacus sapien, placerat a ornare nec, elementum sit amet felis. Maecenas pretium hendrerit fermentum. Fusce lacinia tempor malesuada. Ut lacus sapien, placerat a ornare nec, elementum sit amet felis. Maecenas pretium lorem hendrerit eros sagittis fermentum.</p>
									
									<p>Donec in ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Cras suscipit, quam vitae adipiscing faucibus, risus nibh laoreet odio, a porttitor metus eros ut enim. Morbi augue velit, tempus mattis dignissim nec, porta sed risus. Donec eget magna eu lorem tristique pellentesque eget eu duiport titor metus eros ut enim. </p>
								</div>
								<ul class="shares">
									<li class="shareslabel"><h3>Share This</h3></li>
									<li><a class="twitter" href="https://twitter.com/home?status=<?=$actual_link;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-placement="bottom" data-toggle="tooltip" title="Twitter"></a></li>
									<li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=$actual_link;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-placement="bottom" data-toggle="tooltip" title="Facebook"></a></li>
									<li><a class="gplus" href="https://plus.google.com/share?url=<?=$actual_link;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-placement="bottom" data-toggle="tooltip" title="Google Plus"></a></li>
								</ul>
							</article>
							<div class="about_author">
								<div class="author_desc">
									<div class="author-team_pic">
                                        <img src="<?=$base;?>/img/ghoblin32.jpg" alt="about author">
                                        <span></span>
									</div>
									<ul class="author_social">
										<li><a class="fb" href="https://facebook.com/ghoblin" data-placement="top" data-toggle="tooltip" title="Facbook" target="_blank"><i class="fa fa-facebook"></i></a></li>
										<li><a class="twtr" href="https://twitter.com/ghoblin" data-placement="top" data-toggle="tooltip" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<li><a class="gplus" href="https://plus.google.com/u/1/+MunajatIbnu" data-placement="top" data-toggle="tooltip" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</div>
								<div class="author_bio">
									<h3 class="author_name"><a href="/profile/<?=$admin;?>"><?=$admin;?></a></h3>
									<h5>Admin at <a href="https://rangkasku.web.id">Rangkasku</a></h5>
									<p class="author_det">
										Lorem ipsum dolor sit amet ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus omnis saperet docendi nec, eos ea alii molestiae aliquand.
									</p>
								</div>
							</div>
						</div>
				</div>
					
					
					<!--Sidebar Widget-->
<?php include "widget.php";?>
				</div><!--/.row-->
			</div> <!--/.container-->
		</section>
<?php }else{
include "404-page.php";
	
}
?>