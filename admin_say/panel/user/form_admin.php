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
$result=$db->query("select * from user where id_session='$GETIDSES'");
$data = $result->fetch_array();
$jumlah = $result->num_rows;
if ($jumlah > 0){
	$username = $data['username'];
	$nama_lengkap = $data['nama'];
	$no_hp = $data['no_hp'];
	$email = $data['email'];
	$id_session = $data['id_user'];
	$avatar = $data['foto'];
	$idmenu = $data['idmenu'];
	$aktif = $data['aktif'];
	
//form tambah data
} else {
	$aktif = 'Y';
	$username = "";
	$nama_lengkap = "";
	$email = "";
	$no_hp = "";
	$avatar = "/travel/upload/images/user/avatar04.png";
	$idmenu = 0;
	
}

?>
                        <div class="row">
                                <form role="form" method="POST" action="?panel=user&act=save">
                        <div class="col-md-6">
                            <div class="box">
								<div class="box-header">
								<?php if($jumlah > 0) { ?>
                                    <h3 class="box-title">Edit Data User</h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input Data User</h3>
									<?php } ?>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<input type="hidden" name="id" value="<?=$id_session;?>">
								<input type="hidden" name="ids" value="<?=$GETIDSES;?>">
                                    <div class="box-body">
									<?php if ($jumlah > 0){ ?>
                                        <div class="form-group">
                                            <label for="username">Nama Pengguna</label>
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Nama Pengguna" value="<?php echo $username; ?>" readonly="readonly">
                                        </div>
										<?php }else{ ?>
										<div class="form-group">
                                            <label for="username">Nama Pengguna</label>
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Nama Pengguna" value="" required>
                                        </div>
										<?php } ?>
										<div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password Pengguna" value="">
                                        </div>
										<div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required>
                                        </div>
										<div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" id="email" placeholder="Email" required>
                                        </div>
										<div class="form-group">
                                            <label for="no_hp">No. Handphone</label>
                                            <input type="text" name="no_hp" value="<?php echo $no_hp; ?>" class="form-control" id="no_hp" placeholder="No. Handphone">
                                        </div>
										<div class="form-group">
                                            <label for="no_hp">Avatar</label>
                                            <input type="text" name="avatar" value="<?php echo $avatar; ?>" onclick="openKCFinder(this)" class="form-control" id="no_hp" placeholder="Klik untuk Avatar" readonly="readonly" style="cursor:pointer">
                                        </div>
                                        <div class="form-group"> 
                                            <div class="">
                                                <label>
										<?php if($data['level']=="admin") { ?>
										<input type="radio" name="blokir" value="Y" class="minimal" checked readonly> Aktif Y
										<?php }else{ ?>
										<?php if($aktif=="Y") { ?>
                                                    <input type="radio" name="blokir" id="optionsRadios1" value="N" class="minimal">
                                                    Aktif N
                                                    <input type="radio" name="blokir" id="optionsRadios2" class="minimal" value="Y" checked>
                                                    Aktif Y
										<?php }else{ ?>
													<input type="radio" class="minimal" name="blokir" id="optionsRadios1" value="N" checked>
                                                    Aktif N
                                                    <input type="radio" class="minimal" name="blokir" id="optionsRadios2" value="Y">
                                                    Aktif Y
										<?php }}?>
                                                </label>
                                            </div>
                                        </div>
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<?php if($jumlah > 0) { ?>
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
									<?php }else{ ?>
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									<?php } ?>
										<a href="?panel=user" class="btn btn-danger">Batal</a>
                                    </div>
                               
                            </div><!-- /.box -->
                        </div>
            <div class="col-md-6">

              <div class="box box-danger">
			  
                <div class="box-header">
                  <h3 class="box-title">Akses Level Menu</h3>
                </div>
                <div class="box-body">
                                                <div class="over-user">
                                                    <!-- text input -->
<?php
function checkbox($data, $parent = 0, $parent_id = 0, $Nilai='') {
	global $db;
static $i = 1;
$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
$tab = $i * 0 ;
if (isset($data[$parent])) {
$i++;
$html ='';
foreach ($data[$parent] as $v) {
$child = checkbox($data, $v['idmenu'], $parent_id, $Nilai);
//Edit Di Item

$_arrNilai = explode(',', $Nilai);
$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : 'checked';
$html .= '<div class="checkbox">';
$html .= ''.$ieTab .'<input type=checkbox name="data[]" class="minimal" value="'.$v['idmenu'].'" '.$_ck.'>&nbsp;'.$v['nama_menu'].'<br/>';
$html .= "</div>";
if ($child) { $i--; $html .= $child; }
}
return $html;
}
}

$resultz = $db->query("SELECT * FROM menuadmin order by urutan");
while ($rowz = $resultz->fetch_assoc()) {
$dataTz[$rowz['idparent']][] = $rowz;
}
echo checkbox($dataTz,0,0,$idmenu);
?>
                                                </div>
										<div class="form-group">
                                            <label>Level User</label>
  <select name='level' class="form-control">
  <?php
  $tampil=$db->query("SELECT * FROM hak_akses ORDER BY nama");
  if ($data['level']==0){
  echo "<option value=0 selected>Pilih Level Akses</option>"; }   
  while($w=$tampil->fetch_array()){
  if ($data['level']==$w['level']){
  echo "<option value=$w[level] selected>$w[nama]</option>";}
  else{
  echo "<option value=$w[level]>$w[nama]</option>";}}
?>
</select>
                                        </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

 </form>
            </div><!-- /.col (left) -->
                    </div>
<?php 
 } ?>