<?php 
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "class/referer.php";
$isi= isset($_GET['isi']) ? $_GET['isi'] : '';
$s_name= 'admin@sayuti.com';
$api_key = "kalkulatorcetak.com";
$url = $host."fungsihitung.php?API={$api_key}&name={$s_name}&".base64_decode($isi);
$fields = array(
	'name' => $s_name
);
$data = http_build_query($fields);
$context = stream_context_create(array(
	'http' =>  array(
		'method'  => 'GET',
		'header'  => 'Content-type: application/x-www-form-urlencoded',
		'content' => $data,
	)
));
     $ch = curl_init( $url );
     $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json')
     );
curl_setopt_array( $ch, $options ); // Setting curl options
$result =  curl_exec($ch); // Getting jSON result string
$vr = json_decode($result,true);
if (empty($vr) or $vr[0]['akses']=='N'){
	$vr = array("total_jual" => 'Error',"akses" => 'N');
	array_push($vr,$vr);	
	echo json_encode($vr);
}elseif($vr[0]['akses']=='Y'){
	echo json_encode($vr);
}
?>