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
	$resModul = $modulConn->call('pilihModul', array('a' => 'tag_mod'));
if($GETID > 0) {	
	$param = array('e' => $email, 't' => $token,'i'=>$GETID);
	$res = $modulConn->call('tags3',array($param));	
	
	$param = array('e' => $email, 't' => $token,'i'=>$GETID);
	$result = $modulConn->call('editMesin',array($param));
	// echo $result[0]['jumlahmin'];
	if($result){
	foreach ($result as $data){
	$nama_mesin = $data['namamesin'];
	$jumlah_min = $data['jumlahmin'];
	$harga_min = $data['hargamin'];
	$harga_lebih = $data['hargalebih'];
	$panjang = $data['panjangkertas'];
	$lebar = $data['lebarkertas'];
	$lebarc = $data['lebarcetak'];
	$panjangc = $data['panjangcetak'];
	$min_panjang = $data['min_panjang'];
	$min_lebar = $data['min_lebar'];
	$harga_ctp = $data['hargactp'];
	$jenis = $data['jenis_mesin'];
	$aktif = $data['aktif'];
	$min_bw = $data['hargaminbw'];
	$lebih_bw = $data['hargalebihbw'];
	$min_khusus = $data['hargamintintakhusus'];
	$lebih_khusus = $data['hargalebihtintakhusus'];
	$biayabbplatsama = $data['biayabbplatsama'];
	
	$pilih_data = array('Offset','MiniOffset','PrintDigital','Sablon');
	$pilihan_jenis = '';
	$tarikan = $data['tarikan'];
	$replat = $data['replat'];
	}
	}

	foreach ($pilih_data as $status) {
	$pilihan_jenis .= "<option value=$status";
	if ($status == $jenis) {
	$pilihan_jenis .= " selected";}
	$pilihan_jenis .= ">$status</option>\r\n";
	}
//form tambah data
} else {
	$nama_mesin = "";
	$jumlah_min = "";
	$harga_min = "";
	$harga_lebih = "";
	$panjang = "";
	$lebar = "";
	$min_panjang = "";
	$min_lebar = "";
	$harga_ctp = "";
	$aktif = "Y";	
	$mib_bw = "";
	$lebih_bw = "";
	$min_khusus = "";
	$lebih_khusus = "";
	$biayabbplatsama = "";
	$tarikan = "0";
	$replat = "0";
	
	$pilih_data = array('Offset','MiniOffset','PrintDigital','Sablon');
	$pilihan_jenis = '';
	foreach ($pilih_data as $status) {
	$pilihan_jenis .= "<option value=$status";
	if ($status == $pilihan_jenis) {
	$pilihan_jenis .= " selected";}
	$pilihan_jenis .= ">$status</option>\r\n";}
}

