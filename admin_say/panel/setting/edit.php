<?php
include "../../g-asset/conn_db.php";
include "../../g-asset/library_function.php";
include "../../g-asset/web_function.php";
switch($_GET['act']){
case "edit":
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Edit Data</h4>
</div>
<?php 
$sql = mysql_query("select * from cara_bayar where id_byr='$_GET[idedit]'");
$row = mysql_fetch_array($sql);
?>
				<form method="post" action="?panel=setting&act=update">
				<input type="hidden" name="id" value="<?=$_GET['idedit'];?>">
				<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-4 ">Cara Bayar </label>
					<div class="col-sm-8">
					<input type="text" name="cara" value="<?=$row['cara_bayar'];?>" class="form-control margin-5">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 ">Publish</label>
					<div class="col-sm-8">
					<input type="text" name="publish" value="<?=$row['publish'];?>" class="form-control margin-5">
					</div>
				</div>		
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success" type="submit" name="pesawat" value="Send!" id="submit">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
				</form>
<?php
break;
}
?>