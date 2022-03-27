<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
$sql = $db->query("SELECT * FROM `kantor`  WHERE id=$GETID");
$data=$sql->fetch_array();
	$disabled 	= "disabled";
	$kode	= $data['kode_kantor'];
	$nama_kantor	= $data['nama_kantor'];
	$alamat	= $data['alamat'];
	$tlp	= $data['tlp'];
	$email	= $data['email'];
	$map	= $data['map'];
	// $photo	= $data['photo'];
	if($data['pub']==0) {
		$cek3 = '<input type="radio" class="minimal" name="publish" value="0" checked>';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="1">';
	} else{
		$cek3 = '<input type="radio" class="minimal" name="publish" value="0">';
		$cek4 = '<input type="radio" class="minimal" name="publish" value="1" checked>';
	}
//form tambah data
} elseif($GETID = 0) {

}else{
	$disabled 	= "";
	$kode 	= "";
	$nama_kantor 	= "";
	$alamat 	= "";
	$tlp		= "";
	$email		= "";
	$map		= "";
	$cek3 = '<input type="radio" class="minimal" name="publish" value="0" checked>';
	$cek4 = '<input type="radio" class="minimal" name="publish" value="1">';
}

?>
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
    height: 130px;
    cursor: pointer
}

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
		<div class="col-md-6">
		<div class="form-group" style="display: block;">
			    <label class="control-label" for="judul_depan">Kode Kantor<span class="req"> *</span></label>
			    <div class="controls">
                <input id="judul_depan" class="form-control k-textbox" data-role="text" required="required" name="kode" data-parsley-errors-container="#errId1" type="text" value="<?=$kode;?>" <?=$disabled;?>><span id="errId1" class="error"></span></div>
                
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group" style="display: block;">
			    <label class="control-label" for="judul_depan">Nama Kantor<span class="req"> *</span></label>
			    <div class="controls">
                <input id="judul_depan" class="form-control k-textbox" data-role="text" required="required" name="nama" data-parsley-errors-container="#errId1" type="text" value="<?=$nama_kantor;?>"><span id="errId1" class="error"></span></div>
                
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group" style="display: block;">
			    <label class="control-label" for="judul_depan">Tlp Kantor<span class="req"> *</span></label>
			    <div class="controls">
                <input id="judul_depan" class="form-control k-textbox" data-role="text" required="required" name="tlp" data-parsley-errors-container="#errId1" type="text" value="<?=$tlp;?>"><span id="errId1" class="error"></span></div>
                
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group" style="display: block;">
			    <label class="control-label" for="judul_depan">Email Kantor<span class="req"> *</span></label>
			    <div class="controls">
                <input id="judul_depan" class="form-control k-textbox" data-role="text" required="required" name="email" data-parsley-errors-container="#errId1" type="text" value="<?=$email;?>"><span id="errId1" class="error"></span></div>
                
		</div>
		</div>
		<div class="form-group">
			    <label class="control-label" for="isi">Alamat kantor<span class="req"> *</span></label>
			    <div class="controls">
                <textarea id="compose-textarea" rows="3" class="form-control k-textbox" data-role="textarea" required="required" name="alamat" data-parsley-errors-container="#errId5"><?=$alamat;?></textarea><span id="errId5" class="error"></span></div>
		</div>
		<div class="form-group">
			    <label class="control-label" for="isi">Map kantor<span class="req"> *</span></label>
			    <div class="controls">
                <textarea rows="3" class="form-control" required="required" name="map" ><?=$map;?></textarea><span id="errId5" class="error"></span></div>
		</div>

                                </div>
								</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
						<!-- kanan -->
						<div class="col-md-4">
                            <div class="box">
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
										<div class="panel box-primary">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                   PENGATURAN
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                        <!-- radio -->
										<div class="form-group">
										 <label for="email">Link Photo <code>uk-min : 800x950 px</code></label>
											<textarea name="photo" id="files" class="form-control" readonly="readonly" onclick="openKCFinder(this)" placeholder="Pilih Photo"><?=$photo;?></textarea>
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

                                </div><!-- /.box-body -->
								
                            </div><!-- /.box -->
                        </div><!-- /.col -->
					</form>	
                    </div><!-- /.row -->                    
                </section><!-- /.content -->
<?php 
}
 ?>
