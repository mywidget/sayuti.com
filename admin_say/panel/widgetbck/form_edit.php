<?php 
// error_reporting(0);
// if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
	$link = "http://$_SERVER[HTTP_HOST]";
$sql = $db->query("SELECT * FROM `widget_wa`  WHERE xcode=".$GETID);
$data=$sql->fetch_array();
	$nama 	= $data['judul'];
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$url = $var[0]->widget->url;
	$title = !empty($var[0]->widget->title)?$var[0]->widget->title:"";
	$w_desc = $var[0]->widget->desc;
	$newtab = $var[0]->widget->newtab;
	if($newtab==1){
		$checked = 'checked';
	}else{
		$checked = '';
	}
	$show_title = $var[0]->widget->styletitle;
	if($show_title==1){
		$s_checked = 'checked';
	}else{
		$s_checked = '';
	}
	$automobile = $var[0]->widget->automobile;
	if($automobile==1){
		$a_checked = 'checked';
	}else{
		$a_checked = '';
	}
	$var0 = $var[0]->widget->xgen;
	$name = $var0[0]->agent;
	
	if($var[0]->widget->style==1) {
		$style1 = '<input type="radio" name="w_style" id="w_style1" value="1" checked>';
		$style2 = '<input type="radio" name="w_style" id="w_style2" value="2">';
		$style3 = '<input type="radio" name="w_style" id="w_style3" value="3">';
	}elseif($var[0]->widget->style==2) {
		$style1 = '<input type="radio" name="w_style" id="w_style1" value="1">';
		$style2 = '<input type="radio" name="w_style" id="w_style2" value="2" checked>';
		$style3 = '<input type="radio" name="w_style" id="w_style3" value="3">';
	} else{
		$style1 = '<input type="radio" name="w_style" id="w_style1" value="1">';
		$style2 = '<input type="radio" name="w_style" id="w_style2" value="2">';
		$style3 = '<input type="radio" name="w_style" id="w_style3" value="3" checked>';
	}
	if($var[0]->widget->position=='left') {
		$position1 = '<input type="radio" name="w_position"  value="left" checked>';
		$position2 = '<input type="radio" name="w_position"  value="right">';
	}else{
		$position1 = '<input type="radio" name="w_position"  value="left">';
		$position2 = '<input type="radio" name="w_position"  value="right" checked>';
	}
	if($var[0]->widget->mode==2){
		$mode2 = '<input type="radio" name="w_mode" id="w_mode1" class="minimal" value="2" checked>';
		$mode1 = '<input type="radio" name="w_mode" id="w_mode2" class="minimal" value="1">';
	}else{
		$mode2 = '<input type="radio" name="w_mode" id="w_mode1" class="minimal" value="2">';
		$mode1 = '<input type="radio" name="w_mode" id="w_mode2" class="minimal" value="1" checked>';
	}
	if($var[0]->widget->responsive==1){
		$w_responsive1 = '<input type="radio" id="w_responsive1" name="w_responsive" class="minimal" value="1" checked="checked">';
		$w_responsive2 = '<input type="radio" id="w_responsive2" name="w_responsive" class="minimal" value="2">';
	}else{
		$w_responsive1 = '<input type="radio" id="w_responsive1" name="w_responsive" class="minimal" value="1">';
		$w_responsive2 = '<input type="radio" id="w_responsive2" name="w_responsive" class="minimal" value="2" checked="checked">';
	}
	if($var[0]->widget->show==1) {
		$show_widget1 = '<input type="radio" name="show_widget" id="show_widget1" class="minimal" value="1" checked>';
		$show_widget2 = '<input type="radio" name="show_widget" id="show_widget2" class="minimal" value="2">';
		$show_widget3 = '<input type="radio" name="show_widget" id="show_widget3" class="minimal" value="3">';
	}elseif($var[0]->widget->show==2) {
		$show_widget1 = '<input type="radio" name="show_widget" id="show_widget1" class="minimal" value="1">';
		$show_widget2 = '<input type="radio" name="show_widget" id="show_widget2" class="minimal" value="2" checked>';
		$show_widget3 = '<input type="radio" name="show_widget" id="show_widget3" class="minimal" value="3">';
	} else{
		$show_widget1 = '<input type="radio" name="show_widget" id="show_widget1" class="minimal" value="1">';
		$show_widget2 = '<input type="radio" name="show_widget" id="show_widget2" class="minimal" value="2">';
		$show_widget3 = '<input type="radio" name="show_widget" id="show_widget3" class="minimal" value="3" checked>';
	}
	if($var[0]->widget->autolabel==1) {
		$aowon1 = '<input type="radio" name="aowon" id="aowon1" class="minimal" value="1" checked>';
		$aowon2 = '<input type="radio" name="aowon" id="aowon2" class="minimal" value="2">';
		$aowon3 = '<input type="radio" name="aowon" id="aowon3" class="minimal" value="3">';
	}elseif($var[0]->widget->autolabel==2) {
		$aowon1 = '<input type="radio" name="aowon" id="aowon1" class="minimal aowon" value="1">';
		$aowon2 = '<input type="radio" name="aowon" id="aowon2" class="minimal aowon" value="2" checked>';
		$aowon3 = '<input type="radio" name="aowon" id="aowon3" class="minimal aowon" value="3">';
	} else{
		$aowon1 = '<input type="radio" name="aowon" id="aowon1" class="minimal" value="1">';
		$aowon2 = '<input type="radio" name="aowon" id="aowon2" class="minimal" value="2">';
		$aowon3 = '<input type="radio" name="aowon" id="aowon3" class="minimal" value="3" checked>';
	}
	$nobrand = $var[0]->widget->nobrand;
	if($nobrand==1){
		$n_checked = 'checked';
	}else{
		$n_checked = '';
	}
}else{
		$style1 = '<input type="radio" name="w_style" id="w_style1" value="1" checked>';
		$style2 = '<input type="radio" name="w_style" id="w_style2" value="2">';
		$style3 = '<input type="radio" name="w_style" id="w_style3" value="3">';
		$position1 = '<input type="radio" name="w_position"  value="left" checked>';
		$position2 = '<input type="radio" name="w_position"  value="right">';
		$mode2 = '<input type="radio" name="w_mode" id="w_mode1" class="minimal" value="2" checked>';
		$mode1 = '<input type="radio" name="w_mode" id="w_mode2" class="minimal" value="1">';
		$show_widget1 = '<input type="radio" name="show_widget" id="show_widget1" value="1" checked>';
		$show_widget2 = '<input type="radio" name="show_widget" id="show_widget2" value="2">';
		$show_widget3 = '<input type="radio" name="show_widget" id="show_widget3" value="3">';
		$aowon1 = '<input type="radio" name="aowon" id="aowon1" class="minimal" value="1" checked>';
		$aowon2 = '<input type="radio" name="aowon" id="aowon2" class="minimal" value="2">';
		$aowon3 = '<input type="radio" name="aowon" id="aowon3" class="minimal" value="3">';
		$w_responsive1 = '<input type="radio" id="w_responsive1" name="w_responsive" class="minimal" value="1" checked="checked">';
		$w_responsive2 = '<input type="radio" id="w_responsive2" name="w_responsive" class="minimal" value="2">';
		$checked = 'checked';
		$a_checked = '';
		$$s_checked = '';
		$$n_checked = '';
		$name = array("name"=>"Nama Agen");
	
}
echo ImgAgen('bukaForm','images','images/agen/');
?>
<style>
li{list-style:none}
body.post-type-widget .field-repeater-toggle-all {
    position: absolute;
    right: 10px;
}
.wp-core-ui .button, .wp-core-ui .button-secondary, .wp-core-ui .button-primary {
    border-radius: 30px;
}
.wp-core-ui .button, .wp-core-ui .button-secondary {
    color: #555;
    border-color: #ccc;
    background: #f7f7f7;
    box-shadow: 0 1px 0 #ccc;
    vertical-align: top;
}
.wp-core-ui .button, .wp-core-ui .button-primary, .wp-core-ui .button-secondary {
    display: inline-block;
    text-decoration: none;
    font-size: 13px;
    line-height: 26px;
    height: 28px;
    margin: 0;
    padding: 0 10px 1px;
    cursor: pointer;
    border-width: 1px;
    border-style: solid;
    -webkit-appearance: none;
    border-radius: 3px;
    white-space: nowrap;
    box-sizing: border-box;
}
.field-repeater-toggle-all, .field-flexible-toggle {
    position: relative;
    z-index: 990;
    float: right;
    margin: -6px 0 0 !important;
    padding: 0 5px 1px !important;
}
button, input, select, textarea {
    font-family: inherit;
    font-size: inherit;
    font-weight: inherit;
}
#files {
    height: 90px;
    cursor: pointer
}
#image {
    width: 150px;
    height: 150px;
    overflow: hidden;
    cursor: pointer;
    background: #000;
    color: #fff;
}
#image img {
    visibility: hidden;
}
#imageup {
    width: 150px;
    height: 100px;
    overflow: hidden;
    cursor: pointer;
    background: #000;
    color: #fff;
}
#imageup img {
    visibility: hidden;
}
textarea#files {
    width: 100%;
    height: 100px;
    cursor: pointer
}
</style>
<link href="dist/css/acf-input.css?ver=5.7.7" rel="stylesheet"/>
<link href="panel/plugin/css/style.css" rel="stylesheet">
<script async src="//imgs.info/sdk/pup.js" data-url="https://imgs.info/upload" data-auto-insert="direct-links"  data-sibling-pos="before"></script>
<script>
function copy() {
  let textarea = document.getElementById("salinKode");
  textarea.select();
  document.execCommand("copy");
}
</script>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
					<form role="form" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save">
					<input type="hidden" name="id" value="<?php echo !empty($GETID)?$GETID:''; ?>">
                        <div class="col-md-12">
                            <div class="box">
								<div class="box box-primary">
                                <div class="box-header">
								<?php if($GETID > 0) { ?>
                                    <h3 class="box-title">Edit Widget</h3>
									<?php }else{ ?>
                                    <h3 class="box-title">Input Widget</h3>
									<?php } ?>
								<div class="pull-right box-tools">
									<?php if($GETID > 0) { ?>
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
									<?php }else{ ?>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									<?php } ?>
								<a href="?<?=$mode;?>=<?=$module;?>" class="btn btn-danger">Batal</a>
                                </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                <div class="box-body">
