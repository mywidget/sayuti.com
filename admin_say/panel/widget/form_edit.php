<?php 
// error_reporting(0);
// if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
if($GETID > 0) {
$sql = $db->query("SELECT * FROM `widget_wa`  WHERE xcode=".$GETID);
$data=$sql->fetch_array();
	$judul 	= $data['judul'];
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
		$show_widget1 = '<input type="radio" name="show_widget" class="minimal" id="show_widget1" value="1" checked>';
		$show_widget2 = '<input type="radio" name="show_widget" class="minimal" id="show_widget2" value="2">';
		$show_widget3 = '<input type="radio" name="show_widget" class="minimal" id="show_widget3" value="3">';
		$aowon1 = '<input type="radio" name="aowon" id="aowon1" class="minimal" value="1" checked>';
		$aowon2 = '<input type="radio" name="aowon" id="aowon2" class="minimal" value="2">';
		$aowon3 = '<input type="radio" name="aowon" id="aowon3" class="minimal" value="3">';
		$w_responsive1 = '<input type="radio" id="w_responsive1" name="w_responsive" class="minimal" value="1" checked="checked">';
		$w_responsive2 = '<input type="radio" id="w_responsive2" name="w_responsive" class="minimal" value="2">';
		$checked = 'checked';
		$a_checked = '';
		$s_checked = '';
		$n_checked = '';
		$pluginn = '[{"agent":{"name":"Agent","number":"","photo":"","desc":"","role":"","message":"","link_url":"","link_image":"","link_text":"","availability":[{"sun":",,","mon":",,","tue":",,","wed":",,","thu":"0,,","fri":",,","sat":",,"}]}}]';
		$vars = json_decode($pluginn);
		$name = $vars[0]->agent->name;
}

$site_url = rtrim($link, '/');
$site_urlimg = 'https://sayuti.com';
echo ImgAgen('bukaForm','images','images/agen/');
echo LinkImg('LinkImg','images','images/agen/');
?>
<link href="panel/widget/plugin.css" rel="stylesheet">

<div id="load"></div>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
					<form id="simpanForm" >
<?php if($GETID > 0){ ?>
	<input type="hidden" id="edits" name="id" value="<?php echo !empty($GETID)?$GETID:''; ?>">
<?php }else{ ?>
	<input type="hidden" id="tambah" name="id">
<?php } ?>
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
								<a href="?<?=$mode;?>=<?=$module;?>" class="btn btn-danger">Kembali</a>
                                </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                <div class="box-body">
