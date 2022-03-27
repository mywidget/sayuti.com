<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// echo $GETID;
// $jumlah = $sql->num_rows;
if($GETID > 0) {
	$sql = $db->query("SELECT * FROM menu WHERE id=".$GETID);
	$data=$sql->fetch_array(); 
	$judul = $data['name'];
	$link = $data['link'];
	$class = $data['class'];
	$urutan = $data['global'];
	$parent_id = $data['parent_id'];
	$idmenu = $data['id'];
	
	if($data['status']==0) {
		$cek1 = '<input type="radio" name="aktif"  class="minimal" value="0" checked>';
		$cek2 = '<input type="radio" name="aktif"  class="minimal" value="1">';
	} else{
		$cek1 = '<input type="radio" name="aktif"  class="minimal" value="0">';
		$cek2 = '<input type="radio" name="aktif"  class="minimal" value="1" checked>';
	}
	if($data['sub_menu']==0) {
		$sub1 = '<input type="radio" name="sub"  class="minimal" value="0" checked>';
		$sub2 = '<input type="radio" name="sub"  class="minimal" value="1">';
	} else{
		$sub1 = '<input type="radio" name="sub"  class="minimal" value="0">';
		$sub2 = '<input type="radio" name="sub"  class="minimal" value="1" checked>';
	}

//form tambah data
} else {
	$judul = "";
	$link = "";
	$class = "";
	$urutan = "";
	$parent_id = 0;
	$idmenu = 0;
	$cek1 = '<input type="radio" name="aktif"  value="0" checked>';
	$cek2 = '<input type="radio" name="aktif"  value="1">';
	$sub1 = '<input type="radio" name="sub"  value="0" checked>';
	$sub2 = '<input type="radio" name="sub"  value="1">';
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
											<select name='idparent' class="form-control">
         <?php 
		 $tampil=$db->query("SELECT * FROM menu where parent_id='0'");
          if ($parent_id==0){
            echo "<option value=0 selected>Menu Utama</option>";
          }
          else {
            echo "<option value=0>Menu Utama</option>";
          }

          while($w=$tampil->fetch_array()){
            if ($parent_id==$w['id']){
              echo "<option value=$w[id] selected>$w[name]</option>";
            }
            else{
				if ($w['id']==$idmenu){
              	echo "<option value=0>-- Tanpa Parent --</option>";
				}
				else{
				echo "<option value=$w[id]>$w[name]</option>";	
				}
            }
				$subkategori=$db->query("SELECT * from menu WHERE parent_id=$w[id]");
				if ($idmenu==0){
				//echo "<option value=0 selected>- Pilih kategori -</option>";
				} 
				while($wx=$subkategori->fetch_array()){
				if ($wx['id']==$idmenu){
				echo "<option value=$wx[id]>&rarr;$wx[name]</option>";
				}else{
				echo "<option value=$wx[id]>&rarr;$wx[name]</option>";
				}
					}
          }
		  ?>
			</select>
                                        </div>
										<div class="form-group">
										<label>Link <?=$module;?></label>
                                            <input type="text" name="link" class="form-control" placeholder="Link <?=$module;?>" value="<?php echo $link; ?>">
                                        </div>
										<div class="form-group">
										<label>Class</label>
                                            <input type="text" name="class" class="form-control" value="<?php echo $class; ?>">
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
                                        <!-- radio -->
                                        <div class="form-group"> 
											<label>Aktif</label>
                                            <div class="">
                                                <label><?=$cek1;?> Ya</label>
                                                <label><?=$cek2;?> Tidak</label>
                                            </div>
                                        </div>
																				<div class="form-group"> 
											<label>Submenu</label>
                                            <div class="">
                                                <label><?=$sub1;?> Y</label>
                                                <label><?=$sub2;?> N</label>
                                            </div>
                                        </div>
										<div class="form-group"> 
											<label>Urutan</label>
                                            <input type="text" name="urutan" class="form-control" value="<?=$urutan;?>"/>
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