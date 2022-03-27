<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');
//status informasi pada saat eksekusi database
function alertfly($type = null){
	if($type=='save'){
	save_alert('save',save);
	}
	else if($type=='update')	{
	save_alert('update',update);
	}
	else if($type=='delete')	{
	save_alert('delete',delete);
	}else{
	}
}
function alert($type,$text = null){
	if($type=='info'){
		echo "<font color='white'><div class='infofly go-front' id='status'>$text</div></font>";
	}
	else if($type=='error')	{
		echo "<font color='white'><div class='errorfly go-front' id='status'>$text</div></font>";
	}
	else if($type=='download')	{
		echo "<font color='black'><center>$text</center></font>";
	}
	else if($type=='loading')		
		echo "<div id='loading'><center>$text</center></div>";
	
}
function login_alert($type,$text = null){
	if($type=='info'){
		echo "<font color='black'><div class='infofly info_login' id='status'>$text</div></font>";
	}
	else if($type=='error')	{
		echo "<font color='black'><div class='errorfly error_login' id='status'>$text</div></font>";
	}
	else if($type=='loading')		
		echo "<div id='loading'><center>$text</center></div>";
}
function save_alert($type,$text = null){
	if($type=='save'){
	echo"<div class='box-body'><div class='alert alert-info alert-dismissable'>$text</div></div>";
	}
	else if($type=='error')	{
	echo"<div class='box-body'><div class='alert alert-danger alert-dismissable'>$text</div></div>";
	}
	else if($type=='delete')	{
	echo"<div class='box-body'><div class='alert alert-danger alert-dismissable'>$text</div></div>";
	}
	else if($type=='update')
	echo"<div class='box-body'><div  class='alert alert-success alert-dismissable'>$text</div></div>";
}
//fungsi redirect menggunakan php
function redirect($url) {
	header("location:".$url);
}

//fungsi redirect menggunakan html
function htmlRedirect($link,$time = null) {
	if($time) $time = $time; else $time = 0;
	echo "<meta http-equiv='REFRESH' content='$time; url=$link'>";
}
//fungsi redirect menggunakan html
function LongRedirect($link,$time = null) {
	if($time) $time = $time; else $time = 3;
	echo "<meta http-equiv='REFRESH' content='$time; url=$link'>";
}
//fungsi redirect menggunakan html
function Redirect_Login($link,$time = null) {
	if($time) $time = $time; else $time = 2;
	echo "<meta http-equiv='REFRESH' content='$time; url=$link'>";
}
//fungsi redirect menggunakan html
function dlRedirect($link,$time = null) {
	if($time) $time = $time; else $time = 5;
	echo "<meta http-equiv='REFRESH' content='$time; url=$link'>";
}
function selengkapnya($konten){
    $i = strpos($konten, '<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>');
    if ($i !== false) {
        $i += strlen('<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>');
        return substr($konten, 0, $i);
    }
    else return $konten;
}
function error($str)
{
	die($str);
}
function is_bot()
{
	/* This function will check whether the visitor is a search engine robot */
	
	$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
	"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
	"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
	"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
	"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
	"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
	"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
	"Butterfly","Twitturls","Me.dium","Twiceler");

	foreach($botlist as $bot)
	{
		if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)!==false)
		return true;	// Is a bot
	}

	return false;	// Not a bot
}