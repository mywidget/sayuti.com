<?php 
// if (! defined('BASEPATH')) exit('No direct script access allowed');
switch($act){
  default:
?>

                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data widget</h3>     
									<div class="box-tools pull-right">
									<a href="?<?=$mode;?>=widget&act=edit" class="btn btn-default pull-left"><i class="fa fa-plus"></i> Tambah</a>
									</div>
                                </div><!-- /.box-header table-responsive-->
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:1% !important;" >No</th>
                                                <th>Nama Plugin</th>
												<th style="width:10%;text-align:center">Jumlah Agent</th>
                                                <th style="width:5%;text-align:center">Aksi</th>
                                            </tr>
                                        </thead>
									<tbody>
<?php
$sql = $db->query("SELECT * FROM widget_wa order by id ASC");
$nom=1;
while($row=$sql->fetch_array()){
	$plugin = "[".$row['data']."]";
	$var = json_decode($plugin);
	$var0 = $var[0]->widget->xgen;
	$name = $var0[0]->agent;
	if($row['pub'] == 0){
	$titles	= "unpublish";
	$links 	= "?$mode=$module&act=publish&status=$titles&id=$row[xcode]";
	$gbrs	= '<img src="img/yes.png" alt="" />';
	}
	if($row['pub'] == 1){
	$titles	= "publish";
	$links 	= "?$mode=$module&act=publish&status=$titles&id=$row[xcode]";
	$gbrs	= '<img src="img/no.png" alt="" />';
	}
?>
<tr>
	<td><?php echo $nom;?></td>
	<td><a href="?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['xcode'];?>"><?php echo $row['judul'];?></a></td>
	<td class="text-center"><?php echo count($name);?></td>
	<td><a href='?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['xcode'];?>' data-toggle='tooltip' title='Edit Data'><i class='fa fa-edit'></i> </a></td>
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
	include __DIR__ . '/form_edit.php';
    break;
	
	case "hapus":
	$arr = filtergint('arr');
	$sql = $db->query("SELECT * FROM `widget_wa`  WHERE xcode=".$GETID);
	$data=$sql->fetch_array();
	$plugin = $data['data'];
	$someArray = json_decode($plugin,true);
	unset($someArray['widget']['xgen'][0]['agent'][$arr]);
$dataarr = json_encode($someArray,JSON_UNESCAPED_SLASHES);	
$sql = $db->query("UPDATE widget_wa set data = '$dataarr' WHERE xcode = '$GETID'");	
if($sql){
htmlRedirect('?'.$mode.'=widget&act=edit&id='.$GETID.'#tab_tab_3');
}else{
htmlRedirect('?'.$mode.'=widget');
}
	break;
	case "save":
	$ID = filterpint('id');
if($ID > 0) {
	$site_url	= filterpost('site_url');
	$w_title	= filterpost('w_title');
	$w_desc 	= filterpost('w_desc');
	$w_style 	= filterpost('w_style');
	$w_position = filterpost('w_position');
	$show_widget = filterpost('show_widget');
	$w_icon 	= filterpost('w_icon');
	$w_color 	= filterpost('w_color');
	$w_zindex 	= filterpost('w_zindex');
	$nama_agent	= filterarr('nama_agent');
	$w_tab = filterpost('w_tab');
	if($w_tab=='on'){
		$tab = "1";
	}else{
		$tab = '';
	}
	$show_title = filterpost('show_title');
	if($show_title=='on'){
		$s_title = "1";
	}else{
		$s_title = '';
	}
	$automobile = filterpost('enable_open');
	if($automobile=='on'){
		$a_mobile = "1";
	}else{
		$a_mobile = '';
	}
	$nobrand = filterpost('nobrand');
	if($nobrand=='on'){
		$a_nobrand = "1";
	}else{
		$a_nobrand = '';
	}
	$w_mode = filterpost('w_mode');
	if($w_mode==1){
	$w_replay = filterpost('w_replay');
	}else{
	$w_replay = '';
	}
	$aowon	= filterpost('aowon');
	if($aowon==1){
	$delay = '';
	$gulir = '';
	}elseif($aowon==2){
	$delay = filterpost('w_delay');
	$gulir = '';
	}else{
	$delay = '';
	$gulir = filterpost('w_gulir');
	}

$count = count($nama_agent);
for( $i=0; $i < $count; $i++ ){
	//minggu
	$suns = explode(':',filterarr('day0s')[$i]);
	$sune = explode(':',filterarr('day0e')[$i]);
	//senin
	$mons = explode(':',filterarr('day1s')[$i]);
	$mone = explode(':',filterarr('day1e')[$i]);
	//selasa
	$tues = explode(':',filterarr('day2s')[$i]);
	$tuee = explode(':',filterarr('day2e')[$i]);
	//rabu
	$weds = explode(':',filterarr('day3s')[$i]);
	$wede = explode(':',filterarr('day3e')[$i]);
	//kamis
	$thus = explode(':',filterarr('day4s')[$i]);
	$thue = explode(':',filterarr('day4e')[$i]);
	//jumat
	$fris = explode(':',filterarr('day5s')[$i]);
	$frie = explode(':',filterarr('day5e')[$i]);
	//sabtu
	$sats = explode(':',filterarr('day6s')[$i]);
	$sate = explode(':',filterarr('day6e')[$i]);
	//end
	$agent = array("name"=> $nama_agent[$i],
			"number"=> filterarr('number')[$i],
			"photo"=> filterarr('photo')[$i],
			"desc"=> filterarr('desc')[$i],
			"role"=> filterarr('role')[$i],
			"message"=> filterarr('message')[$i],
			"link_url"=> filterarr('link_url')[$i],
			"link_image"=> filterarr('link_image')[$i],
			"link_text"=> filterarr('link_text')[$i],
				'availability' => array(
				  array("sun"=> filterarr('eagent0')[$i].",".$suns[0].",".$sune[0],
						"mon"=> filterarr('eagent1')[$i].",".$mons[0].",".$mone[0],
						"tue"=> filterarr('eagent2')[$i].",".$tues[0].",".$tuee[0],
						"wed"=> filterarr('eagent3')[$i].",".$weds[0].",".$wede[0],
						"thu"=> filterarr('eagent4')[$i].",".$thus[0].",".$thue[0],
						"fri"=> filterarr('eagent5')[$i].",".$fris[0].",".$frie[0],
						"sat"=> filterarr('eagent6')[$i].",".$sats[0].",".$sate[0])));
$allplayerdata['agent'][] = $agent;
}
$food_groups = array(
"widget" => array(
	"url"=> $site_url,
	"title"=> $w_title,
	"desc"=> $w_desc,
	"reply"=> $w_replay,
	"newtab"=> $tab,
	"style"=> filterpost('w_style'),
	"styletitle"=> $s_title,
	"position"=> $w_position,
	"icon"=> $w_icon,
	"responsive"=> filterpost('w_responsive'),
	"zindex"=> $w_zindex,
	"mode"=> $w_mode,
	"show"=> $show_widget,
	"autolabel"=> $aowon,
	"auto"=> $delay,
	"autoscroll"=> $gulir,
	"automobile"=> $a_mobile,
	"color"=> $w_color,
	"nobrand"=> $a_nobrand,
		"xgen" => array(
$allplayerdata
   ),
   
  )
);
// echo json_encode($food_groups,JSON_PRETTY_PRINT);
$dataarr = json_encode($food_groups, JSON_UNESCAPED_SLASHES);	
$sql = $db->query("UPDATE widget_wa set data = '$dataarr' WHERE xcode = '$ID'");	
if($sql){
htmlRedirect('?'.$mode.'=widget&act=edit&id='.$ID);
}else{
htmlRedirect('?'.$mode.'=widget');
}
}else{
	$site_url	= filterpost('site_url');
	$w_title	= filterpost('w_title');
	$w_desc 	= filterpost('w_desc');
	$w_style 	= filterpost('w_style');
	$w_position = filterpost('w_position');
	$show_widget = filterpost('show_widget');
	$w_icon 	= filterpost('w_icon');
	$w_color 	= filterpost('w_color');
	$w_zindex 	= filterpost('w_zindex');
	$nama_agent	= filterarr('nama_agent');
	$w_tab = filterpost('w_tab');
	if($w_tab=='on'){
		$tab = "1";
	}else{
		$tab = '';
	}
	$show_title = filterpost('show_title');
	if($show_title=='on'){
		$s_title = "1";
	}else{
		$s_title = '';
	}
	$automobile = filterpost('enable_open');
	if($automobile=='on'){
		$a_mobile = "1";
	}else{
		$a_mobile = '';
	}
	$w_mode = filterpost('w_mode');
	if($w_mode==1){
	$w_replay = filterpost('w_replay');
	}else{
	$w_replay = '';
	}
	$aowon	= filterpost('aowon');
	if($aowon==1){
	$delay = '';
	$gulir = '';
	}elseif($aowon==2){
	$delay = filterpost('w_delay');
	$gulir = '';
	}else{
	$delay = '';
	$gulir = filterpost('w_gulir');
	}

$count = count($nama_agent);
for( $i=0; $i < $count; $i++ ){
	$agent = array("name"=> $nama_agent[$i],
			"number"=> filterarr('number')[$i],
			"photo"=> filterarr('photo')[$i],
			"desc"=> filterarr('desc')[$i],
			"role"=> filterarr('role')[$i],
			"message"=> filterarr('message')[$i],
			"link_url"=> filterarr('link_url')[$i],
			"link_image"=> filterarr('link_image')[$i],
			"link_text"=> filterarr('link_text')[$i],
				'availability' => array(
				  array("sun"=> filterarr('eagent0')[$i].",".filterarr('day0s')[$i].",".filterarr('day0e')[$i],
						"mon"=> filterarr('eagent1')[$i].",".filterarr('day1s')[$i].",".filterarr('day1e')[$i],
						"tue"=> filterarr('eagent2')[$i].",".filterarr('day2s')[$i].",".filterarr('day2e')[$i],
						"wed"=> filterarr('eagent3')[$i].",".filterarr('day3s')[$i].",".filterarr('day3e')[$i],
						"thu"=> filterarr('eagent4')[$i].",".filterarr('day4s')[$i].",".filterarr('day4e')[$i],
						"fri"=> filterarr('eagent5')[$i].",".filterarr('day5s')[$i].",".filterarr('day5e')[$i],
						"sat"=> filterarr('eagent6')[$i].",".filterarr('day6s')[$i].",".filterarr('day6e')[$i])));
$allplayerdata['agent'][] = $agent;
}
$food_groups = array(
"widget" => array(
	"url"=> $site_url,
	"title"=> $w_title,
	"desc"=> $w_desc,
	"reply"=> $w_replay,
	"newtab"=> $tab,
	"style"=> filterpost('w_style'),
	"styletitle"=> $s_title,
	"position"=> $w_position,
	"icon"=> $w_icon,
	"responsive"=> filterpost('w_responsive'),
	"zindex"=> $w_zindex,
	"mode"=> $w_mode,
	"show"=> $show_widget,
	"autolabel"=> $aowon,
	"auto"=> $delay,
	"autoscroll"=> $gulir,
	"automobile"=> $a_mobile,
	"color"=> $w_color,
	"nobrand"=> "",
		"xgen" => array(
$allplayerdata
   ),
   
  )
);
$xcode =idxcode(6);
// echo json_encode($food_groups,JSON_PRETTY_PRINT);
$dataarr = json_encode($food_groups, JSON_UNESCAPED_SLASHES);	
$sql = "INSERT INTO widget_wa set judul='$site_url',xcode='$xcode' ,data = '$dataarr'";	

if ($db->query($sql) === TRUE) {
htmlRedirect('?'.$mode.'=widget&act=edit&id='.$xcode);
}else{
htmlRedirect('?'.$mode.'=widget');
}
}
// print_r($food_groups); 
    break;

	}
 ?>