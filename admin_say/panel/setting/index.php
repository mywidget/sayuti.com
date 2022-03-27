<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
// error_reporting(0);
// session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
switch($act){
  // Tampil List kategori
  default:

?>	

<script type="text/javascript">
	
        $(document).ready(function() {
        
            // Javascript to enable link to tab
			var hash = document.location.hash;
			var prefix = "tab_";
			if (hash) {
				$('.navbar a[href='+hash.replace(prefix,"")+']').tab('show');
			} 

			// Change hash for page-reload
			$('.navbar a').on('shown.bs.tab', function (e) {
				window.location.hash = e.target.hash.replace("#", "#" + prefix);
			});
					
        });
		</script>
	
							<?php
							$result=mysql_query("select * from info where id_info=1");
							$data = mysql_fetch_array($result);
							$jumlah = mysql_num_rows($result);
								$id			= $data['id_info'];
								$nama		= $data['nama_pemilik'];
								$telp		= $data['telp'];
								$perusahaan	= $data['nama_perusahaan'];
								$alamat 	= $data['alamat_perusahaan'];
								$kota 		= $data['kota'];
								$email 		= $data['email'];
								$bank 		= $data['bank'];
							//save
							if(isset($_POST['submit']) && $_POST['submit'] != ""){
								$de= mysql_real_escape_string($_POST["id"]);
								$nama		= $_POST['nama_pemilik'];
								$telp		= $_POST['telp'];
								$perusahaan	= $_POST['perusahaan'];
								$alamat 	= $_POST['alamat'];
								$kota 		= $_POST['kota'];
								$email 		= $_POST['email'];
								$bank 		= $_POST['bank'];

								//save ke db
								mysql_query("UPDATE info SET nama_perusahaan = '$perusahaan',
								nama_pemilik = '$nama',
								alamat_perusahaan = '$alamat',
								kota = '$kota',
								telp = '$telp',
								email = '$email',
								bank = '$bank'
								where id_info  = 1");
								save_alert('save',save);
								$_POST['update']=0;
							}
							?>
							
<style>
.bootstrap-select > .dropdown-toggle {
    width: 95%;
    padding-right: 5px;
    height: 30px;
}
.col-xs-10 {
    width: 90%;
}	
input {
    height: 30px;
}
 .col-xs-10 {
    position: relative;
    min-height: 0px;
    padding-top:0px;
	padding-right: 15px;
    padding-left: 15px;
}
td, th {
    height: 20px;
	
}
.form-control {
    height: 30px;
}	

</style>							
<!-- Main content -->
        <section class="content">
		  <nav class="navbar navbar-default">
			<ul class="nav nav-pills">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Link Akun Pembayaran</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Informasi Perusahaan</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Lain-lain</a></li>
                </ul>
                <div class="tab-content">
                 
<script type="text/javascript">
   function savlink() {
   	var i = <?php echo $_SESSION['bar'];?>; 
	
	for (var a = 0; a < i; a++) {
    var str = document.getElementById("idakun" + a.toString()).value; 
    var noid = document.getElementById("noid" + a.toString()).value; 
  //  alert(str);
    $.ajax({
        type: "POST",
        url: "panel/setting/save_link.php",//you can get this values from php using $_POST['n1'], $_POST['n2'] and $_POST['add']
        data: { idakun: str, id: noid}
    })
   }
   }
</script>
				  
					<div class="tab-pane active" id="tab_1">
				  
                           <div class="box">
							<div class="box">								
                                <div class="box-body">
									
										<div class="col-md-6">
											<div class="box box-success">
												<div class='box-header with-border'>
													<span>Akun yang terhubung dengan Penjulan & Pembelian</span>		
												</div>	
												<div class="box-body">
													<table class="style-1">
														<thead>
															<tr>	
																<th style="width:40% !important">Jenis Pembayaran</th>
																<th style="width:55% !important">Link Akun yang terhubung</th>
																<th style="width:5% !important">Publish</th>
															</tr>	
														</thead>
														<tbody>	
															<?php
																$no=0;
																$sql=mysql_query("select * from cara_bayar");
																while($data=mysql_fetch_array($sql)){	
																	
																	//save
																?>
																<tr>
																	<input type="hidden" id="noid<?=$no;?>" value="<?=$data['id_byr'];?>">
																	<td ><input style="width:100%" type="text" id="ket" value="<?=$data['cara_bayar'];?>" readonly="readonly"</td>
																	
																	<td>
																	<select style="width:100%" id="idakun<?=$no;?>" onchange="savlink()" class="selectpicker form-control" data-live-search="true">
																	<option value="0">Pilih Nama Akun</option>
																	<?php 
																	$sql2 = mysql_query("select * from master_akun where H_D = 'D' order by nama_akun");
																	while($row = mysql_fetch_array($sql2)){
																		if ($row['id_akun'] == $data['id_akun']){
																		echo "<option value='$row[id_akun]' selected>$row[nama_akun]</option>";
																		}else{
																		echo "<option value='$row[id_akun]'>$row[nama_akun]</option>";
																		}}?>
																	</select>											
																	</td>
																	
																	<td><input style="width:100%" type="text" id="publish<?=$no;?>" onchange="savlink()" 
																		class="text-center" value="<?=$data['publish'];?>"</td>
																		
																</tr>
																	<?php
																		$no++;
																		$_SESSION['bar'] = $no;
																	} ?>							
															</tbody>
														</table>
														
													</div>
												</div>
										</div>
																				
										
											<div class="col-md-6">
												<div class="box box-success">
												<div class='box-header with-border'>
													<h3 class='box-title'>Tambah Cara Bayar</h3>
													</div>						
														
															<form method="POST" >
																		<!-- form start -->
																		<div class="box-body">
																			<div class="form-group">
																				<label>Jenis Pembayaran</label>
																				<input type="text" name="cara" class="form-control" placeholder="Cara Bayar" value="">
																			</div>
																			<div class="form-group">
																				<label>Publish</label>
																				<input type="text" name="pub" value="Y" class="form-control" id="nama_lengkap" placeholder="Y" required>
																			</div>																
																		</div><!-- /.box-body -->
																		
																		<div class="box-footer">
																			<input type="submit" name="update"  class="btn btn-primary" value="+tambah">
																		</div>
																		
															</form>
													</div>																	
														
														
											</div><!-- /.col (left) -->
										
										</div><!-- /.box-body -->
									</div><!-- /.box-body -->
								
								
							</div><!-- /.box body- -->
					</div><!-- /.tab-content -->					
					<div class="tab-pane" id="tab_2">
						<div class="box">
						<div class='box-header with-border'>
						<h3 class='box-title'><i class="fa fa-tag"></i>Informasi Perusahaan</h3>
							<div class="box-body">
													<div class="row">
															<form  method="POST">
													<div class="col-md-6">
														<div class="box">
															<!-- form start -->
															<input type="hidden" name="id" value="<?=$id;?>">
																<div class="box-body">
																	<div class="form-group">
																		<label>Nama Pemilik Perusahaan</label>
																		<input type="text" name="nama_pemilik" class="form-control" placeholder="Nama Konsumen" value="<?php echo $nama; ?>">
																	</div>
																	<div class="form-group">
																		<label>Telp Perusahaan </label>
																		<input type="text" name="telp" value="<?php echo $telp; ?>" class="form-control" id="nama_lengkap" placeholder="No. Telp" required>
																	</div>
																	<div class="form-group">
																		<label>Email Perusahaan</label>
																		<input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email" required>
																	</div>							
																	
																</div><!-- /.box-body -->

																<div class="box-footer">
																	<input type="submit" name="submit"  class="btn btn-primary" value="Update">
																	<a href="?<?=$mode;?>=home" class="btn btn-danger">Batal</a>
																</div>
														   
														</div><!-- /.box -->
													</div>
															<div class="col-md-6">
															<div class="box">
																<div class="box-body">
																	<div class="form-group">
																		<label>Nama Perusahaan</label>
																		<input type="text" name="perusahaan" class="form-control" value="<?php echo $perusahaan; ?>" readonly="readonly">
																	</div>
																	<div class="form-group">
																		<label>Alamat Perusahaan</label>
																		<textarea name="alamat" class="form-control" rows="2" placeholder="Jalan/Komplek/Kampung"><?php echo $alamat; ?></textarea>
																	</div>
																	<div class="form-group">
																		<label>Kota</label>
																		<input type="text" name="kota" class="form-control" value="<?php echo $kota; ?>" placeholder="kota">
																	</div>
																	<div class="form-group">
																		<label>Info Bank</label>
																		<textarea name="bank" class="form-control" placeholder="Info Bank untuk di Cetak Invoice"><?php echo $bank; ?></textarea>
																	</div>
																</div>
															</div>
															</div><!-- /.col -->

							 </form>
										</div><!-- /.col (left) -->


							</div><!-- /.box-body -->
						</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!-- /.tab-content -->
					<div class="tab-pane" id="tab_3">
						<div class="box">
						<div class='box-header with-border'>
						<h3 class='box-title'><i class="fa fa-tag"></i>Pengaturan Umum</h3>
						
					</div>
					</div>
					</div><!-- /.tab-content -->
			   </div><!-- /.tab-content -->
              </nav><!-- nav-tabs-custom -->
</div><!-- /.col -->
	<!-- Modal HTML select 2-->
    <div id="form-bayar" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
				<form method="post" action="?panel=setting&act=save&name=cara_bayar">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Input Data</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
					<label>Cara Bayar</label>
						<input type="text" name="cara" class="form-control">
					</div>
					<div class="form-group">
					<label>Publish</label>
						<select name="publish" class="form-control">
						<option value="Y">Ya</option>
						<option value="N">Tidak</option>
						</select>
					</div>
				<div class="row"></div>
				</div>
                <div class="modal-footer">
                    <input type="submit" name="simpan" class="btn btn-default" value="Simpan">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
				</form>
        </div>
    </div>
    </div>
<!-- Modal edit produk-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
    break;
	
	case "update":
	$id= mysql_real_escape_string($_POST['id']);
	$cara 		= filter($_POST['cara']);
	$publish 	= filter($_POST['publish']);
	mysql_query("UPDATE cara_bayar set cara_bayar	= '$cara',
									  publish 		= '$publish'
                                    WHERE id_byr  = '$id'");	
		save_alert('save',save);
	    htmlRedirect('?'.$mode.'='.$module);
    break;
	
	case "save":
	$cara 		= filter($_POST['cara']);
	$publish 	= filter($_POST['publish']);
	echo $publish;
		mysql_query("INSERT INTO cara_bayar (cara_bayar,publish) VALUES('$cara', '$publish')");
		save_alert('save',update);
	    htmlRedirect('?'.$mode.'='.$module);
    break;
	
	}
}
 ?>