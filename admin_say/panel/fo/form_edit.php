<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
$sql = $db->query("SELECT * FROM `fo`  WHERE id=".$GETID);
$data=$sql->fetch_array();

	$slug 	= $data['slug'];
	$active = $data['active'];
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$nama = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
	$gambar = $var[0]->gambar;
	// $app_id = $var[0]->app_id;
	if($data['pub']==0) {
		$cek3 = '<input type="radio" class="minimal" name="publish" value="0" checked>';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="1">';
	} else{
		$cek3 = '<input type="radio" class="minimal" name="publish" value="0">';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="1" checked>';
	}
}else{
	$nama 	= "";
	$namap 	= "";
	$telp	= "";
	$slug	= "";
	$active	= "";
	$cek3 = '<input type="radio" class="minimal" name="publish" value="0" checked>';
	$cek4 = '<input type="radio" class="minimal" name="publish" value="1">';
}

?>
<style>
li{list-style:none}
</style>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
					<form role="form" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save&url=<?=$url;?>">
					<input type="hidden" name="id" value="<?=$GETID;?>">
                        <div class="col-md-12">
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
								<div class="col-md-6">
		<div class="form-group" style="display: block;">
			    <label class="control-label">Nama FO<span class="req"> *</span></label>
			    <div class="controls">
                <input class="form-control" required="required" name="nama"  type="text" value="<?=$nama;?>"></div>
		</div>
		<div class="form-group">
			    <label class="control-label">Panggilan<span class="req"> *</span></label>
			    <div class="controls">
                <input class="form-control"  required="required" name="namap"  type="text" value="<?=$namap;?>">
				</div>
		</div>
                                        <div class="form-group"> 
                                             <label>Publish</label>
                                            <div class="">
												<label><?=$cek3;?>Ya</label>
												<label><?=$cek4;?>Tidak</label>
                                            </div>
                                        </div>
                                </div>
								
<div class="col-md-6">
		<div class="form-group" style="display: block;">
			    <label class="control-label">No.Telp<span class="req"> *</span></label>
			    <div class="controls">
                <input class="form-control" required="required" name="telp"  type="text" value="<?=$telp;?>"></div>
		</div>
		<div class="form-group">
			    <label class="control-label">Gambar<span class="req"> *</span></label>
			    <div class="controls">
                <input class="form-control"  required="required" name="gambar"  type="text" value="<?=$gambar;?>">
				</div>
		</div>
<div class="row">
<div class="col-md-6">
		<div class="form-group">
			    <label class="control-label">Active</label>
			    <div class="controls">
                <input class="form-control"   name="active"  type="text" value="<?=$active;?>">
				</div>
		</div>
		</div>
<div class="col-md-6">
		<div class="form-group">
			    <label class="control-label">Slug</label>
			    <div class="controls">
                <input class="form-control"   name="slug"  type="text" value="<?=$slug;?>">
				</div>
		</div>
		</div>
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
