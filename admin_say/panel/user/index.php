<script type="text/javascript">

function openKCFinder(field) {
    window.KCFinder = {
        callBack: function(url) {
            field.value = url;
            window.KCFinder = null;
        }
    };
    window.open('../kcfinder/browse.php?type=images&dir=images/user', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}

</script>
<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
if($chek=='puser'){
header('location:../index.php');
}else{
switch($act){
  // Tampil List user
  default:
  if ($chek='admin'){
      $sqluser = $db->query("SELECT * FROM user ORDER BY username");
?>
                        <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data User</h3>     
									<div class="box-footer clearfix no-border">
										<a href="?<?=$mode;?>=user&act=adduser" class="btn btn-default pull-left"><i class="fa fa-plus"></i> Tambah User</a>
									</div>
                                </div><!-- /.box-header table-responsive-->
                                <div class="box-body">
                                    <table id="user" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:1% !important;" >No</th>
                                                <th>Nama Pengguna</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th>No. Handphone</th>
                                                <th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 <?php


$no=1;
while($row=$sqluser->fetch_array()){
 ?>
                                            <tr>
                                                <td align="center"><?=$no;?></td>
                                                <td><a href="?<?=$mode;?>=user&act=edituser&id=<?=$row['id_session'];?>"  data-toggle="tooltip" title="Edit Data"><?php echo $row['username'];?></a></td>
                                                <td><?php echo $row['nama'];?></td>
                                                <td><?php echo $row['email'];?></td>
                                                <td><?php echo $row['no_hp'];?></td>
                                                <td align="center">
												<a href="?<?=$mode;?>=user&act=edituser&id=<?=$row['id_session'];?>"  data-toggle="tooltip" title="Edit Data"><i class="fa fa-edit"></i> </a> 
												<a data-href="?<?=$mode;?>=<?=$module;?>&act=hapus&id=<?=$row['id_user'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
												</td>
                                            </tr>
<?php $no++; } ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
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
    }else{
	$sqluser=$db->query("SELECT * FROM users WHERE username='$_SESSION[namauser]'");
	include"form_user.php";
 }
    break;
	
	case "save":
	include"save_adm.php";
    break;
	
	case "save_user":
	include"save_user.php";
    break;
	
	case "adduser":
	include"form_admin.php";
    break;
	
	case "edituser":
	include"form_admin.php";
    break;
	
	case "hapus":
	$sql = $db->query("DELETE FROM user WHERE id_user='".$GETID." AND id_lock!=1'");
	if($sql){
	save_alert('delete',delete);
	}else{
	save_alert('delete',nodell);
	}
	htmlRedirect('?'.$mode.'='.$module);
    break;
	}
}
 ?>