<?php if($GETID > 0) {	?>
<div class="input-group input-group-sm">
                <textarea id="salinKode" class="form-control" rows="1" style="background:#fff;width:100%;" readonly="readonly">&lt;script async data-id="<?=$GETID;?>" src="<?=$link;?>/widget.script.min.js"&gt;&lt;/script&gt;</textarea>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger" onclick="copy()">Salin Kode</button>
                    </span>
</div>
<?php } ?>
<br/>
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Pengaturan</a></li>
              <li><a href="#tab_2" data-toggle="tab">Tampilan</a></li>
              <li><a href="#tab_3" data-toggle="tab">Pengguna</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <div class="box-body">
                <div class="form-group">
                  <label for="site_url" class="col-sm-3 control-label">Site URL *</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="site_url" id="site_url" placeholder="http://" value="<?=!empty($url)?$url:''; ?>" required>
					<span class="help-block">URL situs web tempat widget ditempatkan. Ini wajib untuk digunakan http / https sebelum url.</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="w_title" class="col-sm-3 control-label">Judul Widget</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="w_title" id="w_title" placeholder="Butuh bantuan" value="<?=!empty($title)?$title:''; ?>">
					<span class="help-block">Judul untuk tombol widget mengambang</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="w_desc" class="col-sm-3 control-label">Deskripsi Widget</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="w_desc" id="w_desc" placeholder="Butuh bantuan" value="<?=!empty($w_desc)?$w_desc:''; ?>">
					<span class="help-block">Deskripsi singkat widget</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="w_mode" class="col-sm-3 control-label">Mode Widget</label>
                  <div class="col-sm-9">

                  <div class="radio1">
				<label>
                  <?=$mode2;?>
                </label>
                <label>
                  Mode Langsung
                </label>

                  </div>
                  <div class="radio2">
				<label>
                  <?=$mode1;?>
                </label>
                <label>
                  Mode Balas
                </label>
                  </div>
					<span class="help-block">Mode Langsung : Terhubung ke Whatsapp segera setelah mengklik agen
					<br/>Mode Balas : Mode percakapan dengan balasan input dan pesan intro setelah mengklik agen</span>
                  </div>
                </div>

                <div class="form-group replay">
                  <label for="w_replay" class="col-sm-3 control-label">Balas ke Teks</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="w_replay" id="w_replay" placeholder="Replay To" value="<?=!empty($var[0]->widget->reply)?$var[0]->widget->reply:''; ?>">
					<span class="help-block">Balas ke Teks pada kolom input balasan dalam Mode Balas</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="show_widget" class="col-sm-3 control-label">Show Widget On</label>
                  <div class="col-sm-9">
		<div class="acf-input">
		<ul class="acf-radio-list acf-bl" data-allow_null="0" data-other_choice="0">
		<li><label class="selected">
		<?=$show_widget1;?> All</label>
		</li>
		<li><label class=""><?=$show_widget2;?> Desktop Only</label>
		</li>
		<li><label><?=$show_widget3;?> Mobile Only</label>
		</li>
		</ul>
		<p class="description">Choose to display widget on all device or specific to desktop / mobile only</p>	</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="show_widget" class="col-sm-3 control-label">Auto Open Widget On</label>
                  <div class="col-sm-9">
		<div class="acf-input">
		<ul class="acf-radio-list acf-bl" data-allow_null="0" data-other_choice="0">
		<li><label class="selected">
		<?=$aowon1;?> Disabled</label>
		</li>
		<li><label class=""><?=$aowon2;?> Delay Time</label>
		</li>
		<li><label><?=$aowon3;?> Page Scroll</label>
		</li>
		</ul>
		<p class="description">Choose to display widget on all device or specific to desktop / mobile only</p>	</div>
                  </div>
                </div>
                <div class="form-group delay">
                  <label for="w_delay" class="col-sm-3 control-label">Delay Time</label>
                  <div class="col-sm-9">
