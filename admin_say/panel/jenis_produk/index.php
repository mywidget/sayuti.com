<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript">

function openKCFinder(textarea) {
    window.KCFinder = {
        callBackMultiple: function(files) {
            window.KCFinder = null;
            textarea.value = "";
            for (var i = 0; i < files.length; i++)
                textarea.value += files[i] + "#\n";
        }
    };
    window.open('../kcfinder/browse.php?type=images&dir=images/produk',
        'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}

</script>
<style type="text/css">
#files {
    height: 100px;
    cursor: pointer
}

</style>
<?php
switch($act){
  // Tampil List user
  default:

$notab='';	


$sqlu = $db->query("select level from user where id_user = '$_SESSION[iduser]'");
$rowuser = $sqlu->fetch_array();
$level = $rowuser['level'];
//echo $level;

if(isset($_POST['cari'])){
	$cari=$_POST['cari'];
	echo $cari;
}else{
	$cari="";
}
if(isset($_GET['id_jenis_produk'])){
	$id=$_GET['id_jenis_produk'];
}



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

	

          <!-- START CUSTOM TABS -->
          <div class="row">
            <div class="col-md-12">
						<div class="box">
						<div class="col-md-6">
						<div class='box-header'>
							<h4 class='box-title'>Jenis Produk</h4>
						</div>
						</div>
<div class="col-md-6">
<div class="box-header">
<a href="#" data-toggle="modal" data-target="#formproduk"  class="btn btn-danger pull-right"   title="Tambah Produk">Tambah Jenis Produk</a> 
</div>
</div>
                               
						  <div class="box-body">
								<table id="user" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center" style="width:2% !important">ID</th>
											<th class="text-center" style="width:15% !important">Produk</th>
											<th class="text-center" style="width:35% !important">Keterangan</th>
											<th class="text-center" style="width:5% !important">Publish</th>
											<th class="text-center" style="width:5% !important">Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php
									
									$sql = $db->query("SELECT * FROM jenis_produk order by id_jenis_produk");
									$nom=1;
									while($row=$sql->fetch_array()){
									?>
										<tr>
											<td class="text-center"><?php echo $nom;?></td>
											<td class="text-left"><?php echo $row['produk'];?></td>
											<td class="text-left"><?php echo $row['keterangan'];?></td>
											<td ><?php echo $row['pub'];?></td>
											<td >
											<a href="?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['id_jenis_produk'];?>&notab=<?=$notab;?>" title="Rubah Produk">	<i class="fa fa-edit"></i> Edit</a></td>
										</tr>
									<?php $_SESSION['bar'] = $nom; $nom++; }									
									   ?>
									</tbody>
								</table>
							</div><!-- /.box-body -->  
                            </div><!-- /.box -->
                  </div><!-- /.tab-pane -->

          </div> <!-- /.row -->
<?php 
    break;

	case "print":
	include"cetak_produk.php";
    break;
	
	case "save":
	include"save_jenis_produk.php";
    break;
	
	case "edit":
	include"edit_data_jenis.php";
    break;
	
	}
?>	
	<!-- Form Modal Tambah Produk -->

		<div id="formproduk" class="modal fade" data-keyboard="false" data-backdrop="static">
		<div class="login-box">
		  <div class="login-box-body">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<p class="login-box-msg">Tambah Jenis Produk Baru </p>
			<form action="?panel=jenis_produk&act=save" method="post">
			
			<div class="input-group" >
                    <input type="hidden" name="idp" value="0">
					<input type="hidden" name="save" value="insert">
					<div class="input-group-btn">
                      <button type="button" class="btn btn-danger">Jenis Produk</button>
                    </div><!-- /btn-group -->
                    <input type="text" class="form-control" name="produk" id="produk" style="height:34px">
            </div><!-- /input-group -->
			<p class="margin"></p>
			  <div class="form-group has-feedback">
				<textarea type="text" class="form-control" name="keterangan" placeholder="keterangan" id="keterangan"></textarea>
			  </div>
				<input type="text" class="form-control2" name="pub" value="Y" placeholder="Publish" style="width:49%">
			  </div>
			<div class="form-group has-feedback">
			<label>Link Photo (uk-min : 800x950 px)</label>
				<textarea name="photo" id="files" class="form-control" readonly="readonly" onclick="openKCFinder(this)"></textarea>
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
		</div>


			

 