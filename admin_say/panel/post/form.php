<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
$sql = $db->query("SELECT * FROM posting WHERE id_post=$GETID");
$data=$sql->fetch_array();

	$judul = $data['judul'];
	$berita = $data['postingan'];
	$tanggal = tanggal($data['tanggal']);
	$jam 	= jam_update($data['tanggal']);
	$caption = $data['caption'];
	$thn = folderthn($data['folder']);
	$bln = folderbln($data['folder']);
	$gbr = $data['gambar'];
	$admin = $data['alias'];
	$link = $data['link_dl'];
	
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
	if(isset($_POST['submit'])):
    //membuat session array dengan variabel - variabel POST
    $_SESSION['postnews']=$_POST;
	endif;
	if(isset($_SESSION['postnews'])):
    $judul		= $_SESSION['postnews']['judul'];
    $berita		= $_SESSION['postnews']['postingan'];
    $caption	= $_SESSION['postnews']['caption'];
	else:
    $judul  ='';
    $berita	='';
    $caption	='';
	endif;
	$thn 	= "2015";
	$bln 	= "12";
    $gbr	='none.jpg';
	$tanggal 	= date("Y-m-d");
	$jam 		= date("H:i:s");
	$admin = $_SESSION['namalengkap'];
	$link = '';
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
					<form role="form" method="POST" enctype="multipart/form-data" action="?<?=$mode;?>=<?=$module;?>&act=save">
					<input type="hidden" name="id" value="<?=$GETID;?>">
                        <div class="col-md-8">
                            <div class="box">
								<div class="box box-primary">
                                <div class="box-header">
								<?php if($GETID > 0) { ?>
                                    <h3 class="box-title">Edit Berita</h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input Berita</h3>
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
                                        <div class="form-group">
                                            <label>Judul Berita</label>
                                            <input type="text" name="judul" class="form-control" placeholder="Judul Berita" value="<?php echo $judul; ?>">
                                        </div>
                                </div>
                                <div class='box-body pad'>
                                        <textarea id='edit' name='postingan' class="textarea" placeholder="Isi berita" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $berita; ?></textarea>                      
                                </div>
								<div class='box-body pad'>
								<div class="row">
								<div class="col-md-4">
 <div class="form-group">
								<label>Gambar</label>
<div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
    <img data-src="../images/post/<?=$thn.'/'.$bln.'/'.$gbr;?>" src="../images/post/<?=$thn.'/'.$bln.'/'.$gbr;?>" alt="...">
  </div>
  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
  <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="fupload"></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
</div>
</div>
								</div>
								<div class="col-md-8">
                                        <div class="form-group">
                                            <label>Caption Gambar</label>
                                            <textarea name="caption" class="textarea" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Caption Gambar"><?php echo $caption; ?></textarea> 
                                        </div>
										<div class="form-group">
										<label>Tag Berita</label>
										<select placeholder="Pilih Katakunci Atau Create" name="tag[]" class="selectize-control" id="chosen-tags" multiple>
										<?php echo tags3($GETID);?>
										<?php echo tags2();?>
										</select>
                                        </div>
								</div>
<div class="col-md-12">
 <div class="form-group">
                                            <label>Link Download</label>
                                            <input type="text" name="link" class="form-control" placeholder="link download" value="<?php echo $link; ?>">
                                        </div>
								</div>
								</div>

                                </div>
								</div>

                                </div><!-- /.box-body -->

                                    <div class="box-footer">
									<?php if($GETID > 0) { ?>
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
									<?php }else{ ?>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
									<?php } ?>
										<a href="?<?=$mode;?>=<?=$module;?>" class="btn btn-danger">Batal</a>
                                    </div>
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
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        RUBRIK 
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="box-body border-top">
                                                <div class="over">
                                                    <!-- text input -->
<?php
function checkbox($data, $parent = 0, $parent_id = 0, $Nilai='') {
static $i = 1;
$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
$tab = $i * 0 ;
if (isset($data[$parent])) {
$i++;
$html = "";
foreach ($data[$parent] as $v) {
$child = checkbox($data, $v['id_cat'], $parent_id, $Nilai);
//Edit Di Item

$_arrNilai = explode(',', $Nilai);
$_ck = (array_search($v['id_cat'], $_arrNilai) === false)? '' : 'checked';
$html .= '<div class="">';
$html .= ''.$ieTab .'<input type="checkbox" name="data[]" class="minimal" value="'.$v['id_cat'].'" '.$_ck.'>&nbsp;'.$v['nama_kategori'].'<br/>';
$html .= "</div>";
if ($child) { $i--; $html .= $child; }
}
return $html;
}
}
$res = $db->query("SELECT * FROM cat where aktif='Y'");
while($rowz=$res->fetch_assoc()){
$dataTz[$rowz['id_parent']][] = $rowz;
}
if($GETID > 0) {
$idcat = $data['id_cat'];
}else{
$idcat = 0;
}
echo checkbox($dataTz,0,0,$idcat);
?>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
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

										<div class="row">
										<div class="col-md-9">
										<div class="form-group">
                                            <label>Admin</label>
                                            <input type="text" name="admin" class="form-control" value="<?php echo $admin; ?>">
                                        </div>
										<label>Tanggal Publish</label>
										<div class="form-group">
										<div class="row">
										<div class="col-md-7">
										<input id="dp1" type="text" name="tanggal" value="<?php echo $tanggal; ?>" class="form-control">
										</div>
										<div class="col-md-5 bootstrap-timepicker">
										<input id="timepicker" class="form-control timepicker" type="text" name="jam" value="<?php echo $jam; ?>" class="form-control">
										</div>
										</div></div> 
										</div>
										</div>
                                    </div>
                                        <!-- radio -->
										<div class="box-body">
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
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
					</form>	
                    </div><!-- /.row -->                    
                </section><!-- /.content -->
<?php 
}
 ?>