<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
error_reporting(0);
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{

$de= mysql_real_escape_string($_GET["id"]);
$result=mysql_query("select * from users where id_session='$de'");
$data = mysql_fetch_array($result);
$jumlah = mysql_num_rows($result);
if ($jumlah > 0){
	$username = $data['username'];
	$nama_lengkap = $data['nama_lengkap'];
	$no_hp = $data['no_telp'];
	$level = $data['level'];
	$email = $data['email'];

//form tambah data
} else {
	$username = "";
	$nama_lengkap = "";
	$email = "";
	$no_hp = "";
	$level = "";
}

?>
                        <div class="col-xs-12">
                            <div class="box">
								<div class="box box-primary">
                                <div class="box-header">
								<?php if($jumlah > 0) { ?>
                                    <h3 class="box-title">Edit Data User</h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input Data User</h3>
									<?php } ?>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="?module=user&act=save_user">
								<input type="hidden" name="id" value="<?=$de;?>">
                                    <div class="box-body">
									<?php if ($jumlah > 0){ ?>
                                        <div class="form-group">
                                            <label>Nama Pengguna</label>
                                            <input type="text" name="username" class="form-control" placeholder="Nama Pengguna" value="<?php echo $username; ?>" readonly="readonly">
                                        </div>
										<?php }else{ ?>
										<div class="form-group">
                                            <label for="username">Nama Pengguna</label>
                                            <input type="text" name="username" class="form-control" placeholder="Nama Pengguna" value="" required>
                                        </div>
										<?php } ?>
										<div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password Pengguna" value="">
                                        </div>
										<div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" class="form-control" placeholder="Nama Lengkap" required>
                                        </div>
										<div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email" required>
                                        </div>
										<div class="form-group">
                                            <label>No. Handphone</label>
                                            <input type="text" name="no_hp" value="<?php echo $no_hp; ?>" class="form-control" placeholder="No. Handphone">
                                        </div>
										<div class="form-group">
                                            <label>Status User</label>
										<input type="text" value="Demo User" class="form-control" readonly="readonly">
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<?php if($jumlah > 0) { ?>
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
									<?php }else{ ?>
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									<?php } ?>
										<a href="?module=home" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>
<?php 
}
 ?>