<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
//error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
// $save = "panel/konsumen/save_konsumen.php";
switch($act){
  // Tampil List user
  default:
  	// $sid = session_id();	// check
	// $queery=mysql_query("select MAX(id_invoice) as kd_max from invoice");
	// if($queery > 0){
	// $data=mysql_fetch_array($queery);
	// $awal=((int)$data['kd_max'])+1;
	// $kd = sprintf("%0s", $awal);
	// }else{
	// $kd="1";
	// }
	// $kode_test = $kd;
	
	// $queery=mysql_query("select MAX(id_konsumen) as kd_max from konsumen");
	// if($queery > 0){
	// $data=mysql_fetch_array($queery);
	// $awal=((int)$data['kd_max'])+1;
	// $kdk = sprintf("%0s", $awal);
	// }else{
	// $kdk="1";
	// }
	// $kode_kon = $kdk;
	

?>
<style>
#dispu{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#disp{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#result{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#validate-status{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
.red, .red a {color: #FF0000;font-size:24pt}
.green, .green a {color: #33CC33;font-size:24pt}
.modal-title{color:#000}
.modal-footer{color:#000}
#result{
	margin-left:5px;
}

</style>

<script type="text/javascript">
$(document).ready(function(){
//telp
$("#telp").keyup(function() {
var telp = $('#telp').val();
if(telp=="")
{
$("#dispu").html("<img src='server/ajax-loader.gif' data-toggle='tooltip' title='cek data'/>");
}
else
{
$.ajax({
type: "POST",
url: "server/cek_konsumen.php",
data: "telp="+ telp ,
success: function(html){
$("#dispu").html(html);
}
});
return false;
}
});
});
</script>
<script type="text/javascript" language="javascript" class="init">
// $(document).ready(function() {
	// $('#jsontable').dataTable( {
		// "bProcessing": true,
		// "bServerSide": true,
		// "sAjaxSource": "server/data_konsumen.php",
		// "aaSorting": [[ 0, "desc" ]],
	// } );
// } );
</script>
          <!-- START CUSTOM TABS -->
          <div class="row">
            <div class="col-xs-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Data Konsumen</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Tambah Konsumen</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                            <div class="box">
                                <div class="box-body">
                                    <table id="table1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:1% !important;" >No</th>
                                                <th>Nama Konsumen</th>
                                                <th>No. Handphone</th>
                                                <th>Email</th>
                                                <th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$kon = $db->query("select * from tb_resell order by id desc");
$no=1;
while($row = $kon->fetch_array()){
echo "<tr>
<td>$no</td>
<td><a href='?panel=konsumen&act=edit&id={$row['id']}'>{$row['nama']}</a></td>
<td>{$row['nohp']}</td>
<td>{$row['email']}</td>
<td><a href='?panel=konsumen&act=edit&id={$row['id']}'><i class='fa fa-edit'></i></a>
&nbsp;<a href='?panel=konsumen&act=hapus&id={$row['id']}'><i class='fa fa-trash'></i></a></td>
</tr>";
$no++;}
?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                        <div class="row">
<form class="myfirstform" role="form" method="POST" action="?panel=konsumen&act=save_konsumen">
 <input type="hidden" name="id" value="0">
 <input type="hidden" name="inv" value="<?=$kode_test;?>">
 <input type="hidden" name="sid" value="<?=$sid;?>">
 <input type="hidden" name="idk" value="<?=$kode_kon;?>">
 <input type="hidden" name="mode" value="invoice_baru">
                        <div class="col-md-6">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Tambah Data Konsumen</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box-body">
										<div class="form-group">
                                            <label class="control-label">Nama Konsumen</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Konsumen"  required>
                                        </div>
										<div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="password Konsumen" required>
										</div>
										<div class="form-group">
                                            <label class="control-label">Telp Konsumen</label>
                                            <input type="text" name="telp" id="telp" class="form-control" placeholder="Telp Konsumen" required>
											<div id="dispu"></div>
                                        </div>


                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
										<a href="?panel=konsumen" class="btn btn-danger">Batal</a>
                                    </div>
                               
                            </div><!-- /.box -->
                        </div>
								<div class="col-md-6">
									<div class="box">
									<div class="box-header">
                                    <h3 class="box-title"></h3>
									</div><!-- /.box-header -->
										<div class="form-group">
                                            <label class="control-label">Email Konsumen</label>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Email Konsumen" required>
										</div>
										<div class="form-group">
											<label>Alamat</label>
                                            <textarea name="alamat" class="form-control" rows="2" placeholder="Jalan/Komplek/Kampung"></textarea>
										</div>

                                </div>
								</div><!-- /.col -->
				</form>
                  </div><!-- /.row -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->

          </div> <!-- /.row -->
          </div> <!-- /.row -->
<?php 
    break;
 
	case "save":
	include"save_konsumen.php";
    break;
	
	case "edit":
	include"form.php";
    break;
	

	}
}
 ?>