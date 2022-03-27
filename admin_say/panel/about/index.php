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
    window.open('../kcfinder/browse.php?type=images&dir=images/about',
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
if ($chek=='puser'){ include "login.php"; }
switch($act){
  // Tampil List user
  default:

$notab='';	

$sql=$db->query("select * from page where id_page='1'");
$row=$sql->fetch_array();

?>

  <div class="box box-primary">
	<div class='box-header with-border'>
						<div class="col-md-6">
							<h4 class='box-title'>About Us</h4>
							<p>Masukan photo untuk slide ke dalam folder about, hapus yang tidak diinginkan<br>
							Ukuran Maximal 600px</p>
						</div>						
						<div class="col-md-6">
							<div class="pull-right"><a href="#" onclick="openKCFinder(this)" class="btn btn-danger" title="Tambah Info">Tambah Photo Slide</a> 
							</div>
						</div>
						</div>
						<div class="box-body">
						<form role="form" id="myform" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save">
										<div class="form-group">
										 <label for="email">Link Photo <code>uk-min : 800x950 px</code></label>
											<textarea name="photo" id="files" class="form-control" readonly="readonly" onclick="openKCFinder(this)" placeholder="Pilih Photo"><?=$row['photo'];?></textarea>
										</div>
						<input type="hidden" name="id_page" value="<?=$row['id_page'];?>">
						<div class="form-group">
							<textarea id="compose-textarea"  name="isi" class="form-control" style="height: 300px">
							<?=$row['isi'];?>
							</textarea>
						</div>

         </div>
		 
		<div class="box-footer">
			<input type="submit" class="btn btn-primary" value="Simpan">
		</div>
       </div>
	 </form>  
<?php 
    break;

	
	case "save":
	include"save_page.php";
    break;
	
}
?>	

 