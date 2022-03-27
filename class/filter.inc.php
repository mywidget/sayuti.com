<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');
function encodeURIComponent($str) {
    $revert = array(' '=>'%20','%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}
function removeurl($str){
$input = trim($str, '/');
// If scheme not included, prepend it
if (!preg_match('#^http(s)?://#', $input)) {
    $input = 'http://' . $input;
}
$urlParts = parse_url($input);
// remove www
$domain = preg_replace('/^www\./', '', $urlParts['host']);
return $domain;
}
function remove_http($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '//', $url);
      }
   }
   return $url;
}
function get_domaininfo($url) {
    // regex can be replaced with parse_url
    preg_match("/^(https|http|ftp):\/\/(.*?)\//", "$url/" , $matches);
    $parts = explode(".", $matches[2]);
    $tld = array_pop($parts);
    $host = array_pop($parts);
    if ( strlen($tld) == 2 && strlen($host) <= 3 ) {
        $tld = "$host.$tld";
        $host = array_pop($parts);
    }

    return array(
        'protocol' => $matches[1],
        'subdomain' => implode(".", $parts),
        'domain' => "$host.$tld",
        'host'=>$host,'tld'=>$tld
    );
}

function geturl($url){
	$url = strpos($url, 'http') !== 0 ? "http://$url" : $url;
	return $url;
}
function siteURL()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/';
    return $protocol.$domainName;
}
//int get
function protokol(){
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
return $protocol;
}
function geturls($str){

    $input = preg_replace( "#^[^:/.]*[:/]+#i", "", $str );
	
    if (!preg_match('#^http(s)?://#', $input)) {
	$inputs = 'http://' . $input;
    }
	return $inputs;
}
function filterurl($str){
$input = preg_replace( "#^[^:/.]*[:/]+#i", "", $str );
	return $input;
}
function gets($str){
	$str 	= filter_input(INPUT_GET, $str, FILTER_SANITIZE_MAGIC_QUOTES);
	return $str;
}	
//int get
function filterpint($str){
	$str 	= filter_input(INPUT_POST, $str, FILTER_VALIDATE_INT);
	return $str;
}
//int post
function filtergint($str){
	$str 	= filter_input(INPUT_GET, $str, FILTER_VALIDATE_INT);
	return $str;
}

function filterget($str){
	$str 	= filter_input(INPUT_GET, $str, FILTER_SANITIZE_STRING);
	return $str;
}
function filterpost($str){
	$str 	= filter_input(INPUT_POST, $str, FILTER_SANITIZE_STRING);
	return $str;
}
function filterarr($str) {
$str   = filter_input(INPUT_POST, $str, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
return $str;
}
function filter($data) {
	global $db;
    $data = trim(htmlentities(strip_tags($data)));
 
    if (get_magic_quotes_gpc())
        $data = stripslashes($data);
 
    return $data;
}
function cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }
function sanitize($input) {
	global $db;
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysqli_real_escape_string($db,$input);
    }
    return $output;
}
?>