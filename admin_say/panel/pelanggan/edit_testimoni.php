<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
// error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
$result=$db->query("select * from testimoni where id='$GETID'");
$jumlah = $result->num_rows;
if ($jumlah > 0){
$data = $result->fetch_array();
	$id = $data['id'];
	$judul = $data['judul'];
	$nama = $data['client'];
	$company = $data['company'];
	$isi = $data['isi'];
	$photo = $data['photo'];
	$pub = $data['pub'];
	$tanggal = tanggal($data['tanggal']);
	$jam 	= jam_update($data['tanggal']);
//form tambah data
}else{
	$id = "";
	$judul = "";
	$nama = "";
	$company = "";
	$isi = "";
	$photo = "";
	$pub = "";
	$tanggal 	= date("Y-m-d");
	$jam 		= date("H:i:s");
}

?>
                        <div class="row">
                                <form role="form" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save">
                        <div class="col-md-6">
                            <div class="box">
								<div class="box-header">								
                                    <h3 class="box-title">Edit Testimoni</h3>									
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<input type="hidden" name="id" value="<?=$GETID;?>">
								<div class="box-body">
                                        <div class="form-group">
                                            <label for="username">Judul</label>
                                            <input type="text" name="judul" class="form-control" id="judul" placeholder="Kode judul" value="<?php echo $judul; ?>">
                                        </div>
										<div class="form-group">
                                            <label for="username">Isi Testimoni</label>
                                            <textarea name="isi" class="form-control k-textbox" id="compose-textarea" placeholder="isi" required><?php echo $isi; ?></textarea>
                                        </div>
																			
									 <div class="form-group">
										<div class="form-group">
                                            <label for="email">Publish</label>
											<select name="pub" class="form-control">
											<?php if($pub=='Y'){ ?>
											<option value="Y" selected >Ya</option>
											<option value="N">Tidak</option>
											<?php }else{ ?>
											<option value="Y">Ya</option>
											<option value="N" selected >Tidak</option>
											<?php	} ?>
											</select>
                                        </div>	
                                    </div>	
																		
                                    </div><!-- /.box-body -->
                                    </div>	
                                    </div>	
									<div class="col-md-6">
									<div class="box">
									<div class="box-body">
										<div class="form-group">
                                            <label for="nama">Nama Konsumen</label>
                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="" value="<?php echo $nama; ?>">
                                        </div>
										<div class="form-group">
                                            <label for="company">Nama Perusahaan</label>
                                            <input type="text" name="company" class="form-control" id="company" placeholder="" value="<?php echo $company; ?>">
                                        </div>
										<div class="form-group">
										 <label for="email">Link Photo <code>uk-min : 800x950 px</code></label>
											<textarea name="photo" id="files" class="form-control" readonly="readonly" onclick="openKCFinder(this)" placeholder="Pilih Photo"><?php echo $photo; ?></textarea>
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
										</div>
										</div>
                                      </div>	
										
										<div class="box-footer">
									<?php if($jumlah > 0) { ?>
                                        <input type="submit" name="save" class="btn btn-primary" value="update">
									<?php }else{ ?>
                                        <input type="submit" name="save" class="btn btn-primary" value="Simpan">
									<?php } ?>
										<a href="?<?=$mode;?>=<?=$module;?>" class="btn btn-danger">Batal</a>
                                    </div>
																				
								</div>
								</div>
 </form>
								</div><!-- /.col -->

<?php 
 } ?>