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
$sql = $db->query("SELECT * FROM menuadmin WHERE idmenu=".$GETID);
	$data=$sql->fetch_array(); 
	$judul = $data['nama_menu'];
	$link = $data['link'];
	$treeview = $data['treeview'];
	$icon = $data['class'];
	$urutan = $data['urutan'];
	$id_level = $data['id_level'];
	
	if($data['aktif']=="Y") {
		$cek1 = '<input type="radio" name="aktif"  value="Y" checked>';
		$cek2 = '<input type="radio" name="aktif"  value="N">';
	} else{
		$cek1 = '<input type="radio" name="aktif"  value="Y">';
		$cek2 = '<input type="radio" name="aktif"  value="N" checked>';
	}
	if($data['level']=="admin") {
		$admin = '<input type="radio" name="level"  value="admin" checked>';
		$user = '<input type="radio" name="level"  value="user">';
	} else{
		$admin = '<input type="radio" name="level"  value="admin">';
		$user = '<input type="radio" name="level"  value="user" checked>';
	}
	if($data['classicon']=="Y") {
		$sub1 = '<input type="radio" name="sub"  value="Y" checked>';
		$sub2 = '<input type="radio" name="sub"  value="N">';
	} else{
		$sub1 = '<input type="radio" name="sub"  value="Y">';
		$sub2 = '<input type="radio" name="sub"  value="N" checked>';
	}
	$pilihan_status = array('admin', 'user','manager', 'kasir','supervisor','keuangan');
	$pilihan_posisi = '';
	foreach ($pilihan_status as $status) {
	$pilihan_posisi .= "<option value=$status";
	if ($status == $data['level']) {
	$pilihan_posisi .= " selected";}
	$pilihan_posisi .= ">$status</option>\r\n";}
