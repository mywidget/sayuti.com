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
                                                <th>Nama FO</th>
												<th style="width:7%;text-align:center">Panggilan</th>
												<th style="width:7%;text-align:center">Slug</th>
												<th style="width:7%;text-align:center">Status</th>
                                                <th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
									<tbody>
<?php
$sql = $db->query("SELECT * FROM fo order by id ASC");
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
	$plugin = "[".$row['data']."]";
	$var = json_decode($plugin);
	$nama = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
	// print_r($var);
?>
<tr>
	<td><?php echo $nom;?></td>
	<td><a href="?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['id'];?>"><?php echo $nama;?></a></td>
	<td class="text-left"><?=$namap;?></td>
	<td class="text-left"><?=$row['slug'];?></td>
	<td class="text-center"><?php echo $gbrs;?></td>
	<td class="text-center"><a href='?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['id'];?>' data-toggle='tooltip' title='Edit Data'><i class='fa fa-edit'></i> </a></td>
</tr>
<?php $nom++; }	?>
									</tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
<?php 
    break;
	
	case "edit":
$pathFile = "$mode/$module/form_edit.php";
if (file_exists($pathFile)){
	include __DIR__ . '/form_edit.php';
}else{
	echo "error";
}
    break;
	
	case "save":
$pathFile = "$mode/$module/save.php";
if (file_exists($pathFile)){
	include __DIR__ . '/save.php';
}else{
	echo "error";
}
    break;

	}
 ?>