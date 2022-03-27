<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
switch($act){
  // Tampil List berita
  default:
   // echo alertfly($alert);
?>
<script type="text/javascript">
$(document).ready(function() {
	$('#jsontable').DataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "panel/post/serverSide.php",
		"sServerMethod": "POST",
		"aaSorting": [[ 6, "desc" ]],
		"aoColumns": [
			null,
			null,
			null,
			null,
			null,
			null
		]
	} );
} );
</script>
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data berita</h3>     
										<a href="?<?=$mode;?>=<?=$module;?>&act=tambah" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah berita</a>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table id="jsontable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:1% !important;" >No</th>
                                                <th>Judul</th>
                                                <th style="width:20%;">Kategori</th>
                                                <th style="width:7%;text-align:center">Publish</th>
                                                <th style="width:14%;text-align:center">Tanggal</th>
                                                <th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
	
	case "edit$module":
	include __DIR__ . '/form.php';
    break;
	
	case "save":
	// include "../g-asset/class_sitemap.php";
	include __DIR__ . '/save.php';
    break;
	case "hapus":
	include __DIR__ . '/hapus.php';
    break;
	
	case "headline":
	if ($status=='headline'){
$y = 'Y';
$edit = $db->prepare("UPDATE `posting` SET `headline`=? WHERE id_post=?");
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
	if ($status=='unheadline'){
$y = 'N';
$edit = $db->prepare("UPDATE `posting` SET `headline`=? WHERE id_post=?");
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
	case "publish":
	if ($status=='publish'){
$y = 'Y';
$edit = $db->prepare("UPDATE `posting` SET `publish`=? WHERE id_post=?");
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
$edit = $db->prepare("UPDATE `posting` SET `publish`=? WHERE id_post=?");
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
}
 ?>