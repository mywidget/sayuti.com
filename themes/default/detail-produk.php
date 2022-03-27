<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');
$sql = $db->query("SELECT 
  `jenis_produk`.`seo_produk`,
  `produk`.`nama_produk`,
  `produk`.`produk_seo`,
  `produk`.`photo2`,
  `produk`.`id_produk`,
  `produk`.`kategori_produk`,
  `produk`.`keterangan`,
  `produk`.`keyword`,
  `produk`.`status`,  `produk`.`pub`,
  `produk`.`harga`,
  `produk`.`hitung`
FROM
  `jenis_produk`
  INNER JOIN `produk` ON (`jenis_produk`.`id_jenis_produk` = `produk`.`kategori_produk`) where produk.produk_seo='$seo_prod' AND `produk`.`pub`='Y'");
if($sql->num_rows > 0){
$row = $sql->fetch_array();
$id_produk = $row['id_produk'];
$id_kat = $row['kategori_produk'];
$judul = $row['nama_produk'];
$seo = $row['seo_produk'];
$judul_seo = $host.'/produk/'.$seo.'/'.$row['produk_seo'];
$keterangan = $row['keterangan'];
insert_populer($id_produk,$id_kat,$tgl_sekarang,1);
$sqlp = $db->query("SELECT * FROM `tbl_biaya` where KdBiaya='66'");
$rowp = $sqlp->fetch_array();
$persen = $rowp['JumlahMin'];
$keyword = $row['keyword'];
?>
	<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2>Detail produk <?=strtolower($seo);?> <?=$breadone;?></h2>
						<nav id="breadcrumbs">
							<ul>
								<li></li>
								<li><a href="/">Home</a></li>
								<li><a id="top" href="/<?=$act;?>"><?=ucfirst($act);?></a></li>
								<li><?=ucfirst($seo);?> <?=$breadone;?></li>
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
							<article class="post" style="border-bottom:0;margin-bottom:0">
								<figure class="post_img">
									<!-- Post Image Slider -->
									<div id="slider" class="swipe">
										<ul class="swipe-wrap">
										
<?php
if($row['photo2']!=''){
$arrays =  explode('#', $row['photo2']);
$filteredarray = array_values( array_filter($arrays) );
$gabung = array_merge($filteredarray);
// $removed = array_shift($gabung);
foreach ($gabung as $value) {
			echo '<li><img class="lazy" data-src="'.$value.'" /></li>';
}
}else{
			echo '<li><img class="lazy" data-src="'.$base.'/img/blog_slide.png" /></li>';
			echo '<li><img class="lazy" data-src="'.$base.'/img/blog_slide.png" /></li>';
			echo '<li><img class="lazy" data-src="'.$base.'/img/blog_slide.png" /></li>';
}
if($row['status']!=''){
	$status = '<div class="terbaru">'.$row['status'].'</div>';
}else{
	$status = '';
}
?>
										</ul>
										<div class="swipe-navi">
										  <div class="swipe-left" onclick="mySwipe.prev()"><i class="fa fa-chevron-left"></i></div> 
										  <div class="swipe-right" onclick="mySwipe.next()"><i class="fa fa-chevron-right"></i></div>
										</div>
										<?=$status;?>
									</div>
								</figure>
								<div class="post_date hidden-xs">
									<span class="day"><i class="fa fa-chevron-right"></i></span>
									<span class="month">&nbsp;&nbsp;</span>
								</div>
								<div class="post_content post_mob">
									<div class="post_meta">
										<h2>
											<a href="#"><?=$judul;?></a>
										</h2>
										<div class="metaInfo">
											<span><i class="fa fa-user"></i> By <a href="#">Administrator</a> </span>
										</div>
									</div>
									<?=$keterangan;?>
								</div>
								<ul class="shares">
									<li class="shareslabel"><h3>Share & Chat</h3></li>
									<li><a class="twitter" href="https://twitter.com/home?status=<?=$judul_seo;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-placement="bottom" data-toggle="tooltip" title="Twitter"></a></li>
									<li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=$judul_seo;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-placement="bottom" data-toggle="tooltip" title="Facebook"></a></li>
									<?php echo kontakwa(7,$judul_seo,'');?>
									<?php if($row['hitung']=='Y'){
									echo modalHit($row['produk_seo']);
									}else{
										echo harga($row['harga']);
										} ?>
								</ul>
							</article>
							<div class="about_author">
<?=$keyword;?>
							</div>
<script>
// function encode(text) {
      // // document.getElementById('escape').innerHTML = escape(text);
      // // document.getElementById('encodeURI').innerHTML = encodeURI(text);
      // document.getElementById('encodeURIComponent').innerHTML = encodeURIComponent(text);
      // // document.getElementById('urlencode').innerHTML = urlencode(text);
// }
// function urlencode (str) {
    // str = (str+'').toString();
    // return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
// }
</script>
						</div>
<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="dividerHeading">
							<h4><span>Produk Lainnya</span></h4>
						</div>
						<div class="row">
<?php
$sqll = $db->query("SELECT 
  `jenis_produk`.`seo_produk`,
  `produk`.`nama_produk`,
  `produk`.`produk_seo`,
  `produk`.`photo2`,
  `produk`.`photo`,
  `produk`.`id_produk`,
  `produk`.`kategori_produk`,
  `produk`.`keterangan`,
  `produk`.`keyword`,
  `produk`.`status`,
  `produk`.`harga`,
  `produk`.`hitung`
FROM
  `jenis_produk`
  INNER JOIN `produk` ON (`jenis_produk`.`id_jenis_produk` = `produk`.`kategori_produk`) where produk.id_produk!='$id_produk' order by id_produk DESC limit 8");
// if($sqll->num_rows > 0){
	while($rowl = $sqll->fetch_array()){
if($rowl['photo2']!=''){
$arrays =  explode('#', $rowl['photo2']);
$filteredarray = array_values( array_filter($arrays) );
$exp = array_merge($filteredarray);
$medium = $host."/img-medium".$exp[0];
$large = $exp[0];
}else{
$medium = $host.'/images/no_photo.jpg';
$large = $host.'/images/no_photo.jpg';
}
?>
							<div class="col-lg-6 col-md-6 col-sm-6 rec_blog">
								<div class="blogteam_pic ">
									<img alt="" src="<?=$medium;?>">
									<div class="blog-hover">
										<a href="/produk/<?=$rowl['seo_produk'];?>/<?=$rowl['produk_seo'];?>">
											<span class="icon">
												<i class="fa fa-link"></i>
											</span>
										</a>
									</div>
								</div>
								<div class="blogDetail" style="border:0">
									<div class="blogTitle">
										<a href="/produk/<?=$rowl['seo_produk'];?>/<?=$rowl['produk_seo'];?>">
											<h2 style="overflow-wrap: break-word;"><?=$rowl['nama_produk'];?></h2>
										</a>
									</div>
								</div>
							</div>
	<?php } ?>
						</div>
					</div>
				</div>

<script>
$(document).ready(function(){
function jump(h){
    var top = document.getElementById(h).offsetTop;
    window.scrollTo(0, top);
}
    $('#myModal').on('show.bs.modal', function (e) {
		
        var modul = $(e.relatedTarget).data('id');
		var classmod = $(e.relatedTarget).data('classname');
		var modname = $(e.relatedTarget).data('modname');
		var link  = '<?=$actual_link;?>';
        $.ajax({
            type : 'POST',
            url : '/addon/modal.php', //Here you will fetch records 
            data :  'modul='+ modul+'&link='+link, //Pass $id
			beforeSend: function(){	
				$(".lds-ellipsis").show();
				$(".fetched-data").hide();
				jump("top");
			},
            success : function(data){
			$(".fetched-data").show();
            $('.fetched-data').html(data);//Show fetched data from database
			$('#modal-lgs').addClass(classmod);
			$(".lds-ellipsis").hide();
            }
        });
     });
	$('body').on('hidden.bs.modal', '.modal', function () {
     $(this).removeData('bs.modal');
	  $("#modal-lgs").removeClass('modal-md');
	  $('.modal-backdrop').remove();
    });
$(document).on('shown.bs.modal', function(e) {
	$('[autofocus]', e.target).focus();
});
});
</script>
<style>
.terbaru{position:absolute;z-index:100;bottom:0;background:#ff0000;color:#fff;padding:5px;font-transform:uppercase;font-weight:bold}
</style>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="myModal" role="dialog" tabindex="-1">
	<div class="modal-dialog" id="modal-lgs">
		<div class="modal-content">
<center><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></center>
		<div class="fetched-data"></div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

					<!--Sidebar Widget-->
<?php include "widget.php";?>
				</div><!--/.row-->
			</div> <!--/.container-->
		</section>

<?php }else{
if (filter_var($pagenum, FILTER_VALIDATE_INT)) {
include "produk-num.php";
} else {
include "jenis.php";
}
}
?>