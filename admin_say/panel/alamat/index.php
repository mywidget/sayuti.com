<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');
switch($act){
  default:
?>

                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data</h3>     
									<div class="box-footer clearfix no-border">
										<a href="?<?=$mode;?>=<?=$module;?>&act=tambah" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah</a>
									</div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table id="user" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:1% !important;" >No</th>
                                                <th>Nama Kantor</th>
                                                <th>Telp.</th>
                                                <th style="width:7%;text-align:center">Publish</th>
                                                <th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
									<tbody>
<?php
$sql = $db->query("SELECT * FROM kantor order by id DESC");
$nom=1;
while($row=$sql->fetch_array()){
	if($row['pub'] == 0){
	$titles	= "unpublish";
	$links 	= "?$mode=$module&act=publish&status=$titles&id=$row[id]";
	$gbrs	= '<img src="img/yes.png" alt="" />';
	}
	if($row['pub'] == 1){
	$titles	= "publish";
	$links 	= "?$mode=$module&act=publish&status=$titles&id=$row[id]";
	$gbrs	= '<img src="img/no.png" alt="" />';
	}
?>
<tr>
	<td><?php echo $nom;?></td>
	<td><a href="?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['id'];?>"><?php echo $row['nama_kantor'];?></a></td>
	<td class="text-left"><?=$row['tlp'];?></td>
	<td class="text-center"><?php echo $gbrs;?></td>
	<td><a href='?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['id'];?>'  data-toggle='tooltip' title='Edit Data'><i class='fa fa-edit'></i> </a> <a data-href="?'.<?=$mode;?>.'=<?=$module;?>&act=hapus&id=<?=$row['id'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a></td>
</tr>
<?php $nom++; }	?>
									</tbody>
                                    </table>
                                </div><!-- /.box-body -->
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
            
            //$('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
        })
    </script>
<?php 
    break;
	case "tambah":
	include __DIR__ . '/form.php';
    break;
	
	case "edit":
	include __DIR__ . '/form.php';
    break;
	
	case "save":
	include __DIR__ . '/save.php';
    break;
	case "hapus":
	include __DIR__ . '/hapus.php';
    break;
	
	case "publish":
	if ($status=='publish'){
$y = 'Y';
$edit = $mysqli->prepare("UPDATE `posting` SET `publish`=? WHERE id_post=?");
$edit->bind_param("si",$y,$GETID);
if($edit->execute())
{
		save_alert('update',update);
	htmlRedirect('?'.$mode.'='.$module.'&alert=update');
}else{
    // echo "GAGAL UPDATE";
	save_alert('error',$insert->error);
}
	}
	if ($status=='unpublish'){
$y = 'N';
$edit = $mysqli->prepare("UPDATE `posting` SET `publish`=? WHERE id_post=?");
$edit->bind_param("si",$y,$GETID);
if($edit->execute())
{
		save_alert('update',update);
	htmlRedirect('?'.$mode.'='.$module.'&alert=update');
}else{
    // echo "GAGAL UPDATE";
	save_alert('error',$insert->error);
}
	}
    break;
	}
 ?>