//form tambah data
} else {
	$judul = "";
	$link = "";
	$treeview = "treeview";
	$icon = "";
	$urutan = "";
	$id_level = 0;
	$cek1 = '<input type="radio" name="aktif"  value="Y" checked>';
	$cek2 = '<input type="radio" name="aktif"  value="N">';
	$admin = '<input type="radio" name="level"  value="admin" checked>';
	$user = '<input type="radio" name="level"  value="user">';
	$sub1 = '<input type="radio" name="sub"  value="Y" checked>';
	$sub2 = '<input type="radio" name="sub"  value="N">';
	$pilihan_status = array('admin', 'user','manager', 'kasir','supervisor','keuangan');
	$pilihan_posisi = '';
	foreach ($pilihan_status as $status) {
	$pilihan_posisi .= "<option value=$status";
	if ($status == $pilihan_posisi) {
	$pilihan_posisi .= " selected";}
	$pilihan_posisi .= ">$status</option>\r\n";}
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
		 $tampil=$db->query("SELECT * FROM menuadmin where idparent='0'");
          if ($data['idparent']==0){
            echo "<option value=0 selected>Menu Utama</option>";
          }
          else {
            echo "<option value=0>Menu Utama</option>";
          }

          while($w=$tampil->fetch_array()){
            if ($data['idparent']==$w['idmenu']){
              echo "<option value=$w[idmenu] selected>$w[nama_menu]</option>";
            }
            else{
				if ($w['idmenu']==$data['idmenu']){
              	echo "<option value=0>-- Tanpa Parent --</option>";
				}
				else{
				echo "<option value=$w[idmenu]>$w[nama_menu]</option>";	
				}
            }
				$subkategori=$db->query("SELECT * from menuadmin WHERE idparent=$w[idmenu]");
				if ($data['idmenu']==0){
				//echo "<option value=0 selected>- Pilih kategori -</option>";
				} 
				while($wx=$subkategori->fetch_array()){
				if ($wx['idmenu']==$data['idmenu']){
				echo "<option value=$wx[idmenu]>&rarr;$wx[nama_menu]</option>";
				}else{
				echo "<option value=$wx[idmenu]>&rarr;$wx[nama_menu]</option>";
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
										<label>Class Tree Menu</label>
                                            <input type="text" name="treeview" class="form-control" placeholder="Class <?=$module;?>" value="<?php echo $treeview; ?>">
                                        </div>
										<div class="form-group"> 
											<label>Submenu</label>
                                            <div class="">
                                                <label><?=$sub1;?> Y</label>
                                                <label><?=$sub2;?> N</label>
                                            </div>
                                        </div>
										<div class="form-group">
										<label>Icon CLass Menu</label>
                                        </div>
										<div class="form-group">
										<label>
										<input type="radio" name="icon"  id="2" value="bars" checked> <i class="fa fa-bars" data-toggle="tooltip" title="Beranda Icon"></i>
										<input type="radio" name="icon"  id="1" value="user"> <i class="fa fa-user"data-toggle="tooltip" title="User icon"></i>
										<input type="radio" name="icon"  id="2" value="gear"> <i class="fa fa-gear"></i>
										<input type="radio" name="icon"  id="2" value="archive"> <i class="fa fa-archive"></i>
										<input type="radio" name="icon"  id="2" value="picture-o"> <i class="fa fa-picture-o"></i>
										<input type="radio" name="icon"  id="2" value="file-text-o"> <i class="fa fa-file-text-o"></i>
										<input type="radio" name="icon"  id="2" value="ticket"> <i class="fa fa-ticket"></i>
										<input type="radio" name="icon"  id="2" value="train"> <i class="fa fa-train"></i>
										<input type="radio" name="icon"  id="2" value="plane"> <i class="fa fa-plane"></i>
										<input type="radio" name="icon"  id="2" value="hotel "> <i class="fa fa-hotel "></i>
										<input type="radio" name="icon"  id="2" value="ship "> <i class="fa fa-ship "></i>
										<input type="radio" name="icon"  id="2" value="bar-chart "> <i class="fa fa-bar-chart" data-toggle="tooltip" title="Bar Chart Icon"></i>
										<input type="radio" name="icon"  id="2" value="area-chart "> <i class="fa  fa-area-chart" data-toggle="tooltip" title="Area Chart Icon"></i>
										<input type="radio" name="icon"  id="2" value="money "> <i class="fa  fa-money" data-toggle="tooltip" title="Money Icon"></i>
										<input type="radio" name="icon"  id="2" value="calendar "> <i class="fa  fa-calendar" data-toggle="tooltip" title="Calendar Icon"></i>
										<input type="radio" name="icon"  id="2" value="folder "> <i class="fa  fa-folder" data-toggle="tooltip" title="Folder Icon"></i>
										<input type="radio" name="icon"  id="2" value="cart-plus"> <i class="fa  fa-cart-plus" data-toggle="tooltip" title="Keranjang Belanja Icon"></i>
										<input type="radio" name="icon"  id="2" value="gears"> <i class="fa  fa-gears" data-toggle="tooltip" title="Gears Icon"></i>
										</label>
                                            
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
                   <label>Level Menu Akses</label>
                                                <div class="over">
                                                    <!-- text input -->
<?php
function checkbox($data, $parent = 0, $parent_id = 0, $Nilai='') {
static $i = 1;
$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
$tab = $i * 0 ;
if (isset($data[$parent])) {
$i++;
$html ='';
foreach ($data[$parent] as $v) {
$child = checkbox($data, $v['id_level'], $Nilai);
//Edit Di Item
$_arrNilai = explode(',', $Nilai);
$_ck = (array_search($v['id_level'], $_arrNilai) === false)? '' : 'checked';
$html .= '<div class="checkbox">';
$html .= ''.$ieTab .'<input type=checkbox name="data[]" class="minimal" value="'.$v['id_level'].'" '.$_ck.'>&nbsp;'.$v['nama'].'<br/>';
$html .= "</div>";
if ($child) { $i--; $html .= $child; }
}
return $html;
}
}

$resultz = $db->query("SELECT * FROM hak_akses");
while ($rowz = $resultz->fetch_assoc()) {
$dataTz[$rowz['id_parent']][] = $rowz;
}
echo checkbox($dataTz,0,0,$id_level);
?>
                                                </div>
                </div><!-- /.box-body -->
										<!--div class="form-group">
                                            <label>Level Akses</label>
											<select name="level" class="form-control">
											<?=$pilihan_posisi;?>
                                            </select>
                                        </div-->
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