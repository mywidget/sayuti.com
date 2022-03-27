<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
// error_reporting(0);
// session_start();
if (empty($_SESSION['mailuser'])){
header('location:../index.php');
}else{
// $aksi="pages/bahan/export.php";
switch($act){

  // Tampil List bahan
  default:

// koneksi2_buka();
?>
<script src="pages/bahan/modal.bahan.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	// Javascript to enable link to tab
	var hash = document.location.hash;
	var prefix = "tab_";
	if (hash) {
		$('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
	} 

	// Change hash for page-reload
	$('.nav-tabs a').on('shown.bs.tab', function (e) {
		window.location.hash = e.target.hash.replace("#", "#" + prefix);
	});
			
});
function cariFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
if (keywords.length >= 3 || keywords.length == 0) {
    $.ajaxQueue({
        type: 'POST',
        url: 'pages/bahan/getData.php',
        data:'page='+page_num+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#posts_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
}
		function showEdit(editableObj) {
			$(editableObj).css("background","#f7f7f7");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "pages/bahan/saveedit.php",
				type: "GET",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		</script>
                        <div class="col-xs-12">
                            <!-- Custom Tabs (Pulled to the right) -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">List Undangan</a></li>
                                    <li><a href="#" class="btn bg-green" onClick="showModalsk()">
                                        <i class="fa fa-plus"></i> Undangan
                                    </a>
									</li>

                                    <li class="pull-right header"><i class="fa fa-th"></i> Data Bahan</li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
<div class="box-body table-responsive">
<div class="row" style="margin-bottom:10px">
<div class="col-md-6"></div>
<div class="col-md-6">
<div id="input-outer">
	<input type="text" class="form-control" id="keywords" placeholder="cari bahan" onkeyup="cariFilter()"/>
    <div id="clear"></div>
</div>
</div>

</div>
    <div class="loading-overlay"><div class="overlay-content">Loading.....</div></div>
    <div id="posts_content">
    <?php
include("../g-asset/conn_db.php");
require_once("../g-asset/web_function.php");
require_once("../lib/function.php");
// Create database connection

    $limit = 10;
    //get number of rows
    $queryNum = $db->query("SELECT COUNT(*) as postNum FROM tbl_bahan");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];
    
    //initialize pagination class
    $pagConfig = array(
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'cariFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
    //get rows
    $query = $db->query("SELECT * FROM tbl_bahan ORDER BY Nm_Bhn ASC LIMIT $limit");
    if($query->num_rows > 0){ ?>
        <div class="posts_list">
<table class="table table-bordered table-striped">  
<thead>  
		<tr>
			<th style="width:2%;">No</th>
			<th class="text-center" >Nama Bahan</th>
			<th class="text-center" style="width:15%;">Ukuran</th>
			<th class="text-center" style="width:8%;">Harga</th>
			<th class="text-center" style="width:6%;">Tebal</th>
			<th class="text-center" style="width:3%;">Publish (Y/N)</th>
			<th class="text-center" style="width:5%">Aksi</th>
		</tr>
</thead>  
<tbody> 
        <?php
	$no =1;
	while($aRow = $query->fetch_assoc()){
	 
	  
	 
	$edit = paramEncrypt('module=bahan&act=editbahan&id='.$aRow['Kd_Bhn']);
	$edit_adm ='<a href="?'.$edit.'"  class="tooltip-left" data-tooltip="Edit Data">'.$aRow['Nm_Bhn'].'';
	// $hapus = paramEncrypt('module=bahan&act=hapus&id='.$aRow['Kd_Bhn']);	
	$hapus = "<a href='#' onClick='deleteUserk({$aRow['Kd_Bhn']})' class='tooltip-left' data-tooltip='Hapus Data'><i class='fa fa-trash-o'></i></a>";	
	$data ='<a href="?'.$edit.'"  class="tooltip-left" data-tooltip="Edit Data"><i class="fa fa-edit"></i></a> '.$hapus;
	$nama = '<input style="width:100%;" class="text-left" type="text" id="nama'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Nm_Bhn'].'" >';
	$tinggi = '<input style="width:50px !important;" class="text-center" type="text" id="tinggi'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Tinggi'].'" >';
	$lebar = '<input style="width:50px !important;" class="text-center" type="text" id="lebar'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Lebar'].'" >';
	$harga = '<input style="width:100px !important;" class="text-center" type="text" id="harga'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Harga_Bahan'].'" >';
	$tebal = '<input style="width:100px !important;" class="text-center" type="text" id="tebal'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Tebal'].'" >';
	$pub = '<input style="width:80px !important;" class="text-center" type="text" id="pub'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['publish'].'" >';
	
        ?>
            <tr>  
            <td><?=$no++;?></td>  
            <td contenteditable="true" onBlur="saveToDatabase(this,'Nm_Bhn','<?php echo $aRow["Kd_Bhn"]; ?>')" onClick="showEdit(this);"><?php echo $aRow["Nm_Bhn"]; ?></td>
            <td><?=$tinggi.'x'.$lebar.'cm'; ?></td>  
            <td><?=$harga;?></td>
            <td><?=$tebal; ?></td> 
            <td><?=$pub; ?></td>  
            <td><?=$data; ?></td>  
            </tr> 
        <?php } ?>
</tbody>  
</table>  
        </div>
		<div style="float:right">
        <?php echo $pagination->createLinks(); ?>
        </div>
    <?php } ?>
    </div>
                                </div><!-- /.box-body -->
                                    </div><!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
                                <div class="box-body table-responsive">
                                    <table id="jsonplano" class="table table-bordered table-striped table-mailbox">
                                        <thead>
                                            <tr>
                                                <th style="width:2%;">No</th>
                                                <th>Keterangan</th>
                                                <th style="width:40%;">Panjang X Lebar</th>
                                                <th style="width:5%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                    </div><!-- /.tab-pane -->

                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div>
		<!-- Modal add -->
		<div class="modal fade" id="myModalsK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Data</h4>
					</div>
					<div class="modal-body">
						<div class="alert alert-danger" role="alert" id="removeWarning">
							Anda yakin ingin menghapus data ini
						</div>
						<form id="formUserK">
							<input type="hidden" class="form-control" id="id" name="id">
							<input type="hidden" class="form-control" id="type" name="type">
				<div class="body">
					<div class="row clearfix">
						<div class="col-md-12">
							<b>Nama Bahan <span class="errorn" style="display:none;color:#ff0000;"></span></b>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-edit"></i>
								</span>
								<div class="form-line">
					<input type="text" name="nama" id="nama" class="form-control clearable" placeholder="Nama" required autofocus />
								</div>
							</div>
					<label for="negara">Kategori Bahan<span class="errorc" style="display:none;color:#ff0000;"></span></label>
				<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-folder"></i>
								</span>
					<div class="form-line">
										<?php 
										koneksi2_buka();
										$sql_bhn = mysql_query("SELECT * FROM kategori_bahan where pub='Y' ORDER BY nama_kategori"); ?>
	
										 <select name="cat" id="cat" class="form-control" data-style="btn-primary" data-live-search="true">
										<?php
										echo "<option value=''>- Pilih Kategori -</option>";
										while($w=mysql_fetch_array($sql_bhn)){
										echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
										}
										koneksi2_tutup();
										?>
										</select>
					</div>
				</div>
                                         <label for="Harga_Bahan">Harga Bahan <span class="errorh" style="display:none;color:#ff0000;"></span></label>
										<div class="input-group">
										<span class="input-group-addon">
										<i class="fa fa-edit"></i>
										</span>
										<div class="form-line">
                                            <input type="number" name="harga" id="harga" class="form-control"  placeholder="Harga Bahan" required>
                                        </div>
                                        </div>
										<label for="">Ukuran Bahan</label>
										<div class="input-group">
											<span class="input-group-addon">Tinggi</span>
											<input type="number" name="tinggi" id="tinggi" class="form-control" required>
											<span class="input-group-addon bg-red">&times;</span>
											<span class="input-group-addon">Lebar</span>
											<input type="number" name="lebar" id="lebar" class="form-control" required>
											<span class="input-group-addon">cm</span>
										</div>
										<div class="form-group">
                                            <label for="Tebal">Tebal Bahan</label>
                                            <input type="number" name="tebal"  class="form-control" id="tebal" placeholder="Tebal" required>
                                        </div>
                                        <div class="form-group hidex">
										<label for="">Aktifkan</label>
										<select name="pub" id="pub" class="minimal">
										<option value="">--Pilih--</option>
										<option value="Y">Aktif Y</option>
										<option value="N">Aktif N</option>
										</select>
                                        </div>
						</div>
					</div>
				</div>
						</form>
						
					</div>
					<div class="modal-footer">
						<button type="button" onClick="submitUserk()" id="kirim" class="btn btn-success">Submit</button>
						<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal plano -->
		<div class="modal fade" id="myModalsPlano" tabindex="-1" role="dialog" aria-labelledby="myModalLabelp" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabelp">Add Data</h4>
					</div>
					<div class="modal-body">
						<div class="alert alert-danger" role="alert" id="removeWarningp">
							Anda yakin ingin menghapus data ini
						</div>
						<form id="formPlano">
							<input type="hidden" class="form-control" id="idp" name="idp">
							<input type="hidden" class="form-control" id="typep" name="typep">
				<div class="body">
					<div class="row clearfix">
						<div class="col-md-12">
							<b>Keterangan <span class="errorp" style="display:none;color:#ff0000;"></span></b>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-edit"></i>
								</span>
								<div class="form-line">
					<input type="text" name="namap" id="namap" class="form-control clearable" placeholder="Nama" required autofocus />
								</div>
							</div>
							<label for="">Ukuran Bahan <span class="errorw" style="display:none;color:#ff0000;"></span><span class="errorl" style="display:none;color:#ff0000;"></span></label>
							<div class="input-group">
								<span class="input-group-addon">Panjang</span>
								<input type="number" name="panjangp" id="panjangp" class="form-control" required>
								<span class="input-group-addon bg-red">&times;</span>
								<span class="input-group-addon">Lebar</span>
								<input type="number" name="lebarp" id="lebarp" class="form-control" required>
								<span class="input-group-addon">cm</span>
							</div>
						</div>
					</div>
				</div>
						</form>
						
					</div>
					<div class="modal-footer">
						<button type="button" onClick="submitPlano()" id="kirim" class="btn btn-success">Submit</button>
						<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

 <script>
 $('#clear').click(function () {
    $('#input-outer input').val('');
    $('#input-outer input').focus();
	cariFilter();
});

function savharga(a){
    var hr = new XMLHttpRequest();
    str = a; 
    str2 = document.getElementById("harga" + a.toString()).value; 
    str3 = document.getElementById("tinggi" + a.toString()).value; 
    str4 = document.getElementById("lebar" + a.toString()).value; 
    str5 = document.getElementById("tebal" + a.toString()).value; 
    // str6 = document.getElementById("nama" + a.toString()).value; 
    str7 = document.getElementById("pub" + a.toString()).value; 

    var url = "pages/bahan/save_harga.php";
    var vars = "id="+str+"&harga="+str2+"&tinggi="+str3+"&lebar="+str4+"&tebal="+str5+"&pub="+str7;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			status('Data telah di perbaharui');
	    }
    }
    hr.send(vars); // Actually execute the request
    // document.getElementById('').innerHTML = "<i class='fa fa-spinner fa-spin'></i>";
}
</script>


<?php 
// koneksi2_tutup();
    break;

	case "addbahan":
	include"form_bahan.php";
    break;
	
	case "editbahan":
	include"form_bahan.php";
    break;
	
	case "update_bahan":
	include"update_bahan.php";
    break;
	
	case "updatebahan":
	include"update.php";
    break;
	
	case "import":
	include"import.php";
    break;
	
	case "save_import":
	// membaca file excel yang diupload
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
 
	// membaca jumlah baris dari data excel
	$baris = $data->rowcount($sheet_index=0);
 
	// import data excel mulai baris ke-2 
	// (karena baris pertama adalah nama kolom)
	for ($i=2; $i <= $baris; $i++){
	$Kd_Bhn = $data->val($i, 1); 
	$id_kategori = $data->val($i, 2); 
	$Nm_Bhn = $data->val($i, 3);
	$harga = $data->val($i, 4);
	$tinggi = $data->val($i, 5);
	$lebar = $data->val($i, 6);
	$tebal = $data->val($i, 7);
	$cari = mysql_query("SELECT Kd_Bhn FROM tbl_bahan where Kd_Bhn='$Kd_Bhn'");
	$r=mysql_fetch_array($cari);
	$jumlah = mysql_num_rows($cari);
	if (empty($Kd_Bhn)){
	//KOSONG
	save_alert('save',save);
	htmlRedirect('mod.php?'.paramEncrypt('module='.$module));
	}elseif ($jumlah > 0){
	//UPDATE
	$hasil = mysql_query("UPDATE tbl_bahan SET id_kategori='$id_kategori',Nm_Bhn='$Nm_Bhn',Harga_Bahan='$harga',Tinggi='$tinggi',Lebar='$lebar',Tebal='$tebal' where Kd_Bhn='$Kd_Bhn'");
	//save_alert('save',error);
	}else{
	// INSERT
	$hasil = mysql_query("INSERT INTO tbl_bahan(Kd_Bhn,id_kategori,Nm_Bhn,Harga_Bahan,Tinggi,Lebar,Tebal) VALUES('$Kd_Bhn','$id_kategori','$Nm_Bhn','$harga','$tinggi','$lebar','$tebal')");
		//htmlRedirect('mod.php?'.paramEncrypt('module='.$module));
	}
}
	save_alert('save',save);
	htmlRedirect('mod.php?'.paramEncrypt('module='.$module));
    break;
	
	case "save":
koneksi2_buka();
	$Kd_Bhn = $var['id'];
	// deklarasikan variabel

	$Nm_Bhn 		= filter($_POST['Nm_Bhn']);
	$Harga_Bahan 	= filter($_POST['Harga_Bahan']);
	$Tinggi 		= filter($_POST['Tinggi']);
	$Lebar 			= filter($_POST['Lebar']);
	$Tebal 			= filter($_POST['Tebal']);
	$status 		= filter($_POST['status']);
	$bahan 			= filter($_POST['bahan']);
	
	// validasi agar tidak ada data yang kosong
	if($Nm_Bhn!="" && $Harga_Bahan!="" && $Tinggi!="" && $Lebar!="" && $Tebal!="") {
		// proses tambah data bahan
		if($Kd_Bhn == 0) {
			mysql_query("INSERT INTO tbl_bahan (Nm_Bhn,
												id_kategori,
												Harga_Bahan,
												Tinggi,
												Lebar,
												Tebal,
												publish) 
									VALUES ('$Nm_Bhn',
											'$bahan',
											'$Harga_Bahan',
											'$Tinggi',
											'$Lebar',
											'$Tebal',
											'$status')");
	echo'<div class="box-body">
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<b>Alert!</b> Data berhasil disimpan.
			</div>
		</div>';
		htmlRedirect('mod.php?'.paramEncrypt('module=bahan'));
		} else {
		//edit bahan
			mysql_query("UPDATE tbl_bahan SET 
			id_kategori = '$bahan',
			Nm_bhn = '$Nm_Bhn',
			Harga_Bahan = '$Harga_Bahan',
			Tinggi = '$Tinggi',
			Lebar = '$Lebar',
			Tebal = '$Tebal',
			publish = '$status'
			WHERE Kd_Bhn = $Kd_Bhn");
	echo'<div class="box-body">
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>Alert!</b> Data berhasil diperbaharui.
	</div>
	</div>';
	htmlRedirect('mod.php?'.paramEncrypt('module=bahan'));
		}
	}else{
	echo'<div class="box-body">
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>Alert!</b> Data gagal disimpan.
	</div>
	</div>';
	htmlRedirect('mod.php?'.paramEncrypt('module=bahan'));
	}
koneksi2_tutup();
    break;
	
	case "hapus":
	koneksi2_buka();
	mysql_query("DELETE FROM tbl_bahan WHERE Kd_Bhn='".$GET_ID."'");
	echo'<div class="box-body">
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>Alert!</b> Data berhasil dihapus.
	</div>
	</div>';
	htmlRedirect('mod.php?'.paramEncrypt('module='.$module));
	koneksi2_tutup();
    break;
	
	//publish kertas
	case "publish":
	koneksi2_buka();
	mysql_query("UPDATE tbl_bahan SET publish='Y' WHERE Kd_Bhn='".$GET_ID."'");
	save_alert('update',update);
	htmlRedirect('mod.php?'.paramEncrypt('module='.$module));
	koneksi2_tutup();
    break;
	//unpublish kertas
	case "unpublish":
	koneksi2_buka();
	mysql_query("UPDATE tbl_bahan SET publish='N' WHERE Kd_Bhn='".$GET_ID."'");
	save_alert('update',update);
	htmlRedirect('mod.php?'.paramEncrypt('module='.$module));
	koneksi2_tutup();
    break;

	}
}
 ?>
