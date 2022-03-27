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


switch($act){
  // Tampil List kategori
  default:
?>
<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
		<div class="box-header with-border">
         <h3 class="box-title">Data <?=$module;?></h3>     
         <a href="?<?=$mode;?>=<?=$module;?>&act=tambah<?=$module;?>" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah</a>
        </div>
                                <div class="box-body table-responsive">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th style="width:1% !important;" >No</th>
                                                <th style='width:10%'>Nama Menu</th>
												<th style='width:20%'>Link</th>
												<th style="width:2%;text-align:center">Aktif</th>
												<th style="width:2%;text-align:center">Aksi</th>
												<th style="width:1%;text-align:center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTableKategori">

<?php
function childcats($idmenu){
global $db;
$sql=$db->query("SELECT * FROM menuadmin WHERE idparent='$idmenu'");
echo '<tr>';
while($row=$sql->fetch_array()){
if($row['aktif']=='Y'){
$aktif = '<span class="label label-success"><span class="glyphicon glyphicon-check"></span></span>';
$title = 'unPublish';
$link = "?panel=menuadmin&act=publish&status=$title&id=$row[idmenu]";
}else{
$aktif = '<span class="label label-danger"><span class="glyphicon glyphicon-minus"></span></span>';
$title = 'Publish';
$link = "?panel=menuadmin&act=publish&status=$title&id=$row[idmenu]";
}
$a=$row['idmenu'];
?>
<td align="center">--</td>
<td><a href="?panel=menuadmin&act=editmenuadmin&id=<?=$row['idmenu'];?>"  data-toggle="tooltip" title="Edit Data"> >><?=$row['nama_menu'];?></a></td>
<td><?=$row['link'];?></td>
<td align="center"><a href="<?=$link;?>"  data-toggle="tooltip" title="<?=$title;?>"><?=$aktif;?></a></td>
<td align="center">
<a href="?panel=menuadmin&act=editmenuadmin&id=<?=$row['idmenu'];?>"  data-toggle="tooltip" title="Edit Data"><i class="fa fa-edit"></i> </a>
<a data-href="?panel=menuadmin&act=hapus&id=<?=$row['idmenu'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
</td>
<td align="center"><?=$row['urutan'];?></td>
<?php
//echo "$r[nama_menu]";
//Lakukan Rekursi pada Anak kategori di bawahnya
childcats($a);
}
}
$no=1;
//Menampilkan Categori dengan id_parent 0
$sql2=$db->query("SELECT * FROM menuadmin WHERE idparent='0' order by urutan");

while($s=$sql2->fetch_array()){
if($s['aktif']=='Y'){
$aktif = '<span class="label label-info"><span class="glyphicon glyphicon-check"></span></span>';
$title = 'unPublish';
$link = "?panel=menuadmin&act=publish&status=$title&id=$s[idmenu]";
}else{
$aktif = '<span class="label label-danger"><span class="glyphicon glyphicon-minus"></span></span>';
$title = 'Publish';
$link = "?panel=menuadmin&act=publish&status=$title&id=$s[idmenu]";
}
echo "<tr>";
$a=$s['idmenu'];
?>
<td align="center"><?=$no++;?></td>
<td><a href="?<?=$mode;?>=<?=$module;?>&act=edit<?=$module;?>&id=<?=$s['idmenu'];?>"  data-toggle="tooltip" title="Edit Data"><?=$s['nama_menu'];?></a></td>
<td><?=$s['link'];?></td>
<td align="center"><a href="<?=$link;?>"  data-toggle="tooltip" title="<?=$title;?>"><?=$aktif;?></a></td>
<td align="center">
<a href="?<?=$mode;?>=<?=$module;?>&act=edit<?=$module;?>&id=<?=$s['idmenu'];?>"  data-toggle="tooltip" title="Edit Data"><i class="fa fa-edit"></i> </a>
<a data-href="?<?=$mode;?>=<?=$module;?>&act=hapus&id=<?=$s['idmenu'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
</td>
<td align="center"><?=$s['urutan'];?></td>
<?php
//Memanggil Anak kategori
childcats($a);
echo "</tr>";
}
?>

			</tbody>
                                    </table>
                                </div><!-- /.box-body -->
<div class="box-footer clearfix">
                                        <div class="col-md-12 text-right">
										<ul class="pagination" id="myPagerKategori"></ul>
										</div>
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
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
                    <p>Anda akan menghapus satu url, prosedur ini tidak dapat diubah.</p>
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
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
        })
    </script>
<?php 
    break;
	
	case "tambah$module":
	include"form.php";
    break;
	
	case "edit$module":
	include"form.php";
    break;
	
	case "save":
	include"save.php";
    break;
	
	case "hapus":
	include"hapus.php";
    break;
	
	case "publish":
	if ($status=='Publish'){
	$db->query("UPDATE menuadmin SET aktif='Y' WHERE idmenu='".$GETID."'");
	save_alert('update',update);
	htmlRedirect('?'.$mode.'='.$module);
	}else{
	$db->query("UPDATE menuadmin SET aktif='N' WHERE idmenu='".$GETID."'");
	save_alert('update',update);
	htmlRedirect('?'.$mode.'='.$module);
	}
    break;
	}

}
 ?>