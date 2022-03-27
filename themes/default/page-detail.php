<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$sql = $db->query("select * from page where judul_seo='$seo'");
if($sql->num_rows > 0){
?>
	<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>PRODUK</h2>
						<nav id="breadcrumbs">
							<ul>
								<li>You are here:</li>
								<li><a href="index.html">Home</a></li>
								<li><a href="/<?=$act;?>"><?=ucfirst($act);?></a></li>
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
									<a href="#">
										<img src="<?=$base;?>/img/blog/blog_1.png" alt="blog post">
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
									<li class="shareslabel"><h3>Share This Story</h3></li>
									<li><a class="twitter" href="#" data-placement="bottom" data-toggle="tooltip" title="Twitter"></a></li>
									<li><a class="facebook" href="#" data-placement="bottom" data-toggle="tooltip" title="Facebook"></a></li>
									<li><a class="gplus" href="#" data-placement="bottom" data-toggle="tooltip" title="Google Plus"></a></li>
									<li><a class="pinterest" href="#" data-placement="bottom" data-toggle="tooltip" title="Pinterest"></a></li>
									<li><a class="yahoo" href="#" data-placement="bottom" data-toggle="tooltip" title="Yahoo"></a></li>
									<li><a class="linkedin" href="#" data-placement="bottom" data-toggle="tooltip" title="LinkedIn"></a></li>
								</ul>
							</article>
							<div class="about_author">
								<div class="author_desc">
									<div class="author-team_pic">
                                        <img src="img/blog/author.png" alt="about author">
                                        <span></span>
									</div>
									<ul class="author_social">
										<li><a class="fb" href="#." data-placement="top" data-toggle="tooltip" title="Facbook"><i class="fa fa-facebook"></i></a></li>
										<li><a class="twtr" href="#." data-placement="top" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
										<li><a class="skype" href="#." data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
									</ul>
								</div>
								<div class="author_bio">
									<h3 class="author_name"><a href="#">Tom Jobs</a></h3>
									<h5>CEO at <a href="#">bestjquery</a></h5>
									<p class="author_det">
										Lorem ipsum dolor sit amet ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus omnis saperet docendi nec, eos ea alii molestiae aliquand.
									</p>
								</div>
							</div>
						</div>
							
							
						<!--News Comments-->
							<div class="news_comments">
								<div class="dividerHeading">
									<h4><span>Comments (6)</span></h4>
								</div>
								
								<div id="comment">
									<ul id="comment-list">
										<li class="comment">
											<div class="avatar"><img alt="" src="img/blog/avatar_1.png" class="avatar"></div>
											<div class="comment-container">
												<h4 class="comment-author"><span><a href="#">John Smith</a></span></h4>
												<div class="comment-meta"><a href="#" class="comment-date link-style1">February 22, 2014</a><a class="comment-reply-link link-style3" href="#respond">Reply &raquo;</a></div>
												<div class="comment-body">
													<p>Ne omnis saperet docendi nec, eos ea alii molestiae aliquand. Latine fuisset mele, mandamus atrioque eu mea, wi forensib argumentum vim an. Te viderer conceptam sed, mea et delenit fabellas probat.</p>
												</div>
											</div>
										</li>						
										<li class="comment">
											<div class="avatar"><img alt="" src="img/blog/avatar_2.png" class="avatar"></div>
											<div class="comment-container">
												<h4 class="comment-author"><span><a href="#">Eva Smith</a></span></h4>
												<div class="comment-meta"><a href="#" class="comment-date link-style1">February 13, 2014</a><a class="comment-reply-link link-style3" href="#respond">Reply &raquo;</a></div>
												<div class="comment-body">
													<p>Vidit nulla errem ea mea. Dolore apeirian insolens mea ut, indoctum consequuntur hasi. No aeque dictas dissenti as tusu, sumo quodsi fuisset mea in. Ea nobis populo interesset cum, ne sit quis elit officiis, min im tempor iracundia sit anet. Facer falli aliquam nec te. In eirmod utamur offendit vis, posidonium instructior sed te.</p>
												</div>
											</div> 
											<ul class="children">
												<li class="comment">
													<div class="avatar"><img alt="" src="img/blog/avatar_3.png" class="avatar"></div>
													<div class="comment-container">
														<h4 class="comment-author"><span><a href="#">Thomas Smith</a></span></h4>
														<div class="comment-meta"><a href="#" class="comment-date link-style1">February 14, 2014</a><a class="comment-reply-link link-style3" href="#respond">Reply &raquo;</a></div>
														<div class="comment-body">
															<p>Labores pertinax theophrastus vim an. Error ditas in sea, per no omnis iisque nonumes. Est an dicam option, ad quis iriure saperet nec, ignota causae inciderint ex vix. Iisque qualisque imp duo eu, pro reque consequ untur. No vero laudem legere pri, error denique vis ne, duo iusto bonorum.</p>
														</div>
													</div>
													<ul class="children">
														<li class="comment">
															<div class="avatar"><img alt="" src="img/blog/avatar_2.png" class="avatar"></div>
															<div class="comment-container">
																<h4 class="comment-author"><span><a href="#">Eva Smith</a></span></h4>
																<div class="comment-meta"><a href="#" class="comment-date link-style1">February 14, 2014</a><a class="comment-reply-link link-style3" href="#respond">Reply &raquo;</a></div>
																<div class="comment-body">
																	<p>Dico animal vis cu, sed no aliquam appellantur, et exerci eleifend eos. Vixese eros tiloi novum adtam, mazim inimicus maiestatis ad vim. Ex his unum fuisset reformidans, has iriure ornatus atomorum ut, ad tation feugiat impedit per.</p>
																</div>
															</div>  
														</li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="comment">
											<div class="avatar"><img alt="" src="img/blog/avatar_1.png" class="avatar"></div>
											<div class="comment-container">
												<h4 class="comment-author"><span><a href="#">John Smith</a></span></h4>
												<div class="comment-meta"><a href="#" class="comment-date link-style1">February 07, 2014</a><a class="comment-reply-link link-style3" href="#respond">Reply &raquo;</a></div>
												<div class="comment-body">
													<p>Eu mea harum soleat albucius. At duo nihil saperet inimicus. Ne quo dicit offendit eloquenam. Ut intellegam inn theophras tus mea. Vide ceteros mediocritatem est in, utamur gubergren contentiones.</p>
												</div>
											</div>
										</li>
										<li class="comment">
											<div class="avatar"><img alt="" src="img/blog/avatar_3.png" class="avatar"></div>
											<div class="comment-container">
												<h4 class="comment-author"><span><a href="#">Thomas Smith</a></span></h4>
												<div class="comment-meta"><a href="#" class="comment-date link-style1">February 02, 2014</a><a class="comment-reply-link link-style3" href="#respond">Reply &raquo;</a></div>
												<div class="comment-body">
													<p>Quodsi eirmod salutandi usu ei, ei mazim facete mel. Deleniti interesset at sed, sea ei malis expetenda. Ei efficiat integebat mel, vis alii insoles te. Vis ex bonorum contentiones. An cum possit reformidans. Est at eripuit theophrastus. Scripta imper diet ad nec, Leaguerti contentiones id eam, an eum causae officiis.</p>
												</div>
											</div>
										</li>
									</ul>
								</div>
								<!-- /#comments -->
								<div class="dividerHeading">
									<h4><span>Leave a comment</span></h4>

								</div>

                                <div class="row comment_form">
                                    <div class="col-sm-4">
                                        <input class="form-control" name="name" type="text" id="name" size="30"  onfocus="if(this.value == 'Name') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Name'; }" value="Name" placeholder="Name" >
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-control" name="email" type="text" id="email" size="30" onfocus="if(this.value == 'E-mail') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'E-mail'; }" value="E-mail" placeholder="E-mail">
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-control" name="url" type="text" id="url" size="30" onfocus="if(this.value == 'Url') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Url'; }" value="Url" placeholder="Url">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <textarea name="comments" class="form-control" rows="6" cols="40" id="comments" onfocus="if(this.value == 'Message') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Message'; }" placeholder="Message">Message</textarea>
                                        </p>
                                    </div>
                                </div>
								
								
								<a class="btn btn-lg btn-default" href="#">Post Comment</a>
						
						
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