<?php if($GETID > 0) {	?>
<div class="input-group input-group-sm">
                <textarea id="salinKode" name="kode" class="form-control" rows="1" style="background:#fff;width:100%;" readonly="readonly">&lt;script async data-id="<?=$GETID;?>" src="<?=remove_http($link).$pathnya.$nama_js;?>.js"&gt;&lt;/script&gt;</textarea>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger" onclick="copy()">Salin Kode</button>
                    </span>
</div>
<?php }else{ ?>
<div class="input-group input-group-sm" id="ngumpet">
<textarea id="salinKode" name="kode" class="form-control urlnya" rows="1" style="background:#fff;width:100%;" readonly="readonly"></textarea>
<span class="input-group-btn">
<button type="button" class="btn btn-danger" onclick="copy()">Salin Kode</button>
</span>
</div>
<?php }	?>
<br/>
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Pengaturan</a></li>
              <li><a href="#tab_2" data-toggle="tab">Tampilan</a></li>
              <li><a href="#tab_3" data-toggle="tab">Pengguna</a></li>
              <li class="pull-right"><button type="button" class="btn btn-success pull-right" onclick="callFunction(this)" id="kolapse"><i class="fa fa-plus"></i> Expand</button></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <div class="box-body">
                <div class="form-group">
                  <label for="site_url" class="col-sm-3 control-label">Alamat URL*</label>
                  <div class="col-sm-9">
                    <input type="url" class="form-control" name="site_url" id="site_url" placeholder="http://" value="<?=!empty($judul)?$judul:''; ?>">
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
                  <label for="show_widget" class="col-sm-3 control-label">Tampilkan Widget Aktif</label>
                  <div class="col-sm-9">
		<div class="acf-input">
		<ul class="acf-radio-list acf-bl" style="margin-left:-40px">
		<li><label class="selected">
		<?=$show_widget1;?> Semua</label>
		</li>
		<li><label class=""><?=$show_widget2;?> Hanya Desktop</label>
		</li>
		<li><label><?=$show_widget3;?> Hanya Ponsel</label>
		</li>
		</ul>
		<p class="description">Pilih untuk menampilkan widget di semua perangkat atau khusus untuk desktop / seluler saja</p>
		</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="show_widget" class="col-sm-3 control-label">Widget Buka Otomatis Aktif</label>
                  <div class="col-sm-9">
		<div class="acf-input">
		<ul class="acf-radio-list acf-bl" style="margin-left:-40px">
		<li><label class="selected">
		<?=$aowon1;?> Nonaktif</label>
		</li>
		<li><label class=""><?=$aowon2;?> Waktu penundaan</label>
		</li>
		<li><label><?=$aowon3;?> Gulir Halaman</label>
		</li>
		</ul>
		</div>
                  </div>
                </div>
                <div class="form-group delay">
                  <label for="w_delay" class="col-sm-3 control-label">Waktu penundaan</label>
                  <div class="col-sm-9">
<div class="input-group input-group-sm">
                <input type="number" class="form-control" name="w_delay" min="1" max="100" id="w_delay" value="<?=!empty($var[0]->widget->auto)?$var[0]->widget->auto:''; ?>">
                    <span class="input-group-btn">
                      <button type="button" class="btn"><i class="fa fa-clock-o"></i></button>
                    </span>
</div>
					<span class="help-block">Waktu (dalam detik) sebelum widget dibuka secara otomatis.</span>
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
                  <label for="nobrand" class="col-sm-3 control-label">Sembunyikan merek Footer</label>
                  <div class="col-sm-9">
					<label>
                  <input type="checkbox" name="nobrand" class="minimal"  <?=$n_checked;?>>
                  Aktifkan
                </label>
                  </div>
                </div>
              </div>
              </div>
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
                    <input type="text" name="w_zindex" id="w_zindex" class="form-control" value="<?=!empty($var[0]->widget->zindex)?$var[0]->widget->zindex:'99'; ?>">
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
if (is_array( $name ) ) {
			$j = count($name); 
	} else { 	
		$j = 1;
	}
