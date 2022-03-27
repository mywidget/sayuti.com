<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
$sql = $db->query("SELECT * FROM `info_service`  WHERE id=$GETID");
$data=$sql->fetch_array();

	$judulD 	= $data['judulD'];
	$judulM 	= $data['judul'];
	$subjudul 	= $data['sub_judul'];
	$isi		= $data['isi'];
	$tagmod		= $data['modul'];
	$class		= $data['class'];
	$icon		= $data['icon'];
	$pilihan_posisi = '';
	foreach ($iconsx as $status) {
	$_arrNilai = explode(',', $status);	
	$_ck = (array_search($icon, $_arrNilai) === false)? '' : 'checked';
	$pilihan_posisi .= "<label>";
	$pilihan_posisi .= '&nbsp;<i class="fa '.$status.'"></i>&nbsp;&nbsp;<input type=radio name="icon" class="minimal" value="'.$status.'" '.$_ck.'> ';
	$pilihan_posisi .= "</label>";
	}
	if($data['pub']=="Y") {
		$cek3 = '<input type="radio" class="minimal" name="publish" value="Y" checked>';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="N">';
	} else{
		$cek3 = '<input type="radio" class="minimal" name="publish" value="Y">';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="N" checked>';
	}
//form tambah data
} elseif($GETID = 0) {

}else{

	$judulD 	= "";
	$judulM 	= "";
	$subjudul 	= "";
	$isi		= "";
	$tagmod		= "";
	$class		= "";
	$icon		= "";
	$cek3 = '<input type="radio" class="minimal" name="publish" value="Y" checked>';
	$cek4 = '<input type="radio" class="minimal" name="publish" value="N">';
	$pilihan_posisi = '';
	foreach ($iconsx as $status) {
	$_arrNilai = explode(',', $status);	
	$_ck = (array_search($icons, $_arrNilai) === false)? '' : 'checked';
	$pilihan_posisi .= "<label>";
	$pilihan_posisi .= '<input type=radio name="icon" class="minimal" value="'.$status.'" '.$_ck.'> <i class="fa '.$status.'"></i>';
	$pilihan_posisi .= "</label>";
	}
}

?>
<style>
li{list-style:none}
</style>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
					<form role="form" method="POST" enctype="multipart/form-data" action="?<?=$mode;?>=<?=$module;?>&act=save">
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
			    <label class="control-label" for="judul_depan">Judul Depan<span class="req"> *</span></label>
			    <div class="controls">
                <input id="judul_depan" class="form-control k-textbox" data-role="text" required="required" name="judul_depan" data-parsley-errors-container="#errId1" type="text" value="<?=$judulD;?>"><span id="errId1" class="error"></span></div>
                
		</div>
		<div class="form-group">
			    <label class="control-label" for="judul_modal">Judul Modal<span class="req"> *</span></label>
			    <div class="controls">
                <input id="judul_modal" class="form-control k-textbox" data-role="text" required="required" name="judul_modal" data-parsley-errors-container="#errId2" type="text" value="<?=$judulM;?>"><span id="errId2" class="error"></span></div>
                
		</div>
		<div class="form-group">
			    <label class="control-label" for="sub_judul">Sub Judul Modal<span class="req"> *</span></label>
			    <div class="controls">
                <input id="sub_judul" class="form-control k-textbox" data-role="text" required="required" name="sub_judul" data-parsley-errors-container="#errId4" type="text" value="<?=$subjudul;?>"><span id="errId4" class="error"></span></div>
		</div>
		<div class="form-group">
			    <label class="control-label" for="isi">Isi Modal<span class="req"> *</span></label>
			    <div class="controls">
                <textarea id="edit" rows="3" class="form-control k-textbox" data-role="textarea" required="required" name="isi" data-parsley-errors-container="#errId5"><?=$isi;?></textarea><span id="errId5" class="error"></span></div>
                
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
			    <label class="control-label" for="tag_mod">Tag Mod<span class="req"> *</span></label>
			    <div class="controls">
                    
                <input id="tag_mod" class="form-control k-textbox" data-role="text" required="required" name="tag_mod" value="<?=$tagmod;?>" data-parsley-errors-container="#errId3" type="text"><span id="errId3" class="error"></span></div>
                
		</div>
		<div class="form-group">
			    <label class="control-label" for="class">Class Style Modal</label>
			    <div class="controls">
                <input id="class" value="<?=$class;?>" class="form-control k-textbox" data-role="text" name="class" data-parsley-errors-container="#errId6" type="text"><span id="errId6" class="error"></span></div>
                
		</div>
		<div class="form-group" style="display: block;">
		<?=$pilihan_posisi;?>
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
