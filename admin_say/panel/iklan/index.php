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
    window.open('../kcfinder/browse.php?type=images&dir=images/promo',
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
// Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
//error_reporting(0);
//session_start();
// if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
// header('location:../index.php');
// }else{
switch($act){
  // Tampil List user
  default:

$notab='';	
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




          <!-- START CUSTOM TABS -->
          <div class="row">
            <div class="col-md-12">
						<div class="box">
						<div class='box-header with-border'>
						<div class="col-md-6">
							<h4 class='box-title'>Iklan - iklan</h4>
							<p>Masukan gambar iklan kedalam folder iklan, hapus yang tidak diinginkan </p>
						</div>						
						<div class="col-md-6">
							<div class="pull-right"><a href="#" onclick="openKCFinder(this)" class="btn btn-danger" title="Tambah Info">Tambah Iklan</a> 
							</div>
						</div>
						</div>
                               
						  <div class="box-body">
								<?php
								$files = glob("../upload/images/promo/*.*");
								$active="active";
								for ($i=0; $i<count($files); $i++) {
									$image = $files[$i];
									echo "<img height='150px' style='padding:10px' src='".$image."' alt='Random image'/>";
									}
								?>  
							</div><!-- /.box-body -->  
                            </div><!-- /.box -->
                  </div><!-- /.tab-pane -->

          </div> <!-- /.row -->
<?php 
    break;

	
	case "save":
	include"save_iklan.php";
    break;
	
	case "edit":
	include"edit_iklan.php";
    break;
	
	}
?>	
	<!-- Form Modal Tambah Produk -->

		<div id="forminfo" class="modal fade" data-keyboard="false" data-backdrop="static">
		<div class="login-box">
		  <div class="login-box-body">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<p class="login-box-msg">Tambah Iklan </p>
			<form action="?panel=produk&act=save" method="post">
			
			<div class="input-group" >
                    <input type="hidden" name="idp" value="0">
                    <input type="hidden" class="form-control" name="id_iklan" id="id_iklan">
				<p class="margin"></p>
				<div class="form-group has-feedback">
			  <label>Judul</label>
				<input type="text" class="form-control" name="judul" placeholder="Judul Iklan"/>
			  <label>Publish</label>
				<input type="text" class="form-control2" name="pub" value="Y" placeholder="Publish" style="width:49%">
			  </div>
			  </div>
			<div class="form-group has-feedback">
			  <label>Photo</label>
				<textarea name="photo" id="files" class="form-control" readonly="readonly" onclick="openKCFinder(this)">Link Photo (uk-min : 800x950 px)</textarea>
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


			

 