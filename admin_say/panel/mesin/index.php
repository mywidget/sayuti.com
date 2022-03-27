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
//$aksi="pages/".$module."/save_mesin.php";
switch($act){

  // Tampil List MEsin
  default:

	// $response = $clientConn->call('cekTag', array('email' => $email, 'token' => $token));
	$resModul = $modulConn->call('pilihModul', array('a' => 'tag_mod')) or die("<div class='pad-50'></div><center><span class='btn btn-danger pad'>Data yang anda input Tidak Cocok, <a href='index.php'>Klik untuk Kembali</a></span></center>");
	$pilih_data = array('Offset','PrintDigital','Sablon');
	$pilihan_jenis = '';
	foreach ($pilih_data as $status) {
	$pilihan_jenis .= "<option value=$status";
	if ($status == $pilihan_jenis) {
	$pilihan_jenis .= " selected";}
	$pilihan_jenis .= ">$status</option>\r\n";}
?>
						<div class="row">
                        <div class="col-xs-12">
						<!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">List Data Mesin</a></li>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-plus"></i> Tambah Data</a></li>
									<li class="pull-right header"><i class="fa fa-th"></i> Data Mesin</li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
									<div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:1% !important;" >No</th>
                                                <th>Nama Mesin</th>
                                                <th style="width:12%;text-align:center">Ukuran Max Kertas</th>
                                                <th style="width:10%;text-align:center">Ukuran Max Cetak</th>
                                                <th style="width:10%;text-align:center">Ukuran Min Cetak</th>
                                                <th style="width:8%;text-align:center">Jml Min</th>
                                                <th style="width:10%;text-align:center">Harga Min</th>
                                                <th style="width:10%;text-align:center">Harga Lebih</th>
                                                <th style="width:10%;text-align:center">Harga CTP</th>
												<?php if($_SESSION['leveluser']=='demo'){ }else{?>
                                                <th style="width:6%;text-align:center">Publish</th>
												<?php } ?>
                                                <th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$param = array('e' => $email, 't' => $token);
$res = $modulConn->call('listMesin',array($param));
$no=1;
foreach ($res as $row){
$hargamin= number_format($row['hmin'],0,",",".");
$hargalebih= number_format($row['hl'],0,",",".");
$HargaCTP= number_format($row['hctp'],0,",",".");

 ?>
	<tr>
		<td align="center"><?=$no;?></td>
		<td>
		<a href="?<?php echo ('panel=mesin&act=editmesin&id='.$row['id'])?>"  data-tooltip="Edit Data"><?php echo $row['nm'];?></a>
		</td>
		<td align="center"><?php echo $row['pk'];?> x <?php echo $row['lk'];?> cm</td>
		<td align="center"><?php echo $row['pc'];?> x <?php echo $row['lc'];?> cm</td>
		<td align="center"><?php echo $row['minp'];?> x <?php echo $row['minl'];?> cm</td>
		<td align="right"><?php echo $row['jmin'];?></td>
		<td>Rp. <?php echo $hargamin;?></td>
		<td>Rp. <?php echo $hargalebih;?></td>
		<td>Rp. <?php echo $HargaCTP;?></td>
		<td align="center">
		<?php if($row['a'] == 'Y'){ ?>
		<a href="?<?php echo ('panel=mesin&act=unpublish&id='.$row['id'])?>"  data-tooltip="Un Publish"><img src="img/yes.png" alt="" /></a>
		<?php }else{ ?>
		<a href="?<?php echo ('panel=mesin&act=publish&id='.$row['id'])?>"  data-tooltip="Publish"><img src="img/no.png" alt="" /></a>
		<?php } ?>
		</td>
		<td align="center">
		<a href="?<?php echo ('panel=mesin&act=editmesin&id='.$row['id'].'')?>"  class="tooltip-left" data-tooltip="Edit Data"><i class="fa fa-edit"></i> </a> 
<a data-href="?<?php echo ('panel=mesin&act=hapus&id='.$row['id'].'')?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
		</td>
	</tr>
<?php 
$no++; 
}
?>
                                        </tbody>

                                    </table>
                                </div><!-- /.box-body -->
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                <!-- form start -->
					<div class="row">
                               <form role="form" method="POST" action="?<?php echo ('panel=mesin&act=save&id=0')?>">
                        <div class="col-md-6">
                            <div class="box">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="nama_mesin">Nama Mesin</label>
                                            <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" placeholder="Nama Mesin" required />
                                        </div>
										<div class="form-group">
                                            <label for="jumlah_min">Jumlah Minimal</label>
                                            <input type="text" name="jumlah_min"  class="form-control" id="jumlah_min" placeholder="0" required>
                                        </div>
										<div class="form-group">
										<div class="input-group">
										<span class="input-group-addon">Harga Minimal</span>
                                            <input type="text" name="harga_min" class="form-control" id="harga_min" placeholder="0" required>
										<span class="input-group-addon">Harga Lebih</span>
										<input type="text" name="harga_lebih"  class="form-control" id="harga_lebih" placeholder="0" required>
                                        </div>
                                        </div>
										<div class="form-group">
										<div class="input-group">
                                            <span class="input-group-addon">Biaya Plat Sama</span>
                                            <input type="text" name="plat_sama"  class="form-control" id="plat_sama" placeholder="0" required>
                                            <span class="input-group-addon">Harga CTP</span>
											 <input type="text" name="harga_ctp"  class="form-control" id="harga_ctp" placeholder="0" required>
                                        </div>
                                        </div>

										<div class="form-group">
										<div class="input-group">
                                            <span class="input-group-addon">Harga min BW</span>
											<input type="text" name="min_bw"  class="form-control" id="min_bw" placeholder="0" required>
                                            <span class="input-group-addon">Harga lebih BW</span>
											<input type="text" name="lebih_bw"  class="form-control" id="lebih_bw" placeholder="0" required>
                                           
                                        </div>
                                        </div>
										<div class="form-group">
										<div class="input-group">
                                            <span class="input-group-addon">Harga min tinta khusus</span>
											<input type="text" name="min_khusus"  class="form-control" id="min_khusus" placeholder="0" required>
                                            <span class="input-group-addon">Harga lebih tinta khusus</span>
											<input type="text" name="lebih_khusus"  class="form-control" id="lebih_khusus" placeholder="0" required>
                                           
                                        </div>
                                        </div>
                                        <div class="form-group">
										<label for="harga_ctp">Tampilkan Data</label>
                                            <div class="">
                                                <label>
										<?php if($status) { ?>
                                                    <input type="radio" name="aktif" id="optionsRadios1" value="Y" checked>
                                                    Ya
                                                    <input type="radio" name="aktif" id="optionsRadios2" value="N">
                                                    Tidak
										<?php }else{ ?>
													<input type="radio" name="aktif" id="optionsRadios1" value="Y">
                                                    Ya
                                                    <input type="radio" name="aktif" id="optionsRadios2" value="N" checked>
                                                    Tidak
                                               <?php }?>
                                                </label>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
										<a href="?<?php echo ('module='.$module)?>" class="btn btn-danger">Batal</a>
                                    </div>
                        </div>
                    </div>
            <div class="col-md-6">
				<div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Data Mesin</h3>
                </div>
					<div class="box-body">
						<div class="form-group">
						<label for="harga_lebih">Pilih Modul</label>
						<select placeholder="Pilih modul" name="modul[]" class="selectize-control" id="chosen-tags" multiple>
						<?php 
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
						<input type="text" name="panjang"  class="form-control" rel="txtTooltip" title="Panjang" placeholder="0" required>
						<span class="input-group-addon">X</span>
						<input type="text" name="lebar" class="form-control" rel="txtTooltip" title="Lebar" placeholder="0" required>
						<span class="input-group-addon">cm</span>
					</div>
					</div>
					<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">Ukuran Min Kertas</span>
						<input type="text" name="min_panjang"  class="form-control" rel="txtTooltip" title="Panjang" placeholder="0" required>
						<span class="input-group-addon">X</span>
						<input type="text" name="min_lebar"  class="form-control" rel="txtTooltip" title="Lebar" placeholder="0" required>
						<span class="input-group-addon">cm</span>
					</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Ukuran Max Cetak</span>
							<input type="text" name="panjangc"  class="form-control" rel="txtTooltip" title="Panjang" placeholder="0" required>
							<span class="input-group-addon">X</span>
							<input type="text" name="lebarc"  class="form-control" rel="txtTooltip" title="Lebar" placeholder="0" required>
							<span class="input-group-addon">cm</span>
						</div>
						</div>
						<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Lebar Tarikan</span>
							<input type="text" name="tarikan" value="" class="form-control" rel="txtTooltip" title="Lebar Tarikan Mesin" placeholder="0" required>
							<span class="input-group-addon">cm</span>
							<span class="input-group-addon">Replat</span>
							<input type="text" name="replat" value="" class="form-control" rel="txtTooltip" title="Jumlah Pergantian Plat" placeholder="0" required>
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
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div>
                        </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>Anda akan menghapus data, prosedur ini tidak dapat diubah.</p>
                    <p>Apakah Anda ingin melanjutkan?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a href="#" class="btn btn-danger danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
            
            // $('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
        })
    </script>
