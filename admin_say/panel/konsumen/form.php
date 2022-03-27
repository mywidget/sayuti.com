<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
error_reporting(0);
// session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
$result=$db->query("select * from tb_resell where id='$GETID'");
$data = $result->fetch_array();
$jumlah = $result->num_rows;
if ($jumlah > 0){
	$id = $data['id'];
	$nama = $data['nama'];
	$telp = $data['nohp'];
	$alamat = $data['alamat'];
	$email = $data['email'];
	
//form tambah data
} else {
	$nama = "";
	$telp = "";
	$alamat = "";
	$email = "";
}

?>
                        <div class="row">
                                <form role="form" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save">
                        <div class="col-md-6">
                            <div class="box">
								<div class="box-header">
								<?php if($jumlah > 0) { ?>
                                    <h3 class="box-title">Edit Data Konsumen</h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input Data User</h3>
									<?php } ?>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<input type="hidden" name="id" value="<?=$id;?>">
                                    <div class="box-body">
									<?php if ($jumlah > 0){ ?>
                                        <div class="form-group">
                                            <label for="username">Nama Konsumen</label>
                                            <input type="text" name="nama" class="form-control" id="username" placeholder="Nama Konsumen" value="<?php echo $nama; ?>" >
                                        </div>
										<div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="password Konsumen" value="" >
                                        </div>
										<?php }else{ ?>
										<div class="form-group">
                                            <label for="username">Nama Konsumen</label>
                                            <input type="text" name="nama" class="form-control" id="username" placeholder="Nama Konsumen" value="" required>
                                        </div>
										<?php } ?>
										<div class="form-group">
                                            <label for="nama_lengkap">Telp Konsumen </label>
                                            <input type="text" name="telp" value="<?php echo $telp; ?>" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required>
                                        </div>
						
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<?php if($jumlah > 0) { ?>
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
									<?php }else{ ?>
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									<?php } ?>
										<a href="?<?=$mode;?>=<?=$module;?>" class="btn btn-danger">Batal</a>
                                    </div>
                               
                            </div><!-- /.box -->
                        </div>
								<div class="col-md-6">
								<div class="box">
									<div class="box-body">
										<div class="form-group">
                                            <label for="email">Email Konsumen</label>
                                            <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" id="email" placeholder="Email" required>
                                        </div>	
										<div class="form-group">
											<label for="nama_lengkap">Alamat</label>
                                            <textarea name="alamat1" class="form-control" rows="2" placeholder="Jalan/Komplek/Kampung"><?php echo $alamat; ?></textarea>
										</div>
									</div>
								</div>
								</div><!-- /.col -->

 </form>
            </div><!-- /.col (left) -->
<?php 
 } ?>