<div class="input-group input-group-sm">
                <input type="number" class="form-control" name="w_delay" min="1" max="100" id="w_delay" value="<?=!empty($var[0]->widget->auto)?$var[0]->widget->auto:''; ?>">
                    <span class="input-group-btn">
                      <button type="button" class="btn">%</button>
                    </span>
</div>
					<span class="help-block">Persentase (0 - 100) halaman gulir untuk memicu widget terbuka secara otomatis.</span>
                  </div>
                </div>
                <div class="form-group gulir">
                  <label for="w_gulir" class="col-sm-3 control-label">Gulir Panjang</label>
                  <div class="col-sm-9">
<div class="input-group input-group-sm">
                <input type="number" class="form-control" name="w_gulir" min="1" max="100" id="w_gulir" value="<?=!empty($var[0]->widget->autoscroll)?$var[0]->widget->autoscroll:''; ?>">
                    <span class="input-group-btn">
                      <button type="button" class="btn">%</button>
                    </span>
</div>
					<span class="help-block">Persentase (0 - 100) halaman gulir untuk memicu widget terbuka secara otomatis.</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="enable_open" class="col-sm-3 control-label">Aktifkan Widget Buka Otomatis di Seluler</label>
                  <div class="col-sm-9"><label>
                    <input id="enable_open" type="checkbox" name="enable_open" class="minimal" <?=$a_checked;?>> Aktifkan</label>
                  </div>
                </div>
               <div class="col-sm-12"></div>
                <div class="form-group">
                  <label for="w_tab" class="col-sm-3 control-label">Buka di Tab Baru</label>
                  <div class="col-sm-9">
					<label>
                  <input type="checkbox" name="w_tab" class="minimal"  <?=$checked;?>>
                  Aktifkan
                </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nobrand" class="col-sm-3 control-label">Hide Footer brand</label>
                  <div class="col-sm-9">
					<label>
                  <input type="checkbox" name="nobrand" class="minimal"  <?=$n_checked;?>>
                  Aktifkan
                </label>
                  </div>
                </div>
              </div>
              </div>
<style>
/* HIDE RADIO */
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  outline: 2px solid #f00;
}
</style>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
              <div class="box-body">
              <div class="row">
			  <div class="col-sm-12">
                <div class="form-group">
                  <label for="site_url" class="col-sm-2 control-label">Gaya Widget</label>
                  <div class="col-sm-4">
				  <label>
					<?=$style1;?>
                    <img class="text-center img-responsive" src="icon/btn-1.png"  alt="" />
					<p>Style 1</p>
					</label>
                  </div>
                  <div class="col-sm-4">
				  <label>
					<?=$style2;?>
                    <img src="icon/btn-2.png" class="img-responsive" alt="" />
					<p>Style 2</p>
					</label>
                  </div>
				  <div class="col-sm-2">
				   <label>
					<?=$style3;?>
                    <img src="icon/btn-3.png" height="60" class="img-responsive" alt="" />
					<p>Style 3</p>
					</label>
                  </div>
                </div>
                </div>
                  <div class="col-sm-12">
				<div class="form-group style_3">
                  <label for="show_title" class="col-sm-2 control-label"> Tampilkan Judul Widget</label>
                  <div class="col-sm-10">
					<label>
                  <input type="checkbox" name="show_title" class="minimal" <?=$s_checked;?>>
                  Aktifkan
                </label>
				<span class="help-block">Tampilkan atau sembunyikan judul widget untuk Style 3</span>
                  </div>
                </div>
                </div>
 <div class="col-sm-12">
                <div class="form-group">
                  <label for="site_url" class="col-sm-2 control-label">Posisi Widget</label>
                  <div class="col-sm-5">
				  <label>
				  <?=$position1;?>
                    <img src="icon/widget-position_left.png" class="img-responsive" height="180" alt="" />
					<p>Kiri Bawah Layar</p>
					</label>
                  </div>
                  <div class="col-sm-5">
				  <label>
				  <?=$position2;?>
                    <img src="icon/widget-position_right.png" class="img-responsive" height="180" alt="" />
					<p>Kanan Bawah Layar</p>
					</label>
                  </div>
                </div>
                </div>
<?php
	$pilihan_style = array(1=>'Button Icon 1',2=>'Button Icon 2',3=>'Button Icon 3',4=>'Button Icon 4',5=>'Button Icon 5',6=>'Button Icon 6',7=>'Button Icon 7',8=>'Button Icon 8',9=>'Button Icon 9',10=>'Button Icon 10',11=>'Button Icon 11',12=>'Button Icon 12',13=>'Button Icon 13',14=>'Button Icon 14',15=>'Button Icon 15',16=>'Button Icon 16',17=>'Button Icon 17',18=>'Button Icon 18',19=>'Button Icon 19',20=>'Button Icon 20');
	$pilihan_posisi = '';
	$datakey = !empty($var[0]->widget->icon)?$var[0]->widget->icon:$pilihan_posisi;
	foreach ($pilihan_style as $key => $status) {
	$pilihan_posisi .= "<option value=$key";
	if ($key == $datakey) {
	$pilihan_posisi .= " selected";}
	$pilihan_posisi .= ">$status</option>\r\n";}
