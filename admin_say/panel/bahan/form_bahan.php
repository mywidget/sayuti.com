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
koneksi2_buka();
// jika kd_mesin > 0 / form ubah data
if($GET_ID > 0) {
$detail = mysql_query("SELECT * FROM tbl_bahan WHERE Kd_Bhn=".$GET_ID);
$data   = mysql_fetch_array($detail);
	$Nm_Bhn 		= $data['Nm_Bhn'];
	$Harga_Bahan 	= $data['Harga_Bahan'];
	$Tinggi 		= $data['Tinggi'];
	$Lebar 			= $data['Lebar'];
	$Tebal 			= $data['Tebal'];
	
	if($data['publish']=="Y") {
		$status = "Aktif";
	} else {
		$status = "Tidak Aktif";
	}

//form tambah data
} else {
	$Nm_Bhn 		= "";
	$Harga_Bahan 	= "";
	$Tinggi 		= "";
	$Lebar 			= "";
	$Tebal 			= "";
}
//paramEncrypt("email="$email)
?>
                        <div class="col-xs-12">
                            <div class="box">
								<div class="box box-primary">
                                <div class="box-header">
								<?php if($GET_ID > 0) { ?>
                                    <h3 class="box-title">Edit Data Bahan</h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input Data Bahan</h3>
									<?php } ?>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<?php
								if($_SESSION['leveluser']=='demo'){ ?>
								<form method="POST" action="index.php">
									<?PHP }else{ ?>
                                <form role="form" method="POST" action="?<?php echo paramEncrypt('module=bahan&act=save&id='.$GET_ID.'')?>">
								<?php } ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="Nm_Bhn">Nama Bahan</label>
                                            <input type="text" name="Nm_Bhn" class="form-control" id="Nm_Bhn" placeholder="Nama Bahan" value="<?php echo $Nm_Bhn; ?>" required />
                                        </div>
										<div class="form-group">
                                        <label for="Nm_Bhn">Kategori Bahan</label>
										<?php $sql_bhn = mysql_query("SELECT * FROM kategori_bahan where pub='Y' ORDER BY nama_kategori"); ?>
	
										<select name="bahan"  class="selectpicker form-control" data-style="btn-primary" data-size="auto">
										<?php if ($data['id_kategori']==0){
										echo "<option value=0 selected>- Pilih Kategori -</option>";
										}   
										while($w=mysql_fetch_array($sql_bhn)){
										if ($data['id_kategori']==$w['id_kategori']){
										echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
										}else{
										echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
											}
										}
										?>
										
										</select>
                                        </div>
										<div class="form-group">
                                            <label for="Harga_Bahan">Harga Bahan</label>
                                            <input type="number" name="Harga_Bahan" value="<?php echo $Harga_Bahan; ?>" class="form-control" id="Harga_Bahan" placeholder="Harga Bahan" required>
                                        </div>
										<div class="input-group">
											<span class="input-group-addon">Tinggi</span>
											<input type="number" name="Tinggi" value="<?php echo $Tinggi; ?>" class="form-control" required>
											<span class="input-group-addon">X</span>
											<input type="number" name="Lebar" value="<?php echo $Lebar; ?>" class="form-control" required>
											<span class="input-group-addon">cm</span>
										</div>
										<div class="form-group">
                                            <label for="Tebal">Tebal</label>
                                            <input type="number" name="Tebal" value="<?php echo $Tebal; ?>" class="form-control" id="Tebal" placeholder="Tebal" required>
                                        </div>
                                        <div class="form-group"> 
                                            <div class="radio">
                                                <label>
										<?php if($data['publish']=='Y') { ?>
                                                    <input type="radio" name="status" id="optionsRadios1" value="Y" checked>
                                                    Status Y
                                                    <input type="radio" name="status" id="optionsRadios2" value="N">
                                                    Status N
										<?php }else{ ?>
													<input type="radio" name="status" id="optionsRadios1" value="Y">
                                                    Status Y
                                                    <input type="radio" name="status" id="optionsRadios2" value="N" checked>
                                                    Status N
                                               <?php }?>
                                                </label>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<?php 
									if($_SESSION['leveluser']=='demo'){ ?>
									<a href="?<?php echo paramEncrypt('module=bahan')?>" class="btn btn-info">Simpan</a>
									<?PHP }else{ 
									if($GET_ID > 0) { ?>
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
									<?php }else{ ?>
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									<?php } } ?>
										<a href="?<?php echo paramEncrypt('module=bahan')?>" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>
<?php
koneksi2_tutup();
	}
 ?>