<style type="text/css">
#files {
    height: 90px;
    cursor: pointer
}
#image {
    width: 200px;
    height: 200px;
    overflow: hidden;
    cursor: pointer;
    background: #000;
    color: #fff;
}
#image img {
    visibility: hidden;
}
#imageup {
    width: 150px;
    height: 100px;
    overflow: hidden;
    cursor: pointer;
    background: #000;
    color: #fff;
}
#imageup img {
    visibility: hidden;
}
textarea#files {
    width: 100%;
    height: 100px;
    cursor: pointer
}
</style>
<?php
// Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
switch($act){
  default:

$notab='';	


$sqlu = $db->query("select level from user where id_user = '$_SESSION[iduser]'");
$rowuser = $sqlu->fetch_array();
$level = $rowuser['level'];
//echo $level;

if(isset($_POST['cari'])){
	$cari=$_POST['cari'];
//	echo $cari;
}else{
	$cari="";
}
if(isset($_GET['id_jenis_produk'])){
	$id=$_GET['id_jenis_produk'];
}

$page = (isset($_GET['page']))? $_GET['page'] : 1;

?>

<style>
#dispidakun{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#dispnama{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#result{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#validate-status{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
.red, .red a {color: #FF0000;font-size:24pt}
.green, .green a {color: #33CC33;font-size:24pt}
.modal-title{color:#000}
.modal-footer{color:#000}
#result{
	margin-left:5px;
}
.tooltip {
    max-width: 350px;
    /* If max-width does not work, try using width instead */
    width: 350px; 
}
.nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus {
    color: #444;
    background: #C0BAB0 none repeat scroll 0% 0%;
}
label {
    display: inline-block;
    width: 90%;
    margin-top: 10px;
    font-weight: 700;
}
th{background-color: #F39C12;height:30px;border: solid 1px #dcdcdc;}
td, th {
  border: 1px solid #ccc;
  text-align: center;
  height:28px;
}
	.style-1 input[type="text"] {
    padding: 4px;
    border: 0px solid #DCDCDC;
    transition: box-shadow 0.3s ease 0s, border 0.3s ease 0s;
	}
.style-1 input[type="text"]:focus,
.style-1 input[type="text"].focus {
  border: solid 1px #707070;
  box-shadow: 0 0 5px 1px #969696;
}
	.form-control {
    height: 28px;
    padding: 6px 6px;
	}
	
	.form-control2 {
    height: 28px;
    padding: 6px 6px;
	width: 50%;
	border: 1px solid #DCDCDC;
	}	
	
	.dropdown-toggle {
    width: 100%;
    padding: 2px;
    height: 28px;
    border-radius: 0px;
	}	
	
.form-group {
    margin-bottom: 7px;
}	

</style>



	
<script type="text/javascript">
	
        $(document).ready(function() {
        
            // Javascript to enable link to tab
			var hash = document.location.hash;
			var prefix = "tab";
			if (hash) {
				$('.navbar  a[href='+hash.replace(prefix,"")+']').tab('show');
			} 

			// Change hash for page-reload
			$('.navbar  a').on('shown.bs.tab', function (e) {
				window.location.hash = e.target.hash.replace("#", "#" + prefix);
			});
					
        });
</script>
<script type="text/javascript">
function getid(no,nama,tab){

    var  str = no; 
    var  str2 = nama; 
    var  str3 = tab; 
	document.getElementById("id_jenis_produk").value = str; 
	document.getElementById("produk").value = str2; 
	document.getElementById("tab").value = '#tabtab_' + str3; 
	document.getElementById("notab").value = str3; 
//	alert(str);
}

function getid2(no){

    var  str = no; 
	document.getElementById("nama_produk").value = str; 
	alert(str);
}

</script>
	

          <!-- START CUSTOM TABS -->
<div class="row">
<div class="col-md-12">
<div class="box">

<div class="row" style="margin-bottom:10px">
<div class="col-md-6">
<div class="box-header">
<div id="input-outer">
	<input type="text" class="form-control" id="keywords" placeholder="Cari Produk" onkeyup="cariFilter()"/>
    <div id="clear"></div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="box-header">
<a href="#" data-toggle="modal" data-target="#formproduk"  class="btn btn-danger pull-right" onclick="getid(<?=$id_kat;?>)" title="Tambah Produk">Tambah Produk</a> 
</div>
</div>
</div>

<div class="box-body">
    <div class="loading-overlay"><div class="overlay-content">Loading.....</div></div>
    <div id="posts_content">
	<?php
	
    $limit = 10;
	$limit_start = ($page - 1) * $limit;
   
?>
 <div class="posts_list">
<table class="table table-bordered table-hover">
<thead>
	<tr>
		<th style="width:2% !important" class="text-center">No</th>
		<th class="text-left" style="width:15% !important">Nama Produk</th>
		<th class="text-left" style="width:6% !important">Jenis</th>
		<th class="text-left" style="width:6% !important">Harga</th>
		<th class="text-center" style="width:5% !important">Featured</th>
		<th class="text-center" style="width:5% !important">Publish</th>
		<th class="text-center" style="width:5% !important">Hapus</th>
	</tr>
</thead>
<?php
$query = $db->query("SELECT 
  `jenis_produk`.`produk`,
  `produk`.`nama_produk`,
  `produk`.`harga`,
  `produk`.`id_produk`,
  `produk`.`featured`,
  `produk`.`pub`
FROM
  `produk`
  INNER JOIN `jenis_produk` ON (`produk`.`kategori_produk` = `jenis_produk`.`id_jenis_produk`) ORDER BY id_produk DESC LIMIT ".$limit_start.",".$limit);
$nom = $limit_start + 1;
while($row = $query->fetch_assoc()){
$full_path = $_SERVER["DOCUMENT_ROOT"] . '/'.$row['photo'];
$size = @getimagesize($full_path);
if($size !== false){
$gambar = $row['photo'];
}else{
$gambar = '../images/blank.jpg';
}
if($row['pub']=='Y'){
$aktif = '<span class="label label-success"><span class="glyphicon glyphicon-check"></span></span>';
$title = 'unPublish';
$link = "?panel=produk&act=publish&status=$title&id=$row[id_produk]&page=".$page;
}else{
$aktif = '<span class="label label-danger"><span class="glyphicon glyphicon-minus"></span></span>';
$title = 'Publish';
$link = "?panel=produk&act=publish&status=$title&id=$row[id_produk]&page=".$page;
}
if($row['featured']=='Y'){
$aktif1 = '<span class="label label-success"><span class="glyphicon glyphicon-check"></span></span>';
$title1 = 'unfeatured';
$link1 = "?panel=produk&act=featured&status=$title1&id=$row[id_produk]&page=".$page;
}else{
$aktif1 = '<span class="label label-danger"><span class="glyphicon glyphicon-minus"></span></span>';
$title1 = 'featured';
$link1 = "?panel=produk&act=featured&status=$title1&id=$row[id_produk]&page=".$page;
}

									?>
										<tr>
											
											<td ><?php echo $nom;?></td>
											<?php if ($_SESSION['leveluser'] == 'admin'){ ?>
											<td class="text-left">
											<a href="?panel=produk&act=edit&id_produk=<?=$row['id_produk'];?>&page=<?=$page;?>" title="Rubah Produk">	<?php echo $row['nama_produk'];?>
											</a></td>
											<?php }else{ ?>
											<td class="text-left"><?php echo $row['nama_produk'];?></td>
											<?php } ?>
											<td class="text-left"><?php echo $row['produk'];?></td>
											<td class="text-left"><?php echo $row['harga'];?></td>
											<td>
											<a href="<?=$link1;?>" data-toggle="tooltip" title="<?=$title1;?>"><?=$aktif1;?></a>
											</td>
											<td><a href="<?=$link;?>" data-toggle="tooltip" title="<?=$title;?>"><?=$aktif;?></a></td>
											<td>
											<a data-href="?panel=produk&act=hapus&id=<?=$row['id_produk'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
											</td>


										</tr>
									<?php $nom++; } ?>
									</tbody>
								</table>
			<ul class="pagination pull-right">
				<!-- LINK FIRST AND PREV -->
				<?php
				if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
				?>
					<li class="disabled"><a href="#">First</a></li>
					<li class="disabled"><a href="#">&laquo;</a></li>
				<?php
				}else{ // Jika page bukan page ke 1
					$link_prev = ($page > 1)? $page - 1 : 1;
				?>
					<li><a href="?panel=produk&page=1">First</a></li>
					<li><a href="?panel=produk&page=<?php echo $link_prev; ?>">&laquo;</a></li>
				<?php
				}
				?>
				
				<!-- LINK NUMBER -->
				<?php
				// Buat query untuk menghitung semua jumlah data
				$queryNum = $db->query("SELECT COUNT(*) as postNum FROM produk");
				$resultNum = $queryNum->fetch_assoc();
				$rowCount = $resultNum['postNum'];
				
				$jumlah_page = ceil($rowCount / $limit); // Hitung jumlah halamannya
				$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
				$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
				$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
				
				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($page == $i)? ' class="active"' : '';
				?>
					<li <?php echo $link_active; ?>><a href="?panel=produk&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php
				}
				?>
				
				<!-- LINK NEXT AND LAST -->
				<?php
				// Jika page sama dengan jumlah page, maka disable link NEXT nya
				// Artinya page tersebut adalah page terakhir 
				if($page == $jumlah_page){ // Jika page terakhir
				?>
					<li class="disabled"><a href="#">&raquo;</a></li>
					<li class="disabled"><a href="#">Last</a></li>
				<?php
				}else{ // Jika Bukan page terakhir
					$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
				?>
					<li><a href="?panel=produk&page=<?php echo $link_next; ?>">&raquo;</a></li>
					<li><a href="?panel=produk&page=<?php echo $jumlah_page; ?>">Last</a></li>
				<?php
				}
				?>
			</ul>
				</div><!-- /.tab-content -->	
				</div><!-- /.tab-content -->	
				</div><!-- /.tab-content -->	
          </div> <!-- /.row -->
          </div> <!-- /.row -->
          </div> <!-- /.row -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>Anda akan menghapus satu url, prosedur ini tidak dapat diubah.</p>
                    <p>Apakah Anda ingin melanjutkan?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a href="#" class="btn btn-danger danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
        });
var hal = '<?=$page;?>';
function cariFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
if (keywords.length >= 2 || keywords.length == 0) {
    $.ajax({
        type: 'GET',
        url: 'panel/produk/getData.php',
        data:'page='+page_num+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#posts_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
}
 $('#clear').click(function () {
    $('#input-outer input').val('');
    $('#input-outer input').focus();
	cariFilter();
});
    </script>
<?php 
    break;

	case "print":
	include"cetak_produk.php";
    break;
	
	case "save":
	include"save_produk.php";
    break;
	
	case "edit":
	include"edit_data.php";
    break;
	case "hapus":
	$db->query("DELETE FROM produk WHERE id_produk='".$GETID."'");
	save_alert('delete',delete);
	htmlRedirect('?'.$mode.'='.$module);
    break;
	case "publish":
	if ($status=='Publish'){
	$db->query("UPDATE produk SET pub='Y' WHERE id_produk='".$GETID."'");
	save_alert('update',update);
	htmlRedirect('?'.$mode.'='.$module.'&page='.$page);
	}else{
	$db->query("UPDATE produk SET pub='N' WHERE id_produk='".$GETID."'");
	save_alert('update',update);
	htmlRedirect('?'.$mode.'='.$module.'&page='.$page);
	}
    break;
	case "featured":
	if ($status=='featured'){
	$db->query("UPDATE produk SET featured='Y' WHERE id_produk='".$GETID."'");
	save_alert('update',update);
	if($page!=''){
	htmlRedirect('?'.$mode.'='.$module.'&page='.$page);
	}else{
	htmlRedirect('?'.$mode.'='.$module);
	}
	}else{
	$db->query("UPDATE produk SET featured='N' WHERE id_produk='".$GETID."'");
	save_alert('update',update);
	if($page!=''){
	htmlRedirect('?'.$mode.'='.$module.'&page='.$page);
	}else{
	htmlRedirect('?'.$mode.'='.$module);
	}
	}
    break;
	}
?>	
	<!-- Form Modal Tambah Produk -->

		<div id="formproduk" class="modal fade" data-keyboard="false" data-backdrop="static">
		<div class="login-box">
		  <div class="login-box-body">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<p class="login-box-msg">Tambah Produk Baru </p>
			<form action="?panel=produk&act=save" method="post">
			<p class="margin"></p>
			<input type="hidden" name="idp" value="0">
			<input type="hidden" id="imgs" name="photo">
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk"/>
			  </div>
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" name="modal" placeholder="Modal Produk"/>
			  </div>
			  <div class="form-group has-feedback">
				<select name="id_jenis_produk" class="form-control">
				<option value="0" selected>Pilih jenis Produk</option>
				<?php $sql = $db->query("select * from jenis_produk order by produk asc");
				while($row=$sql->fetch_array()){
				echo '<option value="'.$row['id_jenis_produk'].'">'.$row['produk'].'</option>';
				}
				?>
				</select>
			  </div>
			  <div class="form-group has-feedback">
				<textarea type="text" class="form-control" name="keterangan" placeholder="Keterangan 1"></textarea>
			  </div>
<div class="row">
<div class="col-xs-6">  
			<div class="form-group has-feedback">
				<div id="imageup" onclick="oKCFinder(this)"><div style="margin:5px">Klik to Upload</div></div>
			</div>	
</div>			  
<div class="col-xs-6">    
			  <div class="form-group has-feedback">
			  <input type="text" class="form-control" name="harga_produk" placeholder="Harga Produk"/>
			  </div>
				<input type="text" class="form-control2" name="pub" value="Y" placeholder="Publish" style="width:49%">
				<input type="text" class="form-control2" name="hitung" value="N" placeholder="hitung" style="width:49%">
			  </div>
			</div>			
</div>			
					  

			  <div class="row">
				<div class="col-xs-6">    
					<button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
				</div><!-- /.col -->
				<div class="col-xs-6">
					<button class="btn btn-primary btn-block btn-danger btn-flat" data-dismiss="modal">Batal</button>                 
				</div><!-- /.col -->
			  </div>
			</form>
		  </div><!-- /.login-box-body -->
		</div><!-- /.login-box -->