?>
 <div class="col-sm-12">
                <div class="form-group">
                  <label for="w_icon" class="col-sm-2 control-label">Ikon widget</label>
                  <div class="col-sm-10">
                <select  class="form-control select2" name="w_icon" style="width: 100%;">
                  <?=$pilihan_posisi;?>
                </select>
                  </div>
                </div>
                </div>
 <div class="col-sm-12">
				<div class="form-group" style="margin-top:10px">
                  <label for="w_responsive" class="col-sm-2 control-label">Widget Responsive</label>
                  <div class="col-sm-10">
					<?=$w_responsive1;?>Full Responsive
					<?=$w_responsive2;?>Desktop Style
                  </div>
                </div>
                </div>
				<div class="col-sm-12">
				<div class="form-group" style="margin-top:10px">
                  <label for="w_color" class="col-sm-2 control-label">Warna Widget</label>
                  <div class="col-sm-10">
                    <input type="text" name="w_color" id="w_color" class="form-control my-colorpicker1" value="<?=!empty($var[0]->widget->color)?$var[0]->widget->color:'#17bb67'; ?>">
                  </div>
                </div>
                </div>
 <div class="col-sm-12">
				<div class="form-group" style="margin-top:10px">
                  <label for="w_zindex" class="col-sm-2 control-label">CSS Z-Index</label>
                  <div class="col-sm-10">
                    <input type="text" name="w_zindex" id="w_zindex" class="form-control" value="<?=!empty($var[0]->widget->zindex)?$var[0]->widget->zindex:'1'; ?>">
                  </div>
                </div>
                </div>
                </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
