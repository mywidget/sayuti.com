<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
session_start();
if (isset($_SESSION['ids'])){
require_once '../../../class/conn_db.php';
require_once "../../../class/web_function.php";
require_once "../../../class/filter.inc.php";
$iduser = $_SESSION['iduser'];
$ID = filterpint('id');
if($ID > 0) {
	$siteurl	= filterpost('site_url');
	$site_url 	= removeurl($siteurl);
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
	$nobrand = filterpost('nobrand');
	if($nobrand=='on'){
		$a_nobrand = "1";
	}else{
		$a_nobrand = '';
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
$array=array();
$dataarr = json_encode($food_groups, JSON_UNESCAPED_SLASHES);	
$sql = $db->query("UPDATE widget_wa set judul='$siteurl', data = '$dataarr' WHERE xcode = '$ID'");	
if($sql){
$array=array("ok"=>"update","msg"=>"Data terupdate");
}else{
$array=array("error"=>"error");
}
echo json_encode($array,JSON_PRETTY_PRINT);
}else{
	$siteurl	= filterpost('site_url');
	$judul		= geturl($siteurl);
	$site_url	= filterurl($siteurl);
	$sqlcek = $db->query("select judul from widget_wa where judul='$judul' ");
	if($sqlcek->num_rows >0){
	$array=array("error"=>"error",'msg'=>"URL <b>".$judul."</b> sudah ada");
	}else{
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
	$nobrand = filterpost('nobrand');
	if($nobrand=='on'){
		$a_nobrand = "1";
	}else{
		$a_nobrand = '';
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
	"nobrand"=> $a_nobrand,
		"xgen" => array(
$allplayerdata
   ),
   
  )
);
$xcode =idxcode(6);
$array=array();
$dataarr = json_encode($food_groups, JSON_UNESCAPED_SLASHES);	
$sql = "INSERT INTO widget_wa set id_user='$iduser', judul='$judul',xcode='$xcode' ,data = '$dataarr'";	
if ($db->query($sql) === TRUE) {
// $last_id = $db->insert_id;
$sqli_url = $db->query("SELECT * FROM info WHERE id_info='1'");
$rowu = $sqli_url->fetch_array();
$link = remove_http($rowu['alamat_website']); 
$title_up = $rowu['nama_website'];
$path	= $rowu['path'];
$nama_js = $rowu['nama_js'];
if(empty($path)){
$pathnya = '';	
}else{
$pathnya = $path.'/';	
}
$codenya = '&lt;script async data-id="'.$xcode.'" src="'.$link.$pathnya.$nama_js.'.js"&gt;&lt;/script&gt;';
$array=array("ok"=>"save","msg"=>"Data tersimpan","id"=>$xcode,"url"=>$codenya);
}else{
$array=array("error"=>"error");
}
}
echo json_encode($array,JSON_PRETTY_PRINT);
}
}else{
echo "error";
}
?>