<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');
switch($act){
  default:
?>

                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Plugin</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:1% !important;" >No</th>
                                                <th>Nama Plugin</th>
												<th style="width:7%;text-align:center">Status</th>
                                                <th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
									<tbody>
<?php
$sql = $db->query("SELECT * FROM plugin order by id ASC");
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
	<td><a href="?<?=$mode;?>=<?=$module;?>&act=plug&url=<?=$row['url'];?>&id=<?=$row['id'];?>"><?php echo $row['nama'];?></a></td>
	<td class="text-center"><?php echo $gbrs;?></td>
	<td><a href='?<?=$mode;?>=<?=$module;?>&act=<?=$row['url'];?>&id=<?=$row['id'];?>' data-toggle='tooltip' title='Edit Data'><i class='fa fa-edit'></i> </a></td>
</tr>
<?php $nom++; }	?>
									</tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
<?php 
    break;
	
	case "plug":
$pathFile = "$mode/$module/form_$url.php";
if (file_exists($pathFile)){
	include __DIR__ . '/form_'.$url.'.php';
}else{
	echo "error";
}
    break;
	
	case "save":
$pathFile = "$mode/$module/save_$url.php";
if (file_exists($pathFile)){
	include __DIR__ . '/save_'.$url.'.php';
}else{
	echo "error";
}
    break;

	}
 ?>