<table class="table table-responsive table-hover order-list" id="table">
<?php
$j = count($name);
$no=1;
for($i = 0; $i < $j ; $i++) {
$asa = !empty($name[$i]->availability)?$name[$i]->availability:0;
$a = count($asa);
$keys = array_keys($name);
$lastKey = $keys[count($keys)-1];
if($lastKey == $i AND $i !=0){
$hapus = '<a href="?panel=widget&act=hapus&id='.$GETID.'&arr='.$i.'"><i class="fa fa-close"></i></a>';
}else{
$hapus = '<i class="fa fa-eye"></i>';
}
?>
    <tbody>
        <tr class="rowCountCollapse">
            <td style="width:2% !important">
			<i id="accordion" data-toggle="collapse" data-target="#group-of-rows-<?=$i;?>" aria-expanded="false" aria-controls="group-of-rows-<?=$i;?>" class="clickable more-less<?=$i;?> fa fa-plus" aria-hidden="true"></i><br/><?=$i+1;?>
			</td>
            <td style="width:20% !important"><div class="acf-label">
						<label for="acf-field_agent_<?=$i;?>">Nama agen</label>
						<p class="description">Click tanda [+] utk expand/collapse</p>
					</div></td>
          	<td><input id="acf-field_agent_<?=$i;?>" class="form-control" name="nama_agent[]" placeholder="Nama agen" type="text" value="<?=!empty($name[$i]->name)?$name[$i]->name:'Nama Agen';?>"></td> 
<td style="width:1% !important"><?=$hapus;?></td>			
        </tr>
    </tbody>
    <tbody id="group-of-rows-<?=$i;?>" class="collapse">
        <tr>
		 <td>&nbsp;</td>
 <td><div class="acf-label">
						<label for="acf-field_number<?=$i;?>">Whatsapp Number</label>
						<p class="description">Mulai dengan kode negara sebelum nomor telepon</p>
					</div></td>
          	<td><div class="acf-input">
						<div class="acf-input-wrap">
							<input id="acf-field_number<?=$i;?>" class="form-control" name="number[]" placeholder="62" type="text" value="<?=$name[$i]->number;?>">
						</div>
					</div></td> 
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><div class="acf-label">
						<label for="acf-field_photo<?=$i;?>">Photo</label>
						<p class="description">Upload/paste link yg tersedia</p>
					</div>
					</td>
          	<td>
			<img id="imgs<?=$i;?>" src="<?=!empty($name[$i]->photo)?$name[$i]->photo:'http://placehold.it/100x100';?>"  width="100" alt="your image" />
				<div class="input-group input-group-sm">
				<input type="text" readonly="readonly" onclick="bukaForm(this,'<?=$link;?>',<?=$i;?>)"
    value="<?=!empty($name[$i]->photo)?$name[$i]->photo:'';?>" name="photo[]" id="imgInp<?=$i;?>" class="form-control" style="cursor:pointer" />
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger">Upload photo</button>
                    </span>
              </div>
			</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><div class="acf-label">
						<label for="acf-field_desc<?=$i;?>">Deskripsi</label>
						<p class="description">Deskripsi singkat agent</p>
					</div></td>
          	<td><div class="acf-input">
						<div class="acf-input-wrap">
							<input id="acf-field_desc<?=$i;?>" class="form-control" name="desc[]" placeholder="Deskripsi singkat" type="text" value="<?=$name[$i]->desc;?>">
						</div>
					</div></td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><div class="acf-label">
						<label for="acf-field_role<?=$i;?>">Wewenang</label>
					</div></td>
          	<td><div class="acf-input">
						<div class="acf-input-wrap">
							<input id="acf-field_role<?=$i;?>" class="form-control" name="role[]" placeholder="Customer Support" type="text" value="<?=$name[$i]->role;?>">
						</div>
					</div></td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label for="acf-field_message<?=$i;?>">Pesan Pengantar</label>
					</div>
			</td>
          	<td>
			<div class="acf-input">
						<div class="acf-input-wrap">
							<input id="acf-field_message<?=$i;?>" class="form-control" name="message[]" placeholder="Ada yang bisa dibantu?" type="text" value="<?=$name[$i]->message;?>">
						</div>
			</div>
			</td>  
        </tr>
		<tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label for="acf-field_link<?=$i;?>">Link Rekomendasi</label>
						<p class="description">Tampilkan tautan dengan gambar dan teks setelah pesan intro.</p>
			</div>
			</td>
          	<td>
								<div class="acf-input">
						<table class="acf-table" style="width:100%">
							<thead>
								<tr style="width:100%">
									<th style="width:33% !important;margin-right:10px" class="acf-th">
										<label for="acf-field_link_url<?=$i;?>">Link URL</label>
										<p class="description">Biarkan kosong untuk menonaktifkan</p>
									</th>
									<th style="width:33% !important" class="acf-th">
										<label for="acf-field_link_image<?=$i;?>">Link Image</label>
										<p class="description">Terlihat lebih baik dengan rasio aspek gambar 2: 1</p>
									</th>
									<th style="width:33% !important" class="acf-th">
										<label for="acf-field_Text<?=$i;?>">Link Text</label>
										<p class="description">Deskripsi tautan singkat</p>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td  style="width:30% !important;padding:0 10px 0 0" class="acf-field acf-field-text acf-field-">
										<div class="acf-input">
											<div class="acf-input-wrap">
												<input id="acf-field_link_url<?=$i;?>" class="form-control" name="link_url[]" placeholder="http://" type="text" value="<?=$name[$i]->link_url;?>">
											</div>
										</div>
									</td>
									<td class="acf-field acf-field-text">
				<div class="input-group input-group-sm">
                <textarea class="form-control" rows="1" name="link_image[]" id="acf-field_link_image<?=$i;?>" contenteditable><?=$name[$i]->link_image;?></textarea>
                    <span class="input-group-btn">
                      <button data-chevereto-pup-trigger data-target="#acf-field_link_image<?=$i;?>" class="btn btn-warning">Upload gambar</button>
                    </span>
				</div>
									</td>
									<td class="acf-field acf-field-text">
										<div class="acf-input">
											<div class="acf-input-wrap">
												<input id="acf-field_Text<?=$i;?>"  class="form-control" maxlength="40" name="link_text[]" type="text">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
			<label>Agent Availability</label>
			</div>
			</td>
          	<td>
			<div class="acf-input">
			<p> &#8211; Set agent availability based on specific day &#038; time.</p>
			</div>
			</td>  
        </tr>

<?php 

for($s = 0; $s < $a ; $s++) {
$sun = explode(',',$asa[$s]->sun);
$mon = explode(',',$asa[$s]->mon);
$tue = explode(',',$asa[$s]->tue);
$wed = explode(',',$asa[$s]->wed);
$thu = explode(',',$asa[$s]->thu);
$fri = explode(',',$asa[$s]->fri);
$sat = explode(',',$asa[$s]->sat);
if($sun[0]==1){$checksun='checked';$valsun=1;}else{$checksun='';$valsun='';}
if($mon[0]==1){$checkmon='checked';$valmon=1;}else{$checkmon='';$valmon='';}
if($tue[0]==1){$checktue='checked';$valtue=1;}else{$checktue='';$valtue='';}
if($wed[0]==1){$checkwed='checked';$valwed=1;}else{$checkwed='';$valwed='';}
if($thu[0]==1){$checkthu='checked';$valthu=1;}else{$checkthu='';$valthu='';}
if($fri[0]==1){$checkfri='checked';$valfri=1;}else{$checkfri='';$valfri='';}
if($sat[0]==1){$checksat='checked';$valsat=1;}else{$checksat='';$valsat='';}
// echo $valsun;

?>

        <tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label>Minggu</label>
					</div>
			</td>
          	<td>
					<div class="acf-input">
						<table class="acf-table">
							<thead>
								<tr>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_suno<?=$i;?>_<?=$s;?>">Online</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_sunst<?=$i;?>_<?=$s;?>">Start Time</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_sunet<?=$i;?>_<?=$s;?>">End Time</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-field acf-field-checkbox acf-field-" >
										<div class="acf-input">
											<ul class="acf-checkbox-list acf-bl">
												<li><label>
												<input id="eagentsun_<?=$no;?>_<?=$s;?>" name="eagent0[]" type="hidden" value="<?=$sun[0];?>">
												<input id="todayBoxsun_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checksun;?>>Aktifkan Agen</label></li>
											</ul>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_sunst<?=$i;?>_<?=$s;?>" class="form-control timeagent"  name="day0s[]" type="text" value="<?=$sun[1];?>" min="1" max="23">
											</div>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_sunet<?=$i;?>_<?=$s;?>" class="form-control timeagent"  name="day0e[]" type="text" value="<?=$sun[2];?>">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</td>  
        </tr>
<tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label for="acf-field_">Senin</label>
					</div>
			</td>
          	<td>
					<div class="acf-input">
						<table class="acf-table">
							<thead>
								<tr>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_monno<?=$i;?>">Online</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_monst<?=$i;?>">Start Time</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_monet<?=$i;?>">End Time</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-field acf-field-checkbox acf-field-" >
										<div class="acf-input">
											<ul class="acf-checkbox-list acf-bl">
												<li><label>
												<input id="eagentmon_<?=$no;?>_<?=$s;?>" name="eagent1[]" type="hidden" value="<?=$mon[0];?>">
												<input id="todayBoxmon_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checkmon;?>>Aktifkan Agen</label></li>
											</ul>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_monst<?=$i;?>" class="form-control timeagent"  name="day1s[]" type="text" value="<?=$mon[1];?>" >
											</div>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_monet<?=$i;?>" class="form-control timeagent"  name="day1e[]" type="text" value="<?=$mon[2];?>" min="0" max="23">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label for="acf-field_">Selasa</label>
					</div>
			</td>
          	<td>
					<div class="acf-input">
						<table class="acf-table">
							<thead>
								<tr>
									<th class="acf-th" style="width: 30%;"><label for="acf-todayBoxtue_<?=$i;?>">Online</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_tuest<?=$i;?>">Start Time</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_tueet<?=$i;?>">End Time</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-field acf-field-checkbox acf-field-" >
										<div class="acf-input">
											<ul class="acf-checkbox-list acf-bl">
												<li><label>
												<input id="eagenttue_<?=$no;?>_<?=$s;?>" name="eagent2[]" type="hidden" value="<?=$tue[0];?>">
												<input id="todayBoxtue_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checktue;?>>Aktifkan Agen</label></li>
											</ul>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_tuest<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day2s[]" type="text" value="<?=$tue[1];?>" min="0" max="23">
											</div>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_tueet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day2e[]" type="text" value="<?=$tue[2];?>" min="0" max="23">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label for="acf-field_">Rabu</label>
					</div>
			</td>
          	<td>
					<div class="acf-input">
						<table class="acf-table">
							<thead>
								<tr>
									<th class="acf-th" style="width: 30%;"><label for="acf-todayBoxwed_<?=$i;?>_<?=$s;?>">Online</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_wedst<?=$i;?>_<?=$s;?>">Start Time</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_wedet<?=$i;?>_<?=$s;?>">End Time</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-field acf-field-checkbox acf-field-" >
										<div class="acf-input">
											<ul class="acf-checkbox-list acf-bl">
											<li><label>
												<input id="eagentwed_<?=$no;?>_<?=$s;?>" name="eagent3[]" type="hidden" value="<?=$wed[0];?>">
												<input id="todayBoxwed_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checkwed;?>>Aktifkan Agen</label></li>
											</ul>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_wedst<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day3s[]" type="text" value="<?=$wed[1];?>" min="0" max="23">
											</div>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_wedet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day3e[]" type="text" value="<?=$wed[2];?>">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label for="acf-field_">Kamis</label>
					</div>
			</td>
          	<td>
					<div class="acf-input">
						<table class="acf-table">
							<thead>
								<tr>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_">Online</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_thust<?=$i;?>_<?=$s;?>">Start Time</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_thuet<?=$i;?>_<?=$s;?>">End Time</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-field acf-field-checkbox acf-field-" >
										<div class="acf-input">
											
											<ul class="acf-checkbox-list acf-bl">
											<li><label>
												<input id="eagentthu_<?=$no;?>_<?=$s;?>" name="eagent4[]" type="hidden" value="<?=$thu[0];?>">
												<input id="todayBoxthu_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checkthu;?>>Aktifkan Agen</label></li>
											</ul>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_thust<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day4s[]" type="text" value="<?=$thu[1];?>">
											</div>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_thuet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day4e[]" type="text" value="<?=$thu[2];?>">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label for="acf-field_">Jum'at</label>
					</div>
			</td>
          	<td>
					<div class="acf-input">
						<table class="acf-table">
							<thead>
								<tr>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_">Online</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_frist<?=$i;?>_<?=$s;?>">Start Time</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_friet<?=$i;?>_<?=$s;?>">End Time</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-field acf-field-checkbox acf-field-" >
										<div class="acf-input">
											<ul class="acf-checkbox-list acf-bl">
											<li><label>
												<input id="eagentfri_<?=$no;?>_<?=$s;?>" name="eagent5[]" type="hidden" value="<?=$fri[0];?>">
												<input id="todayBoxfri_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checkfri;?>>Aktifkan Agen</label></li>
											</ul>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_frist<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day5s[]" type="text" value="<?=$fri[1];?>">
											</div>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_friet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day5e[]" type="text" value="<?=$fri[2];?>">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
			<div class="acf-label">
						<label for="acf-field_">Sabtu</label>
					</div>
			</td>
          	<td>
					<div class="acf-input">
						<table class="acf-table">
							<thead>
								<tr>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_">Online</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_satst<?=$i;?>_<?=$s;?>">Start Time</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_satet<?=$i;?>_<?=$s;?>">End Time</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-field acf-field-checkbox acf-field-" >
										<div class="acf-input">
											<ul class="acf-checkbox-list acf-bl">
												<li><label>
												<input id="eagentsat_<?=$no;?>_<?=$s;?>" name="eagent6[]" type="hidden" value="<?=$sat[0];?>">
												<input id="todayBoxsat_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checksat;?>>Aktifkan Agen</label></li>
											</ul>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_satst<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day6s[]" type="text" value="<?=$sat[1];?>">
											</div>
										</div>
									</td>
									<td class="acf-field acf-field-time-picker acf-field-">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_satet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day6e[]" type="text" value="<?=$sat[2];?>">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</td>  
        </tr>
<script>
$("#todayBoxsun_<?=$no;?>_<?=$s;?>").change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagentsun_<?=$no;?>_<?=$s;?>").val(dateStr);
});
$("#todayBoxmon_<?=$no;?>_<?=$s;?>").change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagentmon_<?=$no;?>_<?=$s;?>").val(dateStr);
});
$("#todayBoxtue_<?=$no;?>_<?=$s;?>").change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagenttue_<?=$no;?>_<?=$s;?>").val(dateStr);
});
$("#todayBoxwed_<?=$no;?>_<?=$s;?>").change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagentwed_<?=$no;?>_<?=$s;?>").val(dateStr);
});
$("#todayBoxthu_<?=$no;?>_<?=$s;?>").change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagentthu_<?=$no;?>_<?=$s;?>").val(dateStr);
});
$("#todayBoxfri_<?=$no;?>_<?=$s;?>").change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagentfri_<?=$no;?>_<?=$s;?>").val(dateStr);
});
$("#todayBoxsat_<?=$no;?>_<?=$s;?>").change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagentsat_<?=$no;?>_<?=$s;?>").val(dateStr);
});
</script>
<?php } ?>
        
    </tbody>
