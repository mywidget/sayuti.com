<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
// error_reporting(0);
// session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
$sql = $db->query("SELECT * FROM cat WHERE id_cat=".$GETID);
$data = $sql->fetch_array();
	$judul = $data['nama_kategori'];
	$id_cat = $data['id_cat'];
	$id_parent = $data['id_parent'];
	
	if($data['aktif']=="Y") {
		$cek1 = '<input type="radio" class="minimal" name="aktif"  value="Y" checked>';
		$cek2 = '<input type="radio" class="minimal" name="aktif"  value="N">';
	} else{
		$cek1 = '<input type="radio" class="minimal" name="aktif"  value="Y">';
		$cek2 = '<input type="radio" class="minimal" name="aktif"  value="N" checked>';
	}
//form tambah data
} else {
	$judul = "";
	$cek1 = '<input type="radio" class="minimal" name="aktif"  value="Y" checked>';
	$cek2 = '<input type="radio" class="minimal" name="aktif"  value="N">';
	$id_cat=0;
	$id_parent=0;
}
?>
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
                                    <h3 class="box-title">Edit <?=$module;?></h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input <?=$module;?></h3>
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
                                            <label>Judul <?=$module;?></label>
                                            <input type="text" name="judul" class="form-control" placeholder="Judul <?=$module;?>" value="<?php echo $judul; ?>">
                                            <label>Kategori Utama</label>
											<select name='id_parent' class="form-control">
         <?php 
		 $tampil=$db->query("SELECT * FROM cat where id_parent='0'");
          if ($id_parent==0){
            echo "<option value=0 selected>Menu Utama</option>";
          }
          else {
            echo "<option value=0>Menu Utama</option>";
          }

          while($w=$tampil->fetch_array()){
            if ($id_parent==$w['id_cat']){
              echo "<option value=$w[id_cat] selected>$w[nama_kategori]</option>";
            }
            else{
				if ($w['id_cat']==$id_cat){
              	echo "<option value=0>-- Tanpa Parent --</option>";
				}
				else{
				echo "<option value=$w[id_cat]>$w[nama_kategori]</option>";	
				}
            }
				$subkategori=$db->query("SELECT * from cat WHERE id_parent='$w[id_cat]'");
				if ($id_cat==0){
				//echo "<option value=0 selected>- Pilih kategori -</option>";
				} 
				while($wx=$subkategori->fetch_array()){
				if ($wx['id_cat']==$id_cat){
				echo "<option value=$wx[id_cat]>&rarr;$wx[nama_kategori]</option>";
				}else{
				echo "<option value=$wx[id_cat]>&rarr;$wx[nama_kategori]</option>";
				}
					}
          }
		  ?>
			</select>
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
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        Info <?=$module;?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="box-body">
                                                    <!-- text input -->
                                        <div class="form-group">
                                            <label>Author</label>
                                            <input type="text" class="form-control" value="<?php echo"$_SESSION[namauser]"; ?>"/>
                                        </div>
                                        <!-- radio -->
                                        <div class="form-group"> 
											<label>Aktif</label>
                                            <div class="">
                                                <label><?=$cek1;?>Ya</label>
                                                <label><?=$cek2;?>Tidak</label>
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