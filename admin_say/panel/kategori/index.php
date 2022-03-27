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
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data <?=$module;?></h3>     
										<a href="?<?=$mode;?>=<?=$module;?>&act=tambah<?=$module;?>" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah <?=$module;?></a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th style="width:1% !important;" >No</th>
                                                <th style='width:10%'>Kategori</th>
												<th style='width:20%'>Link</th>
												<th style="width:2%;text-align:center">Aktif</th>
												<th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTableKategori">

<?php
$sqlx=$db->query("select nama_kategori, cat.id_cat,aktif,id_parent,urutan,pub,kategori_seo,
                     count(posting.id_cat) as jml from cat left join posting 
                        on posting.id_cat=cat.id_cat group by id_cat DESC");
//fungsi untuk menampilkan Anak

function childcats($id){
global $db;
$sql=$db->query("SELECT * FROM cat WHERE id_parent='$id'");
echo '<tr>';
while($row=$sql->fetch_array()){
if($row['aktif']=='Y'){
$aktif = '<img src="img/yes.png" alt="" />';
$title = 'unPublish';
}else{
$aktif = '<img src="img/no.png" alt="" />';
$title = 'Publish';
}
$a=$row['id_cat'];
?>
<td align="center">--</td>
<td><a href="?module=kategori&act=editkategori&id=<?=$row['id_cat'];?>"  data-toggle="tooltip" title="Edit Data">>><?=$row['nama_kategori'];?></a></td>
<td><a href="../category/<?=$row['kategori_seo'];?>" target="_blank">category/<?=$s['kategori_seo'];?></a></td>
<td align="center"><a href="#"  data-toggle="tooltip" title="<?=$title;?>"><?=$aktif;?></a></td>
<td align="center">
<a href="?module=kategori&act=editkategori&id=<?=$row['id_cat'];?>"  data-toggle="tooltip" title="Edit Data"><i class="fa fa-edit"></i> </a>
<a data-href="?module=kategori&act=hapus&id=<?=$row['id_cat'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
</td>
<?php
//echo "$r[nama_menu]";
//Lakukan Rekursi pada Anak kategori di bawahnya
childcats($a);
}
}
$no=1;
//Menampilkan Categori dengan id_parent 0
$sql2=$db->query("SELECT * FROM cat WHERE id_parent='0'");

while($s=$sql2->fetch_array()){
if($s['aktif']=='Y'){
$aktif = '<img src="img/yes.png" alt="" />';
$title = 'unPublish';
}else{
$aktif = '<img src="img/no.png" alt="" />';
$title = 'Publish';
}
echo "<tr>";
$a=$s['id_cat'];
?>
<td align="center"><?=$no++;?></td>
<td><a href="?<?=$mode;?>=<?=$module;?>&act=edit<?=$module;?>&id=<?=$s['id_cat'];?>"  data-toggle="tooltip" title="Edit Data">>><?=$s['nama_kategori'];?></a></td>
<td><a href="../category/<?=$s['kategori_seo'];?>" target="_blank">category/<?=$s['kategori_seo'];?></a></td>
<td align="center"><a href="#"  data-toggle="tooltip" title="<?=$title;?>"><?=$aktif;?></a></td>
<td align="center">
<a href="?<?=$mode;?>=<?=$module;?>&act=edit<?=$module;?>&id=<?=$s['id_cat'];?>"  data-toggle="tooltip" title="Edit Data"><i class="fa fa-edit"></i> </a>
<a data-href="?<?=$mode;?>=<?=$module;?>&act=hapus&id=<?=$s['id_cat'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
</td>
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
										<ul class="pagination pagination-sm " id="myPagerKategori"></ul>
										</div>
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
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
	// cek id_cat pada tabel berita
	$cek = $db->query("SELECT * FROM berita WHERE id_cat='".$GETID."'");
	$ketemu=$cek->num_rows;
	if ($ketemu > 0){
	save_alert('error',del_err);
	htmlRedirect('?'.$mode.'='.$module);
	}else{
	$db->query("DELETE FROM kategori WHERE id_cat='".$GETID."'");
	save_alert('delete',delete);
	htmlRedirect('?'.$mode.'='.$module);
	}
    break;
	}
}
 ?>