<?php 

    break;
	
	case "addmesin":
	include"form_mesin.php";

    break;
	
	case "editmesin":
	include"form_mesin.php";
    break;
	
	case "save":
	$nama_mesin 	= filter($_POST['nama_mesin']);
	$jumlah_min 	= filter($_POST['jumlah_min']);
	$harga_min 		= filter($_POST['harga_min']);
	$harga_lebih	= filter($_POST['harga_lebih']);
	$plat_sama		= filter($_POST['plat_sama']);
	$lebar 			= filter($_POST['lebar']);
	$panjang 		= filter($_POST['panjang']);
	$lebarc			= filter($_POST['lebarc']);
	$panjangc 		= filter($_POST['panjangc']);
	$min_panjang 	= filter($_POST['min_panjang']);
	$min_lebar 		= filter($_POST['min_lebar']);
	$harga_ctp 		= filter($_POST['harga_ctp']);
	$replat 		= filter($_POST['replat']);
	$tarikan 		= filter($_POST['tarikan']);
	$status 		= $_POST['aktif'];
	$jenis	 		= filter($_POST['jenis']);
	$min_bw	 		= filter($_POST['min_bw']);
	$lebih_bw	 	= filter($_POST['lebih_bw']);
	$min_khusus	 	= filter($_POST['min_khusus']);
	$lebih_khusus	= filter($_POST['lebih_khusus']);
    $modul			= $_POST['modul'];
	$data			= implode(' ',$modul);

	// validasi agar tidak ada data yang kosong
	if($nama_mesin!="" && $jumlah_min!="" && $harga_min!="") {
		// proses tambah data mahasiswa
	if($GETID == 0) {
 $param = array('e' => $email, 't' => $token,'pub'=>$GETID,'nama_mesin'=>$nama_mesin,'jumlah_min'=>$jumlah_min,'harga_min'=>$harga_min,'harga_lebih'=>$harga_lebih,'plat_sama'=>$plat_sama,'lebar'=>$lebar,'panjang'=>$panjang,'lebarc'=>$lebarc,'panjangc'=>$panjangc,'min_panjang'=>$min_panjang,'min_lebar'=>$min_lebar,'harga_ctp'=>$harga_ctp,'replat'=>$replat,'tarikan'=>$tarikan,'status'=>$status,'jenis'=>$jenis,'min_bw'=>$min_bw,'lebih_bw'=>$lebih_bw,'min_khusus'=>$min_khusus,'lebih_khusus'=>$lebih_khusus,'lebih_khusus'=>$lebih_khusus,'modul'=>$data);
 $result = $modulConn->call('updateMesin',array($param));
 if ($result['status'] == 1) {
	save_alert('update',update);	
 }else{
	save_alert('error',error);
 }
	htmlRedirect('?'.('panel=mesin'));
		} else {
 $param = array('e' => $email, 't' => $token,'pub'=>1,'id'=>$GETID,'nama_mesin'=>$nama_mesin,'jumlah_min'=>$jumlah_min,'harga_min'=>$harga_min,'harga_lebih'=>$harga_lebih,'plat_sama'=>$plat_sama,'lebar'=>$lebar,'panjang'=>$panjang,'lebarc'=>$lebarc,'panjangc'=>$panjangc,'min_panjang'=>$min_panjang,'min_lebar'=>$min_lebar,'harga_ctp'=>$harga_ctp,'replat'=>$replat,'tarikan'=>$tarikan,'status'=>$status,'jenis'=>$jenis,'min_bw'=>$min_bw,'lebih_bw'=>$lebih_bw,'min_khusus'=>$min_khusus,'lebih_khusus'=>$lebih_khusus,'lebih_khusus'=>$lebih_khusus,'modul'=>$data);
 $result = $modulConn->call('updateMesin',array($param));
 if ($result['status'] == 1) {
	save_alert('update',update);	
 }else{
	save_alert('error',error);
 }
	htmlRedirect('?'.('panel=mesin'));
}
	}else{
	save_alert('error',error);
	htmlRedirect('?'.('panel=mesin'));
	}

    break;
	//publish mesin
	case "publish":
 $param = array('e' => $email, 't' => $token,'pub'=>2,'id'=>$GETID);
 $result = $modulConn->call('updateMesin',array($param));
 if ($result['status'] == 1) {
	save_alert('update',update);	
 }else{
	save_alert('error',error);
 }
	htmlRedirect('?'.('panel=mesin'));

    break;
	//unpublish mesin
	case "unpublish":
 $param = array('e' => $email, 't' => $token,'pub'=>3,'id'=>$GETID);
 $result = $modulConn->call('updateMesin',array($param));
 if ($result['status'] == 1) {
	save_alert('update',update);	
 }else{
	save_alert('error',error);
 }
	htmlRedirect('?'.('panel=mesin'));
    break;
	
	case "hapus":
 $param = array('e' => $email, 't' => $token,'pub'=>4,'id'=>$GETID);
 $result = $modulConn->call('updateMesin',array($param));
 if ($result['status'] == 1) {
	save_alert('delete',delete);
 }else{
	save_alert('error',error);
 }
	htmlRedirect('?'.('panel=mesin'));
    break;
	
	}
}
 ?>