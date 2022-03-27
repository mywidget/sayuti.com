<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
$result=$db->query("select * from info where id_info='$GETID'");
$data = $result->fetch_array();
$jumlah = $result->num_rows;
if ($jumlah > 0){
	$id_info = $data['id_info'];
	$judul = $data['judul'];
	$isi = $data['isi'];
	$photo = $data['photo'];
	$pub = $data['pub'];
//form tambah data
}else{
	$id_info = "";
	$judul = "";
	$isi = "";
	$photo = "";
	$pub = "";
}

?>
                        <div class="row">
                                <form role="form" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save">
                        <div class="col-md-6">
                            <div class="box">
								<div class="box-header">								
                                    <h3 class="box-title">Edit Info</h3>									
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<input type="hidden" name="id_info" value="<?=$id_info;?>">
								<div class="box-body">
                                        <div class="form-group">
                                            <label for="username">Judul</label>
                                            <input type="text" name="judul" class="form-control" id="judul" placeholder="Kode judul" value="<?php echo $judul; ?>">
                                        </div>
										<div class="form-group">
                                            <label for="username">Isi</label>
                                            <textarea type="text" name="isi" class="form-control" id="compose-textarea" placeholder="isi" required><?php echo $isi; ?></textarea>
                                        </div>
																			
									 <div class="form-group">
										<div class="form-group">
                                            <label for="email">Publish</label>
                                            <input type="text" name="pub" value="<?php echo $pub; ?>" class="form-control" id="stokin" placeholder="Publish" required>
                                        </div>	
                                    </div>	
																		
                                    </div><!-- /.box-body -->
                                    </div>	
                                    </div>	
									<div class="col-md-6">
									<div class="box">
									<div class="box-body">
										<div class="form-group">
										 <label for="email">Link Photo <code>uk-min : 800x950 px</code></label>
											<textarea name="photo" id="files" class="form-control" readonly="readonly" onclick="openKCFinder(this)" placeholder="Pilih Photo"><?php echo $photo; ?></textarea>
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
								</div>
								</div><!-- /.col -->

 </form>
            </div><!-- /.col (left) -->
<?php 
 } ?>