?>
					<div class="row">
	<!-- form start -->
	<form role="form" method="POST" action="?<?php echo ('panel=mesin&act=save&id='.$GETID.'')?>">
                        <div class="col-md-6">
                            <div class="box">
								<div class="box box-primary">
                                <div class="box-header">
								<?php if($GETID > 0) { ?>
                                    <h3 class="box-title">Data mesin dan harga</h3>
									<div class="box-tools pull-right">
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
									<a href="?<?php echo ('panel='.$module)?>" class="btn btn-danger">Batal</a>
									</div>
									<?php }else{ ?>
                                    <h3 class="box-title">Data mesin dan harga</h3>
									<div class="box-tools pull-right">
                                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									<a href="?<?php echo ('panel='.$module)?>" class="btn btn-danger">Batal</a>
									</div>
									<?php } ?>
                                </div><!-- /.box-header -->
                                
							
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="nama_mesin">Nama Mesin</label>
                                            <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" placeholder="Nama Mesin" value="<?php echo $nama_mesin; ?>" required />
                                        </div>
										<div class="form-group">
                                            <label for="jumlah_min">Jumlah Minimal</label>
                                            <input type="text" name="jumlah_min" value="<?php echo $jumlah_min; ?>" class="form-control" id="jumlah_min" placeholder="Jumlah Minimal" required>
                                        </div>
										<div class="form-group">
										<div class="input-group">
                                            <span class="input-group-addon">Harga Minimal</span>
                                            <input type="text" name="harga_min" value="<?php echo $harga_min; ?>" class="form-control" id="harga_min" placeholder="0" required>
                                            <span class="input-group-addon">Harga Lebih</span>
                                            <input type="text" name="harga_lebih" value="<?php echo $harga_lebih; ?>" class="form-control" id="harga_lebih" placeholder="Harga Lebih" required>
                                        </div>
                                        </div>
										<div class="form-group">
										<div class="input-group">
                                            <span class="input-group-addon">Biaya Plat Sama</span>
                                            <input type="text" name="plat_sama"  class="form-control" id="plat_sama" value="<?php echo $biayabbplatsama; ?>" placeholder="0" required>
                                            <span class="input-group-addon">Harga CTP</span>
                                            <input type="text" name="harga_ctp" value="<?php echo $harga_ctp; ?>" class="form-control" id="harga_ctp" placeholder="Harga CTP" required>
                                        </div>
                                        </div>
										<div class="form-group">
										<div class="input-group">
                                            <span class="input-group-addon">Harga min BW</span>
											<input type="text" name="min_bw"  class="form-control" id="min_bw" value="<?php echo $min_bw; ?>" required>
                                            <span class="input-group-addon">Harga lebih BW</span>
											<input type="text" name="lebih_bw"  class="form-control" id="lebih_bw" value="<?php echo $lebih_bw; ?>" required>
                                           
                                        </div>
                                        </div>
										<div class="form-group">
										<div class="input-group">
                                            <span class="input-group-addon">Harga min tinta khusus</span>
											<input type="text" name="min_khusus"  class="form-control" id="min_khusus" value="<?php echo $min_khusus; ?>" required>
                                            <span class="input-group-addon">Harga lebih tinta khusus</span>
											<input type="text" name="lebih_khusus"  class="form-control" id="lebih_khusus" value="<?php echo $lebih_khusus; ?>" required>
                                           
                                        </div>
                                        </div>
						<div class="form-group">
							<label for="harga_lebih">Mesin Aktif</label>
							<select name='aktif' class="form-control">
							<?php 
							if($aktif=="Y") {
							?>
							<option value="Y" selected>Ya</option>
							<option value="N">Tidak</option>
							<?php }else{ ?>
							<option value="Y">Ya</option>
							<option value="N" selected>Tidak</option>
							<?php } ?>
							</select>
						</div>
                                    </div><!-- /.box-body -->
                               
                            </div><!-- /.box -->
                        </div>
                    </div>
            <div class="col-md-6">
				<div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Data modul dan ukuran</h3>
                </div>
					<div class="box-body">
					<div class="form-group">
						<label for="modul">Pilih Modul</label>
						<select placeholder="Pilih modul" name="modul[]" class="selectize-control" id="chosen-tags" multiple>
						<?php 
						if($res){
						foreach ($res as $data){
						$tags= implode(' ',$data);
						echo $tags;
							}
						}
						if($resModul){
						foreach ($resModul as $datam){
						echo '<option value="'.$datam['tag_mod'].'">'.$datam['nama_modul'].'</options>';
							}
						}
						?>
						</select>
						</div>
					<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Ukuran Max kertas</span>
						<input type="text" name="panjang" value="<?php echo $panjang; ?>" class="form-control" rel="txtTooltip" title="Panjang" placeholder="Panjang" required>
						<span class="input-group-addon">X</span>
						<input type="text" name="lebar" value="<?php echo $lebar; ?>" class="form-control" rel="txtTooltip" title="Lebar" placeholder="Lebar" required>
						<span class="input-group-addon">cm</span>
					</div>
					</div>
					<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Ukuran Min Kertas</span>
						<input type="text" name="min_panjang" value="<?php echo $min_panjang; ?>" class="form-control" rel="txtTooltip" title="Panjang" placeholder="Panjang" required>
						<span class="input-group-addon">X</span>
						<input type="text" name="min_lebar" value="<?php echo $min_lebar; ?>" class="form-control" rel="txtTooltip" title="Lebar" placeholder="Lebar" required>
						<span class="input-group-addon">cm</span>
					</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Ukuran Max Cetak</span>
							<input type="text" name="panjangc" value="<?php echo $panjangc; ?>" class="form-control" rel="txtTooltip" title="Panjang" placeholder="Panjang" required>
							<span class="input-group-addon">X</span>
							<input type="text" name="lebarc" value="<?php echo $lebarc; ?>" class="form-control" rel="txtTooltip" title="Lebar" placeholder="Lebar" required>
							<span class="input-group-addon">cm</span>
						</div>
						</div>
						<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Lebar Tarikan</span>
							<input type="text" name="tarikan" value="<?php echo $tarikan; ?>" class="form-control" rel="txtTooltip" title="Lebar Tarikan Mesin" placeholder="Tarikan" required>
							<span class="input-group-addon">Replat</span>
							<input type="text" name="replat" value="<?php echo $replat; ?>" class="form-control" rel="txtTooltip" title="Jumlah Pergantian Plat" placeholder="Replat" required>
							<span class="input-group-addon">Lembar</span>
						</div>
					</div>
						<div class="form-group">
							<label for="harga_lebih">Jenis Mesin</label>
							<select name='jenis' class="form-control">
							<?php echo $pilihan_jenis; ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			</form>
				</div>			
<?php 
	}
 ?>