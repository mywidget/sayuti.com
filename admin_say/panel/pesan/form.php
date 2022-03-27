<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
$sql = $db->query("SELECT * FROM `kotak_masuk`  WHERE id=$GETID");
$data=$sql->fetch_array();

	$judul 	= $data['judul'];
	$email	= $data['email'];
	$pesan 	= $data['pesan'];
	$tag	= $data['tag'];
	if($data['status']==1) {
		$cek3 = '<input type="radio" class="minimal" name="publish" value="Y" checked>';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="N">';
	} else{
		$cek3 = '<input type="radio" class="minimal" name="publish" value="Y">';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="N" checked>';
	}
$edit = $db->query("UPDATE `kotak_masuk` SET `status`=1 WHERE id='$GETID'");
}else{
	$judul 	= "";
	$email 	= "";
	$pesan	= "";
	$tag	= "";
	$cek3 = '<input type="radio" class="minimal" name="publish" value="1" checked>';
	$cek4 = '<input type="radio" class="minimal" name="publish" value="0">';
}

?>
<style>
li{list-style:none}
</style>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
					<form role="form" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save">
					<input type="hidden" name="id" value="<?=$GETID;?>">
                        <div class="col-md-8">
                            <div class="box">
								<div class="box box-primary">
                                <div class="box-header">
								<?php if($GETID > 0) { ?>
                                    <h3 class="box-title">Baca Pesan</h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input</h3>
									<?php } ?>
								<div class="pull-right box-tools">
									<?php if($GETID > 0) { ?>
                                <button type="submit" name="update" class="btn btn-primary">Kirim Balasan</button>
									<?php }else{ ?>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									<?php } ?>
								<a href="?<?=$mode;?>=<?=$module;?>" class="btn btn-danger">Batal</a>
                                </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                <div class="box-body">
								<div class='box-body pad'>
		<div class="form-group" style="display: block;">
			    <label class="control-label" for="judul_depan">Judul<span class="req"> *</span></label>
			    <div class="controls">
                <input id="judul_depan" class="form-control k-textbox" data-role="text" required="required" name="judul" data-parsley-errors-container="#errId1" type="text" value="<?=$judul;?>"><span id="errId1" class="error"></span></div>
                
		</div>
		<div class="form-group">
			    <label class="control-label" for="email">email<span class="req"> *</span></label>
			    <div class="controls">
                <input id="email" class="form-control" data-role="text" required="required" name="email" data-parsley-errors-container="#errId2" type="text" value="<?=$email;?>"><span id="errId2" class="error"></span></div>
                
		</div>
		<div class="form-group">
			    <label class="control-label" for="pesan">isi pesan<span class="req"></span></label>
			    <div class="controls">
				<textarea id="compose-textarea"  name="pesan" class="form-control" style="height: 200px"><?php echo $pesan; ?></textarea>      
				</div>
		</div>
                                </div>
								</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
						<!-- kanan -->
                        </div><!-- /.col -->
					</form>	
                    </div><!-- /.row -->                    
                </section><!-- /.content -->
<?php 
}
 ?>
