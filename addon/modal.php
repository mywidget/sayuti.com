<?php
// error_reporting(0);
// session_start();
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "../class/conn_db.php";
include "../class/web_function.php";
include "../class/referer.php";
include "../class/filter.inc.php";
include "../class/lib/function.php";
$mod = filterpost('modul');
$link = filterpost('link');
$Cekref = refer($referer,$link);
if($Cekref==0){
	goto modul;
}elseif($Cekref==1){
	goto modul;
}else{
echo json_encode(array(401 => "Akses ditolak"));
}
modul:
if($mod){
	$x = "?".$mod;
	$var=decode($x);
	$modul = (isset($var['rowid']) ? $var['rowid'] : '');
	$ssid = session_id();
	$sqlb = $db->query("select * from modul where tag_mod='$modul'");
	$row = $sqlb->fetch_array();
	echo "<script>
	$('.save').click(function(){
			var biaya=$('#biaya').val();
			if(biaya == '' || biaya==0) {
			$('#saved').addClass('merah');
			}else{
			$.ajax({
			url : '/addon/save_biaya.php',
			dataType: 'json',
			method: 'POST',
			data: {
			   biaya: biaya,
			   type: 'simpan_biaya'
			},
			beforeSend: function()
			{	
				$('#saved').removeClass('hijau');
			},
			success: function(result){
				if(result.error){
				$('#saved').addClass('merah');
				}else{
				$('#saved').addClass('hijau');
				}
			}
			});
		}
	});	
	modulhit = '$modul';
	$('#token').val('$ssid');
	$('#modul').val(modulhit);
	</script>";	

$pathFile = "../modal/".$modul.".php";
if (file_exists($pathFile))
{
	include $pathFile;
}else{
	echo $modul;
	// include "modal/global.php";
}
 }else{
	 echo json_encode(array(401 => "Akses ditolak"));
 }
?>
