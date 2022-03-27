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
    window.open('../kcfinder/browse.php?type=images&dir=images/pelanggan',
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

$sql=$db->query("select * from page where id_page='1'");
$row=$sql->fetch_array();
?>

  <div class="box box-primary">
	<div class='box-header with-border'>
						<div class="col-md-6">
							<h4 class='box-title'>Pelanggan</h4>
							<p>Masukan Logo/photo pelanggan ke dalam folder pelanggan, hapus yang tidak diinginkan<br>
							Ukuran Maximal 100px</p>
						</div>						
						<div class="col-md-6">
							<div class="pull-right"><a href="#" onclick="openKCFinder(this)" class="btn btn-danger" title="Tambah Pelanggan">Tambah Logo/Photo Pelanggan</a> 
							</div>
						</div>
						</div>
						<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data Klien</h3>     
										<a href="?<?=$mode;?>=<?=$module;?>&act=edit&id=0" class="btn btn-danger pull-right" title="Tambah Info">Tambah Klien</a> 
                                </div><!-- /.box-header -->
						<div class="box-body">

								<table id="table1" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center" style="width:6% !important">No.</th>
											<th class="text-left" style="width:15% !important">Nama Konsumen</th>
											<th class="text-left" style="width:35% !important">Isi Testimoni</th>
											<th class="text-left" style="width:15% !important">Photo</th>
											<th class="text-center" style="width:5% !important">Publish</th>
											<th class="text-center" style="width:5% !important">Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$sql = $db->query("SELECT * FROM testimoni  order by id ASC");
									$nom=1;
									while($row=$sql->fetch_array()){
									?>
										<tr>
											<td class="text-center"><?php echo $nom;?></td>
											<td class="text-left"><?php echo $row['judul'];?></td>
											<td class="text-left"><?php echo $row['isi'];?></td>
											<td ><img width="80px" src="<?php echo $row['photo'];?>"></td>
											<td class="text-center"><?php echo $row['pub'];?></td>
											<td class="text-center">
											<a href="?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['id'];?>"><i class="fa fa-edit"></i> &nbsp;&nbsp;
											<a href="?<?=$mode;?>=<?=$module;?>&act=hapus&id=<?=$row['id'];?>"><i class="fa fa-trash"></i>
											</a></td>
										</tr>
									<?php  $nom++; }
									   ?>
									</tbody>
								</table>
							</div><!-- /.box-body -->  
         </div>
       </div>
	 </form>  
<?php 
    break;

	case "edit":
	include"edit_testimoni.php";
    break;
	
	case "save":
	include"save_testimoni.php";
    break;	
	
	case "hapus":
	$del = $db->query("DELETE FROM testimoni WHERE id='$GETID'");
	if($del){
	save_alert('delete',delete);
	}else{
	save_alert('delete','gagal');
	}
	htmlRedirect('?'.$mode.'='.$module);
    break;
	
}
?>	