<?php $no++; } ?>
<tfoot>
        <tr>
		 <td>&nbsp;</td>
            <td colspan="2" style="text-align: left;">
               <button class="btn btn-success addmore" type="button">+ Add Agent</button>
<input type='hidden' id='baris' value="<?=$j;?>"/>
		<button class="btn btn-danger delete" type="button">- Delete Agent</button>
            </td>
        </tr>
    </tfoot>
</table>
              <!-- /.tab-pane -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
								</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
					</form>	
                    </div><!-- /.row -->                    
                </section><!-- /.content -->
<script src="plugins/datepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
$('.timeagent').datetimepicker({
    format: 'HH:mm'
}).on('dp.show', function () {
    $('a.btn[data-action="incrementMinutes"], a.btn[data-action="decrementMinutes"]').removeAttr('data-action').attr('disabled', true);
    $('span.timepicker-minute[data-action="showMinutes"]').removeAttr('data-action').attr('disabled', true).text('00');
}).on('dp.change', function () {
    $(this).val($(this).val().split(':')[0]+':00')
    $('span.timepicker-minute').text('00')
});
// $(".timeagent").timepicker({
	// format: 'hh:mm',
	// showInputs: false,
	// showSeconds: false,
	// showMeridian: false,
	// defaultTime: false
// });
var link = '<?=$link;?>';
var fields = 'field';
function bukaFormn(field,links,id) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            field.value = links+url;
            var img = new Image();
            img.src = url;
            img.onload = function() {
				$('#imgnew'+id).attr('src', links+url);
				document.getElementById("imgInp"+id).value=links+url;
            }
        }
    };
    window.open('../kcfinder/browse.php?type=images&dir=images/agen/', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}