$no=1;
for($i = 0; $i < $j ; $i++) {
$asa = !empty($name[$i]->availability)?$name[$i]->availability:',';
if ( is_array( $asa ) ) {
			$a = count($asa); 
	} else { 	
		$a = 1;
	}
if($j != 1){
$hapus = '<input type="checkbox" class="case" id="case'.$i.'"/>';
}else{
$hapus = '<i class="fa fa-eye"></i>';
}
?>

    <tbody id="rowCount<?=$i;?>" class="utama">
        <tr class="rowCountCollapse">
            <td style="width:2% !important" align="center">
			<span data-toggle="collapse" id="singlek" class="checkall chevron_toggleable_<?=$i;?> glyphicon glyphicon-chevron-down" data-target="#group-of-rows-<?=$i;?>" onclick="callFunc(<?=$i;?>)"></span>
			<span class="label label-primary pull-right"><?=$i+1;?></span>
			<input id="checklist<?=$i;?>" value="" style="display:none" type="checkbox" class="chk<?=$i;?>" />
			</td>
            <td style="width:20% !important">
			<div class="acf-label">
						<label for="acf-field_agent_<?=$i;?>">Nama Pengguna</label>
						<p class="description">Click tanda [+] utk expand/collapse</p>
					</div>
			</td>
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
							<input id="acf-field_number<?=$i;?>" class="form-control" name="number[]" placeholder="62" type="text" value="<?=!empty($name[$i]->number)?$name[$i]->number:'62';?>">
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
				<input type="text" readonly="readonly" onclick="bukaForm(this,'<?=$site_url;?>',<?=$i;?>)"
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
						<p class="description">Deskripsi singkat pengguna</p>
					</div></td>
          	<td><div class="acf-input">
						<div class="acf-input-wrap">
							<input id="acf-field_desc<?=$i;?>" class="form-control" name="desc[]" placeholder="Deskripsi singkat" type="text" value="<?=!empty($name[$i]->desc)?$name[$i]->desc:'';?>">
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
							<input id="acf-field_role<?=$i;?>" class="form-control" name="role[]" placeholder="Customer Support" type="text" value="<?=!empty($name[$i]->role)?$name[$i]->role:'';?>">
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
							<input id="acf-field_message<?=$i;?>" class="form-control" name="message[]" placeholder="Ada yang bisa dibantu?" type="text" value="<?=!empty($name[$i]->message)?$name[$i]->message:'';?>">
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
												<input id="acf-field_link_url<?=$i;?>" class="form-control" name="link_url[]" placeholder="" type="text" value="<?=!empty($name[$i]->link_url)?$name[$i]->link_url:'';?>">
											</div>
										</div>
									</td>
          	<td>
				<div class="input-group input-group-sm">
				<input type="text" readonly="readonly" onclick="LinkImg(this,'<?=$site_urlimg;?>')"
    value="<?=!empty($name[$i]->link_image)?$name[$i]->link_image:'';?>" name="link_image[]"  class="form-control" style="cursor:pointer" />
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger">Link Image</button>
                    </span>
              </div>
			</td>
									<td class="acf-field acf-field-text">
										<div class="acf-input">
											<div class="acf-input-wrap">
												<input id="acf-field_Text<?=$i;?>"  class="form-control" maxlength="40" name="link_text[]" type="text" value="<?=!empty($name[$i]->link_text)?$name[$i]->link_text:'';?>" >
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
			<label>Ketersediaan pengguna</label>
			</div>
			</td>
          	<td>
			<div class="acf-input">
			<p> &#8211; Tetapkan ketersediaan pengguna berdasarkan hari  &#038; waktu tertentu.</p>
			</div>
			</td>  
        </tr>

<?php 
for($s = 0; $s < $a ; $s++) {
!empty($asa[$s]->sun)?$sun = explode(',',$asa[$s]->sun):$sun =",";
!empty($asa[$s]->mon)?$mon = explode(',',$asa[$s]->mon):$mon =",";
!empty($asa[$s]->tue)?$tue = explode(',',$asa[$s]->tue):$tue =",";
!empty($asa[$s]->wed)?$wed = explode(',',$asa[$s]->wed):$wed =",";
!empty($asa[$s]->thu)?$thu = explode(',',$asa[$s]->thu):$thu =",";
!empty($asa[$s]->fri)?$fri = explode(',',$asa[$s]->fri):$fri =",";
!empty($asa[$s]->sat)?$sat = explode(',',$asa[$s]->sat):$sat =",";
if($sun[0]==1){$checksun='checked';$valsun=1;}else{$checksun='';$valsun='';}
if($mon[0]==1){$checkmon='checked';$valmon=1;}else{$checkmon='';$valmon='';}
if($tue[0]==1){$checktue='checked';$valtue=1;}else{$checktue='';$valtue='';}
if($wed[0]==1){$checkwed='checked';$valwed=1;}else{$checkwed='';$valwed='';}
if($thu[0]==1){$checkthu='checked';$valthu=1;}else{$checkthu='';$valthu='';}
if($fri[0]==1){$checkfri='checked';$valfri=1;}else{$checkfri='';$valfri='';}
if($sat[0]==1){$checksat='checked';$valsat=1;}else{$checksat='';$valsat='';}
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
									<th class="acf-th" style="width: 30%;"><label for="acf-field_sunst<?=$i;?>_<?=$s;?>">Waktu mulai</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_sunet<?=$i;?>_<?=$s;?>">Waktu selesai</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-field acf-field-checkbox" align="left">
									<input id="eagentsun_<?=$no;?>_<?=$s;?>" name="eagent0[]" type="hidden" value="<?=$sun[0];?>">
									<label class="checkboxs">
									<input id="todayBoxsun_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checksun;?>> <span>Aktifkan Pengguna</span>
									</label>
									</td>
									<td class="acf-fieldtime-picker" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_sunst<?=$i;?>_<?=$s;?>" class="form-control timeagent"  name="day0s[]" type="text" value="<?=!empty($sun[1])?$sun[1]:'';?>" min="1" max="23">
											</div>
										</div>
									</td>
									<td class="acf-fieldtime-picker">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_sunet<?=$i;?>_<?=$s;?>" class="form-control timeagent"  name="day0e[]" type="text" value="<?=!empty($sun[2])?$sun[2]:'';?>">
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
									<th class="acf-th" style="width: 30%;"><label for="acf-field_monst<?=$i;?>">Waktu mulai</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_monet<?=$i;?>">Waktu selesai</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-fieldcheckbox" >
											<label class="checkboxs">
												<input id="eagentmon_<?=$no;?>_<?=$s;?>" name="eagent1[]" type="hidden" value="<?=$mon[0];?>">
												<input id="todayBoxmon_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checkmon;?>><span>Aktifkan Pengguna</span>
												</label>
									</td>
									<td class="acf-fieldtime-picker" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_monst<?=$i;?>" class="form-control timeagent"  name="day1s[]" type="text" value="<?=!empty($mon[1])?$mon[1]:'';?>" >
											</div>
										</div>
									</td>
									<td class="acf-fieldtime-picker">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_monet<?=$i;?>" class="form-control timeagent"  name="day1e[]" type="text" value="<?=!empty($mon[2])?$mon[2]:'';?>" min="0" max="23">
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
									<th class="acf-th" style="width: 30%;"><label for="acf-field_tuest<?=$i;?>">Waktu mulai</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_tueet<?=$i;?>">Waktu selesai</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-fieldcheckbox" >
										<label class="checkboxs">
										<input id="eagenttue_<?=$no;?>_<?=$s;?>" name="eagent2[]" type="hidden" value="<?=$tue[0];?>">
										<input id="todayBoxtue_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checktue;?>> <span>Aktifkan Pengguna</span>
										</label>
									</td>
									<td class="acf-fieldtime-picker" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_tuest<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day2s[]" type="text" value="<?=!empty($tue[1])?$tue[1]:'';?>" min="0" max="23">
											</div>
										</div>
									</td>
									<td class="acf-fieldtime-picker">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_tueet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day2e[]" type="text" value="<?=!empty($tue[2])?$tue[2]:'';?>" min="0" max="23">
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
									<th class="acf-th" style="width: 30%;"><label for="acf-field_wedst<?=$i;?>_<?=$s;?>">Waktu mulai</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_wedet<?=$i;?>_<?=$s;?>">Waktu selesai</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-fieldcheckbox" >
										<label class="checkboxs">
											<input id="eagentwed_<?=$no;?>_<?=$s;?>" name="eagent3[]" type="hidden" value="<?=$wed[0];?>">
											<input id="todayBoxwed_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checkwed;?>>     
											 <span>Aktifkan Pengguna</span></label>
									</td>
									<td class="acf-fieldtime-picker" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_wedst<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day3s[]" type="text" value="<?=!empty($wed[1])?$wed[1]:'';?>" min="0" max="23">
											</div>
										</div>
									</td>
									<td class="acf-fieldtime-picker">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_wedet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day3e[]" type="text" value="<?=!empty($wed[2])?$wed[2]:'';?>">
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
									<th class="acf-th" style="width: 30%;"><label for="acf-field_thust<?=$i;?>_<?=$s;?>">Waktu mulai</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_thuet<?=$i;?>_<?=$s;?>">Waktu selesai</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-fieldcheckbox" >
										<label class="checkboxs">
												<input id="eagentthu_<?=$no;?>_<?=$s;?>" name="eagent4[]" type="hidden" value="<?=$thu[0];?>">
												<input id="todayBoxthu_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checkthu;?>><span>Aktifkan Pengguna</span></label>
									</td>
									<td class="acf-fieldtime-picker" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_thust<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day4s[]" type="text" value="<?=!empty($thu[1])?$thu[1]:'';?>">
											</div>
										</div>
									</td>
									<td class="acf-fieldtime-picker">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_thuet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day4e[]" type="text" value="<?=!empty($thu[2])?$thu[2]:'';?>">
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
									<th class="acf-th" style="width: 30%;"><label for="acf-field_frist<?=$i;?>_<?=$s;?>">Waktu mulai</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_friet<?=$i;?>_<?=$s;?>">Waktu selesai</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-fieldcheckbox" >
										<label class="checkboxs">
												<input id="eagentfri_<?=$no;?>_<?=$s;?>" name="eagent5[]" type="hidden" value="<?=$fri[0];?>">
												<input id="todayBoxfri_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checkfri;?>><span>Aktifkan Pengguna</span>
												</label>
									</td>
									<td class="acf-fieldtime-picker" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_frist<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day5s[]" type="text" value="<?=!empty($fri[1])?$fri[1]:'';?>">
											</div>
										</div>
									</td>
									<td class="acf-fieldtime-picker">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_friet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day5e[]" type="text" value="<?=!empty($fri[2])?$fri[2]:'';?>">
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
									<th class="acf-th" style="width: 30%;"><label for="acf-field_satst<?=$i;?>_<?=$s;?>">Waktu mulai</label></th>
									<th class="acf-th" style="width: 30%;"><label for="acf-field_satet<?=$i;?>_<?=$s;?>">Waktu selesai</label></th>
								</tr>
							</thead>
							<tbody>
								<tr class="acf-row">
									<td class="acf-fieldcheckbox" >
										<label class="checkboxs">
												<input id="eagentsat_<?=$no;?>_<?=$s;?>" name="eagent6[]" type="hidden" value="<?=$sat[0];?>">
												<input id="todayBoxsat_<?=$no;?>_<?=$s;?>" type="checkbox" <?=$checksat;?>><span>Aktifkan Pengguna</span>
												</label>
									</td>
									<td class="acf-fieldtime-picker" >
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
											<input id="acf-field_satst<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day6s[]" type="text" value="<?=!empty($sat[1])?$sat[1]:'';?>">
											</div>
										</div>
									</td>
									<td class="acf-fieldtime-picker">
										<div class="acf-input bootstrap-timepicker">
											<div class="acf-time-picker acf-input-wrap">
												<input id="acf-field_satet<?=$i;?>_<?=$s;?>" class="form-control timeagent" name="day6e[]" type="text" value="<?=!empty($sat[2])?$sat[2]:'';?>">
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
               <button class="btn btn-success addmore" type="button">+ Tambah Pengguna</button>
		<input type='hidden' id='baris' value="<?=$j;?>"/>
		<button class="btn btn-danger delete" type="button" disabled>- Hapus Pengguna</button>
            </td>
		 <td align="right">
									<?php if($GETID > 0) { ?>
                                <button type="submit" id="myBtns" name="update" class="btn btn-primary">Update</button>
									<?php }else{ ?>
                                <button type="submit" id="myBtns" name="simpan" class="btn btn-primary">Simpan</button>
									<?php } ?>
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

<script>
var link = '<?=$site_url;?>';
</script>
<script src="panel/widget/plugin.js"></script>
<?php 
}
 ?>