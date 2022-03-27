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
<link href="panel/menuadmin/style.css" rel="stylesheet" type="text/css" />
<script src="plugins/validation.min.js" type="text/javascript"></script>
<div class="row">
<div id="load"></div>
<div class="error"></div>
<div class="col-xs-12">
<div class="box">
		<div class="box-header with-border">
         <h3 class="box-title">Data Menu Website</h3>    	 
    <span id="nestable-menu">
        <button type="button" class="btn btn-success pull-right" onclick="callFunction(this)" id="kolapse"> Expand</button>
    </span>
        </div>
<div class="box-body">
<div class="col-md-4">
<div class="ns-row" id="ns-header">
						<div class="ns-title">Tambah Menu</div>
					</div>
<form id="submit-form">
<input type="hidden" id="id">
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="label">Nama Menu</label>
                      <input class="form-control" id="label" placeholder="Nama menu" type="text" >
                    </div>
                    <div class="form-group">
<input type="radio" id="radio1" name='from' value='link' checked> Link &nbsp; 
                            <input type="radio" id="radio2" name='from' value='page'> Halaman &nbsp; 
                            <input type="radio" id="radio3" name='from' value='kategori'> Kategori
                            <input type="radio" id="radio4" name='from' value='kategorip'> K Produk
                    </div>
                    <div class="form-group">
                    <tr><td><input class='form-control link' type="text" id="link" placeholder="http://domain.com/page" autocomplete='off' required>
                            <select class='form-control page' type="text" id="page" required>
                              <option value=''>- Halaman -</option>
                              <?php 
$sql = $db->query("SELECT * FROM `page` ");
while($row = $sql->fetch_array()){
	echo '<option value="/page/'.$row['judul_seo'].'">'.$row['judul'].'</option>';
}
                              ?>
                            </select>
                            <select class='form-control kategori' type="text" id="kategori" required>
                              <option value=''>- Kategori -</option>
                              <?php 
$sql = $db->query("SELECT * FROM `cat`");
while($row = $sql->fetch_array()){
	echo '<option value="/'.$row['kategori_seo'].'">'.$row['nama_kategori'].'</option>';
}
                              ?>
                            </select>
                            <select class='form-control kategorip' type="text" id="kategorip" required>
                              <option value=''>- Kategori Produk -</option>
                              <?php 
$sql = $db->query("SELECT * FROM `jenis_produk` ");
while($row = $sql->fetch_array()){
	echo '<option value="/produk/'.$row['seo_produk'].'">'.$row['produk'].'</option>';
}
                              ?>
                            </select>
                    </td></tr>
                    </div>
					<label for="eclass">CLASS ICON</label>
					<div class="input-group">
                    <div class="input-group-addon">
							<i class="fa fa-bars" id="showicon"></i></a>
					</div>
                   <input class="form-control" id="eclass" placeholder="bars" type="text" value="">
                    <div class="input-group-addon">
					<a href="#" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-search"></i></a>
                    </div>
                  </div>
					<label for="eclass">Aktif</label>
					<div class="form-group">
					<select id="aktif" class="form-control">
					<option value="">Pilih</option>
					<option value="0">Ya</option>
					<option value="1">Tidak</option>
					</select>					
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
				  <button class="btn btn-success" id="submits">Submit</button> 
				  <button class="btn btn-danger" id="reset">Reset</button>
                  </div>
</form>
</div>
    <div class="cf nestable-listsss">
        <div class="dd col-md-8" id="nestable">
<div class="ns-row" id="ns-header">
						<div class="ns-actions-2">#</div>
						<div class="ns-actions">AKSI</div>
						<div class="ns-class">CLASS CSS</div>
						<div class="ns-url">URL</div>
						<div class="ns-title">NAMA MENU</div>
					</div>
<?php

$query = $db->query("select * from menu order by global");
 
$ref   = [];
$items = [];

while($data = $query->fetch_object()) {

    $thisRef = &$ref[$data->id];

    $thisRef['parent_id'] = $data->parent_id;
    $thisRef['name'] = $data->name;
    $thisRef['link'] = $data->link;
    $thisRef['class'] = $data->class;
    $thisRef['id'] = $data->id;

   if($data->parent_id == 0) {
        $items[$data->id] = &$thisRef;
   } else {
        $ref[$data->parent_id]['child'][$data->id] = &$thisRef;
   }

}

function get_menu($items,$class = 'dd-list') {

    $html = "<ol class=\"".$class."\" id=\"menu-id\">";

    foreach($items as $key=>$value) {
		$html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >
		<div class="dd-handle dd3-handle"></div>
		<div class="ns-row">
		<div class="ns-title" id="label_show'.$value['id'].'">'.$value['name'].'</div>
		<div class="ns-url" id="link_show'.$value['id'].'">'.$value['link'].'</div>
		<div class="ns-class" id="eclass_show'.$value['id'].'">'.$value['class'].'</div>
		<div class="ns-actions">
		<a class="edit-button" id="'.$value['id'].'""><i class="fa fa-pencil"></i></a>
		<a href="#" class="confirm-delete" data-id="'.$value['id'].'" id="'.$value['id'].'"><i class="fa fa-trash"></i></a>
		</div>
		<div class="ns-actions-2"></div>
		</div>';
        if(array_key_exists('child',$value)) {
            $html .= get_menu($value['child'],'child');
        }
            $html .= "</li>";
    }
    $html .= "</ol>";

    return $html;

}
 
print get_menu($items);

?>
    <input type="hidden" id="nestable-output">
                  <div class="box-footer pull-right">
                    <button id="save" type="button" class="btn btn-success">Simpan</button>
                  </div>
        </div>
    </div>
    </div>
    </div>
<script src="panel/sitemenu/addon.js" type="text/javascript"></script>
</div>
<script>

</script>
    <div class="modal fade" id="myModalDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-md">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>Anda akan menghapus satu data, prosedur ini tidak dapat diubah.</p>
                    <p>Apakah Anda ingin melanjutkan?</p>
                    <p class="debug-url"></p>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnYes" class="btn btn-danger danger">Ya</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
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