$(".addmore").on('click',function(){
	var dash = '"';
	var hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
	i=$('#table tr.rowCountCollapse').length;
	a=$('#table tr.rowCountCollapse').length+1;
	// alert(count);
	// baris = ++counter;
		var cols= "<tbody id=rowCount"+i+">";
		cols += '<tr class="rowCountCollapse">';
		cols += '<td style="width:1% !important"><i id="accordion" data-toggle="collapse" data-target="#group-of-rows-'+i+'" aria-expanded="false" aria-controls="group-of-rows-'+i+'" class="clickable more-less'+i+' fa fa-plus" aria-hidden="true"></i><br/>'+a+'</td>';
        cols += '<td style="width:20% !important"><div class="acf-label"><label for="acf-field_name'+i+'_'+a+'">Nama agen</label><p class="description">Click tanda [+] utk expand/collapse</p></div></td>';
        cols += '<td><input id="acf-field_name'+i+'_'+a+'" class="form-control" name="nama_agent[]" placeholder="Nama agen" type="text" value="Nama agen"></td>';
        cols += '<td style="width:1% !important"><input type="checkbox" class="case" id="case'+i+'"/></td>';
        cols += '</tr>';
		cols += '</tbody>';
		cols += '<tbody id="group-of-rows-'+i+'" class="collapse">';
		cols += '<tr>';
		cols += '<td style="width:1% !important">&nbsp;</td>';
		cols += '<td style="width:20% !important"><div class="acf-label"><label for="acf-field_num'+i+'_'+a+'">Whatsapp Number</label><p class="description">Mulai dengan kode negara sebelum nomor telepon</p></div></td>';
		cols += '<td><div class="acf-input"><div class="acf-input-wrap"><input id="acf-field_num'+i+'_'+a+'" class="form-control" name="number[]" placeholder="62" type="text" value="62"></div></div></td>';
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td><div class="acf-label"><label for="acf-field_photo">Photo</label><p class="description">Upload/paste link yg tersedia</p></div></td>';
		cols += "<td><img id='imgnew"+i+"' src='icon/100x100.png'  width='100' alt='Gambar agen' /><div class='input-group input-group-sm'><input type='text' readonly='readonly' onclick='bukaFormn("+dash+""+fields+""+dash+","+dash+""+link+""+dash+","+i+")'  name='photo[]' id='imgInp"+i+"' class='form-control' style='cursor:pointer' /><span class='input-group-btn'><button type='button' class='btn btn-danger'>Upload photo</button></span></div></td>";
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td><div class="acf-label"><label for="acf-field_desc'+i+'_'+a+'">Deskripsi</label><p class="description">Deskripsi singkat agent</p></div></td>';
		cols += '<td><div class="acf-input"><div class="acf-input-wrap"><input id="acf-field_desc'+i+'_'+a+'" class="form-control" name="desc[]" placeholder="Deskripsi singkat agent" type="text" value=""></div></div></td>';
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td><div class="acf-label"><label for="acf-field_role'+i+'_'+a+'">Wewenang</label></div></td>';
		cols += '<td><div class="acf-input"><div class="acf-input-wrap"><input id="acf-field_role'+i+'_'+a+'" class="form-control" name="role[]" placeholder="Customer Support" type="text" value=""></div></div></td>';
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td>';
		cols += '<div class="acf-label"><label for="acf-field_message'+i+'_'+a+'"> Pesan Pengantar </label></div></td>';
		cols += '<td>';
		cols += '<div class="acf-input"><div class="acf-input-wrap"><input id="acf-field_message'+i+'_'+a+'" class="form-control" name="message[]" placeholder="Ada yang bisa dibantu?" type="text" value=""></div></div></td>';
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td>';
		cols += '<div class="acf-label"><label for="acf-field_link'+i+'_'+a+'">Link Rekomendasi</label><p class="description">Tampilkan tautan dengan gambar dan teks setelah pesan intro.</p></div></td>';
		cols += '<td>';
		cols += '<div class="acf-input"><table class="acf-table" style="width:100%">';
		cols += '<thead>';
		cols += '<tr style="width:100%">';
		cols += '<th style="width:33% !important;margin-right:10px" class="acf-th">';
		cols += '<label for="acf-field_link_url'+i+'_'+a+'">Link URL</label>';
		cols += '<p class="description">Biarkan kosong untuk menonaktifkan</p>';
		cols += '</th>';
		cols += '<th style="width:33% !important" class="acf-th">';
		cols += '<label for="acf-field_link_image'+i+'_'+a+'">Link Image</label>';
		cols += '<p class="description">Terlihat lebih baik dengan rasio aspek gambar 2: 1</p>';
		cols += '</th>';
		cols += '<th style="width:33% !important" class="acf-th">';
		cols += '<label for="acf-field_Text'+i+'_'+a+'">Link Text</label>';
		cols += '<p class="description">Deskripsi tautan singkat</p>';
		cols += '</th>';
		cols += '</tr>';
		cols += '</thead>';
		cols += '<tbody>';
		cols += '<tr class="acf-row">';
		cols += '<td  style="width:30% !important;padding:0 10px 0 0" class="acf-field acf-field-text acf-field-">';
		cols += '<div class="acf-input">';
		cols += '<div class="acf-input-wrap">';
		cols += '<input id="field_link_url'+i+'_'+a+'" class="form-control" name="link_url[]" placeholder="http://" type="text" value=""></div></div></td>';
		cols += '<td class="acf-field acf-field-text">';
		cols += '<div class="input-group input-group-sm">';
		cols += '<textarea class="form-control" rows="1" name="link_image[]" id="field_link_image'+i+'_'+a+'" contenteditable></textarea>';
		cols += '<span class="input-group-btn"><button  data-target="#field_link_image'+i+'_'+a+'" class="btn btn-warning" >Upload gambar</button></span></div></td>';
		cols += '<td class="acf-field acf-field-text"><div class="acf-input"><div class="acf-input-wrap">';
		cols += '<input id="acf-field_Text'+i+'_'+a+'"  class="form-control" maxlength="40" name="link_text[]" type="text">';
		cols += '</div></div></td>';
		cols += '</tr>';
		cols += '</tbody>';
		cols += '</table>';
		cols += '</div>';
		cols += '</td>';  
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td>';
		cols += '<div class="acf-label">';
		cols += '<label>Agent Availability</label>';
		cols += '</div>';
		cols += '</td>';
		cols += '<td>';
		cols += '<div class="acf-input">';
		cols += '<p><strong><span class="dashicons dashicons-lock"></span> PREMIUM</strong> &#8211; Set agent availability based on specific day &#038; time.</p>';
		cols += '</div>';
		cols += '</td>';  
		cols += '</tr>';

//
for(n=0; n<=6; n++){
cols += '<tr>';
cols += '<td>&nbsp;</td>';
cols += '<td><div class="acf-label"><label>'+hari[n]+'</label></div></td>';
cols += '<td><div class="acf-input"><table class="acf-table"><thead>';
cols += '<tr>';
cols += '<th class="acf-th" style="width: 30%;"><label for="eagent_'+hari[n]+'_'+[n]+'_'+a+'">Online</label></th>';
cols += '<th class="acf-th" style="width: 30%;"><label for="acf-field_sunst'+[n]+'_'+a+'">Start Time</label></th>';
cols += '<th class="acf-th" style="width: 30%;"><label for="acf-field_sunet'+[n]+'_'+a+'">End Time</label></th>';
cols += '</tr>';
cols += '</thead>';
cols += '<tbody>';
cols += '<tr class="acf-row">';
cols += '<td class="acf-field acf-field-checkbox acf-field-" >';
cols += '<div class="acf-input">';
cols += '<ul class="acf-checkbox-list acf-bl">';
cols += '<li><label><input id="eagent_'+hari[n]+'_'+[n]+'_'+a+'" name="eagent'+[n]+'[]" type="hidden" value=""><input id="today_'+hari[n]+'_'+[n]+'_'+a+'" type="checkbox">Aktifkan Agen</label></li>';
cols += '</ul>';
cols += '</div>';
cols += '</td>';
cols += '<td class="acf-field acf-field-time-picker acf-field-" >';
cols += '<div class="acf-input bootstrap-timepicker">';
cols += '<div class="acf-time-picker acf-input-wrap">';
cols += '<input id="acf-field_sunst'+[n]+'_'+a+'" class="form-control timeagenbaru"  name="day'+[n]+'s[]" type="text" value="" >';
cols += '</div>';
cols += '</div>';
cols += '</td>';
cols += '<td class="acf-field acf-field-time-picker acf-field-">';
cols += '<div class="acf-input bootstrap-timepicker"><div class="acf-time-picker acf-input-wrap">';
cols += '<input id="acf-field_sunet'+[n]+'_'+a+'" class="form-control timeagenbaru" name="day'+[n]+'e[]" type="text">';
cols += '</div></div></td></tr>';
cols += '</tbody></table></div></td>';
cols += '</tr>';
cols += '<tr>';
}
//

cols += '</tbody>';
$('#table').append(cols);
//minggu
$("#today_Minggu_0_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Minggu_0_"+a).val(dateStr);
});
//senin
$("#today_Senin_1_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Senin_1_"+a).val(dateStr);
});
//selasa
$("#today_Selasa_2_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Selasa_2_"+a).val(dateStr);
});
//rabu
$("#today_Rabu_3_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Rabu_3_"+a).val(dateStr);
});
//kamis
$("#today_Kamis_4_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Kamis_4_"+a).val(dateStr);
});
//jumat
$("#today_Jumat_5_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Jumat_5_"+a).val(dateStr);
});
//sabtu
$("#today_Sabtu_6_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = "0";}
 $("#eagent_Sabtu_6_"+a).val(dateStr);
});

