<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section class="content">
          <div class="box">
          <div class="box-body">
          <div class="row">
            <div class="col-md-12">
					<!-- Small boxes (Stat box) -->
					<div class="row">
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-aqua">
								<div class="inner">
<?php
$status_query = "SELECT COUNT(*) as postNum FROM produk";
$result_query = $db->query($status_query);
$resultNum = $result_query->fetch_assoc();
$id_invoice = $resultNum['postNum'];

$status_post = "SELECT COUNT(*) as postNum FROM posting";
$result_post = $db->query($status_post);
$resultPost = $result_post->fetch_assoc();
$id_posting = $resultPost['postNum'];

$status_post1 = "SELECT COUNT(*) as postNum FROM testimoni";
$result_post1 = $db->query($status_post1);
$resultPost1 = $result_post1->fetch_assoc();
$id_klien = $resultPost1['postNum'];

$status_post2 = "SELECT COUNT(*) as postNum FROM cat";
$result_post2 = $db->query($status_post2);
$resultPost2 = $result_post2->fetch_assoc();
$id_kat = $resultPost2['postNum'];
?>
									<h3><?=$id_invoice;?></h3><p>
										<a href="?panel=invoice">Produk</a>
								</div>
								<div class="icon">									
									<i class="ion ion-bag"></i>
								</div>
								<a href="?panel=produk" class="small-box-footer">Produk Baru <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-green">
								<div class="inner">
									<h3><?=$id_klien;?></h3>
									<p>Klien</p>
								</div>
								<div class="icon">
									<i class="fa  fa-file-o"></i>
								</div>
								<a href="?panel=pelanggan" class="small-box-footer">Lihat Klien <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-yellow">
								<div class="inner">
									<h3><?=$id_posting;?></h3><p>
									<p>Posting</p>
								</div>
								<div class="icon">
									<i class="fa  fa-file-o"></i>
								</div>
								<a href="?panel=post" class="small-box-footer">Lihat Posting <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div><!-- ./col -->
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-red">
								<div class="inner">
									<h3><?=$id_kat;?></h3>
									<p>Kategori</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
								<a href="?panel=kategori" class="small-box-footer">Lihat Kategori <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div><!-- ./col -->
					</div><!-- /.row --> 
				
					
            </div><!-- /.col -->
          </div><!-- /.row -->
          </div><!-- /.row -->
          </div><!-- /.row -->
        </section><!-- /.content -->