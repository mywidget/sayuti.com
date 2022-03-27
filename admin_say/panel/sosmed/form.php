<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
$sql = $db->query("SELECT * FROM `sosmed`  WHERE id=$GETID");
$data=$sql->fetch_array();

	$judul 	= $data['judul'];
	$link 	= $data['link'];
	$idkey	= $data['idkey'];
	$tag	= $data['tag'];
	if($data['publish']=="Y") {
		$cek3 = '<input type="radio" class="minimal" name="publish" value="Y" checked>';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="N">';
	} else{
		$cek3 = '<input type="radio" class="minimal" name="publish" value="Y">';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="N" checked>';
	}
//form tambah data
} elseif($GETID = 0) {

}else{
	$judul 	= "";
	$link 	= "";
	$idkey	= "";
	$tag	= "";
	$cek3 = '<input type="radio" class="minimal" name="publish" value="Y" checked>';
	$cek4 = '<input type="radio" class="minimal" name="publish" value="N">';
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
                                    <h3 class="box-title">Edit</h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input</h3>
									<?php } ?>
								<div class="pull-right box-tools">
									<?php if($GETID > 0) { ?>
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
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
			    <label class="control-label" for="judul_modal">Link<span class="req"> *</span></label>
			    <div class="controls">
                <input id="judul_modal" class="form-control" data-role="text" required="required" name="link" data-parsley-errors-container="#errId2" type="text" value="<?=$link;?>"><span id="errId2" class="error"></span></div>
                
		</div>
		<div class="form-group">
			    <label class="control-label" for="idkey">Key<span class="req"></span></label>
			    <div class="controls">
                <input id="idkey" class="form-control k-textbox" data-role="text" name="idkey" value="<?=$idkey;?>" data-parsley-errors-container="#errId3" type="text"><span id="errId3" class="error"></span></div>
                
		</div>
                                </div>
								</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
						<!-- kanan -->
						<div class="col-md-4">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
										<div class="panel box box-primary">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                        PENGATURAN
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="box-body">
                                    </div>
                                        <!-- radio -->
										<div class="box-body">
		<div class="form-group">
			    <label class="control-label" for="tag">Tag</label>
			    <div class="controls">
                <input id="tag" value="<?=$tag;?>" class="form-control k-textbox" data-role="text" name="tag" data-parsley-errors-container="#errId6" type="text"><span id="errId6" class="error"></span></div>
                
		</div>
                                        <div class="form-group"> 
                                             <label>Publish</label>
                                            <div class="">
												<label><?=$cek3;?>Ya</label>
												<label><?=$cek4;?>Tidak</label>
                                            </div>
                                        </div>
                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="box-footer ">
									<?php if($GETID > 0) { ?>
                                        <button type="submit" name="update" class="btn btn-primary pull-right">Update</button>
									<?php }else{ ?>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
									<?php } ?>
										<a href="?<?=$mode;?>=<?=$module;?>" class="btn btn-danger ">Batal</a>
                                    </div>
                                </div><!-- /.box-body -->
								
                            </div><!-- /.box -->
                        </div><!-- /.col -->
					</form>	
                    </div><!-- /.row -->                    
                </section><!-- /.content -->
<?php 
}
 ?>