$(".timeagenbaru").timepicker({
	showInputs: false,
	showSeconds: false,
	showMeridian: false,
	defaultTime: false
});
}); //--end function--------------------------
$(".delete").on('click', function() {
	
b = $("#table > tbody").children().length; //document.getElementById("baris").value;
	for (var aa = 0; aa < b; aa++) {
// alert(b);
		if ($("#table > tbody").children().length == 2){
			alert('Sisain satu sih jangan di hapus semua');
		return;
		} 
		
		if ($('#case'+aa).length){ 
		if(document.getElementById("case" + aa.toString()).checked == true){
			jQuery('#rowCount'+aa.toString()).remove();
			jQuery('#group-of-rows-'+aa.toString()).remove();
		} }	}
});
  
$(document).ready(function() {
$(".select2").select2({
	templateResult: function (idioma) {
  	var $span = $("<span><img src='icon/icon-" + idioma.id + ".png' height='20' class='img-icon'/> " + idioma.text + "</span>");
  	return $span;
  },
	templateSelection: function (idioma) {
  	var $span = $("<span><img src='icon/icon-" + idioma.id + ".png' height='20' class='img-icon'/> " + idioma.text + "</span>");
  	return $span;
  }
});

		// Javascript to enable link to tab
		var hash = document.location.hash;
		var prefix = "tab_";
		if (hash) {
			$('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
			window.location.hash = e.target.hash.replace("#", "#" + prefix);
		});
				
	});
$(document).ready(function () {
var mode = $("#w_replay").val();
if(mode==''){
$(".replay").hide();
}
var myRadio = $("input[name=aowon]");
var checkedValue = myRadio.filter(":checked").val();
if(checkedValue==1){
  $(".delay").hide('slow');
  $(".gulir").hide('slow');
}else if(checkedValue==2){
  $(".delay").show('slow');
  $(".gulir").hide('slow');
}else{
  $(".delay").hide('slow');
  $(".gulir").show('slow');
}
	$("#aowon1").on('ifChecked', function(event) {
	$(".delay").hide('slow');
	$(".gulir").hide('slow');
	});
	$("#aowon2").on('ifChecked', function(event) {
	$(".delay").show('slow');
	$(".gulir").hide('slow');
	});
	$("#aowon3").on('ifChecked', function(event) {
	$(".delay").hide('slow');
	$(".gulir").show('slow');
	});

	$("#w_mode1").on('ifChecked', function(event) {
	$(".replay").hide('slow');
	});
	$("#w_mode2").on('ifChecked', function(event) {
	$(".replay").show('slow');
	});
if(document.getElementById('w_style3').checked) {
    $(".style_3").show('slow');
} else {
   $(".style_3").hide('slow');
}

$('#w_style1,#w_style2').click(function() {
   $(".style_3").hide('slow');
});
$('#w_style3').click(function() {
   $(".style_3").show('slow');
});
	
    $('input[type="checkbox"].minimal,input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
	  
    });
	
    //Colorpicker
    $('.my-colorpicker1').colorpicker();
});

</script>
<style>
.img-icon{background:#33d450;padding:2px}
.img-icon img{height:20px}
/** This class will hide all the body be default **/
</style>
<?php 
}
 ?>
